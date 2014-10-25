<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 22, 2014, 7:36 pm */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Page
 * @version 		$Id: add.html.php 2847 2011-08-19 07:47:27Z Raymond_Benc $
 */
 
 

 echo $this->_aVars['sCreateJs']; ?>
<form method="post" action="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('admincp.page.add'); ?>" id="js_form" onsubmit="<?php echo $this->_aVars['sGetJsForm']; ?>">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>
	<div><input type="hidden" name="val[attachment]" id="js_attachment" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['attachment']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['attachment']) : (isset($this->_aVars['aForms']['attachment']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['attachment']) : '')); ?>
" /></div>
<?php if ($this->_aVars['bIsEdit']): ?>
	<div><input type="hidden" name="page_id" value="<?php echo $this->_aVars['aForms']['page_id']; ?>" /></div>
	<div><input type="hidden" name="val[old_url]" value="<?php echo $this->_aVars['aForms']['title_url']; ?>" /></div>
	<div><input type="hidden" name="val[add_menu]" value="0" /></div>
	<div><input type="hidden" name="val[menu_id]" value="<?php echo $this->_aVars['aForms']['menu_id']; ?>" /></div>	
<?php endif; ?>
	<div class="table_header">
<?php echo Phpfox::getPhrase('page.details'); ?>
	</div>
	<div class="table">
		<div class="table_left">
<?php echo Phpfox::getPhrase('page.product'); ?>:
		</div>
		<div class="table_right">
			<select name="val[product_id]">
<?php if (count((array)$this->_aVars['aProducts'])):  foreach ((array) $this->_aVars['aProducts'] as $this->_aVars['aProduct']): ?>
				<option value="<?php echo $this->_aVars['aProduct']['product_id']; ?>"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('product_id') && in_array('product_id', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['product_id'])
								&& $aParams['product_id'] == $this->_aVars['aProduct']['product_id'])

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['product_id'])
									&& !isset($aParams['product_id'])
									&& $this->_aVars['aForms']['product_id'] == $this->_aVars['aProduct']['product_id'])
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo $this->_aVars['aProduct']['title']; ?></option>
<?php endforeach; endif; ?>
			</select>
<?php Phpfox::getBlock('help.popup', array('phrase' => 'admincp.page_add_product')); ?>
		</div>
		<div class="clear"></div>
	</div>
	<div class="table">
		<div class="table_left">
<?php echo Phpfox::getPhrase('page.module'); ?>:
		</div>
		<div class="table_right">
			<select name="val[module_id]">
				<option value=""><?php echo Phpfox::getPhrase('page.select'); ?>:</option>
<?php if (count((array)$this->_aVars['aModules'])):  foreach ((array) $this->_aVars['aModules'] as $this->_aVars['sModule']): ?>
				<option value="<?php echo $this->_aVars['sModule']; ?>"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('module_id') && in_array('module_id', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['module_id'])
								&& $aParams['module_id'] == $this->_aVars['sModule'])

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['module_id'])
									&& !isset($aParams['module_id'])
									&& $this->_aVars['aForms']['module_id'] == $this->_aVars['sModule'])
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo $this->_aVars['sModule']; ?></option>
<?php endforeach; endif; ?>
			</select>
<?php Phpfox::getBlock('help.popup', array('phrase' => 'admincp.page_add_product')); ?>
		</div>
		<div class="clear"></div>
	</div>	
	<div class="table">
		<div class="table_left">
<?php echo Phpfox::getPhrase('page.page_title'); ?>:
		</div>
		<div class="table_right">
			<input type="text" name="val[title]" id="title" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['title']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['title']) : (isset($this->_aVars['aForms']['title']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['title']) : '')); ?>
" size="40" onblur="if ($('#title_url').val() == '' && this.value != '') $.ajaxCall('page.admincp.addUrl', 'title=' + this.value);" tabindex="1" />
			<div class="p_4">
<?php echo Phpfox::getPhrase('page.phrase_from_language_package'); ?>
				<label><input type="radio" name="val[is_phrase]" id="is_phrase" value="1"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));
if (isset($this->_aVars['aForms']) && is_numeric('is_phrase') && in_array('is_phrase', $this->_aVars['aForms']) ){echo ' checked="checked"';}
if ((isset($aParams['is_phrase']) && $aParams['is_phrase'] == '1'))
{echo ' checked="checked" ';}
else
{
 if (isset($this->_aVars['aForms']) && isset($this->_aVars['aForms']['is_phrase']) && !isset($aParams['is_phrase']) && $this->_aVars['aForms']['is_phrase'] == '1')
 {
    echo ' checked="checked" ';}
 else
 {
 }
}
?> 
/> <?php echo Phpfox::getPhrase('admincp.yes'); ?></label>
				<label><input type="radio" name="val[is_phrase]" id="is_phrase" value="0"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));
if (isset($this->_aVars['aForms']) && is_numeric('is_phrase') && in_array('is_phrase', $this->_aVars['aForms']) ){echo ' checked="checked"';}
if ((isset($aParams['is_phrase']) && $aParams['is_phrase'] == '0'))
{echo ' checked="checked" ';}
else
{
 if (isset($this->_aVars['aForms']) && isset($this->_aVars['aForms']['is_phrase']) && !isset($aParams['is_phrase']) && $this->_aVars['aForms']['is_phrase'] == '0')
 {
    echo ' checked="checked" ';}
 else
 {
 if (!isset($this->_aVars['aForms']) || ((isset($this->_aVars['aForms']) && !isset($this->_aVars['aForms']['is_phrase']) && !isset($aParams['is_phrase']))))
{
 echo ' checked="checked"';
}
 }
}
?> 
/> <?php echo Phpfox::getPhrase('admincp.no'); ?></label>
			</div>
<?php Phpfox::getBlock('help.popup', array('phrase' => 'admincp.page_add_title')); ?>
		</div>
		<div class="clear"></div>
	</div>
	<div id="js_url_table" class="table"<?php if (! $this->_aVars['bIsEdit'] && ! $this->_aVars['bFormIsPosted']): ?> style="display:none;"<?php endif; ?>>
		<div class="table_left">
<?php echo Phpfox::getPhrase('page.url_title'); ?>:
		</div>
		<div class="table_right">
			<input type="text" name="val[title_url]" id="title_url" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['title_url']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['title_url']) : (isset($this->_aVars['aForms']['title_url']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['title_url']) : '')); ?>
" size="40" />
<?php Phpfox::getBlock('help.popup', array('phrase' => 'admincp.page_add_title_url')); ?>
		</div>
		<div class="clear"></div>
	</div>
	<div class="table">
		<div class="table_left">
<?php echo Phpfox::getPhrase('page.meta_keywords'); ?>:
		</div>
		<div class="table_right">
			<input type="text" name="val[keyword]" id="keyword" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['keyword']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['keyword']) : (isset($this->_aVars['aForms']['keyword']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['keyword']) : '')); ?>
" size="40" tabindex="2" />
<?php Phpfox::getBlock('help.popup', array('phrase' => 'admincp.page_add_keyword')); ?>
		</div>
		<div class="clear"></div>
	</div>
	<div class="table">
		<div class="table_left">
<?php echo Phpfox::getPhrase('page.meta_description'); ?>:
		</div>
		<div class="table_right">
			<textarea cols="35" rows="6" name="val[description]" id="description"><?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['description']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['description']) : (isset($this->_aVars['aForms']['description']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['description']) : '')); ?>
</textarea>
<?php Phpfox::getBlock('help.popup', array('phrase' => 'admincp.page_add_description')); ?>
		</div>
		<div class="clear"></div>
	</div>
	
<?php if (Phpfox ::isModule('tag')):  Phpfox::getBlock('tag.add', array('sType' => 'page','separate' => false));  endif; ?>
	
	<div class="table_header">
<?php echo Phpfox::getPhrase('page.options'); ?>
	</div>
	<div class="table">
		<div class="table_left">
<?php echo Phpfox::getPhrase('page.active'); ?>:
		</div>
		<div class="table_right">
			<label><input type="radio" name="val[is_active]" value="1"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));
if (isset($this->_aVars['aForms']) && is_numeric('is_active') && in_array('is_active', $this->_aVars['aForms']) ){echo ' checked="checked"';}
if ((isset($aParams['is_active']) && $aParams['is_active'] == '1'))
{echo ' checked="checked" ';}
else
{
 if (isset($this->_aVars['aForms']) && isset($this->_aVars['aForms']['is_active']) && !isset($aParams['is_active']) && $this->_aVars['aForms']['is_active'] == '1')
 {
    echo ' checked="checked" ';}
 else
 {
 if (!isset($this->_aVars['aForms']) || ((isset($this->_aVars['aForms']) && !isset($this->_aVars['aForms']['is_active']) && !isset($aParams['is_active']))))
{
 echo ' checked="checked"';
}
 }
}
?> 
/> <?php echo Phpfox::getPhrase('admincp.yes'); ?></label>
			<label><input type="radio" name="val[is_active]" value="0"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));
if (isset($this->_aVars['aForms']) && is_numeric('is_active') && in_array('is_active', $this->_aVars['aForms']) ){echo ' checked="checked"';}
if ((isset($aParams['is_active']) && $aParams['is_active'] == '0'))
{echo ' checked="checked" ';}
else
{
 if (isset($this->_aVars['aForms']) && isset($this->_aVars['aForms']['is_active']) && !isset($aParams['is_active']) && $this->_aVars['aForms']['is_active'] == '0')
 {
    echo ' checked="checked" ';}
 else
 {
 }
}
?> 
/> <?php echo Phpfox::getPhrase('admincp.no'); ?></label>
<?php Phpfox::getBlock('help.popup', array('phrase' => 'admincp.page_add_is_active')); ?>
		</div>
		<div class="clear"></div>
	</div>
	<div class="table">
		<div class="table_left">
<?php echo Phpfox::getPhrase('page.use_entire_page'); ?>:
		</div>
		<div class="table_right">
			<label><input type="radio" name="val[full_size]" value="1"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));
if (isset($this->_aVars['aForms']) && is_numeric('full_size') && in_array('full_size', $this->_aVars['aForms']) ){echo ' checked="checked"';}
if ((isset($aParams['full_size']) && $aParams['full_size'] == '1'))
{echo ' checked="checked" ';}
else
{
 if (isset($this->_aVars['aForms']) && isset($this->_aVars['aForms']['full_size']) && !isset($aParams['full_size']) && $this->_aVars['aForms']['full_size'] == '1')
 {
    echo ' checked="checked" ';}
 else
 {
 if (!isset($this->_aVars['aForms']) || ((isset($this->_aVars['aForms']) && !isset($this->_aVars['aForms']['full_size']) && !isset($aParams['full_size']))))
{
 echo ' checked="checked"';
}
 }
}
?> 
/> <?php echo Phpfox::getPhrase('admincp.yes'); ?></label>
			<label><input type="radio" name="val[full_size]" value="0"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));
if (isset($this->_aVars['aForms']) && is_numeric('full_size') && in_array('full_size', $this->_aVars['aForms']) ){echo ' checked="checked"';}
if ((isset($aParams['full_size']) && $aParams['full_size'] == '0'))
{echo ' checked="checked" ';}
else
{
 if (isset($this->_aVars['aForms']) && isset($this->_aVars['aForms']['full_size']) && !isset($aParams['full_size']) && $this->_aVars['aForms']['full_size'] == '0')
 {
    echo ' checked="checked" ';}
 else
 {
 }
}
?> 
/> <?php echo Phpfox::getPhrase('admincp.no'); ?></label>
<?php Phpfox::getBlock('help.popup', array('phrase' => 'admincp.page_add_full_size')); ?>
		</div>
		<div class="clear"></div>
	</div>
	<div class="table">
		<div class="table_left">
<?php echo Phpfox::getPhrase('page.add_bookmark_links'); ?>:
		</div>
		<div class="table_right">
			<label><input type="radio" name="val[has_bookmark]" value="1"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));
if (isset($this->_aVars['aForms']) && is_numeric('has_bookmark') && in_array('has_bookmark', $this->_aVars['aForms']) ){echo ' checked="checked"';}
if ((isset($aParams['has_bookmark']) && $aParams['has_bookmark'] == '1'))
{echo ' checked="checked" ';}
else
{
 if (isset($this->_aVars['aForms']) && isset($this->_aVars['aForms']['has_bookmark']) && !isset($aParams['has_bookmark']) && $this->_aVars['aForms']['has_bookmark'] == '1')
 {
    echo ' checked="checked" ';}
 else
 {
 if (!isset($this->_aVars['aForms']) || ((isset($this->_aVars['aForms']) && !isset($this->_aVars['aForms']['has_bookmark']) && !isset($aParams['has_bookmark']))))
{
 echo ' checked="checked"';
}
 }
}
?> 
/> <?php echo Phpfox::getPhrase('admincp.yes'); ?></label>
			<label><input type="radio" name="val[has_bookmark]" value="0"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));
if (isset($this->_aVars['aForms']) && is_numeric('has_bookmark') && in_array('has_bookmark', $this->_aVars['aForms']) ){echo ' checked="checked"';}
if ((isset($aParams['has_bookmark']) && $aParams['has_bookmark'] == '0'))
{echo ' checked="checked" ';}
else
{
 if (isset($this->_aVars['aForms']) && isset($this->_aVars['aForms']['has_bookmark']) && !isset($aParams['has_bookmark']) && $this->_aVars['aForms']['has_bookmark'] == '0')
 {
    echo ' checked="checked" ';}
 else
 {
 }
}
?> 
/> <?php echo Phpfox::getPhrase('admincp.no'); ?></label>
<?php Phpfox::getBlock('help.popup', array('phrase' => 'admincp.page_add_bookmark')); ?>
		</div>
		<div class="clear"></div>
	</div>
	<div class="table">
		<div class="table_left">
<?php echo Phpfox::getPhrase('page.add_page_views'); ?>:
		</div>
		<div class="table_right">
			<label><input type="radio" name="val[add_view]" value="1"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));
if (isset($this->_aVars['aForms']) && is_numeric('add_view') && in_array('add_view', $this->_aVars['aForms']) ){echo ' checked="checked"';}
if ((isset($aParams['add_view']) && $aParams['add_view'] == '1'))
{echo ' checked="checked" ';}
else
{
 if (isset($this->_aVars['aForms']) && isset($this->_aVars['aForms']['add_view']) && !isset($aParams['add_view']) && $this->_aVars['aForms']['add_view'] == '1')
 {
    echo ' checked="checked" ';}
 else
 {
 }
}
?> 
/> <?php echo Phpfox::getPhrase('admincp.yes'); ?></label>
			<label><input type="radio" name="val[add_view]" value="0"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));
if (isset($this->_aVars['aForms']) && is_numeric('add_view') && in_array('add_view', $this->_aVars['aForms']) ){echo ' checked="checked"';}
if ((isset($aParams['add_view']) && $aParams['add_view'] == '0'))
{echo ' checked="checked" ';}
else
{
 if (isset($this->_aVars['aForms']) && isset($this->_aVars['aForms']['add_view']) && !isset($aParams['add_view']) && $this->_aVars['aForms']['add_view'] == '0')
 {
    echo ' checked="checked" ';}
 else
 {
 if (!isset($this->_aVars['aForms']) || ((isset($this->_aVars['aForms']) && !isset($this->_aVars['aForms']['add_view']) && !isset($aParams['add_view']))))
{
 echo ' checked="checked"';
}
 }
}
?> 
/> <?php echo Phpfox::getPhrase('admincp.no'); ?></label>
<?php Phpfox::getBlock('help.popup', array('phrase' => 'admincp.page_add_view')); ?>
		</div>
		<div class="clear"></div>
	</div>
<?php if (! $this->_aVars['bIsEdit']): ?>
	<div class="table">
		<div class="table_left">
<?php echo Phpfox::getPhrase('page.add_menu'); ?>:
		</div>
		<div class="table_right">
			<label><input type="radio" name="val[add_menu]" value="1"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));
if (isset($this->_aVars['aForms']) && is_numeric('add_menu') && in_array('add_menu', $this->_aVars['aForms']) ){echo ' checked="checked"';}
if ((isset($aParams['add_menu']) && $aParams['add_menu'] == '1'))
{echo ' checked="checked" ';}
else
{
 if (isset($this->_aVars['aForms']) && isset($this->_aVars['aForms']['add_menu']) && !isset($aParams['add_menu']) && $this->_aVars['aForms']['add_menu'] == '1')
 {
    echo ' checked="checked" ';}
 else
 {
 if (!isset($this->_aVars['aForms']) || ((isset($this->_aVars['aForms']) && !isset($this->_aVars['aForms']['add_menu']) && !isset($aParams['add_menu']))))
{
 echo ' checked="checked"';
}
 }
}
?> 
/> <?php echo Phpfox::getPhrase('admincp.yes'); ?></label>
			<label><input type="radio" name="val[add_menu]" value="0"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));
if (isset($this->_aVars['aForms']) && is_numeric('add_menu') && in_array('add_menu', $this->_aVars['aForms']) ){echo ' checked="checked"';}
if ((isset($aParams['add_menu']) && $aParams['add_menu'] == '0'))
{echo ' checked="checked" ';}
else
{
 if (isset($this->_aVars['aForms']) && isset($this->_aVars['aForms']['add_menu']) && !isset($aParams['add_menu']) && $this->_aVars['aForms']['add_menu'] == '0')
 {
    echo ' checked="checked" ';}
 else
 {
 }
}
?> 
/> <?php echo Phpfox::getPhrase('admincp.no'); ?></label>
<?php Phpfox::getBlock('help.popup', array('phrase' => 'admincp.page_add_menu')); ?>
		</div>
		<div class="clear"></div>
	</div>
<?php endif; ?>
	<div class="table_header">
<?php echo Phpfox::getPhrase('admincp.user_group_access'); ?>
	</div>
	<div class="table">
		<div class="table_left">
<?php echo Phpfox::getPhrase('page.allow_access'); ?>:
		</div>
		<div class="table_right">
<?php if (count((array)$this->_aVars['aUserGroups'])):  foreach ((array) $this->_aVars['aUserGroups'] as $this->_aVars['aUserGroup']): ?>
			<div class="p_4">
				<label><input type="checkbox" name="val[allow_access][]" value="<?php echo $this->_aVars['aUserGroup']['user_group_id']; ?>"<?php if (isset ( $this->_aVars['aAccess'] ) && is_array ( $this->_aVars['aAccess'] )):  if (! in_array ( $this->_aVars['aUserGroup']['user_group_id'] , $this->_aVars['aAccess'] )): ?> checked="checked" <?php endif;  else: ?> checked="checked" <?php endif; ?>/> <?php echo Phpfox::getLib('phpfox.parse.output')->clean(Phpfox::getLib('locale')->convert($this->_aVars['aUserGroup']['title'])); ?></label>
			</div>
<?php endforeach; endif; ?>
<?php Phpfox::getBlock('help.popup', array('phrase' => 'admincp.page_add_access')); ?>
		</div>
		<div class="clear"></div>
	</div>
	<div class="table_header">
<?php echo Phpfox::getPhrase('page.page_data'); ?>
	</div>
	<div class="table">
		<div class="table_span">
			<?php Phpfox::getBlock('attachment.share');  echo Phpfox::getLib('phpfox.editor')->get('text', array (
  'id' => 'text',
  'rows' => '20',
)); ?>
<?php (($sPlugin = Phpfox_Plugin::get('page.template_controller_admincp_add_editor')) ? eval($sPlugin) : false); ?>
			<div class="p_4">			
				Parser: 
					<label><input type="checkbox" name="val[parse_bbcode]" value="1" checked="checked" class="v_middle" /> <?php echo Phpfox::getPhrase('page.bbcode'); ?></label>
					<label><input type="checkbox" name="val[parse_emoticons]" value="1" checked="checked" class="v_middle" /> <?php echo Phpfox::getPhrase('page.emoticons'); ?></label>
					<label><input type="checkbox" name="val[parse_breaks]" value="1" checked="checked" class="v_middle" /> <?php echo Phpfox::getPhrase('page.add_smart_breaks'); ?></label>
					<label><input type="checkbox" name="val[parse_php]" value="1" checked="checked" class="v_middle" /> <?php echo Phpfox::getPhrase('page.php'); ?></label>
			</div>
<?php Phpfox::getBlock('help.popup', array('phrase' => 'admincp.page_add_data')); ?>
		</div>
	</div>
	<div class="table_clear">
		<input type="submit" value="<?php echo Phpfox::getPhrase('core.submit'); ?>" class="button" />
</div>

</form>

