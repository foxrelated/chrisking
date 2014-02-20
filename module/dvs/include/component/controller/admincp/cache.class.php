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
class Dvs_Component_Controller_Admincp_Cache extends Phpfox_Component {

	public function process()
	{
		if ($this->request()->get('rebuild'))
		{
			Phpfox::getService('dvs.cache')->rebuild();
		}

		$this->template()
			->assign(array(
				'iTotalDvs' => Phpfox::getService('dvs.cache')->getTotal(),
				'iTotalLocations' => Phpfox::getService('dvs.cache')->getTotal(true),
				'iTotalBlank' => Phpfox::getService('dvs.cache')->getTotal(false)
			))
			->setBreadcrumb(Phpfox::getPhrase('dvs.contact_stats'));
	}


}

?>