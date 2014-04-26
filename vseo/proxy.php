<?php 
include('settings.php');

$headers = array('Authorization' => 'Secret '.stupeflixSecretKey);

function create($headers, $xml)
{
	$data = array
	(
		'tasks' => array
		(
			'task_name' => 'video.create', 
			'definition' => $xml
		)
	);
	
	$response = Requests::post('https://dragon.stupeflix.com/v1/create', $headers, json_encode($data));
	
	$response = json_decode($response->body, true);
	//print_r($response);
	
	$data = array(
		'task_key' => $response[0]['key'],
		'export_url' => $response[0]['result']['export'],
		//'data' => $data,
		'response' => $response
		);
	echo json_encode($data);
}

function status($headers, $task_key)
{
	$data = array
	(
		'tasks' => $task_key
	);
	
	$continue = true;
	while($continue)
	{
		$response = Requests::post('https://dragon.stupeflix.com/v1/status', $headers, json_encode($data));
		$response = json_decode($response->body, true);
		if($response[0]['status'] == 'success')
		{
			//var_dump($response);
			
			echo "ALL DONE. going to start upload \r\n";
			$continue = false;
		}
		else
		{
			echo "\r\n";
			var_dump($response);
		}
		sleep(1);
	}
}

function upload_to_youtube($headers, $export_url)
{
	include('google_oauth_setup.php');
	$info = get_dvs_info($_SESSION['dvs_id']);
	
	//upload it to youtube
	$data = array(
		'tasks' => array
		(
			'task_name' => 'video.upload.youtube',
			'url' => $export_url,
			//'access_token' => '1/70kRwIEhAU557bJvha76ufj1jRHpYvAqwDGNZo-CXCc',
			'access_token' => get_youtube_oauth_token($info),
			'developer_key' => $GLOBALS['google_api_dev_key'],
			'title' => $_REQUEST['title'],
			'description' => $_REQUEST['description'],
			//'tags' => array(),
			//'category_id' => '',
			//'privacy_status' => '',
			)
	);
	
	$upload_response = Requests::post('https://dragon.stupeflix.com/v1/create', $headers, json_encode($data));
	
	//$upload_response = json_decode($upload_response, true);
	echo $upload_response->body;
}

switch($_REQUEST['action'])
{
	case 'create';
		create($headers, $_REQUEST['video_xml']);
		break;
	
	case 'status';
		status($headers, $_REQUEST['task_key']);
		break;
	
	case 'upload_to_youtube';
		upload_to_youtube($headers, $_REQUEST['export_url']);
		break;
}
