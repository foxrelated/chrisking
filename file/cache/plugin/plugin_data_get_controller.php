<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php $aContent = 'if (!empty($_POST) && isset($_POST[\'id\']) && Phpfox::isModule(\'feed\') && Phpfox::getParam(\'feed.cache_each_feed_entry\') && !PHPFOX_IS_AJAX)
{
	$oReq = Phpfox::getLib(\'request\');
	$oDb = Phpfox::getLib(\'database\');
	
		$sCustomCurrentUrl = Phpfox::getLib(\'module\')->getFullControllerName();
		$aVals = $oReq->getArray(\'val\');		
		if (!empty($aVals))
		{
			switch ($sCustomCurrentUrl)
			{
				case \'blog.add\':
					Phpfox::getService(\'feed.process\')->clearCache(\'blog\', $_POST[\'id\']);
					break;
				case \'pages.add\':
					Phpfox::getService(\'feed.process\')->clearCache(\'pages_itemLiked\', $_POST[\'id\']);
					break;					
				case \'blog.delete\':
					Phpfox::getService(\'feed.process\')->clearCache(\'blog\', $oReq->get(\'id\'));
					break;
			}
		}
	
} if (Phpfox::getParam(\'core.wysiwyg\') == \'tiny_mce\')
{	
		if (Phpfox::getParam(\'core.site_wide_ajax_browsing\'))
		{
			$oTpl->setHeader(array(
					\'wysiwyg/tiny_mce/tiny_mce.js\' => \'static_script\',
					\'wysiwyg/tiny_mce/core.js\' => \'static_script\'
				)
			);
			
			if (Phpfox::getService(\'tinymce\')->load())
			{			
				$oTpl->setHeader(array(
						Phpfox::getService(\'tinymce\')->getJsCode()
					)
				);
			}			
		}
		else
		{
			Phpfox::getService(\'tinymce\')->load();			
			$oTpl->setHeader(array(
					\'wysiwyg/tiny_mce/tiny_mce.js\' => \'static_script\',
					\'wysiwyg/tiny_mce/core.js\' => \'static_script\',
					Phpfox::getService(\'tinymce\')->getJsCode()
				)
			);			
		}
} '; ?>