<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 21, 2014, 8:05 pm */ ?>
<?php if (count((array)$this->_aVars['aFooterLinks'])):  $this->_aPhpfoxVars['iteration']['videos'] = 0;  foreach ((array) $this->_aVars['aFooterLinks'] as $this->_aVars['iKey'] => $this->_aVars['aVideo']):  $this->_aPhpfoxVars['iteration']['videos']++; ?>

<li>
<a href="<?php if ($this->_aVars['bSubdomainMode']):  echo Phpfox::getLib('phpfox.url')->makeUrl($this->_aVars['aDvs']['title_url']);  else:  echo Phpfox::getLib('phpfox.url')->makeUrl('dvs.'.$this->_aVars['aDvs']['title_url']);  endif;  echo $this->_aVars['aVideo']['video_title_url']; ?>" onclick="menuFooter('Footer Link Clicks');" target="_parent">
<?php echo $this->_aVars['aVideo']['year']; ?> <?php echo $this->_aVars['aVideo']['make']; ?> <?php echo $this->_aVars['aVideo']['model']; ?>
</a>
</li>
<?php endforeach; endif; ?>
