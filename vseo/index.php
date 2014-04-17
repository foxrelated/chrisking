<?php 
include('settings.php');
$title = 'WheelsTV VSEO Tool';
ob_start();
$info = get_all_dvs();
echo '<a class="btn btn-xs btn-default pull-right" href="file_uploads">View uploaded files</a>';
echo '<h3>List of DVS&#39;</h3>';

echo '<hr>';

echo '<table class="table table-striped table-bordered">';
	echo '<th>Actions</th>';
	echo '<th>Youtube?</th>';
	echo '<th>dvs_name</th>';
	echo '<th>Dealer Name</th>';
	echo '<th>State</th>';
	foreach($info as $value)
	{
		echo '<tr>';
			echo '<td>';
				echo '<a href="admin_settings.php?dvs_id='.$value['dvs_id'].'" class="btn btn-xs btn-default" >Admin Settings</a>&nbsp;';
				echo '<a href="dealer_settings.php?dvs_id='.$value['dvs_id'].'" class="btn btn-xs btn-default" >Dealer Settings</a>&nbsp;';
			echo '</td>';
			echo '<td>';
				if($value['youtube_oauth_access_token'])
				{
					echo '<span class="glyphicon glyphicon-thumbs-up text-success"></span>&nbsp;';
					echo '<a href="build.php?dvs_id='.$value['dvs_id'].'" class="btn btn-xs btn-default btn-success" >Generate</a>';
				}
				else
				{
					echo '<span class="glyphicon glyphicon-remove text-danger"></span> Account Connection Needed';
				}
			echo '</td>';
			echo '<td>'.$value['dvs_name'].'</td>';
			echo '<td>'.$value['dealer_name'].'</td>';
			echo '<td>'.$value['name'].'</td>'; //aka state
		echo '</tr>';
	}
	
echo '</table>';
?>
	
	<!-- 
	<p>
		<a class="btn btn-default" href="build.php?dvs_id=1" >Build</a>
	</p>
	<p>
		<a class="btn btn-default" href="admin_settings.php?dvs_id=1" >Admin Settings</a>
	</p>
	<p>
		<a class="btn btn-default" href="dealer_settings.php" >Dealer Settings</a>
	</p>
	<p>
		<a class="btn btn-default" href="generate.php" >Generate</a>
	</p>
	<p>
		<a class="btn btn-default" href="generate.php?number_of_videos=20" >Generate 20</a>
	</p>
	-->
<?php


//debug($info);

$content = ob_get_clean();

html_page_start();

html_header($title);

html_body($content);

html_page_end();
