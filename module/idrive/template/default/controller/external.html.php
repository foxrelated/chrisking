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
{template file='dvs.controller.player.player}
{*
<!--<script type="text/javascript" src="http://wheelstvshowroom.com/theme/frontend/wtv-showroom/style/default/jscript/wheelstv.js"></script>--> 
<script type="text/javascript" src="http://admin.brightcove.com/js/APIModules_all.js"></script>

<!-- Start of Brightcove Player -->
<script language="JavaScript" type="text/javascript" src="http://admin.brightcove.com/js/BrightcoveExperiences{if $bIsMobile}_all{/if}.js"></script>

<!-- required javascript for our ad integration with the player -->		
<script language="JavaScript" type="text/javascript" src="http://admin.brightcove.com/js/APIModules_all.js"></script>

<object id="myExperience" class="BrightcoveExperience">
	<param name="bgcolor" value="#FFFFFF" />
	<!-- url-assigned parameter for external player width -->	
	<param name="width" value="{$iWidth}" />
	<!-- url-assigned parameter for external player height -->	
	<param name="height" value="{$iHeight}" />
	<!-- url-assigned parameter for external player id -->			
	<param name="playerID" value="{$iPlayerId}" />
	<!-- url-assigned parameter for external player key -->	
	<param name="playerKey" value="{$sKey}" />
	<param name="isVid" value="true" />
	<param name="isUI" value="true" />
	<param name="dynamicStreaming" value="true" />
	<param name="autoStart" value="true" />
	<param name="wmode" value="transparent" />
	<!-- url-assigned parameter for external player playlist -->	
	{if $sPlaylist}
		<param name="@videoList" value="{$sPlaylist}" />
	{else}
		<param name="@videoPlayer" value="{$sRefId}" />
	{/if}
</object>

<script type="text/javascript">brightcove.createExperiences();</script>
</div>
*}