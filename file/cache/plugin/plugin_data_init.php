<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php $aContent = 'if (Phpfox::getParam(\'dvs.enable_subdomain_mode\'))
{
	$_CONF[\'core.url_rewrite\'] = \'3\';
} if (isset($_REQUEST[\'share-connect\']))
{
	Phpfox::getComponent(\'share.connect\', array(), \'controller\');	
	exit;
} if (!PHPFOX_IS_AJAX)
{
	$mRedirectId = Phpfox::getService(\'subscribe.purchase\')->getRedirectId();
	if (is_numeric($mRedirectId) && $mRedirectId > 0)
	{
		Phpfox::getLib(\'url\')->send(\'subscribe.register\', array(\'id\' => $mRedirectId), Phpfox::getPhrase(\'subscribe.please_complete_your_purchase\'));	
	}
} '; ?>