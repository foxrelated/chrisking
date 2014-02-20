<?php

/**
 * [PHPFOX_HEADER]
 */
defined('PHPFOX') or exit('NO DICE!');

/**
 *
 *
 * @copyright	Konsort.org
 * @author  		Konsort.org
 * @package 		Research
 */
class Research_Component_Ajax_Ajax extends Phpfox_Ajax {

	public function getMakes()
	{
		$aMakes = Phpfox::getService('research')->getMakes($this->get('iYear'));
		$sSelect = '<select name="val[_make]" id="val_research_box_make" onchange="$.ajaxCall(\'research.getModels\', \'sMake=\' + this.value + \'&amp;iYear=\'+$(\'#val_research_box_year\').val());"><option value="">Select Make</option>';
		foreach ($aMakes as $value) $sSelect .= '<option value="' . $value['make'] . '">' . $value['make'] . '</option>';
		$sSelect .= '</select>';
		$this->html('#research_box_makes', $sSelect);
		$this->html('#research_box_models', '<select><option value="">' . Phpfox::getPhrase('research.search_box_option_display_when_empty') . '</option></select>');
	}


	public function changeCar()
	{
		$sName = $this->get('sName');
		$aStyleList = Phpfox::getService('research')->getStyleListByName($sName);
		$aStyle = Phpfox::getService('research')->getStyle($aStyleList[0]['style_id']);
		$aVideo = Phpfox::getService('research')->getVideoByName($sName);

		$this->html('#video_summary', '<strong>' . $aVideo['year'] . ' ' . $aVideo['make'] . ' ' . $aVideo['model'] . ' ' . $aVideo['bodyStyle'] . ' Summary</strong>');
		$this->html('#video_long_desc', $aVideo['longDescription']);

		$sSelector = '<select name="val[_style]" id="val_research_box_style" onchange="$.ajaxCall(\'research.changeStyle\', \'iStyleId=\'+this.value);">';

		foreach ($aStyleList as $aSelStyle)
		{
			$sSelector .='<option value="' . $aSelStyle['style_id'] . '">' . $aSelStyle['cf_style_name'] . '</option>';
		}

		$sSelector .= '</select>';

		$this->html('#research_box_info_selector', $sSelector);
		$this->html('#research_box_info_year', $aStyle['year']);
		$this->html('#research_box_info_make', $aStyle['make']);
		$this->html('#research_box_info_model', $aStyle['model']);
		$this->html('#research_box_info_style_name', $aStyle['style_name']);
		$this->html('#research_box_info_drivetrain', $aStyle['drivetrain']);
		$this->html('#research_box_info_bodystyle', $aStyle['bodystyle']);
		$this->html('#research_box_info_engine', $aStyle['engine']);
		$this->html('#research_box_info_horsepower', $aStyle['horsepower']);
		$this->html('#research_box_info_torque', $aStyle['torque']);
		$this->html('#research_box_info_transmission', $aStyle['transmission']);
		$this->html('#research_box_info_mpg_city', $aStyle['mpg_city']);
		$this->html('#research_box_info_mpg_highway', $aStyle['mpg_highway']);
		$this->html('#research_box_info_passengers', $aStyle['passengers']);
	}


	public function getModels()
	{
		$aModels = Phpfox::getService('research')->getModels($this->get('iYear'), $this->get('sMake'));
		$sSelect = '<select name="val[_model]" id="val_research_box_model"><option value="">Select Model</option>';
		foreach ($aModels as $value) $sSelect .= '<option value="' . $value['model'] . '">' . $value['model'] . '</option>';
		$sSelect .= '</select>';
		$this->html('#research_box_models', $sSelect);
	}


	public function changeStyle()
	{
		$aStyle = Phpfox::getService('research')->getStyle($this->get('iStyleId'));

		$this->html('#research_box_info_year', $aStyle['year']);
		$this->html('#research_box_info_make', $aStyle['make']);
		$this->html('#research_box_info_model', $aStyle['model']);
		$this->html('#research_box_info_style_name', $aStyle['style_name']);
		$this->html('#research_box_info_drivetrain', $aStyle['drivetrain']);
		$this->html('#research_box_info_bodystyle', $aStyle['bodystyle']);
		$this->html('#research_box_info_engine', $aStyle['engine']);
		$this->html('#research_box_info_horsepower', $aStyle['horsepower']);
		$this->html('#research_box_info_torque', $aStyle['torque']);
		$this->html('#research_box_info_transmission', $aStyle['transmission']);
		$this->html('#research_box_info_mpg_city', $aStyle['mpg_city']);
		$this->html('#research_box_info_mpg_highway', $aStyle['mpg_highway']);
		$this->html('#research_box_info_passengers', $aStyle['passengers']);
	}


}

?>