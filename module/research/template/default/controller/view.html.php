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
	$(document).ready(
		function() {
			$('div.video_long_desc_expander').expander({
			userCollapseText: '{/literal}{phrase var='research.read_less'}{literal}',
			expandText: '{/literal}{phrase var='research.read_more'}{literal}',
			 slicePoint: {/literal}{param var='research.character_max_before_trim'}{literal}
			})
		});
	
function onTemplateReady(e) {
	videoList = exp.getElementByID("videoList");

	if(exp == null || !(exp.getReady())) {
		console.log("Player not initialized yet. Wait till after templateReady event.");
	} else {
		var mediaIdsToRequest = [{/literal}{$sVideoIds}{literal}];
		content.getMediaInGroupAsynch(mediaIdsToRequest);
	}
}

function onVideoLoad(e) {
	$(document).ready(
		function(){
			$.ajaxCall(
				'research.changeCar', 'sName='+video.getCurrentVideo().displayName
			);
		}
	);

	$(function() {
	  setTimeout(shorten, 1000);
	});

	function shorten() {
		$('div.video_long_desc_expander').expander({
			userCollapseText: '{/literal}{phrase var='research.read_less'}{literal}',
			expandText: '{/literal}{phrase var='research.read_more'}{literal}',
			slicePoint: {/literal}{param var='research.character_max_before_trim'}{literal}
		})
	}
}

</script>
{/literal}
<!--  -->

<link rel="stylesheet" href="http://wheelstvshowroom.com/theme/frontend/wtv-showroom/style/default/css/wheelstv.css" />

<!-- <script type="text/javascript" src="http://wheelstvshowroom.com/theme/frontend/wtv-showroom/style/default/jscript/wheelstv.js"></script> -->

<script type="text/javascript" src="http://admin.brightcove.com/js/APIModules_all.js"></script>

<!-- Start of Brightcove Player -->
		<script language="JavaScript" type="text/javascript" src="http://admin.brightcove.com/js/BrightcoveExperiences.js"></script>

<!-- required javascript for our ad integration with the player -->		
<script language="JavaScript" type="text/javascript" src="http://admin.brightcove.com/js/APIModules_all.js"></script>
				
		<object id="myExperience" class="BrightcoveExperience">
			<param name="bgcolor" value="#FFFFFF" />
<!-- url-assigned parameter for external player width -->	
			<param name="width" value="760" />
<!-- url-assigned parameter for external player height -->	
			<param name="height" value="450" />
<!-- url-assigned parameter for external player id -->			
<param name="playerID" value="945068366001" />
<!-- url-assigned parameter for external player key -->	
			<param name="playerKey" value="AQ~~,AAAAjVS9InE~,8mX2MExmDXU4GJAL53iadfeGPNzsRZs0" />
			<param name="isVid" value="true" />
			<param name="isUI" value="true" />
			<param name="dynamicStreaming" value="true" />
			<param name="autoStart" value="true" />
			<param name="wmode" value="transparent" />
<!-- url-assigned parameter for external player playlist -->	
			<param name="@videoList" value="637631825001" />
		</object>
		
		<script type="text/javascript">brightcove.createExperiences();</script>
	</div>
	<div id="video_summary"></div>
	<div id="video_long_desc" class="video_long_desc_expander" style="width: 540px"></div>
