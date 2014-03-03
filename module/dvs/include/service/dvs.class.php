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
class Dvs_Service_Dvs extends Phpfox_Service {

	public function __construct()
	{
		$this->_sTable = Phpfox::getT('ko_dvs');
	}


	public function listDvss($iPage, $iPageSize, $iUserId, $bPaginate = true)
	{
		$iPage = (int) $iPage;
		$iPageSize = (int) $iPageSize;
		$iUserId = (int) $iUserId;

		if ($bPaginate)
		{
			if ($iUserId)
			{
				$this->database()->where('user_id =' . $iUserId);
			}
			$iCnt = $this->database()->select('COUNT(*)')
				->from($this->_sTable)
				->execute('getField');

			$this->database()->limit($iPage, $iPageSize, $iCnt);
		}

		if ($iUserId)
		{
			$this->database()->where('d.user_id =' . $iUserId);
		}

		$aDvss = $this->database()
			->select('d.*, t.text, s.branding_file_id, s.background_file_id, s.menu_background, s.menu_link, s.page_background, s.page_text, s.button_background, s.button_text, s.button_top_gradient, s.button_bottom_gradient, s.button_border, s.text_link, s.footer_link, cc.name as state_string, ' . Phpfox::getUserField())
			->from($this->_sTable, 'd')
			->leftjoin(Phpfox::getT('country_child'), 'cc', 'cc.child_id = d.country_child_id')
			->leftjoin(Phpfox::getT('ko_dvs_text'), 't', 't.dvs_id = d.dvs_id')
			->leftjoin(Phpfox::getT('ko_dvs_style'), 's', 's.dvs_id = d.dvs_id')
			->leftjoin(Phpfox::getT('ko_dvs_branding_files'), 'b', 'b.branding_id = s.branding_file_id')
			->leftjoin(Phpfox::getT('ko_dvs_background_files'), 'bg', 'bg.background_id = s.background_file_id')
			->leftjoin(Phpfox::getT('ko_dvs_players'), 'p', 'p.dvs_id = d.dvs_id')
			//->leftjoin(Phpfox::getT('ko_dvs_logo_files'), 'l', 'l.logo_id = p.logo_file_id')
			->leftjoin(Phpfox::getT('ko_dvs_preroll_files'), 'pr', 'pr.preroll_id = p.preroll_file_id')
			->join(Phpfox::getT('user'), 'u', 'u.user_id = d.user_id')
			->execute('getRows');

		if ($bPaginate)
		{
			return array($aDvss, $iCnt);
		}
		else
		{
			return $aDvss;
		}
	}


	public function getTitleUrl($sDvsName, $iDvsId = 0)
	{
		$sDvsName = preg_replace("/[^A-Za-z0-9 ]/", "", $sDvsName);

		return $this->preParse()->prepareTitle('dvs', $sDvsName, 'title_url', null, $this->_sTable, ($iDvsId ? 'title_url LIKE "%' . $this->preParse()->clean($sDvsName) . '%" AND dvs_id !=' . (int) $iDvsId : null), false, false);
	}


	public function get($mDvs, $bUseTitle = false)
	{
		if (!$mDvs)
		{
			return array();
		}

		if ($bUseTitle)
		{
			$this->database()->where('d.title_url = "' . $this->preParse()->clean($mDvs) . '"');
		}
		else
		{
			$this->database()->where('d.dvs_id = ' . (int) $mDvs);
		}

		$aDvs = $this->database()
			->select('cc.name as state_string, t.*, s.*, b.*, bg.*, p.*, pr.*, ' . Phpfox::getUserField('u', 'dealer_user_') . ', d.*')
			->from($this->_sTable, 'd')
			->leftjoin(Phpfox::getT('country_child'), 'cc', 'cc.child_id = d.country_child_id')
			->leftjoin(Phpfox::getT('ko_dvs_text'), 't', 't.dvs_id = d.dvs_id')
			->leftjoin(Phpfox::getT('ko_dvs_style'), 's', 's.dvs_id = d.dvs_id')
			->leftjoin(Phpfox::getT('ko_dvs_branding_files'), 'b', 'b.branding_id = s.branding_file_id')
			->leftjoin(Phpfox::getT('ko_dvs_background_files'), 'bg', 'bg.background_id = s.background_file_id')
			->leftjoin(Phpfox::getT('ko_dvs_players'), 'p', 'p.dvs_id = d.dvs_id')
			//->leftjoin(Phpfox::getT('ko_dvs_logo_files'), 'l', 'l.logo_id = p.logo_file_id')
			->leftjoin(Phpfox::getT('ko_dvs_preroll_files'), 'pr', 'pr.preroll_id = p.preroll_file_id')
			->join(Phpfox::getT('user'), 'u', 'u.user_id = d.user_id')
			->execute('getRow');

		return $aDvs;
	}


	public function geoCode($sAddress, $bRecursion = true)
	{
		$sAddress = utf8_encode($sAddress);

		// output
		$aOutput = array();

		$sRequestUrl = "http://maps.googleapis.com/maps/api/geocode/xml?sensor=false" . "&address=" . urlencode($sAddress);

		$oXml = simplexml_load_file($sRequestUrl);

		$sStatusCode = (string) $oXml->status;

		if (strcmp($sStatusCode, "OK") == 0)
		{
			$aOutput['latitude'] = (string) $oXml->result->geometry->location->lat;
			$aOutput['longitude'] = (string) $oXml->result->geometry->location->lng;
		}
		else if (strcmp($sStatusCode, "620") == 0)
		{
			if ($bRecursion === true)
			{
				sleep(1);
				$aOutput = $this->geoCode($sAddress, false);
			}
		}
		else
		{
			// failure to geocode
		}

		if (!empty($aOutput['latitude']) && !empty($aOutput['longitude']))
		{
			$aOutput['success'] = true;
		}
		else
		{
			$aOutput['success'] = false;
		}

		return $aOutput;
	}


	public function makeAddress($iCountryChildId, $sCityLocation, $sZipCode, $sStreetAddress)
	{
		$oCountry = Phpfox::getService('core.country');
		$oParseOutput = Phpfox::getLib('parse.output');
		$aAddress = array();

		if (!empty($sStreetAddress))
		{
			$aAddress['address'] = $oParseOutput->clean($sStreetAddress);
		}

		if (!empty($sCityLocation))
		{
			$aAddress['city'] = $oParseOutput->clean($sCityLocation);
		}

		if (!empty($iCountryChildId) && $iCountryChildId > 0)
		{
			$aAddress['country_child'] = $oCountry->getChild($iCountryChildId);
		}

		if (!empty($sZipCode))
		{
			$aAddress['postal_code'] = $sZipCode;
		}

		return implode(', ', $aAddress);
	}


	public function getCss($aDvs, $bSubdomainMode)
	{
		$sCss = $this->buildCss('body', array(
			'background' => 'none repeat scroll 0 0 #' . $aDvs['page_background'] . ' !important',
			'color' => '#' . $aDvs['page_text']
		));

		$sCss .= $this->buildCss('h1', array(
			'color' => '#' . $aDvs['page_text']
		));

		$sCss .= $this->buildCss('#dvs_branding_container h1', array(
			'background' => 'none repeat scroll 0 0 #' . $aDvs['page_background'],
			'color' => '#' . $aDvs['page_text']
			), true);

		if (!$aDvs['background_opacity'])
		{
			$aDvs['background_opacity'] = 1;
		}


		// The following addition can come out when the dvs_background div is removed from the desktop template
		$sCss .= $this->buildCss('#dvs_background', array(
			'background' => '#' . $aDvs['page_background'] . ($aDvs['background_file_name'] ? ' url(' . Phpfox::getLib('url')->makeUrl(($bSubdomainMode ? 'www.' : '') . 'file.dvs.background') . $aDvs['background_file_name'] . ')' : ''),
			'opacity' => $aDvs['background_opacity'],
			'filter' => 'alpha(opacity=' . ($aDvs['background_opacity'] * 100) . ')'
		));

		$sCss .= $this->buildCss('.dvs_background', array(
			'background' => '#' . $aDvs['page_background'] . ' url(' . Phpfox::getLib('url')->makeUrl(($bSubdomainMode ? 'www.' : '') . 'file.dvs.background') . $aDvs['background_file_name'] . ')'
		));

		if ($aDvs['background_file_name'])
		{
			$sCss .= $this->buildCss('.dvs_background_image', array(
				'background' => 'url(' . Phpfox::getLib('url')->makeUrl(($bSubdomainMode ? 'www.' : '') . 'file.dvs.background') . $aDvs['background_file_name'] . ')',
				'opacity' => $aDvs['background_opacity'],
				'filter' => 'alpha(opacity=' . ($aDvs['background_opacity'] * 100) . ')'
			));
		}

		$sCss .= $this->buildCss('#dvs_menu_container', array(
			'background' => 'none repeat scroll 0 0 #' . $aDvs['menu_background']
		));

		$sCss .= $this->buildCss('#dvs_menu_container a', array(
			'color' => '#' . $aDvs['menu_link']
			), true);

		$sCss .= $this->buildCss('#dvs_dealer_info a', array(
			'color' => '#' . $aDvs['text_link']
			), true);

		$sCss .= $this->buildCss('.text_expander_links', array(
			'color' => '#' . $aDvs['text_link']
		));

		$sCss .= $this->buildCss('.text_expander_links:hover', array(
			'color' => '#' . $aDvs['text_link']
		));

		$sCss .= $this->buildCss('#dvs_vehicle_select_container', array(
			'color' => '#' . $aDvs['page_text']
		));

		$sCss .= $this->buildCss('#dvs_video_information a', array(
			'color' => '#' . $aDvs['page_text']
		));

		$sCss .= $this->buildCss('.dvs_c2a_button', array(
			'background-image' => '-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #' . $aDvs['button_top_gradient'] . '), color-stop(1, #' . $aDvs['button_bottom_gradient'] . ') )',
			'background-image' => '-webkit-linear-gradient(top, #' . $aDvs['button_top_gradient'] . ', #' . $aDvs['button_bottom_gradient'] . ')',
			'background' => '-moz-linear-gradient( center top, #' . $aDvs['button_top_gradient'] . ' 5%, #' . $aDvs['button_bottom_gradient'] . ' 100% )',
			'filter' => 'progid:DXImageTransform.Microsoft.gradient(startColorstr=\'#' . $aDvs['button_top_gradient'] . '\', endColorstr=\'#' . $aDvs['button_bottom_gradient'] . '\')',
			'background-color' => '#' . $aDvs['button_top_gradient'] . '',
			'border' => '1px solid #' . $aDvs['button_border'],
			'color' => '#' . $aDvs['button_text']
		));

		$sCss .= $this->buildCss('.dvs_c2a_button:hover', array(
			'background-image' => '-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #' . $aDvs['button_bottom_gradient'] . '), color-stop(1, #' . $aDvs['button_top_gradient'] . ') )',
			'background-image' => '-webkit-linear-gradient(top, #' . $aDvs['button_bottom_gradient'] . ', #' . $aDvs['button_top_gradient'] . ')',
			'background' => '-moz-linear-gradient( center top, #' . $aDvs['button_bottom_gradient'] . ' 5%, #' . $aDvs['button_top_gradient'] . ' 100% )',
			'filter' => 'progid:DXImageTransform.Microsoft.gradient(startColorstr=\'#' . $aDvs['button_bottom_gradient'] . '\', endColorstr=\'#' . $aDvs['button_top_gradient'] . '\')',
			'background-color' => '#' . $aDvs['button_bottom_gradient'] . '',
			'border' => '1px solid #' . $aDvs['button_border'],
			'color' => '#' . $aDvs['button_text']
		));

		$sCss .= $this->buildCss('#dvs_footer_container', array(
			'color' => '#' . $aDvs['footer_link']
		));

		$sCss .= $this->buildCss('.dvs_footer_link', array(
			'color' => '#' . $aDvs['footer_link']
			), false, true);

		$sCss .= $this->buildCss('.dvs_footer_link:hover', array(
			'color' => '#' . $aDvs['footer_link']
		));

		$sCss .= $this->buildCss('.dvs_footer_info a', array(
			'color' => '#' . $aDvs['footer_link']
			), false, true);

		$sCss .= $this->buildCss('.dvs_footer_info a:hover', array(
			'color' => '#' . $aDvs['footer_link']
		));

		//contact-form buttons
		$sCss .= $this->buildCss('.dvs_form_button', array(
			'background-image' => '-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #' . $aDvs['button_top_gradient'] . '), color-stop(1, #' . $aDvs['button_bottom_gradient'] . ') )',
			'background-image' => '-webkit-linear-gradient(top, #' . $aDvs['button_top_gradient'] . ', #' . $aDvs['button_bottom_gradient'] . ')',
			'background' => '-moz-linear-gradient( center top, #' . $aDvs['button_top_gradient'] . ' 5%, #' . $aDvs['button_bottom_gradient'] . ' 100% )',
			'filter' => 'progid:DXImageTransform.Microsoft.gradient(startColorstr=\'#' . $aDvs['button_top_gradient'] . '\', endColorstr=\'#' . $aDvs['button_bottom_gradient'] . '\')',
			'background-color' => '#' . $aDvs['button_top_gradient'] . '',
			'border' => '1px solid #' . $aDvs['button_border'],
			'color' => '#' . $aDvs['button_text']
		));

		$sCss .= $this->buildCss('.dvs_form_button:hover', array(
			'background-image' => '-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #' . $aDvs['button_bottom_gradient'] . '), color-stop(1, #' . $aDvs['button_top_gradient'] . ') )',
			'background-image' => '-webkit-linear-gradient(top, #' . $aDvs['button_bottom_gradient'] . ', #' . $aDvs['button_top_gradient'] . ')',
			'background' => '-moz-linear-gradient( center top, #' . $aDvs['button_bottom_gradient'] . ' 5%, #' . $aDvs['button_top_gradient'] . ' 100% )',
			'filter' => 'progid:DXImageTransform.Microsoft.gradient(startColorstr=\'#' . $aDvs['button_bottom_gradient'] . '\', endColorstr=\'#' . $aDvs['button_top_gradient'] . '\')',
			'background-color' => '#' . $aDvs['button_bottom_gradient'] . '',
			'border' => '1px solid #' . $aDvs['button_border'],
			'color' => '#' . $aDvs['button_text']
		));

		return $sCss;
	}


	public function buildCss($sSelector, $aDeclarations, $bContextual = false, $bEnd = false)
	{
		$sCss = $sSelector . ($bContextual ? '' : ' ') . '{' . "\n";

		foreach ($aDeclarations as $sProperty => $sValue)
		{
			$sCss .= "\t" . $sProperty . ': ' . $sValue . ';' . "\n";
		}

		$sCss .= '}' . ($bEnd ? '' : "\n\n");

		return $sCss;
	}


	public function getCname()
	{
		$aUrl = explode('.', $_SERVER['SERVER_NAME']);

		if ($aUrl[0] == 'www' || $aUrl[0] == 'dvs' || $aUrl[0] == 'idrive')
		{
			return false;
		}

		$aDvs = $this->get($aUrl[0], true);

		return (isset($aDvs['title_url']) ? $aDvs['title_url'] : false);
	}


	public function hasAccess($iId, $iUserId, $sIdSource = '')
	{
		if (Phpfox::isAdmin())
		{
			return true;
		}

		if (!$iId || !$iUserId)
		{
			return false;
		}

		if ($sIdSource == '')
		{
			$aDvs = $this->get($iId, false);

			if ($aDvs['user_id'] == $iUserId)
			{
				return true;
			}
		}

		if ($sIdSource == 'branding')
		{
			$iOwnerId = $this->database()
				->select('user_id')
				->from(Phpfox::getT('ko_dvs_branding_files'))
				->where('branding_id = ' . (int) $iId)
				->execute('getField');

			if ($iOwnerId == $iUserId)
			{
				return true;
			}
		}

		if ($sIdSource == 'background')
		{
			$iOwnerId = $this->database()
				->select('user_id')
				->from(Phpfox::getT('ko_dvs_background_files'))
				->where('background_id = ' . (int) $iId)
				->execute('getField');

			if ($iOwnerId == $iUserId)
			{
				return true;
			}
		}

		if ($sIdSource == 'logo')
		{
			$iOwnerId = $this->database()
				->select('user_id')
				->from(Phpfox::getT('ko_dvs_logo_files'))
				->where('logo_id = ' . (int) $iId)
				->execute('getField');

			if ($iOwnerId == $iUserId)
			{
				return true;
			}
		}

		if ($sIdSource == 'preroll')
		{
			$iOwnerId = $this->database()
				->select('user_id')
				->from(Phpfox::getT('ko_dvs_preroll_files'))
				->where('preroll_id = ' . (int) $iId)
				->execute('getField');

			if ($iOwnerId == $iUserId)
			{
				return true;
			}
		}
		return false;
	}


	public function getBrowser()
	{
		static $sAgent;
		$this->_bIsMobile = false;

		$sAgent = Phpfox::getLib('request')->getServer('HTTP_USER_AGENT');

		if (preg_match("/Firefox\/(.*)/i", $sAgent, $aMatches) && isset($aMatches[1]))
		{
			$sAgent = 'Firefox ' . $aMatches[1];
		}
		elseif (preg_match("/MSIE (.*);/i", $sAgent, $aMatches))
		{
			$aParts = explode(';', $aMatches[1]);
			$sAgent = 'IE ' . $aParts[0];
		}
		elseif (preg_match("/Opera\/(.*)/i", $sAgent, $aMatches))
		{
			$aParts = explode(' ', trim($aMatches[1]));
			$sAgent = 'Opera ' . $aParts[0];
		}
		elseif (preg_match('/\s+?chrome\/([0-9.]{1,10})/i', $sAgent, $aMatches))
		{
			$aParts = explode(' ', trim($aMatches[1]));
			$sAgent = 'Chrome ' . $aParts[0];
		}
		elseif (preg_match('/android/i', $sAgent))
		{
			$this->_bIsMobile = true;
			$sAgent = 'Android';
		}
		elseif (preg_match('/opera mini/i', $sAgent))
		{
			$this->_bIsMobile = true;
			$sAgent = 'Opera Mini';
		}
		elseif (preg_match('/(pre\/|palm os|palm|hiptop|avantgo|fennec|plucker|xiino|blazer|elaine)/i', $sAgent))
		{
			$this->_bIsMobile = true;
			$sAgent = 'Palm';
		}
		elseif (preg_match('/blackberry/i', $sAgent))
		{
			$this->_bIsMobile = true;
			$sAgent = 'Blackberry';
		}
		elseif (preg_match('/(iris|3g_t|windows ce|opera mobi|windows ce; smartphone;|windows ce; iemobile|windows phone)/i', $sAgent))
		{
			$this->_bIsMobile = true;
			$sAgent = 'Windows Smartphone';
		}
		elseif (preg_match("/Version\/(.*) Safari\/(.*)/i", $sAgent, $aMatches) && isset($aMatches[1]))
		{
			if (preg_match("/iPhone/i", $sAgent) || preg_match("/ipod/i", $sAgent))
			{
				$aParts = explode(' ', trim($aMatches[1]));
				$sAgent = 'Safari iPhone ' . $aParts[0];
				$this->_bIsMobile = true;
			}
			else if (preg_match("/ipad/i", $sAgent))
			{
				$aParts = explode(' ', trim($aMatches[1]));
				$sAgent = 'ipad';
				$this->_bIsMobile = true;
			}
			else
			{
				$sAgent = 'Safari ' . $aMatches[1];
			}
		}
		//custom ipad detection
		elseif (preg_match('/crios/i', $sAgent)) //detects Chrome browser for iOS
		{
			$this->_bIsMobile = false;
			$sAgent = 'ipad';
		}
		elseif (preg_match('/(mini 9.5|vx1000|lge |m800|e860|u940|ux840|compal|wireless| mobi|ahong|lg380|lgku|lgu900|lg210|lg47|lg920|lg840|lg370|sam-r|mg50|s55|g83|t66|vx400|mk99|d615|d763|el370|sl900|mp500|samu3|samu4|vx10|xda_|samu5|samu6|samu7|samu9|a615|b832|m881|s920|n210|s700|c-810|_h797|mob-x|sk16d|848b|mowser|s580|r800|471x|v120|rim8|c500foma:|160x|x160|480x|x640|t503|w839|i250|sprint|w398samr810|m5252|c7100|mt126|x225|s5330|s820|htil-g1|fly v71|s302|-x113|novarra|k610i|-three|8325rc|8352rc|sanyo|vx54|c888|nx250|n120|mtk |c5588|s710|t880|c5005|i;458x|p404i|s210|c5100|teleca|s940|c500|s590|foma|samsu|vx8|vx9|a1000|_mms|myx|a700|gu1100|bc831|e300|ems100|me701|me702m-three|sd588|s800|8325rc|ac831|mw200|brew |d88|htc\/|htc_touch|355x|m50|km100|d736|p-9521|telco|sl74|ktouch|m4u\/|me702|8325rc|kddi|phone|lg |sonyericsson|samsung|240x|x320vx10|nokia|sony cmd|motorola|up.browser|up.link|mmp|symbian|smartphone|midp|wap|vodafone|o2|pocket|kindle|mobile|psp|treo)/i', $sAgent))
		{
			$this->_bIsMobile = true;
		}

		if ($sAgent == 'ipad')
		{
			return 'ipad';
		}
		else
		{
			return ($this->_bIsMobile ? 'mobile' : 'desktop');
		}
	}

}

?>