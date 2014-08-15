<?php

class Dvs_Service_Manager_Process extends Phpfox_Service {
    function __construct() {
        $this->_sTable = Phpfox::getT('ko_dvs_managersteam');
    }

    public function add($iDvsId, $iUserId) {
        $iManagersteamId = $this->database()->insert($this->_sTable, array(
            'dvs_id' => (int) $iDvsId,
            'user_id' => (int) $iUserId
        ));

        return $iManagersteamId;
    }

    /**
     * Removes a manager team member from the list of managersteams as well as from any user who has selected this managersteam
     *
     * @param int $iTeamMemberId
     */
    public function remove($iTeamMemberId)
    {
        $this->database()->delete($this->_sTable, 'managersteam_id = ' . (int) $iTeamMemberId);
    }

    /**
     * Add a manager team member
     *
     * @param int $iDvsId
     * @param int $iUserId
     * @return int, salesteam id
     */
    public function inviteManagerChange($iUserId,$Email)
    {
        $aInvites = $this->database()->select('i.*')
            ->from(Phpfox::getT('ko_dvs_salesteam_invites'),'i')
            ->where('i.email_address = "'. $Email.'" AND i.manager_invite = 1')
            ->execute('getSlaveRow');

        $iManagerTeamId = $this->database()->insert($this->_sTable, array(
            'dvs_id' => (int) $aInvites['dvs_id'],
            'user_id' => (int) $iUserId
        ));

        $this->database()->delete(Phpfox::getT('ko_dvs_salesteam_invites'), 'invite_id = ' . (int) $aInvites['invite_id']);

        Phpfox::setCookie('managersteam_invite', 0, '-1');
        return true;
    }
}
?>