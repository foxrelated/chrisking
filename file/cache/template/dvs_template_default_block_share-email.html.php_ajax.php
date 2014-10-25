<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 22, 2014, 2:54 pm */ ?>
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
	$(\'#share_email_dealer\').submit(function(event) {
		// cancels the form submission
		event.preventDefault();

		// do whatever you want here
		$.ajaxCall(\'dvs.sendShareEmail\', $(\'#share_email_dealer\').serialize());
		//$.ajaxCall(\'dvs.generateShortUrl\', \'dvs_id={$aDvs.dvs_id}&video_ref_id={$aVideo.referenceId}&service=email&return_id=share_link_box\');
        '; ?>

<?php if ($this->_aVars['bSaveGa'] == 1): ?>
        shareEmailSent();
<?php endif; ?>
        <?php echo '
	});

	if( $.isFunction( $(\'input, textarea\').placeholder ) ) {
		$(\'input, textarea\').placeholder();
	}
	'; ?>

</script>

<style type="text/css">
	<?php echo '
	#dvs_share_email_container {
		text-align: center;
	}

	#share_email_dealer {
		text-align: center;
	}

	#share_email_dealer li {
		text-align: center;
	}

	.inputShare {
		width: 225px;
		font-size: 16px;
		padding: 4px;
		margin-bottom: 4px;
		font-family: Arial;
	}

	#share_email_dealer textarea {
		width: 225px;
		font-size: 16px;
		padding: 4px;
		margin-bottom: 10px;
		font-family: Arial;
	}

	.dvs_form_button {
		padding: 5px 25px;
		border-radius: 5px;
	}
	'; ?>


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
	cursor:pointer;
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
	cursor:pointer;
	}
</style>

<form id="share_email_dealer" name="share_email_dealer">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>

	<fieldset>
		<ul>
			<li>
				<input type="text" name="val[my_share_name]" id="my_share_name" placeholder="<?php echo Phpfox::getPhrase('dvs.your_name'); ?>" value="<?php echo $this->_aVars['your_name']; ?>" required class="inputShare"/>
			</li>
		</ul>
        <ul>
            <li>
                <input type="text" name="val[my_share_email]" id="my_share_email" placeholder="<?php echo Phpfox::getPhrase('dvs.your_email'); ?>" value="<?php echo $this->_aVars['your_email']; ?>" required class="inputShare"/>
            </li>
        </ul>
        <ul>
			<li>
				<input type="text" name="val[share_name]" id="share_name" placeholder="<?php echo Phpfox::getPhrase('dvs.friends_name'); ?>" class="inputShare" required />
			</li>
		</ul>
		<ul>
			<li>
				<input type="email" name="val[share_email]" id="share_email" placeholder="<?php echo Phpfox::getPhrase('dvs.friends_email_address'); ?>" required class="inputShare"/>
			</li>
		</ul>
		
		<ul>
			<li>
				<textarea id="share_message" name="val[share_message]" placeholder="<?php echo Phpfox::getPhrase('dvs.message_to_friend'); ?>" cols="18" rows="5"></textarea>
			</li>
		</ul>
		<input type="hidden" name="val[video_ref_id]" id="video_ref_id" value="<?php echo $this->_aVars['aVideo']['referenceId']; ?>"/>
		<input type="hidden" name="val[dvs_id]" id="dvs_id" value="<?php echo $this->_aVars['aDvs']['dvs_id']; ?>"/>
		<input type="hidden" name="val[longurl]" id="longurl" value="<?php echo $this->_aVars['bLongUrl']; ?>" />
	</fieldset>
	<fieldset>
		<input type="submit" value="<?php echo Phpfox::getPhrase('dvs.send'); ?>" class="dvs_form_button"/>
	</fieldset>

</form>

<div id="dvs_share_email_success" style="display:none;">
<?php echo Phpfox::getPhrase('dvs.email_has_been_sent'); ?>
</div>

