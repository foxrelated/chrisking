<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php $aContent = '//if (Phpfox::getService(\'sdtest\')->isSubdomain())
//{
//	if (empty($sUrl))
//	{
//		$sUrl = \'www\';
//	}
//
//	$aParts = explode(\'.\', $sUrl);
//	if (isset($this->aRewrite[$aParts[0]]) && !is_array($this->aRewrite[$aParts[0]]))
//	{
//		$aParts[0] = $this->aRewrite[$aParts[0]];
//	}
//	$sUrls = preg_replace("/http:\\/\\/(.*?)\\.(.*?)/i", "http://{$aParts[0]}.$2", Phpfox::getParam(\'core.path\'));
//	$sUrls .= $this->_makeUrl($aParts, $aParams);
//
//} '; ?>