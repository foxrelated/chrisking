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
		{phrase var='research.popular_videos'}
	</div>
	<div id="popular_videos" style="text-align:center;">
	<div class="main_break"></div>
	{if $aPopularVideos}
		{foreach from=$aPopularVideos key=key item=aValue}
			{if !($key % 2)}
				<a href="{url link='research.view'}{param var='research.video_url_prefix'}_{$aValue.name}">
				{$aValue.year} {$aValue.make} {$aValue.model}
				<br />
				<img src="{$aValue.thumbnailURL}" border=0 />
				<br />
				</a>
			{else}
				<a href="{url link='research.view'}{param var='research.video_url_prefix'}_{$aValue.name}">
				{$aValue.year} {$aValue.make} {$aValue.model}
				<br />
				<img src="{$aValue.thumbnailURL}" border=0 />
				<br />
				</a>
			{/if}
		{/foreach}
	{else}
		{phrase var='research.search_returned_no_results'}
	{/if}
	</div>	
</div>