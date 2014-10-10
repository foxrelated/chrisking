<?php

class Dvs_Component_Controller_Test extends Phpfox_Component {
    public function process() {
        //Phpfox::getService('dvs.inventory')->importFile();

        //Phpfox::getService('dvs.inventory')->updateEdStyleId();

        //Phpfox::getService('dvs.inventory')->updateReferenceId(30);


        // Get the variables from the ajax call.
        $sDvsName = 'showroomtest';
        $iYear = '2008';

        // Get the DVS details based off the DVS name.
        $aDvs = Phpfox::getService('dvs')->get($sDvsName, true);
        $aPlayer = Phpfox::getService('dvs.player')->get($aDvs['dvs_id']);

        // Get all of the makes for the DVS for the selected year.
        $aMakes = Phpfox::getService('dvs.video')->getValidVSMakesByDealer($iYear, $aPlayer['makes'], $aDvs['dealer_id']);
        vdd($aMakes);
    }
}
?>