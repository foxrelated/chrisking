<?php

defined('PHPFOX') or exit('NO DICE!');

class Mailchimp_Component_Controller_Admincp_Subscribe extends Phpfox_Component
{
    /**
     *
     * @var Pagination
     */
    public $oPagination;

    /**
     * Keep filter.
     */
    public function setSession()
    {
        if ($this->request()->get('filter') != '')
        {
            Phpfox::getLib('session')->set('sListId', $this->request()->get('sListId'));
            Phpfox::getLib('session')->set('sStatus', $this->request()->get('sStatus', 'subscribed'));
            Phpfox::getLib('session')->set('iPageSize', $this->request()->getInt('iPageSize', 5));
        }
    }

    /**
     * Get the pagination for this page.
     * @return object Pagination
     */
    public function getPagination()
    {
        if ($this->oPagination == NULL)
        {
            if (!class_exists('Pagination', FALSE))
            {
                require_once PHPFOX_DIR_MODULE . 'mailchimp' . PHPFOX_DS . 'include' . PHPFOX_DS . 'service' . PHPFOX_DS . 'pagination.php';
            }

            $this->oPagination = new Pagination();
        }

        return $this->oPagination;
    }

    public function process()
    {
        Phpfox::isUser(true);

        $bPing = Phpfox::getService('mailchimp')->ping();

        if (!$bPing)
        {
            Phpfox_Error::set(Phpfox::getPhrase('mailchimp.can_not_connect_to_mailchimp'));
        }

        $this->setSession();

        $this->configTemplate();

        $iPage = $this->request()->getInt('page', 1);
        $sListId = Phpfox::getLib('session')->get('sListId');
        $sStatus = Phpfox::getLib('session')->get('sStatus', 'subscribed');

        $iPageSize = Phpfox::getLib('session')->get('iPageSize', 50);

        if ($iPageSize < 50)
            $iPageSize = 50;

        // Get all subscribe list.
        $aLists = Phpfox::getService('mailchimp')->getLists();

        // Validate the list.
        if (!is_array($aLists))
        {
            $aParams = array(
                'sMessage' => Phpfox::getPhrase('mailchimp.there_is_no_list'),
                'aLists' => false,
                'aSubcribe' => false,
                'iPageSize' => $iPageSize,
                'sStatus' => $sStatus,
                'iTotal' => 0
            );

            $this->template()->assign($aParams);
            return;
        }

        // Get the first list id. Default value.
        if (count($aLists) > 0)
        {
            $bHasDefault = false;

            foreach($aLists as $iKey => $aList)
            {
                if ($aList['id'] == $sListId)
                {
                    $aLists[$iKey]['bIsSelected'] = true;

                    $bHasDefault = true;
                }
                else
                {
                    $aLists[$iKey]['bIsSelected'] = false;
                }
            }

            // Set default.
            if ($bHasDefault == false)
            {
                $sListId = $aLists[0]['id'];
            }
        }

        // Get total.
        $iTotal = Phpfox::getService('mailchimp')->getTotalSubcribeFromMailChimp($sListId, $sStatus);

        // Page count.
        $iPagesCount = ceil($iTotal / $iPageSize);

        // Check the current page.
        $iPage = max(1, min($iPagesCount, $iPage));

        // Get the subcribe list.
        $aSubcribeTotal = Phpfox::getService('mailchimp')->getSubcribeFromMailChimp($sListId, $sStatus, $iPage, $iPageSize);

        // Validate the list.
        if (!is_array($aSubcribeTotal) || $aSubcribeTotal['total'] == 0)
        {
            $aParams = array(
                'sMessage' => Phpfox::getPhrase('mailchimp.this_list_has_no_subscribe'),
                'aLists' => $aLists,
                'aSubcribe' => false,
                'iPageSize' => $iPageSize,
                'sStatus' => $sStatus,
                'iTotal' => 0
            );

            $this->template()->assign($aParams);

            return;
        }

        // Get data.
        $aSubscribe = $aSubcribeTotal['data'];

        foreach($aSubscribe as $iKey => $aItem)
        {
            $aSubscribe[$iKey]['number'] = $iKey + 1 + ($iPage - 1) * $iPageSize;
        }

        // Config for pagination.
        $aParams = array('page' => $iPage, 'size' => $iPageSize, 'count' => $iTotal);
        $this->getPagination()->set($aParams);

        // Assign variable.
        $aParams = array(
            'aLists' => $aLists,
            'aSubcribe' => $aSubscribe,
            'iPageSize' => $iPageSize,
            'sStatus' => $sStatus,
            'iTotal' => $iTotal
        );
        $this->template()->assign($aParams);
    }

    public function configTemplate()
    {
        $this->template()->assign(array('sMessage' => ''));

        $this->template()->setTitle(Phpfox::getPhrase('mailchimp.admin_menu_manager_list'));

        $this->template()->setBreadcrumb(Phpfox::getPhrase('mailchimp.admin_menu_manager_list'), $this->url()->makeUrl('admincp.mailchimp.subscribe'));
    }

}
