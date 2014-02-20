<?php

/**
 * [PHPFOX_HEADER]
 */
defined('PHPFOX') or exit('No direct script access allowed.');

/**
 *
 *
 * @copyright		Konsort.org
 * @author  		James
 * @package 		G
 */
class G_Component_Ajax_Ajax extends Phpfox_Ajax {

	public function dumpCache()
	{
		$aFiles = Phpfox::getLib('file')->getAllFiles(PHPFOX_DIR_CACHE);

		foreach ($aFiles as $sFile)
		{
			unlink($sFile);
		}

		$aFiles = Phpfox::getLib('file')->getAllFiles(PHPFOX_DIR_CACHE);
		$this->html('#dump_cache_button_text', 'Dump Cache (' . count($aFiles) . ' files)');

		$this->hide('#g_status', 'fast');
		$this->html('#g_status', 'Cache cleared.');
		$this->show('#g_status', 'fast');

	}

	public function updateCacheCount()
	{
		$aFiles = Phpfox::getLib('file')->getAllFiles(PHPFOX_DIR_CACHE);
		$this->html('#dump_cache_button_text', 'Dump Cache (' . count($aFiles) . ' files)');

	}

}

?>
