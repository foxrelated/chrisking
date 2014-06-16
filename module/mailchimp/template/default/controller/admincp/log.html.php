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
<form method="post" action="{url link='admincp.mailchimp.log'}">
    <div class="table_header">
        {phrase var='mailchimp.search_filter'}
    </div>
    <div class="table">
        <div class="table_left">
            {phrase var='mailchimp.search_for_description'}
        </div>
        <div class="table_right">
            {$aFilters.description}
        </div>
        <div class="clear"></div>
    </div>
    <div class="table">
        <div class="table_left">
            {phrase var='mailchimp.limit_per_page'}
        </div>
        <div class="table_right">
            {$aFilters.display}
        </div>
        <div class="clear"></div>
    </div>
    <div class="table">
        <div class="table_left">
            {phrase var='mailchimp.sort'}
        </div>
        <div class="table_right">
            {$aFilters.sort} {$aFilters.sort_by}
        </div>
        <div class="clear"></div>
    </div>
    <div class="table_clear">
        <input type="submit" name="search[submit]" value="{phrase var='core.submit'}" class="button" />
        <input type="submit" name="search[reset]" value="{phrase var='core.reset'}" class="button" />
    </div>
</form>
{pager}

<form method="post" action="{url link='admincp.mailchimp.log'}">
    {if count($aLogs)}
    <table>
        <tr>
            <th>{phrase var='mailchimp.mailchimplog_id'}</th>
            <th>{phrase var='mailchimp.description'}</th>
            <th>{phrase var='mailchimp.created_at'}</th>
        </tr>
        {foreach from=$aLogs key=iKey item=aLog}
        <tr id="js_row{$aLog.mailchimplog_id}" class="checkRow{if is_int($iKey/2)} tr{else}{/if}">
            <td>{$aLog.mailchimplog_id}</td>
            <td>{$aLog.description|convert|clean|shorten:1000}</td>
            <td>{$aLog.created_at|date:'core.footer_watch_time_stamp'}</td>
        </tr>
        {/foreach}
    </table>
    <div class="table_bottom">
        <input onclick="if (!confirm(oTranslations['mailchimp.are_you_sure'])) return false;" type="submit" name="delete" value="{phrase var='mailchimp.delete_all'}" class="button"/>
    </div>
    {else}
    <div class="p_4">
        {phrase var='mailchimp.no_mailchimp_log_has_been_created'}
    </div>
    {/if}
</form>

{pager}