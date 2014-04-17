<?php

function get_all_dvs()
{
	$dvs_id = mysql_real_escape_string($dvs_id);
	$query = "SELECT dvs.*, vseo.youtube_oauth_access_token, cc.name
		FROM {$GLOBALS['dvs_table']} dvs
		LEFT JOIN {$GLOBALS['vseo_table']} vseo on dvs.dvs_id = vseo.dvs_id
		LEFT JOIN phpfox_country_child cc on dvs.country_child_id = cc.child_id
		";
	$GLOBALS['debug_query'] = $query;
	$result = mysql_query($query);
	//debug($query);
	while($temp = mysql_fetch_assoc($result))
	{
		$info[] = $temp;
	}
	
	return $info;
}

function get_dvs_info($dvs_id)
{
	$dvs_id = mysql_real_escape_string($dvs_id);
	$query = "SELECT * from {$GLOBALS['dvs_table']} dvs
		LEFT JOIN {$GLOBALS['vseo_table']} vseo on dvs.dvs_id = vseo.dvs_id
		LEFT JOIN phpfox_country_child cc on dvs.country_child_id = cc.child_id
		WHERE dvs.dvs_id = $dvs_id";
	$GLOBALS['debug_query'] = $query;
	$result = mysql_query($query);
	
	$info = mysql_fetch_assoc($result);
	
	return $info;
}

function set_vseo($dvs_id, $pre_roll, $overlay, $post_roll)
{
	$dvs_id = mysql_real_escape_string($dvs_id);
	$pre_roll = mysql_real_escape_string($pre_roll);
	$overlay = mysql_real_escape_string($overlay);
	$post_roll = mysql_real_escape_string($post_roll);
	
	$query = "INSERT INTO {$GLOBALS['vseo_table']} (dvs_id, pre_roll, overlay, post_roll)
		VALUES ($dvs_id, '$pre_roll', '$overlay', '$post_roll' )
		ON DUPLICATE KEY UPDATE 
			pre_roll = '$pre_roll',
			overlay = '$overlay', 
			post_roll = '$post_roll'
		";
		
	$result = mysql_query($query);
}


function set_vseo_youtube_oauth($dvs_id, $youtube_oauth_access_token)
{
	$dvs_id = mysql_real_escape_string($dvs_id);
	$youtube_oauth_access_token = mysql_real_escape_string($youtube_oauth_access_token);
	
	$query = "INSERT INTO {$GLOBALS['vseo_table']} (dvs_id, youtube_oauth_access_token)
		VALUES ($dvs_id, '$youtube_oauth_access_token')
		ON DUPLICATE KEY UPDATE 
			youtube_oauth_access_token = '$youtube_oauth_access_token'
		";
		
	$result = mysql_query($query);
}

function get_video_xml( $dealer_logo, $dealer_name, $video)
{
	$font_color = '#ffffff';
	$xml = 
"<movie service='craftsman-1.0'>
	<body>
		<overlay>
			<image width='1' height='1' alighn='center' filename='http://www.jamesjnadeau.com/files/wheelstv/vseo-bumper-template-blank.png' />
			<text type='zone' fontcolor='$font_color' width='.5' height='.1' align='center' >
				$dealer_name
			</text>
			<image width='.5' top='.1' left='.2' filename='$dealer_logo' />
		</overlay>
		<stack>
			<overlay><video filename='$video' /></overlay>
			
			<overlay width='.1' left='.9' ><image filename='{$dealer_logo}' /></overlay>
			<text type='zone' fontcolor='$font_color' width='.3' height='.1' align='center' >
				$dealer_name
			</text>
		</stack>
		<overlay><video filename='".$bumper."' /></overlay>
	</body>
</movie>";
	
	return $xml;
}

function get_video_xml_custom( $bumper, $overlay, $video)
{
	$font_color = '#ffffff';
	
	$bumper_parts = explode('.', $bumper);
	$bumper_end = count($bumper_parts) - 1;
	$bumper_end = $bumper_parts[$bumper_end];
	
	if(in_array($bumper_end, $GLOBALS['video_extensions']))
	{
		$bumper = "<effect type='none' ><video filename='$bumper' /></effect>";
	}
	else
	{//treat as an image
		$bumper = "<effect type='none' ><image width='1' height='1'  filename='$bumper' /></effect>";
	}
	
	
	$xml = 
"<movie service='craftsman-1.0'>
	<body>
		$bumper
		<stack>
			<effect type='none' >
				<video filename='$video' />
			</effect>
			<overlay width='1' height='1' ><image filename='$overlay' /></overlay>
		</stack>
		$bumper
	</body>
</movie>";
	
	return $xml;
}

function get_videos()
{
	if(isset($_SESSION['video_info']))
	{
		$years = $_SESSION['video_info']['years'];
		$makes = $_SESSION['video_info']['makes'];
		$models = $_SESSION['video_info']['models'];
		$videos = $_SESSION['video_info']['models'];
	}
	else
	{
		$video_source = $GLOBALS['video_source_url'].'snippets.csv';
		if (($handle = fopen($video_source, "r")) !== FALSE) 
		{
			//skip the first row
			$data = fgetcsv($handle, 1000, ",");
			while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) 
			{
				$num = count($data);
				//echo "<p> $num fields in line $row: <br /></p>\n";
				$row++;
				$videos[] = $data;
				
				$years[$data[1]] = true;
				$makes[$data[2]] = true;
				$models[$data[3]] = true;
				
			}
			fclose($handle);
			
			$years = array_keys($years);
			$makes = array_keys($makes);
			$models = array_keys($models);
			arsort($years);
			//arsort($makes);
			//arsort($models);
			$_SESSION['video_info']['years'] = $years;
			$_SESSION['video_info']['makes'] = $makes;
			$_SESSION['video_info']['models'] = $models;
			$_SESSION['video_info']['models'] = $videos;
		}
	}
	return array($years, $makes, $models, $videos);
}

function get_youtube_oauth_token($info)
{
	//debug($info);
	//$access_token = json_decode($info['youtube_oauth_access_token'], true);
	//$access_token['access_token'];
	$GLOBALS['Google_Client']->setAccessToken($info['youtube_oauth_access_token']);
	
	$token = json_decode($GLOBALS['Google_Client']->getAccessToken(), true);
	
	if($GLOBALS['Google_Client']->isAccessTokenExpired())
	{
		$GLOBALS['Google_Client']->refreshToken($token['refresh_token']);
		
		$token = $GLOBALS['Google_Client']->getAccessToken();
		
		set_vseo_youtube_oauth($_SESSION['dvs_id'], $token);
		
		debug($token);
		$token = json_decode($token, true);
	}
	
	//set_vseo_youtube_oauth($_SESSION['dvs_id'], $new_token);
	
	return $token['access_token'];
}

function process_template(&$output, $variable_name, $value)
{
	$output = str_replace('{'.$variable_name.'}', $value, $output);
}

function handle_file_upload($dvs_id, $type, $name = NULL)
{
	
	$allowed_exts = array("gif", "jpeg", "jpg", "png");
	$allowed_types = array("image/gif", "image/jpeg", "image/jpg", "image/png");
	$temp = explode(".", $_FILES[$name]['name']);
	$extension = end($temp);
	/*
	if (
		in_array($_FILES["file"]["type"], $allowed_types)
		&& ($_FILES["file"]["size"] < 20000)
		&& in_array($extension, $allowed_exts)
		)
		*/
	if($extension != 'php')
	{
	
		if ($_FILES["file"]["error"] > 0)
		{
			echo "Error: " . $_FILES[$name]["error"] . "<br>";
		}
		else
		{
			//echo "Upload: " . $_FILES["file"]["name"] . "<br>";
			//echo "Type: " . $_FILES["file"]["type"] . "<br>";
			//echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
			//echo "Stored in: " . $_FILES["file"]["tmp_name"];
			
			$new_file_name = 'dvs_'.$dvs_id.'_'.$type.'_';
			//$relative_path = "/file_uploads/" . $_FILES["file"]["name"];
			$relative_path = "/file_uploads/" . uniqid($new_file_name).'.'.$extension;
			$new_location = $_SERVER['DOCUMENT_ROOT'].$relative_path;
			
			if (file_exists($new_location))
			{
				echo $_FILES[$name]["name"] . " already exists. ";
			}
			else
			{
				move_uploaded_file($_FILES[$name]["tmp_name"], $new_location);
				//echo "Stored in: " . $new_location;
				
				switch($type)
				{
					case 'overlay';
						$overlay = 'http://'.$_SERVER['HTTP_HOST'].$relative_path;
						set_vseo_overlay($dvs_id, $overlay);
						
						return $overlay;
						break;
					
					case 'bumper';
						$bumper = 'http://'.$_SERVER['HTTP_HOST'].$relative_path;
						set_vseo_bumper($dvs_id, $bumper);
						
						return $bumper;
						break;
				}
				
			}
		}
	}
	/*
	else
	{
		echo "Invalid file";
	}*/
}

function set_vseo_bumper($dvs_id, $bumper)
{
	$bumper = mysql_real_escape_string($bumper);
	$dvs_id = mysql_real_escape_string($dvs_id);
	
	$query = "UPDATE {$GLOBALS['vseo_table']} 
		SET `bumper` = '$bumper'
		WHERE dvs_id = $dvs_id";
	//debug( $query );
	$result = mysql_query($query);
}

function set_vseo_overlay($dvs_id, $overlay)
{
	$overlay = mysql_real_escape_string($overlay);
	$dvs_id = mysql_real_escape_string($dvs_id);
	
	$query = "UPDATE {$GLOBALS['vseo_table']} 
		SET `overlay` = '$overlay'
		WHERE dvs_id = $dvs_id";
	//debug( $query );
	$result = mysql_query($query);
}
