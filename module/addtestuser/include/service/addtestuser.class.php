<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');

/**
 * 
 * 
 * @copyright		
 * @author  		Webwolf
 * @package 		
 * @version 		
 */
class Addtestuser_Service_Addtestuser extends Phpfox_Service 
{

	/**
	 * Class constructor
	 */	

	public function __construct()
	{	
		$this->_sTable = Phpfox::getT('user');
	}



	public function getNextUsernumber()
	{
		//$sUsername = Phpfox::getParam('user.disable_username_on_sign_up') ? 'profile-' : Phpfox::getParam('addtestuser.testuser_username');

			$aTestUsers = $this->database()->select('u.full_name')
			->from($this->_sTable, 'u')
			->where("u.full_name like '%" . Phpfox::getParam('addtestuser.testuser_username') . "%'")
			->execute('getSlaveRows');

			$iMax = 0;
			foreach($aTestUsers as $sTestUser)
			{
				
				$sResult = str_replace(Phpfox::getParam('addtestuser.testuser_username'), '',$sTestUser['full_name']);
				if ((int)$sResult > $iMax)
				{
					$iMax = (int)$sResult;
				}
			}
			$iMax = ($iMax = 0? 1 : $iMax);
			$iMax++;

		return ($iMax);
	}

//Note: code fron phpfox v3.4 modified for use in this module.

	public function add($aVals, $iUserGroupId = null)
	{
		if (!defined('PHPFOX_INSTALLER') && Phpfox::getParam('user.split_full_name'))
		{
			if (empty($aVals['first_name']) || empty($aVals['last_name']))
			{
				Phpfox_Error::set(Phpfox::getPhrase('user.please_fill_in_both_your_first_and_last_name'));
			}
			$aVals['full_name'] = $aVals['first_name'] . ' ' . $aVals['last_name'];
		}
		
		$oParseInput = Phpfox::getLib('parse.input');
		$sSalt = $this->_getSalt();
		$aCustom = Phpfox::getLib('request')->getArray('custom');
		
		$aCustomFields = Phpfox::getService('custom')->getForEdit(array('user_main', 'user_panel', 'profile_panel'), null, null, true);
		foreach ($aCustomFields as $aCustomField)
		{
			if ($aCustomField['on_signup'] && $aCustomField['is_required'] && empty($aCustom[$aCustomField['field_id']]))
			{
				Phpfox_Error::set(Phpfox::getPhrase('user.the_field_field_is_required', array('field' => Phpfox::getPhrase($aCustomField['phrase_var_name']))));
			}
		}
		
		if (!Phpfox_Error::isPassed())
		{
			return false;
		}

		if (!defined('PHPFOX_INSTALLER') && Phpfox::getParam('user.validate_full_name'))
		{
			if (!Phpfox::getLib('validator')->check($aVals['full_name'], array('html', 'url')))
			{
				return Phpfox_Error::set(Phpfox::getPhrase('user.not_a_valid_name'));
			}
		}
		
		if (!defined('PHPFOX_INSTALLER') && !Phpfox::getService('ban')->check('display_name', $aVals['full_name']))
		{
			Phpfox_Error::set(Phpfox::getPhrase('user.this_display_name_is_not_allowed_to_be_used'));
		}			

		if (!defined('PHPFOX_INSTALLER'))
		{
		    if (!defined('PHPFOX_SKIP_EMAIL_INSERT'))
		    {
				if (!Phpfox::getLib('mail')->checkEmail($aVals['email']))
			    {
					return Phpfox_Error::set(Phpfox::getPhrase('user.email_is_not_valid'));
			    }
		    }

			if (Phpfox::getLib('parse.format')->isEmpty($aVals['full_name']))
			{
				Phpfox_Error::set(Phpfox::getPhrase('user.provide_a_name_that_is_not_representing_an_empty_name'));
			}		    
		}
		
		$bHasImage = false;

		$aInsert = array(
			'user_group_id' => ($iUserGroupId === null ? NORMAL_USER_ID : $iUserGroupId),
			'full_name' => $oParseInput->clean($aVals['full_name'], 255),
			'password' => Phpfox::getLib('hash')->setHash($aVals['password'], $sSalt),
			'password_salt' => $sSalt,
			'email' => $aVals['email'],
			'joined' => PHPFOX_TIME,
			'gender' => (defined('PHPFOX_INSTALLER') || (!defined('PHPFOX_INSTALLER') && Phpfox::getParam('core.registration_enable_gender')) ? $aVals['gender'] : 0),
			'birthday' => (defined('PHPFOX_INSTALLER') || (!defined('PHPFOX_INSTALLER') && Phpfox::getParam('core.registration_enable_dob')) ? Phpfox::getService('user')->buildAge($aVals['day'],$aVals['month'],$aVals['year']) : null),
			'birthday_search' => (defined('PHPFOX_INSTALLER') || (!defined('PHPFOX_INSTALLER') && Phpfox::getParam('core.registration_enable_dob')) ? Phpfox::getLib('date')->mktime(0, 0, 0, $aVals['month'], $aVals['day'], $aVals['year']) : 0),
			'country_iso' => (defined('PHPFOX_INSTALLER') || (!defined('PHPFOX_INSTALLER') && Phpfox::getParam('core.registration_enable_location')) ? $aVals['country_iso'] : null),
			'language_id' => ((!defined('PHPFOX_INSTALLER') && Phpfox::getLib('session')->get('language_id')) ? Phpfox::getLib('session')->get('language_id') : null),
			'time_zone' => (isset($aVals['time_zone']) && (defined('PHPFOX_INSTALLER') || (!defined('PHPFOX_INSTALLER') && Phpfox::getParam('core.registration_enable_timezone'))) ? $aVals['time_zone'] : null),
			'last_ip_address' => Phpfox::getIp(),
			'last_activity' => PHPFOX_TIME
		);
		
		if (!Phpfox::getParam('user.profile_use_id') && !Phpfox::getParam('user.disable_username_on_sign_up'))
		{
			$aVals['user_name'] = str_replace(' ', '_', $aVals['user_name']);
			$aInsert['user_name'] = $oParseInput->clean($aVals['user_name']);					
		}
		
		if (!Phpfox_Error::isPassed())
		{
			return false;
		}

		$iId = $this->database()->insert($this->_sTable, $aInsert);
		$aInsert['user_id'] = $iId;
		$aExtras = array(
			'user_id' => $iId
		);

		$this->database()->insert(Phpfox::getT('user_activity'), $aExtras);
		$this->database()->insert(Phpfox::getT('user_field'), $aExtras);
		$this->database()->insert(Phpfox::getT('user_space'), $aExtras);
		$this->database()->insert(Phpfox::getT('user_count'), $aExtras);

		if (Phpfox::getParam('user.profile_use_id') || Phpfox::getParam('user.disable_username_on_sign_up') || strlen($aVals['user_name']) < 1)
		{
			$this->database()->update($this->_sTable, array('user_name' => 'profile-' . $iId), 'user_id = ' . $iId);
		}
		
		if (!defined('PHPFOX_INSTALLER') && Phpfox::getParam('user.split_full_name'))
		{
			Phpfox::getService('user.field.process')->update($iId, 'first_name', (empty($aVals['first_name']) ? null :$aVals['first_name']));
			Phpfox::getService('user.field.process')->update($iId, 'last_name', (empty($aVals['last_name']) ? null :$aVals['last_name']));
		}		
		
		if (!defined('PHPFOX_INSTALLER') && Phpfox::getParam('core.registration_enable_dob'))
		{
			// Updating for the birthday range
			$this->database()->update(Phpfox::getT('user_field'), array('birthday_range' => '\''.Phpfox::getService('user')->buildAge($aVals['day'], $aVals['month']) .'\''), 'user_id = ' . $iId, false);
		}
		
		if (!defined('PHPFOX_INSTALLER'))
		{
			$iFriendId = (int) Phpfox::getParam('user.on_signup_new_friend');
			if ($iFriendId > 0 && Phpfox::isModule('friend'))
			{
				$iCheckFriend = $this->database()->select('COUNT(*)')
					->from(Phpfox::getT('friend'))
					->where('user_id = ' . (int) $iId . ' AND friend_user_id = ' . (int) $iFriendId)
					->execute('getSlaveField');
				
				if (!$iCheckFriend)
				{
					$this->database()->insert(Phpfox::getT('friend'), array(
							'list_id' => 0,
							'user_id' => $iId,
							'friend_user_id' => $iFriendId,
							'time_stamp' => PHPFOX_TIME
						)
					);
					
					$this->database()->insert(Phpfox::getT('friend'), array(
							'list_id' => 0,
							'user_id' => $iFriendId,
							'friend_user_id' => $iId,
							'time_stamp' => PHPFOX_TIME
						)
					);
	
					Phpfox::getService('friend.process')->updateFriendCount($iId, $iFriendId);
					Phpfox::getService('friend.process')->updateFriendCount($iFriendId, $iId);
				}
			}

			switch (Phpfox::getParam('user.on_register_privacy_setting'))
			{
				case 'network':
					$iPrivacySetting = '1';
					break;
				case 'friends_only':
					$iPrivacySetting = '2';
					break;
				case 'no_one':
					$iPrivacySetting = '4';
					break;
				default:
					
					break;
			}
			
			if (isset($iPrivacySetting))
			{
				$this->database()->insert(Phpfox::getT('user_privacy'), array(
						'user_id' => $iId,
						'user_privacy' => 'profile.view_profile',
						'user_value' => $iPrivacySetting
					)
				);			
			}
		}
		
		if (!empty($aCustom))
		{
			if (!Phpfox::getService('custom.process')->updateFields($iId, $iId, $aCustom, true))
			{
				return false;
			}
		}		
		
		$this->database()->insert(Phpfox::getT('user_ip'), array(
				'user_id' => $iId,
				'type_id' => 'register',
				'ip_address' => Phpfox::getIp(),
				'time_stamp' => PHPFOX_TIME
			)
		);			
		
		if (!defined('PHPFOX_INSTALLER') && Phpfox::isModule('subscribe') && Phpfox::getParam('subscribe.enable_subscription_packages') && $aVals['package_id'] > 0)
		{
			$aPackage = Phpfox::getService('subscribe')->getPackage($aVals['package_id']);
			if (isset($aPackage['package_id']))
			{
				$iPurchaseId = Phpfox::getService('subscribe.purchase.process')->add(array(
						'package_id' => $aPackage['package_id'],
						'currency_id' => $aPackage['default_currency_id'],
						'price' => $aPackage['default_cost']
					), $iId
				);
				
				$iDefaultCost = 0;
				
				if ($iPurchaseId)
				{
						Phpfox::getService('subscribe.purchase.process')->update($iPurchaseId, $aPackage['package_id'], 'completed', $iId, $aPackage['user_group_id'], $aPackage['fail_user_group']);
				}
				else 
				{
					return false;
				}				
			}
		}		

		return $iId;
	}

	private function _getSalt($iTotal = 3)
	{
		$sSalt = '';
		for ($i = 0; $i < $iTotal; $i++)
		{
			$sSalt .= chr(rand(33, 91));
		}

		return $sSalt;
	}

}