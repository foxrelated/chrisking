<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 22, 2014, 6:32 pm */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author			Raymond Benc
 * @package 		PhpFox
 * @version 		$Id: email.html.php 4928 2012-10-23 06:12:51Z Raymond_Benc $
 */
 
 

 if ($this->_aVars['bHtml']): ?>	
<?php if ($this->_aVars['bMessageHeader']): ?>
<?php if (isset ( $this->_aVars['sMessageHello'] )): ?>
<?php echo $this->_aVars['sMessageHello']; ?>
<?php else: ?>
<?php echo Phpfox::getPhrase('core.hello'); ?>
<?php endif; ?>,
	<br />
	<br />
<?php endif; ?>
<?php echo $this->_aVars['sMessage']; ?>
	<br />
	<br />
<?php echo $this->_aVars['sEmailSig']; ?>
<?php else: ?>
<?php if ($this->_aVars['bMessageHeader']): ?>
<?php if (isset ( $this->_aVars['sMessageHello'] )): ?>
<?php echo $this->_aVars['sMessageHello']; ?>
<?php else: ?>
<?php echo Phpfox::getPhrase('core.hello'); ?>
<?php endif; ?>,
<?php endif; ?>
<?php echo $this->_aVars['sMessage']; ?>

<?php echo $this->_aVars['sEmailSig']; ?>
<?php endif; ?>
