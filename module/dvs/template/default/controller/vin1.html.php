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
    {header}

<style type="text/css">
html {l}
    width: 100%;
    height: 100%;
{r}

.vin_btn, .vin_btn:hover {l}
    display: block;
    font-weight: bold;
    text-align: center;
    text-decoration: none;
    text-transform: uppercase;
    height: {$sHeight}px;
    line-height: {$sHeight}px;
    color: #{$aDvs.vin_btn_color};
    font-size: {$aDvs.vin_font_size};
    background: #{$aDvs.vin_top_gradient}; /* Old browsers */
    background: -moz-linear-gradient(top,  #{$aDvs.vin_top_gradient} 0%, #{$aDvs.vin_bottom_gradient} 100%); /* FF3.6+ */
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#{$aDvs.vin_top_gradient}), color-stop(100%,#{$aDvs.vin_bottom_gradient})); /* Chrome,Safari4+ */
    background: -webkit-linear-gradient(top,  #{$aDvs.vin_top_gradient} 0%,#{$aDvs.vin_bottom_gradient} 100%); /* Chrome10+,Safari5.1+ */
    background: -o-linear-gradient(top,  #{$aDvs.vin_top_gradient} 0%,#{$aDvs.vin_bottom_gradient} 100%); /* Opera 11.10+ */
    background: -ms-linear-gradient(top,  #{$aDvs.vin_top_gradient} 0%,#{$aDvs.vin_bottom_gradient} 100%); /* IE10+ */
    background: linear-gradient(to bottom,  #{$aDvs.vin_top_gradient} 0%,#{$aDvs.vin_bottom_gradient} 100%); /* W3C */
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#{$aDvs.vin_top_gradient}', endColorstr='#{$aDvs.vin_bottom_gradient}',GradientType=0 ); /* IE6-9 */
{r}
</style>
</head>
<body>
    <a class="vin_btn" href="{$sVideoUrl}">Take a Virtual Test Drive</a>
</body>
</html>