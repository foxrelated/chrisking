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
class Dvs_Component_Block_Share_Links extends Phpfox_Component {

	public function process()
	{
		$aMyDvss = Phpfox::getService('dvs.salesteam')->getMyLinks(Phpfox::getUserId());

		if (empty($aMyDvss))
		{
			return false;
		}

		$this->template()
			->assign(array(
				'aDvss' => $aMyDvss,
				'bSubdomainMode' => Phpfox::getParam('dvs.enable_subdomain_mode'),
				'sHeader' => Phpfox::getPhrase('dvs.share_links_block_header')
		));

		return 'block';
	}


}

?>