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
class Kobrightcove_Component_Block_Remove extends Phpfox_Component
{
	public function process()
	{	
		$iVideos = Phpfox::getService('kobrightcove')->remove();
		
		$this->template()->assign(array('iVideos' => $iVideos));
	}
} 
?>