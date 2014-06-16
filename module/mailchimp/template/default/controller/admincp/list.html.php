<div class="table_header">
    {phrase var='mailchimp.mailchimp_list'}
</div>
{if $tab ne 'edit'}
<form method="post" action="{url link='admincp.mailchimp.list'}">
    <table>
        <tr>
            <th>{phrase var='mailchimp.mailchimp_list'}</th>
            <th>{phrase var='mailchimp.description'}</th>
            <th>{phrase var='mailchimp.subscribe'}</th>
            <th>{phrase var='mailchimp.group_name'}</th>
            <th>{phrase var='mailchimp.edit'}</th>
        </tr>
        {foreach from=$aMailChimpLists key=iKey item=aItem}
        <tr id="js_row{$aItem.id}" class="checkRow{if is_int($iKey/2)} tr{else}{/if}">
            <td id="js_blog_edit_title{$aItem.id}">{$aItem.name}</td>
            <td id="js_blog_edit_title{$aItem.id}">{$aItem.description}</td>
            <td>
                {if $aItem.enabled}
                {phrase var='core.yes'}
                {else}
                {phrase var='core.no'}
                {/if}
            </td>
            <td>{$aItem.groups_name}</td>
            <td><a href="{url link='admincp.mailchimp.list.tab_edit'}id_{$aItem.id}">{phrase var='mailchimp.edit'}</a></td>
        </tr>
        {/foreach}
    </table>
    <div class="table_clear">
        <input type="submit" value="{phrase var='mailchimp.refresh'}" class="button" name="_refresh"/>
    </div>
</form>
{/if}

{if $tab eq 'edit'}
<form method="post">
    <div class="table_header">
        {phrase var='mailchimp.admin_cp_field_desc'}
    </div>
    <table>
        <tr>
            <th>{phrase var='mailchimp.mailchimp_field_label'}</th>
            <th>{phrase var='mailchimp.mailchimp_field_tag'}</th>
            <th>{phrase var='mailchimp.mailchimp_field_require'}</th>
            <th>{phrase var='mailchimp.phpfox_user_field'}</th>
        </tr>
        {foreach from=$aMailChimpFields key=iKey item=aField}
        {if $aField.tag != 'EMAIL'}
        <tr id="js_row{$iKey}" class="checkRow{if is_int($iKey/2)} tr{else}{/if}">
            <td>{$aField.name}</td>
            <td>{$aField.tag}</td>
            <td>{if $aField.req}{phrase var='core.yes'}{else}{phrase var='core.no'}{/if}</td>
            <td>{$aField.select_html}</td>
        </tr>
        {/if}
        {/foreach}
    </table>
    <div class="table_header">
        {phrase var='mailchimp.admin_cp_group_desc'}
    </div>
    <table>
        <tr>
            <th width="20">
                <input type="checkbox" value="" onchange="{literal}var checked=this.checked;$('.checkselect').each(function(a,b){b.checked=checked;}){/literal}"/>
            </th>
            <th>{phrase var='mailchimp.user_group_name'}</th>
            <th>{phrase var='mailchimp.user_group_type'}</th>
            <th>{phrase var='mailchimp.user_count'}</th>
        </tr>
        {foreach from=$aUserGroups key=iKey item=aItem}
        <tr id="js_row{$aItem.user_group_id}" class="checkRow{if is_int($iKey/2)} tr{else}{/if}">
            <td>
                <input {if $aItem.checked}checked="checked"{/if} type="checkbox" class="checkselect" name="val[groups][]" value="{$aItem.user_group_id}" />
            </td>
            <td>{$aItem.title}</td>
            <td>{if $aItem.inherit_id eq 0}{phrase var='mailchimp.user_default_group'}{else}{phrase var='mailchimp.user_custom_group'}{/if}</td>
            <td>{$aItem.user_count}</td>
        </tr>
        {/foreach}
    </table>

    <div class="table_header">
        {phrase var='mailchimp.admin_cp_subscribe_desc'}
    </div>
    <div class="table3">
        <div class="row_left">{phrase var='mailchimp.admin_cp_subscribe_label'}
        </div>
        <div class="row_right" style="margin-bottom:20px;">
            <select name="val[enabled]">
                {if $bEnabled}
                <option value="1" selected="selected">{phrase var='admincp.true'}</option>
                <option value="0">{phrase var='admincp.false'}</option>
                {else}
                <option value="1" >{phrase var='admincp.true'}</option>
                <option value="0" selected="selected">{phrase var='admincp.false'}</option>
                {/if}
            </select>
        </div>
        <div class="clear"></div>
    </div>

    <div class="table3">
        <div class="row_left">
            {phrase var='mailchimp.send_confirm_email'}
        </div>
        <div class="row_right" style="margin-bottom:20px;">
            <select name="val[confirm]">
                {if $bConfirm}
                <option value="1" selected="selected">{phrase var='admincp.true'}</option>
                <option value="0">{phrase var='admincp.false'}</option>
                {else}
                <option value="1" >{phrase var='admincp.true'}</option>
                <option value="0" selected="selected">{phrase var='admincp.false'}</option>
                {/if}
            </select>
        </div>
        <div class="clear"></div>
    </div>

    <div class="table3">
        <div class="row_left">{phrase var='mailchimp.description'}
        </div>
        <div class="row_right" style="margin-bottom:20px;">
            <textarea cols="60" rows="8" name="val[description]">{$sDescription}</textarea>
        </div>
        <div class="clear"></div>
    </div>

    <div class="table_clear">
        <input type="button" value="{phrase var='mailchimp.cancel'}" class="button" name="_cancel" onclick="window.location.href='{url link='admincp.mailchimp.settings'}'"/>
        {* <input type="button" value="{phrase var='mailchimp.overview'}" class="button" name="_overview" onclick="tb_show(oTranslations['mailchimp.overview'], $.ajaxBox('mailchimp.overview', 'height=240&width=600&sListId={$sListId}')); return false;" /> *}
        <input type="submit" value="{phrase var='mailchimp.submit'}" class="button" name="_submit"/>
    </div>
</form>
{/if}
