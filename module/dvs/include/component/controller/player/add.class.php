<?php
/**
 * [PHPFOX_HEADER]
 */
defined('PHPFOX') or exit('No direct script access allowed.');

/**
 *
 *
 * @copyright		Konsort.org 
 * @author  		Konsort.org
 * @package 		DVS
 */
class Dvs_Component_Controller_Player_Add extends Phpfox_Component
{
	public function process()
	{
		Phpfox::isUser(true);

		if (Phpfox::getParam('dvs.enable_subdomain_mode'))
		{
			$sSwfUrl = Phpfox::getLib('url')->makeUrl('www.module.dvs.static.swf');
		}
		else
		{
			$sSwfUrl = Phpfox::getLib('url')->makeUrl('module.dvs.static.swf');
		}

		$sBrowser = Phpfox::getService('dvs')->getBrowser();

//		$aYears = Phpfox::getParam('dvs.new_years');
//        $aAllowedYears = $aYears;
        $aAllowedYears = Phpfox::getParam('dvs.vf_video_select_allowed_years');



        if($iDvsId = $this->request()->get('id')) {
            $aDvs = Phpfox::getService('dvs')->get($iDvsId);
            if($aDvs) {
                if(!$aDvs['new_car_videos']) {
                    $aYears2 = Phpfox::getParam('dvs.new_years');
                    foreach($aAllowedYears as $iKey => $sYear) {
                        if(in_array($sYear, $aYears2)) {
                            unset($aAllowedYears[$iKey]);
                        }
                    }
                }

                if(!$aDvs['used_car_videos']) {
                    $aYears2 = Phpfox::getParam('dvs.new_years');
                    foreach($aAllowedYears as $iKey => $sYear) {
                        if(!in_array($sYear, $aYears2)) {
                            unset($aAllowedYears[$iKey]);
                        }
                    }
                }
            }
        }

        $aYears = $aAllowedYears;

		$aMakes = Phpfox::getService('dvs.video')->getMakes();
		foreach($aMakes as $ik=>$amk)
		{
			$aMakes[$ik]['remake'] = str_replace(" ","-",$amk['make']); 
		}
        
		//If there is an array 'val', attempt to validate and save player, otheriwse, display add/edit page.
		if ($aVals = $this->request()->getArray('val'))
		{
			
			if (!isset($aVals['dvs_id']) || !Phpfox::getService('dvs')->hasAccess($aVals['dvs_id'], Phpfox::getUserId()))
			{
				$this->url()->send('');
				return false;
			}

			$aValidation = array(
//				'player_name' => Phpfox::getPhrase('dvs.please_enter_a_player_name')
			);

			if ($aVals['preroll_file_id'])
			{
				$aValidation['preroll_duration'] = Phpfox::getPhrase('dvs.please_enter_a_duration_for_the_pre_roll_file');
			}

			$oValid = Phpfox::getLib('validator')->set(array(
				'sFormName' => 'add_player',
				'aParams' => $aValidation
				)
			);

			$aFeaturedModel = explode(',', $aVals['featured_model']);

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
				$iPlayerId = Phpfox::getService('dvs.player')->get($aVals['dvs_id']);

				//DVS Players will always be interactive
				$aVals['player_type'] = 0;
                
                //$player_type = (int) $aVals['player_type'];
                //die($aVals['player_type']);
				if (!$iPlayerId)
				{
					
					$iPlayerId = Phpfox::getService('dvs.player.process')->add($aVals);

					if ($aVals['forward'])
					{
						$this->url()->send('dvs.code', array('id' => $iDvsId, 'action' => 'add'), null);
					}
					else
					{
						Phpfox::getLib('module')->setController('dvs.index');

						$this->template()
							->assign(array(
								'sMessage' => Phpfox::getPhrase('dvs.player_added_successfully')
						));
					}
				}
				else
				{
					Phpfox::getService('dvs.player.process')->update($aVals);

					if ($aVals['forward'])
					{
						$this->url()->send('dvs.player.code', array('id' => $aVals['player_id'], 'action' => 'save'), null);
					}
					else
					{
						$this->url()->send('dvs.index', null, Phpfox::getPhrase('dvs.player_saved_successfully'));
					}
				}
			}
			//Validation failed, reload all JS and pass aVals back to contrller as aForms. We need to load the player JS for preview.
			else
			{
//				$aVals['logo_file_name'] = Phpfox::getService('dvs.file')->getLogoFile((int) $aVals['logo_file_id']);
				$aVals['preroll_file_name'] = Phpfox::getService('dvs.file')->getPrerollFile((int) $aVals['preroll_file_id']);

				if (!isset($aVals['autoplay']))
				{
					$aVals['autoplay'] = 0;
				}

				if (!isset($aVals['autoadvance']))
				{
					$aVals['autoadvance'] = 0;
				}

				$aPlayerModels = array();

				foreach ($aMakes as $iKey => $aMake)
				{
					foreach ($aVals['selected_makes'] as $aPlayerMake => $bSelected)
					{
						if ($aMake['make'] == $aPlayerMake && $bSelected)
						{
							$aMakes[$iKey]['selected'] = 1;
						}
					}
				}

				foreach ($aYears as $iYear)
				{
					foreach ($aMakes as $aMake)
					{
						if (isset($aMake['selected']))
						{
							$aModels = Phpfox::getService('dvs.video')->getModels($iYear, $aMake['make']);
							$aPlayerModels = array_merge($aPlayerModels, $aModels);
						}
					}
				}

				$this->template()
					->assign(array(
						'iDvsId' => $aVals['dvs_id'],
						'aForms' => $aVals,
						'bIsEdit' => true,
						'bCanAddPlayers' => true,
						'aMakes' => $aMakes,
						'sDvsUrl' => Phpfox::getParam('core.url_file') . 'dvs/',
						'sSwfUrl' => $sSwfUrl,
						'aModels' => $aPlayerModels
					))
					->setHeader(array(
						'colorpicker.js' => 'module_dvs',
						'eye.js' => 'module_dvs',
						'utils.js' => 'module_dvs',
						'layout.js' => 'module_dvs',
						'colorpicker.css' => 'module_dvs',
						'<script type="text/javascript">var bDebug = ' . (Phpfox::getParam('dvs.javascript_debug_mode') ? 'true' : 'false') . '</script>',
						'<script type="text/javascript">var sBrowser = "' . $sBrowser . '"</script>',
						'<script type="text/javascript">var bIsDvs = true</script>',
						'<script type="text/javascript">var sFirstVideoTitleUrl = "";</script>',
						'<script type="text/javascript">var bGoogleAnalytics = true;</script>',
						'player.js' => 'module_dvs',
						'overlay.js' => 'module_dvs',
						'jcarousellite.js' => 'module_dvs',
						'<script type="text/javascript" src="http://admin.brightcove.com/js/BrightcoveExperiences' . ($sBrowser == 'mobile' || $sBrowser == 'ipad' ? '' : '_all') . '.js"></script>',
						'add.js' => 'module_dvs'
					))
					->setBreadcrumb(Phpfox::getPhrase('dvs.my_players'), Phpfox::getLib('url')->makeUrl('dvs'))
					->setBreadcrumb(Phpfox::getPhrase('dvs.edit_player'));
				;
			}
		} 
        else { //add & edit feature models
			$iDvsId = $this->request()->getInt('id');

			if (Phpfox::getService('dvs')->hasAccess($iDvsId, Phpfox::getUserId()))
			{
				$bCanAddPlayers = true;
			}
			else
			{
				$this->url()->send('');
				return false;
			}

			//If there is a player, we're editing
			if (($aPlayer = Phpfox::getService('dvs.player')->get($iDvsId)))
			{
                $aDvs = Phpfox::getService('dvs')->get($iDvsId);
                $aPlayer['player_st_type'] = $aDvs['player_type'];
				$aPlayerModels = array();
                $aSelectedMakes = array();
				foreach ($aMakes as $iKey => $aMake)
				{
					foreach ($aPlayer['makes'] as $aPlayerMake)
					{
						if ($aMake['make'] == $aPlayerMake['make'])
						{
							$aMakes[$iKey]['selected'] = 1;
                            array_push($aSelectedMakes, $aPlayerMake['make']);
						}
					}
				}
                /*
				foreach ($aYears as $iYear)
				{
					foreach ($aMakes as $aMake)
					{
						if (isset($aMake['selected']))
						{
							$aModels = Phpfox::getService('dvs.video')->getModels($iYear, $aMake['make']);
							$aPlayerModels = array_merge($aPlayerModels, $aModels);
						}
					}
				}*/

                $aPlayerModels = Phpfox::getService('dvs.video')->getFeatureModels($iDvsId, $aSelectedMakes);
                //var_dump($aPlayer);
				$this->template()
					->assign(array(
						'aForms' => $aPlayer,
						'bIsEdit' => true,
						'bCanAddPlayers' => $bCanAddPlayers,
						'aModels' => $aPlayerModels
					))
					->setBreadcrumb(Phpfox::getPhrase('dvs.my_dealer_video_showrooms'), Phpfox::getLib('url')->makeUrl('dvs'))
					->setBreadcrumb(Phpfox::getPhrase('dvs.edit_player'));
			}
			else
			//New player being created
			{
//				$aPlayers = Phpfox::getService('dvs.player')->listPlayers(0, 0, $iDvsId, false);
//
//				if (count($aPlayers) < Phpfox::getUserParam('dvs.players'))
//				{
//					$bCanAddPlayers = true;
//				}
//				else
//				{
//					$bCanAddPlayers = false;
//				}

				$this->template()
					->assign(array(
						'bIsEdit' => false,
						'bCanAddPlayers' => true
					))
					->setBreadcrumb(Phpfox::getPhrase('dvs.my_players'), Phpfox::getLib('url')->makeUrl('dvs'))
					->setBreadcrumb(Phpfox::getPhrase('dvs.add_player'));
			}

			//Need to load all player JS for preview
			$this->template()
				->setHeader(array(
					'colorpicker.js' => 'module_dvs',
					'eye.js' => 'module_dvs',
					'utils.js' => 'module_dvs',
					'layout.js' => 'module_dvs',
					'colorpicker.css' => 'module_dvs',
					'<script type="text/javascript">var bDebug = ' . (Phpfox::getParam('dvs.javascript_debug_mode') ? 'true' : 'false') . '</script>',
					'<script type="text/javascript">var sBrowser = "' . $sBrowser . '"</script>',
					'<script type="text/javascript">var bIsDvs = true</script>',
					'<script type="text/javascript">var sFirstVideoTitleUrl = "";</script>',
					'<script type="text/javascript">var bGoogleAnalytics = true;</script>',
					'player.js' => 'module_dvs',
					'overlay.js' => 'module_dvs',
					'jcarousellite.js' => 'module_dvs',
					'<script type="text/javascript" src="http://admin.brightcove.com/js/BrightcoveExperiences' . ($sBrowser == 'mobile' || $sBrowser == 'ipad' ? '' : '_all') . '.js"></script>',
					'add.js' => 'module_dvs'
				))
				->assign(array(
					'iDvsId' => $iDvsId,
					'aMakes' => $aMakes,
					'iUserId' => Phpfox::getUserId(),
					'sDefaultColor' => Phpfox:: getParam('dvs.default_color_picker_color'),
					'sDvsUrl' => Phpfox::getParam('core.url_file') . 'dvs/',
					'sSwfUrl' => $sSwfUrl
			));
		}

		$this->template()
			->setHeader(array(
				'jquery.multiselect.min.js' => 'module_dvs',
				'jquery.multiselect.css' => 'module_dvs',
				'validate.js' => 'module_dvs',
				'jquery.animate-shadow-min.js' => 'module_dvs',
//				'add.css' => 'module_dvs',
				'add_player.css' => 'module_dvs'
			))
			->assign(array(
				'bIsDvs' => true,
				'bIsExternal' => false
		));
		
	}

}
?>
