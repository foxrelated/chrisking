<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 22, 2014, 6:33 pm */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 *
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_User
 * @version 		$Id: setting.html.php 7121 2014-02-18 13:57:28Z Fern $
 */

 

 echo $this->_aVars['sCreateJs']; ?>
<div class="main_break">
	<form method="post" action="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('user.setting'); ?>" id="js_form" onsubmit="<?php echo $this->_aVars['sGetJsForm']; ?>">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>
<?php if (Phpfox ::getUserId() == $this->_aVars['aForms']['user_id'] && Phpfox ::getUserParam('user.can_change_own_full_name')): ?>
		
<?php if (Phpfox ::getParam('user.split_full_name')): ?>
		<div><input type="hidden" name="val[full_name]" id="full_name" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['full_name']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['full_name']) : (isset($this->_aVars['aForms']['full_name']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['full_name']) : '')); ?>
" size="30" /></div>
		<div class="table">
			<div class="table_left">
				<label for="first_name"><?php if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif;  echo Phpfox::getPhrase('user.first_name'); ?>:</label>
			</div>
			<div class="table_right">
				<input type="text" name="val[first_name]" id="first_name" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['first_name']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['first_name']) : (isset($this->_aVars['aForms']['first_name']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['first_name']) : '')); ?>
" size="30" <?php if ($this->_aVars['iTotalFullNameChangesAllowed'] != 0 && $this->_aVars['aForms']['total_full_name_change'] >= $this->_aVars['iTotalFullNameChangesAllowed']): ?>readonly="readonly"<?php endif; ?> />
			</div>			
		</div>		
		<div class="table">
			<div class="table_left">
				<label for="last_name"><?php if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif;  echo Phpfox::getPhrase('user.last_name'); ?>:</label>				
			</div>
			<div class="table_right">
				<input type="text" name="val[last_name]" id="last_name" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['last_name']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['last_name']) : (isset($this->_aVars['aForms']['last_name']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['last_name']) : '')); ?>
" size="30" <?php if ($this->_aVars['iTotalFullNameChangesAllowed'] != 0 && $this->_aVars['aForms']['total_full_name_change'] >= $this->_aVars['iTotalFullNameChangesAllowed']): ?>readonly="readonly"<?php endif; ?> />
			</div>			
		</div>		
		<div class="extra_info">
<?php if ($this->_aVars['iTotalFullNameChangesAllowed'] > 0): ?>
<?php echo Phpfox::getPhrase('user.total_full_name_change_out_of_allowed', array('total_full_name_change' => $this->_aVars['aForms']['total_full_name_change'],'allowed' => $this->_aVars['iTotalFullNameChangesAllowed'])); ?>
<?php endif; ?>
		</div>		
		<div class="separate"></div>
<?php else: ?>
		<div class="table">
			<div class="table_left">
				<label for="full_name"><?php if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif;  echo $this->_aVars['sFullNamePhrase']; ?>:</label>
			</div>
			<div class="table_right">
<?php if ($this->_aVars['iTotalFullNameChangesAllowed'] != 0 && $this->_aVars['aForms']['total_full_name_change'] >= $this->_aVars['iTotalFullNameChangesAllowed']): ?>
				<input type="text" name="val[full_name]" id="full_name" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['full_name']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['full_name']) : (isset($this->_aVars['aForms']['full_name']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['full_name']) : '')); ?>
" size="30" readonly="readonly" />
<?php else: ?>
				<input type="text" name="val[full_name]" id="full_name" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['full_name']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['full_name']) : (isset($this->_aVars['aForms']['full_name']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['full_name']) : '')); ?>
" size="30" />
<?php endif; ?>
				<div class="extra_info">
<?php if ($this->_aVars['iTotalFullNameChangesAllowed'] > 0): ?>
<?php echo Phpfox::getPhrase('user.total_full_name_change_out_of_allowed', array('total_full_name_change' => $this->_aVars['aForms']['total_full_name_change'],'allowed' => $this->_aVars['iTotalFullNameChangesAllowed'])); ?>
<?php endif; ?>
				</div>
			</div>
			<div class="clear"></div>
		</div>
<?php endif; ?>
<?php endif; ?>
<?php if (Phpfox ::getUserParam('user.can_change_own_user_name') && ! Phpfox ::getParam('user.profile_use_id')): ?>
		<div class="table">
			<div class="table_left">
				<label for="user_name"><?php if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif;  echo Phpfox::getPhrase('user.username'); ?>:</label>
			</div>
			<div class="table_right">
<?php if ($this->_aVars['aForms']['total_user_change'] >= $this->_aVars['iTotalChangesAllowed']): ?>
				<input type="text" name="val[user_name]" id="user_name" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['user_name']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['user_name']) : (isset($this->_aVars['aForms']['user_name']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['user_name']) : '')); ?>
" size="30" readonly="readonly" />
<?php else: ?>
				<input type="text" name="val[user_name]" id="user_name" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['user_name']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['user_name']) : (isset($this->_aVars['aForms']['user_name']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['user_name']) : '')); ?>
" size="30" />
<?php endif; ?>
				<div class="extra_info">
<?php echo Phpfox::getPhrase('user.total_user_change_out_of_total_user_name_changes', array('total_user_change' => $this->_aVars['aForms']['total_user_change'],'total' => $this->_aVars['iTotalChangesAllowed'])); ?>
				</div>
				<div><input type="hidden" name="val[old_user_name]" id="user_name" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['user_name']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['user_name']) : (isset($this->_aVars['aForms']['user_name']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['user_name']) : '')); ?>
" size="30" /></div>
			</div>
			<div class="clear"></div>
		</div>
<?php endif; ?>
<?php if (Phpfox ::getUserParam('user.can_change_email')): ?>
		<div class="table">
			<div class="table_left">
				<label for="email"><?php if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif;  echo Phpfox::getPhrase('user.email_address'); ?>:</label>
			</div>
			<div class="table_right">
				<input type="text" <?php if (Phpfox ::getParam('user.verify_email_at_signup')): ?>onfocus="$('#js_email_warning').show();" <?php endif; ?>name="val[email]" id="email" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['email']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['email']) : (isset($this->_aVars['aForms']['email']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['email']) : '')); ?>
" size="30" />
<?php if (Phpfox ::getParam('user.verify_email_at_signup')): ?>
					   <div class="extra_info" style="display:none;" id="js_email_warning">
<?php echo Phpfox::getPhrase('user.changing_your_email_address_requires_you_to_verify_your_new_email'); ?>
				</div>
<?php endif; ?>
			</div>
			<div class="clear"></div>
		</div>
<?php endif; ?>
<?php if (! Phpfox ::getUserBy('fb_user_id')): ?>
			<div class="table">
				<div class="table_left">
					<label for="password"><?php if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif;  echo Phpfox::getPhrase('user.password'); ?>:</label>
				</div>
				<div class="table_right">
					<div id="js_password_info" style="padding-top:2px;"><a href="#" onclick="tb_show('<?php echo Phpfox::getPhrase('user.change_password', array('phpfox_squote' => true)); ?>', $.ajaxBox('user.changePassword', 'height=250&amp;width=500')); return false;"><?php echo Phpfox::getPhrase('user.change_password'); ?></a></div>
				</div>
				<div class="clear"></div>
			</div>
<?php endif; ?>

		<div class="table">
			<div class="table_left">
				<label for="language_id"><?php echo Phpfox::getPhrase('user.primary_language'); ?>:</label>
			</div>
			<div class="table_right">
				<select name="val[language_id]" id="language_id">					
<?php if (count((array)$this->_aVars['aLanguages'])):  foreach ((array) $this->_aVars['aLanguages'] as $this->_aVars['aLanguage']): ?>
					<option value="<?php echo $this->_aVars['aLanguage']['language_id']; ?>"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('language_id') && in_array('language_id', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['language_id'])
								&& $aParams['language_id'] == $this->_aVars['aLanguage']['language_id'])

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['language_id'])
									&& !isset($aParams['language_id'])
									&& $this->_aVars['aForms']['language_id'] == $this->_aVars['aLanguage']['language_id'])
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aLanguage']['title']); ?></option>
<?php endforeach; endif; ?>
				</select>
			</div>
			<div class="clear"></div>
		</div>

		<div class="table" id="tbl_time_zone">
			<div class="table_left">
<?php echo Phpfox::getPhrase('user.time_zone'); ?>:
			</div>
			<div class="table_right">
				<select name="val[time_zone]" id="time_zone">
<?php if (count((array)$this->_aVars['aTimeZones'])):  foreach ((array) $this->_aVars['aTimeZones'] as $this->_aVars['sTimeZoneKey'] => $this->_aVars['sTimeZone']): ?>
					<option value="<?php echo $this->_aVars['sTimeZoneKey']; ?>"<?php if (( empty ( $this->_aVars['aForms']['time_zone'] ) && $this->_aVars['sTimeZoneKey'] == Phpfox ::getParam('core.default_time_zone_offset')) || ( ! empty ( $this->_aVars['aForms']['time_zone'] ) && $this->_aVars['aForms']['time_zone'] == $this->_aVars['sTimeZoneKey'] )): ?> selected="selected"<?php endif; ?>><?php echo $this->_aVars['sTimeZone']; ?></option>
<?php endforeach; endif; ?>
				</select>
<?php if (PHPFOX_USE_DATE_TIME != true && Phpfox ::getParam('core.identify_dst')): ?>
				<div class="extra_info">
					<label><input type="checkbox" name="val[dst_check]" value="1" class="v_middle" <?php if ($this->_aVars['aForms']['dst_check']): ?>checked="checked" <?php endif; ?>/> <?php echo Phpfox::getPhrase('user.enable_dst_daylight_savings_time'); ?></labe>
				</div>
<?php endif; ?>
			</div>
			<div class="clear"></div>
		</div>
		
		
<?php if (Phpfox ::getUserParam('user.can_edit_currency')): ?>
			
		<div class="table">
			<div class="table_left">
<?php echo Phpfox::getPhrase('user.preferred_currency'); ?>:
			</div>
			<div class="table_right">		
				<select name="val[default_currency]">
					<option value=""><?php echo Phpfox::getPhrase('user.select'); ?>:</option>
<?php if (count((array)$this->_aVars['aCurrencies'])):  foreach ((array) $this->_aVars['aCurrencies'] as $this->_aVars['sCurrency'] => $this->_aVars['aCurrency']): ?>
					<option value="<?php echo $this->_aVars['sCurrency']; ?>"<?php if ($this->_aVars['aForms']['default_currency'] == $this->_aVars['sCurrency']): ?> selected="selected"<?php endif; ?>><?php echo Phpfox::getPhrase($this->_aVars['aCurrency']['name']); ?></option>
<?php endforeach; endif; ?>
				</select>
				<div class="extra_info">
<?php echo Phpfox::getPhrase('user.show_prices_and_make_purchases_in_this_currency'); ?>
				</div>				
			</div>
			<div class="clear"></div>
		</div>
<?php endif; ?>

<?php (($sPlugin = Phpfox_Plugin::get('user.template_controller_setting')) ? eval($sPlugin) : false); ?>
		
		<div class="table_clear">
			<input type="submit" value="<?php echo Phpfox::getPhrase('user.save'); ?>" class="button" />
		</div>

<?php if (Phpfox ::getParam('core.display_required')): ?>
			<div class="table_clear">
<?php if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif; ?> <?php echo Phpfox::getPhrase('core.required_fields'); ?>
			</div>
<?php endif; ?>
		
<?php if (isset ( $this->_aVars['aGateways'] ) && is_array ( $this->_aVars['aGateways'] ) && count ( $this->_aVars['aGateways'] )): ?>
		<h3><?php echo Phpfox::getPhrase('user.payment_methods'); ?></h3>
<?php if (count((array)$this->_aVars['aGateways'])):  foreach ((array) $this->_aVars['aGateways'] as $this->_aVars['aGateway']): ?>
<?php if (count((array)$this->_aVars['aGateway']['custom'])):  foreach ((array) $this->_aVars['aGateway']['custom'] as $this->_aVars['sFormField'] => $this->_aVars['aCustom']): ?>
			<div class="table">
				<div class="table_left">
<?php echo $this->_aVars['aCustom']['phrase']; ?>:
				</div>
				<div class="table_right">
<?php if (( isset ( $this->_aVars['aCustom']['type'] ) && $this->_aVars['aCustom']['type'] == 'textarea' )): ?>
						<textarea name="val[gateway_detail][<?php echo $this->_aVars['aGateway']['gateway_id']; ?>][<?php echo $this->_aVars['sFormField']; ?>]" cols="50" rows="8"><?php if (isset ( $this->_aVars['aCustom']['user_value'] )):  echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aCustom']['user_value']);  endif; ?></textarea>
<?php else: ?>
						<input type="text" name="val[gateway_detail][<?php echo $this->_aVars['aGateway']['gateway_id']; ?>][<?php echo $this->_aVars['sFormField']; ?>]" value="<?php if (isset ( $this->_aVars['aCustom']['user_value'] )):  echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aCustom']['user_value']);  endif; ?>" size="40" />
<?php endif; ?>
<?php if (! empty ( $this->_aVars['aCustom']['phrase_info'] )): ?>
					<div class="extra_info">
<?php echo $this->_aVars['aCustom']['phrase_info']; ?>
					</div>
<?php endif; ?>
				</div>
				<div class="clear"></div>
			</div>			
<?php endforeach; endif; ?>
<?php if (isset ( $this->_aVars['aGateway']['custom'] ) && is_array ( $this->_aVars['aGateway']['custom'] ) && count ( $this->_aVars['aGateway']['custom'] )): ?><div class="separate"></div><?php endif; ?>
<?php endforeach; endif; ?>

		<div class="table_clear">
			<input type="submit" value="<?php echo Phpfox::getPhrase('user.save'); ?>" class="button" />
		</div>
<?php endif; ?>
<?php if (( Phpfox ::getUserParam('user.can_delete_own_account'))): ?>
		<br />
		<br />
		<br />
		<br />
		<div class="p_top_8">
			<a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('user.remove'); ?>"><?php echo Phpfox::getPhrase('user.cancel_account'); ?></a>
		</div>
<?php endif; ?>
	
</form>

</div>

