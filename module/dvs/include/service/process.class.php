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
class Dvs_Service_Process extends Phpfox_Service {

	public function __construct()
	{
		$this->_sTable = Phpfox::getT('ko_dvs');
		$this->_sTextTable = Phpfox::getT('ko_dvs_text');
	}


	public function add($aDvs)
	{
		$sTitleUrl = Phpfox::getService('dvs')->getTitleUrl($aDvs['title_url']);

		$sAddress = Phpfox::getService('dvs')->makeAddress($aDvs['country_child_id'], $aDvs['city'], $aDvs['postal_code'], $aDvs['address']);
		$aGeoCode = Phpfox::getService('dvs')->geoCode($sAddress);
		
		// Did we fail to get a geo location?
		if(!(!empty($aGeoCode['latitude']) && !empty($aGeoCode['longitude']))){
			$aGeoCode['latitude'] = 0;
			$aGeoCode['longitude'] = 0;
		}
		
		$iId = $this->database()->insert($this->_sTable, array(
			'user_id' => Phpfox::getUserId(),
			'dvs_name' => $this->preParse()->clean($aDvs['dvs_name'], 255),
			'dealer_name' => $this->preParse()->clean($aDvs['dealer_name'], 255),
			'title_url' => $this->preParse()->clean($sTitleUrl),
			'address' => $this->preParse()->clean($aDvs['address'], 255),
			'city' => $this->preParse()->clean($aDvs['city'], 255),
			'country_child_id' => (int) $aDvs['country_child_id'],
			'postal_code' => $this->preParse()->clean($aDvs['postal_code'], 16),
			'phone' => $this->preParse()->clean($aDvs['phone'], 16),
			'email' => $this->preParse()->clean($aDvs['email'], 255),
			'url' => $this->preParse()->clean($aDvs['url'], 255),
			'inventory_url' => $this->preParse()->clean($aDvs['inventory_url'], 255),
			'seo_tags' => $this->preParse()->clean($aDvs['seo_tags'], 255),
			'dvs_google_id' => $this->preParse()->clean($aDvs['dvs_google_id'], 16),
//			'contact_url' => $this->preParse()->clean($aDvs['contact_url'], 255),
			'youtube_url' => (isset($aDvs['youtube_url']) ? $this->preParse()->clean($aDvs['youtube_url'], 255) : ''),
			'facebook_url' => (isset($aDvs['facebook_url']) ? $this->preParse()->clean($aDvs['facebook_url'], 255) : ''),
			'twitter_url' => (isset($aDvs['twitter_url']) ? $this->preParse()->clean($aDvs['twitter_url'], 255) : ''),
			'google_url' => (isset($aDvs['google_url']) ? $this->preParse()->clean($aDvs['google_url'], 255) : ''),
			'specials_url' => $this->preParse()->clean($aDvs['specials_url'], 255),
			'latitude' => $aGeoCode['latitude'],
			'longitude' => $aGeoCode['longitude'],
			'1onone_override' => (isset($aDvs['1onone_override']) ? $this->preParse()->clean($aDvs['1onone_override'], 128) : ''),
			'new2u_override' => (isset($aDvs['new2u_override']) ? $this->preParse()->clean($aDvs['new2u_override'], 128) : ''),
			'top200_override' => (isset($aDvs['top200_override']) ? $this->preParse()->clean($aDvs['top200_override'], 128) : ''),
			'dvs_time_stamp' => PHPFOX_TIME
		));

		$this->database()->insert($this->_sTextTable, array(
			'dvs_id' => $iId,
			'text' => $this->preParse()->clean($aDvs['welcome'], Phpfox::getParam('dvs.welcome_greeting_max_chars')),
			'text_parsed' => $this->preParse()->prepare($aDvs['welcome'])
		));

		return $iId;
	}


	public function update($aDvs)
	{
		$sAddress = Phpfox::getService('dvs')->makeAddress($aDvs['country_child_id'], $aDvs['city'], $aDvs['postal_code'], $aDvs['address']);
		$aGeoCode = Phpfox::getService('dvs')->geoCode($sAddress);

		$this->database()->update($this->_sTable, array(
			//'user_id' => Phpfox::getUserId(),
			'dealer_name' => $this->preParse()->clean($aDvs['dealer_name'], 255),
			'dvs_name' => $this->preParse()->clean($aDvs['dvs_name'], 255),
			'address' => $this->preParse()->clean($aDvs['address'], 255),
			'city' => $this->preParse()->clean($aDvs['city'], 255),
			'country_child_id' => (int) $aDvs['country_child_id'],
			'postal_code' => $this->preParse()->clean($aDvs['postal_code'], 16),
			'phone' => $this->preParse()->clean($aDvs['phone'], 16),
			'email' => $this->preParse()->clean($aDvs['email'], 255),
			'url' => $this->preParse()->clean($aDvs['url'], 255),
			'inventory_url' => $this->preParse()->clean($aDvs['inventory_url'], 255),
			'seo_tags' => $this->preParse()->clean($aDvs['seo_tags'], 255),
			'dvs_google_id' => $this->preParse()->clean($aDvs['dvs_google_id'], 16),
			'youtube_url' => (isset($aDvs['youtube_url']) ? $this->preParse()->clean($aDvs['youtube_url'], 255) : ''),
			'facebook_url' => (isset($aDvs['facebook_url']) ? $this->preParse()->clean($aDvs['facebook_url'], 255) : ''),
			'twitter_url' => (isset($aDvs['twitter_url']) ? $this->preParse()->clean($aDvs['twitter_url'], 255) : ''),
			'google_url' => (isset($aDvs['google_url']) ? $this->preParse()->clean($aDvs['google_url'], 255) : ''),
			'specials_url' => $this->preParse()->clean($aDvs['specials_url'], 255),
			'latitude' => $aGeoCode['latitude'],
			'longitude' => $aGeoCode['longitude'],
			'1onone_override' => (isset($aDvs['1onone_override']) ? $this->preParse()->clean($aDvs['1onone_override'], 128) : ''),
			'new2u_override' => (isset($aDvs['new2u_override']) ? $this->preParse()->clean($aDvs['new2u_override'], 128) : ''),
			'top200_override' => (isset($aDvs['top200_override']) ? $this->preParse()->clean($aDvs['top200_override'], 128) : ''),
			'dvs_time_stamp' => PHPFOX_TIME
			), 'dvs_id = ' . (int) $aDvs['dvs_id']);

		if (Phpfox::isAdmin())
		{
			$sTitleUrl = Phpfox::getService('dvs')->getTitleUrl($aDvs['vanity_url'], $aDvs['dvs_id']);

			$this->database()->update($this->_sTable, array(
				'title_url' => $this->preParse()->clean($sTitleUrl)
				), 'dvs_id = ' . (int) $aDvs['dvs_id']);
		}

		$this->database()->update($this->_sTextTable, array(
			'text' => $this->preParse()->clean($aDvs['welcome'], Phpfox::getParam('dvs.welcome_greeting_max_chars')),
			'text_parsed' => $this->preParse()->prepare($aDvs['welcome'])
			), 'dvs_id = ' . (int) $aDvs['dvs_id']);
	}


	public function remove($iDvsId)
	{
		$aDvs = Phpfox::getService('dvs')->get($iDvsId);

		$this->database()->delete($this->_sTable, 'dvs_id = ' . (int) $iDvsId);
		$this->database()->delete($this->_sTextTable, 'dvs_id = ' . (int) $iDvsId);

		if ($aDvs['branding_file_id'])
		{
			Phpfox::getService('dvs.file.process')->removeBranding($aDvs['branding_file_id']);
		}

		if ($aDvs['background_file_id'])
		{
			Phpfox::getService('dvs.file.process')->removeBackground($aDvs['background_file_id']);
		}

		Phpfox::getService('dvs.style.process')->remove($iDvsId);
		Phpfox::getService('dvs.player.process')->remove($iDvsId);
	}


	public function updateContactCount($iDvsId)
	{
		$this->database()->query("UPDATE " . $this->_sTable . " SET total_emails_sent  = total_emails_sent + 1 WHERE dvs_id = " . (int) $iDvsId);
	}


}

?>