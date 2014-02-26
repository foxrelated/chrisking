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
class Dvs_Component_Block_Get_Price extends Phpfox_Component {

	public function process()
	{
		
		$this->template()
				->assign(array(
					'aVideo' => Phpfox::getService('dvs.video')->get($this->getParam('sRefId')),
					'aDvs' => Phpfox::getService('dvs')->get($this->getParam('iDvsId'), false)
		));
	}


}

?>