<?php

if (Phpfox::getLib('module')->getFullControllerName() == 'dvs.view')
{
	$iSiteTitleLength = (strlen(Phpfox::getParam('core.title_delim') . ' ' . Phpfox::getLib('locale')->convert(Phpfox::getParam('core.global_site_title'))));

	$sData = substr($sData, 0, strlen($sData) - $iSiteTitleLength);
}

?>
