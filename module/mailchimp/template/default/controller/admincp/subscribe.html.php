{if ($aLists == false)}
{$sMessage}
{else}
<div class="table_header">{phrase var='mailchimp.list_filter'}</div>
<div class="table">
    <form action="{url link='admincp.mailchimp.subscribe'}" method="post">
        <div class="table">
            <div class="table_left">
                {phrase var='mailchimp.select_list'}:
            </div>
            <div class="table_right">
                <select name="sListId">
                    {foreach from=$aLists key=iKey item=list}
                    <option {if $list.bIsSelected}selected="selected"{/if} value="{$list.id}">{$list.name}</option>
                    {/foreach}
                </select>
            </div>
            <div class="clear"></div>
        </div>

        <div class="table">
            <div class="table_left">
                {phrase var='mailchimp.select_list_number_item_per_page'}:
            </div>
            <div class="table_right">
                <select name="iPageSize">
                    <option {if ($iPageSize == 50)}selected="selected"{/if} value="50">50</option>
                    <option {if ($iPageSize == 75)}selected="selected"{/if} value="75">75</option>
                    <option {if ($iPageSize == 100)}selected="selected"{/if} value="100">100</option>
                    <option {if ($iPageSize == 150)}selected="selected"{/if} value="150">150</option>
                    <option {if ($iPageSize == 200)}selected="selected"{/if} value="200">200</option>
                </select>
            </div>
            <div class="clear"></div>
        </div>

        <div class="table">
            <div class="table_left">
                {phrase var='mailchimp.select_list_status'}:
            </div>
            <div class="table_right">
                <select name="sStatus">
                    <option {if ($sStatus == "subscribed")}selected="selected"{/if} value="subscribed">{phrase var='mailchimp.subscribed'}</option>
                    <option {if ($sStatus == "unsubscribed")}selected="selected"{/if} value="unsubscribed">{phrase var='mailchimp.unsubscribed'}</option>
                </select>
            </div>
            <div class="clear"></div>
        </div>

        <div class="table_clear">
            <input type="submit" class="button" value="Submit" name="filter">
        </div>
    </form>
    <div class="clear"></div>
</div>
<div class="table_header">
    {phrase var='mailchimp.admin_list_subcribe'} - {phrase var='mailchimp.total'}: {$iTotal}
</div>
{if ($aLists == false || $aSubcribe == false)}
{$sMessage}
{else}
<table>
    <tr>
        <th>{phrase var='mailchimp.subcribe_number'}</th>
        <th>{phrase var='mailchimp.subcribe_email'}</th>
        <th>{phrase var='mailchimp.subcribe_time'}</th>
    </tr>
    {foreach from=$aSubcribe key=iKey item=subcribe}
    <tr class="checkRow{if is_int($iKey/2)} tr{else}{/if}">
        <td>{$subcribe.number}</td>
        <td>{$subcribe.email}</td>
        <td>{$subcribe.timestamp}</td>
    </tr>
    {/foreach}
</table>
<form action="{url link='admincp.mailchimp.compose'}" method="post">
    <select name="sListId" style="display: none;">
        {foreach from=$aLists key=iKey item=list}
        <option {if $list.bIsSelected}selected="selected"{/if} value="{$list.id}">{$list.name}</option>
        {/foreach}
    </select>
</form>
{pager}
{/if}

{/if}