<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 21, 2014, 8:28 pm */ ?>
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
<div id="dvs_error_messages"></div>
<?php if ($this->_aVars['bCanAddPlayers'] || $this->_aVars['bIsEdit']): ?>
<script type="text/javascript">
			var iSelectedMakes = 0;
<?php if ($this->_aVars['bIsEdit']): ?>
<?php if (count((array)$this->_aVars['aMakes'])):  foreach ((array) $this->_aVars['aMakes'] as $this->_aVars['aMake']): ?>
<?php if (isset ( $this->_aVars['aMake']['selected'] ) && $this->_aVars['aMake']['selected']): ?>
	iSelectedMakes++;
<?php endif; ?>
<?php endforeach; endif; ?>
<?php endif; ?>

<?php if ($this->_aVars['bIsEdit']): ?>
	$Behavior.colorPick = function() {
	$('#color_picker_player_background').ColorPickerSetColor('#<?php echo $this->_aVars['aForms']['player_background']; ?>');
			$('#color_picker_player_text').ColorPickerSetColor('#<?php echo $this->_aVars['aForms']['player_text']; ?>');
			$('#color_picker_player_buttons').ColorPickerSetColor('#<?php echo $this->_aVars['aForms']['player_buttons']; ?>');
			$('#color_picker_player_progress_bar').ColorPickerSetColor('#<?php echo $this->_aVars['aForms']['player_progress_bar']; ?>');
			$('#color_picker_player_button_icons').ColorPickerSetColor('#<?php echo $this->_aVars['aForms']['player_button_icons']; ?>');
			$('#color_picker_playlist_arrows').ColorPickerSetColor('#<?php echo $this->_aVars['aForms']['playlist_arrows']; ?>');
			$('#color_picker_playlist_border').ColorPickerSetColor('#<?php echo $this->_aVars['aForms']['playlist_border']; ?>');
<?php if ($this->_aVars['aForms']['player_type']): ?>
	iPreviewWidth = 640;
			iPreviewHeight = 360;
<?php else: ?>
	iPreviewWidth = 920;
			iPreviewHeight = 522;
<?php endif; ?>
	}
<?php else: ?>
	$Behavior.colorPicker = function() {
	$('#color_picker_player_background').ColorPickerSetColor('#<?php echo $this->_aVars['sDefaultColor']; ?>');
			$('#color_picker_player_text').ColorPickerSetColor('#<?php echo $this->_aVars['sDefaultColor']; ?>');
			$('#color_picker_player_buttons').ColorPickerSetColor('#<?php echo $this->_aVars['sDefaultColor']; ?>');
			$('#color_picker_player_progress_bar').ColorPickerSetColor('#<?php echo $this->_aVars['sDefaultColor']; ?>');
			$('#color_picker_player_button_icons').ColorPickerSetColor('#<?php echo $this->_aVars['sDefaultColor']; ?>');
			$('#color_picker_playlist_arrows').ColorPickerSetColor('#<?php echo $this->_aVars['sDefaultColor']; ?>');
			$('#color_picker_playlist_border').ColorPickerSetColor('#<?php echo $this->_aVars['sDefaultColor']; ?>');
			iPreviewWidth = 910;
			iPreviewHeight = 522;
	}
<?php endif; ?>

	<?php echo '
	$Behavior.multiSelect = function() {
	$("#makes").multiselect({
	header: false,
			click: function(event, ui){
			$(\'#make_select_\' + ui.value).val((ui.checked ? 1 : 0));
					if (ui.checked)
			{
			iSelectedMakes++;
			}
			else
			{
			iSelectedMakes = iSelectedMakes - 1; ;
			}
			}
	});
	}
	function validateDvsForm()
	{
	clearErrors();
			if (iSelectedMakes <= 0)
	{
	validateError("';  echo Phpfox::getPhrase('dvs.please_select_a_make_first');  echo '", \'makes\');
	}

	return window.bIsValid
	}

	'; ?>

</script>
<form id="add_player" method="post" action="<?php if ($this->_aVars['bIsDvs']):  echo Phpfox::getLib('phpfox.url')->makeUrl('dvs.player.add');  else:  echo Phpfox::getLib('phpfox.url')->makeUrl('idrive.add');  endif; ?>" onsubmit="return validateDvsForm();">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>

	<h3><?php echo Phpfox::getPhrase('dvs.player_info'); ?></h3>

	<fieldset>
		<ol>
<?php if (! $this->_aVars['bIsDvs']): ?>
			<li>
				<label for="player_name"><?php echo Phpfox::getPhrase('dvs.player_name'); ?>:</label>
				<input type="text" name="val[player_name]" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['player_name']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['player_name']) : (isset($this->_aVars['aForms']['player_name']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['player_name']) : '')); ?>
" id="player_name" />
			</li>
			<li>
				<label for="player_type"><?php echo Phpfox::getPhrase('idrive.player_type'); ?>:</label>
				<select name="val[player_type]" id="player_type" onchange="newPlayerType($('#player_type').val())">
<?php if (Phpfox ::getUserParam('idrive.enable_interactive_player')): ?><option value="0" <?php if (isset ( $this->_aVars['aForms'] ) && $this->_aVars['aForms']['player_type'] == 0): ?>selected="selected"<?php endif; ?>}><?php echo Phpfox::getPhrase('idrive.interactive'); ?></option><?php endif; ?>
<?php if (Phpfox ::getUserParam('idrive.single_player')): ?><option value="1" <?php if (isset ( $this->_aVars['aForms'] ) && $this->_aVars['aForms']['player_type'] == 1): ?>selected="selected"<?php endif; ?>}><?php echo Phpfox::getPhrase('idrive.single'); ?></option><?php endif; ?>
				</select>
				<a href="#" onclick="tb_show('<?php echo Phpfox::getPhrase('idrive.player_type', array('phpfox_squote' => true)); ?>', $.ajaxBox('idrive.moreInfoPlayerType', 'height=180&amp;width=320')); return false;" /><?php echo Phpfox::getPhrase('idrive.more_info'); ?></a>
			</li>
			
<?php else: ?>
			<input type="hidden" name="val[player_type]" value="0" />
<?php endif; ?>
			
			<li <?php if (Phpfox ::isAdmin()):  else: ?>style="display:none;"<?php endif; ?>>
				<label for="makes"><?php echo Phpfox::getPhrase('dvs.make'); ?>:</label>
				<select name="val[makes]" id="makes" onchange="$.ajaxCall('dvs.getFeaturedModels', 'iDvs=<?php echo $this->_aVars['iDvsId']; ?>&aMakes=' + $('#makes').val());" multiple="multiple">
<?php if (count((array)$this->_aVars['aMakes'])):  foreach ((array) $this->_aVars['aMakes'] as $this->_aVars['aMake']): ?>
					<option value="<?php echo $this->_aVars['aMake']['make']; ?>"<?php if ($this->_aVars['bIsEdit'] && isset ( $this->_aVars['aMake']['selected'] )): ?> selected="selected"<?php endif; ?>><?php echo $this->_aVars['aMake']['make']; ?></option>
<?php endforeach; endif; ?>
				</select>
<?php if (count((array)$this->_aVars['aMakes'])):  foreach ((array) $this->_aVars['aMakes'] as $this->_aVars['aMake']): ?>
				<input type="hidden" value="<?php if ($this->_aVars['bIsEdit']):  if (isset ( $this->_aVars['aMake']['selected'] ) && $this->_aVars['aMake']['selected']): ?>1<?php else: ?>0<?php endif;  else: ?>0<?php endif; ?>" name="val[selected_makes][<?php echo $this->_aVars['aMake']['make']; ?>]" id="make_select_<?php echo $this->_aVars['aMake']['make']; ?>" class="player_make_select"/>
<?php endforeach; endif; ?>
			</li>
			
			<li>
				<label for="featured_model"><?php echo Phpfox::getPhrase('dvs.featured_model'); ?>:</label>
				<div id="dvs_vehicle_select_model_container">
					<select id="featured_model" name="val[featured_model]">
<?php if ($this->_aVars['bIsEdit']): ?>
						<option><?php echo Phpfox::getPhrase('dvs.select_model'); ?></option>
<?php if (count((array)$this->_aVars['aModels'])):  foreach ((array) $this->_aVars['aModels'] as $this->_aVars['aModel']): ?>
						<option value="<?php echo $this->_aVars['aModel']['year']; ?>,<?php echo $this->_aVars['aModel']['make']; ?>,<?php echo $this->_aVars['aModel']['model']; ?>"<?php if ($this->_aVars['aForms']['featured_model'] == $this->_aVars['aModel']['model'] && $this->_aVars['aForms']['featured_year'] == $this->_aVars['aModel']['year']): ?>selected="selected"<?php endif; ?>><?php echo $this->_aVars['aModel']['year']; ?> <?php echo $this->_aVars['aModel']['make']; ?> <?php echo $this->_aVars['aModel']['model']; ?></option>
<?php endforeach; endif; ?>
<?php else: ?>
						<option><?php echo Phpfox::getPhrase('dvs.select_model'); ?></option>
						<option><?php echo Phpfox::getPhrase('dvs.please_select_a_make_first'); ?></option>
<?php endif; ?>
					</select>
				</div>
			</li>

<?php if (! $this->_aVars['bIsDvs']): ?>
			<li>
				<label for="google_id"><?php echo Phpfox::getPhrase('dvs.google_analytics_id'); ?>:</label>
				<input type="text" name="val[google_id]" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['google_id']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['google_id']) : (isset($this->_aVars['aForms']['google_id']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['google_id']) : '')); ?>
" id="google_id" />
			</li>
			<li>
				<label for="email"><?php echo Phpfox::getPhrase('idrive.email_address'); ?>:</label>
				<input type="text" name="val[email]" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['email']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['email']) : (isset($this->_aVars['aForms']['email']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['email']) : '')); ?>
" id="email" />		
			</li>
<?php endif; ?>
			
<?php if (! $this->_aVars['bIsDvs']): ?>
			<li>
				<label for="autoplay"><?php echo Phpfox::getPhrase('dvs.autoplay'); ?>:</label>
				<input type="checkbox" name="val[autoplay]" id="autoplay" value="1" <?php if ($this->_aVars['bIsEdit']):  if ($this->_aVars['aForms']['autoplay']): ?>checked=checked<?php endif;  endif; ?>/>
			</li>
<?php endif; ?>
			<!--phpmasterminds Auto play setting for base URL -->
			<li <?php if (Phpfox ::isAdmin()):  else: ?>style="display:none;"<?php endif; ?>>
				<label for="autoplay_baseurl">Autoplay Base URL:</label>
				<input type="checkbox" name="val[autoplay_baseurl]" id="autoplay_baseurl" value="1" <?php if ($this->_aVars['bIsEdit']):  if ($this->_aVars['aForms']['autoplay_baseurl']): ?>checked=checked<?php endif;  endif; ?>/>
			</li>
			<li <?php if (Phpfox ::isAdmin()):  else: ?>style="display:none;"<?php endif; ?>>
				<label for="autoplay_videourl">Autoplay Video URL:</label>
				<input type="checkbox" name="val[autoplay_videourl]" id="autoplay_videourl" value="1" <?php if ($this->_aVars['bIsEdit']):  if ($this->_aVars['aForms']['autoplay_videourl']): ?>checked=checked<?php endif;  endif; ?>/>
			</li>
			<!--phpmasterminds Auto play setting for base URL -->
			<li>
				<label for="autoadvance"><?php echo Phpfox::getPhrase('dvs.auto_advance'); ?>:</label>
				<input type="checkbox" name="val[autoadvance]" id="autoadvance" value="1" <?php if ($this->_aVars['bIsEdit']):  if ($this->_aVars['aForms']['autoadvance']): ?>checked=checked<?php endif;  endif; ?>/>
			</li>
		</ol>
	</fieldset>
	
	<div <?php if (Phpfox ::isAdmin()):  else: ?>style="display:none;"<?php endif; ?>>
	<h3><?php echo Phpfox::getPhrase('dvs.player_colors'); ?></h3>

	<fieldset class="color_selectors">
		<legend><?php echo Phpfox::getPhrase('dvs.player'); ?></legend>
		<ol>
			<li>
				<label><?php echo Phpfox::getPhrase('dvs.background'); ?>:</label>
				<div id="color_picker_player_background" class="colorSelector">	
					<div style="background-color: #<?php if ($this->_aVars['bIsEdit']):  echo $this->_aVars['aForms']['player_background'];  else:  echo $this->_aVars['sDefaultColor'];  endif; ?>"></div>
				</div>
				<input type="hidden" id="color_picker_player_background_input" name="val[player_background]" <?php if ($this->_aVars['bIsEdit']): ?>value="<?php echo $this->_aVars['aForms']['player_background']; ?>"<?php else: ?>value="<?php echo $this->_aVars['sDefaultColor']; ?>"<?php endif; ?>/>
			</li>
			<li>
				<label><?php echo Phpfox::getPhrase('dvs.text'); ?>:</label>
				<div id="color_picker_player_text" class="colorSelector">	
					<div style="background-color: #<?php if ($this->_aVars['bIsEdit']):  echo $this->_aVars['aForms']['player_text'];  else:  echo $this->_aVars['sDefaultColor'];  endif; ?>"></div>
				</div>
				<input type="hidden" id="color_picker_player_text_input" name="val[player_text]"  <?php if ($this->_aVars['bIsEdit']): ?>value="<?php echo $this->_aVars['aForms']['player_text']; ?>"<?php else: ?>value="<?php echo $this->_aVars['sDefaultColor']; ?>"<?php endif; ?>/>
			</li>
		</ol>
	</fieldset>

	<fieldset>
		<legend><?php echo Phpfox::getPhrase('dvs.player_controls'); ?></legend>
		<ol>
			<li>
				<label><?php echo Phpfox::getPhrase('dvs.buttons'); ?>:</label>
				<div id="color_picker_player_buttons" class="colorSelector">	
					<div style="background-color: #<?php if ($this->_aVars['bIsEdit']):  echo $this->_aVars['aForms']['player_buttons'];  else:  echo $this->_aVars['sDefaultColor'];  endif; ?>"></div>
				</div>
				<input type="hidden" id="color_picker_player_buttons_input" name="val[player_buttons]" <?php if ($this->_aVars['bIsEdit']): ?>value="<?php echo $this->_aVars['aForms']['player_buttons']; ?>"<?php else: ?>value="<?php echo $this->_aVars['sDefaultColor']; ?>"<?php endif; ?>/>
			</li>
			<li>
				<label><?php echo Phpfox::getPhrase('dvs.button_icons'); ?>:</label>
				<div id="color_picker_player_button_icons" class="colorSelector">	
					<div style="background-color: #<?php if ($this->_aVars['bIsEdit']):  echo $this->_aVars['aForms']['player_button_icons'];  else:  echo $this->_aVars['sDefaultColor'];  endif; ?>"></div>
				</div>
				<input type="hidden" id="color_picker_player_button_icons_input" name="val[player_button_icons]" <?php if ($this->_aVars['bIsEdit']): ?>value="<?php echo $this->_aVars['aForms']['player_button_icons']; ?>"<?php else: ?>value="<?php echo $this->_aVars['sDefaultColor']; ?>"<?php endif; ?>/>
			</li>
			<li>
				<label><?php echo Phpfox::getPhrase('dvs.progress_bar'); ?>:</label>
				<div id="color_picker_player_progress_bar" class="colorSelector">	
					<div style="background-color: #<?php if ($this->_aVars['bIsEdit']):  echo $this->_aVars['aForms']['player_progress_bar'];  else:  echo $this->_aVars['sDefaultColor'];  endif; ?>"></div>
				</div>
				<input type="hidden" id="color_picker_player_progress_bar_input" name="val[player_progress_bar]" <?php if ($this->_aVars['bIsEdit']): ?>value="<?php echo $this->_aVars['aForms']['player_progress_bar']; ?>"<?php else: ?>value="<?php echo $this->_aVars['sDefaultColor']; ?>"<?php endif; ?>/>
			</li>
		</ol>
	</fieldset>
	<fieldset>
		<legend><?php echo Phpfox::getPhrase('dvs.thumbnail_playlist'); ?></legend>
		<ol>
			<li>
				<label><?php echo Phpfox::getPhrase('dvs.prev_next_arrows'); ?>:</label>
				<div id="color_picker_playlist_arrows" class="colorSelector">	
					<div style="background-color: #<?php if ($this->_aVars['bIsEdit']):  echo $this->_aVars['aForms']['playlist_arrows'];  else:  echo $this->_aVars['sDefaultColor'];  endif; ?>"></div>
				</div>
				<input type="hidden" id="color_picker_playlist_arrows_input" name="val[playlist_arrows]" <?php if ($this->_aVars['bIsEdit']): ?>value="<?php echo $this->_aVars['aForms']['playlist_arrows']; ?>"<?php else: ?>value="<?php echo $this->_aVars['sDefaultColor']; ?>"<?php endif; ?>/>
			</li>
			<li>
				<label><?php echo Phpfox::getPhrase('dvs.thumbnail_border'); ?>:</label>
				<div id="color_picker_playlist_border" class="colorSelector">	
					<div style="background-color: #<?php if ($this->_aVars['bIsEdit']):  echo $this->_aVars['aForms']['playlist_border'];  else:  echo $this->_aVars['sDefaultColor'];  endif; ?>"></div>
				</div>
				<input type="hidden" id="color_picker_playlist_border_input" name="val[playlist_border]" <?php if ($this->_aVars['bIsEdit']): ?>value="<?php echo $this->_aVars['aForms']['playlist_border']; ?>"<?php else: ?>value="<?php echo $this->_aVars['sDefaultColor']; ?>"<?php endif; ?>/>
			</li>
		</ol>
	</fieldset>
	</div>
	
	<h3><?php echo Phpfox::getPhrase('dvs.player_branding'); ?></h3>

	<fieldset>
		<legend><?php echo Phpfox::getPhrase('dvs.pre_roll'); ?>:</legend>
		<ol>
			<li>
				<a href="#" onclick="tb_show('<?php echo Phpfox::getPhrase('dvs.pre_roll', array('phpfox_squote' => true)); ?>', $.ajaxBox('dvs.moreInfoPrerollSwf', 'height=180&amp;width=320')); return false;">Pre-Roll Help</a>
			</li>
			<li>
<?php if ($this->_aVars['bIsEdit']): ?>
				<label id="preroll_file_label"><?php echo Phpfox::getPhrase('dvs.current_file'); ?>:</label>
<?php else: ?>
				<label id="preroll_file_label"><?php echo Phpfox::getPhrase('dvs.select_file'); ?>:</label>
<?php endif; ?>

				<div id="js_preroll_file_upload_error" style="display:none;">
					<div class="error_message" id="js_preroll_file_upload_message"></div>		
					<div class="main_break"></div>
				</div>
				<iframe id="js_preroll_upload_frame" name="js_preroll_upload_frame" src="<?php if ($this->_aVars['bIsDvs']):  echo Phpfox::getLib('phpfox.url')->makeUrl('dvs.player.preroll-file-form');  else:  echo Phpfox::getLib('phpfox.url')->makeUrl('idrive.preroll-file-form');  endif;  if ($this->_aVars['bIsEdit']): ?>current-preroll-id_<?php echo $this->_aVars['aForms']['preroll_file_id'];  endif; ?>" scrolling="no" frameborder="0" width="256" height="36" <?php if ($this->_aVars['bIsEdit']): ?>style="display:none;"<?php endif; ?>></iframe>
				<div id="preroll_file_preview" <?php if (! $this->_aVars['bIsEdit']): ?>style="display: none"<?php endif; ?>>
<?php if ($this->_aVars['bIsEdit']): ?>
<?php if ($this->_aVars['aForms']['preroll_file_name']): ?>
					 <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0">
						<param name="allowfullscreen" value="true" />
						<param name="movie" value="<?php echo $this->_aVars['sSwfUrl']; ?>player.swf" />
						<param name="flashvars" value="<?php if ($this->_aVars['bIsDvs']):  echo $this->_aVars['sDvsUrl'];  else:  echo $this->_aVars['sIdriveUrl'];  endif; ?>preroll/<?php echo $this->_aVars['aForms']['preroll_file_name']; ?>" />	
						<param name="wmode" value="opaque" />
						<embed wmode="opaque" allowfullscreen="true" type="application/x-shockwave-flash" src="<?php echo $this->_aVars['sSwfUrl']; ?>player.swf" pluginspage="http://www.macromedia.com/go/getflashplayer" flashvars="file=<?php if ($this->_aVars['bIsDvs']):  echo $this->_aVars['sDvsUrl'];  else:  echo $this->_aVars['sIdriveUrl'];  endif; ?>preroll/<?php echo $this->_aVars['aForms']['preroll_file_name']; ?>" />
					</object>
<?php else: ?>
<?php echo Phpfox::getPhrase('dvs.no_pre_roll_swf'); ?>
<?php endif; ?>
					<a href="#" onclick="window.parent.document.getElementById('preroll_file_label').innerHTML = '<?php echo Phpfox::getPhrase('dvs.select_file'); ?>:'; window.parent.document.getElementById('js_preroll_upload_frame').style.display = 'block'; window.parent.document.getElementById('preroll_file_preview').style.display = 'none'; return false;"><?php echo Phpfox::getPhrase('dvs.change_pre_roll_swf'); ?></a> - <a href="#" onclick="if (confirm('Are you sure?')){window.parent.document.getElementById('preroll_file_label').innerHTML = '<?php echo Phpfox::getPhrase('dvs.select_file'); ?>:'; window.parent.document.getElementById('js_preroll_upload_frame').style.display = 'block'; window.parent.document.getElementById('preroll_file_preview').style.display = 'none'; window.parent.document.getElementById('preroll_file_id').value = 0; $.ajaxCall('<?php if ($this->_aVars['bIsDvs']): ?>dvs<?php else: ?>idrive<?php endif; ?>.removePrerollFile', 'iPrerollFileId=<?php echo $this->_aVars['aForms']['preroll_file_id']; ?>')} return false;"><?php echo Phpfox::getPhrase('dvs.remove_preroll_image'); ?></a>
<?php endif; ?>
				</div>
				<input type="hidden" id="preroll_file_id" name="val[preroll_file_id]" value="<?php if ($this->_aVars['bIsEdit']):  echo $this->_aVars['aForms']['preroll_file_id'];  else: ?>0<?php endif; ?>"/>
			</li>
			
			<li>
				<label for="preroll_duration"><?php echo Phpfox::getPhrase('dvs.pre_roll_duration'); ?>:</label>
				<input type="number" name="val[preroll_duration]" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['preroll_duration']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['preroll_duration']) : (isset($this->_aVars['aForms']['preroll_duration']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['preroll_duration']) : '')); ?>
" id="preroll_duration" size="10" maxlength=3 />
			</li>
			<li>
				<label for="preroll_url"><?php echo Phpfox::getPhrase('dvs.pre_roll_url'); ?>:</label>
				<input type="text" name="val[preroll_url]" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['preroll_url']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['preroll_url']) : (isset($this->_aVars['aForms']['preroll_url']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['preroll_url']) : '')); ?>
" id="preroll_url" size="40"/>
				
			</li>
		</ol>
	</fieldset>

<?php if ($this->_aVars['bIsDvs']): ?>
	<div id="custom_overlay_input_container">

		<h3><?php echo Phpfox::getPhrase('dvs.custom_video_overlays'); ?></h3>

		<fieldset>
			<legend><?php echo Phpfox::getPhrase('dvs.custom_overlay_1'); ?>:</legend>
			<ol>
				<li>
					<label for="custom_overlay_1_disabled" class="inline_radio">Disabled:</label> 
					<input type="radio" class="inline_radio" onchange="if ($(this).attr('checked') == 'checked')$('.custom_overlay_1_extras1').hide('fast');if ($(this).attr('checked') == 'checked')$('.custom_overlay_1_extras2').hide('fast');" <?php if ($this->_aVars['bIsEdit'] && isset ( $this->_aVars['aForms']['custom_overlay_1_type'] ) && $this->_aVars['aForms']['custom_overlay_1_type'] == 0): ?>checked="checked"<?php endif; ?> value="0" name="val[custom_overlay_1_type]" id="custom_overlay_1_disabled" />

						   <label for="custom_overlay_1_price_overlay" class="inline_radio">Get Price Overlay:</label> 
					<input type="radio" class="inline_radio" onchange="if ($(this).attr('checked') == 'checked')$('.custom_overlay_1_extras1').hide('fast');if ($(this).attr('checked') == 'checked')$('.custom_overlay_1_extras2').show('fast');" <?php if ($this->_aVars['bIsEdit'] && isset ( $this->_aVars['aForms']['custom_overlay_1_type'] ) && $this->_aVars['aForms']['custom_overlay_1_type'] == 1): ?>checked="checked"<?php endif; ?> value="1" name="val[custom_overlay_1_type]" id="custom_overlay_1_price_overlay" />

						   <label for="custom_overlay_1_link_overlay" class="inline_radio">Link Overlay:</label> 
					<input type="radio" class="inline_radio" onchange="if ($(this).attr('checked') == 'checked')$('.custom_overlay_1_extras1').show('fast');if ($(this).attr('checked') == 'checked')$('.custom_overlay_1_extras2').show('fast');" <?php if ($this->_aVars['bIsEdit'] && isset ( $this->_aVars['aForms']['custom_overlay_1_type'] ) && $this->_aVars['aForms']['custom_overlay_1_type'] == 2 || ! isset ( $this->_aVars['aForms']['custom_overlay_1_type'] )): ?>checked="checked"<?php endif; ?> value="2" name="val[custom_overlay_1_type]" id="custom_overlay_1_link_overlay" />
				</li>
				<li class="custom_overlay_1_extras1 <?php if (isset ( $this->_aVars['aForms']['custom_overlay_1_type'] ) && $this->_aVars['aForms']['custom_overlay_1_type'] != 2): ?>hidden<?php endif; ?>">
					<label for="custom_overlay_1_text">Link Text:</label>
					<input type="text" name="val[custom_overlay_1_text]" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['custom_overlay_1_text']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['custom_overlay_1_text']) : (isset($this->_aVars['aForms']['custom_overlay_1_text']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['custom_overlay_1_text']) : '')); ?>
" id="custom_overlay_1_text" class="m_left_5"/>
				</li>
				<li class="custom_overlay_1_extras1 <?php if (isset ( $this->_aVars['aForms']['custom_overlay_1_type'] ) && $this->_aVars['aForms']['custom_overlay_1_type'] != 2): ?>hidden<?php endif; ?>">
					<label for="custom_overlay_1_url">Link URL:</label>
					<input type="text" name="val[custom_overlay_1_url]" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['custom_overlay_1_url']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['custom_overlay_1_url']) : (isset($this->_aVars['aForms']['custom_overlay_1_url']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['custom_overlay_1_url']) : '')); ?>
" id="custom_overlay_1_url" class="m_top_left_5" />
				</li>
				<li class="custom_overlay_1_extras2 <?php if (isset ( $this->_aVars['aForms']['custom_overlay_1_type'] ) && $this->_aVars['aForms']['custom_overlay_1_type'] == 0): ?>hidden<?php endif; ?>">
					<label for="custom_overlay_1_start">Start Time (seconds):</label>
					<input type="text" name="val[custom_overlay_1_start]" value="<?php if ($this->_aVars['bIsEdit'] && isset ( $this->_aVars['aForms']['custom_overlay_1_start'] ) && $this->_aVars['aForms']['custom_overlay_1_start']):  echo $this->_aVars['aForms']['custom_overlay_1_start'];  else: ?>5<?php endif; ?>" id="custom_overlay_1_start" class="m_top_left_5" size="5"/>
				</li>
				<li class="custom_overlay_1_extras2 <?php if (isset ( $this->_aVars['aForms']['custom_overlay_1_type'] ) && $this->_aVars['aForms']['custom_overlay_1_type'] == 0): ?>hidden<?php endif; ?>">
					<label for="custom_overlay_1_duration">Duration (seconds):</label>
					<input type="text" name="val[custom_overlay_1_duration]" value="<?php if ($this->_aVars['bIsEdit'] && isset ( $this->_aVars['aForms']['custom_overlay_1_duration'] ) && $this->_aVars['aForms']['custom_overlay_1_duration']):  echo $this->_aVars['aForms']['custom_overlay_1_duration'];  else: ?>10<?php endif; ?>" id="custom_overlay_1_duration" class="m_top_left_5" size="5"/>
				</li>
			</ol>
		</fieldset>
		<fieldset>

			<legend><?php echo Phpfox::getPhrase('dvs.custom_overlay_2'); ?>:</legend>
			<ol>
				<li>
					<label for="custom_overlay_2_disabled" class="inline_radio">Disabled:</label> 
					<input type="radio" class="inline_radio" onchange="if ($(this).attr('checked') == 'checked')$('.custom_overlay_2_extras1').hide('fast');if ($(this).attr('checked') == 'checked')$('.custom_overlay_2_extras2').hide('fast');" <?php if ($this->_aVars['bIsEdit'] && isset ( $this->_aVars['aForms']['custom_overlay_2_type'] ) && $this->_aVars['aForms']['custom_overlay_2_type'] == 0): ?>checked="checked"<?php endif; ?> value="0" name="val[custom_overlay_2_type]" id="custom_overlay_2_disabled" />

						   <label for="custom_overlay_2_price_overlay" class="inline_radio">Get Price Overlay:</label> 
					<input type="radio" class="inline_radio" onchange="if ($(this).attr('checked') == 'checked')$('.custom_overlay_2_extras1').hide('fast');if ($(this).attr('checked') == 'checked')$('.custom_overlay_2_extras2').show('fast');" <?php if ($this->_aVars['bIsEdit'] && isset ( $this->_aVars['aForms']['custom_overlay_2_type'] ) && $this->_aVars['aForms']['custom_overlay_2_type'] == 1): ?>checked="checked"<?php endif; ?> value="1" name="val[custom_overlay_2_type]" id="custom_overlay_2_price_overlay" />

						   <label for="custom_overlay_2_link_overlay" class="inline_radio">Link Overlay:</label> 
					<input type="radio" class="inline_radio" onchange="if ($(this).attr('checked') == 'checked')$('.custom_overlay_2_extras1').show('fast');if ($(this).attr('checked') == 'checked')$('.custom_overlay_2_extras2').show('fast');" <?php if ($this->_aVars['bIsEdit'] && isset ( $this->_aVars['aForms']['custom_overlay_2_type'] ) && $this->_aVars['aForms']['custom_overlay_2_type'] == 2 || ! isset ( $this->_aVars['aForms']['custom_overlay_2_type'] )): ?>checked="checked"<?php endif; ?> value="2" name="val[custom_overlay_2_type]" id="custom_overlay_2_link_overlay" />
				</li>
				<li class="custom_overlay_2_extras1 <?php if (isset ( $this->_aVars['aForms']['custom_overlay_2_type'] ) && $this->_aVars['aForms']['custom_overlay_2_type'] != 2): ?>hidden<?php endif; ?>">
					<label for="custom_overlay_2_text">Link Text:</label>
					<input type="text" name="val[custom_overlay_2_text]" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['custom_overlay_2_text']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['custom_overlay_2_text']) : (isset($this->_aVars['aForms']['custom_overlay_2_text']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['custom_overlay_2_text']) : '')); ?>
" id="custom_overlay_2_text" class="m_left_5" />
				</li>
				<li class="custom_overlay_2_extras1 <?php if (isset ( $this->_aVars['aForms']['custom_overlay_2_type'] ) && $this->_aVars['aForms']['custom_overlay_2_type'] != 2): ?>hidden<?php endif; ?>">
					<label for="custom_overlay_2_url">Link URL:</label>
					<input type="text" name="val[custom_overlay_2_url]" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['custom_overlay_2_url']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['custom_overlay_2_url']) : (isset($this->_aVars['aForms']['custom_overlay_2_url']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['custom_overlay_2_url']) : '')); ?>
" id="custom_overlay_2_url" class="m_top_left_5" />
				</li>
				<li class="custom_overlay_2_extras2 <?php if (isset ( $this->_aVars['aForms']['custom_overlay_2_type'] ) && $this->_aVars['aForms']['custom_overlay_2_type'] == 0): ?>hidden<?php endif; ?>">
					<label for="custom_overlay_2_start">Start Time (seconds):</label>
					<input type="text" name="val[custom_overlay_2_start]" value="<?php if ($this->_aVars['bIsEdit'] && isset ( $this->_aVars['aForms']['custom_overlay_2_start'] ) && $this->_aVars['aForms']['custom_overlay_2_start']):  echo $this->_aVars['aForms']['custom_overlay_2_start'];  else: ?>35<?php endif; ?>" id="custom_overlay_2_start" class="m_top_left_5" size="5"/>
				</li>
				<li class="custom_overlay_2_extras2 <?php if (isset ( $this->_aVars['aForms']['custom_overlay_2_type'] ) && $this->_aVars['aForms']['custom_overlay_2_type'] == 0): ?>hidden<?php endif; ?>">
					<label for="custom_overlay_2_duration">Duration (seconds):</label>
					<input type="text" name="val[custom_overlay_2_duration]" value="<?php if ($this->_aVars['bIsEdit'] && isset ( $this->_aVars['aForms']['custom_overlay_2_duration'] ) && $this->_aVars['aForms']['custom_overlay_2_duration']):  echo $this->_aVars['aForms']['custom_overlay_2_duration'];  else: ?>10<?php endif; ?>" id="custom_overlay_2_duration" class="m_top_left_5" size="5"/>
				</li>
			</ol>
		</fieldset>
		<fieldset>
			<legend><?php echo Phpfox::getPhrase('dvs.custom_overlay_3'); ?>:</legend>
			<ol>
				<li>

					<label for="custom_overlay_3_disabled" class="inline_radio">Disabled:</label> 
					<input type="radio" class="inline_radio" onchange="if ($(this).attr('checked') == 'checked')$('.custom_overlay_3_extras1').hide('fast');if ($(this).attr('checked') == 'checked')$('.custom_overlay_3_extras2').hide('fast');" <?php if ($this->_aVars['bIsEdit'] && isset ( $this->_aVars['aForms']['custom_overlay_3_type'] ) && $this->_aVars['aForms']['custom_overlay_3_type'] == 0): ?>checked="checked"<?php endif; ?> value="0" name="val[custom_overlay_3_type]" id="custom_overlay_3_disabled" />

						   <label for="custom_overlay_3_price_overlay" class="inline_radio">Get Price Overlay:</label> 
					<input type="radio" class="inline_radio" onchange="if ($(this).attr('checked') == 'checked')$('.custom_overlay_3_extras1').hide('fast');if ($(this).attr('checked') == 'checked')$('.custom_overlay_3_extras2').show('fast');" <?php if ($this->_aVars['bIsEdit'] && isset ( $this->_aVars['aForms']['custom_overlay_3_type'] ) && $this->_aVars['aForms']['custom_overlay_3_type'] == 1): ?>checked="checked"<?php endif; ?> value="1" name="val[custom_overlay_3_type]" id="custom_overlay_3_price_overlay" />

						   <label for="custom_overlay_3_link_overlay" class="inline_radio">Link Overlay:</label> 
					<input type="radio" class="inline_radio" onchange="if ($(this).attr('checked') == 'checked')$('.custom_overlay_3_extras1').show('fast');if ($(this).attr('checked') == 'checked')$('.custom_overlay_3_extras2').show('fast');" <?php if ($this->_aVars['bIsEdit'] && isset ( $this->_aVars['aForms']['custom_overlay_3_type'] ) && $this->_aVars['aForms']['custom_overlay_3_type'] == 2 || ! isset ( $this->_aVars['aForms']['custom_overlay_3_type'] )): ?>checked="checked"<?php endif; ?> value="2" name="val[custom_overlay_3_type]" id="custom_overlay_3_link_overlay" />
				</li>
				<li class="custom_overlay_3_extras1 <?php if (isset ( $this->_aVars['aForms']['custom_overlay_3_type'] ) && $this->_aVars['aForms']['custom_overlay_3_type'] != 2): ?>hidden<?php endif; ?>">
					<label for="custom_overlay_3_text">Link Text:</label>
					<input type="text" name="val[custom_overlay_3_text]" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['custom_overlay_3_text']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['custom_overlay_3_text']) : (isset($this->_aVars['aForms']['custom_overlay_3_text']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['custom_overlay_3_text']) : '')); ?>
" id="custom_overlay_3_text" class="m_left_5" />
				</li>
				<li class="custom_overlay_3_extras1 <?php if (isset ( $this->_aVars['aForms']['custom_overlay_3_type'] ) && $this->_aVars['aForms']['custom_overlay_3_type'] != 2): ?>hidden<?php endif; ?>">
					<label for="custom_overlay_3_url">Link URL:</label>
					<input type="text" name="val[custom_overlay_3_url]" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['custom_overlay_3_url']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['custom_overlay_3_url']) : (isset($this->_aVars['aForms']['custom_overlay_3_url']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['custom_overlay_3_url']) : '')); ?>
" id="custom_overlay_3_url" class="m_top_left_5" />
				</li>
				<li class="custom_overlay_3_extras2 <?php if (isset ( $this->_aVars['aForms']['custom_overlay_3_type'] ) && $this->_aVars['aForms']['custom_overlay_3_type'] == 0): ?>hidden<?php endif; ?>">
					<label for="custom_overlay_3_start">Start Time (seconds):</label>
					<input type="text" name="val[custom_overlay_3_start]" value="<?php if ($this->_aVars['bIsEdit'] && isset ( $this->_aVars['aForms']['custom_overlay_3_start'] ) && $this->_aVars['aForms']['custom_overlay_3_start']):  echo $this->_aVars['aForms']['custom_overlay_3_start'];  else: ?>65<?php endif; ?>" id="custom_overlay_3_start" class="m_top_left_5" size="5"/>
				</li>
				<li class="custom_overlay_3_extras2 <?php if (isset ( $this->_aVars['aForms']['custom_overlay_3_type'] ) && $this->_aVars['aForms']['custom_overlay_3_type'] == 0): ?>hidden<?php endif; ?>">
					<label for="custom_overlay_3_duration">Duration (seconds):</label>
					<input type="text" name="val[custom_overlay_3_duration]" value="<?php if ($this->_aVars['bIsEdit'] && isset ( $this->_aVars['aForms']['custom_overlay_3_duration'] ) && $this->_aVars['aForms']['custom_overlay_3_duration']):  echo $this->_aVars['aForms']['custom_overlay_3_duration'];  else: ?>10<?php endif; ?>" id="custom_overlay_3_duration" class="m_top_left_5" size="5"/>
				</li>
			</ol>
		</fieldset>
		<br><p><i>Note: Custom Overlays are not HTML5 compatible so they will not work on mobile or tablet devices.</i></p>
	</div>
<?php endif; ?>
	<br>
	<fieldset>
<?php if ($this->_aVars['bIsDvs']): ?>
		<input type="hidden" name="val[dvs_id]" value="<?php echo $this->_aVars['iDvsId']; ?>">
		<input type="hidden" name="val[step]" value="player" />
<?php else: ?>
		<input type="hidden" name="val[action]" value="<?php if ($this->_aVars['bIsEdit'] && isset ( $this->_aVars['aForms']['player_id'] )): ?>save<?php else: ?>add<?php endif; ?>" />
		<button class="button" onclick="$('#forward').val(1); $('#add_player').submit();" ><?php echo Phpfox::getPhrase('idrive.get_code'); ?></button>
<?php endif; ?>
		<input type="hidden" name="val[forward]" id="forward" value="0" />
<?php if ($this->_aVars['bIsEdit'] && isset ( $this->_aVars['aForms']['player_id'] )): ?><input type="hidden" name="val[player_id]" value="<?php echo $this->_aVars['aForms']['player_id']; ?>" /><?php endif; ?>
		<button type="submit" class="button"><?php echo Phpfox::getPhrase('dvs.save_settings'); ?></button>
<?php if ($this->_aVars['bIsDvs']): ?>
		<button class="button" onclick='$.ajaxCall("dvs.previewPlayer",$("#add_player").serialize()); return false;'><?php echo Phpfox::getPhrase('dvs.save_and_preview'); ?></button>
<?php else: ?>
		<button class="button" onclick="tb_show('<?php echo Phpfox::getPhrase('dvs.preview', array('phpfox_squote' => true)); ?>', $.ajaxBox('idrive.previewPlayer', 'width=' + iPreviewWidth + '&amp;height=' + iPreviewHeight + '&amp;' + $('#add_player').serialize())); return false;"><?php echo Phpfox::getPhrase('idrive.preview_player'); ?></button>
		
<?php endif; ?>
	</fieldset>

</form>

<?php else: ?>
<div class="error_message">
<?php if ($this->_aVars['bIsEdit']): ?>
<?php echo Phpfox::getPhrase('dvs.error_editing_player'); ?>
<?php else: ?>
<?php echo Phpfox::getPhrase('dvs.error_adding_player'); ?>
<?php endif; ?>
</div>
<?php endif; ?>
