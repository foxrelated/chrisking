<?php
/**
* [PHPFOX_HEADER]
*/

defined('PHPFOX') or exit('DRINK SLICE!');

/**
*
*
* @copyright	Konsort.org 
* @author  		Konsort.org
* @package 		Research
*/
?>
<div class="main_break"></div>

<div class="block sub_block">
	<div class="title">
		{phrase var='research.more_information'}
	</div>

	<div class="main_break"></div>

	<form method="post" action="{url link='research.search'}">
	<fieldset>
		<div align="center" id="research_box_info_selector">
			<select name="val[_style]" id="val_research_box_style" onchange="$.ajaxCall('research.changeStyle', 'iStyleId='+this.value);">
				{foreach from=$aStyleList item=value}
					<option value="{$value.style_id}" {value type='select' id='_style' default=$value.style_id}>{$value.cf_style_name}</option>
				{/foreach}
			</select>
		</div>
	</fieldset>
	</form>
	
	<div class="main_break"></div>

	<div id="research_box_info" style="padding-left: 100px;">
		<div class="table">
			<div class="table_left" style="padding: 0 0 0 0; padding-left: 70px;">
				{phrase var='research.year_info'}:
			</div>
			<div class="table_right" id="research_box_info_year">
				{$aStyle.year}
			</div>
		</div>
		
		<div class="table">
			<div class="table_left" style="padding: 0 0 0 0; padding-left: 70px;">
				{phrase var='research.make_info'}:
			</div>
			<div class="table_right" id="research_box_info_make">
				{$aStyle.make}
			</div>
		</div>

		<div class="table">
			<div class="table_left" style="padding: 0 0 0 0; padding-left: 70px;">
				{phrase var='research.model_info'}:
			</div>
			<div class="table_right" id="research_box_info_model">
				{$aStyle.model}
			</div>
		</div>

		<div class="table">
			<div class="table_left" style="padding: 0 0 0 0; padding-left: 70px;">
				{phrase var='research.trim'}:
			</div>
			<div class="table_right" id="research_box_info_style_name">
				{$aStyle.style_name}
			</div>
		</div>

		<div class="table">
			<div class="table_left" style="padding: 0 0 0 0; padding-left: 70px;">
				{phrase var='research.drivetrain'}:
			</div>
			<div class="table_right" id="research_box_info_drivetrain">
				{$aStyle.drivetrain}
			</div>
		</div>

		<div class="table">
			<div class="table_left" style="padding: 0 0 0 0; padding-left: 70px;">
				{phrase var='research.bodystyle'}:
			</div>
			<div class="table_right" id="research_box_info_bodystyle">
				{$aStyle.bodystyle}
			</div>
		</div>

		<div class="table">
			<div class="table_left" style="padding: 0 0 0 0; padding-left: 70px;">
				{phrase var='research.engine'}:
			</div>
			<div class="table_right" id="research_box_info_engine">
				{$aStyle.engine}
			</div>
		</div>

		<div class="table">
			<div class="table_left" style="padding: 0 0 0 0; padding-left: 70px;">
				{phrase var='research.horsepower'}:
			</div>
			<div class="table_right" id="research_box_info_horsepower">
				{$aStyle.horsepower}
			</div>
		</div>

		<div class="table">
			<div class="table_left" style="padding: 0 0 0 0; padding-left: 70px;">
				{phrase var='research.torque'}:
			</div>
			<div class="table_right" id="research_box_info_torque">
				{$aStyle.torque}
			</div>
		</div>

		<div class="table">
			<div class="table_left" style="padding: 0 0 0 0; padding-left: 70px;">
				{phrase var='research.transmission'}:
			</div>
			<div class="table_right" id="research_box_info_transmission">
				{$aStyle.transmission}
			</div>
		</div>

		<div class="table">
			<div class="table_left" style="padding: 0 0 0 0; padding-left: 70px;">
				{phrase var='research.mpg_city'}:
			</div>
			<div class="table_right" id="research_box_info_mpg_city">
				{$aStyle.mpg_city}
			</div>
		</div>

		<div class="table">
			<div class="table_left" style="padding: 0 0 0 0; padding-left: 70px;">
				{phrase var='research.mpg_highway'}:
			</div>
			<div class="table_right" id="research_box_info_mpg_highway">
				{$aStyle.mpg_highway}
			</div>
		</div>

		<div class="table">
			<div class="table_left" style="padding: 0 0 0 0; padding-left: 70px;">
				{phrase var='research.passengers'}:
			</div>
			<div class="table_right" id="research_box_info_passengers">
				{$aStyle.passengers}
			</div>
		</div>
	</div>
</div>