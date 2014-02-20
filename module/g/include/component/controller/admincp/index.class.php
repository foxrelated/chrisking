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
class G_Component_Controller_Admincp_Index extends Phpfox_Component {

	public function process()
	{
		$aFiles = Phpfox::getLib('file')->getAllFiles(PHPFOX_DIR_CACHE);

		//Phpfox::getService('g')->d($aFiles);

		$this->template()
				->setBreadcrumb('GoLevel Dev Tools')
				->assign(array(
					'iTotalCachedFiles' => count($aFiles)
				));

	}

}

?>