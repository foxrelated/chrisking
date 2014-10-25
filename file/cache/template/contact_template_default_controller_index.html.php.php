<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 21, 2014, 8:58 pm */ ?>
<?php
/**
 * [PHPFOX_HEADER]
 *
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Miguel Espinoza
 * @package  		Module_Contact
 * @version 		$Id: index.html.php 1870 2010-09-28 15:09:21Z Miguel_Espinoza $
 */



 echo $this->_aVars['sCreateJs']; ?>
<div class="main_break">
	<form method="post" action="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('contact'); ?>" id="js_contact_form" onsubmit="<?php echo $this->_aVars['sGetJsForm']; ?>">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>
		<div class="table">
			<div class="table_left">
				<label for="category_id"><?php if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif;  echo Phpfox::getPhrase('contact.category'); ?>:</label>
			</div>
			<div class="table_right">
				<select name="val[category_id]" id="category_id">
				<option value=""><?php echo Phpfox::getPhrase('contact.select'); ?>:</option>
<?php if (count((array)$this->_aVars['aCategories'])):  foreach ((array) $this->_aVars['aCategories'] as $this->_aVars['sCategory']): ?>
					<option value="<?php echo $this->_aVars['sCategory']['title']; ?>"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('category_id') && in_array('category_id', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['category_id'])
								&& $aParams['category_id'] == $this->_aVars['sCategory']['title'])

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['category_id'])
									&& !isset($aParams['category_id'])
									&& $this->_aVars['aForms']['category_id'] == $this->_aVars['sCategory']['title'])
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo Phpfox::getLib('phpfox.parse.output')->clean(Phpfox::getLib('locale')->convert($this->_aVars['sCategory']['title'])); ?></option>
<?php endforeach; else: ?>
					<option value="#"><?php echo Phpfox::getPhrase('contact.currently_unavailable'); ?></option>
<?php endif; ?>

				</select>
			</div>
			<div class="clear"></div>
		</div>
<?php if (Phpfox ::isUser()): ?>
			<div><input type="hidden" name="val[full_name]" id="full_name" value="<?php echo $this->_aVars['sFullName']; ?>" size="30" /></div>
<?php else: ?>
		<div class="table">
			<div class="table_left">
				<label for="full_name"><?php if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif;  echo Phpfox::getPhrase('contact.full_name'); ?>:</label>
			</div>
			<div class="table_right">
				<input type="text" name="val[full_name]" id="full_name" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['full_name']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['full_name']) : (isset($this->_aVars['aForms']['full_name']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['full_name']) : '')); ?>
" size="30" />
			</div>
			<div class="clear"></div>
		</div>
<?php endif; ?>

		<div class="table">
			<div class="table_left">
				<label for="subject"><?php if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif;  echo Phpfox::getPhrase('contact.subject'); ?>:</label>
			</div>
			<div class="table_right">
				<input type="text" name="val[subject]" id="subject" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['subject']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['subject']) : (isset($this->_aVars['aForms']['subject']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['subject']) : '')); ?>
" size="30" />
			</div>
			<div class="clear"></div>
		</div>
<?php if (Phpfox ::isUser()): ?>
			<div><input type="hidden" name="val[email]" id="email" value="<?php echo $this->_aVars['sEmail']; ?>" size="30" /></div>
<?php else: ?>
		<div class="table">
			<div class="table_left">
				<label for="email"><?php if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif;  echo Phpfox::getPhrase('contact.email'); ?>:</label>
			</div>
			<div class="table_right">
				<input type="text" name="val[email]" id="email" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['email']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['email']) : (isset($this->_aVars['aForms']['email']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['email']) : '')); ?>
" size="30" />
			</div>
			<div class="clear"></div>
		</div>
<?php endif; ?>

		<div class="table">
			<div class="table_left">
				<label for="message"><?php if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif;  echo Phpfox::getPhrase('contact.message'); ?>:</label>
			</div>
			<div class="table_right">
				<textarea cols="60" rows="10" name="val[text]"><?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['text']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['text']) : (isset($this->_aVars['aForms']['text']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['text']) : '')); ?>
</textarea>
			</div>
			<div class="clear"></div>
		</div>
		
		<div class="table">
			<div class="table_left">
<?php echo Phpfox::getPhrase('contact.send_yourself_a_copy'); ?>
			</div>
			<div class="table_right">
				<input type="checkbox" name="val[copy]" value="1"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('copy') && in_array('copy', $this->_aVars['aForms']))
							
{
								echo ' checked="checked" ';
							}

							if (isset($aParams['copy'])
								&& $aParams['copy'] == '1')

							{

								echo ' checked="checked" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['copy'])
									&& !isset($aParams['copy'])
									&& $this->_aVars['aForms']['copy'] == '1')
								{
								 echo ' checked="checked" ';
								}
								else
								{
									echo "";
								}
							}
							?>
/>
			</div>
			<div class="clear"></div>
		</div>				

<?php if (Phpfox ::isModule('captcha') && Phpfox ::getParam('contact.contact_enable_captcha')): ?>
<?php Phpfox::getBlock('captcha.form', array('sType' => 'contact')); ?>
<?php endif; ?>

		<div class="table_clear">
			<input type="submit" value="<?php echo Phpfox::getPhrase('contact.submit'); ?>" class="button" />
			<div class="t_right"><span id="js_comment_process"></span></div>
		</div>
	
</form>

<?php if (Phpfox ::getParam('core.display_required')): ?>
	<div class="table_clear">
<?php if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif; ?> <?php echo Phpfox::getPhrase('core.required_fields'); ?>
	</div>
<?php endif; ?>
</div>
