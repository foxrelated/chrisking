<?php
/**
* [PHPFOX_HEADER]
*/

defined('PHPFOX') or exit('DRINK SLICE!');

/**
*
*
* @copyright	Konsort.org 
* @author  		Konsort.org
* @package 		Research
*/
class Research_Component_Block_Latest_Used extends Phpfox_Component
{
	public function process()
	{
		$this->template()->assign(array(
			'aLatestVideos' => Phpfox::getService('research')->getLatestVideos('used')
		));
	}
}
?>