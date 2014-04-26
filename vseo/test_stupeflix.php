<?php 
include('settings.php');


$xml_str = '
<movie service="craftsman-1.0">
	<body>
		<overlay duration="1.0" margin-end="0.0" width="1.0">
			<image filename="http://assets.stupeflix.com/code/images/Monument_Valley.jpg"/>
		</overlay>
	</body>
</movie>';
$headers = array('Authorization' => 'Secret '.stupeflixSecretKey);
$data = array
(
	'tasks' => array
	(
		'task_name' => 'video.create', 
		'definition' => $xml_str
	)
);

$response = Requests::post('https://dragon.stupeflix.com/v1/create', $headers, json_encode($data));

$response = json_decode($response->body, true);
$export_url = $response[0]['result']['export'];
//print_r($response);

$data = array
(
	'tasks' => $response[0]['key']
);

//print_r($data);

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


//upload it to youtube
$data = array(
	'tasks' => array
	(
		'task_name' => 'video.upload.youtube',
		'url' => $export_url,
		'access_token' => '1/70kRwIEhAU557bJvha76ufj1jRHpYvAqwDGNZo-CXCc',
		'developer_key' => $GLOBALS['google_api_dev_key'],
		'title' => 'test stupeflix video upload',
		'description' => 'test description',
		//'tags' => array(),
		//'category_id' => '',
		//'privacy_status' => '',
		)
);

$upload_response = Requests::post('https://dragon.stupeflix.com/v1/create', $headers, json_encode($data));
print_r($upload_response);
$upload_response = json_decode($response->body, true);
print_r($upload_response);

