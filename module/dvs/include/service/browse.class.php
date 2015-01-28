<?php

class Dvs_Service_Browse extends Phpfox_Service {
    public function __construct() {
        $this->_sTable = Phpfox::getT('ko_dvs');
    }

    public function query() {

    }

    public function getQueryJoins($bIsCount = false, $bNoQueryFriend = false) {
        if($bIsCount) {
            $this->database()->join(Phpfox::getT('user'), 'u', 'dvs.user_id = u.user_id AND u.user_name IS NOT NULL');
        }

        if($sMake = $this->request()->get('make')) {
            if(!$bIsCount) {
                $this->database()->select('dmake.pmake_id, ');
            }

            $sMakeSpace = str_replace('-', ' ', $sMake);

            $this->database()
                ->leftJoin(Phpfox::getT('ko_dvs_players'), 'dplayers', 'dvs.dvs_id = dplayers.dvs_id')
                ->leftJoin(Phpfox::getT('ko_dvs_player_makes'), 'dmake', 'dmake.player_id = dplayers.player_id AND (dmake.make = \'' . $sMake . '\' OR dmake.make = \'' . $sMakeSpace . '\')');
        }
    }
}
?>