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
 * @package 		iDrive
 */
class Idrive_Component_Controller_Add extends Phpfox_Component {

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

		$aYears = Phpfox::getParam('dvs.new_years');
		$aMakes = Phpfox::getService('dvs.video')->getMakes();

		//If there is an array 'val', attempt to validate and save player, otheriwse, display add/edit page.
		if ($aVals = $this->request()->getArray('val'))
		{
			$aValidation = array(
				'player_name' => 'Please enter a Player Name'
			);

			if ($aVals['preroll_file_id'])
			{
				$aValidation['preroll_duration'] = 'Please Enter a Duration for the Pre-Roll File';
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
				$aVals['featured_year'] = null;
				$aVals['featured_make'] = null;
				$aVals['featured_model'] = null;
			}

			if ($oValid->isValid($aVals))
			{
				if ($aVals['action'] == 'add')
				{
					$iId = Phpfox::getService('idrive.player.process')->add($aVals);
					if ($aVals['forward'])
					{
						$this->url()->send('idrive.code', array('id' => $iId, 'action' => 'add'), null);
					}
					else
					{
						$this->url()->send('idrive.index', null, Phpfox::getPhrase('idrive.player_added_successfully'));
					}
				}
				else if ($aVals['action'] == 'save')
				{
					Phpfox::getService('idrive.player.process')->update($aVals);
					if ($aVals['forward'])
					{
						$this->url()->send('idrive.code', array('id' => $aVals['player_id'], 'action' => 'save'), null);
					}
					else
					{
						$this->url()->send('idrive.index', null, Phpfox::getPhrase('idrive.player_saved_successfully'));
					}
				}
			}
			//Validation failed, reload all JS and pass aVals back to contrller as aForms. We need to load the player JS for preview.
			else
			{
				$aVals['logo_file_name'] = Phpfox::getService('idrive.file')->getLogoFile((int) $aVals['logo_file_id']);
				$aVals['preroll_file_name'] = Phpfox::getService('idrive.file')->getPrerollFile((int) $aVals['preroll_file_id']);

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
						'aForms' => $aVals,
						'bIsEdit' => true,
						'bCanAddPlayers' => true,
						'aMakes' => $aMakes,
						'aModels' => $aPlayerModels,
						'sSwfUrl' => $sSwfUrl,
						'sIdriveUrl' => Phpfox::getParam('core.url_file') . 'idrive/'
					))
					->setHeader(array(
						'colorpicker.js' => 'module_dvs',
						'eye.js' => 'module_dvs',
						'utils.js' => 'module_dvs',
						'layout.js' => 'module_dvs',
						'colorpicker.css' => 'module_dvs',
						'<script type="text/javascript">var bDebug = ' . (Phpfox::getParam('dvs.javascript_debug_mode') ? 'true' : 'false') . '</script>',
						'<script type="text/javascript">var sBrowser = "' . $sBrowser . '"</script>',
						'<script type="text/javascript">var bIsDvs = false</script>',
						'player.js' => 'module_dvs',
						'jcarousellite.js' => 'module_dvs',
						'<script type="text/javascript" src="http://admin.brightcove.com/js/BrightcoveExperiences' . ($sBrowser == 'mobile' || $sBrowser == 'ipad' ? '' : '_all') . '.js"></script>',
						'add.js' => 'module_idrive'
					))
					->setBreadcrumb(Phpfox::getPhrase('idrive.my_players'), Phpfox::getLib('url')->makeUrl('idrive'))
					->setBreadcrumb(Phpfox::getPhrase('idrive.edit_player'));
				;
			}
		}
		else
		{
			//If there is an ID, we're editing
			if (($iId = $this->request()->getInt('id')))
			{
				if (($aPlayer = Phpfox::getService('idrive.player')->get($iId)))
				{
					if ($aPlayer['user_id'] == Phpfox::getUserId() || Phpfox::isAdmin())
					{
						$bCanAddPlayers = true;
					}
					else
					{
						$bCanAddPlayers = false;
					}

					$aPlayerModels = array();

					foreach ($aMakes as $iKey => $aMake)
					{
						foreach ($aPlayer['makes'] as $aPlayerMake)
						{
							if ($aMake['make'] == $aPlayerMake['make'])
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
							'aForms' => $aPlayer,
							'bIsEdit' => true,
							'bCanAddPlayers' => $bCanAddPlayers,
							'sSwfUrl' => $sSwfUrl,
							'aModels' => $aPlayerModels
						))
						->setBreadcrumb(Phpfox::getPhrase('idrive.my_players'), Phpfox::getLib('url')->makeUrl('idrive'))
						->setBreadcrumb(Phpfox::getPhrase('idrive.edit_player'));
				}
			}
			else
			//New player being created
			{
				$aPlayers = Phpfox::getService('idrive.player')->listPlayers(0, 0, Phpfox::getUserId(), false);

				if (count($aPlayers) < Phpfox::getUserParam('idrive.players'))
				{
					$bCanAddPlayers = true;
				}
				else
				{
					$bCanAddPlayers = false;
				}
				$this->template()
					->assign(array(
						'bIsEdit' => false,
						'bCanAddPlayers' => $bCanAddPlayers
					))
					->setBreadcrumb(Phpfox::getPhrase('idrive.my_players'), Phpfox::getLib('url')->makeUrl('idrive'))
					->setBreadcrumb(Phpfox::getPhrase('idrive.add_player'));
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
					'<script type="text/javascript">var bIsDvs = false</script>',
					'player.js' => 'module_dvs',
					'jcarousellite.js' => 'module_dvs',
					'<script type="text/javascript" src="http://admin.brightcove.com/js/BrightcoveExperiences' . ($sBrowser == 'mobile' || $sBrowser == 'ipad' ? '' : '_all') . '.js"></script>',
					'add.js' => 'module_idrive'
				))
				->assign(array(
					'aMakes' => $aMakes,
					'iUserId' => Phpfox::getUserId(),
					'sDefaultColor' => Phpfox::getParam('idrive.default_color_picker_color'),
					'sSwfUrl' => $sSwfUrl,
					'sIdriveUrl' => Phpfox::getParam('core.url_file') . 'idrive/'
			));
		}

		$this->template()->setHeader(array(
				'jquery.multiselect.min.js' => 'module_dvs',
				'jquery.multiselect.css' => 'module_dvs',
				'validate.js' => 'module_dvs',
				'jquery.animate-shadow-min.js' => 'module_dvs'
			))
			->assign(array(
				'bIsDvs' => false,
				'bIsExternal' => false
		));
	}


}

?>
