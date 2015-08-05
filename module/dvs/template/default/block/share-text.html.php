<?php
defined('PHPFOX') or exit('No direct script access allowed.');

?>
<script>
	{literal}
	$('#share_text_dealer').submit(function(event) {
		// cancels the form submission
		event.preventDefault();

		// do whatever you want here
        $('.share_text_field').hide();
        $('#loading_text_img').show();
		$.ajaxCall('dvs.sendShareText', $('#share_text_dealer').serialize());
		//$.ajaxCall('dvs.generateShortUrl', 'dvs_id={$aDvs.dvs_id}&video_ref_id={$aVideo.referenceId}&service=email&return_id=share_link_box');
        {/literal}
        {if $bSaveGa == 1}
        shareEmailSent();
        {/if}
        {literal}
	});

	if( $.isFunction( $('input, textarea').placeholder ) ) {
		$('input, textarea').placeholder();
	}
	{/literal}
</script>

<style type="text/css">
	{literal}

	#share_text_dealer {
		text-align: center;
	}

	#share_text_dealer li {
		text-align: center;
	}

	.inputShare {
		width: 225px;
		font-size: 16px;
		padding: 4px;
		margin-bottom: 4px;
		font-family: Arial;
	}

	#share_text_dealer textarea {
		width: 225px;
		font-size: 16px;
		padding: 4px;
		margin-bottom: 10px;
		font-family: Arial;
	}

	.dvs_form_button {
		padding: 5px 25px;
		border-radius: 5px;
	}
	{/literal}

	input.dvs_form_button {l}
	background-color: #{$aDvs.button_background};
	background-image: -webkit-linear-gradient(top, #{$aDvs.button_top_gradient}, #{$aDvs.button_bottom_gradient});
	background-image: -moz-linear-gradient( center top, #{$aDvs.button_top_gradient} 5%, #{$aDvs.button_bottom_gradient} 100% );
	background-image: -ms-linear-gradient(bottom, #{$aDvs.button_top_gradient} 0%, #{$aDvs.button_bottom_gradient} 100%);
	background-image: linear-gradient(to bottom, #{$aDvs.button_top_gradient} 0%, #{$aDvs.button_bottom_gradient} 100%);
	background-image: -o-linear-gradient(bottom, #{$aDvs.button_top_gradient} 0%, #{$aDvs.button_bottom_gradient} 100%);
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#{$aDvs.button_top_gradient}', endColorstr='#{$aDvs.button_bottom_gradient}');
	border: 1px solid #{$aDvs.button_border};
	color: #{$aDvs.button_text};
	cursor:pointer;
	{r}

	input.dvs_form_button:hover {l}
	background-image: -webkit-linear-gradient(top, #{$aDvs.button_bottom_gradient}, #{$aDvs.button_top_gradient});
	background-image: -moz-linear-gradient( center top, #{$aDvs.button_bottom_gradient} 5%, #{$aDvs.button_top_gradient} 100% );
	background-image: -ms-linear-gradient(bottom, #{$aDvs.button_bottom_gradient} 0%, #{$aDvs.button_top_gradient} 100%);
	background-image: linear-gradient(to bottom, #{$aDvs.button_bottom_gradient} 0%, #{$aDvs.button_top_gradient} 100%);
	background-image: -o-linear-gradient(bottom, #{$aDvs.button_bottom_gradient} 0%, #{$aDvs.button_top_gradient} 100%);
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#{$aDvs.button_bottom_gradient}', endColorstr='#{$aDvs.button_top_gradient}');
	background-color: #{$aDvs.button_background};
	border: 1px solid #{$aDvs.button_border};
	color: #{$aDvs.button_text};
	cursor:pointer;
	{r}
</style>

<form id="share_text_dealer" name="share_text_dealer">

	<fieldset>
		<ul>
            <li id="loading_text_img" style="display: none;">
                {img theme='ajax/large.gif'}
            </li>
        </ul>
        <div class="share_text_field">
            <!--<ul>
                <li>
                    <input type="text" name="val[sender_mobile]" id="sender_mobile" placeholder="Sender Mobile" class="inputShare" required />
                </li>
            </ul>-->
            <ul>
                <li>
                    <input type="text" name="val[receiver_mobile]" id="receiver_mobile" placeholder="Receiver Mobile" required class="inputShare"/>
                </li>
            </ul>

            <ul>
                <li>
                    <textarea id="custom_message" name="val[custom_message]" placeholder="Custom Message" cols="18" rows="5" maxlength="100"></textarea>
                </li>
            </ul>
        </div>

		<input type="hidden" name="val[video_ref_id]" id="video_ref_id" value="{$aVideo.referenceId}"/>
		<input type="hidden" name="val[dvs_id]" id="dvs_id" value="{$aDvs.dvs_id}"/>
	</fieldset>
	<fieldset class="share_text_field">
		<input type="submit" value="{phrase var='dvs.send'}" class="dvs_form_button"/>
	</fieldset>
</form>
<div id="dvs_share_text_success" style="display:none;">
	Your virtual "text" drive has been sent!
</div>
