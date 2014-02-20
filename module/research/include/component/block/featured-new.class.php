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
class Research_Component_Block_Featured_New extends Phpfox_Component
{
	public function process()
	{
		$this->template()->assign(array(
			'aFeaturedVideos' => Phpfox::getService('research')->getFeaturedVideos(Phpfox::getParam('research.featured_new_playlist'))
		));
	}
}
?>