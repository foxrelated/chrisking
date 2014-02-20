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
{literal}
<script language="javascript">
	<!--
	function submitenter(myfield,e)
	{
	var keycode;
	if (window.event) keycode = window.event.keyCode;
	else if (e) keycode = e.which;
	else return true;

	if (keycode == 13)
	   {
		window.location.href="{/literal}{url link='research.search'}{literal}" + "type_all/text_" + $('#val_research_search_text').val();
	   return false;
	   }
	else
	   return true;
	}
	//-->
</script>
{/literal}
<div class="main_break"></div>
<div class="block sub_block">
	<div class="title">
		{phrase var='research.search_all_cars'}
	</div>
	<form>
	<fieldset>
		
		<div class="table">
			<br />
			<div class="table_left">
				{phrase var='research.keywords'}:
			</div>
			<div class="table_right">
				<input type="text" name="search" id="val_research_search_text" onKeyPress="return submitenter(this,event)" value="{phrase var='research.enter_text_to_search'}" onfocus="if(this.value=='{phrase var='research.enter_text_to_search'}')this.value=''">
			</div>
			<div class="clear"></div>
		</div>
		
		<div class="table">
			<div class="table_left">
			</div>
			<div class="table_right" id="research_box_button">
				<input type="button" onclick="
                                    if ($('#val_research_search_text').val() != '')
                                        {left_curly}
                                            window.location.href=
                                                '{url link='research.search'}' +
                                                'type_all/text_' +
                                                $('#val_research_search_text').val() ;
                                        {right_curly}
                                 " value="{phrase var='research.find_cars'}" class="button" />
			</div>
			<div class="clear"></div>
		</div>
	</fieldset>
	</form>
</div>