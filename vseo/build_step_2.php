<?php 
include('settings.php');
$title = 'WheelsTV VSEO: Build Branding';
ob_start();

	$info = get_dvs_info($_REQUEST['dvs_id']);
	//pull in any already set values 
	if(!isset($_REQUEST['pre_roll']))
		$_REQUEST['pre_roll'] = $info['pre_roll'];
	if(!isset($_REQUEST['overlay']))
		$_REQUEST['overlay'] = $info['overlay'];
	if(!isset($_REQUEST['post_roll']))
		$_REQUEST['post_roll'] = $info['post_roll'];
	
	//debug($info);

?>
	<h2>Select Video Branding <small> for <?php echo $info['dealer_name']; ?></small></h2>
	<form method="post" enctype="multipart/form-data" action="generate.php?dvs_id=<?php echo $_REQUEST['dvs_id']; ?>" >
		
		<div class="panel panel-default" >
			<div class="panel-heading">
				<h5><b>Bumper</b> <small>(image or video of type: <?php echo implode(', ', $GLOBALS['video_extensions']); ?>)</small></h5>
			</div>
			<div class="panel-body" >
				
				<div >
					<!--
					<input type="radio" disabled name="dvs_bumper" id="dvs_bumper_auto" value="dvs_bumper_auto" />
					<label for="dvs_bumper_auto" class="text-muted" >Auto Generate </label>
					<div class="clearfix" ></div>
					-->
					
					
					<input type="radio" checked name="dvs_bumper" id="dvs_bumper_custom" value="dvs_bumper_custom" />
					<label for="dvs_bumper_custom_upload">Custom: </label>
					<div class="form-group" id="dvs_bumper_custom_upload" >
						<label for="dvs_bumper_upload"> URL: </label>
						<input name="dvs_bumper_url" type="text" id="dvs_bumper_upload" class="form-control" />
					</div>
					<div class="clearfix" ></div>
					
					<?php 
					if($info['bumper'] != '')
					{
						?>
						<input type="radio" checked name="dvs_bumper" id="dvs_bumper_current" value="dvs_bumper_current" />
						<label for="dvs_bumper_current">Current: </label>
						<div class="form-group" id="dvs_bumper_current_file" >
							<?php 
								echo '<a target="_blank" href="'.$info['bumper'].'" class="btn btn-sm btn-info" >View</a>';
							?>
						</div>
						<div class="clearfix" ></div>
						<script>$('#dvs_bumper_custom_upload:visible').toggle();</script>
						<?php
					}
					?>
					
					<input type="radio" name="dvs_bumper" id="dvs_bumper_upload" value="dvs_bumper_upload" />
					<label for="dvs_bumper_upload">Upload: </label>
					<div class="form-group" id="dvs_bumper_custom_file" style="display: none;" >
						<label for="dvs_bumper_file"> Upload dvs_bumper File: </label>
						<input name="dvs_bumper_file" type="file" id="dvs_bumper_file" class="form-control" />
					</div>
					<div class="clearfix" ></div>
					
					
				</div>
				
			</div>
		</div>
		
		<div class="panel panel-default" >
			<div class="panel-heading">
				<h5><b>Overlay</b> <small>(image)</small></h5>
			</div>
			
			<div class="panel-body" >
					<!--
					<input type="radio" disabled name="dvs_overlay" id="dvs_overlay_auto" value="dvs_overlay_auto" />
					<label for="dvs_overlay_auto" class="text-muted" >Auto Generate </label>
					<div class="clearfix" ></div>
					-->
					
					<input type="radio" checked name="dvs_overlay" id="dvs_overlay_custom" value="dvs_overlay_custom" />
					<label for="dvs_overlay_custom_upload">Custom: </label>
					<div class="form-group" id="dvs_overlay_custom_upload" >
						<label for="dvs_overlay_upload"> URL: </label>
						<input name="dvs_overlay_url" type="text" id="dvs_overlay_upload" class="form-control" />
					</div>
					<div class="clearfix" ></div>
					
					<?php 
					if($info['overlay'] != '')
					{
						?>
						<input type="radio" checked name="dvs_overlay" id="dvs_overlay_current" value="dvs_overlay_current" />
						<label for="dvs_overlay_current">Current: </label>
						<div class="form-group" id="dvs_overlay_current_file" >
							<?php 
								echo '<a target="_blank" href="'.$info['overlay'].'" class="btn btn-sm btn-info" >View</a>';
							?>
						</div>
						<div class="clearfix" ></div>
						<script>$('#dvs_overlay_custom_upload:visible').toggle();</script>
						<?php
					}
					?>
					
					<input type="radio" name="dvs_overlay" id="dvs_overlay_upload" value="dvs_overlay_upload" />
					<label for="dvs_overlay_upload">Upload: </label>
					<div class="form-group" id="dvs_overlay_custom_file" style="display: none;" >
						<label for="dvs_overlay_file"> Upload dvs_overlay File: </label>
						<input name="dvs_overlay_file" type="file" id="dvs_overlay_file" class="form-control" />
					</div>
					<div class="clearfix" ></div>
					
					
			</div>
			
		</div>
		
		<div class="panel panel-default" >
			<div class="panel-heading">
				<h5><b>SEO</b> <small>(uploaded title and description templates)</small></h5>
			</div>
			<div class="panel-body" >
				<div class="form-group">
					<label for="textfield2">Title</label>
					<input name="title" type="text" id="textfield2" 
						value="{year} {make} {model} - {dealer_name} - {dealer_city}, {dealer_state}" size="60" class="form-control" />
				</div>
				
				<div class="form-group" >
					<label for="textarea">Description</label>
					<textarea name="description" id="textarea" cols="45" rows="5" class="form-control" >
Get a great deal on this {year} {make} {model} from {dealer_name} in {dealer_city}, {dealer_state}. Click the link to check out our {model} Inventory Listings: {dvs_url}
					</textarea>
				</div>
			</div>
		</div>
		
		<div align="left">
			<p>
				<input type="submit" name="build_video_step_1" value="Generate Videos" class="pull-right btn btn-lg btn-primary" />
			</p>
		</div>
		
		<input type="hidden" name="model_settings" value='<?php echo serialize($_REQUEST);?>' />
	</form>
<script>
$(document).ready(function()
{
	$("[name=dvs_bumper]").on('change', function(event)
	{
		
		var $this = $(this);
		
		$('#dvs_bumper_custom_upload:visible').slideUp();
		$('#dvs_bumper_custom_file:visible').slideUp();
		$('#dvs_bumper_current_file:visible').slideUp();
		
		console.log($this.val());
		switch($this.val())
		{
			case 'dvs_bumper_upload':
				$('#dvs_bumper_custom_file').slideToggle();
				break;
			
			case 'dvs_bumper_custom':
				$('#dvs_bumper_custom_upload').slideToggle();
				break;
			
			case 'dvs_bumper_current':
				$('#dvs_bumper_current_file').slideToggle();
				break;
		}
		
		
	});
	
	$("[name=dvs_overlay]").on('change', function(event)
	{
		
		var $this = $(this);
		
		$('#dvs_overlay_custom_upload:visible').slideUp();
		$('#dvs_overlay_custom_file:visible').slideUp();
		$('#dvs_overlay_current_file:visible').slideUp();
		
		console.log($this.val());
		switch($this.val())
		{
			case 'dvs_overlay_upload':
				$('#dvs_overlay_custom_file').slideToggle();
				break;
			
			case 'dvs_overlay_custom':
				$('#dvs_overlay_custom_upload').slideToggle();
				break;
			
			case 'dvs_overlay_current':
				$('#dvs_overlay_current_file').slideToggle();
				break;
		}
		
		
	});
});
</script>


<?php

//echo '<pre>'.print_r($_REQUEST, true).'</pre>';
//echo '<pre>'.print_r($info, true).'</pre>';

$content = ob_get_clean();

html_page_start();

html_header($title);

html_body($content);

html_page_end();
