<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 22, 2014, 7:11 pm */ ?>
<?php
/**
 * [PHPFOX_HEADER]
 */
defined('PHPFOX') or exit('No direct script access allowed.');

/**
 *
 *
 * @copyright		Konsort.org 
 * @author  		Konsort.org
 * @package 		iDrive
 */

?>
<div class="table" style="display: none;">
	<div class="table_left">
		<label for="user_type"><?php if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif;  echo Phpfox::getPhrase('idrive.user_type'); ?>:</label>
	</div>
	<div class="table_right">
		<select name="val[user_type]" onchange="if ($(this).val() == <?php echo $this->_aVars['iDealerUserGroup']; ?>){$('#dealer_extra_info').show();}else{$('#dealer_extra_info').hide();}">
<?php if (count((array)$this->_aVars['aUserTypes'])):  foreach ((array) $this->_aVars['aUserTypes'] as $this->_aVars['sUserTypeKey'] => $this->_aVars['sUserType']): ?>
				<option value="<?php echo $this->_aVars['sUserTypeKey']; ?>" <?php if ($this->_aVars['sUserTypeKey'] == $this->_aVars['iSalesTeamUserGroup'] && $this->_aVars['salesteam_invite']): ?>selected="selected"<?php elseif ($this->_aVars['sUserTypeKey'] == $this->_aVars['iManagerTeamUserGroup'] && $this->_aVars['managersteam_invite']): ?>selected="selected"<?php elseif ($this->_aVars['sUserType'] == 'Free Trial'): ?>selected="selected"<?php endif; ?>><?php echo $this->_aVars['sUserType']; ?></option>
<?php endforeach; endif; ?>
		</select>
	</div>
</div>

<div id="dealer_extra_info"<?php if ($this->_aVars['salesteam_invite'] || $this->_aVars['managersteam_invite']): ?> style="display:none;"<?php endif; ?>>
	<div class="table">
		<div class="table_left">
			<label for="website_rep"><?php if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif;  echo Phpfox::getPhrase('dvs.website_rep'); ?>:</label>
		</div>
		<div class="table_right">
			<input type="text" name="val[website_rep]" id="website_rep" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['website_rep']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['website_rep']) : (isset($this->_aVars['aForms']['website_rep']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['website_rep']) : '')); ?>
"  />
		</div>			
	</div>

	<div class="table">
		<div class="table_left">
			<label for="contact_name"><?php if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif;  echo Phpfox::getPhrase('dvs.contact_name'); ?>:</label>
		</div>
		<div class="table_right">
			<input type="text" name="val[contact_name]" id="contact_name" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['contact_name']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['contact_name']) : (isset($this->_aVars['aForms']['contact_name']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['contact_name']) : '')); ?>
"  />
		</div>			
	</div>

	<div class="table">
		<div class="table_left">
			<label for="contact_phone"><?php if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif;  echo Phpfox::getPhrase('dvs.contact_phone'); ?>:</label>
		</div>
		<div class="table_right">
			<input type="text" name="val[contact_phone]" id="contact_phone" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['contact_phone']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['contact_phone']) : (isset($this->_aVars['aForms']['contact_phone']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['contact_phone']) : '')); ?>
"  />
		</div>			
	</div>

	<div class="table">
		<div class="table_left">
			<label for="billing_name"><?php if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif;  echo Phpfox::getPhrase('dvs.billing_name'); ?>:</label>
		</div>
		<div class="table_right">
			<input type="text" name="val[billing_name]" id="billing_name" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['billing_name']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['billing_name']) : (isset($this->_aVars['aForms']['billing_name']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['billing_name']) : '')); ?>
"  />
		</div>			
	</div>

	<div class="table">
		<div class="table_left">
			<label for="billing_address_1"><?php if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif;  echo Phpfox::getPhrase('dvs.billing_address_1'); ?>:</label>
		</div>
		<div class="table_right">
			<input type="text" name="val[billing_address_1]" id="billing_address_1" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['billing_address_1']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['billing_address_1']) : (isset($this->_aVars['aForms']['billing_address_1']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['billing_address_1']) : '')); ?>
"  />
		</div>			
	</div>

	<div class="table">
		<div class="table_left">
			<label for="billing_address_2"><?php echo Phpfox::getPhrase('dvs.billing_address_2'); ?>:</label>
		</div>
		<div class="table_right">
			<input type="text" name="val[billing_address_2]" id="billing_address_2" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['billing_address_2']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['billing_address_2']) : (isset($this->_aVars['aForms']['billing_address_2']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['billing_address_2']) : '')); ?>
"  />
		</div>			
	</div>

	<div class="table">
		<div class="table_left">
			<label for="billing_city"><?php if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif;  echo Phpfox::getPhrase('dvs.billing_city'); ?>:</label>
		</div>
		<div class="table_right">
			<input type="text" name="val[billing_city]" id="billing_city" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['billing_city']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['billing_city']) : (isset($this->_aVars['aForms']['billing_city']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['billing_city']) : '')); ?>
"  />
		</div>			
	</div>

	<div class="table">
		<div class="table_left">
			<label for="billing_state"><?php if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif;  echo Phpfox::getPhrase('dvs.billing_state'); ?>:</label>
		</div>
		<div class="table_right">
			<input type="text" name="val[billing_state]" id="billing_state" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['billing_state']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['billing_state']) : (isset($this->_aVars['aForms']['billing_state']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['billing_state']) : '')); ?>
"  />
		</div>			
	</div>

	<div class="table">
		<div class="table_left">
			<label for="billing_zip_code"><?php if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif;  echo Phpfox::getPhrase('dvs.billing_zip_code'); ?>:</label>
		</div>
		<div class="table_right">
			<input type="text" name="val[billing_zip_code]" id="billing_zip_code" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['billing_zip_code']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['billing_zip_code']) : (isset($this->_aVars['aForms']['billing_zip_code']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['billing_zip_code']) : '')); ?>
"  />
		</div>			
	</div>
</div>
