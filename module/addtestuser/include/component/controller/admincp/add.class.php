<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');

/**
 * 
 * 
 * @copyright		
 * @author  		webwolf
 * @package  		
 * @version 		
 */

class Addtestuser_Component_Controller_Admincp_Add extends Phpfox_Component 
{ 
    public function process() 
	{         
		//Set this to make sure the request is coming from this admincp file
		define('PHPFOX_IS_ADMIN_USERADD', true);
		$aCond = array();
		$bCustomExists = array();

		// Define the fields that will be validated
		$aValidation = array(
			'email' => array(
				'def' => 'email',
				'title' => Phpfox::getPhrase('user.provide_a_valid_email_address')
			),
			'user_name' => array(
				'def' => 'username',
				'title' => Phpfox::getPhrase('user.provide_a_valid_user_name', 
						array(
							'min' => Phpfox::getParam('user.min_length_for_username'), 					'max' =>Phpfox::getParam('user.max_length_for_username')
						)
				)
			),
			'month' => Phpfox::getPhrase('user.select_month_of_birth'),
			'day'=> Phpfox::getPhrase('user.select_day_of_birth'),
			'year' => Phpfox::getPhrase('user.select_year_of_birth'),
			'country_iso' => Phpfox::getPhrase('user.select_current_location'),
			'gender' => Phpfox::getPhrase('user.select_your_gender')
		);

		//Add some conditional validation fields
		if(Phpfox::getLib('setting')->isParam('user.split_full_name') && Phpfox::getParam('user.split_full_name'))
		{
			$aValidation['first_name'] = Phpfox::getPhrase('addtestuser.please_provide_your_first_name');
			$aValidation['last_name'] = Phpfox::getPhrase('addtestuser.please_provide_your_last_name');
		}
		else
		{
			$aValidation['full_name'] = Phpfox::getPhrase('user.provide_your_full_name');
		}
		if(strlen(Phpfox::getParam('addtestuser.testuser_password')) < 1)
		{
			$aValidation['password'] = array(
				'def' => 'password',
				'title' => Phpfox::getPhrase('user.provide_a_valid_password')
			);
		}

		//Set the validation object
		$oValid = Phpfox::getLib('validator')->set(array('sFormName' => 'js_form', 'aParams' => $aValidation));

		//Define the next username by looking at the number in the last username and incrementing 1
		if(strlen(Phpfox::getParam('addtestuser.testuser_username')) > 0  )
		{
			$sUserName =  Phpfox::getParam('addtestuser.testuser_username') . Phpfox::getService('addtestuser')->getNextUsernumber();
		}
		else
		{
			$sUserName = '';
		}
		//Define other default form fields by calling the module settings from the admincp_settings
		$aCond[] = " AND setting.module_id = 'addtestuser' AND setting.is_hidden = 0 ";
		$aSettings = Phpfox::getService('admincp.setting')->get($aCond);

		$sTitle = Phpfox::getPhrase('addtestuser.add_test_user');

		//Get the user_id to use as a template for custom fields and load custom fields if any
		$iCustomTemplate = Phpfox::getParam('addtestuser.adduser_custom');
		$aCustomFields = Phpfox::getService('custom')->getForEdit(array('user_main', 'user_panel', 'profile_panel'), null, null, true, $iCustomTemplate);
		$bCustomExists = count($aCustomFields) > 0 ? true : false;

		//Change the integer keys to reflect the variable name so the order they are read doesn't matter
		foreach($aSettings as $key => $value)
		{
			$newkey=$value['var_name'];
			$aSettings[$newkey] = $aSettings[$key];
			unset($aSettings[$key]);

			// On ver 3.4 deal with split full names
			if (Phpfox::getLib('setting')->isParam('user.split_full_name') && Phpfox::getParam('user.split_full_name') && empty($aSetting['first_name']) && empty($aSetting['last_name']))
			{
				$aSetting['first_name'] = '';
				$aSetting['last_name'] = '';
				preg_match('/(.*) (.*)/', $sUserName, $aNameMatches);
				if (isset($aNameMatches[1]) && isset($aNameMatches[2]))
				{
					$aSettings['first_name'] = $aNameMatches[1];
					$aSettings['last_name'] = $aNameMatches[2];
				}
				else
				{
					$aSettings['first_name'] = $sUserName;
					$aSettings['last_name'] = '';
				}
			}

		}

		if ($aVals = $this->request()->getArray('val'))
		{
					Phpfox::getService('user.validate')->email($aVals['email']);

					$aVals['password']=isset($aVals['password']) ? $aVals['password'] : Phpfox::getParam('addtestuser.testuser_password');
					$aVals['user_name'] = isset($aVals['user_name']) ? str_replace(' ', '_', $aVals['user_name']) : '';

					if ($iId = Phpfox::getService('addtestuser')->add($aVals,$aVals['user_group_id']))
					{
						//$this->url()->send('http://admincp.wtvdvs-dev.com/addtestuser/add', null, 'User ' . $iId . ' Successfully Created ');
						
						$this->url()->send(($bSubdomainMode ? Phpfox::getLib('url')->makeUrl('www.admincp.addtestuer.add') : Phpfox::getLib('url')->makeUrl('admincp.addtestuser.add')), null, 'User ' . $iId . ' Successfully Created ');
						
						
					}

		}

		$this->template()->setHeader(array(
					'addtestuser.js' => 'module_addtestuser'
				)
			);

		$this->template()->setTitle($sTitle)			
				->assign(array(
				'sCreateJs' => $oValid->createJS(),
				'sGetJsForm' => $oValid->getJsForm(),
				'bNoUsernames' => Phpfox::getParam('user.disable_username_on_sign_up'),
				'aSettings' => $aSettings,
				'aCusFld' => $aCustomFields,
				'bCustomExists' => $bCustomExists,
				'sUserName' => str_replace(' ', '_', $sUserName),
				'sFullName' =>  $sUserName,
				'bPassword' => (strlen(Phpfox::getParam('addtestuser.testuser_password')) > 0) ? 1 : 0,
				'aPackages' => $aPackages = Phpfox::getService('subscribe')->getPackages(false,true),
				'sSiteTitle' => Phpfox::getParam('core.site_title')
			)
		);
	}

}
