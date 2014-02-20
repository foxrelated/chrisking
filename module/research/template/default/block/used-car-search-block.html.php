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
		{phrase var='research.research_used_cars'}
	</div>
	<form method="post" action="{url link='research.view'}">
	<fieldset>
		
		<div class="table">
			<br />
			<div class="table_left">
				{phrase var='research.year'}
			</div>
			<div class="table_right">
				<select name="val[_year]" id="val_research_box_year" onchange="$.ajaxCall('research.getMakes', 'iYear='+this.value);">
					<option value="">Select Year</option>
					{foreach from=$aYears item=value}
						<option value="{$value.year}" {value type='select' id='_year' default=$value.year}>{$value.year}</option>
					{/foreach}
				</select>
			</div>
			<div class="clear"></div>
		</div>
		
		<div class="table">
			<div class="table_left">
				{phrase var='research.make'}
			</div>
			<div class="table_right" id="research_box_makes">
				<select><option value="">{phrase var='research.search_box_option_display_when_empty'}</option></select>
			</div>
			<div class="clear"></div>
		</div>
		
		<div class="table">
			<div class="table_left">
				{phrase var='research.model'}
			</div>
			<div class="table_right" id="research_box_models">
				<select><option value="">{phrase var='research.search_box_option_display_when_empty'}</option></select>
			</div>
			<div class="clear"></div>
		</div>
		
		<div class="table">
			<div class="table_left">
			</div>
			<div class="table_right" id="research_box_button">
				<input type="button" onclick="
                                    if ($('#val_research_box_year').val() > 0)
                                        {left_curly}
                                            window.location.href=
                                                '{url link='research.view'}' +
                                                'type_used/year_' +
                                                $('#val_research_box_year').val() +
                                                '/make_' +
                                                $('#val_research_box_make').val() +
                                                '/model_' +
                                                $('#val_research_box_model').val() ;
                                        {right_curly}
                                 " value="{phrase var='research.find_car'}" class="button" />
			</div>
			<div class="clear"></div>
		</div>
	</fieldset>
	</form>
</div>