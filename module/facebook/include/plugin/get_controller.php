<?php

$sHttp = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 'https' : 'http');

if ((defined('PHPFOX_IS_AJAX') && PHPFOX_IS_AJAX) || (defined('PHPFOX_IS_AJAX_PAGE') && PHPFOX_IS_AJAX_PAGE))
{
	
}
else
{
	if (!Phpfox::getParam('user.force_user_to_upload_on_sign_up') && Phpfox::getParam('facebook.enable_facebook_connect') && !Phpfox::isAdminPanel())
	{
		if (Phpfox::isUser())
		{
			if (Phpfox::getLib('request')->get('req1') == 'facebook' && Phpfox::getLib('request')->get('req2') == 'unlink')
			{
					
			}			
			else
			{
				if (Phpfox::getUserBy('fb_user_id') && !Phpfox::getUserBy('fb_is_unlinked'))
				{
					$oTpl->setHeader(array(
							'<script src="' . $sHttp . '://connect.facebook.net/en_US/all.js" type="text/javascript"></script>',							
							'<script type="text/javascript">
								$(function()
								{
									FB.init(
									{
										appId  : \'' . Phpfox::getParam('facebook.facebook_app_id') . '\',
										status : true,
										cookie : true,
										oauth  : true,
										xfbml  : true 
									});
	
									FB.getLoginStatus(function(response) 
									{
										if (!response.authResponse) 
										{
											window.location.href = \'' . Phpfox::getLib('url')->makeUrl('facebook.unlink', array('noapp' => '1')) . '\';
										}
									});
								});
							</script>')
						);
				}
				else
				{
					$oTpl->setHeader(array(
							'<script src="' . $sHttp . '://connect.facebook.net/en_US/all.js" type="text/javascript"></script>',							
							'<script type="text/javascript">
								$(function()
								{
									FB.init(
									{
										appId  : \'' . Phpfox::getParam('facebook.facebook_app_id') . '\',
										status : true,
										cookie : true,
										oauth  : true,
										xfbml  : true 
									});			   			
								});
							</script>')
						);			
				}
			}
		}
		else 
		{
			if (Phpfox::getLib('request')->get('req1') == 'facebook' && Phpfox::getLib('request')->get('req2') == 'frame')
			{

			}
			elseif (Phpfox::getLib('request')->get('req1') == 'facebook' && Phpfox::getLib('request')->get('req2') == 'logout')
			{

			}		
			elseif (Phpfox::getLib('request')->get('req1') == 'facebook' && Phpfox::getLib('request')->get('req2') == 'account')
			{

			}
			elseif (!empty($_REQUEST['facebook-process-login']))
			{

			}
			else 
			{
				$oTpl->setHeader(array(
						'<script src="' . $sHttp . '://connect.facebook.net/en_US/all.js" type="text/javascript"></script>',							
						'<script type="text/javascript">
							$(function()
							{
								FB.init(
								{
									appId  : \'' . Phpfox::getParam('facebook.facebook_app_id') . '\',
									status : true,
									cookie : true,
									oauth  : true,
									xfbml  : true 
								});
								
								FB.getLoginStatus(function(response){
									if (response.authResponse){
										$(\'body\').html(\'<div id="fb-root"></div><div id="facebook_connection">' . Phpfox::getPhrase('facebook.connecting_to_facebook_please_hold') . '</div>\');
										window.location.href = \'' . Phpfox::getLib('url')->makeUrl('facebook.frame') . '\';
									}
								});
							});						

							FB.Event.subscribe(\'auth.login\', function(response) 
							{
								if (response.authResponse) 
								{
									$(\'body\').html(\'<div id="fb-root"></div><div id="facebook_connection">' . Phpfox::getPhrase('facebook.connecting_to_facebook_please_hold') . '</div>\');
									window.location.href = \'' . Phpfox::getLib('url')->makeUrl('facebook.frame') . '\';
								}
							});
						</script>')
					);
			}
		}
	}
	else
	{
		if (Phpfox::isUser() && !Phpfox::isAdminPanel())
		{
			$oTpl->setHeader(array(
					'<script src="' . $sHttp . '://connect.facebook.net/en_US/all.js" type="text/javascript"></script>',							
					'<script type="text/javascript">
						$(function()
						{
							FB.init(
							{
								appId  : \'' . Phpfox::getParam('facebook.facebook_app_id') . '\',
								status : true,
								cookie : true,			
								oauth  : true,
								xfbml  : true 
							});			   			
						});
					</script>')
				);	
		}
	}
}
?>