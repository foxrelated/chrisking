<?php

defined('PHPFOX') or exit('NO DICE!');

class Mailchimp_Component_Controller_Admincp_Stats extends Phpfox_Component
{

    public function process()
    {
        Phpfox::isUser(true);

        $bPing = Phpfox::getService('mailchimp')->ping();

        if (!$bPing)
        {
            Phpfox_Error::set(Phpfox::getPhrase('mailchimp.can_not_connect_to_mailchimp'));
        }

        $aChimpLists = Phpfox::getService('mailchimp')
            ->getMailChimpApi()
            ->lists -> getList($filters = array(), $start = 0, $limit = 100);

        $aListData = Phpfox::getService('mailchimp')->getLists($bNoCache = false);

        $aCheckList = array();
        foreach($aListData as $aItem)
        {
            $aCheckList[$aItem['id']] = $aItem['total_request'];
        }

        if (isset($aChimpLists['data']))
        {
            foreach($aChimpLists['data'] as $iKey => $aList)
            {
                if (isset($aCheckList[$aList['id']]))
                {
                    $aChimpLists['data'][$iKey]['total_request'] = $aCheckList[$aList['id']];
                }
            }
        }

        $this->template()
            ->setTitle(Phpfox::getPhrase('mailchimp.stats_1'))
            ->setBreadcrumb(Phpfox::getPhrase('mailchimp.stats_1'), $this->url()->makeUrl('admincp.mailchimp.stats'));

        $this->template()->assign('aLists', $aChimpLists['data']);
    }

}
