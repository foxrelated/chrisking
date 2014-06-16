<?php

/**
 * [PHPFOX_HEADER]
 */
defined('PHPFOX') or exit('No direct script access allowed.');

/**
 *
 *
 * @copyright		Konsort.org
 * @author  		James
 * @package 		DVS
 */
class Dvs_Service_Salesteam_Salesteam extends Phpfox_Service {

	public function __construct()
	{
		$this->_tSalesTeam = Phpfox::getT('ko_dvs_salesteam');
	}


	/**
	 * Get a sales team member by salesteam id
	 *
	 * @param int $iTeamMemberId
	 * @param $iDvsId, look up by dvs id and user_id
	 * @return array, team member
	 */
	public function get($iTeamMemberId, $iDvsId = 0)
	{
		return $this->database()->select('s.*, ' . Phpfox::getUserField())
				->from($this->_tSalesTeam, 's')
				->join(Phpfox::getT('user'), 'u', 'u.user_id = s.user_id')
				->where(($iDvsId ? 's.user_id =' . (int) $iTeamMemberId . ' AND s.dvs_id =' . (int) $iDvsId : 's.salesteam_id =' . (int) $iTeamMemberId))
				->execute('getRow');
	}


	/**
	 * Get a list of sales team members
	 *
	 * @return array, list of salesteams
	 */
	public function getAll($iDvsId)
	{
		$aTeamMembers = $this->database()->select('s.*, u.email, ' . Phpfox::getUserField())
			->from($this->_tSalesTeam, 's')
			->join(Phpfox::getT('user'), 'u', 'u.user_id = s.user_id')
			->where('s.dvs_id = ' . $iDvsId)
			->execute('getRows');

		return $aTeamMembers;
	}


	public function searchUserId($sEmailAddress)
	{
		return $this->database()->select('u.user_id')
				->from(Phpfox::getT('user'), 'u')
				->where('u.email = "' . $sEmailAddress . '"')
				->execute('getField');
	}


	/**
	 * Get all members of the Sales Team usergroup
	 */
	public function getUsergroupMembers()
	{
		$aUserGroupMembers = $this->database()->select('email, ' . Phpfox::getUserField())
			->from(Phpfox::getT('user'), 'u')
			->where('user_group_id = ' . Phpfox::getParam('dvs.salesteam_usergroup_id'))
			->execute('getRows');

		return $aUserGroupMembers;
	}


	/**
	 * Gets all sales team members that have already been assigned to other DVSs that the logged in user has created
	 *
	 * @param int $iDvsId
	 * @return array
	 */
	public function getRelated($iDvsId)
	{
		// Get a list of the user's DVSs

		$aDvss = Phpfox::getService('dvs')->listDvss(0, 0, Phpfox::getUserId(), false);

		// Build related sales team
		$aTeamMembers = array();

		foreach ($aDvss as $aDvs)
		{
			$aDvsTeamMembers = $this->getAll($aDvs['dvs_id']);
			foreach ($aDvsTeamMembers as $aUser)
			{
				$aTeamMembers[$aUser['user_id']] = $aUser;
			}
		}

		return $aTeamMembers;
	}


	/**
	 * Return a list of DVSs to provide links for
	 *
	 * @param type $iUserId
	 */
	public function getMyLinks($iUserId)
	{
		return $this->database()->select('s.*, d.*')
				->from($this->_tSalesTeam, 's')
				->join(Phpfox::getT('ko_dvs'), 'd', 'd.dvs_id = s.dvs_id')
				->where('s.user_id =' . (int) $iUserId)
				->execute('getRows');
	}


	public function getShareReport($iDvsId, $aVals)
	{
		$iDvsId = (int) $iDvsId;
		$iUserId = (int) $aVals['user_id'];
		$iLimit = (int) $aVals['limit'];

		$iStartDate = Phpfox::getLib('date')->convertToGmt(Phpfox::getLib('date')->mktime(0, 0, 0, $aVals['start_month'], $aVals['start_day'], $aVals['start_year']));
		$iEndDate = Phpfox::getLib('date')->convertToGmt(Phpfox::getLib('date')->mktime(23, 59, 59, $aVals['end_month'], $aVals['end_day'], $aVals['end_year']));

		$aServices = array(
			'total' => 0,
			'email' => 0,
			'facebook' => 0,
			'google' => 0,
			'twitter' => 0,
			'embed' => 0,
		);

		$aShareReport = array(
			'total_generated' => $aServices,
			'total_clicked' => $aServices,
			'ctr' => $aServices
		);

		$aTotalGenerated = $this->database()->select('s.service, COUNT(s.shorturl_id) as total_generated')
			->from(Phpfox::getT('ko_shorturls'), 's')
			->where('s.dvs_id = ' . $iDvsId . ' AND s.user_id = ' . $iUserId . ' AND s.timestamp BETWEEN ' . $iStartDate . ' AND ' . $iEndDate . ' AND s.hidden = 0')
			->group('s.service')
			->execute('getRows');

		foreach ($aTotalGenerated as $aService)
		{
			$aShareReport['total_generated'][$aService['service']] = $aService['total_generated'];
			$aShareReport['total_generated']['total'] += $aService['total_generated'];
		}

		$aTotalClicked = $this->database()->select('s.service, COUNT(s.shorturl_id) as total_clicked')
			->from(Phpfox::getT('ko_shorturls'), 's')
			->join(Phpfox::getT('ko_shorturl_clicks'), 'c', 'c.shorturl_id = s.shorturl_id')
			->where('s.dvs_id = ' . $iDvsId . ' AND s.user_id = ' . $iUserId . ' AND s.timestamp BETWEEN ' . $iStartDate . ' AND ' . $iEndDate . ' AND s.hidden = 0 AND c.ip_address REGEXP \'[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\'')
			->group('s.service')
			->execute('getRows');

		foreach ($aTotalClicked as $aService)
		{
			$serviceTotalClicked = (!in_array($aService['service'], array('facebook', 'google'))?$aService['total_clicked']:($aService['total_clicked'] - $aShareReport['total_generated'][$aService['service']])); // check if there is facebook or google - subtract 1 point for each shared link
			$aShareReport['total_clicked'][$aService['service']] = $serviceTotalClicked;
			$aShareReport['total_clicked']['total'] += $serviceTotalClicked;

			$aShareReport['ctr'][$aService['service']] = round($serviceTotalClicked / $aShareReport['total_generated'][$aService['service']], 2) * 100;
		}

		if ($aShareReport['total_generated']['total'] != 0)
		{
			$aShareReport['ctr']['total'] = round($aShareReport['total_clicked']['total'] / $aShareReport['total_generated']['total'], 2) * 100;
		}
		else
		{
			$aShareReport['ctr']['total'] = 0;
		}

		//$aShareReport['top_generated'] = $this->database()->select('v.video_title_url, v.referenceId, COUNT(s.shorturl_id) as total_generated')
		$aShareReport['top_generated'] = $this->database()->select('v.name, v.referenceId, COUNT(s.shorturl_id) as total_generated')

			->from(Phpfox::getT('ko_shorturls'), 's')
			->join(Phpfox::getT('ko_brightcove'), 'v', 'v.referenceId = s.video_ref_id')
			->where('s.dvs_id = ' . $iDvsId . ' AND s.user_id = ' . $iUserId . ' AND s.timestamp BETWEEN ' . $iStartDate . ' AND ' . $iEndDate . ' AND s.hidden = 0')
			->group('s.video_ref_id')
			->order('total_generated DESC')
			->limit($iLimit)
			->execute('getRows');

		foreach ($aShareReport['top_generated'] as $iKey => $aVideo)
		{
			$aShareReport['top_generated'][$iKey] = array_merge($aShareReport['top_generated'][$iKey], $this->getVideoCount($aVideo['referenceId'], $iDvsId, $iUserId, false, $iStartDate, $iEndDate, $iLimit));
		}

		//$aShareReport['top_clicked'] = $this->database()->select('v.video_title_url, v.referenceId, COUNT(s.shorturl_id) as total_clicked')
		$aShareReport['top_clicked'] = $this->database()->select('v.name, v.referenceId, COUNT(s.shorturl_id) as total_clicked')
			->from(Phpfox::getT('ko_shorturls'), 's')
			->join(Phpfox::getT('ko_brightcove'), 'v', 'v.referenceId = s.video_ref_id')
			->join(Phpfox::getT('ko_shorturl_clicks'), 'c', 'c.shorturl_id = s.shorturl_id')
			->where('s.dvs_id = ' . $iDvsId . ' AND s.user_id = ' . $iUserId . ' AND s.timestamp BETWEEN ' . $iStartDate . ' AND ' . $iEndDate . ' AND s.hidden = 0')
			->group('s.video_ref_id')
			->order('total_clicked DESC')
			->limit($iLimit)
			->execute('getRows');

		foreach ($aShareReport['top_clicked'] as $iKey => $aVideo)
		{
			$aShareReport['top_clicked'][$iKey] = array_merge($aShareReport['top_clicked'][$iKey], $this->getVideoCount($aVideo['referenceId'], $iDvsId, $iUserId, false, $iStartDate, $iEndDate, $iLimit));
		}

		return $aShareReport;
	}

        //caculator for line chart
        public function shares_clicks_linechart($iDvsId,$aVals)
        {
                $iDvsId = (int) $iDvsId;
		$iUserId = (int) $aVals['user_id'];
		//$iLimit = (int) $aVals['limit'];

		$iStartDate = Phpfox::getLib('date')->convertToGmt(Phpfox::getLib('date')->mktime(0, 0, 0, $aVals['start_month'], $aVals['start_day'], $aVals['start_year']));
		$iEndDate = Phpfox::getLib('date')->convertToGmt(Phpfox::getLib('date')->mktime(23, 59, 59, $aVals['end_month'], $aVals['end_day'], $aVals['end_year']));

		$aServices = array(
			'total' => 0,
			'email' => 0,
			'facebook' => 0,
			'google' => 0,
			'twitter' => 0,
			'embed' => 0,
		);

		$aShareReport = array(
			'total_generated' => $aServices,
			'total_clicked' => $aServices,
			//'ctr' => $aServices
		);
                $iTime = $iEndDate - $iStartDate; 
                //check > 3 month
                $monthTimestamp =  30*86400;
                $weekTimestamp = 7*86400;
                $check3 = $iTime/$monthTimestamp;    
                $checkweek = $iTime/$weekTimestamp;
                $montharr_stamp = array();
                $montharr = array();
                //echo $check3;
                if($check3 > 3){
                    for($m =0; $m < $check3; $m++){
                        $montharr[$m] = date('m/d/Y',$iStartDate+86400*30*$m);
                        $montharr_stamp[$m] =  $iStartDate+86400*30*$m;
                    }
                    $montharr[$check3] = date('m/d/Y',$iEndDate);
                    $montharr_stamp[$check3] = $iEndDate;
                }else{
                   for($m =0; $m < $checkweek; $m++){
                        $montharr[$m] = date('m/d/Y',$iStartDate+86400*7*$m);
                        $montharr_stamp[$m] = $iStartDate+86400*7*$m;
                    }
                    $montharr[$checkweek] = date('m/d/Y',$iEndDate); 
                    $montharr_stamp[$checkweek] = $iEndDate;
                }
                $aShareReport['listtime']= $montharr;
                $sharearr = array();
                $clickarr = array();
                //var_dump($aShareReport);exit;
                //var_dump($montharr_stamp);
               
                for($i=0;$i<count($montharr_stamp);$i++)
                {
                    $aShareReport['total_generated']['total'] =0;
                    $aShareReport['total_clicked']['total'] =0;
                    $aTotalGenerated = $this->database()->select('s.service, COUNT(s.shorturl_id) as total_generated')
                            ->from(Phpfox::getT('ko_shorturls'), 's')
                            ->where('s.dvs_id = ' . $iDvsId . ' AND s.user_id = ' . $iUserId . ' AND s.timestamp BETWEEN ' . $montharr_stamp[$i] . ' AND ' . $montharr_stamp[$i+1] . ' AND s.hidden = 0')
                            ->group('s.service')
                            ->execute('getRows');
                    //var_dump(date('m/d/Y',1400812614));
                   
                    foreach ($aTotalGenerated as $aService)
                    {
                            $aShareReport['total_generated'][$aService['service']] = $aService['total_generated'];
                            $aShareReport['total_generated']['total'] += $aService['total_generated'];
                    }
                    //$sharearr[$i] =  count($aTotalGenerated);
                    $sharearr[$i] = $aShareReport['total_generated']['total'];
                    $aTotalClicked = $this->database()->select('s.service, COUNT(s.shorturl_id) as total_clicked')
                            ->from(Phpfox::getT('ko_shorturls'), 's')
                            ->join(Phpfox::getT('ko_shorturl_clicks'), 'c', 'c.shorturl_id = s.shorturl_id')
                            ->where('s.dvs_id = ' . $iDvsId . ' AND s.user_id = ' . $iUserId . ' AND c.timestamp BETWEEN ' . $montharr_stamp[$i] . ' AND ' . $montharr_stamp[$i+1] . ' AND s.hidden = 0 AND c.ip_address REGEXP \'[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\'')
                            ->group('s.service')
                            ->execute('getRows');
                  
                   foreach ($aTotalClicked as $aService)
                    {
                            $serviceTotalClicked = (!in_array($aService['service'], array('facebook', 'google'))?$aService['total_clicked']:($aService['total_clicked'] - $aShareReport['total_generated'][$aService['service']])); // check if there is facebook or google - subtract 1 point for each shared link
                            $aShareReport['total_clicked'][$aService['service']] = $serviceTotalClicked;
                            $aShareReport['total_clicked']['total'] += $serviceTotalClicked;

                            //$aShareReport['ctr'][$aService['service']] = round($serviceTotalClicked / $aShareReport['total_generated'][$aService['service']], 2) * 100;
                    }
                    $clickarr[$i] =$aShareReport['total_clicked']['total'];
                }
                $aShareReport['shares'] = $sharearr;
                $aShareReport['clicks'] = $clickarr;
               /* echo '<pre>';
                print_r($aShareReport);
                echo '</pre>';exit;
                 */
                return $aShareReport;
                 
        }

        public function getVideoCount($sVideoRefId, $iDvsId, $iUserId, $bClicked, $iStartDate, $iEndDate, $iLimit)
	{
		if ($bClicked)
		{
			$this->database()->join(Phpfox::getT('ko_shorturl_clicks'), 'c', 'c.shorturl_id = s.shorturl_id');
		}

		$aVideoInfo = $this->database()->select('s.service, COUNT(DISTINCT s.shorturl_id) as total')
			->from(Phpfox::getT('ko_shorturls'), 's')
			->join(Phpfox::getT('ko_brightcove'), 'v', 'v.referenceId = s.video_ref_id')
			->where('s.dvs_id = ' . $iDvsId . ' AND s.user_id = ' . $iUserId . ' AND s.timestamp BETWEEN ' . $iStartDate . ' AND ' . $iEndDate . ' AND s.hidden = 0' . ' AND s.video_ref_id = "' . $sVideoRefId . '"')
			->group('s.service')
			->order('total DESC')
			->limit($iLimit)
			->execute('getRows');

		$aReturn = array(
			'total' => 0,
			'email' => 0,
			'facebook' => 0,
			'google' => 0,
			'twitter' => 0
		);

		foreach ($aVideoInfo as $aService)
		{
			$aReturn[$aService['service']] = $aService['total'];
			$aReturn['total'] += $aService['total'];
		}

		return $aReturn;
	}


	/**
	 * Creates a CSV file ready for output
	 *
	 * @param array $aReport
	 * @return string
	 */
	public function makeCsv(&$aReport)
	{
		if (count($aReport) == 0)
		{
			return null;
		} ob_start();
		$rFilePointer = fopen("php://output", 'w');

		fputcsv($rFilePointer, array(
			'Email Shares Sent',
			'Email Links Clicked',
			'Email CTR',
			'Facebook Shares Sent',
			'Facebook Links Clicked',
			'Facebook CTR',
			'Twitter Shares Sent',
			'Twitter Links Clicked',
			'Twitter CTR',
			'Google Shares Sent',
			'Google Links Clicked',
			'Google CTR',
			'Embed Shares Sent',
			'Embed Links Clicked',
			'Embed CTR',
		));

		fputcsv($rFilePointer, array(
			$aReport['total_generated']['email'],
			$aReport['total_clicked']['email'],
			$aReport['ctr']['email'],
			$aReport['total_generated']['facebook'],
			$aReport['total_clicked']['facebook'],
			$aReport['ctr']['facebook'],
			$aReport['total_generated']['twitter'],
			$aReport['total_clicked']['twitter'],
			$aReport['ctr']['twitter'],
			$aReport['total_generated']['google'],
			$aReport['total_clicked']['google'],
			$aReport['ctr']['google'],
			$aReport['total_generated']['embed'],
			$aReport['total_clicked']['embed'],
			$aReport['ctr']['embed'],
		));

		fclose($rFilePointer);
		return ob_get_clean();
	}


	/*
	 * Send headers required in initiate a file download
	 */

	public function downloadSendHeaders($sFilename)
	{
		// disable caching
		$now = gmdate("D, d M Y H:i:s");
		header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
		header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
		header("Last-Modified: {$now} GMT");

		// force download
		header("Content-Type: application/force-download");
		header("Content-Type: application/octet-stream");
		header("Content-Type: application/download");

		// disposition / encoding on response body
		header("Content-Disposition: attachment;filename={$sFilename}");
		header("Content-Transfer-Encoding: binary");
	}


}

?>