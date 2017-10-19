<?php

/**
 * [PHPFOX_HEADER]
 */
defined('PHPFOX') or exit('GO MICE!');

/**
 *
 *
 * @copyright	Konsort.org
 * @author  		Konsort.org
 * @package 		KOBrightcove
 */
class Kobrightcove_Service_Kobrightcove extends Phpfox_Service {

	public function __construct()
	{
		$this->_sTable = Phpfox::getT('ko_brightcove');
	}


	//Check DB for RefID
	public function refExists($sRef)
	{
		return $this->database()
				->select('COUNT(*)')
				->from($this->_sTable)
				->where('referenceId = "' . $sRef . '"')
				->execute('getField');
	}


	//Build array from local DB browse
	public function browse($iPage, $iPageSize)
	{
		$iPage = (int) $iPage;
		$iPageSize = (int) $iPageSize;

		$iCnt = $this->database()->select('COUNT(*)')
			->from($this->_sTable)
			->execute('getField');

		$aBrowse = $this->database()
			->select('*')
			->from($this->_sTable)
			->limit($iPage, $iPageSize, $iCnt)
			->execute('getRows');

		return array($aBrowse, $iCnt);
	}


	//Check BC for RefID
//	public function refExistsRemote($sRef, $oVideos)
//	{
//		foreach ($oVideos as $key => $oValue) {
//			if ($sRef == $oValue->referenceId) {
//				return true;
//			}
//		}
//		return false;
//	}
	//Imports VMD when local RefID doesn't exist
	public function import($iOffset, $iBatch)
	{
		$iOffset = (int) $iOffset;
		$iBatch = (int) $iBatch;

		$iVideos = 0;

		$oVideos = Phpfox::getService('kobrightcove.koechove')->findUpdate($iOffset, 'year,make,model,bodystyle', 10);

        $aVideos = Phpfox::getService('kobrightcove')->changeBcObjectKey($oVideos);

		$aVideos = Phpfox::getService('kobrightcove')->flattenBcObjectCustomFields($aVideos);

		$aVideos = Phpfox::getService('kobrightcove')->keepAllowedVideos($aVideos);

		$aVideos = Phpfox::getService('kobrightcove')->parseOutNullInts($aVideos);

        $aNewVideos = array();

		foreach ($aVideos as $key => $aValue)
		{
			if (!$this->refExists($aValue['referenceId']))
			{
				if (Phpfox::getService('kobrightcove.data.process')->add($aValue)) {
                    $aNewVideos[] = $aValue['name'];
                }
				//echo '<script>console.log("Adding RefID: ' . $aValue['referenceId'] . '");</script>';
				$iVideos++;
			}
		}

        if(count($aNewVideos)) {
            $oCache = Phpfox::getLib('cache');
            $sCacheId = $oCache->set('kobrightcove_import_video');
            if ($aImportedVideos = $oCache->get($sCacheId)) {
                foreach($aNewVideos as $sVideo) {
                    $aImportedVideos[] = $sVideo;
                }
                $sCacheId = $oCache->set('kobrightcove_import_video');
                $oCache->save($sCacheId, $aImportedVideos);
            } else {
                $aImportedVideos = array();
                foreach($aNewVideos as $sVideo) {
                    $aImportedVideos[] = $sVideo;
                }
                $sCacheId = $oCache->set('kobrightcove_import_video');
                $oCache->save($sCacheId, $aImportedVideos);
            }
        }

		return $iVideos;
	}


	//Overwrites all DB rows with BC data where RefID matches
	public function update($iOffset, $iBatch)
	{
		$iOffset = (int) $iOffset;
		$iBatch = (int) $iBatch;
		$iVideos = 0;

		$oVideos = Phpfox::getService('kobrightcove.koechove')->findUpdate($iOffset, 'year,make,model,bodystyle', 10);

        $aVideos = Phpfox::getService('kobrightcove')->changeBcObjectKey($oVideos);

		$aVideos = Phpfox::getService('kobrightcove')->flattenBcObjectCustomFields($aVideos);

		$aVideos = Phpfox::getService('kobrightcove')->keepAllowedVideos($aVideos);

		$aVideos = Phpfox::getService('kobrightcove')->parseOutNullInts($aVideos);
		foreach ($aVideos as $key => $aValue)
		{
			Phpfox::getService('kobrightcove.data.process')->update($aValue);

			$iVideos++;
		}
		return $iVideos;
	}

    public function changeBcObjectKey($aVideos) {
        $aConvertKeys = array(
            'ad_keys' => 'adKeys',
            'description' => 'shortDescription',
            'long_description' => 'longDescription',
            'created_at' => 'creationDate',
            'published_at' => 'publishedDate',
            'updated_at' => 'lastModifiedDate',
            'reference_id' => 'referenceId',
            'duration' => 'length',
            'economics' => 'economics',
            'custom_fields' => 'customFields'
        );

        foreach ($aVideos as $iKey => $aVideo) {
            $aVideos[$iKey]['videoStillURL'] = $aVideo['images']['poster']['src'] ? $aVideo['images']['poster']['src'] : '';
            $aVideos[$iKey]['thumbnailURL'] = $aVideo['images']['thumbnail']['src'] ? $aVideo['images']['thumbnail']['src'] : '';
            $aVideos[$iKey]['linkURL'] = $aVideo['link']['url'] ? $aVideo['link']['url'] : '';
            $aVideos[$iKey]['linkText'] = $aVideo['link']['text'] ? $aVideo['link']['text'] : '';
            $aVideos[$iKey]['playsTotal'] = 0;
            $aVideos[$iKey]['playsTrailingWeek'] = 0;

            foreach($aConvertKeys as $sConvertKey => $sConvertValue) {
                if (isset($aVideo[$sConvertKey])) {
                    $aVideos[$iKey][$sConvertValue] = $aVideo[$sConvertKey];
                } else {
                    $aVideos[$iKey][$sConvertValue] = '';
                }
            }

            $aVideos[$iKey]['creationDate'] = strtotime($aVideos[$iKey]['creationDate']) * 1000;
            $aVideos[$iKey]['publishedDate'] = strtotime($aVideos[$iKey]['publishedDate']) * 1000;
            $aVideos[$iKey]['lastModifiedDate'] = strtotime($aVideos[$iKey]['lastModifiedDate']) * 1000;
        }

        return $aVideos;
    }


	public function keepAllowedVideos($aVideos)
	{
		$aVideosAllowed = array();

		foreach (Phpfox::getParam('kobrightcove.allow_prefix') as $sAllow)
		{
			foreach ($aVideos as $iKey => $aVideo)
			{
				if (strpos($aVideo['referenceId'], $sAllow) === 0)
				{
					$aVideosAllowed[$iKey] = $aVideo;
				}
			}
		}

		return $aVideosAllowed;
	}


	//Converts StdObject to array, merges second dimension StdObj custom fields, returns array
	public function flattenBcObjectCustomFields($oVideos)
	{
		$aVideos = array();

		foreach ($oVideos as $key => $oValue)
		{
			$aVideos[$key] = (array) $oValue;

			//Set up custom fields in the event BC data is blank
			$aVideos[$key]['year'] = 0;
			$aVideos[$key]['make'] = '';
			$aVideos[$key]['model'] = '';
			$aVideos[$key]['bodyStyle'] = '';

			if ($aVideos[$key]['customFields'])
			{
				foreach ($aVideos[$key]['customFields'] as $keyCf => $oValueCf)
				{
					$aVideos[$key][$keyCf] = $oValueCf;
				}

				//Fix bad naming convention
				$aVideos[$key]['bodyStyle'] = $aVideos[$key]['bodystyle'];

				//Unset redundant object
				unset($aVideos[$key]['customFields']);
			}
		}

		return $aVideos;
	}


	//Converts BC timestamp in to human readable format
	public function convertBcTimestamp($aVideosTemp)
	{
		foreach ($aVideosTemp as $key => $aValue)
		{
			$aValue['creationDate'] = date('Y-m-d H:i:s', substr($aValue['creationDate'], 0, -3));
			$aValue['publishedDate'] = date('m/d/Y H:i:s', substr($aValue['publishedDate'], 0, -3));
			$aValue['lastModifiedDate'] = date('m/d/Y H:i:s', substr($aValue['lastModifiedDate'], 0, -3));
			$aVideos[$key] = $aValue;
		}

		return $aVideos;
	}


	public function parseOutNullInts($aVideosTemp)
	{
		$aVideos = array();

		foreach ($aVideosTemp as $key => $aValue)
		{
			$aValue['length'] = (int) $aValue['length'];
			$aValue['playsTotal'] = (int) $aValue['playsTotal'];
			$aValue['playsTrailingWeek'] = (int) $aValue['playsTrailingWeek'];

			$aVideos[$key] = $aValue;
		}

		return $aVideos;
	}


	public function endScriptTimer($iStartTime)
	{
		$aTimeParts = explode(' ', microtime());
		$iEndTime = $aTimeParts[1] . substr($aTimeParts[0], 1);
		//return bcsub($iEndTime, $iStartTime, 3);
		return round(($iEndTime - $iStartTime), 3);
	}


	public function startScriptTimer()
	{
		$aTimeParts = explode(' ', microtime());
		return $aTimeParts[1] . substr($aTimeParts[0], 1);
	}

    public function sendImportedEmail() {
        $oCache = Phpfox::getLib('cache');
        $sCacheId = $oCache->set('kobrightcove_import_video');
        if ($aNewVideos = $oCache->get($sCacheId)) {
            $iNotificationUserGroup = Phpfox::getParam('kobrightcove.notificationuser_group');
            $aUsers = $this->database()
                ->select('full_name, email')
                ->from(Phpfox::getT('user'))
                ->where('user_group_id = "' . $iNotificationUserGroup . '"')
                ->execute('getRows');
            if ($aUsers) {
                foreach ($aUsers as $aUser) {
                    $sSubject = Phpfox::getPhrase('kobrightcove.notification_email_subject');
                    $sBody = Phpfox::getPhrase('kobrightcove.notification_email_body', array(
                        'user_name' => $aUser['full_name'],
                        'list_video' => implode(
'<br />
', $aNewVideos)
                    ));
                    Phpfox::getLib('mail')
                        ->to($aUser['email'])
                        ->subject($sSubject)
                        ->message($sBody)
                        ->send();
                }
            }
        }

        $sCacheId = $oCache->set('kobrightcove_import_video');
        $oCache->remove($sCacheId);
    }
}

?>