<?php 
require_once 'google-api-php-client/src/Google_Client.php';
//require_once 'google-api-php-client/src/contrib/Google_PlusService.php';
require_once 'google-api-php-client/src/contrib/Google_YouTubeService.php';

session_start();

$GLOBALS['Google_Client'] = new Google_Client();
$GLOBALS['Google_Client']->setApplicationName("Google+ PHP Starter Application");
// Visit https://code.google.com/apis/console to generate your
// oauth2_client_id, oauth2_client_secret, and to register your oauth2_redirect_uri.
$GLOBALS['Google_Client']->setClientId('837103978833.apps.googleusercontent.com');
$GLOBALS['Google_Client']->setClientSecret('Ul6oRDQKy3b5XlbuAa9yibwD');
//$client->setRedirectUri('http://'.$_SERVER['HTTP_HOST'].'/oauth2callback.php');
$GLOBALS['Google_Client']->setRedirectUri('http://wheelstv.vseo.jamesjnadeau.com/oauth2callback.php');
//$client->setDeveloperKey('AIzaSyAXt0PsNT-egZKxwSlWINXTBNkwqZK7z9Q');
$GLOBALS['Google_Client']->setDeveloperKey($GLOBALS['google_api_dev_key']);
$GLOBALS['Google_Client']->setAccessType('offline');

//$plus = new Google_PlusService($client);

$GLOBALS['Google_Client']->setScopes('https://www.googleapis.com/auth/youtube.upload');
//$youtube = new Google_YouTubeService($client);


/*
//if (isset($_REQUEST['logout'])) 
{
	unset($_SESSION['access_token']);
}

if (isset($_GET['code'])) 
{
	$client->authenticate($_GET['code']);
	$_SESSION['access_token'] = $client->getAccessToken();
	//header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
	ob_start();
		//debug($_SESSION);
		//debug($_REQUEST);
		echo '<pre>'.print_r($_SESSION, true).'</pre>';
		echo '<pre>'.print_r($_REQUEST, true).'</pre>';
	$output = ob_get_clean();
}

if (isset($_SESSION['access_token'])) 
{
	$client->setAccessToken($_SESSION['access_token']);
}

if ($client->getAccessToken()) 
{
	// The access token may have been updated lazily.
	$_SESSION['access_token'] = $client->getAccessToken();
} 
else 
{
	$authUrl = $client->createAuthUrl();
}
*/
