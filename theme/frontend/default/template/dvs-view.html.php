<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author			Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: blank.html.php 3118 2011-09-16 10:51:04Z Raymond_Benc $
 */
 
defined('PHPFOX') or exit('NO DICE!'); 

?><!DOCTYPE html>
<html dir="{$sLocaleDirection}" lang="{$sLocaleCode}">
	<head>
		<title>{title}</title>	
		{if !isset($bNoIFrameHeader)}
		{header}
		{/if}
		{if isset($sCustomHeader)}
		{$sCustomHeader}
		{/if}
		<script src="http://ajax.aspnetcdn.com/ajax/modernizr/modernizr-2.7.1.js"></script>
		{if !empty($aDvs)}
		<style>
			/* This CSS is generated for the base DVS page */
            html, body {l}
                height: 100%;
                font-family: {$aDvs.font_family};
            {r}

            {if $bc != 'refid' && !$bPreview}
            body {l}
                background-image: url('{$sBackgroundPath}');
                background-attachment: {$aDvs.background_attachment_type};
                /*opacity: {$iBackgroundOpacity / 100};
                filter:alpha(opacity={$iBackgroundOpacity});*/
                z-index: -1;
                /* keep the bg image aligned properly */
                background-position:center top;
                background-repeat:{$aDvs.background_repeat_type};
                background-color: #{$aDvs.page_background};
            {r}
            {/if}

			section h1,h2,h3,h4,h5,h6,h7 {l}
				color: #{$aDvs.page_text};
			{r}
			
			section p {l}
				color: #{$aDvs.page_text};
			{r}	
					
			header h1 {l}
				color: #{$aDvs.page_text};
			{r}

			header nav {l}
				background-color: #{$aDvs.menu_background};
				border: 5px solid #{$aDvs.menu_background};
			{r}

			header nav a,
			header nav a:hover,
			nav li + li:before {l}
				color: #{$aDvs.menu_link};
			{r}

			#video_information h3,
			#video_information a,
			.model_description,
			footer h3,
			article aside,
			#video_information section h2,
			#select_new h3,
			#action_links p {l}
				color: #{$aDvs.page_text};
			{r}

			aside a,
			aside a:hover {l}
				color: #{$aDvs.text_link};
			{r}

			footer a,
			footer a:hover {l}
				color: #{$aDvs.footer_link};
			{r}

			#dealer_links a {l}
				background-color: #{$aDvs.button_background};
				background-image: -webkit-linear-gradient(top, #{$aDvs.button_top_gradient}, #{$aDvs.button_bottom_gradient});
				background-image: -moz-linear-gradient( center top, #{$aDvs.button_top_gradient} 5%, #{$aDvs.button_bottom_gradient} 100% );
				background-image: -ms-linear-gradient(bottom, #{$aDvs.button_top_gradient} 0%, #{$aDvs.button_bottom_gradient} 100%);
				background-image: linear-gradient(to bottom, #{$aDvs.button_top_gradient} 0%, #{$aDvs.button_bottom_gradient} 100%);
				background-image: -o-linear-gradient(bottom, #{$aDvs.button_top_gradient} 0%, #{$aDvs.button_bottom_gradient} 100%);
				filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#{$aDvs.button_top_gradient}', endColorstr='#{$aDvs.button_bottom_gradient}');
				border: 1px solid #{$aDvs.button_border};
				color: #{$aDvs.button_text};
				border: 1px solid #{$aDvs.button_border};
				behavior: url('./dvs/module/static/css/default/default/border-radius.htc');
			{r}

			#dealer_links a:hover {l}
				background-image: -webkit-linear-gradient(top, #{$aDvs.button_bottom_gradient}, #{$aDvs.button_top_gradient});
				background-image: -moz-linear-gradient( center top, #{$aDvs.button_bottom_gradient} 5%, #{$aDvs.button_top_gradient} 100% );
				background-image: -ms-linear-gradient(bottom, #{$aDvs.button_bottom_gradient} 0%, #{$aDvs.button_top_gradient} 100%);
				background-image: linear-gradient(to bottom, #{$aDvs.button_bottom_gradient} 0%, #{$aDvs.button_top_gradient} 100%);
				background-image: -o-linear-gradient(bottom, #{$aDvs.button_bottom_gradient} 0%, #{$aDvs.button_top_gradient} 100%);
				filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#{$aDvs.button_bottom_gradient}', endColorstr='#{$aDvs.button_top_gradient}');
				background-color: #{$aDvs.button_background};
				border: 1px solid #{$aDvs.button_border};
				color: #{$aDvs.button_text};
			{r}

			/* This CSS is generated for the DVS player block */
			#player {l}
				background-color: #{$aDvs.player_background};
			{r}

			#playlist_wrapper button.playlist-button {l}
				background-color: #{$aDvs.player_buttons};
				color: #{$aDvs.playlist_arrows};
			{r}

			#playlist_wrapper button.playlist-button:hover {l}
				opacity: 0.5;
			{r}

			#overview_playlist li {l}
				border: 2px #{$aDvs.playlist_border} solid;
			{r}
		</style>
		{/if}
	</head>
	<body itemscope itemtype="http://schema.org/AutoDealer">
		<div id="js_body_width_frame">
			{if !isset($bNoIFrameHeader)}
			{body}	
			{/if}
			{content}
			{if !isset($bNoIFrameHeader)}
			{footer}	
			{/if}
		</div>
	</body>
</html>