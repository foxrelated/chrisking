<?php

class Mailchimp_Service_Log_Log extends Phpfox_Service
{
    
    public function getAllLogs()
    {
        $aLogs = Phpfox::getLib('database')
                ->select('l.*')
                ->from(Phpfox::getT('mailchimp_log'), 'l')
                ->order('l.mailchimplog_id DESC')
                ->execute('getSlaveRows');
        
        return $aLogs;
    }

    public function adminGet($aConds, $sSort = 'l.created_at ASC', $iPage = '', $iLimit = '')
    {
        Phpfox::getLib('database')->select('COUNT(l.mailchimplog_id)');
        Phpfox::getLib('database')->from(Phpfox::getT('mailchimp_log'), 'l');
        Phpfox::getLib('database')->where($aConds);
        Phpfox::getLib('database')->order($sSort);
        
        $iCount = Phpfox::getLib('database')->execute('getSlaveField');

        $aItems = array();

        if ($iCount > 0)
        {
            Phpfox::getLib('database')->select('l.*');
            Phpfox::getLib('database')->from(Phpfox::getT('mailchimp_log'), 'l');
            Phpfox::getLib('database')->where($aConds);
            Phpfox::getLib('database')->order($sSort);
            Phpfox::getLib('database')->limit($iPage, $iLimit, $iCount);
            
            $aItems = Phpfox::getLib('database')->execute('getSlaveRows');
        }

        return array($iCount, $aItems);
    }

}
