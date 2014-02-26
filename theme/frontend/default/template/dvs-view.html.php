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
	</head>
	<body itemscope itemtype="http://schema.org/AutoDealer>
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