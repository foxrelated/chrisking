<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
</head>
<body link="#3399ff" text="#{$aForms.page_text}" vlink="#3399ff" alink="#3399ff" bgcolor="#{$aForms.page_background}">
<div align="center">
    <table width="600" border="0" cellpadding="4" cellspacing="4" style="border:1px solid #cccccc;font-family:{$ses};color:#{$aForms.page_text};background:#{$aForms.page_background};">
        <tbody>
        <tr>
            <td colspan="2" rowspan="1" valign="top">
                <a href="{$sVideoLink}" style="color:#{$aForms.text_link};">{img path='core.url_file' file='dvs/branding/'.$aDvs.branding_file_name style="vertical-align:middle" max_width=600 max_height=300 suffix='_600'}</a>
            </td>
        </tr>
        <tr>
            <td valign="top">
                Hello {$sShareName}!<br />
            </td>
            <td valign="top" style="text-align:center;">
                <a href="{$sVideoLink}" style="text-decoration:none;font-weight:bold;color:#{$aForms.text_link};">Take a {$aVideo.year} {$aVideo.make} {$aVideo.model} Test Drive</a><br />
            </td>
        </tr>
        <tr>
            <td valign="top">
                Take a <a href="{$sVideoLink}" style="text-decoration:none;font-weight:bold;color:#{$aForms.text_link};">{$aVideo.year} {$aVideo.make} {$aVideo.model} Video Test Drive</a> from {$aDvs.dealer_name} -- It's fun, easy, and free!<br><br>
				Copy and Paste this URL to watch:
				{$sVideoLink}
				<br/><br/>
                Your friend {$sMyShareName} has this to say:<br />
                "{$sShareMessage}"
                <br />
                <br />
                Drive Safely!<br />
                &nbsp;{$aDvs.dealer_name}</td>
            <td valign="top">
                <div style="position: relative;width:300px;overflow:hidden">
                    <a href="{$sVideoLink}" style="color:#{$aForms.text_link};">
                        <div>
                            {*img server_id=$aVideo.image_server_id path='brightcove.url_image' file=$aVideo.image_path suffix='_email' max_width=300 max_height=300 title=$aVideo.name*}
							{img path='core.url_file' file='brightcove/'.$aVideo.thumbnail_image max_width=150 max_height=150 title=$aVideo.name}
                        </div>
                    </a>
                </div>
            </td>
        </tr>
        <tr align="center">
            <td colspan="2" rowspan="1" valign="top">
                Sent from the {$aDvs.dealer_name} Video Showroom.<br>Powered by <a href="http://wheelstvnetwork.com" style="color:#{$aForms.text_link};">WheelsTV</a><br />
            </td>
        </tr>
        </tbody>
    </table>
    <br />
</div>
</body>
</html>