<?php
include('settings.php');

include('google_oauth_setup.php');

if (isset($_GET['code'])) 
{
	$GLOBALS['Google_Client']->authenticate($_GET['code']);
	//$_SESSION['access_token'] = $GLOBALS['Google_Client']->getAccessToken();
	$token = $GLOBALS['Google_Client']->getAccessToken();
	
	//header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
	ob_start();
		//debug($_SESSION);
		//debug($_REQUEST);
		echo '<pre>'.print_r($_SESSION, true).'</pre>';
		echo '<pre>'.print_r($_REQUEST, true).'</pre>';
	$output = ob_get_clean();
}

ob_start();
	if(isset($token))
	{
		$info = get_dvs_info($_SESSION['dvs_id']);
		
		set_vseo_youtube_oauth($_SESSION['dvs_id'], $token);
		$token = json_decode($token, true);
		echo '<h3>'.$info['dealer_name'].'</h3>';
		
		echo '<div class="container" >';
			echo '<div class="jumbotron" style="background-color: #dff0d8;">';
				echo '<h3 class=""><span class="glyphicon glyphicon-thumbs-up"></span> Youtube token has been created! </h3>';
			echo '</div>';
		echo '</div>';
		//echo '<pre>'.print_r($token, true).'</pre>';
	}
	//echo $output;
$content = ob_get_clean();

html_page_start();

html_header($title);

html_body($content);

html_page_end();


/*
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<link rel='stylesheet' href='style.css' />
</head>
<body>
	<header><h1>Connect VSEO to YouTube</h1></header>
	<div class="box">
		<p>dvs_id: <?php echo $_SESSION['dvs_id']; ?></p>
		
		<?php if(isset($personMarkup)): ?>
		<div class="me"><?php print $personMarkup ?></div>
		<?php endif ?>
		
		<?php if(isset($activityMarkup)): ?>
		<div class="activities">Your Activities: <?php print $activityMarkup ?></div>
		<?php endif ?>
		
		
		<?php
			echo $output;
			if(isset($authUrl)) {
				print "<a class='login' href='$authUrl'>Connect Me!</a>";
			} else {
			 print "<a class='logout' href='?logout'>Logout</a>";
			}
		?>
	</div>
	</body>
</html>
*/
