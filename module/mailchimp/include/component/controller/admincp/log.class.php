<?php

defined('PHPFOX') or exit('NO DICE!');

class Mailchimp_Component_Controller_Admincp_Log extends Phpfox_Component
{

    public function delete()
    {
        // Delete case.
        $sDelete = $this->request()->get('delete');

        if ($sDelete != '')
        {
            if (Phpfox::getService('mailchimp.log.process')->deleteAll())
            {
                $this->url()->send('admincp.mailchimp.log', null, Phpfox::getPhrase('mailchimp.logs_successfully_deleted'));
            }
            else
            {
                $this->url()->send('admincp.mailchimp.log', null, Phpfox::getPhrase('mailchimp.delete_logs_fail'));
            }
        }
    }

    public function process()
    {
        Phpfox::isUser(true);

        $bPing = Phpfox::getService('mailchimp')->ping();

        if (!$bPing)
        {
            Phpfox_Error::set(Phpfox::getPhrase('mailchimp.can_not_connect_to_mailchimp'));
        }

        $this->delete();

        $this->template()
            ->setTitle(Phpfox::getPhrase('mailchimp.log_browse'))
            ->setBreadcrumb(Phpfox::getPhrase('mailchimp.log_browse'), $this->url()->makeUrl('admincp.mailchimp.log'));

        // Get current page.
        $iPage = $this->request()->getInt('page');

        // Get array of limit.
        $aPages = array(5, 10, 15, 20);

        $aDisplays = array();
        foreach ($aPages as $iPageCnt)
        {
            $aDisplays[$iPageCnt] = Phpfox::getPhrase('core.per_page', array('total' => $iPageCnt));
        }

        // Config the sort conditions.
        $aSorts = array(
            'mailchimplog_id' => Phpfox::getPhrase('mailchimp.id'),
            'description' => Phpfox::getPhrase('mailchimp.description'),
            'created_at' => Phpfox::getPhrase('core.time')
        );

        // Compose the filter.
        $aFilters = array(
            'description' => array(
                'type' => 'input:text',
                'search' => "AND l.description LIKE '%[VALUE]%'"
            ),
            'display' => array(
                'type' => 'select',
                'options' => $aDisplays,
                'default' => '10'
            ),
            'sort' => array(
                'type' => 'select',
                'options' => $aSorts,
                'default' => 'mailchimplog_id',
                'alias' => 'l'
            ),
            'sort_by' => array(
                'type' => 'select',
                'options' => array(
                    'DESC' => Phpfox::getPhrase('core.descending'),
                    'ASC' => Phpfox::getPhrase('core.ascending')
                ),
                'default' => 'DESC'
            )
        );

        $aSearchConfig = array(
            'type' => 'mailchimp',
            'filters' => $aFilters,
            'search' => 'search'
        );

        $this->search()->set($aSearchConfig);

        // Get the limit.
        $iLimit = $this->search()->getDisplay();

        list($iCount, $aLogs) = Phpfox::getService('mailchimp.log')->adminGet($this->search()->getConditions(), $this->search()->getSort(), $this->search()->getPage(), $iLimit);

        Phpfox::getLib('pager')->set(array('page' => $iPage, 'size' => $iLimit, 'count' => $this->search()->getSearchTotal($iCount)));

        $aParams = array(
            'aLogs' => $aLogs,
            'iCount' => $iCount
        );

        $this->template()->assign($aParams);

        $this->template()->setPhrase(array('mailchimp.are_you_sure'));
    }

}
