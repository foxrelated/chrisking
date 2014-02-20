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
class Dvs_Component_Controller_Admincp_Theme_Index extends Phpfox_Component {

	public function process()
	{
		if ($aVals = $this->request()->getArray('val'))
		{
			if (isset($aVals['theme_id']) && $aVals['theme_id'])
			{
				Phpfox::getService('dvs.theme.process')->update($aVals);
			}
			else
			{
				Phpfox::getService('dvs.theme.process')->add($aVals);
			}
		}

		$aThemes = Phpfox::getService('dvs.theme')->listThemes();

		$this->template()
				->assign(array(
					'aThemes' => $aThemes
				))
				->setBreadcrumb(Phpfox::getPhrase('dvs.themes'));

	}

}

?>