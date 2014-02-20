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
<div id="stats">
	<table>
		<th>{phrase var='dvs.user'}</th>
		<th>{phrase var='dvs.dealer'}</th>
		<th>{phrase var='dvs.dvs'}</th>
		<th>{phrase var='dvs.total_emails_sent'}</th>
		{foreach from=$aStats item=aStat}
			<tr id="stat_{$aStat.dvs_id}">
				<td>{$aStat|user}</td>
				<td>{$aStat.dealer_name}</td>	
				<td><a href="{url link='dvs'}{$aStat.title_url}" target="_blank">{$aStat.dvs_name}</a></td>
				<td>{$aStat.total_emails_sent}</td>
			</tr>
		{/foreach}
	</table>
</div>