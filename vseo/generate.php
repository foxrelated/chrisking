<?php 
include('settings.php');
$title = 'VSEO: Generate videos';
ob_start();

	$info = get_dvs_info($_SESSION['dvs_id']);
	
	//handle file uploads
	if(isset($_REQUEST['dvs_bumper']))
	{
		switch($_REQUEST['dvs_bumper'])
		{
			case 'dvs_bumper_upload';
				$bumper = handle_file_upload($_SESSION['dvs_id'], 'bumper', 'dvs_bumper_file');
				break;
			
			case 'dvs_bumper_custom';
				$bumper = $_REQUEST['dvs_bumper_url'];
				set_vseo_bumper($_SESSION['dvs_id'], $_REQUEST['dvs_bumper_url']);
				break;
			
			default;
				$bumper = $info['bumper'];
				break;
		}
	}
	
	if(isset($_REQUEST['dvs_overlay']))
	{
		switch($_REQUEST['dvs_overlay'])
		{
			case 'dvs_overlay_upload';
				$overlay = handle_file_upload($_SESSION['dvs_id'], 'overlay', 'dvs_overlay_file');
				$overlay = 'http://'.$_SERVER['HTTP_HOST'].$overlay;
				break;
			
			case 'dvs_overlay_custom';
				$overlay = $_REQUEST['dvs_overlay_url'];
				set_vseo_overlay($_SESSION['dvs_id'], $_REQUEST['dvs_overlay_url']);
				break;
			
			default;
				$overlay = 'http://'.$_SERVER['HTTP_HOST'].$info['overlay'];
				break;
		}
	}
	
	
	list($years, $makes, $models, $videos) = get_videos();
	
	//pull in any already set values 
	$settings = unserialize($_REQUEST['model_settings']);
	
	//count the number of videos we are going to create
	$number_of_videos = 0;
	$debug = array();
	
	$video_data = array();
	
	
	foreach($videos as $value)
	{
		$title_template = $_REQUEST['title'];
		$description_template = $_REQUEST['description'];
		$tags_template = $_REQUEST['tags'];
		$value[0] = $GLOBALS['video_source_url'].$value[0];
		
		if($value[1] == $settings['year'] || $settings['year'] == 'all')
		{
			if($value[2] == $settings['make'])
			{
				if($value[3] == $settings['model'] || $settings['model'] == 'all')
				{
					$number_of_videos++;
					
					//generate description
					process_template($title_template, 'year', $value[1]);
					process_template($description_template, 'year', $value[1]);
					process_template($tags_template, 'year', $value[1]);
					
					process_template($title_template, 'make', $value[2]);
					process_template($description_template, 'make', $value[2]);
					process_template($tags_template, 'make', $value[2]);
					
					process_template($title_template, 'model', $value[3]);
					process_template($description_template, 'model', $value[3]);
					process_template($tags_template, 'model', $value[3]);
					
					process_template($title_template, 'dealer_name', $info['dealer_name']);
					process_template($description_template, 'dealer_name', $info['dealer_name']);
					process_template($tags_template, 'dealer_name', $info['dealer_name']);
					
					process_template($title_template, 'dealer_city', $info['city']);
					process_template($description_template, 'dealer_city', $info['city']);
					process_template($tags_template, 'dealer_city', $info['city']);
					
					process_template($title_template, 'dealer_state', $info['name']);
					process_template($description_template, 'dealer_state', $info['name']);
					process_template($tags_template, 'dealer_state', $info['name']);
					
					process_template($title_template, 'dvs_url', $info['url']);
					process_template($description_template, 'dvs_url', $info['url']);
					process_template($tags_template, 'dvs_url', $info['url']);
					
					$xml = get_video_xml_custom($bumper, $overlay, $value[0]);
					//$xml = print_r(array($bumper, $overlay, $value[0]), true);
					
					$video_data[] = array
					(
						'info' => $value,
						'title' => $title_template,
						'description' => $description_template,
						'video_xml' => $xml,
						'video_xml_display' => htmlentities($xml)
					);
				}
			}
		}
	}
	
?>
	<h2>Generating Videos <small> for <?php echo $info['dealer_name']; ?></small></h2>
	
	<h5>Total Videos to Create: <span id="total_videos_to_create" ><?php echo $number_of_videos; ?></span></h5>
	<p>Feel free to refresh this page if you think it's stuck, your videos will only be uploaded once per 24 hours</p>
	<div class="uploads" >
		
	</div>
	
	<div class="video_upload template" style="display: none;" >
		<div class="progress">
			<div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
				<span class="sr-only"><span class="completion_text">0%</span> Complete</span>
			</div>
		</div>
		<p class="uploaded" style="display: none;" >
			<i class="glyphicon glyphicon-check" ></i> Video has been uploaded to youtube
		</p>
		<div class="status"></div>
		<hr/>
	</div>
	
	
	<script>
		var number_of_videos = <?php echo $number_of_videos; ?>;
		var video_info = <?php echo json_encode($video_data); ?>;
		
		var info_modal_template = <?php echo json_encode('
<!-- Button trigger modal -->
<button class="btn btn-primary btn-xs pull-right open_button" data-toggle="modal" data-target="#myModal">
	View Info
</button>

<!-- Modal -->
<div class="modal fade modal_window" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Modal title</h4>
			</div>
		<div class="modal-body">
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			<!-- <button type="button" class="btn btn-primary">Save changes</button> -->
		</div>
	</div>
	</div>
</div>'); ?>;
		
		function update_progress_bar(bar, percentage)
		{
			bar.css('width', percentage+'%');
			//bar.find('.completion_text').
		}
		
		function percentwidth(elem)
		{
			var current_percentage;
			var current_value;
			var this_size;
			var parent_size;
			this_size = elem.width();
			parent_size = elem.parent().width();
			
			current_percentage = Math.round(100 * this_size / parent_size);
			current_value = Math.round(this_size / parent_size * 100);
			
			//console.log(current_percentage);
			//console.log(current_value);
			return current_percentage;
		}
		
		var proxy_url = 'proxy.php';
		var call_timeout = 2000;
		var in_queue = false;
		
		function start_video_generation(xml, title, description, $progressbar, $status)
		{
			
			$.ajax(
			{ 
				url: proxy_url+'?action=create',
				type: 'POST',
				dataType: 'json',
				data: {video_xml: xml},
				success: function(data) 
				{
					console.log(data);
					console.log(data.response);
					console.log( "checking video generation" );
					if(data.export_url == null)
					{
						in_queue = true;
						$status.html('<h5>Queued</h5>');
						
						var my_percentage = percentwidth($progressbar);
						
						my_percentage++;
						
						if(my_percentage > 50)
							my_percentage = 25;
						
						update_progress_bar($progressbar, my_percentage);
						setTimeout(start_video_generation(xml, title, description, $progressbar, $status), call_timeout);
					}
					else
					{
						$status.html('<h5>Video Created</h5>');
						//video created
						update_progress_bar($progressbar, 50);
						console.log('starting upload_to_youtube');
						upload_to_youtube(data.export_url, title, description,  $progressbar, $status);
					}
				}
			});
		}
		
		function upload_to_youtube(export_url, title, description,  $progressbar, $status)
		{
			console.log('checking upload_to_youtube');
			console.log(export_url);
			var jqxhr = $.ajax(
				{
					url: proxy_url+'?action=upload_to_youtube',
					type: 'POST',
					dataType: 'json',
					data: {export_url: export_url, title: title, description: description},
					success: function(data) 
					{
						console.log(data);
						console.log( "upload_to_youtube done" );
						//$('.video_status').append('<li>Video upload to youtube has started.</li><li>You should see this new video in your feed within the next 5 minutes.</li>');
						//upload started
						if(data[0].status == 'queued')
						{
							$status.html('<h5>Upload to youtube Queued</h5>');
							var my_percentage = percentwidth($progressbar);
							my_percentage++;
							
							if(my_percentage > 99)
								my_percentage = 75;
							update_progress_bar($progressbar,my_percentage);
							
							setTimeout( upload_to_youtube(export_url, title, description, $progressbar, $status), call_timeout);
						}
						else if('result' in data[0])
						{
							update_progress_bar($progressbar,100);
							$progressbar.addClass('progress-bar-success');
							$status.html('<h5><i class="glyphicon glyphicon-thumbs-up"></i> Done <a target="_blank" href="'+data[0].result.output+'" >View your upload on youtube</a></h5>');
							
							//$('.video_status').append('<li><a target="_blank" href="'+data[0].result.output+'" >View your upload on youtube</a></li>')
						}
					}
				});
		}
		
		$(document).ready(function()
		{
			var video_count = 0;
			
			var $uploads_container = $('.uploads');
			var check_timeout = 1000;
			
			var $video_upload_template = $('.video_upload.template');
			console.log($video_upload_template);
			
			var $new_upload;
			
			function create_new_upload()
			{
				$new_upload = $video_upload_template.clone();
				
				var modal = $(info_modal_template);
				modal.find('.modal-body').html(video_info[video_count].description 
					+ '<hr>' 
					+ '<a href="' + video_info[video_count].info[0] + '" target="_blank" >Video File</a>'
					+ '<hr>' 
					+ '<pre>' + video_info[video_count].video_xml_display + '</pre>'
				);
				modal.find('.modal-title').html(video_info[video_count].title);
				var my_modal_id = modal.find('.modal_window').attr('id') + '_' + video_count;
				modal.find('.open_button').attr('data-target', '#'+my_modal_id);
				modal.find('.modal_window').attr('id', my_modal_id);
				$uploads_container.append(modal);
				
				var display_count = video_count+1; 
				$uploads_container.append('<h5>'+display_count+'/<?php echo $number_of_videos; ?> - ' + video_info[video_count].title + ' </h5>');
				$uploads_container.append($new_upload);
				
				
				video_count++;
				$new_upload.show();
			}
			//create first one
			create_new_upload();
			
			
			function process_videos()
			{
				var $bar = $new_upload.find('.progress-bar');
				console.log(video_count);
				console.log(video_info[video_count-1]);
				$status = $new_upload.find('.status');
				//$uploads_container.append($status);
				
				start_video_generation(video_info[video_count-1].video_xml, 
					video_info[video_count-1].title,
					video_info[video_count-1].description,
					$bar, $status);
				
				console.log('making a new one');
				if(video_count < number_of_videos)
				{
					setTimeout(function()
					{
						//create new one
						create_new_upload();
						process_videos();
					}, check_timeout);
				}
				else
				{//ALL DONE!
					console.log('all_done');
				}
				
				/*
				//get current bars width/percentage
				var my_percentage = percentwidth($bar);
				
				my_percentage += 25;
				update_progress_bar($bar, my_percentage)
				
				if (my_percentage == 100)
				{
					console.log(video_count+' <= '+number_of_videos);
					if(video_count < number_of_videos)
					{
						
						$new_upload.find('.uploaded').show();
						$bar.addClass('progress-bar-success');
						console.log('making a new one');
						
						setTimeout(function()
						{
							//create new one
							create_new_upload();
							process_videos();
						}, check_timeout);
					}
					else
					{//ALL DONE!
						$new_upload.find('.uploaded').show();
						$bar.addClass('progress-bar-success');
						
						$uploads_container.append('<h3><i class="glyphicon glyphicon-thumbs-up"></i> Done</h3>');
					}
				}
				else
				{
					console.log(my_percentage);
					setTimeout(function()
					{
						process_videos();
					}, check_timeout);
				}
				*/
				//console.log(my_percentage);
			}
			
			setTimeout(function()
			{
				//process_videos();
				console.log('process_videos done');
			}, check_timeout);
		});
	</script>
<?php
//debug($info);
//debug($video_data);
//debug($settings);
//debug($_REQUEST);

$content = ob_get_clean();

html_page_start();

html_header($title);

html_body($content);

html_page_end();
