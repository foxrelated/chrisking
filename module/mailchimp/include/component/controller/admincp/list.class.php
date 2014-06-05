<?php

defined('PHPFOX') or exit('NO DICE!');

class Mailchimp_Component_Controller_Admincp_List extends Phpfox_Component{
    public function process()
    {
        Phpfox::isUser(true);

        $bPing = Phpfox::getService('mailchimp')->ping();

        if (!$bPing)
        {
            Phpfox_Error::set(Phpfox::getPhrase('mailchimp.can_not_connect_to_mailchimp'));
        }

        $tab = $this->request()->get('tab');

        $this->template()
            ->setTitle(Phpfox::getPhrase('mailchimp.account_settings'))
            ->setBreadcrumb(Phpfox::getPhrase('mailchimp.account_settings'), $this->url()->makeUrl('admincp.mailchimp.list'));

        if ($tab != 'edit')
        {
            if (isset($_POST['_refresh']))
            {
                Phpfox::getService('mailchimp')->clearCacheAll();
            }

            $aMailChimpLists = Phpfox::getService('mailchimp')->getLists();

            if ($bPing && count($aMailChimpLists) == 0)
            {
                Phpfox_Error::set(Phpfox::getPhrase('mailchimp.there_are_no_subscribe_lists'));
            }

            foreach($aMailChimpLists as $iKey => $aItem)
            {
                $aMailChimpLists[$iKey]['description'] = Phpfox::getService('mailchimp')->word_limiter($aItem['description'], 50);

                $aGroupUsers = Phpfox::getService('mailchimp')->getGroupsByListId($aItem['id']);

                $aMailChimpLists[$iKey]['groups_name'] = '';

                $aTemp = array();
                foreach($aGroupUsers as $aGroupUser)
                {
                    $aTemp[] = $aGroupUser['title'];
                }

                $aMailChimpLists[$iKey]['groups_name'] = implode(', ', $aTemp);
            }

            $this->template()->assign(array(
                'aMailChimpLists' => $aMailChimpLists,
                'tab' => $tab
            ));
        }

        // settings for tab

        if ($tab == 'edit')
        {
            $listId = $this->request()->get('id');

            /**
             * get post data or array
             */
            $aVals = $this->request()->get('val');

            if ($_POST)
            {
                $aSettings = array(
                    'groups' => isset($aVals['groups']) ? $aVals['groups'] : array(),
                    'fields' => isset($aVals['fields']) ? $aVals['fields'] : array(),
                    'enabled' => isset($aVals['enabled']) ? $aVals['enabled'] : FALSE,
                    'confirm' => isset($aVals['confirm']) ? $aVals['confirm'] : FALSE,
                    'description' => isset($aVals['description']) ? $aVals['description'] : ''
                );

                if ($this->request()->get('_submit'))
                {
                    Phpfox::getService('mailchimp')->updateMapSettings($listId, $aSettings);
                }
                else
                    if ($this->request()->get('_overview'))
                    {

                    }
            }

            /**
             * get current list id
             */
            $aList = Phpfox::getService('mailchimp')->getList($listId);

            // process group mapping for this fields.
            $aUserGroups = Phpfox::getService('mailchimp')->getUserGroups();

            /**
             * a mailchimp fields
             */
            $aMailChimpFields = Phpfox::getService('mailchimp')->getMergeVars($listId);

            if (!is_array($aMailChimpFields))
            {
                $aMailChimpFields = array();
            }

            /**
             * phpfox user fields
             */
            $aPhpfoxUserFields = Phpfox::getService('mailchimp')->getPhpfoxUserFields();

            /**
             * @var bool
             * is check all to group
             */
            $bCheckAll = FALSE;

            $aGroups = isset($aVals['groups']) ? $aVals['groups'] : Phpfox::getService('mailchimp')->getGroupsMap($listId);

            foreach ($aUserGroups as $iKey => $group)
            {
                $aUserGroups[$iKey]['checked'] = FALSE;

                foreach ($aGroups as $group_id)
                {
                    if ($group['user_group_id'] == $group_id)
                    {
                        $aUserGroups[$iKey]['checked'] = TRUE;
                    }
                }
            }

            /**
             * get current mapping for this mailchimp listID
             */
            $aFields = isset($aVals['fields']) ? $aVals['fields'] : Phpfox::getService('mailchimp')->getFieldsMap($listId);

            foreach ($aMailChimpFields as $iKey => $aRow)
            {
                $value = NULL;
                if (isset($aFields[$aRow['tag']]))
                {
                    $value = $aFields[$aRow['tag']];
                }
                $aMailChimpFields[$iKey]['select_html'] = $this->generateFieldSelectBox($aRow['tag'], $value, $aPhpfoxUserFields);
            }

            $bEnalbed = isset($aVals['enabled']) ? $aVals['enabled'] : $aList['enabled'];
            $bConfirm = isset($aVals['confirm']) ? $aVals['confirm'] : $aList['confirm'];
            $sDescription = isset($aVals['description']) ? $aVals['description'] : $aList['description'];
            $this->template()->assign(array(
                'tab' => $tab,
                'checkall' => $bCheckAll,
                'bEnabled' => $bEnalbed,
                'bConfirm' => $bConfirm,
                'aUserGroups' => $aUserGroups,
                'aMailChimpFields' => $aMailChimpFields,
                'aPhpfoxUserFields' => $aPhpfoxUserFields,
                'sDescription' => $sDescription,
                'sListId' => $listId
            ));

            $this->template()->setPhrase(array('mailchimp.overview'));
        }
    }

    function generateFieldSelectBox($tag, $value, $aPhpfoxUserFields)
    {
        $str = '<select name=val[fields][' . $tag . ']">';
        foreach ($aPhpfoxUserFields as $key => $label)
        {
            $str .= strtr('<option value=":key" :selected>:label</option>', array(
                ':label' => $label,
                ':key' => $key,
                ':selected' => ($key == $value ? 'selected="selected"' : ''),
            ));
        }
        $str .= '</select>';
        return $str;
    }
}

?>