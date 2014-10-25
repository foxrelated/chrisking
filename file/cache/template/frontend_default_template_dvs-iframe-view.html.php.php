<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 21, 2014, 8:10 pm */ ?>
<?php
/**
 * [PHPFOX_HEADER]
 *
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author			Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: blank.html.php 3118 2011-09-16 10:51:04Z Raymond_Benc $
 */



?><!DOCTYPE html>
<html dir="<?php echo $this->_aVars['sLocaleDirection']; ?>" lang="<?php echo $this->_aVars['sLocaleCode']; ?>">
<head>
    <title><?php echo $this->getTitle(); ?></title>
<?php if (! isset ( $this->_aVars['bNoIFrameHeader'] )): ?>
<?php echo $this->getHeader(); ?>
<?php endif; ?>
<?php if (isset ( $this->_aVars['sCustomHeader'] )): ?>
<?php echo $this->_aVars['sCustomHeader']; ?>
<?php endif; ?>
    <script src="http://ajax.aspnetcdn.com/ajax/modernizr/modernizr-2.7.1.js"></script>
<?php if (! empty ( $this->_aVars['aDvs'] )): ?>
    <style>
        /* This CSS is generated for the base DVS page */
        html, body {
            font-family: <?php echo $this->_aVars['aDvs']['font_family']; ?>;
        }

        body {
            background-attachment: <?php echo $this->_aVars['aDvs']['background_attachment_type']; ?>;
            opacity: <?php echo $this->_aVars['iBackgroundOpacity']; ?>;
            filter:alpha(opacity=<?php echo $this->_aVars['iBackgroundOpacity']; ?>);
            z-index: -1;
            /* keep the bg image aligned properly */
            background-position:center top;
            background-repeat:<?php echo $this->_aVars['aDvs']['background_repeat_type']; ?>;
            background-color: #<?php echo $this->_aVars['aDvs']['iframe_background']; ?>;
        }

        section h1,h2,h3,h4,h5,h6,h7 {
        color: #<?php echo $this->_aVars['aDvs']['iframe_text']; ?>;
        }

        section p {
        color: #<?php echo $this->_aVars['aDvs']['iframe_text']; ?>;
        }

        header h1 {
        color: #<?php echo $this->_aVars['aDvs']['iframe_text']; ?>;
        }

        header nav {
        background-color: #<?php echo $this->_aVars['aDvs']['menu_background']; ?>;
        border: 5px solid #<?php echo $this->_aVars['aDvs']['menu_background']; ?>;
        }

        header nav a,
        header nav a:hover,
        nav li + li:before {
        color: #<?php echo $this->_aVars['aDvs']['menu_link']; ?>;
        }

        #video_information h3,
        #video_information a,
        .model_description,
        footer h3,
        article aside,
        #video_information section h2,
        #select_new h3,
        #action_links p {
        color: #<?php echo $this->_aVars['aDvs']['iframe_text']; ?>;
        }

        aside a,
        aside a:hover {
        color: #<?php echo $this->_aVars['aDvs']['text_link']; ?>;
        }

        footer a,
        footer a:hover {
        color: #<?php echo $this->_aVars['aDvs']['footer_link']; ?>;
        }

        #dealer_links a {
        background-color: #<?php echo $this->_aVars['aDvs']['button_background']; ?>;
        background-image: -webkit-linear-gradient(top, #<?php echo $this->_aVars['aDvs']['button_top_gradient']; ?>, #<?php echo $this->_aVars['aDvs']['button_bottom_gradient']; ?>);
        background-image: -moz-linear-gradient( center top, #<?php echo $this->_aVars['aDvs']['button_top_gradient']; ?> 5%, #<?php echo $this->_aVars['aDvs']['button_bottom_gradient']; ?> 100% );
        background-image: -ms-linear-gradient(bottom, #<?php echo $this->_aVars['aDvs']['button_top_gradient']; ?> 0%, #<?php echo $this->_aVars['aDvs']['button_bottom_gradient']; ?> 100%);
        background-image: linear-gradient(to bottom, #<?php echo $this->_aVars['aDvs']['button_top_gradient']; ?> 0%, #<?php echo $this->_aVars['aDvs']['button_bottom_gradient']; ?> 100%);
        background-image: -o-linear-gradient(bottom, #<?php echo $this->_aVars['aDvs']['button_top_gradient']; ?> 0%, #<?php echo $this->_aVars['aDvs']['button_bottom_gradient']; ?> 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#<?php echo $this->_aVars['aDvs']['button_top_gradient']; ?>', endColorstr='#<?php echo $this->_aVars['aDvs']['button_bottom_gradient']; ?>');
        border: 1px solid #<?php echo $this->_aVars['aDvs']['button_border']; ?>;
        color: #<?php echo $this->_aVars['aDvs']['button_text']; ?>;
        border: 1px solid #<?php echo $this->_aVars['aDvs']['button_border']; ?>;
        behavior: url('./dvs/module/static/css/default/default/border-radius.htc');
        }

        #dealer_links a:hover {
        background-image: -webkit-linear-gradient(top, #<?php echo $this->_aVars['aDvs']['button_bottom_gradient']; ?>, #<?php echo $this->_aVars['aDvs']['button_top_gradient']; ?>);
        background-image: -moz-linear-gradient( center top, #<?php echo $this->_aVars['aDvs']['button_bottom_gradient']; ?> 5%, #<?php echo $this->_aVars['aDvs']['button_top_gradient']; ?> 100% );
        background-image: -ms-linear-gradient(bottom, #<?php echo $this->_aVars['aDvs']['button_bottom_gradient']; ?> 0%, #<?php echo $this->_aVars['aDvs']['button_top_gradient']; ?> 100%);
        background-image: linear-gradient(to bottom, #<?php echo $this->_aVars['aDvs']['button_bottom_gradient']; ?> 0%, #<?php echo $this->_aVars['aDvs']['button_top_gradient']; ?> 100%);
        background-image: -o-linear-gradient(bottom, #<?php echo $this->_aVars['aDvs']['button_bottom_gradient']; ?> 0%, #<?php echo $this->_aVars['aDvs']['button_top_gradient']; ?> 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#<?php echo $this->_aVars['aDvs']['button_bottom_gradient']; ?>', endColorstr='#<?php echo $this->_aVars['aDvs']['button_top_gradient']; ?>');
        background-color: #<?php echo $this->_aVars['aDvs']['button_background']; ?>;
        border: 1px solid #<?php echo $this->_aVars['aDvs']['button_border']; ?>;
        color: #<?php echo $this->_aVars['aDvs']['button_text']; ?>;
        }

        /* This CSS is generated for the DVS player block */
        #player {
        background-color: #<?php echo $this->_aVars['aDvs']['player_background']; ?>;
        }

        #playlist_wrapper button.playlist-button {
        background-color: #<?php echo $this->_aVars['aDvs']['player_buttons']; ?>;
        color: #<?php echo $this->_aVars['aDvs']['playlist_arrows']; ?>;
        }

        #playlist_wrapper button.playlist-button:hover {
        opacity: 0.5;
        }

        #overview_playlist li {
        border: 2px #<?php echo $this->_aVars['aDvs']['playlist_border']; ?> solid;
        }

        #contact_box {
        background-color: #<?php echo $this->_aVars['aDvs']['iframe_contact_background']; ?>;
        }

        #contact_box h2, #contact_box #dvs_contact_success {
        color: #<?php echo $this->_aVars['aDvs']['iframe_contact_text']; ?>;
        }

        #dealer_links a {
        font-family: <?php echo $this->_aVars['aDvs']['font_family']; ?>;
        }

        input.dvs_form_button, input.inputContact, textarea.inputContact {
        font-family: <?php echo $this->_aVars['aDvs']['font_family']; ?>;
        }
    </style>
<?php endif; ?>
</head>
<body itemscope itemtype="http://schema.org/AutoDealer">
<div id="js_body_width_frame">
<?php if (! isset ( $this->_aVars['bNoIFrameHeader'] )): ?>
<?php Phpfox::getBlock('core.template-body'); ?>
<?php endif; ?>
<?php if (!$this->bIsSample): ?><div id="site_content"><?php if (isset($this->_aVars['bSearchFailed'])): ?><div class="message">Unable to find anything with your search criteria.</div><?php else:  $sController = "dvs.iframe";  if ( Phpfox::getLib("template")->shouldLoadDelayed("dvs.iframe") == true ): ?>
<div id="delayed_block_image" style="text-align:center; padding-top:20px;"><img src="http://www.wtvdvs.com/theme/frontend/default/style/default/image/ajax/add.gif" alt="" /></div>
<div id="delayed_block" style="display:none;"><?php echo Phpfox::getLib('phpfox.module')->getFullControllerName(); ?></div>
<?php else:  Phpfox::getLib('phpfox.module')->getControllerTemplate();  endif;  endif; ?></div><?php endif; ?>
<?php if (! isset ( $this->_aVars['bNoIFrameHeader'] )): ?>
<?php Phpfox::getBlock('core.template-footer'); ?>
<?php endif; ?>
</div>
</body>
</html>
