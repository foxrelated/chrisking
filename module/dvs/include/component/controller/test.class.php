<?php

class Dvs_Component_Controller_Test extends Phpfox_Component {
    public function process() {
        $sDvsName = 'showroomtest';
        $iYear = '2013';

        // Get the DVS details based off the DVS name.
        $aDvs = Phpfox::getService('dvs')->get($sDvsName, true);
        $aPlayer = Phpfox::getService('dvs.player')->get($aDvs['dvs_id']);

        // Get all of the makes for the DVS for the selected year.
        $aMakes = Phpfox::getService('dvs.video')->getValidVSMakes($iYear, $aPlayer['makes']);

        // Did we get more than one make?
        if (count($aMakes) === 1) {
            // Yes, make the only make selected by default.
            $sSelectOptions = '<li class="init"><span class="init_selected">' . $aMakes[0]['make'] . '</span><ul>';
        } else {
            // The first list item should be one to tell the user to select a make.
            $sSelectOptions = '<li class="init"><span class="init_selected">' . Phpfox::getPhrase('dvs.select_make') . '</span><ul>';
        }

        // Build the ul list items
        foreach ($aMakes as $aMake) {
            $sSelectOptions .= '<li onclick="$.ajaxCall(\'dvs.getShareModels\', \'iYear=' . $iYear . '&amp;sMake=' . $aMake['make'] . '\');">' . $aMake['make'] . '</li>';
        }

        $sSelectOptions .= '</ul></li>';

        $aShareVideos = Phpfox::getService('dvs.video')->getShareVideos($aDvs['dvs_id'], $iYear, $aPlayer['makes'], '');

        $this->template()->assign(array(
            'aDvs' => $aDvs,
            'aShareVideos' => $aShareVideos
        ));
    }
}
?>