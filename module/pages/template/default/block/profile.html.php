<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond_Benc
 * @package 		Phpfox
 * @version 		$Id: profile.html.php 4458 2012-07-03 12:30:43Z Miguel_Espinoza $
 */
 
defined('PHPFOX') or exit('NO DICE!'); 

?>

{foreach from=$aPages name=pages item=aPage}
<div class="pages_profile_block"{if $phpfox.iteration.pages > 6} style="display:none;"{/if}>
	<a href="{$aPage.url}" title="{$aPage.title|clean}">
		{if $aPage.is_app}
			{img server_id=0 path='app.url_image' file=$aPage.aApp.image_path suffix='_200' max_width=75 max_height=75 force_max=true no_link=true}
		{else}		
			{if isset($aPage.image_overwrite)}
				<img src="{$aPage.image_overwrite}" width=75 height=75>
			{else}
				{img user=$aPage suffix='_200' max_width=75 max_height=75 no_link=true is_page_image=true}
			{/if}
		{/if}
	</a>
	<div>		
		<a href="{$aPage.url}" title="{$aPage.title|clean}">{$aPage.title|clean|shorten:20:'...'}</a>
	</div>
</div>
{if is_int($phpfox.iteration.pages/5)}
<div class="clear"></div>
{/if}
{/foreach}
<div class="clear"></div>
{if count($aPage)}
<a href="#" class="pages_profile_view_more" onclick="$('.pages_profile_block').show(); $(this).hide(); return false;">{phrase var='pages.more'}</a>
{/if}