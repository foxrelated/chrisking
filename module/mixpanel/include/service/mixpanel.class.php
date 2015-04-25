<?php

class Mixpanel_Service_Mixpanel extends Phpfox_Service {
    function __construct() {
        $this->_sTable = Phpfox::getT('user');
    }

    public function get($iUserId) {
        $aUser = $this->database()
            ->select('u.user_id, u.user_name, u.full_name, u.email, u.joined, u.last_login, ug.title AS user_group_title, uf.first_name, uf.last_name')
            ->from($this->_sTable, 'u')
            ->leftJoin(Phpfox::getT('user_group'), 'ug', 'u.user_group_id = ug.user_group_id')
            ->leftJoin(Phpfox::getT('user_field'), 'uf', 'u.user_id = uf.user_id')
            ->where('u.user_id = ' . (int)$iUserId)
            ->execute('getRow');

        // process user first name/last name issue.
        if (empty($aUser['first_name']) && empty($aUser['last_name'])) {
            $aUser['first_name'] = '';
            $aUser['last_name'] = '';
            preg_match('/(.*) (.*)/', $aUser['full_name'], $aNameMatches);
            if (isset($aNameMatches[1]) && isset($aNameMatches[2])) {
                $aUser['first_name'] = $aNameMatches[1];
                $aUser['last_name'] = $aNameMatches[2];
            } else {
                $aUser['first_name'] = $aUser['full_name'];
                $aUser['last_name'] = '';
            }
        }

        return $aUser;
    }
}
?>