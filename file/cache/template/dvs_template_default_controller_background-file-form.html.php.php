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
		$Behavior.background = function() {
			$('#js_background_upload_file').change(function(){
				if (!empty(this.value))
				{
					$('#js_background_file_form').ajaxCall('dvs.backgroundFileProcess');
				}
			});
		}
</script>
<div id="js_background_file_upload_container" style="background:#FFFFFF;">
	<div id="js_background_file_content">
		<div id="js_background_file_done" style="display:none;">
			<div class="valid_message">
				File Successfully Uploaded
			</div>
		</div>

		<div id="js_background_file_process" style="display:none;">
			<div class="message">
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'ajax/small.gif','alt' => '','class' => 'v_middle')); ?> <span id="js_background_upload_command">Uploading</span>: <span id="js_background_upload_file_name"></span>
			</div>
		</div>	
		<form method="post" action="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('dvs.background-file-frame'); ?>" id="js_background_file_form" enctype="multipart/form-data" target="js_background_upload_frame">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>
			<div><input type="hidden" name="is_ajax" value="1" /></div>
			<input type="hidden" name="user_id" value="<?php echo $this->_aVars['iUserId']; ?>" />

			<div><input type="hidden" name="background_file_id" value="<?php if ($this->_aVars['iCurrentBackgroundId']):  echo $this->_aVars['iCurrentBackgroundId'];  endif; ?>" class="js_cache_background_file_id" id="js_cache_background_file_id" /></div>
			<div id="js_background_upload_inner_form">

				<div id="js_background_file_upload_error" style="display:none;">
					<div class="error_message" id="js_background_file_upload_message"></div>		
					<div class="main_break"></div>
				</div>
				<div id="method_simple" class="upload_method" >
					<input type="file" name="background_file" id="js_background_upload_file" size="10"/>			
				</div>
			</div>
		
</form>

		<div id="js_background_progress_uploader"></div>
	</div>
</div>	
