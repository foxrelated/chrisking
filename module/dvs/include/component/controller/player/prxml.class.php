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
class Dvs_Component_Controller_Player_Prxml extends Phpfox_Component {

	public function process()
	{
		$iId = $this->request()->getInt('id');
		
		if ($iId)
		{
			$aPlayer = Phpfox::getService('dvs.player')->get($iId);
		}
		else
		{
			$aPlayer = array();
			$aPlayer['preroll_file_name'] = Phpfox::getService('dvs.file')->getPrerollFile($this->request()->getInt('pr-id'));
			$aPlayer['preroll_duration'] = $this->request()->getInt('duration', '15');
			$aPlayer['preroll_url'] = '';
		}

		header("Content-type: text/xml");
		echo '<videoAd trackPointTime="" version="1" trackPointURLs="" duration="' . $aPlayer['preroll_duration'] . '" trackStartURLs="" trackMidURLs="" trackEndURLs="">';
		echo '<videoURL>' . Phpfox::getParam('core.url_file') . 'dvs/preroll/' . $aPlayer['preroll_file_name'] . '</videoURL>';
		echo '<videoClickURL>' . $aPlayer['preroll_url'] . '</videoClickURL>';
		echo '</videoAd>';
		exit;
	}


}

?>