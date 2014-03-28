<?php
/**
 * [PHPFOX_HEADER]
 */
defined('PHPFOX') or exit('No direct script access allowed.');

/**
 * @copyright		EMPulse Codeworx
 * @author  		James
 * @package 		MetaRadio
 */

?>
{if $bImport}
{literal}
<script type="text/javascript">

	var total={/literal}{$iTotal}{literal};
	var totalvideos={/literal}{$iTotalVideos}{literal};
	var job={/literal}"{$sJob}"{literal};
	var run=true;

	$Behavior.domReady = function(){
		autoUpdate(0);
	};

	function autoUpdate(offset){
		if (offset < total && run){
			$.ajaxCall('kobrightcove.autoUpdate',
			'val[offset]=' + offset
				+'&val[total]='	+ total
				+'&val[totalvideos]=' + totalvideos
				+'&val[job]=' + job
				+'&val[batch]={/literal}{$iBatch}{literal}'
			);
		};
		if (run == false){
			$("#progress_running").toggle("slow");
			$("#progress_stopped").toggle("slow");
		};
		if (offset >= total){
			$("#progress_running").hide("slow");
			$("#progress_outer").hide("slow");
			$("#progress_update").hide("slow");
			$("#progress_complete").show("slow");
			
			window.location.replace("{/literal}{url link='admincp.kobrightcove' status='finished' total={$iTotalVideos}job_"+job+"{literal}");
		};

	};
	function restart(offset){
		$("#progress_running").show("slow");
		$("#progress_stopped").hide("slow");
		run=true;
		autoUpdate(offset);
	};
</script>
<style type="text/css">
	#progress_outer{
		border: 1px solid #000;
		width: 600px;
		height: 15px;
	}
	#progress_inner{
		width: 0%;
		height: 15px;
		background: #ff8c22;
	}
	#progress_percentage{
		position: absolute;
		float: center;
		width: 600px;
		height:15px;
		color:#000;
		font-weight: bold;
		text-align: center;
		padding-top: 2px;
	}
</style>
{/literal}
Parsing {$iTotalVideos} videos...
<br>
<br>
<div id="progress_running">
	<a href="#" onclick="run=false;">Stop</a>
</div>
<div id="progress_stopped" style="display:none;">
	<a href="#" onclick="restart(0);">Restart</a>
</div>
<div id="progress_complete" style="display:none;">
	Complete!
</div>
<br>
<br>
<div id="progress_outer">
	<div id="progress_percentage">0%</div>
	<div id="progress_inner"></div>
</div>

<div id="progress_update"></div>
{else}
<div id="import">
	<form method="post" action="{url link="current"}" id="import">
		  <div class="table">
			<div class="table_left">
				Ready to parse {$iTotalVideos} videos.
			</div>
			<div class="table_right">
				<input type="hidden" name="val[total]" value="{$iTotal}" />
				<input type="hidden" name="val[totalvideos]" value="{$iTotalVideos}" />
				<input type="hidden" name="val[job]" value="{$sJob}" />
				<input type="submit" name="val[Start]" value="Start" class="button" />
			</div>
		</div>
	</form>
</div>
{/if}