<?php
/**
* [PHPFOX_HEADER]
*/

defined('PHPFOX') or exit('GO MICE!');

/**
*
*
* @copyright	Konsort.org
* @author  		Konsort.org
* @package 		KOBrightcove
*/
?>
<div id="video_list">
{pager}
		<table>
		<th>ID</th>
		<th>Name</th>
		<th>Year</th>
		<th>Make</th>
		<th>Model</th>
		<th>Body Style</th>
		<th>Short Description</th>
		<th>Long Description</th>
		<th>Creation Date</th>
		<th>Tags</th>
		<th>Video Still</th>
		<th>Reference ID</th>
		<th>Year</th>
		<th>Make</th>
		<th>Model</th>
		<th>Bodystyle</th>
		{foreach from=$aVideos key=key item=aValue}
		<tr>
			<td>{$aValue.ko_id}</td>
			<td>{$aValue.name}</td>
			<td>{$aValue.year}</td>
			<td>{$aValue.make}</td>
			<td>{$aValue.model}</td>
			<td>{$aValue.bodyStyle}</td>
			<td>{$aValue.shortDescription}</td>
			<td>{$aValue.longDescription}</td>
			<td>{$aValue.creationDate}</td>
			<td>{$aValue.tags}</td>
			<td><a href="{$aValue.videoStillURL}"><img src="{$aValue.thumbnailURL}" border=0></a></td>	
			<td>{$aValue.referenceId}</td>
			<td>{$aValue.year}</td>
			<td>{$aValue.make}</td>
			<td>{$aValue.model}</td>
			<td>{$aValue.bodyStyle}</td>
		</tr>
		{/foreach}
	</table>
</div>
