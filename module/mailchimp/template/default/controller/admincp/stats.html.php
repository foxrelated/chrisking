<?php
/**
 * [PHPFOX_HEADER]
 *
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Blog
 * @version 		$Id: index.html.php 3072 2011-09-12 13:23:50Z Raymond_Benc $
 */
defined('PHPFOX') or exit('NO DICE!');
?>
<div class="table_header">
    {phrase var='mailchimp.statistic_number_of_subscribe_unsubscribe'}
</div>

<form method="post" action="{url link='admincp.mailchimp.stats'}">
    {if count($aLists)}
    <table>
        <tr>
            <th>{phrase var='mailchimp.list_id'}</th>
            <th>{phrase var='mailchimp.name'}</th>
            <th>{phrase var='mailchimp.subscribe'}</th>
            <th>{phrase var='mailchimp.unsubscribe'}</th>

        </tr>
        {foreach from=$aLists key=iKey item=aList}
        <tr id="js_row{$aList.id}" class="checkRow{if is_int($iKey/2)} tr{else}{/if}">
            <td>{$aList.id}</td>
            <td>{$aList.name}</td>
            <td>{$aList.stats.member_count}</td>
            <td>{$aList.stats.unsubscribe_count}</td>

        </tr>
        {/foreach}
    </table>
    {else}
    <div class="p_4">
        {phrase var='mailchimp.no_list_has_been_created'}
    </div>
    {/if}
</form>