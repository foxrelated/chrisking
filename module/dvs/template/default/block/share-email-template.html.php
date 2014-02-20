<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
	</head>
	<body link="#3399ff" text="#000000" vlink="#3399ff" alink="#3399ff" bgcolor="#FFFFFF">
		<div align="center">
			<table width="600" border="0" cellpadding="4" cellspacing="4" style="border:1px solid #cccccc;">
				<tbody>
					<tr>
						<td colspan="2" rowspan="1" valign="top">
							<a href="{$sVideoLink}">{img path='core.url_file' file='dvs/branding/'.$aDvs.branding_file_name style="vertical-align:middle" max_width=600 max_height=300 suffix='_600'}</a>
						</td>
					</tr>
					<tr>
						<td valign="top">
							Hello {$sShareName}!<br />
						</td>
						<td valign="top" style="text-align:center;">
							<a href="{$sVideoLink}" style="text-decoration:none;font-weight:bold;">Take a {$aVideo.year} {$aVideo.make} {$aVideo.model} Test Drive</a><br />
						</td>
					</tr>
					<tr>
						<td valign="top">
							Take a <a href="{$sVideoLink}" style="text-decoration:none;font-weight:bold;">{$aVideo.year} {$aVideo.make} {$aVideo.model} Video Test Drive</a> from {$aDvs.dealer_name} -- It's fun, easy, and free!<br><br>
							Your friend {$sMyShareName} has this to say:<br />
							"{$sShareMessage}"
							<br />
							<br />
							Drive Safe!<br />
							&nbsp;{$aDvs.dealer_name}</td>
						<td valign="top">
							<div style="position: relative;width:300px;overflow:hidden">
								<a href="{$sVideoLink}">
									<div>
										{img path='core.url_file' file='brightcove/'.$aVideo.video_still_image style="vertical-align:middle" max_width=300 max_height=300}
									</div>
									<div style="height: 100%;left: 0;position: absolute;top: 0;width: 300px;">
										<img src="{$sImagePath}play_btn_75.png" style="display:block;margin-left: auto;margin-right: auto;padding-top: 40px;"/>
									</div>
								</a>
							</div>
						</td>
					</tr>
					<tr align="center">
						<td colspan="2" rowspan="1" valign="top">
							Sent from the {$aDvs.dealer_name} Video Showroom.<br>Powered by <a href="http://wheelstvnetwork.com">WheelsTV</a><br />
						</td>
					</tr>
				</tbody>
			</table>
			<br />
		</div>
	</body>
</html>