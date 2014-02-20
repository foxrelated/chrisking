<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');

/**
 * 
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Feed
 * @version 		$Id: display.class.php 4171 2012-05-16 07:10:36Z Raymond_Benc $
 */
class Feed_Component_Block_Time extends Phpfox_Component 
{
	/**
	 * Class process method wnich is used to execute this component.
	 */
	public function process()
	{
		if (!Phpfox::getService('profile')->timeline())
		{
			return false;
		}
		
		$aUser = $this->getParam('aUser');
		if (empty($aUser['user_id']))
		{
			return false;
		}
		
		$aTimeline = Phpfox::getService('feed')->getTimeLineYears($aUser['user_id'], $aUser['birthday_search']);
		
		$this->template()->assign(array(
				'aTimelineDates' => $aTimeline
			)
		);
	}
}

?>