<?php 
include('settings.php');

switch($_REQUEST['method'])
{
	case 'videos_to_create';
		list($years, $makes, $models, $videos) = get_videos();
		$number_of_videos = 0;
		foreach($videos as $value)
		{
			if($value[1] == $_REQUEST['year'] || $_REQUEST['year'] == 'all')
			{
				if($value[2] == $_REQUEST['make'])
				{
					if($value[3] == $_REQUEST['model'] || $_REQUEST['model'] == 'all')
					{
						$number_of_videos++;
					}
				}
			}
		}
		
		echo json_encode(array('count'=>$number_of_videos));
		
		break;
	
	case 'select_year';
		list($years, $makes, $models, $videos) = get_videos();
		$makes = '<option value="">Select... </option>';
		$makes_set = array();
		$models = '<option value="">Select... </option>';
		$models_set = array();
		
		
		foreach($videos as $value)
		{
			if($value[1] == $_REQUEST['year'] || $_REQUEST['year'] == 'all')
			{
				$makes_set[$value[2]] = true;
				$models_set[$value[3]] = true;
			}
		}
		$makes_set = array_keys($makes_set);
		foreach($makes_set as $value)
			$makes .= '<option value="'.$value.'" >'.$value.'</option>';
		
		$models_set = array_keys($models_set);
		foreach($models_set as $value)
			$models .= '<option value="'.$value.'" >'.$value.'</option>';
		
		
		echo json_encode(array('makes'=>$makes, 'models'=>$models));
		
		break;
	
	case 'select_make';
		list($years, $makes, $models, $videos) = get_videos();
		$models = '<option value="">Select... </option><option value="all" >*All Models*</option>';
		$makes_set = array();
		
		foreach($videos as $value)
		{
			if($value[1] == $_REQUEST['year'] || $_REQUEST['year'] == 'all')
			{
				if($value[2] == $_REQUEST['make'])
				{
					$models_set[$value[3]] = true;
				}
			}
		}
		
		$models_set = array_keys($models_set);
		foreach($models_set as $value)
			$models .= '<option value="'.$value.'" >'.$value.'</option>';
		
		echo json_encode(array('models'=>$models));
		
		break;
	
	default;
		echo json_encode(array('error' => 'Unknown method', 'request'=>$_REQUEST));
		break;
	
}
