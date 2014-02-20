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
class Dvs_Service_Override_Process extends Phpfox_Service {

	public function __construct()
	{
		$this->_tOverrides = Phpfox::getT('ko_dvs_phrase_overrides');
	}


	/**
	 * Add, update, and remove phrase overrides based on existing phrase overrides for a specific dvs
	 * 
	 * @param int $iDvsId
	 * @param array $aVals, phrase overrides
	 */
	public function addUpdateRemove($iDvsId, $aVals)
	{
		array_walk_recursive($aVals, function(&$mValue) {
				$mValue = Phpfox::getLib('database')->escape($mValue);
			});

		$aOverrides = Phpfox::getService('dvs.override')->getOverrides($iDvsId);

		// Update existing phrase overrides
		foreach ($aVals as $sPhraseVar => $sPhraseText)
		{
			// Entry exists
			if (isset($aOverrides[$sPhraseVar]))
			{
				if (!$sPhraseText)
				{
					// Return to default (remove)
					$this->database()->delete($this->_tOverrides, 'dvs_id = ' . (int) $iDvsId . ' AND var_name = "' . $sPhraseVar . '"');
				}
				else if ($aOverrides[$sPhraseVar] != $sPhraseText)
				{
					// Update override
					$this->database()->update($this->_tOverrides, array(
						'text' => $sPhraseText
						), 'dvs_id = ' . (int) $iDvsId . ' AND var_name = "' . $sPhraseVar . '"');
				}
			}
			else
			{
				// Entry does not exist yet. If phrase text exists, add a new row.
				if ($sPhraseText)
				{
					$this->database()->insert($this->_tOverrides, array(
						'dvs_id' => (int) $iDvsId,
						'var_name' => $sPhraseVar,
						'text' => $sPhraseText
					));
				}
			}
		}
	}


	/**
	 * Remove all overrides for a specific dvs
	 * 
	 * @param int $iDvsId
	 * @return boolean
	 */
	public function removeAll($iDvsId)
	{
		return $this->database()->delete($this->_tOverrides, 'dvs_id = ' . (int) $iDvsId);
	}


}

?>