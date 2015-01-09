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
class Dvs_Service_Override_Override extends Phpfox_Service {

	public $aPhraseVars = array();

	public function __construct()
	{
		$this->_tOverrides = Phpfox::getT('ko_dvs_phrase_overrides');

		$this->aPhraseVars = array_flip(array(
			'override_page_title_display',
			'override_page_title_display_video_specified',
			'override_video_name_display',
			'override_video_description_display',
			'override_meta_keywords_meta',
			'override_meta_keywords_meta_video_specified',
			'override_meta_description_meta',
			'override_meta_description_meta_video_specified',
			'override_meta_itemprop_creator_meta',
			'override_meta_itemprop_name_meta',
			'override_meta_itemprop_description_meta',
			'override_open_graph_site_name_meta',
			'override_open_graph_site_name_meta_video_specified',
			'override_open_graph_title_meta',
			'override_open_graph_title_meta_video_specified',
			'override_open_graph_description_meta_video_specified',
			'override_open_graph_description_meta',
			'override_video_name_sitemaps',
			'override_video_description_sitemaps',
		));

		// Clear the values from the Phrase Var array
		array_walk_recursive($this->aPhraseVars, function(&$sPhraseVar) {
				$sPhraseVar = '';
			});
	}


	/**
	 * Get a override by override id
	 * 
	 * @param int $iOverrideId
	 * @return array, override
	 */
	public function get($iOverrideId, $bUseVarName = false)
	{
		return $this->database()->select('*')
				->from($this->_tOverrides, 'override')
				->where('override_id =' . $iOverrideId)
				->execute('getRow');
	}


	/**
	 * Get a list of overrides for a specific DVS
	 * 
	 * @param type $iDvsId
	 * @return type
	 */
	public function getOverrides($iDvsId)
	{
		$aOverrides = $this->database()->select('var_name, text')
			->from($this->_tOverrides)
			->where('dvs_id = ' . (int) $iDvsId)
			->execute('getRows');

		// Set the value in aPhraseVars and unset the override array
		foreach ($aOverrides as $iKey => $aOverride)
		{
			$aOverrides[$aOverride['var_name']] = $aOverride['text'];
			unset($aOverrides[$iKey]);
		}

		return $aOverrides;
	}


	/**
	 * Get phrases for a DVS and Video.
	 * If a dealer has overridden any of these, replace the deault phrase with the dealer's phrase
	 * 
	 * @param type $aDvs
	 * @param type $aVideo
	 * @param type $sPhraseVar
	 * @return array
	 */
	public function getAll($aDvs, $aVideo = array())
	{
		// Dynamically add DVS and video keys and values to the find and replace arrays for str_replace
		$aFindReplace = array();
		foreach ($aDvs as $sKey => $sValue) {
            if(!in_array($sKey, array('dealer_id'))) {
                $aFind[] = '{dvs_' . $sKey . '}';
                $aReplace[] = '' . $sValue . '';
            }
		}
		foreach ($aVideo as $sKey => $sValue)
		{
			$aFind[] = '{video_' . $sKey . '}';
			$aReplace[] = '' . $sValue . '';
		}

		foreach (array_merge($this->aPhraseVars, $this->getOverrides($aDvs['dvs_id'])) as $sPhraseVar => $sPhraseText)
		{
			if (!$sPhraseText) $sPhraseText = Phpfox::getPhrase('dvs.' . $sPhraseVar);
			$this->aPhraseVars[$sPhraseVar] = str_replace($aFind, $aReplace, $sPhraseText);
		}

		return $this->aPhraseVars;
	}


}

?>