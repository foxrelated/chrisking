<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 22, 2014, 9:33 am */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_User
 * @version 		$Id: request.html.php 1245 2009-11-02 16:10:29Z Raymond_Benc $
 */
 
 

?>
<div class="main_break">
	<form method="post" action="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('user.password.request'); ?>">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>
		<div class="table">
			<div class="table_left">
				<label for="email"><?php echo Phpfox::getPhrase('user.email'); ?></label>:
			</div>
			<div class="table_right">
				<input type="text" name="email" id="email" value="" size="40" />
			</div>
			<div class="clear"></div>
		</div>
<?php if (Phpfox ::isModule('captcha')):  Phpfox::getBlock('captcha.form', array('sType' => 'lostpassword'));  endif; ?>
		<div class="table_clear">
			<input type="submit" value="<?php echo Phpfox::getPhrase('user.request_new_password'); ?>" class="button" />
		</div>	
	
</form>

</div>
