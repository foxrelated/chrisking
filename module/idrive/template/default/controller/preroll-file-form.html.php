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
 * @package 		iDrive
 */

?>
<script type="text/javascript">
	$Behavior.preRoll = function() {left_curly}
		$('#js_preroll_upload_file').change(function()
			{left_curly}
				if (!empty(this.value))
				{left_curly}
					$('#js_preroll_file_form').ajaxCall('idrive.prerollFileProcess');
				{right_curly}
			{right_curly});
	{right_curly}
</script>
<div id="js_preroll_file_upload_container" style="background:#FFFFFF;">
	<div id="js_preroll_file_content">
		<div id="js_preroll_file_done" style="display:none;">
			<div class="valid_message">
				File Successfully Uploaded
			</div>
		</div>

		<div id="js_preroll_file_process" style="display:none;">
			<div class="message">
				{img theme='ajax/small.gif' alt='' class='v_middle'} <span id="js_preroll_upload_command">Uploading</span>: <span id="js_preroll_upload_file_name"></span>
			</div>
		</div>	
		<form method="post" action="{url link='idrive.preroll-file-frame'}" id="js_preroll_file_form" enctype="multipart/form-data" target="js_preroll_upload_frame">
			<div><input type="hidden" name="is_ajax" value="1" /></div>
			<input type="hidden" name="user_id" value="{$iUserId}" />

			<div><input type="hidden" name="preroll_file_id" value="{if $iCurrentPrerollId}{$iCurrentPrerollId}{/if}" class="js_cache_preroll_file_id" id="js_cache_preroll_file_id" /></div>
			<div id="js_preroll_upload_inner_form">


				
				<div id="method_simple" class="upload_method" >
					<input type="file" name="preroll_file" id="js_preroll_upload_file" size="10"/>			
				</div>
			</div>
		</form>
		</iframe>
		<div id="js_preroll_progress_uploader"></div>
	</div>
</div>	