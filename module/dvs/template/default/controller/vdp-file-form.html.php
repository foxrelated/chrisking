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
{literal}
<script type="text/javascript">
    $Behavior.vdp = function() {
        $('#js_vdp_upload_file').change(function() {
            if (!empty(this.value)) {
                $('#js_vdp_file_form').ajaxCall('dvs.vdpFileProcess');
            }
        });
    }
</script>
{/literal}
<div id="js_vdp_file_upload_container" style="background:#FFFFFF;">
    <div id="js_vdp_file_content">
        <div id="js_vdp_file_done" style="display:none;">
            <div class="valid_message">
                File Successfully Uploaded
            </div>
        </div>

        <div id="js_vdp_file_process" style="display:none;">
            <div class="message">
                {img theme='ajax/small.gif' alt='' class='v_middle'} <span id="js_vdp_upload_command">Uploading</span>: <span id="js_vdp_upload_file_name"></span>
            </div>
        </div>
        <form method="post" action="{url link='dvs.vdp-file-frame'}" id="js_vdp_file_form" enctype="multipart/form-data" target="js_vdp_upload_frame">
            <div><input type="hidden" name="is_ajax" value="1" /></div>
            <input type="hidden" name="user_id" value="{$iUserId}" />

            <div><input type="hidden" name="vdp_file_id" value="{if $iCurrentVdpId}{$iCurrentVdpId}{/if}" class="js_cache_vdp_file_id" id="js_cache_vdp_file_id" /></div>
            <div id="js_vdp_upload_inner_form">

                <div id="js_vdp_file_upload_error" style="display:none;">
                    <div class="error_message" id="js_vdp_file_upload_message"></div>
                    <div class="main_break"></div>
                </div>
                <div id="method_simple" class="upload_method" >
                    <input type="file" name="vdp_file" id="js_vdp_upload_file" size="10"/>
                </div>
            </div>
        </form>
        <div id="js_vdp_progress_uploader"></div>
    </div>
</div>