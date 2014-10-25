<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 21, 2014, 8:29 pm */ ?>
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
<script type="text/javascript">
    <?php echo '
    $Behavior.changeFontFamilyInit = function() {
        var aFontFamilies = [
            \'Georgia, serif\',
            \'"Palatino Linotype", "Book Antiqua", Palatino, serif\',
            \'"Times New Roman", Times, serif\',
            \'Arial, Helvetica, sans-serif\',
            \'"Arial Black", Gadget, sans-serif\',
            \'"Comic Sans MS", cursive, sans-serif\',
            \'Impact, Charcoal, sans-serif\',
            \'"Lucida Sans Unicode", "Lucida Grande", sans-serif\',
            \'Tahoma, Geneva, sans-serif\',
            \'"Trebuchet MS", Helvetica, sans-serif\',
            \'Verdana, Geneva, sans-serif\',
            \'"Courier New", Courier, monospace\',\'"Lucida Console", Monaco, monospace\'
        ];

        var iStart = parseInt($(\'#font_family_id\').val());
        $(\'#preview_wrapper\').css(\'fontFamily\', aFontFamilies.slice(iStart, iStart + 1).toString());


        $(\'#font_family_id\').change(function() {
            iStart = parseInt($(\'#font_family_id\').val());
            $(\'#preview_wrapper\').css(\'fontFamily\', aFontFamilies.slice(iStart, iStart + 1).toString());
        });
    };
    '; ?>



<?php if ($this->_aVars['bIsEdit']): ?>
		$Behavior.colorPicker = function() {
			$('#color_picker_menu_background').ColorPickerSetColor('#<?php echo $this->_aVars['aForms']['menu_background']; ?>');
			$('#color_picker_menu_link').ColorPickerSetColor('#<?php echo $this->_aVars['aForms']['menu_link']; ?>');
			$('#color_picker_page_background').ColorPickerSetColor('#<?php echo $this->_aVars['aForms']['page_background']; ?>');
			$('#color_picker_page_text').ColorPickerSetColor('#<?php echo $this->_aVars['aForms']['page_text']; ?>');
			$('#color_picker_button_background').ColorPickerSetColor('#<?php echo $this->_aVars['aForms']['button_background']; ?>');
			$('#color_picker_button_text').ColorPickerSetColor('#<?php echo $this->_aVars['aForms']['button_text']; ?>');
			$('#color_picker_button_top_gradient').ColorPickerSetColor('#<?php echo $this->_aVars['aForms']['button_top_gradient']; ?>');
			$('#color_picker_button_bottom_gradient').ColorPickerSetColor('#<?php echo $this->_aVars['aForms']['button_bottom_gradient']; ?>');
			$('#color_picker_button_border').ColorPickerSetColor('#<?php echo $this->_aVars['aForms']['button_border']; ?>');
			$('#color_picker_text_link').ColorPickerSetColor('#<?php echo $this->_aVars['aForms']['text_link']; ?>');
			$('#color_picker_footer_link').ColorPickerSetColor('#<?php echo $this->_aVars['aForms']['footer_link']; ?>');
            $('#color_picker_iframe_background').ColorPickerSetColor('#<?php echo $this->_aVars['aForms']['iframe_background']; ?>');
            $('#color_picker_iframe_text').ColorPickerSetColor('#<?php echo $this->_aVars['aForms']['iframe_text']; ?>');
            $('#color_picker_iframe_contact_background').ColorPickerSetColor('#<?php echo $this->_aVars['aForms']['iframe_contact_background']; ?>');
            $('#color_picker_iframe_contact_text').ColorPickerSetColor('#<?php echo $this->_aVars['aForms']['iframe_contact_text']; ?>');
            $('#color_picker_vin_top_gradient').ColorPickerSetColor('#<?php echo $this->_aVars['aForms']['vin_top_gradient']; ?>');
            $('#color_picker_vin_bottom_gradient').ColorPickerSetColor('#<?php echo $this->_aVars['aForms']['vin_bottom_gradient']; ?>');
			}
<?php else: ?>
		$Behavior.colorPicker = function() {
			$('#color_picker_menu_background').ColorPickerSetColor('#<?php echo $this->_aVars['sDefaultColor']; ?>');
			$('#color_picker_menu_link').ColorPickerSetColor('#<?php echo $this->_aVars['sDefaultColor']; ?>');
			$('#color_picker_page_background').ColorPickerSetColor('#<?php echo $this->_aVars['sDefaultColor']; ?>');
			$('#color_picker_page_text').ColorPickerSetColor('#<?php echo $this->_aVars['sDefaultColor']; ?>');
			$('#color_picker_button_background').ColorPickerSetColor('#<?php echo $this->_aVars['sDefaultColor']; ?>');
			$('#color_picker_button_text').ColorPickerSetColor('#<?php echo $this->_aVars['sDefaultColor']; ?>');
			$('#color_picker_button_top_gradient').ColorPickerSetColor('#<?php echo $this->_aVars['sDefaultColor']; ?>');
			$('#color_picker_button_bottom_gradient').ColorPickerSetColor('#<?php echo $this->_aVars['sDefaultColor']; ?>');
			$('#color_picker_button_border').ColorPickerSetColor('#<?php echo $this->_aVars['sDefaultColor']; ?>');
			$('#color_picker_text_link').ColorPickerSetColor('#<?php echo $this->_aVars['sDefaultColor']; ?>');
			$('#color_picker_footer_link').ColorPickerSetColor('#<?php echo $this->_aVars['sDefaultColor']; ?>');
            $('#color_picker_iframe_background').ColorPickerSetColor('#<?php echo $this->_aVars['sDefaultColor']; ?>');
            $('#color_picker_iframe_text').ColorPickerSetColor('#<?php echo $this->_aVars['sDefaultColor']; ?>');
            $('#color_picker_iframe_contact_background').ColorPickerSetColor('#<?php echo $this->_aVars['sDefaultColor']; ?>');
            $('#color_picker_iframe_contact_text').ColorPickerSetColor('#<?php echo $this->_aVars['sDefaultColor']; ?>');
            $('#color_picker_vin_top_gradient').ColorPickerSetColor('#A764C5');
            $('#color_picker_vin_bottom_gradient').ColorPickerSetColor('#451656');
		}
<?php endif; ?>
</script>

<style type="text/css">
	#dvs_container {
		position:relative;
		width: 670px;
		height: 270px;
		margin-left: auto;
		margin-right: auto;
		color: #<?php if ($this->_aVars['bIsEdit']):  echo $this->_aVars['aForms']['page_background'];  else: ?>c5c5c5<?php endif; ?>;
		background: #<?php if ($this->_aVars['bIsEdit']):  echo $this->_aVars['aForms']['page_background'];  else: ?>c5c5c5<?php endif; ?>;
	}
	
	#preview_menu_container {
		top:0px;
		position:absolute;
		width: 670px;
		padding-left:10px;
		padding-top:3px;
		height:22px;
		text-align:left;
		background: none repeat scroll 0 0 #<?php if ($this->_aVars['bIsEdit']):  echo $this->_aVars['aForms']['menu_background'];  else: ?>c5c5c5<?php endif; ?>;
		font-size: 1.2em;
	}
	
	.dvs_top_menu_link {
		margin-right:10px;
		color: #<?php if ($this->_aVars['bIsEdit']):  echo $this->_aVars['aForms']['menu_link'];  else:  echo $this->_aVars['sDefaultColor'];  endif; ?>
	}
	
	#preview_vehicle_select_container {
		position: absolute;
		top: 30px;
		left:500px;
		width:160px;
		height:52px;
		color: #<?php if ($this->_aVars['bIsEdit']):  echo $this->_aVars['aForms']['page_text'];  else: ?>c5c5c5<?php endif; ?>;
		font-weight: bold;
	}
	
	.preview_select {
		width:160px;
		-webkit-border-top-left-radius: 10px;
		-webkit-border-bottom-left-radius: 10px;
		-webkit-border-top-right-radius: 10px;
		-webkit-border-bottom-right-radius: 10px;
		-moz-border-radius-topleft: 10px;
		-moz-border-radius-bottomleft: 10px;
		-moz-border-radius-topright: 10px;
		-moz-border-radius-bottomright: 10px;
		border-top-left-radius: 10px;
		border-bottom-left-radius: 10px;
		border-top-right-radius: 10px;
		border-bottom-right-radius: 10px;
		padding:5px;
		margin-bottom: 7px;
		font-weight:bold;
		border: 1px solid #<?php if ($this->_aVars['bIsEdit']):  echo $this->_aVars['aForms']['button_border'];  else: ?>c5c5c5<?php endif; ?>;
		color: #<?php if ($this->_aVars['bIsEdit']):  echo $this->_aVars['aForms']['button_text'];  else: ?>c5c5c5<?php endif; ?>;
		background: #<?php if ($this->_aVars['bIsEdit']):  echo $this->_aVars['aForms']['button_background'];  else: ?>c5c5c5<?php endif; ?>;
	}
	
	#preview_cta_button_container {
		position: absolute;
		top: 30px;
		left:500px;
		width:160px;
		height:128px;
		font-weight: bold;
	}
	
	#preview_social_button_container {
		position: absolute;
		top: 215px;
		left:500px;
		width:160px;
		height:32px;
		font-weight: bold;
	}
	
	.dvs_social_button_link {
		margin-right:5px;
	}
	
	#preview_player_container {
		position: absolute;
		margin-left: 10px;
		margin-right: 10px;
		height:100px;
		top:30px;
		width:470px;
		text-align:left;
		background:#000;
		color:#ccc;
	}
	
	#player_mockup {
		text-align:center;
		color:#fff;
		font-size:2em;
		font-weight:bold;
		letter-spacing:1px;
		padding-top:25px;
	}
	
	#preview_now_playing_container {
		position: relative;
		top: 140px;
		text-align: left;
		overflow:hidden;
		text-overflow: ellipsis;
        white-space: nowrap;
		color: #<?php if ($this->_aVars['bIsEdit']):  echo $this->_aVars['aForms']['page_text'];  else: ?>c5c5c5<?php endif; ?>;
    }
	
	#preview_dealer_info_container {
		position: absolute;
		top: 180px;
		width:320px;
		text-align: left;
		overflow:hidden;
		text-overflow: ellipsis;
        white-space: nowrap;
	}
	
	.preview_dealer_info {
		color: #<?php if ($this->_aVars['bIsEdit']):  echo $this->_aVars['aForms']['page_text'];  else: ?>c5c5c5<?php endif; ?>;
	}
	
	#preview_dealer_website_link {
		color: #<?php if ($this->_aVars['bIsEdit']):  echo $this->_aVars['aForms']['text_link'];  else: ?>c5c5c5<?php endif; ?>;
	}
	
	#preview_container {
		position: relative;
		text-align: left;
	}
	
	#preview_wrapper {
		margin-left:60px;
		overflow: hidden;
	}
	
	.dvs_c2a_button {
		background-color:#<?php if ($this->_aVars['bIsEdit']):  echo $this->_aVars['aForms']['button_top_gradient'];  else: ?>ffffff<?php endif; ?>;
		background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #<?php if ($this->_aVars['bIsEdit']):  echo $this->_aVars['aForms']['button_top_gradient'];  else: ?>ffffff<?php endif; ?>;), color-stop(1, #<?php if ($this->_aVars['bIsEdit']):  echo $this->_aVars['aForms']['button_bottom_gradient'];  else: ?>000000<?php endif; ?>) );
		background:-moz-linear-gradient( center top, #<?php if ($this->_aVars['bIsEdit']):  echo $this->_aVars['aForms']['button_top_gradient'];  else: ?>ffffff<?php endif; ?> 5%, #<?php if ($this->_aVars['bIsEdit']):  echo $this->_aVars['aForms']['button_bottom_gradient'];  else: ?>000000<?php endif; ?> 100% );
		filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#<?php if ($this->_aVars['bIsEdit']):  echo $this->_aVars['aForms']['button_top_gradient'];  else: ?>ffffff<?php endif; ?>', endColorstr='#<?php if ($this->_aVars['bIsEdit']):  echo $this->_aVars['aForms']['button_bottom_gradient'];  else: ?>000000<?php endif; ?>');
		border:1px solid #<?php if ($this->_aVars['bIsEdit']):  echo $this->_aVars['aForms']['button_border'];  else: ?>000000<?php endif; ?>;
		color:#<?php if ($this->_aVars['bIsEdit']):  echo $this->_aVars['aForms']['button_text'];  else: ?>ffffff<?php endif; ?>;
		-moz-border-radius:10px;
		-webkit-border-radius:10px;
		border-radius:10px;
		display:inline-block;
		font-family:arial;
		font-size:1.5em;
		font-weight:bold;
		padding:2px 0px;
		text-decoration:none;
		width:160px;
		text-align:center;
		margin-bottom:3px;
	}

	.dvs_c2a_button:active {
		position:relative;
		top:1px;
	}

	.dvs_c2a_button:hover {
		background-color:#<?php if ($this->_aVars['bIsEdit']):  echo $this->_aVars['aForms']['button_bottom_gradient'];  else: ?>000000<?php endif; ?>;
		background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #<?php if ($this->_aVars['bIsEdit']):  echo $this->_aVars['aForms']['button_bottom_gradient'];  else: ?>000000<?php endif; ?>), color-stop(1, #<?php if ($this->_aVars['bIsEdit']):  echo $this->_aVars['aForms']['button_top_gradient'];  else: ?>ffffff<?php endif; ?>) );
		background:-moz-linear-gradient( center top, #<?php if ($this->_aVars['bIsEdit']):  echo $this->_aVars['aForms']['button_bottom_gradient'];  else: ?>000000<?php endif; ?> 5%, #<?php if ($this->_aVars['bIsEdit']):  echo $this->_aVars['aForms']['button_top_gradient'];  else: ?>ffffff<?php endif; ?> 100% );
		filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#<?php if ($this->_aVars['bIsEdit']):  echo $this->_aVars['aForms']['button_bottom_gradient'];  else: ?>000000<?php endif; ?>', endColorstr='#<?php if ($this->_aVars['bIsEdit']):  echo $this->_aVars['aForms']['button_top_gradient'];  else: ?>ffffff<?php endif; ?>');
		
		text-decoration:none;
		color:#<?php if ($this->_aVars['bIsEdit']):  echo $this->_aVars['aForms']['button_text'];  else: ?>ffffff<?php endif; ?>;
	}
	
	#preview_footer_container {
		top:250px;
		position:absolute;
		width: 670px;
		padding-left:10px;
		text-align:left;
		text-align:center;
		font-size: 1.25em;
		font-weight:bold;
		color: #<?php if ($this->_aVars['bIsEdit']):  echo $this->_aVars['aForms']['footer_link'];  else: ?>c5c5c5<?php endif; ?>;
	}
	
	.dvs_footer_link {
		margin-right:10px;
	}

</style>
<form method="post" action="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('dvs.index'); ?>" id="add_dvs_customize" name="add_dvs_customize">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>
	<h3>Branding</h3>
	<div id="error_message" class="error_message" style="display:none"></div>
	<table>
		<tr class="tr_interactive">
			<td class="dvs_add_td">
<?php echo Phpfox::getPhrase('dvs.banner_image'); ?>:
			</td>
			<td class="dvs_add_td">
				<span id="branding_file_label">
<?php if ($this->_aVars['bIsEdit']): ?>
<?php echo Phpfox::getPhrase('dvs.current_image'); ?>
<?php else: ?>
<?php echo Phpfox::getPhrase('dvs.select_file'); ?>
<?php endif; ?>:
				</span>
				<iframe id="js_branding_upload_frame" name="js_branding_upload_frame" src="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('dvs.branding-file-form');  if ($this->_aVars['bIsEdit']): ?>current-branding-id_<?php echo $this->_aVars['aForms']['branding_file_id'];  endif; ?>" scrolling="no" frameborder="0" width="250" height="35" <?php if ($this->_aVars['bIsEdit']): ?>style="display:none;"<?php endif; ?>></iframe>
				<div id="branding_file_preview" <?php if (! $this->_aVars['bIsEdit']): ?>style="display: none"<?php endif; ?>>
<?php if ($this->_aVars['bIsEdit']): ?>
<?php if ($this->_aVars['aForms']['branding_file_name']): ?>
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('path' => 'core.url_file','file' => 'dvs/branding/'.$this->_aVars['aForms']['branding_file_name'],'max_width' => 180,'max_height' => 180)); ?>
<?php else: ?>
<?php echo Phpfox::getPhrase('dvs.no_branding_file'); ?>
<?php endif; ?>
						 <br />
						<a href="#" onclick="window.parent.document.getElementById('branding_file_label').innerHTML = '<?php echo Phpfox::getPhrase('dvs.select_file'); ?>:';window.parent.document.getElementById('js_branding_upload_frame').style.display = 'block';window.parent.document.getElementById('branding_file_preview').style.display = 'none';"><?php echo Phpfox::getPhrase('dvs.change_branding_image'); ?></a> - <a href="#" onclick="if (confirm('Are you sure?')){window.parent.document.getElementById('branding_file_label').innerHTML = '<?php echo Phpfox::getPhrase('dvs.select_file'); ?>:';window.parent.document.getElementById('js_branding_upload_frame').style.display = 'block';window.parent.document.getElementById('branding_file_preview').style.display = 'none';window.parent.document.getElementById('branding_file_id').value = 0;$.ajaxCall('dvs.removeBrandingFile','iBrandingFileId=<?php echo $this->_aVars['aForms']['branding_file_id']; ?>')}"><?php echo Phpfox::getPhrase('dvs.remove_branding_image'); ?></a>
<?php endif; ?>
				</div>
				<input type="hidden" id="branding_file_id" name="val[branding_file_id]" value="<?php if ($this->_aVars['bIsEdit']):  echo $this->_aVars['aForms']['branding_file_id'];  else: ?>0<?php endif; ?>"/>
			</td>
		</tr>
	</table>
	
	<table>
		<tr class="tr_interactive">
			<td class="dvs_add_td">
<?php echo Phpfox::getPhrase('dvs.background_image'); ?>:
			</td>
			<td class="dvs_add_td">
				<span id="background_file_label">
<?php if ($this->_aVars['bIsEdit']): ?>
<?php echo Phpfox::getPhrase('dvs.current_image'); ?>
<?php else: ?>
<?php echo Phpfox::getPhrase('dvs.select_file'); ?>
<?php endif; ?>:
				</span>
				<iframe id="js_background_upload_frame" name="js_background_upload_frame" src="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('dvs.background-file-form');  if ($this->_aVars['bIsEdit']): ?>current-background-id_<?php echo $this->_aVars['aForms']['background_file_id'];  endif; ?>" scrolling="no" frameborder="0" width="250" height="35" <?php if ($this->_aVars['bIsEdit']): ?>style="display:none;"<?php endif; ?>></iframe>
				<div id="background_file_preview" <?php if (! $this->_aVars['bIsEdit']): ?>style="display: none"<?php endif; ?>>
<?php if ($this->_aVars['bIsEdit']): ?>
<?php if ($this->_aVars['aForms']['background_file_name']): ?>
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('path' => 'core.url_file','file' => 'dvs/background/'.$this->_aVars['aForms']['background_file_name'],'max_width' => 180,'max_height' => 180)); ?>
<?php else: ?>
<?php echo Phpfox::getPhrase('dvs.no_background_file'); ?>
<?php endif; ?>
						 <br />
						<a href="#" onclick="window.parent.document.getElementById('background_file_label').innerHTML = '<?php echo Phpfox::getPhrase('dvs.select_file'); ?>:';window.parent.document.getElementById('js_background_upload_frame').style.display = 'block';window.parent.document.getElementById('background_file_preview').style.display = 'none';"><?php echo Phpfox::getPhrase('dvs.change_background_image'); ?></a> - <a href="#" onclick="if (confirm('Are you sure?')){window.parent.document.getElementById('background_file_label').innerHTML = '<?php echo Phpfox::getPhrase('dvs.select_file'); ?>:';window.parent.document.getElementById('js_background_upload_frame').style.display = 'block';window.parent.document.getElementById('background_file_preview').style.display = 'none';window.parent.document.getElementById('background_file_id').value = 0;$.ajaxCall('dvs.removeBackgroundFile','iBackgroundFileId=<?php echo $this->_aVars['aForms']['background_file_id']; ?>')}"><?php echo Phpfox::getPhrase('dvs.remove_background_image'); ?></a>
<?php endif; ?>
				</div>
				<input type="hidden" id="background_file_id" name="val[background_file_id]" value="<?php if ($this->_aVars['bIsEdit']):  echo $this->_aVars['aForms']['background_file_id'];  else: ?>0<?php endif; ?>"/>
			</td>
		</tr>

		<tr style="display: none;">
			<td class="dvs_add_td">
<?php echo Phpfox::getPhrase('dvs.background_opacity'); ?>:
			</td>
			<td class="dvs_add_td">
				<input type="text" name="val[background_opacity]" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['background_opacity']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['background_opacity']) : (isset($this->_aVars['aForms']['background_opacity']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['background_opacity']) : '')); ?>
" id="background_opacity" size="5"/>
			</td>
		</tr>
		
	</table>

    <table>
        <tr class="tr_interactive">
            <td class="dvs_add_td">
                Background Repeat:
            </td>
            <td class="dvs_add_td_label">
                <input type="radio" name="val[background_repeat_type]" value="repeat" <?php if ($this->_aVars['bIsEdit']):  if ($this->_aVars['aForms']['background_repeat_type'] == 'repeat'): ?>checked="checked"<?php endif;  else: ?>checked="checked"<?php endif; ?>>repeat<br>
            </td>
            <td class="dvs_add_td_label">
                <input type="radio" name="val[background_repeat_type]" value="no-repeat" <?php if ($this->_aVars['bIsEdit'] && $this->_aVars['aForms']['background_repeat_type'] == 'no-repeat'): ?>checked="checked"<?php endif; ?>>no-repeat<br>
            </td>
            <td class="dvs_add_td_label">
                <input type="radio" name="val[background_repeat_type]" value="repeat-x" <?php if ($this->_aVars['bIsEdit'] && $this->_aVars['aForms']['background_repeat_type'] == 'repeat-x'): ?>checked="checked"<?php endif; ?>>repeat-x<br>
            </td>
            <td class="dvs_add_td_label">
                <input type="radio" name="val[background_repeat_type]" value="repeat-y" <?php if ($this->_aVars['bIsEdit'] && $this->_aVars['aForms']['background_repeat_type'] == 'repeat-y'): ?>checked="checked"<?php endif; ?>>repeat-y<br>
            </td>
        </tr>
    </table>

    <table>
        <tr class="tr_interactive">
            <td class="dvs_add_td">
                Background Attachment:
            </td>
            <td class="dvs_add_td_label">
                <input type="radio" name="val[background_attachment_type]" value="scroll" <?php if ($this->_aVars['bIsEdit']):  if ($this->_aVars['aForms']['background_attachment_type'] == 'scroll'): ?>checked="checked"<?php endif;  else: ?>checked="checked"<?php endif; ?>>scroll<br>
            </td>
            <td class="dvs_add_td_label">
                <input type="radio" name="val[background_attachment_type]" value="fixed" <?php if ($this->_aVars['bIsEdit'] && $this->_aVars['aForms']['background_attachment_type'] == 'fixed'): ?>checked="checked"<?php endif; ?>>fixed<br>
            </td>
        </tr>
    </table>
	<br>
	<div <?php if (Phpfox ::isAdmin()):  else: ?>style="display:none;"<?php endif; ?>>
	<h3>Page Styling</h3>

    <table>
        <tr>
            <td class="dvs_add_td_label">
<?php echo Phpfox::getPhrase('dvs.select_a_theme'); ?>:
            </td>
            <td class="dvs_add_td">
                <select name="val[theme_select]" id="theme_select" onchange="$.ajaxCall('dvs.chooseTheme', 'theme_id='+this.value);">
                    <option value="0">Select a Theme</option>
<?php if (count((array)$this->_aVars['aThemes'])):  foreach ((array) $this->_aVars['aThemes'] as $this->_aVars['aTheme']): ?>
                    <option value="<?php echo $this->_aVars['aTheme']['theme_id']; ?>"><?php echo $this->_aVars['aTheme']['theme_name']; ?></option>
<?php endforeach; endif; ?>
                </select>
            </td>
        </tr>

        <tr>
            <td class="dvs_add_td_label">
                Font Family:
            </td>
            <td>
                <select id="font_family_id" name="val[font_family_id]">
<?php if (count((array)$this->_aVars['aFontFamilies'])):  foreach ((array) $this->_aVars['aFontFamilies'] as $this->_aVars['iKey'] => $this->_aVars['sFontFamily']): ?>
                    <option value="<?php echo $this->_aVars['iKey']; ?>" <?php if ($this->_aVars['bIsEdit'] && $this->_aVars['aForms']['font_family_id'] == $this->_aVars['iKey']): ?>selected="selected"<?php elseif (( ! $this->_aVars['bIsEdit'] ) && ( $this->_aVars['aForms']['font_family_id'] == 3 ) && ( $this->_aVars['iKey'] == 3 )): ?>selected="selected"<?php endif; ?>><?php echo $this->_aVars['sFontFamily']; ?></option>
<?php endforeach; endif; ?>
                </select>
            </td>
        </tr>
    </table>

	<table>
		<tr>
			<td class="dvs_add_td_label">
<?php echo Phpfox::getPhrase('dvs.menu_background'); ?>:
			</td>
			<td class="dvs_add_td">
				<div id="color_picker_menu_background" class="colorSelector">	
					<div style="background-color: #<?php if ($this->_aVars['bIsEdit']):  echo $this->_aVars['aForms']['menu_background'];  else:  echo $this->_aVars['sDefaultColor'];  endif; ?>"></div>
				</div>
				<input type="hidden" id="color_picker_menu_background_input" name="val[menu_background]" <?php if ($this->_aVars['bIsEdit']): ?>value="<?php echo $this->_aVars['aForms']['menu_background']; ?>"<?php else: ?>value="<?php echo $this->_aVars['sDefaultColor']; ?>"<?php endif; ?>/>
			</td>
			<td rowspan="6" style="vertical-align:middle;">
				<div id="preview_wrapper">
				<h1 align="center">Live Preview</h1>
					<div id="preview_container">
						<div id="dvs_container">
							<div id="preview_menu_container">
								<span class="dvs_top_menu_link">Top Menu Link</span>
								<span class="dvs_top_menu_link">Top Menu Link</span>
								<span class="dvs_top_menu_link">Top Menu Link</span>
								<span class="dvs_top_menu_link">Top Menu Link</span>
							</div>

							<div id="preview_player_container">
								<div id="player_mockup">Video Player</div>
							</div>

							<div id="preview_now_playing_container">
								<span class="preview_dealer_info">This is the Page Text color. This is the Page Text color.</span><br/><br>
								<span id="preview_dealer_website_link">This is the Text Link color.</span><br/>
							</div>
							
							<div id="preview_cta_button_container">
								<a href="#" class="dvs_c2a_button">Button</a>
								<a href="#" class="dvs_c2a_button">Button</a>
								<a href="#" class="dvs_c2a_button">Button</a>
								<a href="#" class="dvs_c2a_button">Button</a>
								
							</div>
							<div id="preview_footer_container">
							<span class="dvs_footer_link">Footer Link</span>
							<span class="dvs_footer_link">Footer Link</span>
							<span class="dvs_footer_link">Footer Link</span>
							<span class="dvs_footer_link">Footer Link</span>
							</div>
						</div>
					</div>
				</div>	
			</td>
		</tr>
		
		<tr>
			<td class="dvs_add_td_label">
<?php echo Phpfox::getPhrase('dvs.top_menu_link'); ?>:
			</td>
			<td class="dvs_add_td">
				<div id="color_picker_menu_link" class="colorSelector">	
					<div style="background-color: #<?php if ($this->_aVars['bIsEdit']):  echo $this->_aVars['aForms']['menu_link'];  else:  echo $this->_aVars['sDefaultColor'];  endif; ?>"></div>
				</div>
				<input type="hidden" id="color_picker_menu_link_input" name="val[menu_link]" <?php if ($this->_aVars['bIsEdit']): ?>value="<?php echo $this->_aVars['aForms']['menu_link']; ?>"<?php else: ?>value="<?php echo $this->_aVars['sDefaultColor']; ?>"<?php endif; ?>/>
			</td>
		</tr>

		<tr class="tr_interactive">
			<td class="dvs_add_td_label">
<?php echo Phpfox::getPhrase('dvs.page_background'); ?>:
			</td>
			<td class="dvs_add_td">
				<div id="color_picker_page_background" class="colorSelector">	
					<div style="background-color: #<?php if ($this->_aVars['bIsEdit']):  echo $this->_aVars['aForms']['page_background'];  else:  echo $this->_aVars['sDefaultColor'];  endif; ?>"></div>
				</div>
				<input type="hidden" id="color_picker_page_background_input" name="val[page_background]" <?php if ($this->_aVars['bIsEdit']): ?>value="<?php echo $this->_aVars['aForms']['page_background']; ?>"<?php else: ?>value="<?php echo $this->_aVars['sDefaultColor']; ?>"<?php endif; ?>/>
			</td>
		</tr>
		
		<tr>
			<td class="dvs_add_td_label">
<?php echo Phpfox::getPhrase('dvs.page_text'); ?>:
			</td>
			<td class="dvs_add_td">
				<div id="color_picker_page_text" class="colorSelector">	
					<div style="background-color: #<?php if ($this->_aVars['bIsEdit']):  echo $this->_aVars['aForms']['page_text'];  else:  echo $this->_aVars['sDefaultColor'];  endif; ?>"></div>
				</div>
				<input type="hidden" id="color_picker_page_text_input" name="val[page_text]" <?php if ($this->_aVars['bIsEdit']): ?>value="<?php echo $this->_aVars['aForms']['page_text']; ?>"<?php else: ?>value="<?php echo $this->_aVars['sDefaultColor']; ?>"<?php endif; ?>/>
			</td>
		</tr>
		
		<tr>
			<td class="dvs_add_td_label">
<?php echo Phpfox::getPhrase('dvs.text_link'); ?>:
			</td>
			<td class="dvs_add_td">
				<div id="color_picker_text_link" class="colorSelector">	
					<div style="background-color: #<?php if ($this->_aVars['bIsEdit']):  echo $this->_aVars['aForms']['text_link'];  else:  echo $this->_aVars['sDefaultColor'];  endif; ?>"></div>
				</div>
				<input type="hidden" id="color_picker_text_link_input" name="val[text_link]" <?php if ($this->_aVars['bIsEdit']): ?>value="<?php echo $this->_aVars['aForms']['text_link']; ?>"<?php else: ?>value="<?php echo $this->_aVars['sDefaultColor']; ?>"<?php endif; ?>/>
			</td>
		</tr>
		
		<tr>
			<td class="dvs_add_td_label">
<?php echo Phpfox::getPhrase('dvs.footer_link'); ?>:
			</td>
			<td class="dvs_add_td">
				<div id="color_picker_footer_link" class="colorSelector">	
					<div style="background-color: #<?php if ($this->_aVars['bIsEdit']):  echo $this->_aVars['aForms']['footer_link'];  else:  echo $this->_aVars['sDefaultColor'];  endif; ?>"></div>
				</div>
				<input type="hidden" id="color_picker_footer_link_input" name="val[footer_link]" <?php if ($this->_aVars['bIsEdit']): ?>value="<?php echo $this->_aVars['aForms']['footer_link']; ?>"<?php else: ?>value="<?php echo $this->_aVars['sDefaultColor']; ?>"<?php endif; ?>/>
			</td>
		</tr>
	</table>
	<br>
	<h3><?php echo Phpfox::getPhrase('dvs.button_styling'); ?></h3>
	<table>
		<tr class="tr_interactive">
			<td class="dvs_add_td_label">
<?php echo Phpfox::getPhrase('dvs.background'); ?>:
			</td>
			<td class="dvs_add_td">
				<div id="color_picker_button_background" class="colorSelector">	
					<div style="background-color: #<?php if ($this->_aVars['bIsEdit']):  echo $this->_aVars['aForms']['button_background'];  else:  echo $this->_aVars['sDefaultColor'];  endif; ?>"></div>
				</div>
				<input type="hidden" id="color_picker_button_background_input" name="val[button_background]" <?php if ($this->_aVars['bIsEdit']): ?>value="<?php echo $this->_aVars['aForms']['button_background']; ?>"<?php else: ?>value="<?php echo $this->_aVars['sDefaultColor']; ?>"<?php endif; ?>/>
			</td>

			<td class="dvs_add_td_label">
<?php echo Phpfox::getPhrase('dvs.text'); ?>:
			</td>
			<td class="dvs_add_td">
				<div id="color_picker_button_text" class="colorSelector">	
					<div style="background-color: #<?php if ($this->_aVars['bIsEdit']):  echo $this->_aVars['aForms']['button_text'];  else:  echo $this->_aVars['sDefaultColor'];  endif; ?>"></div>
				</div>
				<input type="hidden" id="color_picker_button_text_input" name="val[button_text]" <?php if ($this->_aVars['bIsEdit']): ?>value="<?php echo $this->_aVars['aForms']['button_text']; ?>"<?php else: ?>value="<?php echo $this->_aVars['sDefaultColor']; ?>"<?php endif; ?>/>
			</td>
			
			<td class="dvs_add_td_label">
<?php echo Phpfox::getPhrase('dvs.top_gradient'); ?>:
			</td>
			<td class="dvs_add_td">
				<div id="color_picker_button_top_gradient" class="colorSelector">	
					<div style="background-color: #<?php if ($this->_aVars['bIsEdit']):  echo $this->_aVars['aForms']['button_top_gradient'];  else:  echo $this->_aVars['sDefaultColor'];  endif; ?>"></div>
				</div>
				<input type="hidden" id="color_picker_button_top_gradient_input" name="val[button_top_gradient]" <?php if ($this->_aVars['bIsEdit']): ?>value="<?php echo $this->_aVars['aForms']['button_top_gradient']; ?>"<?php else: ?>value="<?php echo $this->_aVars['sDefaultColor']; ?>"<?php endif; ?>/>
			</td>
			
			<td class="dvs_add_td_label">
<?php echo Phpfox::getPhrase('dvs.bottom_gradient'); ?>:
			</td>
			<td class="dvs_add_td">
				<div id="color_picker_button_bottom_gradient" class="colorSelector">	
					<div style="background-color: #<?php if ($this->_aVars['bIsEdit']):  echo $this->_aVars['aForms']['button_bottom_gradient'];  else:  echo $this->_aVars['sDefaultColor'];  endif; ?>"></div>
				</div>
				<input type="hidden" id="color_picker_button_bottom_gradient_input" name="val[button_bottom_gradient]" <?php if ($this->_aVars['bIsEdit']): ?>value="<?php echo $this->_aVars['aForms']['button_bottom_gradient']; ?>"<?php else: ?>value="<?php echo $this->_aVars['sDefaultColor']; ?>"<?php endif; ?>/>
			</td>
			
			<td class="dvs_add_td_label">
<?php echo Phpfox::getPhrase('dvs.border'); ?>:
			</td>
			<td class="dvs_add_td">
				<div id="color_picker_button_border" class="colorSelector">	
					<div style="background-color: #<?php if ($this->_aVars['bIsEdit']):  echo $this->_aVars['aForms']['button_border'];  else:  echo $this->_aVars['sDefaultColor'];  endif; ?>"></div>
				</div>
				<input type="hidden" id="color_picker_button_border_input" name="val[button_border]" <?php if ($this->_aVars['bIsEdit']): ?>value="<?php echo $this->_aVars['aForms']['button_border']; ?>"<?php else: ?>value="<?php echo $this->_aVars['sDefaultColor']; ?>"<?php endif; ?>/>
			</td>
			
		</tr>
	</table>
	<br>
    <h3>iFrame Styling</h3>
    <table>
        <tr class="tr_interactive">
            <td class="dvs_add_td_label">
                iFrame Background:
            </td>
            <td class="dvs_add_td">
                <div id="color_picker_iframe_background" class="colorSelector">
                    <div style="background-color: #<?php if ($this->_aVars['bIsEdit']):  echo $this->_aVars['aForms']['iframe_background'];  else:  echo $this->_aVars['sDefaultColor'];  endif; ?>"></div>
                </div>
                <input type="hidden" id="color_picker_iframe_background_input" name="val[iframe_background]" <?php if ($this->_aVars['bIsEdit']): ?>value="<?php echo $this->_aVars['aForms']['iframe_background']; ?>"<?php else: ?>value="<?php echo $this->_aVars['sDefaultColor']; ?>"<?php endif; ?>/>
            </td>

            <td class="dvs_add_td_label">
                iFrame Text:
            </td>
            <td class="dvs_add_td">
                <div id="color_picker_iframe_text" class="colorSelector">
                    <div style="background-color: #<?php if ($this->_aVars['bIsEdit']):  echo $this->_aVars['aForms']['iframe_text'];  else:  echo $this->_aVars['sDefaultColor'];  endif; ?>"></div>
                </div>
                <input type="hidden" id="color_picker_iframe_text_input" name="val[iframe_text]" <?php if ($this->_aVars['bIsEdit']): ?>value="<?php echo $this->_aVars['aForms']['iframe_text']; ?>"<?php else: ?>value="<?php echo $this->_aVars['sDefaultColor']; ?>"<?php endif; ?>/>
            </td>

            <td class="dvs_add_td_label">
                Contact Form Background:
            </td>
            <td class="dvs_add_td">
                <div id="color_picker_iframe_contact_background" class="colorSelector">
                    <div style="background-color: #<?php if ($this->_aVars['bIsEdit']):  echo $this->_aVars['aForms']['iframe_contact_background'];  else:  echo $this->_aVars['sDefaultColor'];  endif; ?>"></div>
                </div>
                <input type="hidden" id="color_picker_iframe_contact_background_input" name="val[iframe_contact_background]" <?php if ($this->_aVars['bIsEdit']): ?>value="<?php echo $this->_aVars['aForms']['iframe_contact_background']; ?>"<?php else: ?>value="<?php echo $this->_aVars['sDefaultColor']; ?>"<?php endif; ?>/>
            </td>

            <td class="dvs_add_td_label">
                Contact Form Text:
            </td>
            <td class="dvs_add_td">
                <div id="color_picker_iframe_contact_text" class="colorSelector">
                    <div style="background-color: #<?php if ($this->_aVars['bIsEdit']):  echo $this->_aVars['aForms']['iframe_contact_text'];  else:  echo $this->_aVars['sDefaultColor'];  endif; ?>"></div>
                </div>
                <input type="hidden" id="color_picker_iframe_contact_text_input" name="val[iframe_contact_text]" <?php if ($this->_aVars['bIsEdit']): ?>value="<?php echo $this->_aVars['aForms']['iframe_contact_text']; ?>"<?php else: ?>value="<?php echo $this->_aVars['sDefaultColor']; ?>"<?php endif; ?>/>
            </td>
        </tr>
    </table>

    <br>
    <h3>Virtual Test Drive Button</h3>
    <table>
        <tr class="tr_interactive">
            <td class="dvs_add_td_label">
                Top-gradient color:
            </td>
            <td class="dvs_add_td">
                <div id="color_picker_vin_top_gradient" class="colorSelector">
                    <div style="background-color: #<?php if ($this->_aVars['bIsEdit']):  echo $this->_aVars['aForms']['vin_top_gradient'];  else:  echo $this->_aVars['sDefaultColor'];  endif; ?>"></div>
                </div>
                <input type="hidden" id="color_picker_vin_top_gradient_input" name="val[vin_top_gradient]" <?php if ($this->_aVars['bIsEdit']): ?>value="<?php echo $this->_aVars['aForms']['vin_top_gradient']; ?>"<?php else: ?>value="A764C5"<?php endif; ?>/>
            </td>

            <td style="padding-left: 20px; width: 145px;" class="dvs_add_td_label">
                Bottom-gradient color:
            </td>
            <td class="dvs_add_td">
                <div id="color_picker_vin_bottom_gradient" class="colorSelector">
                    <div style="background-color: #<?php if ($this->_aVars['bIsEdit']):  echo $this->_aVars['aForms']['vin_bottom_gradient'];  else:  echo $this->_aVars['sDefaultColor'];  endif; ?>"></div>
                </div>
                <input type="hidden" id="color_picker_vin_bottom_gradient_input" name="val[vin_bottom_gradient]" <?php if ($this->_aVars['bIsEdit']): ?>value="<?php echo $this->_aVars['aForms']['vin_bottom_gradient']; ?>"<?php else: ?>value="451656"<?php endif; ?>/>
            </td>
        </tr>

        <tr style="line-height: 45px;" class="tr_interactive">
            <td class="dvs_add_td_label">
                Font-Size:
            </td>
            <td colspan="3" class="dvs_add_td">
                <input type="text" id="vin_font_size" name="val[vin_font_size]" <?php if ($this->_aVars['bIsEdit']): ?>value="<?php echo $this->_aVars['aForms']['vin_font_size']; ?>"<?php else: ?>value="12px"<?php endif; ?>/>
            </td>
        </tr>


        <tr style="line-height: 45px;" class="tr_interactive">
            <td class="dvs_add_td_label">
                Button label:
            </td>
            <td colspan="3" class="dvs_add_td">
                <input type="text" id="vin_button_label" name="val[vin_button_label]" <?php if ($this->_aVars['bIsEdit']): ?>value="<?php echo $this->_aVars['aForms']['vin_button_label']; ?>"<?php else: ?>value="Virtual Test Drive"<?php endif; ?>/>
            </td>
        </tr>
    </table>
    </div>
    <br>
	<input type="hidden" name="val[step]" value="customize" />
	<input type="hidden" name="val[is_edit]" value="<?php if ($this->_aVars['bIsEdit'] && isset ( $this->_aVars['aForms']['dvs_id'] )): ?>1<?php else: ?>0<?php endif; ?>" />
	<input type="hidden" name="val[dvs_id]" value="<?php echo $this->_aVars['iDvsId']; ?>" />
	<input type="button" value="<?php if ($this->_aVars['bIsEdit'] && isset ( $this->_aVars['aForms']['dvs_id'] )):  echo Phpfox::getPhrase('dvs.save_changes');  else:  echo Phpfox::getPhrase('dvs.save_and_continue');  endif; ?>" class="button" onclick="$('#add_dvs_customize').submit();" />

</form>



