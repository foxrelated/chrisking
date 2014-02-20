<?php

/**
 * [PHPFOX_HEADER]
 */
defined('PHPFOX') or exit('GO MICE!');

/**
 *
 *
 * @copyright	Konsort.org
 * @author  		Konsort.org
 * @package 		KOBrightcove
 */
class Kobrightcove_Component_Ajax_Ajax extends Phpfox_Ajax {

	public function autoUpdate()
	{
		Phpfox::getBlock('kobrightcove.progress-update');
		$this->call('$(\'#progress_update\').html(\'' . $this->getContent() . '\');');
	}

	public function import()
	{
		Phpfox::getBlock('kobrightcove.import');
	}

	public function update()
	{
		Phpfox::getBlock('kobrightcove.update');
	}

	public function remove()
	{
		Phpfox::getBlock('kobrightcove.remove');
	}

}

?>
