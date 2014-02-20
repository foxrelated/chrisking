<?php
/**
 * [PHPFOX_HEADER]
 */
defined('PHPFOX') or exit('DRINK SLICE!');

/**
 *
 *
 * @copyright	Konsort.org 
 * @author  		Konsort.org
 * @package 		Research
 */
//$width = (isset($_GET['width'])) ? $_GET['width'] : 720;
//$height = (isset($_GET['height'])) ? $_GET['height'] : 605;
//$refid = (isset($_GET['refid'])) ? $_GET['refid'] : null;

?>


{literal}
<script type="text/javascript">
	
	function onTemplateReady(e) {
		videoList = exp.getElementByID("videoList");
		if(exp == null || !(exp.getReady())) {
			console.log("Player not initialized yet. Wait till after templateReady event.");
		} else {
			var mediaIdsToRequest = [{/literal}{$sVideoIds}{literal}];
			content.getMediaInGroupAsynch(mediaIdsToRequest);
		}
	}
</script>
{/literal}
<script type="text/javascript" src="http://wheelstvshowroom.com/theme/frontend/wtv-showroom/style/default/jscript/wheelstv.js"></script>
<script type="text/javascript" src="http://admin.brightcove.com/js/APIModules_all.js"></script>

<!-- Start of Brightcove Player -->
<script language="JavaScript" type="text/javascript" src="http://admin.brightcove.com/js/BrightcoveExperiences.js"></script>

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
