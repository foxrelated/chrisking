<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
</head>
<body link="#3399ff" text="#000000" vlink="#3399ff" alink="#3399ff" bgcolor="#FFFFFF">
<div align="center">
    <table width="600" border="0" cellpadding="4" cellspacing="4" style="border:1px solid #cccccc;">
        <tbody>
        <tr>
            <td colspan="2" rowspan="1" valign="top" align="center">
                {if $aDvs.branding_file_name}
                <a href="{$sVideoLink}">
                {img path='core.url_file' file='dvs/branding/'.$aDvs.branding_file_name style="vertical-align:middle" max_width=600 max_height=300 suffix='_600'}</a>
                {else}
                <h2>{$aDvs.dealer_name}</h2>
                {/if}
            </td>
        </tr>
        <tr>
            <td valign="top">
                Hello {$sShareName},
            </td>
            <td valign="top" style="text-align:center;">
                <a href="{$sVideoLink}" style="text-decoration:none;font-weight:bold;">Take your {$aVideo.year} {$aVideo.make} {$aVideo.model} Virtual Test Drive</a><br />
            </td>
        </tr>
        <tr>
            <td valign="top">
                {$sShareMessage}
                <br /><br />
                Take your <a href="{$sVideoLink}" style="text-decoration:none;font-weight:bold;">{$aVideo.year} {$aVideo.make} {$aVideo.model} Virtual Test Drive</a> from {$aDvs.dealer_name} -- It's fun, easy, and free!
                <br /><br />
                If you have any questions, please reply to this email.
                <br /><br />
                Thanks,<br />
                {$sMyShareName}
                </td>
            <td valign="top">
                <div style="position: relative;width:300px;overflow:hidden">
                    <a href="{$sVideoLink}">
                        <div>
                            {img server_id=$aVideo.image_server_id path='brightcove.url_image' file=$aVideo.image_path suffix='_email' max_width=300 max_height=300 title=$aVideo.name}
                        </div>
                    </a>
                </div>
            </td>
        </tr>
        <tr align="center">
            <td colspan="2" rowspan="1" valign="top">
                Sent from the <a href="{$sVideoLink}">{$aDvs.dealer_name} Video Showroom</a>.
            </td>
        </tr>
        </tbody>
    </table>
    <br />
</div>
</body>
</html>