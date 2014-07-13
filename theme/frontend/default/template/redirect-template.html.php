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
    <meta property="og:title" content="{$aFirstVideoMeta.name}" />
    <meta property="og:site_name" content="WheelsTV" />
    <meta property="og:description" content="{$aFirstVideoMeta.description}" />
    <meta property="og:image" content="{$aFirstVideoMeta.thumbnail_url}" />
    <meta property="article:author" content="{$aDvs.dealer_user_full_name}" />
    <title>{title}</title>
</head>
<body itemscope itemtype="http://schema.org/AutoDealer">
<div id="js_body_width_frame">
    {content}
</div>
</body>
</html>