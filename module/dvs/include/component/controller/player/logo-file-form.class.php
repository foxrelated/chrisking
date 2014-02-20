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
class Dvs_Component_Controller_Player_Logo_File_Form extends Phpfox_Component {

	public function process()
	{
		$this->template()
			->setTemplate('blank')
			->setHeader(array('<style>body{background:#FFFFFF !important;}</style>'))
			->assign(array(
				'iUserId' => Phpfox::getUserId(),
				'iCurrentLogoId' => $this->request()->getInt('current-logo-id')
		));
	}


}

?>
