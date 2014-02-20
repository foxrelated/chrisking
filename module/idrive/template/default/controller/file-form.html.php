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
		$(document).ready(function() {left_curly}
			$('#js_upload_file').change(function()
			{left_curly}
				if (!empty(this.value))
				{left_curly}
					$('#js_file_form').ajaxCall('idrive.fileProcess');
				{right_curly}
			{right_curly});
		{right_curly});
</script>
<div id="js_file_upload_container" style="background:#FFFFFF;">
	<div id="js_file_content">
		<div id="js_file_done" style="display:none;">
			<div class="valid_message">
				File Successfully Uploaded
			</div>
		</div>

		<div id="js_file_process" style="display:none;">
			<div class="message">
				{img theme='ajax/small.gif' alt='' class='v_middle'} <span id="js_upload_command">Uploading</span>: <span id="js_upload_file_name"></span>
			</div>
		</div>	
		<form method="post" action="{url link='idrive.file-Frame'}" id="js_file_form" enctype="multipart/form-data" target="js_upload_frame">
			<div><input type="hidden" name="is_ajax" value="1" /></div>
			<input type="hidden" name="user_id" value="{$iUserId}" />

			<div><input type="hidden" name="file_id" value="" class="js_cache_file_id" /></div>
			<div id="js_upload_inner_form">

				<div id="js_file_upload_error" style="display:none;">
					<div class="error_message" id="js_file_upload_message"></div>		
					<div class="main_break"></div>
				</div>
				<div id="method_simple" class="upload_method" >
					<input type="file" name="file" id="js_upload_file" size="10"/>			
				</div>
			</div>
		</form>
		</iframe>
		<div id="js_progress_uploader"></div>
	</div>
</div>	