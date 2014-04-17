<?php 
include('settings.php');

include('google_oauth_setup.php');

$title = 'VSEO: Dealer Settings';
$_SESSION['dvs_id'] = $_REQUEST['dvs_id'];

$info = get_dvs_info($_REQUEST['dvs_id']);

ob_start();

	echo '<h3>'.$info['dealer_name'].'</h3>';

$content = ob_get_clean();

html_page_start();

html_header($title);

html_body($content);

html_page_end();
