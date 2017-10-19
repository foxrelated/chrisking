<?php

/**
 * [PHPFOX_HEADER]
 */
defined('PHPFOX') or exit('No direct script access allowed.');

/**
 * @copyright		EMPulse Codeworx
 * @author  		James
 * @package 		MetaRadio
 */
class Kobrightcove_Component_Block_Progress_Update extends Phpfox_Component {
	public function process() {
		$oBrightcove = Phpfox::getService('kobrightcove');
		$iStartTime = $oBrightcove->startScriptTimer();
		$aVals = Phpfox::getLib('phpfox.request')->getArray('val');
		$iOffset = $aVals['offset'];
		$iTotal = $aVals['total'];
		$iTotalVideos = $aVals['totalvideos'];
		$iBatch = $aVals['batch'];
		$sJob = $aVals['job'];

		//If nearing the end, don't do too many...
		if ($iOffset + $iBatch > $iTotal) $iBatch = $iTotal - $iOffset;

		$iLimit = $iOffset + $iBatch;

		while ($iOffset < $iLimit) {
			if ($sJob == 'import') {
				$sResult = $oBrightcove->import($iOffset, $iBatch);
			} else if ($sJob == 'update') {
				$sResult = $oBrightcove->update($iOffset, $iBatch);
			}
			//echo '<script>console.log("Page: ' . $iOffset . ': ' . $sResult . '.")</script>';
			$iOffset++;
		}

		$this->template()->assign(array(
			'iOffset' => $iOffset,
			'iTotal' => $iTotal,
			'iTotalVideos' => 1,
			'iTime' => $oBrightcove->endScriptTimer($iStartTime),
			'iPercentage' => round(($iOffset / $iTotal) * 100, 2)
		));

		return 'block';
	}
}

?>





