<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond_Benc
 * @package 		Phpfox
 * @version 		$Id: export.html.php 4961 2012-10-29 07:11:34Z Raymond_Benc $
 */
 
defined('PHPFOX') or exit('NO DICE!'); 

?>
<div class="table_header">
	Export
</div>
<form method="post" action="{url link='admincp.apps.export'}">
	<div class="table">
		<div class="table_left">
			Package Title:
		</div>
		<div class="table_right">
			<input type="text" name="val[title]" value="{value id='title' type='input'}" size="40" style="width:90%;" />			
		</div>
		<div class="clear"></div>
	</div>
	<div class="table">
		<div class="table_left">
			Callback URL:
		</div>
		<div class="table_right">
			<input type="text" name="val[url]" value="{value id='url' type='input'}"" size="40" style="width:90%;" />
			<div class="extra_info">
				This is the URL you will be notified when a client installs your set of Apps and you will be provided with API keys.
			</div>
		</div>
		<div class="clear"></div>
	</div>
	<div class="table">
		<div class="table_left">
			Apps to Export:
		</div>
		<div class="table_right">
			<div class="label_flow" style="max-height:200px;">
			{foreach from=$aApps item=aApp}
				<div class="p_4">
					<label for="js_{$aApp.app_id}"><input name="val[apps][]" type="checkbox" value="{$aApp.app_id}" id="js_{$aApp.app_id}" checked="checked" /> {$aApp.app_title|clean}</label>
				</div>
			{/foreach}
			</div>			
		</div>
		<div class="clear"></div>
	</div>	
	<div class="table_clear">
		<input type="submit" value="Submit" class="button" />
	</div>
</form>