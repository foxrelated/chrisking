<?php
/**
 * [PHPFOX_HEADER]
 */
defined('PHPFOX') or exit('NO DICE!');

/**
 * 
 * 
 * @copyright		Golevel, LLC
 * @author  		Chris Gaines
 * @package  		
 * @version 		
 */
class Idrive_Component_Block_Player_Preview extends Phpfox_Component {

	public function process()
	{
		$aVals = $this->request()->getArray('val');
		
		$aValsClean = array();
		
		foreach ($aVals as $sKey => $sVal)
		{
			$sKey = str_replace('_', '-', $sKey);
			$aValsClean[$sKey] = $sVal;
		}

		$aValsClean['logo-branding-url'] = '';
		
		$sMakes = '';

		foreach ($aVals['selected_makes'] as $sMake => $bSelected)
		{
			if ($bSelected)
			{
				$sMakes .= $sMake . ',';
			}
		}

		$aValsClean['selected-makes'] = rtrim($sMakes, ',');
		
		$this->template()
			->assign(array(
				'aVals' => $aVals,
				'sIframeUrl' => Phpfox::getLib('url')->makeUrl('dvs.player.preview', $aValsClean),
		));
	}


}

?>