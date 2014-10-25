<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 22, 2014, 6:32 pm */ ?>
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
<?php if (count((array)$this->_aVars['aManagersteam'])):  foreach ((array) $this->_aVars['aManagersteam'] as $this->_aVars['iKey'] => $this->_aVars['aTeamMember']): ?>
        <tr id="managers_team_member_<?php echo $this->_aVars['aTeamMember']['managersteam_id']; ?>">
            <td>
<?php echo '<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aTeamMember']['user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aTeamMember']['user_name'], ((empty($this->_aVars['aTeamMember']['user_name']) && isset($this->_aVars['aTeamMember']['profile_page_id'])) ? $this->_aVars['aTeamMember']['profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getService('user')->getCurrentName($this->_aVars['aTeamMember']['user_id'], $this->_aVars['aTeamMember']['full_name']), Phpfox::getParam('user.maximum_length_for_full_name')) . '</a></span>'; ?>
            </td>
            <td>
                <a href="#" onclick="$.ajaxCall('dvs.removeManagerTeamMember', 'managersteam_id=<?php echo $this->_aVars['aTeamMember']['managersteam_id']; ?>');"><?php echo Phpfox::getPhrase('dvs.remove'); ?></a>
            </td>
        </tr>
<?php endforeach; endif; ?>
    </table>
</div>

<?php if (Phpfox ::isAdmin()): ?>
<h3>Add Existing User </h3>
<form method="post" action="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('current'); ?>" id="add_sales_team_member" name="add_sales_team_member">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>
    <table class="dvs_add_table">
        <tr>
            <td class="dvs_add_td" style="width:auto;">
<?php echo Phpfox::getPhrase('dvs.member_name'); ?>:
            </td>
            <td class="dvs_add_td" style="width:auto;">
                <select name="val[user_id]" id="user_id">
                    <option value="">Select a user </option>
<?php if (count((array)$this->_aVars['aUsers'])):  foreach ((array) $this->_aVars['aUsers'] as $this->_aVars['aUser']): ?>
                    <option value="<?php echo $this->_aVars['aUser']['user_id']; ?>"><?php echo $this->_aVars['aUser']['full_name']; ?> (<?php echo $this->_aVars['aUser']['email']; ?>)</option>
<?php endforeach; endif; ?>
                </select>

            </td>
        </tr>
    </table>
    <i>Note: This is an admin-only tool to add existing DVS users.</i>
    <div id="dvs_settings_save_button_container">
        <input type="submit" value="Add User" class="button" />
    </div>

</form>

<?php endif; ?>

<br>
<h3>Add Manager by Email</h3>
<form method="post" action="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('current'); ?>" id="invite_sales_team_member" name="invite_sales_team_member">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>
    <table class="dvs_add_table">
        <tr>
            <td class="dvs_add_td" style="width:auto;">
<?php echo Phpfox::getPhrase('dvs.email_address'); ?>:
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
