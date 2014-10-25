<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 22, 2014, 6:47 pm */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author			Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: pager.html.php 3588 2011-11-28 08:28:21Z Raymond_Benc $
 */
 
 

 if (isset ( $this->_aVars['aPager'] ) && $this->_aVars['aPager']['totalPages'] > 1): ?>
	<div class="pager_outer">
			<ul class="pager">
<?php if (! isset ( $this->_aVars['bIsMiniPager'] )): ?>
				<li class="pager_total"><?php echo Phpfox::getPhrase('core.page_x_of_x', array('current' => $this->_aVars['aPager']['current'],'total' => $this->_aVars['aPager']['totalPages'])); ?></li>
<?php endif; ?>
<?php if (isset ( $this->_aVars['aPager']['firstUrl'] )): ?><li class="first"><a <?php if ($this->_aVars['sAjax']): ?>href="<?php echo $this->_aVars['aPager']['firstUrl']; ?>" onclick="$(this).parent().parent().parent().parent().find('.sJsPagerDisplayCount').html($.ajaxProcess('<?php echo Phpfox::getPhrase('core.loading'); ?>')); $.ajaxCall('<?php echo $this->_aVars['sAjax']; ?>', 'page=<?php echo $this->_aVars['aPager']['firstAjaxUrl'];  echo $this->_aVars['aPager']['sParams']; ?>'); $Core.addUrlPager(this); return false;"<?php else: ?>href="<?php echo $this->_aVars['aPager']['firstUrl']; ?>"<?php endif; ?>><?php echo Phpfox::getPhrase('core.first'); ?></a></li><?php endif; ?>
<?php if (isset ( $this->_aVars['aPager']['prevUrl'] )): ?><li><a <?php if ($this->_aVars['sAjax']): ?>href="<?php echo $this->_aVars['aPager']['prevUrl']; ?>" onclick="$(this).parent().parent().parent().parent().find('.sJsPagerDisplayCount').html($.ajaxProcess('<?php echo Phpfox::getPhrase('core.loading'); ?>')); $.ajaxCall('<?php echo $this->_aVars['sAjax']; ?>', 'page=<?php echo $this->_aVars['aPager']['prevAjaxUrl'];  echo $this->_aVars['aPager']['sParams']; ?>'); $Core.addUrlPager(this); return false;"<?php else: ?>href="<?php echo $this->_aVars['aPager']['prevUrl']; ?>"<?php endif; ?>><?php echo Phpfox::getPhrase('core.previous'); ?></a></li><?php endif; ?>
<?php if (count((array)$this->_aVars['aPager']['urls'])):  $this->_aPhpfoxVars['iteration']['pager'] = 0;  foreach ((array) $this->_aVars['aPager']['urls'] as $this->_aVars['sLink'] => $this->_aVars['sPage']):  $this->_aPhpfoxVars['iteration']['pager']++; ?>

				<li <?php if (! isset ( $this->_aVars['aPager']['firstUrl'] ) && $this->_aPhpfoxVars['iteration']['pager'] == 1): ?> class="first"<?php endif; ?>><a <?php if ($this->_aVars['sAjax']): ?>href="<?php echo $this->_aVars['sLink']; ?>" onclick="<?php if ($this->_aVars['sLink']): ?>$(this).parent().parent().parent().parent().find('.sJsPagerDisplayCount').html($.ajaxProcess('<?php echo Phpfox::getPhrase('core.loading'); ?>')); $.ajaxCall('<?php echo $this->_aVars['sAjax']; ?>', 'page=<?php echo $this->_aVars['sPage'];  echo $this->_aVars['aPager']['sParams']; ?>'); $Core.addUrlPager(this);<?php endif; ?> return false;<?php else: ?>href="<?php if ($this->_aVars['sLink']):  echo $this->_aVars['sLink'];  else: ?>javascript:void(0);<?php endif;  endif; ?>"<?php if ($this->_aVars['aPager']['current'] == $this->_aVars['sPage']): ?> class="active"<?php endif; ?>><?php echo $this->_aVars['sPage']; ?></a></li>
<?php endforeach; endif; ?>
<?php if (isset ( $this->_aVars['aPager']['nextUrl'] )): ?><li><a <?php if ($this->_aVars['sAjax']): ?>href="<?php echo $this->_aVars['aPager']['nextUrl']; ?>" onclick="$(this).parent().parent().parent().parent().find('.sJsPagerDisplayCount').html($.ajaxProcess('<?php echo Phpfox::getPhrase('core.loading'); ?>')); $.ajaxCall('<?php echo $this->_aVars['sAjax']; ?>', 'page=<?php echo $this->_aVars['aPager']['nextAjaxUrl'];  echo $this->_aVars['aPager']['sParams']; ?>'); $Core.addUrlPager(this); return false;"<?php else: ?>href="<?php echo $this->_aVars['aPager']['nextUrl']; ?>"<?php endif; ?>><?php echo Phpfox::getPhrase('core.next'); ?></a></li><?php endif; ?>
<?php if (isset ( $this->_aVars['aPager']['lastUrl'] )): ?><li><a <?php if ($this->_aVars['sAjax']): ?>href="<?php echo $this->_aVars['aPager']['lastUrl']; ?>" onclick="$(this).parent().parent().parent().parent().find('.sJsPagerDisplayCount').html($.ajaxProcess('<?php echo Phpfox::getPhrase('core.loading'); ?>')); $.ajaxCall('<?php echo $this->_aVars['sAjax']; ?>', 'page=<?php echo $this->_aVars['aPager']['lastAjaxUrl'];  echo $this->_aVars['aPager']['sParams']; ?>'); $Core.addUrlPager(this); return false;"<?php else: ?>href="<?php echo $this->_aVars['aPager']['lastUrl']; ?>"<?php endif; ?>><?php echo Phpfox::getPhrase('core.last'); ?></a></li><?php endif; ?>
			</ul>	
			<div class="clear"></div>		
	</div>
<?php endif; ?>
