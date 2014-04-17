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
	
?>
	<h3>Connected Video Accounts</h3>
	<form method="post" enctype="multipart/form-data" name="form1" id="form1" action="" >
		<table width="80%" border="0" cellspacing="4" cellpadding="4">
			<?php 
			if($_REQUEST['youtube_oauth_access_token'] == NULL)
			{
			?>
				<tr>
					<td><h4>You Tube</h4></td>
					<td><div align="left">
						<input type="button" name="build_video" id="button" value="Connect YouTube" onclick="window.location.assign('oauth2callback.php');" />
						</div></td>
					<td><em>This opens window for Google Account access.</em></td>
				</tr>
			<?php
			}
			else
			{
			?>
				<tr>
					<td width="15%">YouTube Token:</td>
					<td width="23%"><label for="textfield"></label>
					<input name="youtube_oauth_token" type="text" id="textfield" value="<?php echo $_REQUEST['youtube_oauth_access_token']; ?>" /></td>
					<td width="62%"><em>Upon successful connection, callback returns to this page and YouTube token will appear here as stored.</em></td>
				</tr>
			<?php
			}
			?>
			
			<tr>
					<td><h4>Vimeo</h4></td>
					<td><div align="left">
						<input type="submit" name="build_video" id="button" value="Connect Vimeo" disabled />
						</div></td>
					<td><em>Coming soon.</em></td>
				</tr>
			
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<!-- <tr>
				<td>&nbsp;</td>
				<td><input type="submit" name="button" id="button2" value="Save Settings" /></td>
				<td><em>Use must click Save to confirm settings.</em></td>
			</tr> -->
		</table>
	</form>	
<?php 
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
