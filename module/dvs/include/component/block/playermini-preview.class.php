<?php

/**
 * [PHPFOX_HEADER]
 */
defined('PHPFOX') or exit('No direct script access allowed.');

/**
 *
 *
 * @copyright   Konsort.org
 * @author      Konsort.org
 * @package     DVS
 */
class Dvs_Component_Block_Playermini_Preview extends Phpfox_Component {
    public function process() {
        $aVals = $this->request()->getArray('val');
        $aValsClean = array();

        foreach ($aVals as $sKey => $sVal) {
            $sKey = str_replace('_', '-', $sKey);
            $aValsClean[$sKey] = $sVal;
        }

        $aValsClean['logo-branding-url'] = '';

        $sMakes = '';

        if(isset($aVals['selected_makes'])) {
            foreach ($aVals['selected_makes'] as $sMake => $bSelected) {
                if ($bSelected) {
                    $sMakes .= $sMake . ',';
                }
            }
        }

        $sVideoTitleUrl = $this->getParam('video_title_url', '');

        $aValsClean['selected-makes'] = rtrim($sMakes, ',');

        $sUrl = 'dvs.view.preview.' . $aVals['dvs_id'];

        if($sVideoTitleUrl) {
            $aValsClean['video-title-url'] = $sVideoTitleUrl;
        }

        $sIframeUrl = Phpfox::getLib('url')->makeUrl($sUrl, $aValsClean);

        if(Phpfox::getService('dvs')->getBrowser() == 'mobile') {
            $aVals['player_type'] = 'mobile';
        }

        if( isset($aVals['shorturl']) and !empty($aVals['shorturl']) ) {
            if( Phpfox::getParam('dvs.enable_subdomain_mode') ) {
                $sIframeUrl = Phpfox::getLib('url')->makeUrl( 'www' ) . $aVals['shorturl'].'/bc_refid';
            } else {
                $sIframeUrl = Phpfox::getLib('url')->makeUrl( '' ) . $aVals['shorturl'].'/bc_refid';
            }
        }

        $this->template()->assign(array(
            'aVals' => $aVals,
            'sIframeUrl' => $sIframeUrl,
        ));
    }
}

?>