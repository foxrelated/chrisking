<?php 
include('settings.php');

include('google_oauth_setup.php');

$title = 'VSEO: Test';

$info = get_dvs_info($_REQUEST['dvs_id']);

ob_start();

	echo '<h3>'.$info['dealer_name'].'</h3>';
	echo '<div class="container" >';
		echo '<div class="jumbotron" style="background-color: #dff0d8;">';
			echo '<h3 class=""><span class="glyphicon glyphicon-thumbs-up"></span> Youtube token has been created! </h3>';
		echo '</div>';
	echo '</div>';
	$test = get_youtube_oauth_token($info);
	
	debug($test);

$content = ob_get_clean();

html_page_start();

html_header($title);

html_body($content);

html_page_end();
