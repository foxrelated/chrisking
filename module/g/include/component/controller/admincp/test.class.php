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
 * @package 		G
 */
class G_Component_Controller_Admincp_Test extends Phpfox_Component {

	public function process()
	{

		
		Phpfox::getService('g.my-shows')->getPage();

		$this->template()
				->setBreadcrumb('GoLevel Dev Tools - TEST')
				->assign(array(
					'sVar' => 'Var'
				));

	}

}

?>