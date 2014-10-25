<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 23, 2014, 12:16 am */ ?>
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

 if ($this->_aVars['bImport']):  echo '
<script type="text/javascript">

	var total=';  echo $this->_aVars['iTotal'];  echo ';
	var totalvideos=';  echo $this->_aVars['iTotalVideos'];  echo ';
	var job='; ?>
"<?php echo $this->_aVars['sJob']; ?>"<?php echo ';
	var run=true;

	$Behavior.domReady = function(){
		autoUpdate(0);
	};

	function autoUpdate(offset){
		if (offset < total && run){
			$.ajaxCall(\'kobrightcove.autoUpdate\',
			\'val[offset]=\' + offset
				+\'&val[total]=\'	+ total
				+\'&val[totalvideos]=\' + totalvideos
				+\'&val[job]=\' + job
				+\'&val[batch]=';  echo $this->_aVars['iBatch'];  echo '\'
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
			
			window.location.replace("';  echo Phpfox::getLib('phpfox.url')->makeUrl('admincp.kobrightcove', array('status' => 'finished','total' => $this->_aVars['iTotalVideos'])); ?>job_"+job+"<?php echo '");
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
'; ?>

Parsing <?php echo $this->_aVars['iTotalVideos']; ?> videos...
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
<?php else: ?>
<div id="import">
	<form method="post" action="<?php echo Phpfox::getLib('phpfox.url')->makeUrl("current"); ?>" id="import">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>
		  <div class="table">
			<div class="table_left">
				Ready to parse <?php echo $this->_aVars['iTotalVideos']; ?> videos.
			</div>
			<div class="table_right">
				<input type="hidden" name="val[total]" value="<?php echo $this->_aVars['iTotal']; ?>" />
				<input type="hidden" name="val[totalvideos]" value="<?php echo $this->_aVars['iTotalVideos']; ?>" />
				<input type="hidden" name="val[job]" value="<?php echo $this->_aVars['sJob']; ?>" />
				<input type="submit" name="val[Start]" value="Start" class="button" />
			</div>
		</div>
	
</form>

</div>
<?php endif; ?>
