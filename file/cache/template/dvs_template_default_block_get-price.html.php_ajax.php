<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 22, 2014, 3:25 pm */ ?>
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
 * @package 		DVS
 */

?>
<script>
	<?php echo '
	$(\'#contact_dealer\').submit(function(event){

		// cancels the form submission
		event.preventDefault();

		// do whatever you want here
		$.ajaxCall(\'dvs.contactDealer\', $(\'#contact_dealer\').serialize());

	});
	$(\'input, textarea\').placeholder();
'; ?>

</script>
<?php if (! empty ( $this->_aVars['aDvs'] )): ?>
<style>
	input.dvs_form_button {
		background-color: #<?php echo $this->_aVars['aDvs']['button_background']; ?>;
		background-image: -webkit-linear-gradient(top, #<?php echo $this->_aVars['aDvs']['button_top_gradient']; ?>, #<?php echo $this->_aVars['aDvs']['button_bottom_gradient']; ?>);
		background-image: -moz-linear-gradient( center top, #<?php echo $this->_aVars['aDvs']['button_top_gradient']; ?> 5%, #<?php echo $this->_aVars['aDvs']['button_bottom_gradient']; ?> 100% );
		background-image: -ms-linear-gradient(bottom, #<?php echo $this->_aVars['aDvs']['button_top_gradient']; ?> 0%, #<?php echo $this->_aVars['aDvs']['button_bottom_gradient']; ?> 100%);
		background-image: linear-gradient(to bottom, #<?php echo $this->_aVars['aDvs']['button_top_gradient']; ?> 0%, #<?php echo $this->_aVars['aDvs']['button_bottom_gradient']; ?> 100%);
		background-image: -o-linear-gradient(bottom, #<?php echo $this->_aVars['aDvs']['button_top_gradient']; ?> 0%, #<?php echo $this->_aVars['aDvs']['button_bottom_gradient']; ?> 100%);
		filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#<?php echo $this->_aVars['aDvs']['button_top_gradient']; ?>', endColorstr='#<?php echo $this->_aVars['aDvs']['button_bottom_gradient']; ?>');
		border: 1px solid #<?php echo $this->_aVars['aDvs']['button_border']; ?>;
		color: #<?php echo $this->_aVars['aDvs']['button_text']; ?>;
	}
	
	input.dvs_form_button:hover {
		background-image: -webkit-linear-gradient(top, #<?php echo $this->_aVars['aDvs']['button_bottom_gradient']; ?>, #<?php echo $this->_aVars['aDvs']['button_top_gradient']; ?>);
		background-image: -moz-linear-gradient( center top, #<?php echo $this->_aVars['aDvs']['button_bottom_gradient']; ?> 5%, #<?php echo $this->_aVars['aDvs']['button_top_gradient']; ?> 100% );
		background-image: -ms-linear-gradient(bottom, #<?php echo $this->_aVars['aDvs']['button_bottom_gradient']; ?> 0%, #<?php echo $this->_aVars['aDvs']['button_top_gradient']; ?> 100%);
		background-image: linear-gradient(to bottom, #<?php echo $this->_aVars['aDvs']['button_bottom_gradient']; ?> 0%, #<?php echo $this->_aVars['aDvs']['button_top_gradient']; ?> 100%);
		background-image: -o-linear-gradient(bottom, #<?php echo $this->_aVars['aDvs']['button_bottom_gradient']; ?> 0%, #<?php echo $this->_aVars['aDvs']['button_top_gradient']; ?> 100%);
		filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#<?php echo $this->_aVars['aDvs']['button_bottom_gradient']; ?>', endColorstr='#<?php echo $this->_aVars['aDvs']['button_top_gradient']; ?>');
		background-color: #<?php echo $this->_aVars['aDvs']['button_background']; ?>;
		border: 1px solid #<?php echo $this->_aVars['aDvs']['button_border']; ?>;
		color: #<?php echo $this->_aVars['aDvs']['button_text']; ?>;
	}
</style>
<?php endif; ?>

<form id="contact_dealer" name="contact_dealer" action="javascript:void(0);">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>
	<fieldset>
<?php if ($this->_aVars['sBrowser'] == 'mobile'): ?>
		<p>Thank you for your interest in this vehicle!</p>
<?php else: ?>
		<p>Thank you for your interest in the <strong><?php echo $this->_aVars['aVideo']['year']; ?> <?php echo $this->_aVars['aVideo']['make']; ?> <?php echo $this->_aVars['aVideo']['model']; ?></strong>!</p><?php endif; ?>
		<p>We're happy to help you find your next car, go over current specials and offer your our very best price. Please let us know how to reach you and we'll get right back to you:</p>
		<ul>
			<li>
				<input type="text" name="val[contact_name]" id="name" placeholder="<?php echo Phpfox::getPhrase('dvs.get_price_placeholder_name'); ?>" <?php if (Phpfox ::getParam('dvs.get_price_validate_name')): ?> required <?php endif; ?> class="inputContact"/>
			</li>
			<li>
				<input type="email" name="val[contact_email]" id="email" placeholder="<?php echo Phpfox::getPhrase('dvs.get_price_placeholder_email'); ?>" <?php if (Phpfox ::getParam('dvs.get_price_validate_email')): ?> required <?php endif; ?> class="inputContact" />
			</li>
			<li>
				<input type="text" name="val[contact_phone]" id="phone" placeholder="<?php echo Phpfox::getPhrase('dvs.get_price_placeholder_phone'); ?>" <?php if (Phpfox ::getParam('dvs.get_price_validate_phone')): ?> required <?php endif; ?> class="inputContact" />
			</li>
			<li>
				<input type="text" name="val[contact_zip]" id="zip" placeholder="<?php echo Phpfox::getPhrase('dvs.get_price_placeholder_zip'); ?>" <?php if (Phpfox ::getParam('dvs.get_price_validate_zip_code')): ?> required <?php endif; ?> class="inputContact" />
			</li>
			<li>
				<textarea id="comments" name="val[contact_comments]" cols="16" rows="3" placeholder="<?php echo Phpfox::getPhrase('dvs.get_price_placeholder_comments'); ?>" <?php if (Phpfox ::getParam('dvs.get_price_validate_comments')): ?> required <?php endif; ?> class="inputContact"></textarea>
			</li>
		</ul>

		<input type="hidden" name="val[contact_video_ref_id]" id="video_ref_id" value="<?php echo $this->_aVars['aVideo']['referenceId']; ?>"/>
<?php if (! empty ( $this->_aVars['aDvs'] )): ?><input type="hidden" name="val[contact_dvs_id]" id="dvs_id" value="<?php echo $this->_aVars['aDvs']['dvs_id']; ?>"/><?php endif; ?>
	</fieldset>
	<fieldset>
		<input type="submit" value="<?php echo Phpfox::getPhrase('dvs.send'); ?>" class="dvs_form_button" />
	</fieldset>

</form>

<div id="dvs_contact_success" style="display:none;">
<?php echo Phpfox::getPhrase('dvs.contact_request_sent_thank_you'); ?>
</div>
