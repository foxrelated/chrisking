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
 * @package 		DVS
 */
class Dvs_Component_Ajax_Ajax extends Phpfox_Ajax
{
	public function instantImport()
	{
		if(!Phpfox::isAdmin()){
			return false;
		}

		$dvs_id = $this->get('dvs_id');
		// echo $dvs_id;die();
		$res = Phpfox::getService('dvs')->importInventory($dvs_id);
		$this->call("finishProgress();");

	}

	public function updateInventoryConnector()
	{
		if(!Phpfox::isAdmin()){
			return false;
		}

		$connector_id    = $this->get('connector_id');
		$title           = $this->get('title');
		$guid            = $this->get('guid');
		$pagination_name = $this->get('pagination_name');
		$pagination_type = $this->get('pagination_type');
		$description     = $this->get('description');

		if(empty($connector_id)){
			return false;
		}

		if(empty($pagination_name)){
			$pagination_name = 'start';
		}

		Phpfox::getLib('database')->update(Phpfox::getT('ko_dvs_inventory_connectors'), array(
			'title' => Phpfox::getLib('database')->escape($title),
			'description' => Phpfox::getLib('database')->escape($description),
			'pagination_name' => Phpfox::getLib('database')->escape($pagination_name),
			'pagination_type' => Phpfox::getLib('database')->escape($pagination_type),
			'guid' => Phpfox::getLib('database')->escape($guid)
			), "connector_id = '".$connector_id."'");

		$this->call("connectorUpdated('{$connector_id}');");

	}

	public function deleteInventoryConnector()
	{
		if(!Phpfox::isAdmin()){
			return false;
		}

		$connector_id  = $this->get('connector_id');

		if(empty($connector_id)){
			return false;
		}

		Phpfox::getLib('database')->delete(Phpfox::getT('ko_dvs_inventory_connectors'), "connector_id = '".Phpfox::getLib('database')->escape($connector_id)."'");

		$this->call("connectorDeleted('{$connector_id}');");

	}

	public function addInventoryConnector()
	{
		if(!Phpfox::isAdmin()){
			return false;
		}

		$userId                        = Phpfox::getUserId();
		$dvs_inventory_name            = $this->get('dvs_inventory_name');
		$dvs_inventory_guid            = $this->get('dvs_inventory_guid');
		$dvs_inventory_notes           = $this->get('dvs_inventory_notes');
		$dvs_inventory_pagination_name = $this->get('dvs_inventory_pagination_name');
		$dvs_inventory_pagination_type = $this->get('dvs_inventory_pagination_type');

		if(empty($dvs_inventory_name) && empty($dvs_inventory_guid)){
			return false;
		}

		if(empty($dvs_inventory_pagination_name)){
			$dvs_inventory_pagination_name = 'start';
		}

		$connector_id = Phpfox::getLib('database')->insert(Phpfox::getT('ko_dvs_inventory_connectors'), array(
				'user_id'         => Phpfox::getLib('database')->escape($userId),
				'title'           => Phpfox::getLib('database')->escape($dvs_inventory_name),
				'description'     => Phpfox::getLib('database')->escape($dvs_inventory_notes),
				'pagination_name' => Phpfox::getLib('database')->escape($dvs_inventory_pagination_name),
				'pagination_type' => Phpfox::getLib('database')->escape($dvs_inventory_pagination_type),
				'guid'            => Phpfox::getLib('database')->escape($dvs_inventory_guid)
			)
		);

    $this->call("connectorCreated('{$connector_id}');");

	}

	public function updateClicks()
	{
		$sDvsRequest = $this->get('sDvsRequest');
		if (Phpfox::getParam('dvs.enable_subdomain_mode')){
			$sDvsRequest = str_replace(Phpfox::getLib('url')->makeUrl(''), '', $sDvsRequest);
		}else{
			$sDvsRequest = str_replace(Phpfox::getLib('url')->makeUrl('dvs'), '', $sDvsRequest);
		}
		$aShortUrl = Phpfox::getService('dvs.shorturl')->get($sDvsRequest);

		Phpfox::getService('dvs.shorturl.clicks.process')->click($aShortUrl['shorturl_id'], Phpfox::getUserId());
	}

	public function generateShortUrl()
	{
		$iDvsId = $this->get('dvs_id');
		$sVideoRefId = $this->get('video_ref_id');
		$sService = $this->get('service');
		$sReturnId = $this->get('return_id');
		$iUserId = Phpfox::getUserId();

		$sShortUrl = Phpfox::getService('dvs.shorturl')->generate($iDvsId, $sVideoRefId, $sService, $iUserId);

		if (Phpfox::getParam('dvs.enable_subdomain_mode'))
		{
			$sUrl = Phpfox::getLib('url')->makeUrl('') . $sShortUrl;
		}
		else
		{
			$sUrl = Phpfox::getLib('url')->makeUrl('dvs') . $sShortUrl;
		}

		$this->val('#' . $sReturnId, $sUrl);
	}

	public function getPrice()
	{
		Phpfox::getBlock('dvs.get-price');
		$this->html('#dvs_get_price_container', $this->getContent(false));
		$this->show('#dvs_get_price_container', 'fast');
	}

	public function showShareEmail()
	{
		Phpfox::getBlock('dvs.share-email');
		$this->html('#dvs_share_email_wrapper', $this->getContent(false));
		$this->call('checkModernizr();');
		$this->show('#dvs_share_email_wrapper', 'fast');
	}

	public function deletePlayer()
	{
		if (!Phpfox::isAdmin())
		{
			return false;
		}

		$iPlayerId = $this->get('player_id');

		Phpfox::getService('dvs.player.process')->remove($iPlayerId);
	}

	public function deleteDvs()
	{
		$iDvsId = $this->get('dvs_id');

		if (!Phpfox::getService('dvs')->hasAccess($iDvsId, Phpfox::getUserId()))
		{
			return false;
		}

		Phpfox::getService('dvs.process')->remove($iDvsId);
	}

	public function deleteTheme()
	{
		$iThemeId = $this->get('theme_id');

		Phpfox::getService('dvs.theme.process')->remove($iThemeId);
	}

	public function logoFileProcess()
	{
		$iUserId = $this->get('user_id');
		$this->errorSet('#js_logo_file_upload_message');

		if ($iId = Phpfox::getService('dvs.file')->logoFileProcess($this->get('logo_file'), $this->get('logo_file_id')))
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

	public function brandingFileProcess()
	{
		$iUserId = $this->get('user_id');
		$this->errorSet('#js_branding_file_upload_message');

		if ($iId = Phpfox::getService('dvs.file')->brandingFileProcess($this->get('branding_file'), $this->get('branding_file_id')))
		{
			$sBrandingFile = $this->get('branding_file');

			// windows
			if (strpos($sBrandingFile, "\\"))
			{
				$aParts = explode('\\', $sBrandingFile);
				if (isset($aParts[count($aParts) - 1]))
				{
					$sBrandingFile = $aParts[count($aParts) - 1];
				}
			}

			// Do we have an appropriate file extension for an image?
			$aFilePlusExtension = explode('.', $sBrandingFile);
			// Make the submission extension lower case.
			$sLowerCaseSubmission = strtolower($aFilePlusExtension[1]);
			// Make the approved extension list lower case.
			$aLowerCaseApproved = array_map('strtolower', Phpfox::getParam('dvs.allowed_file_types'));
			// Is the extension on the list?
			if(!in_array($sLowerCaseSubmission,$aLowerCaseApproved)){
				$this->call('window.parent.document.getElementById(\'error_message\').innerHTML = \''.Phpfox::getPhrase('dvs.please_select_a_valid_banner_image').'\';window.parent.document.getElementById(\'error_message\').setAttribute("style","display:show");');
				return false;
			}else{
				$this->call('window.parent.document.getElementById(\'error_message\').setAttribute("style","display:none");');
			}


			$this->attr('#js_view_branding_file_link', 'href', Phpfox::getLib('url')->makeUrl('file', array('redirect' => $iId)))
				->html('#js_branding_upload_file_name', htmlentities(addslashes($sBrandingFile)))
				->val('.js_cache_branding_file_id', $iId)
				->submit('#js_branding_file_form')
				->show('#js_branding_file_process');
		}
		else
		{
			$this->show('#js_branding_file_upload_error');
		}
	}

	public function backgroundFileProcess()
	{
		$iUserId = $this->get('user_id');
		$this->errorSet('#js_background_file_upload_message');

		if ($iId = Phpfox::getService('dvs.file')->backgroundFileProcess($this->get('background_file'), $this->get('background_file_id')))
		{
			$sBackgroundFile = $this->get('background_file');

			// windows
			if (strpos($sBackgroundFile, "\\"))
			{
				$aParts = explode('\\', $sBackgroundFile);
				if (isset($aParts[count($aParts) - 1]))
				{
					$sBackgroundFile = $aParts[count($aParts) - 1];
				}
			}

						// Do we have an appropriate file extension for an image?
			$aFilePlusExtension = explode('.', $sBackgroundFile);
			// Make the submission extension lower case.
			$sLowerCaseSubmission = strtolower($aFilePlusExtension[1]);
			// Make the approved extension list lower case.
			$aLowerCaseApproved = array_map('strtolower', Phpfox::getParam('dvs.allowed_file_types'));
			// Is the extension on the list?
			if(!in_array($sLowerCaseSubmission,$aLowerCaseApproved)){
				$this->call('window.parent.document.getElementById(\'error_message\').innerHTML = \''.Phpfox::getPhrase('dvs.please_select_a_valid_background_image').'\';window.parent.document.getElementById(\'error_message\').setAttribute("style","display:show");');
				return false;
			}else{
				$this->call('window.parent.document.getElementById(\'error_message\').setAttribute("style","display:none");');
			}

			$this->attr('#js_view_background_file_link', 'href', Phpfox::getLib('url')->makeUrl('file', array('redirect' => $iId)))
				->html('#js_background_upload_file_name', htmlentities(addslashes($sBackgroundFile)))
				->val('.js_cache_background_file_id', $iId)
				->submit('#js_background_file_form')
				->show('#js_background_file_process');
		}
		else
		{
			$this->show('#js_background_file_upload_error');
		}
	}

    public function vdpFileProcess() {
        $iUserId = $this->get('user_id');
        $this->errorSet('#js_vdp_file_upload_message');

        if ($iId = Phpfox::getService('dvs.file')->vdpFileProcess($this->get('vdp_file'), $this->get('vdp_file_id'))) {
            $sVdpFile = $this->get('vdp_file');

            if (strpos($sVdpFile, "\\")) {
                $aParts = explode('\\', $sVdpFile);
                if (isset($aParts[count($aParts) - 1])) {
                    $sVdpFile = $aParts[count($aParts) - 1];
                }
            }

            // Do we have an appropriate file extension for an image?
            $aFilePlusExtension = explode('.', $sVdpFile);
            // Make the submission extension lower case.
            $sLowerCaseSubmission = strtolower($aFilePlusExtension[1]);
            // Make the approved extension list lower case.
            $aLowerCaseApproved = array_map('strtolower', Phpfox::getParam('dvs.allowed_file_types'));
            // Is the extension on the list?
            if(!in_array($sLowerCaseSubmission,$aLowerCaseApproved)){
                $this->call('window.parent.document.getElementById(\'error_message\').innerHTML = \'Please select a valid vdp image\';window.parent.document.getElementById(\'error_message\').setAttribute("style","display:show");');
                return false;
            }else{
                $this->call('window.parent.document.getElementById(\'error_message\').setAttribute("style","display:none");');
            }

            $this->attr('#js_view_vdp_file_link', 'href', Phpfox::getLib('url')->makeUrl('file', array('redirect' => $iId)))
                ->html('#js_vdp_upload_file_name', htmlentities(addslashes($sVdpFile)))
                ->val('.js_cache_vdp_file_id', $iId)
                ->submit('#js_vdp_file_form')
                ->show('#js_vdp_file_process');
        } else {
            $this->show('#js_vdp_file_upload_error');
        }
    }

    public function removeVdpFile() {
        $iVdpId = $this->get('iVdpFileId');

        if (!Phpfox::getService('dvs')->hasAccess($iVdpId, Phpfox::getUserId(), 'vdp')) {
            return false;
        }

        Phpfox::getService('dvs.file.process')->removeVdp($iVdpId);
    }

	public function prerollFileProcess()
	{
		$iUserId = $this->get('user_id');
		$this->errorSet('#js_preroll_file_upload_message');

		if ($iId = Phpfox::getService('dvs.file')->prerollFileProcess($this->get('preroll_file'), $this->get('preroll_file_id')))
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

    
    public function imageoverlayProcess()
    {
        $iUserId = $this->get('user_id');
        $this->errorSet('#js_image_overlay'.$overlay_id.'_file_upload_message');

        $overlay_id = $this->get('image_overlay');
       
       $sOverlayFile = $this->get('image_overlay'.$overlay_id.'_file');
      
       
            // windows
            if (strpos($sOverlayFile, "\\"))
            {
                $aParts = explode('\\', $sOverlayFile);
                if (isset($aParts[count($aParts) - 1]))
                {
                    $sOverlayFile = $aParts[count($aParts) - 1];
                }
            }
            
         
            $this
            //->attr('#js_view_preroll_file_link', 'href', Phpfox::getLib('url')->makeUrl('file', array('redirect' => $iId)))
                ->html('#js_image_overlay'.$overlay_id.'_upload_file_name', htmlentities(addslashes($sOverlayFile)))
//                ->val('.js_cache_image_overlay'.$overlay_id.'_file_id', $iId)
                ->submit('#js_image_overlay'.$overlay_id.'_file_form')
                ->show('#js_image_overlay'.$overlay_id.'_file_process');
        
        
    }
    
	public function removeBrandingFile()
	{
		$iBrandingId = $this->get('iBrandingFileId');

		if (!Phpfox::getService('dvs')->hasAccess($iBrandingId, Phpfox::getUserId(), 'branding'))
		{
			return false;
		}

		Phpfox::getService('dvs.file.process')->removeBranding($iBrandingId);
	}

	public function removeBackgroundFile()
	{
		$iBackgroundId = $this->get('iBackgroundFileId');

		if (!Phpfox::getService('dvs')->hasAccess($iBackgroundId, Phpfox::getUserId(), 'background'))
		{
			return false;
		}

		Phpfox::getService('dvs.file.process')->removeBackground($iBackgroundId);
	}

	public function removeLogoFile()
	{
		$iLogoId = $this->get('iLogoFileId');

		if (!Phpfox::getService('dvs')->hasAccess($iLogoId, Phpfox::getUserId(), 'logo'))
		{
			return false;
		}

		Phpfox::getService('dvs.file.process')->removeLogo($iLogoId);
	}

	public function removePrerollFile()
	{
		$iPrerollId = $this->get('iPrerollFileId');

		if (!Phpfox::getService('dvs')->hasAccess($iPrerollId, Phpfox::getUserId(), 'preroll'))
		{
			return false;
		}

		Phpfox::getService('dvs.file.process')->removePreRoll($iPrerollId);
	}

	public function moreInfoPlayerType()
	{
		$this->template()->getTemplate('dvs.block.more-info.player-type');
	}

	public function moreInfoDomainName()
	{
		$this->template()->getTemplate('dvs.block.more-info.domain-name');
	}

	public function moreInfoLogoBranding()
	{
		$this->template()->getTemplate('dvs.block.more-info.logo-branding');
	}

	public function moreInfoPrerollSwf()
	{
		$this->template()->getTemplate('dvs.block.more-info.preroll-swf');
	}

	public function moreInfoPrerollDuration()
	{
		$this->template()->getTemplate('dvs.block.more-info.preroll-duration');
	}

	public function previewPlayer()
	{
		$aVals = $this->get('val');

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

		$aValidation = array(
//				'player_name' => Phpfox::getPhrase('dvs.please_enter_a_player_name')
			'makes' => Phpfox::getPhrase('dvs.please_select_a_make_first')
		);

		if (!empty($aVals['preroll_file_id']))
		{
			$aValidation['preroll_duration'] = Phpfox::getPhrase('dvs.please_enter_a_duration_for_the_pre_roll_file');
		}

		$oValid = Phpfox::getLib('validator')->set(array(
			'sFormName' => 'add_player',
			'aParams' => $aValidation
			)
		);

		if (!empty($aVals['featured_model']))
		{
			$aFeaturedModel = explode(',', $aVals['featured_model']);
		}

		if (isset($aFeaturedModel[1]))
		{
			$aVals['featured_year'] = $aFeaturedModel[0];
			$aVals['featured_make'] = $aFeaturedModel[1];
			$aVals['featured_model'] = $aFeaturedModel[2];
		}
		else
		{
			$aVals['featured_year'] = '';
			$aVals['featured_make'] = '';
			$aVals['featured_model'] = '';
		}

		$aVals['domain'] = '';

		if ($oValid->isValid($aVals))
		{
			$aPlayer = Phpfox::getService('dvs.player')->get($aVals['dvs_id']);

			//DVS Players will always be interactive
			$aVals['player_type'] = 0;

			if (empty($aPlayer))
			{
				$iPlayerId = Phpfox::getService('dvs.player.process')->add($aVals);
			}
			else
			{
				$aVals['player_id'] = $aPlayer['player_id'];
				Phpfox::getService('dvs.player.process')->update($aVals);
			}

			$this->call("tb_show('" . Phpfox::getPhrase('dvs.preview') . "', $.ajaxBox('dvs.showPreview', 'width=' + iPreviewWidth + '&amp;height=' + iPreviewHeight + '&amp;' + $('#add_player').serialize()));");
		}
		else
		{
			return false;
		}

	}

	public function showPreview()
	{
		$aVals = $this->get('val');

		Phpfox::getBlock('dvs.player-preview', array('aVals' => $aVals));
	}

	public function showMiniPreview()
	{
		$aVals = $this->get('val');

		Phpfox::getBlock('dvs.playermini-preview', array('aVals' => $aVals, 'video_title_url' => $this->get('video_title_url')));
	}

	public function updateTitleUrl()
	{
		$sVanityUrl = Phpfox::getLib('request')->get('vanity_url');
		$iDvsId = Phpfox::getLib('request')->get('dvs_id');

		// Are we editing the current Vanity Url?
		if(!empty($iDvsId)){
			$sTitleUrl = Phpfox::getService('dvs')->getTitleUrl($sVanityUrl, $iDvsId);
		}
		else{
			$sTitleUrl = Phpfox::getService('dvs')->getTitleUrl($sVanityUrl);
		}

		$this->call('$("#title_url").val("' . $sTitleUrl . '");');
		if (Phpfox::getParam('dvs.enable_subdomain_mode'))
		{
			$this->call('$("#title_url_display").html("' . Phpfox::getLib('url')->makeUrl($sTitleUrl) . '");');
		}
		else
		{
			$this->call('$("#title_url_display").html("' . Phpfox::getLib('url')->makeUrl('dvs', $sTitleUrl) . '");');
		}

	}
	/*phpmasterminds added below function */
	/*public function blanknew()
	{
		$aDvs = Phpfox::getService('dvs')->get(Phpfox::getLib('request')->get('pollval'));

		$aVideo = Phpfox::getService('dvs.video')->get(Phpfox::getLib('request')->get('refe'));

		if (Phpfox::getParam('dvs.enable_subdomain_mode'))
		{
			$sOverrideLink = Phpfox::getLib('url')->makeUrl($aDvs['title_url'], $aVideo['video_title_url']);
		}
		else
		{
			$sOverrideLink = Phpfox::getLib('url')->makeUrl('dvs', array($aDvs['title_url'], $aVideo['video_title_url']));
		}

		$sOverrideLink = rtrim($sOverrideLink, '/');
		if($aDvs['gallery_target_setting'] == 1)
		{


			//$this->call('window.location.href = \'' . $sOverrideLink . '\';');
			$this->call('window.open( \'' . $sOverrideLink . '\',"_blank");');
		}
	}
	*/
	/*phpmasterminds added above function */
	public function changeVideo()
	{
		//Change RefID for contact form
		$sRefId = Phpfox::getLib('request')->get('sRefId');
		Phpfox::getService('dvs.video')->setDvs(Phpfox::getLib('request')->get('iDvsId'));
		$aVideo = Phpfox::getService('dvs.video')->get($sRefId);
		$aDvs = Phpfox::getService('dvs')->get(Phpfox::getLib('request')->get('iDvsId'));

		// Change get price form values
//		$this->html('.vehicle_year', $aVideo['year']);
//		$this->html('.vehicle_make', $aVideo['make']);
//		$this->html('.vehicle_model', $aVideo['model']);

//		$this->val('#contact_video_ref_id', $aVideo['referenceId']);

		if (empty($aDvs) || empty($aVideo))
		{
			return false;
		}

		$aDvs['phrase_overrides'] = Phpfox::getService('dvs.override')->getAll($aDvs, $aVideo);
		$bVideoChanged = ($this->get('bVideoChanged') == 'true' ? true : false);

		if (Phpfox::getParam('dvs.enable_subdomain_mode')) {
			$sOverrideLink = Phpfox::getLib('url')->makeUrl($aDvs['title_url'], $aVideo['video_title_url']);
		} else {
			$sOverrideLink = Phpfox::getLib('url')->makeUrl('dvs', array($aDvs['title_url'], $aVideo['video_title_url']));
		}

		$sOverrideLink = rtrim($sOverrideLink, '/');

		//Change video information and reset description visibility
		$this->html('#video_name', '<a href="' . $sOverrideLink . '">' . $aDvs['phrase_overrides']['override_video_name_display'] . '</a>');
		$this->html('#car_description', Phpfox::getLib('parse.output')->clean($aDvs['phrase_overrides']['override_video_description_display']));

//		$this->call('$("#twitter_share").prop("href", "https://twitter.com/intent/tweet?text=Check%20out%20" + sShareLink + "&url=" + sShareLink);');
//		$this->html('#video_name', '<strong><a href="' . $sOverrideLink . '">' . $aDvs['phrase_overrides']['override_video_name_display'] . '</a></strong>');
//		$this->html('#video_long_description_text', Phpfox::getLib('parse.output')->clean($aDvs['phrase_overrides']['override_video_description_display']));
//		$this->html('#video_long_description_shortened_text', Phpfox::getLib('parse.output')->shorten(Phpfox::getLib('parse.output')->clean($aDvs['phrase_overrides']['override_video_description_display']), Phpfox::getParam('dvs.long_desc_limit'), '...'));
//
//		$this->hide('#video_long_description');
//		$this->show('#video_long_description_shortened');

//		if (strlen(Phpfox::getLib('parse.output')->clean($aVideo['longDescription'])) > Phpfox::getParam('dvs.long_desc_limit'))
//		{
//			$this->show('#video_long_description_control');
//			$this->show('#video_long_description_shortened_control');
//		}
//		else
//		{
//			$this->hide('#video_long_description_control');
//			$this->hide('#video_long_description_shortened_control');
//		}

		$sThumbnailUrl = Phpfox::getLib('url')->makeUrl((Phpfox::getParam('dvs.enable_subdomain_mode') ? 'www.' : '') . 'file.brightcove') . $aVideo['video_still_image'];
		/* new thumb path */
		/*if( file_exists(PHPFOX_DIR_FILE . "brightcove" . PHPFOX_DS . $aVideo['video_still_image'] ) {
			$sThumbnailUrl = Phpfox::getLib('url')->makeUrl((Phpfox::getParam('dvs.enable_subdomain_mode') ? 'www.' : '') . ''file.brightcove') . $aVideo['video_still_image'];
		} else {
			$sThumbnailUrl = Phpfox::getLib('url')->makeUrl((Phpfox::getParam('dvs.enable_subdomain_mode') ? 'www.' : '') . ''theme.frontend.default.style.default.image.noimage') . 'item.png';
		}
		$sThumbnailUrl = str_replace('index.php?do=/', '', $sThumbnailUrl);*/

		// Change microdata
		$this->call('$("#schema_video_thumbnail_url").attr("content", "' . $sThumbnailUrl . '");');
		$this->call('$("#schema_video_image").attr("content", "' . $sThumbnailUrl. '");');
		$this->call('$("#schema_video_embed_url").attr("content", "//c.brightcove.com/services/viewer/federated_f9/1970101121001?isVid=1&isUI=1&domain=embed&playerID=1970101121001&publisherID=607012070001&videoID=' . $aVideo['referenceId'] . '");');
		$this->call('$("#schema_video_upload_date").attr("content", "' . date('Y-m-d', (int) ($aVideo['publishedDate'] / 1000)) . '");');
		$this->call('$("#schema_video_duration").attr("content", "PT' . (int) ($aVideo['length'] / 1000) . 'S");');
		$this->call('$("#schema_video_name").attr("content", "' . $aDvs['phrase_overrides']['override_video_name_display'] . '");');
		$this->call('$("#schema_video_description").attr("content", "' . Phpfox::getLib('parse.output')->clean($aDvs['phrase_overrides']['override_video_description_display']) . '");');

		// Change inventory link URL
		$sInventoryLink = str_replace('{$sMake}', urlencode($aVideo['make']), html_entity_decode($aDvs['inventory_url']));
		$sInventoryLink = str_replace('{$sModel}', urlencode($aVideo['model']), $sInventoryLink);
		$sInventoryLink = str_replace('{$iYear}', urlencode($aVideo['year']), $sInventoryLink);

		if (Phpfox::getParam('dvs.javascript_debug_mode'))
		{
			$this->call('console.log("Page: Inventory link: ' . $aDvs['inventory_url'] . '");');
			$this->call('console.log("Page: Setting Inventory link: ' . $sInventoryLink . '");');
		}

		$this->call('$(".dvs_inventory_link").attr("href", "' . $sInventoryLink . '");');

		//Change address bar contents
		$sBrowser = Phpfox::getService('dvs')->getBrowser();

		$sTitle = $aDvs['phrase_overrides']['override_page_title_display_video_specified'];
		$sUrl = $aVideo['video_title_url'];

		// Only change the URL if the video is not the default video
		if ($bVideoChanged)
		{
			if (Phpfox::getParam('dvs.javascript_debug_mode'))
			{
				$this->call('console.log("AJAX: Video is changed.  Changing URL...");');
			}

			$this->call('window.parent.history.pushState("string", "' . $sTitle . '", "' . $sUrl . '");');

			// Most browsers do not support changing the page title via pushState
			$this->call('document.title = "' . $sTitle . '";');
		}
		else
		{
			if (Phpfox::getParam('dvs.javascript_debug_mode'))
			{
				$this->call('console.log("AJAX: Video is unchanged.");');
			}
		}

		// Change share links
		$this->call('sShareLink = "' . $sOverrideLink . '";');

		if (Phpfox::getParam('dvs.javascript_debug_mode'))
		{
			$this->call('console.log("Page: Setting share URL to: ' . Phpfox::getLib('url')->makeUrl((Phpfox::getService('dvs')->getCname() ? Phpfox::getService('dvs')->getCname() : 'dvs'), $sUrl) . '");');
		}

		if ($sBrowser == 'mobile' || $sBrowser == 'ipad')
		{
			$this->attr('#bc_player_param_linkbase', 'value', Phpfox::getLib('url')->makeUrl((Phpfox::getService('dvs')->getCname() ? Phpfox::getService('dvs')->getCname() : 'dvs'), $sUrl));
		}
		else
		{
			$this->call('modSoc.setLink("' . Phpfox::getLib('url')->makeUrl((Phpfox::getService('dvs')->getCname() ? Phpfox::getService('dvs')->getCname() : 'dvs'), $sUrl) . '");');
		}

		$this->call('$("#schema_video_url").attr("content", "' . Phpfox::getLib('url')->makeUrl((Phpfox::getService('dvs')->getCname() ? Phpfox::getService('dvs')->getCname() : 'dvs'), $sUrl) . '");');

		// Change twitter default text
		// Repllace variables in the subject
		$aFindReplace = array();
		foreach ($aDvs as $sKey => $sValue) {
            if ($sKey == 'phrase_overrides') {
                continue;
            }
            if (!is_array($sValue)) {
                $aFind[] = '{dvs_' . $sKey . '}';
                $aReplace[] = '' . $sValue . '';
            }
		}

		foreach ($aVideo as $sKey => $sValue) {
            if (!is_array($sValue)) {
                $aFind[] = '{video_' . $sKey . '}';
                $aReplace[] = '' . $sValue . '';
            }
		}

		if ($bVideoChanged)
		{
			$this->val('#video_hash_code', Phpfox::getService('dvs.share')->convertNumberToHashCode($aVideo['ko_id'], 5));

			$sTwitterText = Phpfox::getPhrase('dvs.twitter_default_share_text');
			$sTwitterText = str_replace($aFind, $aReplace, $sTwitterText);

			$sShareCode = Phpfox::getLib('url')->makeUrl('share') . Phpfox::getService('dvs.share')->convertNumberToHashCode($aVideo['ko_id'], 5) . Phpfox::getService('dvs.share')->convertNumberToHashCode($aDvs['dvs_id'], 3);
			$this->remove('.twitter_popup');
			$this->html('#twitter_button_wrapper', '<a href="https://twitter.com/share?url=' . urlencode($sShareCode) . '&text=' . urlencode($sTwitterText) . '" class="twitter-share-button twitter_popup" data-size="large" data-count="none" id="dvs_twitter_share_link"></a>');
			$this->call('twttr.widgets.load();');
		}

		if($aDvs['inv_display_status']){
			$inventoryList = Phpfox::getService('dvs')->getModelInventory($aVideo['ko_id']);
			$sPlaylistHtml = '<div class="inventory_info_message">';
			if(count($inventoryList) > 1){
				$sPlaylistHtml .= count($inventoryList).' '.$aVideo['model'].'\'s available in inventory! Select one below:';
			}elseif(count($inventoryList) == 1){
				$sPlaylistHtml .= count($inventoryList).' '.$aVideo['model'].' available in inventory! Select one below:';
			}else{
				$sPlaylistHtml .= Phpfox::getPhrase('dvs.we_dont_have').' '.$aVideo['model'].' '.Phpfox::getPhrase('dvs.in_stock_at_this_time').'. <a href="#" onclick="tb_show(\'Contact Dealer\', $.ajaxBox(\'dvs.showGetPriceForm\', \'height=400&amp;width=360&amp;iDvsId='.$aDvs['dvs_id'].'&amp;sRefId='.$aVideo['referenceId'].'\')); menuContact(\'Call To Action Menu Clicks\'); return false;">Click here</a> to request this vehicle instead!';
			}
			$sPlaylistHtml .= '</div>';

			if($inventoryList){
				$sPlaylistHtml .= '<button class="prev playlist-button">&lt;</button>';
				$sPlaylistHtml .= '<div class="playlist_carousel" id="overview_inventory">';
				$sPlaylistHtml .= '<ul>';
				foreach ($inventoryList as $iKey => $inventoryItem)
				{
					$sThumbnailImageHtml = Phpfox::getLib('image.helper')->display(array(
						'path' => 'dvs.video_url_image',
						'file' => Phpfox::getParam('core.path') . '/file/' . $inventoryItem['image'],
						'max_width' => 145,
						'max_height' => 82));

					$sPlaylistHtml .= '<li><div class="inv_dvs_wrapper">' .
							'<div class="inv_dvs_avatar"><a href="'.$inventoryItem['link'].'" target="_blank">' . $sThumbnailImageHtml . '</a></div>' .
							'<div class="inv_dvs_info">' .
								'<p><a href="'.$inventoryItem['link'].'" target="_blank">'.$inventoryItem['title'].'</a></p>' .
								'<p>'.Phpfox::getPhrase('dvs.color').': '.$inventoryItem['color'].'</p>' .
								'<p>'.Phpfox::getPhrase('dvs.msrp').': '.$inventoryItem['price'].'</p>' .
								'<p class="view_details">' .
									'<a href="'.$inventoryItem['link'].'" title="'.Phpfox::getPhrase('dvs.view_details').'" target="_blank">'.Phpfox::getPhrase('dvs.view_details').'</a>' .
								'</p>' .
							'</div>' .
						'</div></li>';
				}

				$sPlaylistHtml .= '</ul>';
				$sPlaylistHtml .= '</div>';
				$sPlaylistHtml .= '<button class="next playlist-button">&gt;</button>';

				$this->html('#playlist_wrapper', $sPlaylistHtml);
				if ($sBrowser != 'mobile')
				{
					$this->call('enableInventoryCarousel();');
				}
			}else{
				$this->html('#playlist_wrapper', $sPlaylistHtml);
			}
		}

		$this->val('#contact_dvs_id', $aDvs['dvs_id']);


        if($aDvs['footer_toggle']) {
            Phpfox::getBlock('dvs.related-video', array('aDvs' => $aDvs, 'aVideo' => $aVideo));
            $this->html('#related_videos', $this->getContent(false));
        }
	}

     function changehtml5Video(){
        //Change RefID for contact form
        $sRefId = Phpfox::getLib('request')->get('sRefId');
        Phpfox::getService('dvs.video')->setDvs(Phpfox::getLib('request')->get('iDvsId'));
        $aVideo = Phpfox::getService('dvs.video')->get($sRefId);
        $aDvs = Phpfox::getService('dvs')->get(Phpfox::getLib('request')->get('iDvsId'));
        $vidtype = Phpfox::getLib('request')->get('vidtype');

        if (empty($aDvs) || empty($aVideo))
        {
            return false;
        }

        $aDvs['phrase_overrides'] = Phpfox::getService('dvs.override')->getAll($aDvs, $aVideo);
        $bVideoChanged = ($this->get('bVideoChanged') == 'true' ? true : false);
        

        if (Phpfox::getParam('dvs.enable_subdomain_mode')) {
            $sOverrideLink = Phpfox::getLib('url')->makeUrl($aDvs['title_url'], $aVideo['video_title_url']);
        } else {
            $sOverrideLink = Phpfox::getLib('url')->makeUrl('dvs', array($aDvs['title_url'], $aVideo['video_title_url']));
        }

        $sOverrideLink = rtrim($sOverrideLink, '/');

        //Change video information and reset description visibility
        if($vidtype == "inventory"){
        $this->html('#video_name', $aDvs['phrase_overrides']['override_video_name_display']);            
        }else if( $vidtype == 'vdpiframe'){
        $this->html('#video_name', $aDvs['phrase_overrides']['override_video_name_display']);            
        }
        else{
        $this->html('#video_name', '<a href="' . $sOverrideLink . '">' . $aDvs['phrase_overrides']['override_video_name_display'] . '</a>');    
        }
        
        $this->html('#car_description', Phpfox::getLib('parse.output')->clean($aDvs['phrase_overrides']['override_video_description_display']));


        $sThumbnailUrl = Phpfox::getLib('url')->makeUrl((Phpfox::getParam('dvs.enable_subdomain_mode') ? 'www.' : '') . 'file.brightcove') . $aVideo['video_still_image'];
        // Change inventory link URL
        $sInventoryLink = str_replace('{$sMake}', urlencode($aVideo['make']), html_entity_decode($aDvs['inventory_url']));
        $sInventoryLink = str_replace('{$sModel}', urlencode($aVideo['model']), $sInventoryLink);
        $sInventoryLink = str_replace('{$iYear}', urlencode($aVideo['year']), $sInventoryLink);

        if (Phpfox::getParam('dvs.javascript_debug_mode'))
        {
            $this->call('console.log("Page: Inventory link: ' . $aDvs['inventory_url'] . '");');
            $this->call('console.log("Page: Setting Inventory link: ' . $sInventoryLink . '");');
        }

        $this->call('$(".dvs_inventory_link").attr("href", "' . $sInventoryLink . '");');    
        $this->call('inventory_new = "'.$sInventoryLink.'";');    
        
        
        

        //Change address bar contents
        $sBrowser = Phpfox::getService('dvs')->getBrowser();

        $sTitle = $aDvs['phrase_overrides']['override_page_title_display_video_specified'];
        $sUrl = $aVideo['video_title_url'];

        // Only change the URL if the video is not the default video
        if ($bVideoChanged)
        {
            
            
                if (Phpfox::getParam('dvs.javascript_debug_mode'))
                {
                    $this->call('console.log("AJAX: Video is changed.  Changing URL...");');
                }

                $this->call('window.parent.history.pushState("string", "' . $sTitle . '", "' . $sUrl . '");');

                // Most browsers do not support changing the page title via pushState
                $this->call('document.title = "' . $sTitle . '";');
            
        }
        else
        {
            if (Phpfox::getParam('dvs.javascript_debug_mode'))
            {
                $this->call('console.log("AJAX: Video is unchanged.");');
            }
        }

        // Change share links
        $this->call('sShareLink = "' . $sOverrideLink . '";');

        if (Phpfox::getParam('dvs.javascript_debug_mode'))
        {
            $this->call('console.log("Page: Setting share URL to: ' . Phpfox::getLib('url')->makeUrl((Phpfox::getService('dvs')->getCname() ? Phpfox::getService('dvs')->getCname() : 'dvs'), $sUrl) . '");');
        }

       // if ($sBrowser == 'mobile' || $sBrowser == 'ipad')
//        {
//            $this->attr('#bc_player_param_linkbase', 'value', Phpfox::getLib('url')->makeUrl((Phpfox::getService('dvs')->getCname() ? Phpfox::getService('dvs')->getCname() : 'dvs'), $sUrl));
//        }
//        else
//        {
//            $this->call('modSoc.setLink("' . Phpfox::getLib('url')->makeUrl((Phpfox::getService('dvs')->getCname() ? Phpfox::getService('dvs')->getCname() : 'dvs'), $sUrl) . '");');
//        }
//
//        $this->call('$("#schema_video_url").attr("content", "' . Phpfox::getLib('url')->makeUrl((Phpfox::getService('dvs')->getCname() ? Phpfox::getService('dvs')->getCname() : 'dvs'), $sUrl) . '");');

        // Change twitter default text
        // Repllace variables in the subject
        $aFindReplace = array();
        foreach ($aDvs as $sKey => $sValue) {
            if ($sKey == 'phrase_overrides') {
                continue;
            }
            if (!is_array($sValue)) {
                $aFind[] = '{dvs_' . $sKey . '}';
                $aReplace[] = '' . $sValue . '';
            }
        }

        foreach ($aVideo as $sKey => $sValue) {
            if (!is_array($sValue)) {
                $aFind[] = '{video_' . $sKey . '}';
                $aReplace[] = '' . $sValue . '';
            }
        }

        if ($bVideoChanged)
        {
            $this->val('#video_hash_code', Phpfox::getService('dvs.share')->convertNumberToHashCode($aVideo['ko_id'], 5));

            $sTwitterText = Phpfox::getPhrase('dvs.twitter_default_share_text');
            $sTwitterText = str_replace($aFind, $aReplace, $sTwitterText);

            $sShareCode = Phpfox::getLib('url')->makeUrl('share') . Phpfox::getService('dvs.share')->convertNumberToHashCode($aVideo['ko_id'], 5) . Phpfox::getService('dvs.share')->convertNumberToHashCode($aDvs['dvs_id'], 3);
            $this->remove('.twitter_popup');
            $this->html('#twitter_button_wrapper', '<a href="https://twitter.com/share?url=' . urlencode($sShareCode) . '&text=' . urlencode($sTwitterText) . '" class="twitter-share-button twitter_popup" data-size="large" data-count="none" id="dvs_twitter_share_link"></a>');
            $this->call('twttr.widgets.load();');
        }

        if($aDvs['inv_display_status']){
            $inventoryList = Phpfox::getService('dvs')->getModelInventory($aVideo['ko_id']);         
            $sPlaylistHtml = '<div class="inventory_info_message">';
            if(count($inventoryList) > 1){
                $sPlaylistHtml .= count($inventoryList).' '.$aVideo['model'].'\'s available in inventory! Select one below:';
            }elseif(count($inventoryList) == 1){
                $sPlaylistHtml .= count($inventoryList).' '.$aVideo['model'].' available in inventory! Select one below:';
            }else{
                $sPlaylistHtml .= Phpfox::getPhrase('dvs.we_dont_have').' '.$aVideo['model'].' '.Phpfox::getPhrase('dvs.in_stock_at_this_time').'. <a href="#" onclick="tb_show(\'Contact Dealer\', $.ajaxBox(\'dvs.showGetPriceForm\', \'height=400&amp;width=360&amp;iDvsId='.$aDvs['dvs_id'].'&amp;sRefId='.$aVideo['referenceId'].'\')); menuContact(\'Call To Action Menu Clicks\'); return false;">Click here</a> to request this vehicle instead!';
            }
            $sPlaylistHtml .= '</div>';

            if($inventoryList){
                $sPlaylistHtml .= '<button class="prev playlist-button">&lt;</button>';
                $sPlaylistHtml .= '<div class="playlist_carousel" id="overview_inventory">';
                $sPlaylistHtml .= '<ul>';
                foreach ($inventoryList as $iKey => $inventoryItem)
                {                                                  
                    $sThumbnailImageHtml = Phpfox::getLib('image.helper')->display(array(
                        'path' => 'dvs.video_url_image',
                        'file' => Phpfox::getParam('core.path') . '/file/' . $inventoryItem['image'],
                        'max_width' => 145,
                        'max_height' => 82));

                    $sPlaylistHtml .= '<li><div class="inv_dvs_wrapper">' .
                            '<div class="inv_dvs_avatar"><a href="'.$inventoryItem['link'].'" target="_blank">' . $sThumbnailImageHtml . '</a></div>' .
                            '<div class="inv_dvs_info">' .
                                '<p><a href="'.$inventoryItem['link'].'" target="_blank">'.$inventoryItem['title'].'</a></p>' .
                                '<p>'.Phpfox::getPhrase('dvs.color').': '.$inventoryItem['color'].'</p>' .
                                '<p>'.Phpfox::getPhrase('dvs.msrp').': '.$inventoryItem['price'].'</p>' .
                                '<p class="view_details">' .
                                    '<a href="'.$inventoryItem['link'].'" title="'.Phpfox::getPhrase('dvs.view_details').'" target="_blank">'.Phpfox::getPhrase('dvs.view_details').'</a>' .
                                '</p>' .
                            '</div>' .
                        '</div></li>';
                }

                $sPlaylistHtml .= '</ul>';
                $sPlaylistHtml .= '</div>';
                $sPlaylistHtml .= '<button class="next playlist-button">&gt;</button>';

                $this->html('#playlist_wrapper', $sPlaylistHtml);
                if ($sBrowser != 'mobile')
                {
                    $this->call('enableInventoryCarousel();');
                }
            }else{
                $this->html('#playlist_wrapper', $sPlaylistHtml);
            }
        }

        $this->val('#contact_dvs_id', $aDvs['dvs_id']);


        if($aDvs['footer_toggle']) {
            Phpfox::getBlock('dvs.related-video', array('aDvs' => $aDvs, 'aVideo' => $aVideo));
            $this->html('#related_videos', $this->getContent(false));
        }
    }
    
    public function iframeChangeVideo()
    {
        //Change RefID for contact form
        $sRefId = Phpfox::getLib('request')->get('sRefId');
        Phpfox::getService('dvs.video')->setDvs(Phpfox::getLib('request')->get('iDvsId'));
        $aVideo = Phpfox::getService('dvs.video')->get($sRefId);
        $aDvs = Phpfox::getService('dvs')->get(Phpfox::getLib('request')->get('iDvsId'));

        if (empty($aDvs) || empty($aVideo))
        {
            return false;
        }

        $aDvs['phrase_overrides'] = Phpfox::getService('dvs.override')->getAll($aDvs, $aVideo);
        $bVideoChanged = ($this->get('bVideoChanged') == 'true' ? true : false);

        if ($aDvs['sitemap_parent_url']) {
            $sOverrideLink = str_replace('WTVDVS_VIDEO_TEMP', $aVideo['video_title_url'], $aDvs['parent_video_url']);
        } else {
            if (Phpfox::getParam('dvs.enable_subdomain_mode')) {
                $sOverrideLink = Phpfox::getLib('url')->makeUrl($aDvs['title_url'] . '.iframe', $aVideo['video_title_url']);
            } else {
                $sOverrideLink = Phpfox::getLib('url')->makeUrl('dvs.iframe', array($aDvs['title_url'], $aVideo['video_title_url']));
            }
            $sOverrideLink = rtrim($sOverrideLink, '/');
        }

        //Change video information and reset description visibility
        if ($this->get('bVideoClickable', 1)) {
            $this->html('#video_name','<a href="' . $sOverrideLink . '">' . $aDvs['phrase_overrides']['override_video_name_display'] . '</a>');
        } else {
            $this->html('#video_name', $aDvs['phrase_overrides']['override_video_name_display']);
        }

        $this->html('#car_description', Phpfox::getLib('parse.output')->clean($aDvs['phrase_overrides']['override_video_description_display']));

        $sThumbnailUrl = Phpfox::getLib('url')->makeUrl((Phpfox::getParam('dvs.enable_subdomain_mode') ? 'www.' : '') . 'file.brightcove') . $aVideo['video_still_image'];

        // Change microdata
        $this->call('$("#schema_video_thumbnail_url").attr("content", "' . $sThumbnailUrl . '");');
        $this->call('$("#schema_video_image").attr("content", "' . $sThumbnailUrl. '");');
        $this->call('$("#schema_video_embed_url").attr("content", "//c.brightcove.com/services/viewer/federated_f9/1970101121001?isVid=1&isUI=1&domain=embed&playerID=1970101121001&publisherID=607012070001&videoID=' . $aVideo['referenceId'] . '");');
        $this->call('$("#schema_video_upload_date").attr("content", "' . date('Y-m-d', (int) ($aVideo['publishedDate'] / 1000)) . '");');
        $this->call('$("#schema_video_duration").attr("content", "PT' . (int) ($aVideo['length'] / 1000) . 'S");');
        $this->call('$("#schema_video_name").attr("content", "' . $aDvs['phrase_overrides']['override_video_name_display'] . '");');
        $this->call('$("#schema_video_description").attr("content", "' . Phpfox::getLib('parse.output')->clean($aDvs['phrase_overrides']['override_video_description_display']) . '");');

        // Change inventory link URL
        $sInventoryLink = str_replace('{$sMake}', urlencode($aVideo['make']), html_entity_decode($aDvs['inventory_url']));
        $sInventoryLink = str_replace('{$sModel}', urlencode($aVideo['model']), $sInventoryLink);
        $sInventoryLink = str_replace('{$iYear}', urlencode($aVideo['year']), $sInventoryLink);

        if (Phpfox::getParam('dvs.javascript_debug_mode'))
        {
            $this->call('console.log("Page: Inventory link: ' . $aDvs['inventory_url'] . '");');
            $this->call('console.log("Page: Setting Inventory link: ' . $sInventoryLink . '");');
        }

        $this->call('$(".dvs_inventory_link").attr("href", "' . $sInventoryLink . '");');

        //Change address bar contents
        $sBrowser = Phpfox::getService('dvs')->getBrowser();

        $sTitle = $aDvs['phrase_overrides']['override_page_title_display_video_specified'];
        $sUrl = $aVideo['video_title_url'];

        // Only change the URL if the video is not the default video
        if ($bVideoChanged)
        {
            if (Phpfox::getParam('dvs.javascript_debug_mode'))
            {
                $this->call('console.log("AJAX: Video is changed.  Changing URL...");');
            }

            $this->call('window.parent.history.pushState("string", "' . $sTitle . '", "' . $sUrl . '");');

            // Most browsers do not support changing the page title via pushState
            $this->call('document.title = "' . $sTitle . '";');
        }
        else
        {
            if (Phpfox::getParam('dvs.javascript_debug_mode'))
            {
                $this->call('console.log("AJAX: Video is unchanged.");');
            }
        }

        // Change share links
        $this->call('sShareLink = "' . $sOverrideLink . '";');

        if (Phpfox::getParam('dvs.javascript_debug_mode'))
        {
            $this->call('console.log("Page: Setting share URL to: ' . Phpfox::getLib('url')->makeUrl((Phpfox::getService('dvs')->getCname() ? Phpfox::getService('dvs')->getCname() : 'dvs'), $sUrl) . '");');
        }

        if ($sBrowser == 'mobile' || $sBrowser == 'ipad')
        {
            $this->attr('#bc_player_param_linkbase', 'value', Phpfox::getLib('url')->makeUrl((Phpfox::getService('dvs')->getCname() ? Phpfox::getService('dvs')->getCname() : 'dvs'), $sUrl));
        }
        else
        {
            $this->call('modSoc.setLink("' . Phpfox::getLib('url')->makeUrl((Phpfox::getService('dvs')->getCname() ? Phpfox::getService('dvs')->getCname() : 'dvs'), $sUrl) . '");');
        }

        $this->call('$("#schema_video_url").attr("content", "' . Phpfox::getLib('url')->makeUrl((Phpfox::getService('dvs')->getCname() ? Phpfox::getService('dvs')->getCname() : 'dvs'), $sUrl) . '");');

        // Change twitter default text
        // Repllace variables in the subject
        $aFindReplace = array();
        foreach ($aDvs as $sKey => $sValue) {
            if ($sKey == 'phrase_overrides') {
                continue;
            }

            if (!is_array($sValue)) {
                $aFind[] = '{dvs_' . $sKey . '}';
                $aReplace[] = '' . $sValue . '';
            }
        }

        foreach ($aVideo as $sKey => $sValue) {
            if (!is_array($sValue)) {
                $aFind[] = '{video_' . $sKey . '}';
                $aReplace[] = '' . $sValue . '';
            }
        }

        if ($bVideoChanged)
        {
            $sTwitterText = Phpfox::getPhrase('dvs.twitter_default_share_text');
            $sTwitterText = str_replace($aFind, $aReplace, $sTwitterText);

			$sShareCode = Phpfox::getLib('url')->makeUrl('share') . Phpfox::getService('dvs.share')->convertNumberToHashCode($aVideo['ko_id'], 5) . Phpfox::getService('dvs.share')->convertNumberToHashCode($aDvs['dvs_id'], 3);
            $this->remove('.twitter_popup');
            $this->html('#twitter_button_wrapper', '<a href="https://twitter.com/share?url=' . urlencode($sShareCode) . '&text=' . urlencode($sTwitterText) . '" class="twitter-share-button twitter_popup" data-size="large" data-count="none" id="dvs_twitter_share_link"></a>');
            $this->call('twttr.widgets.load();');
        }

        if($aDvs['inv_display_status']){
            $inventoryList = Phpfox::getService('dvs')->getModelInventory($aVideo['ko_id']);
            $sPlaylistHtml = '<div class="inventory_info_message">';
            if(count($inventoryList) > 1){
                $sPlaylistHtml .= count($inventoryList).' '.$aVideo['model'].'�s available in inventory! Select one below:';
            }elseif(count($inventoryList) > 1){
                $sPlaylistHtml .= count($inventoryList).' '.$aVideo['model'].' available in inventory! Select one below:';
            }else{
                $sPlaylistHtml .= 'We don�t have the '.$aVideo['model'].' in stock at this time. <a href="#" onclick="tb_show(\'Contact Dealer\', $.ajaxBox(\'dvs.showGetPriceForm\', \'height=400&amp;width=360&amp;iDvsId='.$aDvs['dvs_id'].'&amp;sRefId='.$aVideo['referenceId'].'\')); menuContact(\'Call To Action Menu Clicks\'); return false;">Click here</a> to request this vehicle instead!';
            }
            $sPlaylistHtml .= '</div>';

            if($inventoryList){
                $sPlaylistHtml .= '<button class="prev playlist-button">&lt;</button>';
                $sPlaylistHtml .= '<div class="playlist_carousel" id="overview_inventory">';
                $sPlaylistHtml .= '<ul>';
                foreach ($inventoryList as $iKey => $inventoryItem)
                {
                    $sThumbnailImageHtml = Phpfox::getLib('image.helper')->display(array(
                        'path' => 'dvs.video_url_image',
                        'file' => Phpfox::getParam('core.path') . '/file/' . $inventoryItem['image'],
                        'max_width' => 145,
                        'max_height' => 82));

                    $sPlaylistHtml .= '<li><div class="inv_dvs_wrapper">' .
                        '<div class="inv_dvs_avatar"><a href="'.$inventoryItem['link'].'" target="_blank">' . $sThumbnailImageHtml . '</a></div>' .
                        '<div class="inv_dvs_info">' .
                        '<p><a href="'.$inventoryItem['link'].'" target="_blank">'.$inventoryItem['title'].'</a></p>' .
                        '<p>'.Phpfox::getPhrase('dvs.color').': '.$inventoryItem['color'].'</p>' .
                        '<p>'.Phpfox::getPhrase('dvs.msrp').': '.$inventoryItem['price'].'</p>' .
                        '<p class="view_details">' .
                        '<a href="'.$inventoryItem['link'].'" title="'.Phpfox::getPhrase('dvs.view_details').'" target="_blank">'.Phpfox::getPhrase('dvs.view_details').'</a>' .
                        '</p>' .
                        '</div>' .
                        '</div></li>';
                }

                $sPlaylistHtml .= '</ul>';
                $sPlaylistHtml .= '</div>';
                $sPlaylistHtml .= '<button class="next playlist-button">&gt;</button>';

                $this->html('#playlist_wrapper', $sPlaylistHtml);
                if ($sBrowser != 'mobile')
                {
                    $this->call('enableInventoryCarousel();');
                }
            }else{
                $this->html('#playlist_wrapper', $sPlaylistHtml);
            }
        }

        $this->val('#contact_dvs_id', $aDvs['dvs_id']);
    }
    
      public function iframeChangehtml5Video()
    {
        //Change RefID for contact form
        $sRefId = Phpfox::getLib('request')->get('sRefId');
        Phpfox::getService('dvs.video')->setDvs(Phpfox::getLib('request')->get('iDvsId'));
        $aVideo = Phpfox::getService('dvs.video')->get($sRefId);
        $aDvs = Phpfox::getService('dvs')->get(Phpfox::getLib('request')->get('iDvsId'));

        if (empty($aDvs) || empty($aVideo))
        {
            return false;
        }

        $aDvs['phrase_overrides'] = Phpfox::getService('dvs.override')->getAll($aDvs, $aVideo);
        $bVideoChanged = ($this->get('bVideoChanged') == 'true' ? true : false);

        if ($aDvs['sitemap_parent_url']) {
            $sOverrideLink = str_replace('WTVDVS_VIDEO_TEMP', $aVideo['video_title_url'], $aDvs['parent_video_url']);
        } else {
            if (Phpfox::getParam('dvs.enable_subdomain_mode')) {
                $sOverrideLink = Phpfox::getLib('url')->makeUrl($aDvs['title_url'] . '.iframe', $aVideo['video_title_url']);
            } else {
                $sOverrideLink = Phpfox::getLib('url')->makeUrl('dvs.iframe', array($aDvs['title_url'], $aVideo['video_title_url']));
            }
            $sOverrideLink = rtrim($sOverrideLink, '/');
        }

        //Change video information and reset description visibility
        if ($this->get('bVideoClickable', 1)) {
            $this->html('#video_name','<a href="' . $sOverrideLink . '">' . $aDvs['phrase_overrides']['override_video_name_display'] . '</a>');
        } else {
            $this->html('#video_name', $aDvs['phrase_overrides']['override_video_name_display']);
        }

        $this->html('#car_description', Phpfox::getLib('parse.output')->clean($aDvs['phrase_overrides']['override_video_description_display']));

        $sThumbnailUrl = Phpfox::getLib('url')->makeUrl((Phpfox::getParam('dvs.enable_subdomain_mode') ? 'www.' : '') . 'file.brightcove') . $aVideo['video_still_image'];

        // Change inventory link URL
        $sInventoryLink = str_replace('{$sMake}', urlencode($aVideo['make']), html_entity_decode($aDvs['inventory_url']));
        $sInventoryLink = str_replace('{$sModel}', urlencode($aVideo['model']), $sInventoryLink);
        $sInventoryLink = str_replace('{$iYear}', urlencode($aVideo['year']), $sInventoryLink);

        if (Phpfox::getParam('dvs.javascript_debug_mode'))
        {
            $this->call('console.log("Page: Inventory link: ' . $aDvs['inventory_url'] . '");');
            $this->call('console.log("Page: Setting Inventory link: ' . $sInventoryLink . '");');
        }

        $this->call('$(".dvs_inventory_link").attr("href", "' . $sInventoryLink . '");');
        $this->call('inventory_new = "'.$sInventoryLink.'";');    
        //Change address bar contents
        $sBrowser = Phpfox::getService('dvs')->getBrowser();

        $sTitle = $aDvs['phrase_overrides']['override_page_title_display_video_specified'];
        $sUrl = $aVideo['video_title_url'];

        // Only change the URL if the video is not the default video
        if ($bVideoChanged)
        {
            
            if (Phpfox::getParam('dvs.javascript_debug_mode'))
            {
                $this->call('console.log("AJAX: Video is changed.  Changing URL...");');
            }

//            $this->call('window.parent.history.pushState("string", "' . $sTitle . '", "' . $sUrl . '");');

            // Most browsers do not support changing the page title via pushState
            $this->call('document.title = "' . $sTitle . '";');
        }
        else
        {
            if (Phpfox::getParam('dvs.javascript_debug_mode'))
            {
                $this->call('console.log("AJAX: Video is unchanged.");');
            }
        }

        // Change share links
        $this->call('sShareLink = "' . $sOverrideLink . '";');

        if (Phpfox::getParam('dvs.javascript_debug_mode'))
        {
            $this->call('console.log("Page: Setting share URL to: ' . Phpfox::getLib('url')->makeUrl((Phpfox::getService('dvs')->getCname() ? Phpfox::getService('dvs')->getCname() : 'dvs'), $sUrl) . '");');
        }

        //if ($sBrowser == 'mobile' || $sBrowser == 'ipad')
//        {
//            $this->attr('#bc_player_param_linkbase', 'value', Phpfox::getLib('url')->makeUrl((Phpfox::getService('dvs')->getCname() ? Phpfox::getService('dvs')->getCname() : 'dvs'), $sUrl));
//        }
//        else
//        {
//            $this->call('modSoc.setLink("' . Phpfox::getLib('url')->makeUrl((Phpfox::getService('dvs')->getCname() ? Phpfox::getService('dvs')->getCname() : 'dvs'), $sUrl) . '");');
//        }
//
//        $this->call('$("#schema_video_url").attr("content", "' . Phpfox::getLib('url')->makeUrl((Phpfox::getService('dvs')->getCname() ? Phpfox::getService('dvs')->getCname() : 'dvs'), $sUrl) . '");');

        // Change twitter default text
        // Repllace variables in the subject
        $aFindReplace = array();
        foreach ($aDvs as $sKey => $sValue) {
            if ($sKey == 'phrase_overrides') {
                continue;
            }

            if (!is_array($sValue)) {
                $aFind[] = '{dvs_' . $sKey . '}';
                $aReplace[] = '' . $sValue . '';
            }
        }

        foreach ($aVideo as $sKey => $sValue) {
            if (!is_array($sValue)) {
                $aFind[] = '{video_' . $sKey . '}';
                $aReplace[] = '' . $sValue . '';
            }
        }

        if ($bVideoChanged)
        {
            $this->val('#video_hash_code', Phpfox::getService('dvs.share')->convertNumberToHashCode($aVideo['ko_id'], 5));
            
            $sTwitterText = Phpfox::getPhrase('dvs.twitter_default_share_text');
            $sTwitterText = str_replace($aFind, $aReplace, $sTwitterText);

            $sShareCode = Phpfox::getLib('url')->makeUrl('share') . Phpfox::getService('dvs.share')->convertNumberToHashCode($aVideo['ko_id'], 5) . Phpfox::getService('dvs.share')->convertNumberToHashCode($aDvs['dvs_id'], 3);
            $this->remove('.twitter_popup');
            $this->html('#twitter_button_wrapper', '<a href="https://twitter.com/share?url=' . urlencode($sShareCode) . '&text=' . urlencode($sTwitterText) . '" class="twitter-share-button twitter_popup" data-size="large" data-count="none" id="dvs_twitter_share_link"></a>');
            $this->call('twttr.widgets.load();');
        }

        if($aDvs['inv_display_status']){
            $inventoryList = Phpfox::getService('dvs')->getModelInventory($aVideo['ko_id']);
            $sPlaylistHtml = '<div class="inventory_info_message">';
            if(count($inventoryList) > 1){
                $sPlaylistHtml .= count($inventoryList).' '.$aVideo['model'].'�s available in inventory! Select one below:';
            }elseif(count($inventoryList) > 1){
                $sPlaylistHtml .= count($inventoryList).' '.$aVideo['model'].' available in inventory! Select one below:';
            }else{
                $sPlaylistHtml .= 'We don�t have the '.$aVideo['model'].' in stock at this time. <a href="#" onclick="tb_show(\'Contact Dealer\', $.ajaxBox(\'dvs.showGetPriceForm\', \'height=400&amp;width=360&amp;iDvsId='.$aDvs['dvs_id'].'&amp;sRefId='.$aVideo['referenceId'].'\')); menuContact(\'Call To Action Menu Clicks\'); return false;">Click here</a> to request this vehicle instead!';
            }
            $sPlaylistHtml .= '</div>';

            if($inventoryList){
                $sPlaylistHtml .= '<button class="prev playlist-button">&lt;</button>';
                $sPlaylistHtml .= '<div class="playlist_carousel" id="overview_inventory">';
                $sPlaylistHtml .= '<ul>';
                foreach ($inventoryList as $iKey => $inventoryItem)
                {
                    $sThumbnailImageHtml = Phpfox::getLib('image.helper')->display(array(
                        'path' => 'dvs.video_url_image',
                        'file' => Phpfox::getParam('core.path') . '/file/' . $inventoryItem['image'],
                        'max_width' => 145,
                        'max_height' => 82));

                    $sPlaylistHtml .= '<li><div class="inv_dvs_wrapper">' .
                        '<div class="inv_dvs_avatar"><a href="'.$inventoryItem['link'].'" target="_blank">' . $sThumbnailImageHtml . '</a></div>' .
                        '<div class="inv_dvs_info">' .
                        '<p><a href="'.$inventoryItem['link'].'" target="_blank">'.$inventoryItem['title'].'</a></p>' .
                        '<p>'.Phpfox::getPhrase('dvs.color').': '.$inventoryItem['color'].'</p>' .
                        '<p>'.Phpfox::getPhrase('dvs.msrp').': '.$inventoryItem['price'].'</p>' .
                        '<p class="view_details">' .
                        '<a href="'.$inventoryItem['link'].'" title="'.Phpfox::getPhrase('dvs.view_details').'" target="_blank">'.Phpfox::getPhrase('dvs.view_details').'</a>' .
                        '</p>' .
                        '</div>' .
                        '</div></li>';
                }

                $sPlaylistHtml .= '</ul>';
                $sPlaylistHtml .= '</div>';
                $sPlaylistHtml .= '<button class="next playlist-button">&gt;</button>';

                $this->html('#playlist_wrapper', $sPlaylistHtml);
                if ($sBrowser != 'mobile')
                {
                    $this->call('enableInventoryCarousel();');
                }
            }else{
                $this->html('#playlist_wrapper', $sPlaylistHtml);
            }
        }

        $this->val('#contact_dvs_id', $aDvs['dvs_id']);
    }

	public function contactDealer()
	{
		$aVals = Phpfox::getLib('request')->getArray('val');
		$bIsError = false;

		if (!$aVals['contact_name'] && Phpfox::getParam('dvs.get_price_validate_name'))
		{
			Phpfox_Error::set(Phpfox::getPhrase('dvs.please_enter_your_name'). ' ');
			$bIsError = true;
		}
		if (!$aVals['contact_email'] && Phpfox::getParam('dvs.get_price_validate_email'))
		{
			Phpfox_Error::set(Phpfox::getPhrase('dvs.please_enter_your_email_address'). ' ');
			$bIsError = true;
		}
		if (!$aVals['contact_phone'] && Phpfox::getParam('dvs.get_price_validate_phone'))
		{
			Phpfox_Error::set(Phpfox::getPhrase('dvs.please_enter_your_phone_number'). ' ');
			$bIsError = true;
		}
		if (!$aVals['contact_zip'] && Phpfox::getParam('dvs.get_price_validate_zip_code'))
		{
			Phpfox_Error::set(Phpfox::getPhrase('dvs.please_enter_your_zip_code'). ' ');
			$bIsError = true;
		}
		if (!$aVals['contact_comments'] && Phpfox::getParam('dvs.get_price_validate_comments'))
		{
			Phpfox_Error::set(Phpfox::getPhrase('dvs.please_enter_comments'). ' ');
			$bIsError = true;
		}
        
		if (!$bIsError)
		{
            
			$this->call("$('#contact_dealer').hide();");
			$this->call("$('#dvs_contact_success').show();");
			$this->call("setTimeout(function() { tb_remove(); }, 3000);");

			$aVideo = Phpfox::getService('dvs.video')->get($aVals['contact_video_ref_id']);
			$aDvs = Phpfox::getService('dvs')->get($aVals['contact_dvs_id']);

			$sSubject = Phpfox::getPhrase('dvs.dealer_email_subject', array(
					'contact_name' => $aVals['contact_name'],
					'contact_email' => $aVals['contact_email'],
					'contact_phone' => $aVals['contact_phone'],
					'contact_zip' => $aVals['contact_zip'],
					'contact_comments' => $aVals['contact_comments'],
					'year' => $aVideo['year'],
					'make' => $aVideo['make'],
					'model' => $aVideo['model'],
					'bodyStyle' => $aVideo['bodyStyle'],
					'dvs_name' => $aDvs['dvs_name'],
					'dealer_name' => $aDvs['dealer_name'],
					'title_url' => $aDvs['title_url'],
					'address' => $aDvs['address'],
					'city' => $aDvs['city'],
					'state_string' => $aDvs['state_string'],
					'phone' => $aDvs['phone']
			));
            

            if($aDvs['email_format']){
                $sBody = Phpfox::getPhrase('dvs.dealer_email_xml_body', array(
                    'time' => date('Y-m-dTH:i:s', PHPFOX_TIME),
                    'dvs_name' => $aDvs['dvs_name'],
                    'year' => $aVideo['year'],
                    'make' => $aVideo['make'],
                    'model' => $aVideo['model'],
                    'contact_name' => $aVals['contact_name'],
                    'contact_email' => $aVals['contact_email'],
                    'contact_phone' => $aVals['contact_phone'],
                    'contact_comments' => $aVals['contact_comments']
                ));
            }else{
                $sBody = Phpfox::getPhrase('dvs.dealer_email_body', array(
                    'contact_name' => $aVals['contact_name'],
                    'contact_email' => $aVals['contact_email'],
                    'contact_phone' => $aVals['contact_phone'],
                    'contact_zip' => $aVals['contact_zip'],
                    'contact_comments' => $aVals['contact_comments'],
                    'year' => $aVideo['year'],
                    'make' => $aVideo['make'],
                    'model' => $aVideo['model'],
                    'bodyStyle' => $aVideo['bodyStyle'],
                    'dvs_name' => $aDvs['dvs_name'],
                    'dealer_name' => $aDvs['dealer_name'],
                    'title_url' => $aDvs['title_url'],
                    'address' => $aDvs['address'],
                    'city' => $aDvs['city'],
                    'state_string' => $aDvs['state_string'],
                    'phone' => $aDvs['phone']
                ));
            }
            $sEmailSig = preg_replace('/\{phrase var=\'(.*)\'\}/ise', "'' . Phpfox::getPhrase('\\1', {$this->_sArray}, false, null, '". Phpfox::getParam('core.default_lang_id')."') . ''", Phpfox::getParam('core.mail_signature'));
            
			//Phpfox::getLib('mail')
//				->to($aDvs['email'])
//				->subject($sSubject)
//				->message($sBody)
//				->send();
             $sTextHtml = Phpfox::getLib('template')->assign(array(
                        'bHtml' => true,
                        'sMessage' => str_replace("\n", "<br />", $sBody),
                        'sEmailSig' => str_replace("\n", "<br />", $sEmailSig),
                        'bMessageHeader' => $this->_bMessageHeader
                    )
                    )->getLayout('email', true);
             Phpfox::getLibClass('phpfox.mail.interface');
             
            $toMail = explode(',',$aDvs['email']);
                    
            $oMail = Phpfox::getLib('mail.driver.phpmailer.' . Phpfox::getParam('core.method'));
            
            foreach($toMail as $receipent){
            $receipent = trim($receipent);    
            $oMail->send($receipent, $sSubject, $sBody, $sTextHtml);

            Phpfox::getService('dvs.process')->updateContactCount($aDvs['dvs_id']);

            $this->call('getPriceEmailSent();');    
            }
            
		}
		else
		{
			return false;
		}
	}

	public function sendShareText()
	{
        Phpfox::getLib('setting')->setParam('brightcove.dir_image', PHPFOX_DIR_FILE . 'pic' . PHPFOX_DS . 'brightcove' . PHPFOX_DS);
        Phpfox::getLib('setting')->setParam('brightcove.url_image', Phpfox::getParam('core.url_pic') . 'brightcove/');

		$aVals = Phpfox::getLib('request')->getArray('val');
		$bIsError = false;

		if (!$aVals['receiver_mobile']) {
			Phpfox_Error::set('Please enter receiver mobile');
			$bIsError = true;
		}


		if (!$bIsError) {
			$aDvs = Phpfox::getService('dvs')->get($aVals['dvs_id']);
			Phpfox::getService('dvs.video')->setDvs($aDvs['dvs_id']);
			$aVideo = Phpfox::getService('dvs.video')->get($aVals['video_ref_id']);
            $oShareService = Phpfox::getService('dvs.share');
            $sVideoLink = $oShareService->convertNumberToHashCode($aVideo['ko_id'], 5) . $oShareService->convertNumberToHashCode($aDvs['dvs_id'], 3);
            $sVideoLink = Phpfox::getLib('url')->makeUrl('share.') . $sVideoLink . '7';
			$sBody = Phpfox::getPhrase('dvs.dealer_text_body', array(
				'dealer_name' => $aDvs['dvs_name'],
				'custom_message' => $aVals['custom_message'],
				'video_link' => $sVideoLink
			));
			$url = 'https://www.callfire.com/api/1.1/rest/text';
			$username = '8d8f92381861';
			$password='fa466f5e29147c02';
			$params = array(
				'Text'  => 'TEXT',
				'Message' => $sBody,
				//'From' => $aVals['sender_mobile'],
				'From' => 67076,
				'To' => $aVals['receiver_mobile'],
				'BroadcastName' => $aDvs['dvs_name']
				
			);
			$http = curl_init($url);
			curl_setopt($http, CURLOPT_POST, true);
			$query = http_build_query($params);
			curl_setopt($http, CURLOPT_POSTFIELDS, $query);
			$header = array('Content-Type: application/x-www-form-urlencoded');
			curl_setopt($http, CURLOPT_HTTPHEADER,     $header);
			curl_setopt($http, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($http, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($http, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($http, CURLOPT_USERPWD, "$username:$password");
			$response = curl_exec($http);
			$error = curl_error($http);
			curl_close($http);

            $this->hide('#loading_text_img')
                ->show('.share_text_field');

			$this->hide('#share_text_dealer');
			$this->show('#dvs_share_text_success');
			$this->call("setTimeout(function() { tb_remove(); }, 3000);");
		} else {
            $this->hide('#loading_text_img')
                ->show('.share_text_field');
			return false;
		}
	}

	public function sendShareEmail()
	{
		Phpfox::getLib('setting')->setParam('brightcove.dir_image', PHPFOX_DIR_FILE . 'pic' . PHPFOX_DS . 'brightcove' . PHPFOX_DS);
		Phpfox::getLib('setting')->setParam('brightcove.url_image', Phpfox::getParam('core.url_pic') . 'brightcove/');

		$aVals = Phpfox::getLib('request')->getArray('val');
		$bIsError = false;

		if (!$aVals['share_name']) {
			Phpfox_Error::set(Phpfox::getPhrase('dvs.please_enter_an_email_address'));
			$bIsError = true;
		}
		if (!$aVals['my_share_name']) {
			Phpfox_Error::set(Phpfox::getPhrase('dvs.please_enter_your_name'));
			$bIsError = true;
		}

		if (!$aVals['my_share_email']) {
			Phpfox_Error::set(Phpfox::getPhrase('dvs.please_enter_your_email_address'));
			$bIsError = true;
		}

		if (!$aVals['share_email']) {
			Phpfox_Error::set(Phpfox::getPhrase('dvs.please_enter_your_friends_name'));
			$bIsError = true;
		}

		if (!$bIsError) {
			$aDvs = Phpfox::getService('dvs')->get($aVals['dvs_id']);
			Phpfox::getService('dvs.video')->setDvs($aDvs['dvs_id']);
			$aVideo = Phpfox::getService('dvs.video')->get($aVals['video_ref_id']);

			$sSubject = Phpfox::getPhrase('dvs.share_email_subject');

			// Repllace variables in the subject
			$aFindReplace = array();
			foreach ($aVals as $sKey => $sValue) {
				$aFind[] = '{share_' . $sKey . '}';
				$aReplace[] = '' . $sValue . '';
			}
			foreach ($aDvs as $sKey => $sValue) {
				if(is_array($sValue)) {
					continue;
				}
				$aFind[] = '{dvs_' . $sKey . '}';
				$aReplace[] = '' . $sValue . '';
			}
			foreach ($aVideo as $sKey => $sValue) {
				$aFind[] = '{video_' . $sKey . '}';
				$aReplace[] = '' . $sValue . '';
			}

			$sSubject = str_replace($aFind, $aReplace, $sSubject);

			$iUserId = Phpfox::getUserId();
			$oShareService = Phpfox::getService('dvs.share');
			$sVideoLink = $oShareService->convertNumberToHashCode($aVideo['ko_id'], 5) . $oShareService->convertNumberToHashCode($aDvs['dvs_id'], 3);
			$sVideoLink = Phpfox::getLib('url')->makeUrl('share.') . $sVideoLink . '6';
			Phpfox::getBlock('dvs.share-email-template', array(
				'iDvsId' => $aDvs['dvs_id'],
				'sReferenceId' => $aVideo['referenceId'],
				'sShareName' => $aVals['share_name'],
				'sMyShareName' => $aVals['my_share_name'],
				'sShareMessage' => nl2br(htmlentities($aVals['share_message'], ENT_QUOTES, 'UTF-8')),
				'sShareEmail' => $aVals['share_email'],
				'sMyShareEmail' => $aVals['my_share_email'],
                //'sMySharePhone' => $aDvs['phone'],
				'sMySharePhone' => $aVals['my_share_tel'],
				'sPagebg' => $aDvs['page_background'],
				'sTextColor' => $aDvs['vin_text_color'],
				'sLinkColor' => $aDvs['text_link'],
				'sButtonBackground' => $aDvs['button_background'],
				'sButtonText' => $aDvs['button_text'],
				'sBackgroundImageUrl' => ($aDvs['background_file_name'] ? Phpfox::getLib('url')->makeUrl((Phpfox::getParam('dvs.enable_subdomain_mode') ? 'www.' : '') . 'file.dvs.background') . $aDvs['background_file_name'] : ''),
				'sVideoLink' => $sVideoLink,
				'sImagePath' => (Phpfox::getParam('dvs.enable_subdomain_mode') ? Phpfox::getLib('url')->makeUrl('www.module.dvs.static.image') : Phpfox::getLib('url')->makeUrl('module.dvs.static.image'))
			));
			$sBody = $this->getContent(false);
			Phpfox::getBlock('dvs.share-email-plain-template', array(
				'iDvsId' => $aDvs['dvs_id'],
				'sReferenceId' => $aVideo['referenceId'],
				'sShareName' => $aVals['share_name'],
				'sMyShareName' => $aVals['my_share_name'],
				'sShareMessage' => $aVals['share_message'],
				'sShareEmail' => $aVals['share_email'],
				'sBackgroundImageUrl' => ($aDvs['background_file_name'] ? Phpfox::getLib('url')->makeUrl((Phpfox::getParam('dvs.enable_subdomain_mode') ? 'www.' : '') . 'file.dvs.background') . $aDvs['background_file_name'] : ''),
				'sVideoLink' => $sVideoLink,
				'sImagePath' => (Phpfox::getParam('dvs.enable_subdomain_mode') ? Phpfox::getLib('url')->makeUrl('www.module.dvs.static.image') : Phpfox::getLib('url')->makeUrl('module.dvs.static.image'))
			));
			$sBodyPlain = $this->getContent(false);
			$sDealerEmail = $aDvs['email'];
			Phpfox::getLibClass('phpfox.mail.interface');
			$oMail = Phpfox::getLib('mail.driver.phpmailer.' . Phpfox::getParam('core.method'));
			$oMail->send($aVals['share_email'], $sSubject, $sBodyPlain, $sBody, $aVals['my_share_name'], $aVals['my_share_email']);

			$this->hide('#loading_email_img')
				->show('.share_email_field');

			$this->hide('#share_email_dealer');
			$this->show('#dvs_share_email_success');
			$this->call("setTimeout(function() { tb_remove(); }, 3000);");
		} else {
			$this->hide('#loading_email_img')
				->show('.share_email_field');
			return false;
		}
	}

    public function sendShareEmailIframe()
    {
        Phpfox::getLib('setting')->setParam('brightcove.dir_image', PHPFOX_DIR_FILE . 'pic' . PHPFOX_DS . 'brightcove' . PHPFOX_DS);
        Phpfox::getLib('setting')->setParam('brightcove.url_image', Phpfox::getParam('core.url_pic') . 'brightcove/');

        $aVals = Phpfox::getLib('request')->getArray('val');
        $sErrorText = '';
        $bIsError = false;


        if (!$aVals['share_name'])
        {
            $sErrorText = Phpfox::getPhrase('dvs.please_enter_your_friends_name');
            $this->call('$("#share_email_dealer #share_name").addClass("required");');
            $bIsError = true;
        }
        if (!$aVals['share_email'])
        {
            if(!$sErrorText) {
                $sErrorText = Phpfox::getPhrase('dvs.please_enter_an_email_address');
            }
            $this->call('$("#share_email_dealer #share_email").addClass("required");');
            $bIsError = true;
        }
        if (!$aVals['my_share_name'])
        {
            if(!$sErrorText) {
                $sErrorText = Phpfox::getPhrase('dvs.please_enter_your_name');
            }
            $this->call('$("#share_email_dealer #my_share_name").addClass("required");');
            $bIsError = true;
        }
        if (!$aVals['my_share_email'])
        {
            if(!$sErrorText) {
                $sErrorText = Phpfox::getPhrase('dvs.please_enter_your_email_address');
            }
            $this->call('$("#share_email_dealer #my_share_email").addClass("required");');
            $bIsError = true;
        }

        if (!$bIsError)
        {
            $aDvs = Phpfox::getService('dvs')->get($aVals['dvs_id']);
            Phpfox::getService('dvs.video')->setDvs($aDvs['dvs_id']);
            $aVideo = Phpfox::getService('dvs.video')->get($aVals['video_ref_id']);

            $sSubject = Phpfox::getPhrase('dvs.share_email_subject');

            // Repllace variables in the subject
            $aFindReplace = array();
            foreach ($aVals as $sKey => $sValue)
            {
                $aFind[] = '{share_' . $sKey . '}';
                $aReplace[] = '' . $sValue . '';
            }
            foreach ($aDvs as $sKey => $sValue) {
                if(is_array($sValue)) {
                    continue;
                }
                $aFind[] = '{dvs_' . $sKey . '}';
                $aReplace[] = '' . $sValue . '';
            }
            foreach ($aVideo as $sKey => $sValue)
            {
                $aFind[] = '{video_' . $sKey . '}';
                $aReplace[] = '' . $sValue . '';
            }

            $sSubject = str_replace($aFind, $aReplace, $sSubject);

            $iUserId = Phpfox::getUserId();
            /*if( $aVals['longurl'] ) {
                $sVideoLink = ( Phpfox::getParam('dvs.enable_subdomain_mode' ) ?
                    Phpfox::getLib('url')->makeUrl( $aDvs['title_url'], $aVideo['video_title_url'] ) :
                    Phpfox::getLib('url')->makeUrl( 'dvs', array($aDvs['title_url'], $aVideo['video_title_url']) ) );
            } else {
                $sShortUrl = Phpfox::getService('dvs.shorturl')->generate($aDvs['dvs_id'], $aVideo['referenceId'], 'email', $iUserId);
                $sVideoLink = Phpfox::getLib('url')->makeUrl((Phpfox::getParam('dvs.enable_subdomain_mode') ? 'www.' : '') . $sShortUrl);
            }*/
            //$sVideoLink = $aVals['parent_url'];
            $oShareService = Phpfox::getService('dvs.share');
            $sVideoLink = $oShareService->convertNumberToHashCode($aVideo['ko_id'], 5) . $oShareService->convertNumberToHashCode($aDvs['dvs_id'], 3);
            $sVideoLink = Phpfox::getLib('url')->makeUrl('share.') . $sVideoLink . '6';

            Phpfox::getBlock('dvs.share-email-template', array(
                'iDvsId' => $aDvs['dvs_id'],
                'sReferenceId' => $aVideo['referenceId'],
                'sShareName' => $aVals['share_name'],
                'sMyShareName' => $aVals['my_share_name'],
                'sShareMessage' => nl2br(htmlentities($aVals['share_message'], ENT_QUOTES, 'UTF-8')),
                'sShareEmail' => $aVals['share_email'],
                'sMyShareEmail' => $aVals['my_share_email'],
                //'sMySharePhone' => $aDvs['phone'],
                'sMySharePhone' => $aVals['my_share_tel'],
                'sPagebg' => $aDvs['page_background'],
                'sTextColor' => $aDvs['vin_text_color'],
                'sLinkColor' => $aDvs['text_link'],
                'sButtonBackground' => $aDvs['button_background'],
                'sButtonText' => $aDvs['button_text'],
                'sBackgroundImageUrl' => ($aDvs['background_file_name'] ? Phpfox::getLib('url')->makeUrl((Phpfox::getParam('dvs.enable_subdomain_mode') ? 'www.' : '') . 'file.dvs.background') . $aDvs['background_file_name'] : ''),
                'sVideoLink' => $sVideoLink,
                'sImagePath' => (Phpfox::getParam('dvs.enable_subdomain_mode') ? Phpfox::getLib('url')->makeUrl('www.module.dvs.static.image') : Phpfox::getLib('url')->makeUrl('module.dvs.static.image'))
            ));
            $sBody = $this->getContent(false);

            Phpfox::getBlock('dvs.share-email-plain-template', array(
                'iDvsId' => $aDvs['dvs_id'],
                'sReferenceId' => $aVideo['referenceId'],
                'sShareName' => $aVals['share_name'],
                'sMyShareName' => $aVals['my_share_name'],
                'sShareMessage' => $aVals['share_message'],
                'sShareEmail' => $aVals['share_email'],
                'sBackgroundImageUrl' => ($aDvs['background_file_name'] ? Phpfox::getLib('url')->makeUrl((Phpfox::getParam('dvs.enable_subdomain_mode') ? 'www.' : '') . 'file.dvs.background') . $aDvs['background_file_name'] : ''),
                'sVideoLink' => $sVideoLink,
                'sImagePath' => (Phpfox::getParam('dvs.enable_subdomain_mode') ? Phpfox::getLib('url')->makeUrl('www.module.dvs.static.image') : Phpfox::getLib('url')->makeUrl('module.dvs.static.image'))
            ));
            $sBodyPlain = $this->getContent(false);

            $sDealerEmail = 'noreply@' . str_replace('www.', '', parse_url($aDvs['url'], PHP_URL_HOST));
            Phpfox::getLibClass('phpfox.mail.interface');
            $oMail = Phpfox::getLib('mail.driver.phpmailer.' . Phpfox::getParam('core.method'));
            $oMail->send($aVals['share_email'], $sSubject, $sBodyPlain, $sBody, $aVals['my_share_name'], $aVals['my_share_email']);

//			Phpfox::getLib('mail')
//				->to($aVals['share_email'])
//				->fromEmail($sDealerEmail)
//				->subject($sSubject)
//				->message($sBody)
//				->send();

            $this->hide('#loading_email_img')
                ->show('.share_email_field');

            $this->hide('#share_email_dealer');
            $this->show('#dvs_share_email_success');
            $this->call("setTimeout(function() { tb_remove(); }, 3000);");
        }
        else
        {
            $this->hide('#loading_email_img')
                ->show('.share_email_field');

            $this->html('#share_email_error', $sErrorText)
                ->show('#share_email_error');
            return false;
        }
    }

	public function chooseTheme()
	{
		$iThemeId = Phpfox::getLib('request')->get('theme_id');

		if ($iThemeId)
		{
			$aTheme = Phpfox::getService('dvs.theme')->get($iThemeId);

			$this->call("$('#color_picker_menu_background div').css('background', '#" . $aTheme['theme_menu_background'] . "');");
			$this->call("$('#color_picker_menu_background_input').val('" . $aTheme['theme_menu_background'] . "');");
			$this->call("$('#preview_menu_container').css('background', '#" . $aTheme['theme_menu_background'] . "');");
			$this->call("$('#preview_contact_container').css('background', '#" . $aTheme['theme_menu_background'] . "');");

			$this->call("$('#color_picker_menu_link div').css('background', '#" . $aTheme['theme_menu_link'] . "');");
			$this->call("$('#color_picker_menu_link_input').val('" . $aTheme['theme_menu_link'] . "');");
			$this->call("$('#preview_menu_container').css('color', '#" . $aTheme['theme_menu_link'] . "');");
			$this->call("$('.dvs_top_menu_link').css('color', '#" . $aTheme['theme_menu_link'] . "');");


			$this->call("$('#color_picker_page_background div').css('background', '#" . $aTheme['theme_page_background'] . "');");
			$this->call("$('#color_picker_page_background_input').val('" . $aTheme['theme_page_background'] . "');");
			$this->call("$('#dvs_container').css('background', '#" . $aTheme['theme_page_background'] . "');");

			$this->call("$('#color_picker_page_text div').css('background', '#" . $aTheme['theme_page_text'] . "');");
			$this->call("$('#color_picker_page_text_input').val('" . $aTheme['theme_page_text'] . "');");
			$this->call("$('.preview_dealer_info').css('color', '#" . $aTheme['theme_page_text'] . "');");
			$this->call("$('#preview_vehicle_select_container').css('color', '#" . $aTheme['theme_page_text'] . "');");
			$this->call("$('#preview_now_playing_container').css('color', '#" . $aTheme['theme_page_text'] . "');");

			$this->call("$('#color_picker_button_background div').css('background', '#" . $aTheme['theme_button_background'] . "');");
			$this->call("$('#color_picker_button_background_input').val('" . $aTheme['theme_button_background'] . "');");
			$this->call("$('.preview_select').css('background', '#" . $aTheme['theme_button_background'] . "');");

			$this->call("$('#color_picker_button_text div').css('background', '#" . $aTheme['theme_button_text'] . "');");
			$this->call("$('#color_picker_button_text_input').val('" . $aTheme['theme_button_text'] . "');");
			$this->call("$('.dvs_c2a_button').css('color', '#" . $aTheme['theme_button_text'] . "');");
			$this->call("$('.dvs_c2a_button:hover').css('color', '#" . $aTheme['theme_button_text'] . "');");
			$this->call("$('.preview_select').css('color', '#" . $aTheme['theme_button_text'] . "');");

			$this->call("$('#color_picker_button_top_gradient div').css('background', '#" . $aTheme['theme_button_top_gradient'] . "');");
			$this->call("$('#color_picker_button_top_gradient_input').val('" . $aTheme['theme_button_top_gradient'] . "');");

			$this->call("$('#color_picker_button_bottom_gradient div').css('background', '#" . $aTheme['theme_button_bottom_gradient'] . "');");
			$this->call("$('#color_picker_button_bottom_gradient_input').val('" . $aTheme['theme_button_bottom_gradient'] . "');");

			$this->call("$('#color_picker_button_border div').css('background', '#" . $aTheme['theme_button_border'] . "');");
			$this->call("$('#color_picker_button_border_input').val('" . $aTheme['theme_button_border'] . "');");
			$this->call("$('.preview_select').css('borderColor', '#" . $aTheme['theme_button_border'] . "');");
			$this->call("$('.dvs_c2a_button').css('borderColor', '#" . $aTheme['theme_button_border'] . "');");

			$this->call("$('#color_picker_text_link div').css('background', '#" . $aTheme['theme_text_link'] . "');");
			$this->call("$('#color_picker_text_link_input').val('" . $aTheme['theme_text_link'] . "');");
			$this->call("$('#preview_dealer_website_link').css('color', '#" . $aTheme['theme_text_link'] . "');");

			$this->call("$('#color_picker_footer_link div').css('background', '#" . $aTheme['theme_footer_link'] . "');");
			$this->call("$('#color_picker_footer_link_input').val('" . $aTheme['theme_footer_link'] . "');");
			$this->call("$('.dvs_footer_link').css('color', '#" . $aTheme['theme_footer_link'] . "');");

			//Change preview buttons
			$this->call("$('.dvs_c2a_button').css('background', '-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #" . $aTheme['theme_button_top_gradient'] . "), color-stop(1, #" . $aTheme['theme_button_bottom_gradient'] . ") )');");
			$this->call("$('.dvs_c2a_button').css('background', '-moz-linear-gradient( center top, #" . $aTheme['theme_button_top_gradient'] . " 5%, #" . $aTheme['theme_button_bottom_gradient'] . " 100% )');");
			$this->call("$('.dvs_c2a_button').css('filter', 'progid:DXImageTransform.Microsoft.gradient(startColorstr=\"#" . $aTheme['theme_button_top_gradient'] . "\", endColorstr=\"#" . $aTheme['theme_button_bottom_gradient'] . "\")');");
			$this->call("$('.dvs_c2a_button').css('backgroundColor', '#" . $aTheme['theme_button_top_gradient'] . "');");
			$this->call("$('.dvs_c2a_button:hover').css('background', '-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #" . $aTheme['theme_button_top_gradient'] . "), color-stop(1, #" . $aTheme['theme_button_bottom_gradient'] . ") )');");
			$this->call("$('.dvs_c2a_button:hover').css('background', '-moz-linear-gradient( center top, #" . $aTheme['theme_button_top_gradient'] . " 5%, #" . $aTheme['theme_button_bottom_gradient'] . " 100% )');");
			$this->call("$('.dvs_c2a_button:hover').css('filter', 'progid:DXImageTransform.Microsoft.gradient(startColorstr=\"#" . $aTheme['theme_button_top_gradient'] . "\", endColorstr=\"#" . $aTheme['theme_button_bottom_gradient'] . "\")');");
			$this->call("$('.dvs_c2a_button:hover').css('backgroundColor', '#" . $aTheme['theme_button_bottom_gradient'] . "');");
            
            // Change Player buttons
            
            $this->call("$('#color_picker_player_background div').css('background', '#" . $aTheme['player_background'] . "');");
            $this->call("$('#color_picker_player_background_input').val('" . $aTheme['player_background'] . "');");
            
            $this->call("$('#color_picker_player_text div').css('background', '#" . $aTheme['player_text'] . "');");
            $this->call("$('#color_picker_player_text_input').val('" . $aTheme['player_text'] . "');");
            
            $this->call("$('#color_picker_player_buttons div').css('background', '#" . $aTheme['player_buttons'] . "');");
            $this->call("$('#color_picker_player_buttons_input').val('" . $aTheme['player_buttons'] . "');");
            
            $this->call("$('#color_picker_player_button_icons div').css('background', '#" . $aTheme['player_icons'] . "');");
            $this->call("$('#color_picker_player_button_icons_input').val('" . $aTheme['player_icons'] . "');");
            
            $this->call("$('#color_picker_player_progress_bar div').css('background', '#" . $aTheme['player_progress_bar'] . "');");
            $this->call("$('#color_picker_player_progress_bar_input').val('" . $aTheme['player_progress_bar'] . "');");
            
            $this->call("$('#color_picker_playlist_arrows div').css('background', '#" . $aTheme['player_arrows'] . "');");
            $this->call("$('#color_picker_playlist_arrows_input').val('" . $aTheme['player_arrows'] . "');");
            
            $this->call("$('#color_picker_playlist_border div').css('background', '#" . $aTheme['player_thumbnail_border'] . "');");
            $this->call("$('#color_picker_playlist_border_input').val('" . $aTheme['player_thumbnail_border'] . "');");
		}
	}

	public function getMakes() {
		// Get the variables from the ajax call.
		$sDvsName = $this->get('sDvsName');
		$iYear = $this->get('iYear');

		// Get the DVS details based off the DVS name.
		$aDvs = Phpfox::getService('dvs')->get($sDvsName, true);
		$aPlayer = Phpfox::getService('dvs.player')->get($aDvs['dvs_id']);

		// Get all of the makes for the DVS for the selected year.
		$aMakes = Phpfox::getService('dvs.video')->getValidVSMakesByDealer($iYear, $aPlayer['makes'], $aDvs['dvs_id']);
        

		// Did we get more than one make?
		if (count($aMakes) === 1) {
			// Yes, make the only make selected by default.
			$sSelectOptions = '<li class="init"><span class="init_selected">' . $aMakes[0]['make'] . '</span><ul>';
			$this->call('$.ajaxCall(\'dvs.getModels\', \'iDvsId=' . $aDvs['dvs_id'] . '&iYear=' . $iYear . '&sMake=' . $aMakes[0]['make'] . '\');');
		} else {
			// The first list item should be one to tell the user to select a make.
			$sSelectOptions = '<li class="init"><span class="init_selected">' . Phpfox::getPhrase('dvs.select_make') . '</span><ul>';
			$this->html('#models', '<li class="init">' . Phpfox::getPhrase('dvs.select_model') . '</li><ul><li>' . Phpfox::getPhrase('dvs.please_select_a_make_first') . '</li></ul>');
		}

		// Build the ul list items
		foreach ($aMakes as $aMake) {
			$sSelectOptions .= '<li onclick="$.ajaxCall(\'dvs.getModels\', \'iDvsId=' . $aDvs['dvs_id'] . '&iYear=' . $iYear . '&amp;sMake=' . $aMake['make'] . '\');">' . $aMake['make'] . '</li>';
		}

		$sSelectOptions .= '</ul></li>';

		// Replace the old html with the new list items.
		$this->html('#makes', $sSelectOptions);
	}

	public function getModels() {
		// Set the variables to determine which models to get.
        $iDvsId = $this->get('iDvsId');
		$sMake = $this->get('sMake');
		$iYear = $this->get('iYear');
		// Get a list of models that belong to the make and year.
		$aModels = Phpfox::getService('dvs.video')->getModelsByYearMakeDvs($iDvsId, $iYear, $sMake, '', true);

		// Are there models to add to the drop down menu?
		if (!empty($aModels)) {
			// Yes, begin to create the drop down menu.
			$sSelectOptions = '<li class="init"><span class="init_selected">' . Phpfox::getPhrase('dvs.select_model') . '</span><ul>';
		} else {
			// No, let the user know there were no models found.
			$sSelectOptions = '<li class="init"><span class="init_selected">No Models Found</span><ul>';
		}

		// Add each model to the drop down.
		foreach ($aModels as $aModel) {
			$sSelectOptions .= '<li onclick="$.ajaxCall(\'dvs.videoSelect\', \'sReferenceId=' . $aModel['referenceId'] . '&amp;sModel=' . $aModel['model'] . '&amp;iYear=' . $aModel['year'] . '&amp;sMake=' . $aModel['make'] . '&amp;iDvsId=' . $iDvsId . '&amp;sPlaylistBorder=\' + $(\'#dvs_playlist_border_color\').val());showspinner();">' . $aModel['year'] . ' ' . $aModel['model'] . (Phpfox::getParam('dvs.javascript_debug_mode') ? ' (' . $aModel['video_type'] . ')' : '') . '</li>';
		}

		$sSelectOptions .= '</ul></li>';

		// Display the dropdown on the page.
		$this->html('#models', $sSelectOptions);
	}

	public function getFeaturedModels()
	{
		$sMakes = Phpfox::getLib('request')->get('aMakes');
        $iDvsId = $this->get('iDvs');
		$aMakes = explode(',', $sMakes);
        $aPlayerModels = Phpfox::getService('dvs.video')->getFeatureModels($iDvsId, $aMakes);

		$sSelect = '<select id="dvs_video_select_model"><option value="">' . Phpfox::getPhrase('dvs.select_model') . '</option>';
		foreach ($aPlayerModels as $aModel)
		{
			$sSelect .= '<option value="' . $aModel['year'] . ',' . $aModel['make'] . ',' . $aModel['model'] . '">' . $aModel['year'] . ' ' . $aModel['make'] . ' ' . $aModel['model'] . '</option>';
		}
		$sSelect .= '</select>';

		$this->html('#featured_model', $sSelect);
	}

	/**
	 * Select a video based on the year, make, and model selected in the video select drop down box
	 * Build a new playlist and set video_select_playlist, call enableVideoSelectCarousel
	 */
	public function videoSelect()
	{

        
        $iDvsId = $this->get('iDvsId');
        $sReferenceId = $this->get('sReferenceId');
		Phpfox::getService('dvs.video')->setDvs($iDvsId);
        $aPlayer = Phpfox::getService('dvs.player')->get($iDvsId);
        //var_dump($aPlayer);
        $aVideo = Phpfox::getService('dvs.video')->get($sReferenceId);
        $aVideos = Phpfox::getService('dvs.video')->getRelatedVideo($aVideo, $iDvsId);

		//Build media id js array
		$this->call('aVideoSelectMediaIds = [];');
		foreach ($aVideos as $iKey => $aVideo) {
			$this->call('aVideoSelectMediaIds[' . $iKey . '] = "' . $aVideo['id'] . '";');
		}

		$sBrowser = Phpfox::getService('dvs')->getBrowser();

		//Build playlist html and set
		Phpfox::getLib('setting')->setParam(array('dvs.video_url_image' => Phpfox::getParam('core.url_file') . 'brightcove/'));
		$sPlaylistHtml = '<ul>';
        
        //if ($aPlayer['player_type'] != "2"){
//            $playlistLink = '<a href="#" onclick="thumbnailClick (' . $iKey . ');thumbnailClickDvs();return false;">' ;
//        }

		foreach ($aVideos as $iKey => $aVideo)
		{
			$sThumbnailImageHtml = Phpfox::getLib('image.helper')->display(array(
				'path' => 'dvs.video_url_image',
				'file' => $aVideo['thumbnail_image'],
				'max_width' => 145,
				'max_height' => 82));
            //$sPlaylistHtml .= '<li>' .
//                '<a href="#" onclick="thumbnailClick (' . $iKey . ');thumbnailClickDvs();return false;">' .

        if ($aPlayer['player_type'] != "2"){
            $playlistLink = '<a href="#" onclick="thumbnailClick (' . $iKey . ');thumbnailClickDvs();return false;">' ;
        }else{
            $playlistLink = '<a class="playlist_carousel_image_link" id="thumbnail_link_'.$iKey.'">' ;
        }

            $sPlaylistHtml .= '<li>' . $playlistLink .
                
                $sThumbnailImageHtml . '<p>' . $aVideo['year'] . ' ' . $aVideo['model'] . '</p></a>' .
                '</li>';
		}

		$sPlaylistHtml .= '</ul>';

		$this->html('#overview_playlist', $sPlaylistHtml);
		//Enable playlist for jCarousel

		if ($sBrowser != 'mobile')
		{
			$this->call('enableVideoSelectCarousel();');
		}

		//Switch to Video Select
		$this->call('watchVideoSelect(aVideoSelectMediaIds);');
        
	}

	public function copyCRM()
	{
		$sShortUrl = $this->get('shorturl');
		Phpfox::getService('dvs.shorturl.process')->unhideShortUrl($sShortUrl);
	}

	public function removeTeamMember()
	{
		$iSalesTeamId = $this->get('salesteam_id');

		Phpfox::getService('dvs.salesteam.process')->remove($iSalesTeamId);

		$this->hide('#sales_team_member_' . $iSalesTeamId);
	}

    public function removeManagerTeamMember()
    {
        $iManagerTeamId = $this->get('managersteam_id');

        Phpfox::getService('dvs.manager.process')->remove($iManagerTeamId);

        $this->hide('#managers_team_member_' . $iManagerTeamId);
        $this->alert('User removed');
    }

	public function showGetPriceForm()
	{
		Phpfox::getBlock('dvs.get-price', array('iDvsId' => $this->get('iDvsId'), 'sRefId' => $this->get('sRefId')));
	}

	public function emailForm()
	{
		Phpfox::getBlock('dvs.share-email', array('iDvsId' => $this->get('iDvsId'), 'sRefId' => $this->get('sRefId'), 'bSaveGa' => $this->get('bSaveGa', 1)), false);
	}

	public function textForm()
	{
		Phpfox::getBlock('dvs.share-text', array('iDvsId' => $this->get('iDvsId'), 'sRefId' => $this->get('sRefId'), 'bSaveGa' => $this->get('bSaveGa', 1)), false);
	}

    public function emailFormIframe() {
        Phpfox::getBlock('dvs.share-email-iframe', array('sParentUrl' => $this->get('sParentUrl'), 'iDvsId' => $this->get('iDvsId'), 'sRefId' => $this->get('sRefId'), 'bLongUrl' => $this->get('longurl', false) ), false);
    }

	public function emailFormMobile()
	{
		Phpfox::getBlock('dvs.share-email-mobile', array('iDvsId' => $this->get('iDvsId'), 'sRefId' => $this->get('sRefId')));
	}

    public function showGetPriceFormMobile()
    {
        Phpfox::getBlock('dvs.get-price-mobile', array('iDvsId' => $this->get('iDvsId'), 'sRefId' => $this->get('sRefId')));
    }

    public function updateShareUrl() {
        $sRefId = $this->get('ref-id');

        Phpfox::getService('dvs.video')->setDvs(Phpfox::getLib('request')->get('iDvsId'));
        $aVideo = Phpfox::getService('dvs.video')->get($sRefId);
        $aDvs = Phpfox::getService('dvs')->get(Phpfox::getLib('request')->get('iDvsId'));

        $aFindReplace = array();
        foreach ($aDvs as $sKey => $sValue) {
            if ($sKey == 'phrase_overrides' || is_array($sValue)) {
                continue;
            }

            $aFind[] = '{dvs_' . $sKey . '}';
            $aReplace[] = '' . $sValue . '';
        }

        foreach ($aVideo as $sKey => $sValue) {
            $aFind[] = '{video_' . $sKey . '}';
            $aReplace[] = '' . $sValue . '';
        }

        $sTwitterText = Phpfox::getPhrase('dvs.twitter_default_share_text');
        $sTwitterText = str_replace($aFind, $aReplace, $sTwitterText);

        $this->val('#video_ref_id', $aVideo['referenceId']);

        $sShareCode = Phpfox::getLib('url')->makeUrl('share') . Phpfox::getService('dvs.share')->convertNumberToHashCode($aVideo['ko_id'], 5) . Phpfox::getService('dvs.share')->convertNumberToHashCode($aDvs['dvs_id'], 3);
        $this->remove('.twitter_popup');
        $this->call('$(\'#twitter_button_wrapper\').html(\'<a href="https://twitter.com/share?url=\' + encodeURIComponent(\'' . $sShareCode . '1\') + \'&text=\' + encodeURIComponent(\'' . $sTwitterText . '\') + \'" class="twitter-share-button twitter_popup" data-size="large" data-count="none" id="dvs_twitter_share_link"></a>\');');
        $this->call('twttr.widgets.load();');

        $this->val('#video_url', $aVideo['video_title_url']);
        $this->val('#video_hash_code', Phpfox::getService('dvs.share')->convertNumberToHashCode($aVideo['ko_id'], 5));
        $this->val('#share_title', $sTwitterText);
        $this->val('#video_thumbnail', Phpfox::getLib('image.helper')->display(array(
            'server_id' => $aVideo['server_id'],
            'path' => 'core.url_file',
            'file' => 'brightcove/' . $aVideo['thumbnail_image'],
            'return_url' => true
        )));
        $this->call('$("#video_name a").attr("href", $(\'#parent_url\').val().replace(\'WTVDVS_VIDEO_TEMP\', \'' . $aVideo['video_title_url'] . '\'));');
    }

    public function contactDealerIframe() {
        $aVals = Phpfox::getLib('request')->getArray('val');
        $sErrorText = '';
        $bIsError = false;

        if (Phpfox::getParam('dvs.get_price_validate_name') && (!$aVals['contact_name'] || ($aVals['contact_name'] == Phpfox::getPhrase('dvs.get_price_placeholder_name')))) {
            $sErrorText = Phpfox::getPhrase('dvs.please_enter_your_name');
            $this->call('$("#contact_dealer #name").addClass("required");');
            $bIsError = true;
        }

        if (Phpfox::getParam('dvs.get_price_validate_email') && (!$aVals['contact_email'] || ($aVals['contact_email'] == Phpfox::getPhrase('dvs.get_price_placeholder_email')))) {
            if(!$sErrorText) {
                $sErrorText = Phpfox::getPhrase('dvs.please_enter_your_email_address');
            }
            $this->call('$("#contact_dealer #email").addClass("required");');
            $bIsError = true;
        }

        if (Phpfox::getParam('dvs.get_price_validate_phone') && (!$aVals['contact_phone'] || ($aVals['contact_phone'] == Phpfox::getPhrase('dvs.get_price_placeholder_phone')))) {
            if(!$sErrorText) {
                $sErrorText = Phpfox::getPhrase('dvs.please_enter_your_phone_number');
            }
            $this->call('$("#contact_dealer #phone").addClass("required");');
            $bIsError = true;
        }

        if (Phpfox::getParam('dvs.get_price_validate_zip_code') && (!$aVals['contact_zip'] || ($aVals['contact_zip'] == Phpfox::getPhrase('dvs.get_price_placeholder_zip')))) {
            if(!$sErrorText) {
                $sErrorText = Phpfox::getPhrase('dvs.please_enter_your_zip_code');
            }
            $this->call('$("#contact_dealer #zip").addClass("required");');
            $bIsError = true;
        }

        if (Phpfox::getParam('dvs.get_price_validate_comments') && (!$aVals['contact_comments'] || ($aVals['contact_comments'] == Phpfox::getPhrase('dvs.get_price_placeholder_comments')))) {
            if(!$sErrorText) {
                $sErrorText = Phpfox::getPhrase('dvs.please_enter_comments');
            }
            $this->call('$("#contact_dealer #comments").addClass("required");');
            $bIsError = true;
        }

        if (!$bIsError) {
            $this->call("$('#contact_dealer').hide();");
            $this->call("$('#dvs_contact_success').show();");
            $this->call("setTimeout(function() { $('#dvs_contact_success').hide(); $('#contact_dealer').show(); $('.inputContact').val(''); }, 2000);");

            $aVideo = Phpfox::getService('dvs.video')->get($aVals['contact_video_ref_id']);
            $aDvs = Phpfox::getService('dvs')->get($aVals['contact_dvs_id']);

            $sSubject = Phpfox::getPhrase('dvs.dealer_email_subject', array(
                'contact_name' => $aVals['contact_name'],
                'contact_email' => $aVals['contact_email'],
                'contact_phone' => $aVals['contact_phone'],
                'contact_zip' => $aVals['contact_zip'],
                'contact_comments' => $aVals['contact_comments'],
                'year' => $aVideo['year'],
                'make' => $aVideo['make'],
                'model' => $aVideo['model'],
                'bodyStyle' => $aVideo['bodyStyle'],
                'dvs_name' => $aDvs['dvs_name'],
                'dealer_name' => $aDvs['dealer_name'],
                'title_url' => $aDvs['title_url'],
                'address' => $aDvs['address'],
                'city' => $aDvs['city'],
                'state_string' => $aDvs['state_string'],
                'phone' => $aDvs['phone']
            ));
            if($aDvs['email_format']){
                $sBody = Phpfox::getPhrase('dvs.dealer_email_xml_body', array(
                    'dvs_name' => $aDvs['dvs_name'],
                    'time' => date('Y-m-dTH:i:s', PHPFOX_TIME),
                    'year' => $aVideo['year'],
                    'make' => $aVideo['make'],
                    'model' => $aVideo['model'],
                    'contact_name' => $aVals['contact_name'],
                    'contact_email' => $aVals['contact_email'],
                    'contact_phone' => $aVals['contact_phone'],
                    'contact_comments' => $aVals['contact_comments']
                ));
            }else{
                $sBody = Phpfox::getPhrase('dvs.dealer_email_body', array(
                    'contact_name' => $aVals['contact_name'],
                    'contact_email' => $aVals['contact_email'],
                    'contact_phone' => $aVals['contact_phone'],
                    'contact_zip' => $aVals['contact_zip'],
                    'contact_comments' => $aVals['contact_comments'],
                    'year' => $aVideo['year'],
                    'make' => $aVideo['make'],
                    'model' => $aVideo['model'],
                    'bodyStyle' => $aVideo['bodyStyle'],
                    'dvs_name' => $aDvs['dvs_name'],
                    'dealer_name' => $aDvs['dealer_name'],
                    'title_url' => $aDvs['title_url'],
                    'address' => $aDvs['address'],
                    'city' => $aDvs['city'],
                    'state_string' => $aDvs['state_string'],
                    'phone' => $aDvs['phone']
                ));
            }
            
             $sEmailSig = preg_replace('/\{phrase var=\'(.*)\'\}/ise', "'' . Phpfox::getPhrase('\\1', {$this->_sArray}, false, null, '". Phpfox::getParam('core.default_lang_id')."') . ''", Phpfox::getParam('core.mail_signature'));
            
            //Phpfox::getLib('mail')
//                ->to($aDvs['email'])
//                ->subject($sSubject)
//                ->message($sBody)
//                ->send();
             $sTextHtml = Phpfox::getLib('template')->assign(array(
                        'bHtml' => true,
                        'sMessage' => str_replace("\n", "<br />", $sBody),
                        'sEmailSig' => str_replace("\n", "<br />", $sEmailSig),
                        'bMessageHeader' => $this->_bMessageHeader
                    )
                    )->getLayout('email', true);
             Phpfox::getLibClass('phpfox.mail.interface');
             
            $toMail = explode(',',$aDvs['email']);
                    
            $oMail = Phpfox::getLib('mail.driver.phpmailer.' . Phpfox::getParam('core.method'));
            
            foreach($toMail as $receipent){
            $receipent = trim($receipent);    
            $oMail->send($receipent, $sSubject, $sBody, $sTextHtml);

            Phpfox::getService('dvs.process')->updateContactCount($aDvs['dvs_id']);

            $this->call('getPriceEmailSent();');    
            }
           
            $this->hide('#loading_email_img')
                ->show('.share_email_field');

        }
        else
        {
            $this->html('#contact_dealer_error', $sErrorText)
                ->show('#contact_dealer_error');

            $this->hide('#loading_email_img')
                ->show('.share_email_field');

            return false;
        }
    }

    public function getShareMakes()
    {
        // Get the variables from the ajax call.
        $sDvsName = $this->get('sDvsName');
        $iYear = $this->get('iYear');

        // Get the DVS details based off the DVS name.
        $aDvs = Phpfox::getService('dvs')->get($sDvsName, true);
        $aPlayer = Phpfox::getService('dvs.player')->get($aDvs['dvs_id']);

        // Get all of the makes for the DVS for the selected year.
        $aMakes = Phpfox::getService('dvs.video')->getValidVSMakesByDealer($iYear, $aPlayer['makes'], $aDvs['dvs_id']);

        // Did we get more than one make?
        //if (count($aMakes) === 1) {
            // Yes, make the only make selected by default.
            $sSelectOptions = '<li class="init"><span class="init_selected">' . $aMakes[0]['make'] . '</span><ul>';

        // Build the ul list items
        foreach ($aMakes as $aMake) {
            $sSelectOptions .= '<li onclick="$.ajaxCall(\'dvs.getShareModels\', \'sDvsName=' . $aDvs['title_url'] . '&iYear=' . $iYear . '&amp;sMake=' . $aMake['make'] . '\');">' . $aMake['make'] . '</li>';
        }

        $sSelectOptions .= '</ul></li>';

        // Replace the old html with the new list items.
        $this->html('#makes', $sSelectOptions);

        $sMake = '';
        if(count($aMakes)) {
            $sMake = $aMakes[0]['make'];
        }

        $aShareVideos = Phpfox::getService('dvs.video')->getShareVideos($aDvs['dvs_id'], $iYear, $sMake, '');
        Phpfox::getBlock('dvs.share-video', array('aShareVideos' => $aShareVideos, 'aDvs' => $aDvs));

        $this->html('#video_items', $this->getContent(false));
    }

    public function getShareModels()
    {
        // Set the variables to determine which models to get.
        $sMake = $this->get('sMake');
        $iYear = $this->get('iYear');
        $sDvsName = $this->get('sDvsName');

        // Get the DVS details based off the DVS name.
        $aDvs = Phpfox::getService('dvs')->get($sDvsName, true);

        $aShareVideos = Phpfox::getService('dvs.video')->getShareVideos($aDvs['dvs_id'], $iYear, $sMake, '');
        Phpfox::getBlock('dvs.share-video', array('aShareVideos' => $aShareVideos, 'aDvs' => $aDvs));

        $this->html('#video_items', $this->getContent(false));
    }

    public function getShareItem() {
        $sMake = $this->get('sMake');
        $iYear = $this->get('iYear');
        $iDvsId = $this->get('iDvsId');
        $sModel = $this->get('sModel');

        $aDvs = Phpfox::getService('dvs')->get($iDvsId);

        $aShareVideos = Phpfox::getService('dvs.video')->getShareVideos($aDvs['dvs_id'], $iYear, $sMake, $sModel);
        Phpfox::getBlock('dvs.share-video', array('aShareVideos' => $aShareVideos, 'aDvs' => $aDvs));

        $this->html('#video_items', $this->getContent(false));
    }

    public function updateActivity() {
        if (Phpfox::getService('dvs.process')->updateActivity($this->get('id'), $this->get('active'))) {

        }
    }

    public function deleteDomain()
	{
		$iId = $this->get('id');

		Phpfox::getService('dvs.blacklists')->remove($iId);
	}

    public function analyticExportPdf() {
        $sTab = $this->get('tab');
        $iDay = $this->get('day');

        if ($iDvsId = $this->get('dvsId')) {
            if (!Phpfox::getService('dvs')->hasAccess($iDvsId, Phpfox::getUserId())) {
                return false;
            }
            $aDvs = Phpfox::getService('dvs')->get($iDvsId);
        } else {
            return false;
        }

//        $aDvs['title_url'] = 'commonwealthhonda';
//        $aDvs['dealer_name'] = 'Commonwealth Honda';

        $sCacheImagePrefix = md5($iDvsId.$sTab.$iDay);

        if ($sTab == 'overall') {
            $this->saveImageData($this->get('circleGraphImg'), $sCacheImagePrefix.'1.png');
            $this->saveImageData($this->get('sessionMainChartImg'), $sCacheImagePrefix.'2.png');
            $this->saveImageData($this->get('sessionMiniChartImage'), $sCacheImagePrefix.'3.png');
            $this->saveImageData($this->get('userMiniChartImage'), $sCacheImagePrefix.'4.png');
            $this->saveImageData($this->get('pageViewMiniChartImage'), $sCacheImagePrefix.'5.png');
            $this->saveImageData($this->get('pagePerSessionMiniChartImage'), $sCacheImagePrefix.'6.png');
            $this->saveImageData($this->get('avgTimePageMiniChartImage'), $sCacheImagePrefix.'7.png');
            $this->saveImageData($this->get('bounceRateMiniChartImage'), $sCacheImagePrefix.'8.png');
            $this->saveImageData($this->get('visitorPercentChartImage'), $sCacheImagePrefix.'9.png');
            $sNewPdfFile = Phpfox::getService('dvs.analytics.export')->exportOverall(Phpfox::getParam('core.dir_cache').$sCacheImagePrefix, $iDay, $aDvs,'overallstats');
        } elseif ($sTab == 'video') {
            $this->saveImageData($this->get('circleGraphImg'), $sCacheImagePrefix.'1.png');
            $sNewPdfFile = Phpfox::getService('dvs.analytics.export')->exportVideo(Phpfox::getParam('core.dir_cache').$sCacheImagePrefix, $iDay, $aDvs,'videostats');
        } elseif ($sTab == 'sharing') {
            $this->saveImageData($this->get('circleGraphImg'), $sCacheImagePrefix.'1.png');
            if ($this->get('shareViewPieImage') != '') {
                $this->saveImageData($this->get('shareViewPieImage'), $sCacheImagePrefix.'2.png');
            }
            $sNewPdfFile = Phpfox::getService('dvs.analytics.export')->exportSharing(Phpfox::getParam('core.dir_cache').$sCacheImagePrefix, $iDay, $aDvs,'sharingstats');
        }

        $sNewPdfFile = Phpfox::getLib('url')->makeUrl('dvs.analytics.export', array('id'=>trim($aDvs['title_url']), 'file'=>'pdf','tab' => $sTab.'stats'));
        $this->call("$('#download_iframe').attr('src', '" . $sNewPdfFile . "')");
    }

    function saveImageData($EncodedPNG, $sFile) {
        $EncodedPNG = str_replace(' ','+',$EncodedPNG);
        $EncodedPNG =  str_replace('data:image/png;base64,', '', $EncodedPNG);
        $decoded=base64_decode($EncodedPNG);
        file_put_contents(Phpfox::getParam('core.dir_cache') . $sFile, $decoded);
    }

    public function analyticsExportCSV() {
        $sTab = $this->get('tab');
        $iDay = $this->get('day');

        if ($iDvsId = $this->get('dvsId')) {
            if (!Phpfox::getService('dvs')->hasAccess($iDvsId, Phpfox::getUserId())) {
                return false;
            }
            $aDvs = Phpfox::getService('dvs')->get($iDvsId);
        } else {
            return false;
        }

//        $aDvs['title_url'] = 'commonwealthhonda';
//        $aDvs['dealer_name'] = 'Commonwealth Honda';

        switch ($sTab) {
            case 'video':
                Phpfox::getService('dvs.analytics.export')->exportVideoCSV($iDay, $aDvs,'videostats');
                break;
            case 'sharing':
                Phpfox::getService('dvs.analytics.export')->exportSharingCSV($iDay, $aDvs,'sharingstats');
                break;
            default:
                Phpfox::getService('dvs.analytics.export')->exportOverallCSV($iDay, $aDvs,'overallstats');
                break;
        }

        $sNewPdfFile = Phpfox::getLib('url')->makeUrl('dvs.analytics.export', array('id'=>trim($aDvs['title_url']), 'file'=>'csv', 'tab'=>$sTab.'stats'));
        $this->call("$('#download_iframe').attr('src', '" . $sNewPdfFile . "')");
    }
}
?>
