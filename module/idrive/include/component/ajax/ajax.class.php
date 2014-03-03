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
 * @package 		iDrive
 */
class Idrive_Component_Ajax_Ajax extends Phpfox_Ajax {

	public function deletePlayer()
	{
		$iPlayerId = $this->get('player_id');

		Phpfox::getService('idrive.player.process')->remove($iPlayerId);

		if (!$this->get('from_admincp'))
		{
			if (count(Phpfox::getService('idrive.player')->listPlayers(0, 0, Phpfox::getUserId(), false)) < Phpfox::getUserParam('idrive.players'))
			{
				$bCanAddPlayers = true;
			}
			$this->call('$("#add_player_button").show("slow");');
			$this->call('$("#players").addClass("separate").fadeIn();');
		}
	}


	public function logoFileProcess()
	{
		$iUserId = $this->get('user_id');
		$this->errorSet('#js_logo_file_upload_message');

		if ($iId = Phpfox::getService('idrive.file')->logoFileProcess($this->get('logo_file'), $this->get('logo_file_id')))
		{
			$sLogoFile = $this->get('logo_file');

			// windows
			if (strpos($sLogoFile, "\\"))
			{
				$aParts = explode('\\', $sLogoFile);
				if (isset($aParts[count($aParts) - 1]))
				{
					$sLogoFile = $aParts[count($aParts) - 1];
				}
			}

			$this->attr('#js_view_logo_file_link', 'href', Phpfox::getLib('url')->makeUrl('file', array('redirect' => $iId)))
				->html('#js_logo_upload_file_name', htmlentities(addslashes($sLogoFile)))
				->val('.js_cache_logo_file_id', $iId)
				->submit('#js_logo_file_form')
				->show('#js_logo_file_process');
		}
		else
		{
			$this->show('#js_logo_file_upload_error');
		}
	}


	public function prerollFileProcess()
	{
		$iUserId = $this->get('user_id');
		$this->errorSet('#js_preroll_file_upload_message');

		if ($iId = Phpfox::getService('idrive.file')->prerollFileProcess($this->get('preroll_file'), $this->get('preroll_file_id')))
		{
			$sPrerollFile = $this->get('preroll_file');

			// windows
			if (strpos($sPrerollFile, "\\"))
			{
				$aParts = explode('\\', $sPrerollFile);
				if (isset($aParts[count($aParts) - 1]))
				{
					$sPrerollFile = $aParts[count($aParts) - 1];
				}
			}

			$this->attr('#js_view_preroll_file_link', 'href', Phpfox::getLib('url')->makeUrl('file', array('redirect' => $iId)))
				->html('#js_preroll_upload_file_name', htmlentities(addslashes($sPrerollFile)))
				->val('.js_cache_preroll_file_id', $iId)
				->submit('#js_preroll_file_form')
				->show('#js_preroll_file_process');
		}
		else
		{
			$this->show('#js_preroll_file_upload_error');
		}
	}


	public function moreInfoPlayerType()
	{
		$this->template()->getTemplate('idrive.block.more-info.player-type');
	}


	public function moreInfoDomainName()
	{
		$this->template()->getTemplate('idrive.block.more-info.domain-name');
	}


	public function moreInfoLogoBranding()
	{
		$this->template()->getTemplate('idrive.block.more-info.logo-branding');
	}


	public function moreInfoPrerollSwf()
	{
		$this->template()->getTemplate('idrive.block.more-info.preroll-swf');
	}


	public function moreInfoPrerollDuration()
	{
		$this->template()->getTemplate('idrive.block.more-info.preroll-duration');
	}


	public function previewPlayer()
	{
//		$aVals = Phpfox::getLib('request')->getArray('val');
//		
//		$aValidation = array(
////			'player_name' => 'Please enter a Player Name'
//			'makes' => Phpfox::getPhrase('dvs.please_select_a_make_first')		
//		);
//
//		if (!empty($aVals['preroll_file_id']))
//		{
//			$aValidation['preroll_duration'] = Phpfox::getPhrase('dvs.please_enter_a_duration_for_the_pre_roll_file');
//		}
//
//		$oValid = Phpfox::getLib('validator')->set(array(
//			'sFormName' => 'add_player',
//			'aParams' => $aValidation
//				)
//		);
//		
//		if (!empty($aVals['featured_model']))
//		{
//			$aFeaturedModel = explode(',', $aVals['featured_model']);
//		}
//
//		if (isset($aFeaturedModel[1]))
//		{
//			$aVals['featured_year'] = $aFeaturedModel[0];
//			$aVals['featured_make'] = $aFeaturedModel[1];
//			$aVals['featured_model'] = $aFeaturedModel[2];
//		}
//		else
//		{
//			$aVals['featured_year'] = '';
//			$aVals['featured_make'] = '';
//			$aVals['featured_model'] = '';
//		}
//		
//		if ($oValid->isValid($aVals))
//		{
//			if ($aVals['action'] == 'add')
//			{
//				$iId = Phpfox::getService('idrive.player.process')->add($aVals);
//			}
//			else if ($aVals['action'] == 'save')
//			{
//				Phpfox::getService('idrive.player.process')->update($aVals);
//				
//				$iId = $this->request()->getInt('id');
//				var_dump($iId);
//				exit;
//			}
//			
//			$this->call("tb_show('" . Phpfox::getPhrase('dvs.preview') . "', $.ajaxBox('idrive.showPreview', 'id=" . $iId . "&width=' + iPreviewWidth + '&amp;height=' + iPreviewHeight + '&amp;' + $('#add_player').serialize()));");
//		}
//			
//		$bMakeSelected = false;
//
//		foreach ($aVals['selected_makes'] as $sMake => $bSelected)
//		{
//			if ($bSelected)
//			{
//				$bMakeSelected = true;
//			}
//		}
//
//		if (!$bMakeSelected)
//		{
//			echo Phpfox::getPhrase('dvs.strong_error_you_must_select_at_least_1_make_before_previewing_the_player_strong');
//		}
//		else
//		{
//			Phpfox::getBlock('idrive.player-preview', array('aVals' => $aVals, 'aMakes' => $aVals['selected_makes']));
//		}
		
		$aVals = Phpfox::getLib('request')->getArray('val');
		
		$bMakeSelected = false;

		foreach ($aVals['selected_makes'] as $sMake => $bSelected)
		{
			if ($bSelected)
			{
				$bMakeSelected = true;
			}
		}

		if (!$bMakeSelected)
		{
			echo Phpfox::getPhrase('dvs.strong_error_you_must_select_at_least_1_make_before_previewing_the_player_strong');
		}
		else
		{
			Phpfox::getBlock('idrive.player-preview', array('aVals' => $aVals, 'aMakes' => $aVals['selected_makes']));
		}
	}

	public function showPreview()
	{
		$aVals = $this->get('val');
		$aVals['player_id'] = $this->get('id');
		
		Phpfox::getBlock('idrive.player-preview', array('aVals' => $aVals));
	}

	public function removeLogoFile()
	{
		$iLogoId = $this->get('iLogoFileId');

		if (!Phpfox::getService('idrive')->hasAccess($iLogoId, Phpfox::getUserId(), 'logo'))
		{
			return false;
		}

		Phpfox::getService('idrive.file.process')->removeLogo($iLogoId);
	}


	public function removePrerollFile()
	{
		$iPrerollId = $this->get('iPrerollFileId');

		if (!Phpfox::getService('idrive')->hasAccess($iPrerollId, Phpfox::getUserId(), 'preroll'))
		{
			return false;
		}

		Phpfox::getService('idrive.file.process')->removePreRoll($iPrerollId);
	}


	public function contactDealer()
	{
		$aVals = Phpfox::getLib('request')->getArray('val');
		$bIsError = false;

		if (!$aVals['contact_name'] && Phpfox::getParam('dvs.get_price_validate_name'))
		{
			Phpfox_Error::set(Phpfox::getPhrase('dvs.please_enter_your_name'));
			$bIsError = true;
		}
		if (!$aVals['contact_email'] && Phpfox::getParam('dvs.get_price_validate_email'))
		{
			Phpfox_Error::set(Phpfox::getPhrase('dvs.please_enter_your_email_address'));
			$bIsError = true;
		}
		if (!$aVals['contact_phone'] && Phpfox::getParam('dvs.get_price_validate_phone'))
		{
			Phpfox_Error::set(Phpfox::getPhrase('dvs.please_enter_your_phone_number'));
			$bIsError = true;
		}
		if (!$aVals['contact_zip'] && Phpfox::getParam('dvs.get_price_validate_zip_code'))
		{
			Phpfox_Error::set(Phpfox::getPhrase('dvs.please_enter_your_zip_code'));
			$bIsError = true;
		}
		if (!$aVals['comments'] && Phpfox::getParam('dvs.get_price_validate_comments'))
		{
			Phpfox_Error::set(Phpfox::getPhrase('dvs.please_enter_comments'));
			$bIsError = true;
		}

		if (!$bIsError)
		{
			$sEmail = Phpfox::getService('idrive.player')->get($aVals['contact_dealer_address']);

			if (!$sEmail)
			{
				$aPlayer = Phpfox::getService('idrive.player')->get($aVals['contact_idrive_id']);
				if (!$aPlayer)
				{
					//An error has occured
					return false;
				}

				$bIsExternal = false;
			}
			else
			{
				$bIsExternal = true;
			}

			$aVideo = Phpfox::getService('dvs.video')->get($aVals['contact_video_ref_id']);

			if ($bIsExternal)
			{
				$sSubject = Phpfox::getPhrase('idrive.external_dealer_email_subject', array(
						'contact_name' => $aVals['contact_name'],
						'contact_email' => $aVals['contact_email'],
						'contact_phone' => $aVals['contact_phone'],
						'contact_zip' => $aVals['contact_zip'],
						'contact_comments' => $aVals['contact_comments'],
						'year' => $aVideo['year'],
						'make' => $aVideo['make'],
						'model' => $aVideo['model'],
						'bodyStyle' => $aVideo['bodyStyle']
				));

				$sBody = Phpfox::getPhrase('idrive.external_dealer_email_body', array(
						'contact_name' => $aVals['contact_name'],
						'contact_email' => $aVals['contact_email'],
						'contact_phone' => $aVals['contact_phone'],
						'contact_zip' => $aVals['contact_zip'],
						'contact_comments' => $aVals['contact_comments'],
						'year' => $aVideo['year'],
						'make' => $aVideo['make'],
						'model' => $aVideo['model'],
						'bodyStyle' => $aVideo['bodyStyle']
				));
			}
			else
			{
				$sSubject = Phpfox::getPhrase('idrive.dealer_email_subject', array(
						'contact_name' => $aVals['contact_name'],
						'contact_email' => $aVals['contact_email'],
						'contact_phone' => $aVals['contact_phone'],
						'contact_zip' => $aVals['contact_zip'],
						'contact_comments' => $aVals['contact_comments'],
						'year' => $aVideo['year'],
						'make' => $aVideo['make'],
						'model' => $aVideo['model'],
						'bodyStyle' => $aVideo['bodyStyle'],
						'player_name' => $aPlayer['player_name'],
						'idrive_link' => Phpfox::getLib('url')->makeUrl('idrive.player', array('id' => $aPlayer['player_id']))
				));

				$sBody = Phpfox::getPhrase('idrive.dealer_email_body', array(
						'contact_name' => $aVals['contact_name'],
						'contact_email' => $aVals['contact_email'],
						'contact_phone' => $aVals['contact_phone'],
						'contact_zip' => $aVals['contact_zip'],
						'contact_comments' => $aVals['contact_comments'],
						'year' => $aVideo['year'],
						'make' => $aVideo['make'],
						'model' => $aVideo['model'],
						'bodyStyle' => $aVideo['bodyStyle'],
						'player_name' => $aPlayer['player_name'],
						'idrive_link' => Phpfox::getLib('url')->makeUrl('idrive.player', array('id' => $aPlayer['player_id']))
				));
			}

			Phpfox::getLib('mail')
				->to((!$bIsExternal) ? $aPlayer['email'] : $sEmail)
				->subject($sSubject)
				->message($sBody)
				->send();

			//Phpfox::getService('idrive.process')->updateContactCount($aPlayer['dvs_id']);

			$this->hide('#idrive_contact_form');
			$this->show('#idrive_contact_success');
			$this->call('setTimeout(function() { $("#idrive_get_price_container").fadeOut("fast");}, 3000);');
			$this->call('setTimeout(function() { resetIDriveGetPriceForm(); }, 3500);');
			$this->call('getPriceEmailSent();');
		}
		else
		{
			return false;
		}
	}


}

?>
