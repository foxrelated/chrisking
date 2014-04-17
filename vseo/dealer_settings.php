<?php 
include('settings.php');

include('google_oauth_setup.php');

$title = 'VSEO: Dealer Settings';
ob_start();
$_SESSION['dvs_id'] = $_REQUEST['dvs_id'];

$info = get_dvs_info($_REQUEST['dvs_id']);
 
?>
	<h2>Connected Video Accounts <small> for <?php echo $info['dealer_name']; ?></small></h2>
	<form method="post" enctype="multipart/form-data" name="form1" id="form1" action="" >
		<table width="80%" border="0" cellspacing="4" cellpadding="4">
			<?php 
			if($_REQUEST['youtube_oauth_access_token'] == NULL)
			{
				
				$authUrl = $GLOBALS['Google_Client']->createAuthUrl();
			?>
				<tr>
					<td><h4>You Tube</h4></td>
					<td><div align="left">
						<!-- <input type="button" name="build_video" id="button" value="Connect YouTube" onclick="window.location.assign('oauth2callback.php');" /> -->
						<a class="btn btn-default" href="<?php echo $authUrl; ?>" >Authorize YouTube Access</a>
						</div></td>
					<td><em>This opens window for Google Account access.<br/> 
						You will be asked to give us offline permission to your account. <br/>
						This is just so we can upload videos to your account without having <br/>
						to bother you with logging in each time
					</em></td>
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
						<input class="btn btn-default" type="submit" name="build_video" id="button" value="Connect Vimeo(disabled)" disabled />
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

html_page_start();

html_header($title);

html_body($content);

html_page_end();
