<?php 
include('settings.php');

ob_start();
	
	$info = get_dvs_info($_SESSION['dvs_id']);
	//pull in any already set values 
	if(!isset($_REQUEST['pre_roll']))
		$_REQUEST['pre_roll'] = $info['pre_roll'];
	if(!isset($_REQUEST['overlay']))
		$_REQUEST['overlay'] = $info['overlay'];
	if(!isset($_REQUEST['post_roll']))
		$_REQUEST['post_roll'] = $info['post_roll'];
	
	echo '<h3>'.$info['dealer_name'].'</h3>';
	
	//echo '<pre>'.print_r($_REQUEST, true).'</pre>';
	
	$xml = 
"<movie service='craftsman-1.0'>
	<body>
		";
	
	if($_REQUEST['pre_roll'] != NULL)
	{
		$xml .= 
		"<overlay><video filename='{$_REQUEST['pre_roll']}' /></overlay>";
	}
	
	if($_REQUEST['overlay'] != NULL)
	{
		$xml .= "<stack>";
		
	}
	
	//Main video content
		$xml .= "<overlay><video filename='http://wheelstv.net/sandbox/vseo-assets/video.mov' /></overlay>";
	
	
	if($_REQUEST['overlay'] != NULL)
	{
		$xml .= "<overlay width='1' height='1' ><image filename='{$_REQUEST['overlay']}' /></overlay>
		</stack>";
	}
	
	
	if($_REQUEST['post_roll'] != NULL)
	{
		$xml .= "<overlay><video filename='".$_REQUEST['post_roll']."' /></overlay>";
	}
	
	$xml .= "
	</body>
</movie>";
	
$content = ob_get_clean();


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Add VSEO</title>
		
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="status.js"></script>
	</head>
	<body>
		<h1>Manual VSEO Tool by James Nadeau(james.nadeau@gmail.com)</h1>
		<?php echo $content; ?>
		<ol class="video_status" ></ol>
		<script>
		var proxy_url = 'proxy.php';
		var $progressbar = $( "#progressbar" );
		
		
		var video_xml = <?php echo json_encode($xml); ?>;
		console.log(video_xml);
		var in_queue = false;
		function start_video_generation(xml)
		{
			
			var jqxhr = $.ajax(proxy_url+'?action=create',
				{
					type: 'POST',
					dataType: 'json',
					data: {video_xml: xml}
				})
				.done(function(data) 
				{
					console.log(data);
					console.log(data.response);
					console.log( " start_video_generation done" );
					if(in_queue == true)
					{
						$('.video_status:last-child').html($('.video_status:last-child').html()+'.');
					}
					else if(data.export_url == null)
					{
						in_queue = true;
						setTimeout(start_video_generation(xml), 5000);
						$('.video_status').append('<li>Video has put into queue! Please wait until it is finished.</li>');
						$('.video_status').append('<li>.</li>');
					}
					else
					{
						$('.video_status').append('<li>Video has been created!</li><li>Starting upload to youtube.</li>');
						upload_to_youtube(data.export_url);
					}
				});
		}
		
		function upload_to_youtube(export_url)
		{
			console.log('starting upload_to_youtube');
			console.log(export_url);
			var jqxhr = $.ajax(proxy_url+'?action=upload_to_youtube',
				{
					type: 'POST',
					dataType: 'json',
					data: {export_url: export_url}
				})
				.done(function(data) 
				{
					console.log(data);
					console.log( "upload_to_youtube done" );
					$('.video_status').append('<li>Video upload to youtube has started.</li><li>You should see this new video in your feed within the next 5 minutes.</li>');
					if(data[0].result.output != null)
					{
						$('.video_status').append('<li><a target="_blank" href="'+data[0].result.output+'" >View your upload on youtube</a></li>')
					}
				});
		}
		
		/* start everything up */
		$(function() 
		{
			console.log('document ready');
			start_video_generation(video_xml);
		});
		</script>
		
	</body>
</html>
