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
 * @version 		$Id: birth.class.php 5012 2012-11-12 09:08:37Z Raymond_Benc $
 */
class User_Component_Block_Birth extends Phpfox_Component 
{
	/**
	 * Class process method wnich is used to execute this component.
	 */
	public function process()
	{
		$aUser = (PHPFOX_IS_AJAX ? Phpfox::getService('user')->get($this->request()->getInt('profile_user_id'), true) : $this->getParam('aUser'));
		$aBirthDay = Phpfox::getService('user')->getAgeArray((PHPFOX_IS_AJAX ? $aUser['birthday'] : $aUser['birthday_time_stamp']));
		
		$this->template()->assign(array(
				'aUser' => $aUser,
				'sBirthDisplay' => Phpfox::getTime(Phpfox::getParam('user.user_dob_month_day'), mktime(0, 0, 0, $aBirthDay['month'], $aBirthDay['day'], $aBirthDay['year']), false)
			)
		);
	}
}

?>