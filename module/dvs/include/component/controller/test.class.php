<?php

class Dvs_Component_Controller_Test extends Phpfox_Component {
    public function process() {
        if($this->request()->get('import')) {
            Phpfox::getService('dvs.inventory')->importFile();
            echo 'Import Completed';
            exit;
        }

        if($this->request()->get('update') == 'style') {
            Phpfox::getService('dvs.inventory')->updateEdStyleId();
            $bReturn = Phpfox::getService('dvs.inventory')->getPending('style');
            echo 'Pending : ' . $bReturn;
            exit;
        }

        if($this->request()->get('update') == 'video') {
            Phpfox::getService('dvs.inventory')->updateReferenceId();
            $bReturn = Phpfox::getService('dvs.inventory')->getPending('video');
            echo 'Pending : ' . $bReturn;
            exit;
        }

        echo 'No actions!';
        exit;

        //Phpfox::getService('dvs.inventory')->updateEdStyleId();

        //Phpfox::getService('dvs.inventory')->updateReferenceId(30);


        // Get the variables from the ajax call.
        //$sDvsName = 'showroomtest';
        //$iYear = '2008';

        // Get the DVS details based off the DVS name.
        //$aDvs = Phpfox::getService('dvs')->get($sDvsName, true);
        //$aPlayer = Phpfox::getService('dvs.player')->get($aDvs['dvs_id']);

        // Get all of the makes for the DVS for the selected year.
        //$aMakes = Phpfox::getService('dvs.video')->getValidVSMakesByDealer($iYear, $aPlayer['makes'], $aDvs['dealer_id']);
        //vdd($aMakes);
    }
}
?>