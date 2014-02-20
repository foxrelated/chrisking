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
class Dvs_Component_Controller_Admincp_Theme_Add extends Phpfox_Component {

	public function process()
	{
		if ($iThemeId = $this->request()->get('theme-id'))
		{
			if (($aForms = Phpfox::getService('dvs.theme')->get($iThemeId)))
			{

				$bIsEdit = true;
			}
		}
		else
		{
			$bIsEdit = false;
			$aForms = array();
		}

		$this->template()
				->setHeader(array(
					'colorpicker.js' => 'module_dvs',
					'eye.js' => 'module_dvs',
					'utils.js' => 'module_dvs',
					'layout.js' => 'module_dvs',
					'colorpicker.css' => 'module_dvs',
					'<script type="text/javascript">var bDebug = ' . (Phpfox::getParam('dvs.javascript_debug_mode') ? 'true' : 'false') . '</script>',
					'player.js' => 'module_dvs',
					'jcarousellite.js' => 'module_dvs',
					'add.css' => 'module_dvs',
				))
				->assign(array(
					'sDefaultColor' => Phpfox::getParam('dvs.default_color_picker_color'),
					'bIsEdit' => $bIsEdit,
					'aForms' => $aForms,
					'sImagePath' => (Phpfox::getParam('dvs.enable_subdomain_mode') ? Phpfox::getLib('url')->makeUrl('www.module.dvs.static.image') : Phpfox::getLib('url')->makeUrl('module.dvs.static.image')),
				))
				->setBreadcrumb(Phpfox::getPhrase('dvs.add_theme'))
				->setBreadcrumb(Phpfox::getPhrase('dvs.add_theme'));
	}


}

?>