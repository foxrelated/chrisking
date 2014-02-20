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
<div id="search_results" style="width: 528px; margin-left:40px">
	{if $aVideos}
		{pager}
		{foreach from=$aVideos key=key item=aValue}
			<div class="info">
				<div class="info_left" style="width: 120px; margin-left:40px">
					<a href="{url link='research.view'}{param var='research.video_url_prefix'}_{$aValue.name}"><img src="{$aValue.thumbnailURL}" border=0></a>
				</div>
				<div class="info_right" style="width: 428px">
					<b>{$aValue.name}</b>
					<br />
					{$aValue.shortDescription}
					<br />
					<b>{phrase var='research.tags'} {if $aValue.year}<a href="{url link='research.search'}year_{$aValue.year}">{$aValue.year}</a>, {/if}{if $aValue.make}<a href="{url link='research.search'}make_{$aValue.make}">{$aValue.make}</a>, {/if}{if $aValue.model}<a href="{url link='research.search'}model_{$aValue.model}">{$aValue.model}</a>, {/if}{if $aValue.bodyStyle}<a href="{url link='research.search'}bodyStyle_{$aValue.bodyStyle}">{$aValue.bodyStyle}</a>{/if}</b>
					<br />
					<b><a href="{url link='research.view'}{param var='research.video_url_prefix'}_{$aValue.name}">Watch {$aValue.name}</a><br />{phrase var='research.get_a_price'} | {phrase var='research.search_local_listings'} | {phrase var='research.user_reviews'}</b>
				</div>
			</div>
			<br />
			<br />
		{/foreach}
	{else}
		{phrase var='research.search_returned_no_results'}
	{/if}
</div>