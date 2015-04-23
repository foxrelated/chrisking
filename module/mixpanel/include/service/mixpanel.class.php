<?php

class Mixpanel_Service_Mixpanel extends Phpfox_Service {
    function __construct() {
        $this->_sTable = Phpfox::getT('user');
    }

    public function get($iUserId) {
        $aUser = $this->database()
            ->select('u.full_name')
            ->from($this->_sTable, 'u')
            ->where('u.user_id = ' . (int)$iUserId)
            ->execute('getRow');

        return $aUser;
    }
}
?>