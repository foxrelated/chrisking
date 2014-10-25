<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 24, 2014, 1:20 pm */ ?>
<?php
/**
 * [PHPFOX_HEADER]
 */



/**
 * Display the image details when viewing an image.
 *
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Miguel Espinoza
 * @package  		Module_User
 * @version 		$Id: detail.class.php 254 2009-02-23 12:36:20Z Miguel_Espinoza $
 */

 if (isset ( $this->_aVars['sTime'] )): ?>
	<div>
<?php echo Phpfox::getPhrase('user.the_link_that_brought_you_here_is_not_valid_it_may_already_have_expired', array('time' => $this->_aVars['sTime'])); ?>
	</div>
<?php endif; ?>

<?php if (! isset ( $this->_aVars['sTime'] )): ?>
	<div>
<?php echo Phpfox::getPhrase('user.this_site_is_very_concerned_about_security'); ?>
	</div>
	<div>
		<input type="button" value="<?php echo Phpfox::getPhrase('user.resend_verification_email'); ?>" class="button" onclick="$.ajaxCall('user.verifySendEmail', 'iUser=<?php echo $this->_aVars['iVerifyUserId']; ?>'); return false;" />
	</div>
<?php endif; ?>
