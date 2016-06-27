<?php
/**
 * [PHPFOX_HEADER]
 */
defined('PHPFOX') or exit('No direct script access allowed.');

/**
 *
 *
 * @copyright        Konsort.org 
 * @author          Konsort.org
 * @package         DVS
 */

?>
<script type="text/javascript">
    $Behavior.preRoll = function() {left_curly}
        $('#js_image_overlay{$iCurrentOverlay}_upload_file').change(function()
            {left_curly}
                if (!empty(this.value))
                {left_curly}
                    $('#js_image_overlay{$iCurrentOverlay}_file_form').ajaxCall('dvs.imageoverlayProcess');
                {right_curly}
            {right_curly});
    {right_curly}
</script>

<div id="js_image_overlay{$iCurrentOverlay}_file_upload_container" style="background:#FFFFFF;">
    <div id="js_image_overlay{$iCurrentOverlay}_file_content">
        <div id="js_image_overlay{$iCurrentOverlay}_file_done" style="display:none;">
            <div class="valid_message">
                File Successfully Uploaded
            </div>
        </div>

        <div id="js_image_overlay{$iCurrentOverlay}_file_process" style="display:none;">
            <div class="message">
                {img theme='ajax/small.gif' alt='' class='v_middle'} <span id="js_image_overlay{$iCurrentOverlay}_upload_command">Uploading</span>: <span id="js_image_overlay{$iCurrentOverlay}_upload_file_name"></span>
            </div>
        </div>    
        <form method="post" action="{url link='dvs.player.image-overlay-frame'}" id="js_image_overlay{$iCurrentOverlay}_file_form" enctype="multipart/form-data" target="js_image_overlay{$iCurrentOverlay}_upload_frame">
            <div><input type="hidden" name="is_ajax" value="1" /></div>
            <input type="hidden" name="user_id" value="{$iUserId}" />

            <div>
           <!-- <input type="hidden" name="image_overlay{$iCurrentOverlay}_file_id" value="{if $iCurrentOverlayId}{$iCurrentOverlayId}{/if}" class="js_cache_image_overlay{$iCurrentOverlay}_file_id" id="js_cache_image_overlay{$iCurrentOverlay}_file_id" />
            -->
            <input type="hidden" name="image_overlay" value="{if $iCurrentOverlay}{$iCurrentOverlay}{else}0{/if}">
            </div>
            <div id="js_image_overlay{$iCurrentOverlay}_upload_inner_form">
                <div id="method_simple" class="upload_method" >
                    <input type="file" name="image_overlay{$iCurrentOverlay}_file" id="js_image_overlay{$iCurrentOverlay}_upload_file" size="10"/>            
                </div>
            </div>
        </form>
        </iframe>
        <div id="js_image_overlay{$iCurrentOverlay}_progress_uploader"></div>
    </div>
</div>    