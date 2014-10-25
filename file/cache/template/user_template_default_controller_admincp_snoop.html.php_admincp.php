<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 22, 2014, 6:47 pm */ ?>
<?php
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_User
 * @version 		$Id: browse.html.php 2137 2010-11-15 13:37:06Z Raymond_Benc $
 * 
 */

?>
<div class="warning">
<?php echo Phpfox::getPhrase('user.member_snoop_text', array('user_name' => $this->_aVars['user_name'],'full_name' => $this->_aVars['full_name'],'user_link' => $this->_aVars['user_link'])); ?>
	<br /><br />
	<form action="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('admincp.user.snoop', array('user' => $this->_aVars['aUser']['user_id'])); ?>" method="post">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>
		<input type="hidden" name="action" value="proceed">
		<a class="button linkAway" href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('admincp'); ?>"><?php echo Phpfox::getPhrase('user.abort_log_in_as_this_user'); ?> </a>
		- <input type="submit" class="btnSubmit button" value="<?php echo Phpfox::getPhrase('user.log'); ?>">
	
</form>

</div>

