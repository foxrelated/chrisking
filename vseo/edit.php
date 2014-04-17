<?php 
include('settings.php');
$title = 'Edit VSEO Settings';
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
	
	echo '<h3>'.$info['dealer_name'].'</h3>';
	
	if(isset($_REQUEST['save']))
	{//process
		set_vseo($_REQUEST['dvs_id'], $_REQUEST['pre_roll'], $_REQUEST['overlay'], $_REQUEST['post_roll']);
		echo '<p style="color: green" >Settings Saved!</p>';
	}
	
	//show form
	include(__DIR__.'/forms.php');
	echo $edit_form; 
	
	if($_REQUEST['youtube_oauth_access_token'] != NULL)
	{
		echo '<p>YouTube Access Has been set up</p>';
	}
	else
	{
		echo '<p><a href="oauth2callback.php" >Set Up YouTube Connection</a></p>';
	}
$content = ob_get_clean();


/*
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Edit VSEO Settings</title>
	</head>
	<body>
		<h1>Manual VSEO Tool by James Nadeau(james.nadeau@gmail.com)</h1>
		<?php echo $content; ?>
	</body>
</html>
*/


html_page_start();

html_header($title);

html_body($content);

html_page_end();
