<?php
/**
 * [PHPFOX_HEADER]
 */
defined('PHPFOX') or exit('No direct script access allowed.');

/**
 *
 *
 * @copyright		PhpfoxPlus.com
 * @author  		PhpfoxPlus.com
 * @package 		DVS
 */

?>
<br>
<div id="sales_team_members">
    <table class="dvs_sales_team_table">
        <tr>
            <th>
                Manager
            </th>
            <th>
                Action
            </th>
        </tr>
        {foreach from=$aManagersteam key=iKey item=aTeamMember}
        <tr id="managers_team_member_{$aTeamMember.managersteam_id}">
            <td>
                {$aTeamMember|user}
            </td>
            <td>
                <a href="#" onclick="$.ajaxCall('dvs.removeManagerTeamMember', 'managersteam_id={$aTeamMember.managersteam_id}');">{phrase var='dvs.remove'}</a>
            </td>
        </tr>
        {/foreach}
    </table>
</div>

{if Phpfox::isAdmin()}
<h3>Add Existing User {*phrase var='dvs.add_new_team_member'*}</h3>
<form method="post" action="{url link='current'}" id="add_sales_team_member" name="add_sales_team_member">
    <table class="dvs_add_table">
        <tr>
            <td class="dvs_add_td" style="width:auto;">
                {phrase var='dvs.member_name'}:
            </td>
            <td class="dvs_add_td" style="width:auto;">
                <select name="val[user_id]" id="user_id">
                    <option value="">Select a user {*phrase var='dvs.select_a_member'*}</option>
                    {foreach from=$aUsers item=aUser}
                    <option value="{$aUser.user_id}">{$aUser.full_name} ({$aUser.email})</option>
                    {/foreach}
                </select>

            </td>
        </tr>
    </table>
    <i>Note: This is an admin-only tool to add existing DVS users.</i>
    <div id="dvs_settings_save_button_container">
        <input type="submit" value="Add User" class="button" />
    </div>
</form>
{/if}

<br>
<h3>Add Manager by Email</h3>
<form method="post" action="{url link='current'}" id="invite_sales_team_member" name="invite_sales_team_member">
    <table class="dvs_add_table">
        <tr>
            <td class="dvs_add_td" style="width:auto;">
                {phrase var='dvs.email_address'}:
            </td>
            <td class="dvs_add_td">
                <input type="text" name="val[email]" size="30" />
            </td>
        </tr>
    </table>

    <div id="dvs_settings_save_button_container">
        <input type="submit" value="Invite User" class="button" />
    </div>
</form>
<br>