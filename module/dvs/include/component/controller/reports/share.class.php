<?php

/**
 * [PHPFOX_HEADER]
 */
defined('PHPFOX') or exit('No direct script access allowed.');

/**
 *
 *
 * @copyright		Konsort.org 
 * @author  		Konsort.org
 * @package 		DVS
 */
class Dvs_Component_Controller_Reports_Share extends Phpfox_Component {

	public function process()
	{
		$sStartYear = date('Y') - 100;
		$sEndYear = date('Y') + 100;
        $shares_clicks = '';
		// Is the user allowed to be here?
		Phpfox::isUser(true);
		
		$sDvsTitle = $this->request()->get('req4'); // Subdomain mode does not matter. DVS Title is req 4 in both cases.

		$aDvs = Phpfox::getService('dvs')->get($sDvsTitle, true);

		$aVals = $this->request()->getArray('val');
		
		if (isset($aVals['user_id']) && $aVals['user_id'])
		{
			$aShareReport = Phpfox::getService('dvs.salesteam')->getShareReport($aDvs['dvs_id'], $aVals);
                        $shares_clicks = Phpfox::getService('dvs.salesteam')->shares_clicks_linechart($aDvs['dvs_id'], $aVals);
                        
			// Export CSV
			if ($aVals['csv'])
			{
				$sCsv = Phpfox::getService('dvs.salesteam')->makeCsv($aShareReport);
				Phpfox::getService('dvs.salesteam')->downloadSendHeaders("share_report_" . $aVals['start_year'] . '-' . $aVals['start_month'] . '-' . $aVals['start_day'] . '_to_' . $aVals['end_year'] . '-' . $aVals['end_month'] . '-' . $aVals['end_day'] . ".csv");
				echo $sCsv;
				exit;
			}
		}
		else
		{
			$aShareReport = array();
		}

		$aDvsOwner = array(Phpfox::getService('user')->get($aDvs['user_id']));
		// Get all of the sales members id's for this DVS.
		$aSalesMembers = Phpfox::getService('dvs.salesteam')->getAll($aDvs['dvs_id']);
        $aManagerMembers = Phpfox::getService('dvs.manager')->getAll($aDvs['dvs_id']);
        $aAllMembers = array();
        foreach ($aSalesMembers as $aSalesMember) {
            $aAllMembers[] = $aSalesMember['user_id'];
        }

        foreach ($aManagerMembers as $aManagerMember) {
            if(!in_array($aManagerMember['user_id'], $aAllMembers)) {
                $aAllMembers[] = $aManagerMember['user_id'];
            }
        }

		// Loop through to pull out their name and email.
		foreach ($aAllMembers as $iMemberId)
		{
			$aSalesMembersDetails[] = Phpfox::getService('user')->get($iMemberId);
		}
		// Did we have any sales members to begin with?
		if (!empty($aSalesMembersDetails)) {
			// Yes, merge the two arrays.
            if(!in_array($aDvs['user_id'], $aAllMembers)) {
                $aTeamMembers = array_merge($aDvsOwner, $aSalesMembersDetails);
            }
		} else {
			// No, just set it equal to the owner array so this variable can be used below in an array merge.
			$aTeamMembers = $aDvsOwner;
		}
		/*if (Phpfox::isAdmin() && $aDvs['user_id'] != Phpfox::getUserId()) {
			$aAdmin = array(Phpfox::getService('user')->get($aDvs['user_id']));
			$aTeamMembers = array_merge($aAdmin, $aTeamMembers);
		}*/

        if(!Phpfox::isAdmin()) {
            foreach($aTeamMembers as $iKey => $aTeamMember) {
                if($aTeamMember['user_group_id'] == 1) {
                    unset($aTeamMembers[$iKey]);
                }
            }
        }
                
		$this->template()
			->setTitle(Phpfox::getPhrase('dvs.share_report'))
			->setBreadcrumb(Phpfox::getPhrase('dvs.share_report'))
			->setHeader(array(
				'<script type="text/javascript">var bDebug = ' . (Phpfox::getParam('dvs.javascript_debug_mode') ? 'true' : 'false') . '</script>',
				'share-report.css' => 'module_dvs',
                'highcharts.js' => 'module_dvs',
                'highcharts-3d.js' => 'module_dvs',
                //'sharechart.js' => 'module_dvs'
			))
			->assign(array(
				'sStartYear' => $sStartYear,
				'sEndYear' => $sEndYear,
				'aDvs' => $aDvs,
				'aForms' => $aVals,
				'aTeamMembers' => $aTeamMembers,
				'aShareReport' => $aShareReport,
                'aShareClicks' => $shares_clicks,
				'aMember' => (isset($aVals['user_id']) ? Phpfox::getService('user')->get($aVals['user_id']) : array())
		));
	}


}

?>