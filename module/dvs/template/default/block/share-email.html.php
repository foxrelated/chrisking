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
<script>
	{literal}
	$('#share_email_dealer').submit(function(event) {
		// cancels the form submission
		event.preventDefault();

		// do whatever you want here
		$.ajaxCall('dvs.sendShareEmail', $('#share_email_dealer').serialize());
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
	#dvs_share_email_container {
		text-align: center;
	}

	#share_email_dealer {
		text-align: center;
	}

	#share_email_dealer li {
		text-align: center;
	}

	.inputShare {
		width: 225px;
		font-size: 16px;
		padding: 4px;
		margin-bottom: 4px;
		font-family: Arial;
	}

	#share_email_dealer textarea {
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

<form id="share_email_dealer" name="share_email_dealer">

	<fieldset>
		<ul>
			<li>
				<input type="text" name="val[my_share_name]" id="my_share_name" placeholder="{phrase var='dvs.your_name'}" value="{$your_name}" required class="inputShare"/>
			</li>
		</ul>
        <ul>
            <li>
                <input type="text" name="val[my_share_email]" id="my_share_email" placeholder="{phrase var='dvs.your_email'}" value="{$your_email}" required class="inputShare"/>
            </li>
        </ul>
        <ul>
			<li>
				<input type="text" name="val[share_name]" id="share_name" placeholder="{phrase var='dvs.friends_name'}" class="inputShare" required />
			</li>
		</ul>
		<ul>
			<li>
				<input type="email" name="val[share_email]" id="share_email" placeholder="{phrase var='dvs.friends_email_address'}" required class="inputShare"/>
			</li>
		</ul>
		
		<ul>
			<li>
				<textarea id="share_message" name="val[share_message]" placeholder="{phrase var='dvs.message_to_friend'}" cols="18" rows="5"></textarea>
			</li>
		</ul>
		<input type="hidden" name="val[video_ref_id]" id="video_ref_id" value="{$aVideo.referenceId}"/>
		<input type="hidden" name="val[dvs_id]" id="dvs_id" value="{$aDvs.dvs_id}"/>
		<input type="hidden" name="val[longurl]" id="longurl" value="{$bLongUrl}" />
	</fieldset>
	<fieldset>
		<input type="submit" value="{phrase var='dvs.send'}" class="dvs_form_button"/>
	</fieldset>
</form>
<div id="dvs_share_email_success" style="display:none;">
	{phrase var='dvs.email_has_been_sent'}
</div>
