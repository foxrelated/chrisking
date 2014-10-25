<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 21, 2014, 8:26 pm */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Page
 * @version 		$Id: view.html.php 3917 2012-02-20 18:21:08Z Raymond_Benc $
 */
 
 

?>


<?php (($sPlugin = Phpfox_Plugin::get('page.template_controller_view_start')) ? eval($sPlugin) : false); ?>

<?php if ($this->_aVars['aPage']['parse_php']):  echo eval(' ?>' . $this->_aVars['aPage']['text_parsed'] . '<?php ');  else:  echo $this->_aVars['aPage']['text_parsed'];  endif; ?>

<?php if (Phpfox ::getUserParam('page.can_manage_custom_pages') && Phpfox ::getUserParam('admincp.has_admin_access')): ?>
<div class="p_4 t_right">
	<a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('admincp.page.add', array('id' => $this->_aVars['aPage']['page_id'])); ?>"><?php echo Phpfox::getPhrase('page.edit'); ?></a>	
	- <a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('admincp.page', array('delete' => $this->_aVars['aPage']['page_id'])); ?>" class="sJsConfirm"><?php echo Phpfox::getPhrase('page.delete'); ?></a>
</div>

<?php endif;  if (Phpfox ::isModule('tag') && isset ( $this->_aVars['aPage']['tag_list'] )):  Phpfox::getBlock('tag.item', array('sType' => 'page','sTags' => $this->_aVars['aPage']['tag_list'],'iItemId' => $this->_aVars['aPage']['page_id'],'iUserId' => $this->_aVars['aPage']['user_id']));  endif;  if (Phpfox ::isModule('attachment') && $this->_aVars['aPage']['total_attachment'] > 0):  Phpfox::getBlock('attachment.list', array('sType' => 'page','iItemId' => $this->_aVars['aPage']['page_id']));  endif;  if ($this->_aVars['aPage']['add_view'] && $this->_aVars['aPage']['total_view'] > 0): ?>
<em><?php if ($this->_aVars['aPage']['total_view'] == 1):  echo Phpfox::getPhrase('page.page_has_been_viewed_once');  else:  echo Phpfox::getPhrase('page.page_has_been_viewed', array('total' => $this->_aVars['aPage']['total_view'])); ?>.<?php endif; ?></em>
<?php endif; ?>

<?php (($sPlugin = Phpfox_Plugin::get('page.template_controller_view_end')) ? eval($sPlugin) : false);  if (Phpfox ::isModule('share') && $this->_aVars['aPage']['has_bookmark']): ?>
<div class="p_4">
<?php echo Phpfox::getPhrase('page.bookmark'); ?>: <?php Phpfox::getBlock('share.bookmark', array('type' => 'page','url' => $this->_aVars['aPage']['bookmark_url'],'title' => $this->_aVars['aPage']['title'])); ?>
</div>
<?php endif; ?>
