<?php 
/* Stupeflix */
	//james
	//define('stupeflixAccessKey', 'ezog4zfgxnh4o');
	//define('stupeflixSecretKey', 'RQNIWHJIZVDD3BPSR4VOMYRMGE');
	
	//colin
	define('stupeflixAccessKey', 'ptxmxjb3bfh46');
	define('stupeflixSecretKey', 'PCLYZKM7HZAXXEEKK57PIKGPXE');
	
	define('stupeflixHost', 'http://services.stupeflix.com/');
	
	

/* Includes */
	$GLBOALS['sub_directory'] = '/vseo';
	//from: http://requests.ryanmccue.info/docs/usage.html
	include($_SERVER['DOCUMENT_ROOT'].$GLBOALS['sub_directory'].'/Requests-1.6.0/library/Requests.php');
	Requests::register_autoloader();
	
	include($_SERVER['DOCUMENT_ROOT'].$GLBOALS['sub_directory'].'/stupeflix_functions.php');
	
	include($_SERVER['DOCUMENT_ROOT'].$GLBOALS['sub_directory'].'/functions.php');

/* Video source */
	$GLOBALS['video_source_url'] = 'http://wheelstv.net/vseo/';
	$GLOBALS['video_extensions'] = array('flv', 'mp4', 'mov');

/* DB Settings */
	//if installed in phpfox, use this
	
	define('PHPFOX', true);
	include($_SERVER['DOCUMENT_ROOT'].'/include/setting/server.sett.php');
	$GLOBALS['db_connection'] = mysql_connect($_CONF['db']['host'], $_CONF['db']['user'], $_CONF['db']['pass']);
	mysql_select_db($_CONF['db']['name'], $GLOBALS['db_connection']);
	
	
	//setup for my server
	//$GLOBALS['db_connection'] = mysql_connect('localhost', 'james', '');
	//mysql_select_db('wheelstv_dev', $GLOBALS['db_connection']);
	//$_CONF['db']['prefix'] = 'phpfox_';

/* Tables */
	$GLOBALS['dvs_table'] = $_CONF['db']['prefix'].'ko_dvs';
	$GLOBALS['vseo_table'] = $_CONF['db']['prefix'].'vseo';

/* Google Api key */
	//James' key
	$GLOBALS['google_api_dev_key'] = 'AIzaSyAXt0PsNT-egZKxwSlWINXTBNkwqZK7z9Q';

//kick off the session - should probably use php.ini setting.... but this ensures we have it going
session_start();


/* HTML settings and such */
	include 'html_functions.php';
	$GLOBALS['css']["bootstrap"] = array(
				"media" => "all",
				"source" => "//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css"
			);
	
	$GLOBALS['js']['jquery'] = 'https://code.jquery.com/jquery-1.10.2.min.js';
	$GLOBALS['js']['bootstrap'] = '//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js';


