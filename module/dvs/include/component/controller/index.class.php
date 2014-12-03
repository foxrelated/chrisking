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
class Dvs_Component_Controller_Index extends Phpfox_Component {
	public function process() {
		$bSubdomainMode = Phpfox::getParam('dvs.enable_subdomain_mode');

		$sDvsRequest = $this->request()->get(($bSubdomainMode ? 'req1' : 'req2'));

		if ($aDvs = Phpfox::getService('dvs')->get($sDvsRequest, true)) {
			if ($this->request()->get(($bSubdomainMode ? 'req2' : 'req3')) == 'sitemap') {
				return Phpfox::getLib('module')->setController('dvs.dvs-sitemap');
			} else if ($this->request()->get(($bSubdomainMode ? 'req2' : 'req3')) == 'share') {
				return Phpfox::getLib('module')->setController('dvs.share');
			} else if ($this->request()->get(($bSubdomainMode ? 'req2' : 'req3')) == 'gallery') {
				return Phpfox::getLib('module')->setController('dvs.gallery');
			} else if ($this->request()->get($bSubdomainMode ? 'req3' : 'req4') == 'player') {
				return Phpfox::getLib('module')->setController('dvs.player.player');
			} else if ($this->request()->get(($bSubdomainMode ? 'req2' : 'req3')) == 'iframe') {
                return Phpfox::getLib('module')->setController('dvs.iframe');
            } else if ($this->request()->get(($bSubdomainMode ? 'req2' : 'req3')) == 'dvs-vdp-iframe') {
                return Phpfox::getLib('module')->setController('dvs.dvs-vdp-iframe');
            } else {
				return Phpfox::getLib('module')->setController('dvs.view');
			}
		} else {
			$aShortUrl = Phpfox::getService('dvs.shorturl')->get($sDvsRequest);

			// Even with ShortURL mode on, the short url should come in as req2
			if (!empty($aShortUrl)) {
				$aShortUrl = Phpfox::getService('dvs.shorturl')->get($this->request()->get('req2'));
			}

			if (!empty($aShortUrl)) {
				return Phpfox::getLib('module')->setController('dvs.view');
			}
		}

		// Load the index if the user has access to this DVS
		// Make sure user
		if (!Phpfox::isUser()) {
			$this->url()->send('');
			return false;
		}

		$sMessage = '';

		if ($aVals = $this->request()->getArray('val')) {
			if ($aVals['step'] == 'settings') {
				if ($aVals['country_child_id'] == 0) {
					$aVals['country_child_id'] = '';
				}

				$aValidation = array(
					'dealer_name' => Phpfox::getPhrase('dvs.please_enter_a_dealer_name'),
					'dvs_name' => Phpfox::getPhrase('dvs.please_enter_a_showroom_name'),
					'address' => Phpfox::getPhrase('dvs.please_enter_an_address'),
					'city' => Phpfox::getPhrase('dvs.please_enter_a_city'),
					'country_child_id' => Phpfox::getPhrase('dvs.please_select_a_state')
				);

				$oValid = Phpfox::getLib('validator')->set(array(
					'sFormName' => 'add_dvs',
					'aParams' => $aValidation
				));

				if ($oValid->isValid($aVals)) {
					if (strlen($aVals['welcome']) > Phpfox::getParam('dvs.welcome_greeting_max_chars')) {
						$aVals['welcome'] = substr($aVals['welcome'], 0, Phpfox::getParam('dvs.welcome_greeting_max_chars'));
					}

					if (isset($aVals['dvs_id']) && $aVals['dvs_id']) {
						Phpfox::getService('dvs.process')->update($aVals);						Phpfox::getService('dvs.override.process')->addUpdateRemove($aVals['dvs_id'], $aVals['phrase_overrides']);
						$sMessage = Phpfox::getPhrase('dvs.settings_saved_successfully');
					} else {
						$iId = Phpfox::getService('dvs.process')->add($aVals);
						Phpfox::getService('dvs.override.process')->addUpdateRemove($iId, $aVals['phrase_overrides']);

						$this->url()->send('dvs.customize', array('id' => $iId));
					}
				} else {
				//Validation failed, reload all JS and pass aVals back to contrller as aForms. We need to load the dvs JS for preview.
					Phpfox::getLib('module')->setController('dvs.settings');

					$this->template()->assign(array(
								'aForms' => $aVals,
								'bCanAddDvss' => true,
								'bIsEdit' => true
							))
							->setBreadcrumb(Phpfox::getPhrase('dvs.my_dealer_video_showrooms'), Phpfox::getLib('url')->makeUrl('dvs'))
							->setBreadcrumb(Phpfox::getPhrase('dvs.edit_dealer_video_showroom'));
				}
			} else if ($aVals['step'] == 'customize') {
				if ($aVals['is_edit']) {
					Phpfox::getService('dvs.style.process')->update($aVals);
					$sMessage = Phpfox::getPhrase('dvs.customization_saved_successfully');
				} else {
					Phpfox::getService('dvs.style.process')->add($aVals);

					$this->url()->send('dvs.player.add', array('id' => $aVals['dvs_id']), null);
				}
			}
		}

		$iPage = $this->request()->getInt('page');
		$iPageSize = 20;

		list($aDvss, $iCnt) = Phpfox::getService('dvs')->listDvss($iPage, $iPageSize, Phpfox::getUserId(), true, Phpfox::getUserParam('dvs.can_view_other_dvs'));

		if ($iCnt < Phpfox::getUserParam('dvs.dvss')) {
			$bCanAddDvss = true;
		} else {
			$bCanAddDvss = false;
		}

        Phpfox::getLib('pager')->set(array('page' => $iPage, 'size' => $iPageSize, 'count' => $iCnt));

		$this->template()->assign(array(
					'sMessage' => $sMessage,
					'aDvss' => $aDvss,
					'bCanAddDvss' => $bCanAddDvss,
					'bSubdomainMode' => $bSubdomainMode,
                    'sCorePath' => Phpfox::getParam('core.path')
				))
				->setBreadcrumb(Phpfox::getPhrase('dvs.my_dealer_video_showrooms'))
				->setHeader('cache', array(
					'pager.css' => 'style_css',
					'activity.css' => 'module_dvs',
					'activity.js' => 'module_dvs'
		));

		
	}

}

?>