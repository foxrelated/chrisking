<?php 
include('settings.php');
$title = 'VSEO: Build';
//pull in video info
list($years, $makes, $models, $data) = get_videos();
ob_start();
$_SESSION['dvs_id'] = $_REQUEST['dvs_id'];
$info = get_dvs_info($_REQUEST['dvs_id']);
	//pull in any already set values 
	if(!isset($_REQUEST['pre_roll']))
		$_REQUEST['pre_roll'] = $info['pre_roll'];
	if(!isset($_REQUEST['overlay']))
		$_REQUEST['overlay'] = $info['overlay'];
	if(!isset($_REQUEST['post_roll']))
		$_REQUEST['post_roll'] = $info['post_roll'];
	
?>
	<h2>Select Videos to Create <small> for <?php echo $info['dealer_name']; ?></small></h2>
	
	<form method="post" enctype="multipart/form-data" class=""
		action="build_step_2.php?dvs_id=<?php echo $_REQUEST['dvs_id']; ?>" role="form" >
		
		<div class="row">
			<div class="form-group col-md-4">
				<label for="select_year" >Year</label>
				<select name="year" id="select_year" class="form-control" >
					<option value="">Select... </option>
					<option value="all" >*All Years*</option>
					<?php 
					foreach($years as $year)
						echo '<option value="'.$year.'" >'.$year.'</option>'
					?>
					
				</select>
			</div>
			
			<div class="form-group col-md-4">
				<label for="select_make" >Make</label>
				<select name="make" id="select_make" class="form-control" disabled >
					<option value="">Select... </option>
					<?php 
					foreach($makes as $make)
						echo '<option value="'.$make.'" >'.$make.'</option>'
					?>
				</select>
			</div>
			
			
			<div class="form-group col-md-4">
				<label for="select_model" >Model</label>
				<select name="model" id="select_model" class="form-control" disabled >
					<option value="">Select... </option>
					<option value="all" >*All Models*</option>
					<?php 
					foreach($models as $model)
						echo '<option value="'.$model.'" >'.$model.'</option>'
					?>
					
				</select>
			</div>
		</div>
		
		<div align="left">
			
			<input type="submit" name="build_video_step_1" value="Continue" class="pull-right btn btn-lg btn-primary" />
			
			<p class="pull-right text-center" >
				Videos <br/><span id="video_count" >?</span>
			</p>
			
		</div>
	</form>
	<script>
		$(document).ready(function() 
		{
			$('select').on('change', function(event)
			{
				var form = $('form').serializeArray();
				form.push({name: 'method', value: 'videos_to_create'});
				
				$.ajax(
				{
					dataType:'json',
					url: 'ajax.php',
					data: form,
					success: function(msg)
					{
						$('#video_count').html(msg.count);
					}
				});
				
			});
			
			$('#select_year').on('change', function(event)
			{
				var form = $('form').serializeArray();
				form.push({name: 'method', value: 'select_year'});
				console.log(form);
				
				$.ajax(
				{
					dataType:'json', url: 'ajax.php', data: form,
					success: function(msg)
					{
						console.log(msg);
						$('#select_make').html(msg.makes).removeAttr('disabled').focus();
						$('#select_model').html(msg.models);
					}
				});
				
			});
			
			$('#select_make').on('change', function(event)
			{
				var form = $('form').serializeArray();
				form.push({name: 'method', value: 'select_make'});
				console.log(form);
				
				$.ajax(
				{
					dataType:'json', url: 'ajax.php', data: form,
					success: function(msg)
					{
						console.log(msg);
						$('#select_model').html(msg.models).removeAttr('disabled').focus();
						
					}
				});
				
			});
		});
		
	</script>
<?php
//echo '<pre>'.print_r( $videos , true).'</pre>';

$content = ob_get_clean();

html_page_start();

html_header($title);

html_body($content);

html_page_end();
