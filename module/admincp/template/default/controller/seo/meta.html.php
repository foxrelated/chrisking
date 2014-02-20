<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: meta.html.php 4165 2012-05-14 10:43:25Z Raymond_Benc $
 */
 
defined('PHPFOX') or exit('NO DICE!'); 

?>
<form method="post" action="#" onsubmit="$(this).ajaxCall('admincp.addMeta'); return false;" id="js_meta_form">
	<div class="table_header">
		{phrase var='admincp.add_new_meta'}
	</div>
	<div class="table">
		<div class="table_left">
			{phrase var='admincp.type'}:
		</div>
		<div class="table_right">
			<select name="val[type_id]">
				<option value="0">{phrase var='admincp.keyword'}</option>
				<option value="1">{phrase var='admincp.description'}</option>
			</select>
		</div>
		<div class="clear"></div>
	</div>	
	
	<div class="table">
		<div class="table_left">
			{phrase var='admincp.url'}:
		</div>
		<div class="table_right">
			<input type="input" name="val[url]" value="" size="60" id="js_nofollow_url" />
			<div class="extra_info">
				{phrase var='admincp.provide_the_full_url_to_add_your_custom_meta_keywords_or_descriptions'}
			</div>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="table">
		<div class="table_left">
			{phrase var='admincp.value'}:
		</div>
		<div class="table_right">
			<textarea name="val[content]" cols="60" rows="6"></textarea>		
			<div class="extra_info">
				{phrase var='admincp.separate_keywords_with_commas'}
			</div>
		</div>
		<div class="clear"></div>
	</div>	
	
	<div class="table_clear">
		<input type="submit" value="{phrase var='admincp.submit'}" class="button" />
	</div>
</form>

<br /><br />

<div id="js_meta_holder"{if !count($aMetas)} style="display:none;"{/if}>	
	<form method="post" action="#" onsubmit="$(this).ajaxCall('admincp.deleteMeta'); return false;">	
		<div class="table_header">
			{phrase var='admincp.meta_keyword_descriptions'}
		</div>
		<table cellpadding="0" cellspacing="0" id="js_meta_holder_table">
			<tr>
				<th style="width:10px;"><input type="checkbox" name="val[id]" value="" id="js_check_box_all" /></th>
				<th>{phrase var='admincp.type'}</th>
				<th>{phrase var='admincp.url'}</th>
				<th>{phrase var='admincp.value'}</th>
				<th style="width:20%;">{phrase var='admincp.added'}</th>
			</tr>
		{foreach from=$aMetas item=aMeta key=iKey}
			<tr id="js_id_row_{$aMeta.meta_id}" class="js_nofollow_row {if is_int($iKey/2)} tr{else}{/if}">
				<td><input type="checkbox" name="id[]" class="checkbox" value="{$aMeta.meta_id}" id="js_id_row{$aMeta.meta_id}" /></td>
				<td>{if $aMeta.type_id}{phrase var='admincp.description'}{else}{phrase var='admincp.keyword'}{/if}</td>
				<td>{$aMeta.url}</td>
				<td><textarea name="val[{$aMeta.meta_id}][content]" cols="30" rows="4" style="height:30px;">{$aMeta.content|clean}</textarea></td>
				<td>{$aMeta.time_stamp|convert_time}</td>
			</tr>
		{/foreach}
		</table>
		<div class="table_bottom">	
			<input type="submit" name="delete" value="{phrase var='admincp.delete'}" class="button sJsConfirm disabled sJsCheckBoxButton" disabled="true" />
		</div>
	</form>
</div>