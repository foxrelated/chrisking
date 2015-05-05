<?php

class Dvs_Service_Blacklists extends Phpfox_Service {

    function __construct() {
        $this->_sTable = Phpfox::getT('ko_dvs_blacklists');
    }

    public function getAllDomain()
    {
        return $this->database()->select("*")
            ->from($this->_sTable)
            ->execute('getSlaveRows');
    }

    public function getForCheck()
    {
        return $this->database()->select("domain")
            ->from($this->_sTable)
            ->execute('getSlaveRows');
    }
    public function add($aVals = array())
    {
    	 $aInsert = array(
            'name' => isset($aVals['name'])? $aVals['name']: "",
            'domain' => isset($aVals['domain'])? $aVals['domain']: ""

        );
        $iId = $this->database()->insert($this->_sTable, $aInsert);

        return $iId;
    }

    public function update($iID = 0, $aVals = array())
    {

        $aUpdate = array(
            'name' => isset($aVals['name'])? $aVals['name']: "",
            'domain' => isset($aVals['domain'])? $aVals['domain']: ""

        );
        $bUpdate = $this->database()->update($this->_sTable, $aUpdate, 'id = '.(int)$iID);
        return $bUpdate;
    }

    public function getById($iId)
    {
        return $this->database()->select("*")
            ->from($this->_sTable)
            ->where('id = '.(int)$iId)
            ->execute('getSlaveRow');
    }

    public function remove($iId)
    {
        return $this->database()->delete($this->_sTable, 'id = '.(int)$iId);
    }

}

?>