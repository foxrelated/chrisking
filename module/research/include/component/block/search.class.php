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
class Research_Component_Block_Search extends Phpfox_Component
{
	public function process()
	{	
		$this->template()->assign(array(
			'aYears' => Phpfox::getService('research')->getYears('all')
		));
	}
}
?>