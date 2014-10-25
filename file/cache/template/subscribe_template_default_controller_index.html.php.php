<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 22, 2014, 7:20 pm */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: index.html.php 1321 2009-12-15 18:19:30Z Raymond_Benc $
 */
 
 

 if (Phpfox ::getParam('subscribe.enable_subscription_packages')):  if (count ( $this->_aVars['aPackages'] )):  if (count((array)$this->_aVars['aPackages'])):  $this->_aPhpfoxVars['iteration']['packages'] = 0;  foreach ((array) $this->_aVars['aPackages'] as $this->_aVars['aPackage']):  $this->_aPhpfoxVars['iteration']['packages']++; ?>

	<?php
						Phpfox::getLib('template')->getBuiltFile('subscribe.block.entry-package');						
						 endforeach; endif;  else: ?>
<div class="extra_info">
<?php echo Phpfox::getPhrase('subscribe.no_packages_available'); ?>
</div>
<?php endif;  else: ?>
<div class="extra_info">
<?php echo Phpfox::getPhrase('subscribe.the_feature_or_section_you_are_attempting_to_use_is_not_permitted_with_your_membership_level'); ?>
</div>
<?php endif; ?>
