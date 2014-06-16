<?php

    Phpfox::getLibClass('phpfox.mail.interface');

class Mailchimp_Service_Mailchimp extends Phpfox_Service
{
    protected $_mailchimpApi = NULL;
    protected $_lists = NULL;
    protected $_mergevars = array();
    protected $_skipCache = FALSE;
    protected $_fieldsMap = NULL;
    protected $_listMap = NULL;
    protected $_groupMap = NULL;
    protected $_usersFields = NULL;
    protected static $_aCaches = array('lists' => 'mailchimp_lists');

    function clearCacheAll()
    {
        foreach (self::$_aCaches as $sKey)
        {
            $this -> cache() -> remove($sKey);
        }
    }

    /**
     * @return MCAPI
     */
    public function getMailChimpApi()
    {
        if ($this -> _mailchimpApi == NULL)
        {
            if (!class_exists('MCAPI', FALSE))
            {
                require_once dirname(__FILE__) . '/api/Mailchimp.php';
            }

            // retry setting
            $sKey = Phpfox::getParam('mailchimp.api_key');
            $bSecure = Phpfox::getParam('mailchimp.secure');

            $this -> _mailchimpApi = new Mailchimp($sKey);
        }

        return $this -> _mailchimpApi;
    }

    /**
     * use this method to reset api for new configure.
     * @param MCAPI|NULL
     * @return Mailchimp_Service_Mailchimp
     */
    public function setMailChimpApi($api = NULL)
    {
        $this -> _mailchimpApi = NULL;
        return $this;
    }


    /**
     * test connection
     * @return bool
     */
    function ping()
    {
        return $this -> getMailChimpApi() -> helper ->ping();
    }

    /**
     * @see MCAPI::lists
     * @return mailchimp list
     */
    function getLists($bNoCache = false)
    {
        $sTable = Phpfox::getT('mailchimp_list');

        if ($bNoCache == true)
            $this -> _lists = null;

        if (NULL == $this -> _lists)
        {
            // use cache to improve performance
            if (FALSE == $this -> _skipCache && $bNoCache == false)
            {
                $sKey = $this -> cache() -> set(self::$_aCaches['lists']);
                $data = $this -> cache() -> get($sKey);

                if (is_array($data))
                {
                    return $this -> _lists = $data;
                }
            }

            // buck performance
            $response = $this -> getMailChimpApi() -> lists ->getList($filters = array(), $start = 0, $limit = 100);

            if ($response['total'])
            {
                // update database settings.
                $maps = array();
                foreach ($response['data'] as $data)
                {

                    $id = $data['id'];
                    $sCond = "id='{$id}'";
                    $name = $data['name'];

                    $aRow = $this -> database() -> select('*') -> from($sTable) -> where($sCond) -> execute('getSlaveRow');

                    if ($aRow)
                    {
                        $this -> database() -> update($sTable, array(
                            'name' => $name,
                            'subscribe_url_short' => $data['subscribe_url_short'],
                            'subscribe_url_long' => $data['subscribe_url_long']
                        ), $sCond);
                    }
                    else
                    {
                        $this -> database() -> insert($sTable, array(
                            'id' => $id,
                            'name' => $name,
                            'enabled' => 0,
                            'subscribe_url_short' => $data['subscribe_url_short'],
                            'subscribe_url_long' => $data['subscribe_url_long'],
                        ));
                    }

                    $maps[] = "'{$id}'";
                }

                // update all old fields
                $lists = implode(',', $maps);

                if ($lists)
                {
                    $this -> database() -> delete(Phpfox::getT('mailchimp_list'), "id NOT IN ($lists)");
                    $this -> database() -> delete(Phpfox::getT('mailchimp_field_map'), "list_id NOT IN ($lists)");
                    $this -> database() -> delete(Phpfox::getT('mailchimp_list_map'), "list_id NOT IN ($lists)");
                }
            }

            $data = $this -> database() -> select('*') -> from($sTable) -> execute('getSlaveRows');

            $sKey = $this -> cache() -> set(self::$_aCaches['lists']);
            $this -> cache() -> save($sKey, $data);
            $this -> _lists = $data;
        }

        return $this -> _lists;
    }

    public function word_limiter($str, $limit = 100, $end_char = '&#8230;')
    {
        if (trim($str) == '')
        {
            return $str;
        }

        preg_match('/^\s*+(?:\S++\s*+){1,' . (int)$limit . '}/', $str, $matches);

        if (strlen($str) == strlen($matches[0]))
        {
            $end_char = '';
        }

        return rtrim($matches[0]) . $end_char;
    }

    function getGroupsByListId($sListId)
    {
        $aRows = $this -> database() -> select('ug.title') -> from(Phpfox::getT('user_group'), 'ug') -> leftJoin(Phpfox::getT('mailchimp_list_map'), 'lm', 'lm.group_id = ug.user_group_id') -> where('lm.list_id = "' . $sListId . '" AND lm.enabled = 1') -> execute('getSlaveRows');

        return $aRows;
    }

    /**
     * @return array
     */
    function getUserGroups()
    {
        //$aRows = $this -> database() -> select('*') -> from(Phpfox::getT('user_group')) -> execute('getSlaveRows');
        $aRows = Phpfox::getService('user.group') -> get('1');

        $maps = array();

        foreach ($aRows as $iKey => $aRow)
        {

            $id = $aRow['user_group_id'];
            if (isset($maps[$id]))
            {
                unset($aRows[$iKey]);
            }
            else
            {
                $maps[$id] = 1;
                $aRows[$iKey]['user_count'] = $this -> database() -> select('count(*)') -> from(Phpfox::getT('user')) -> where("user_group_id='{$id}' AND email is not NULL") -> execute('getField');
            }
        }
        return $aRows;
    }

    /**
     * process get detail of merge vars
     * @see  MCAPI::listMergeVals($id)
     * @param string $listId
     * @return array
     */
    function getMergeVars($listId)
    {
        if (!isset($this -> _mergevars[$listId]))
        {
            $aTemp = $this -> getMailChimpApi() -> lists -> mergeVars(array($listId));
            $this -> _mergevars[$listId] = $aTemp['data'][0]['merge_vars'];
        }
        return $this -> _mergevars[$listId];
    }

    /**
     *
     */
    function getPhpfoxUserFields()
    {
        if (NULL == $this -> _usersFields)
        {
            $this -> _usersFields = array(
                'none' => '',
                'user_id' => 'User ID',
                'email' => 'Email',
                'user_name' => 'User Name',
                'full_name' => 'Full Name',
                'first_name' => 'First Name',
                'last_name' => 'Last Name',
                'birthday' => 'Birthday',
                'gender' => 'Gender',
                'group_name' => 'Group Name', // Fixes DRQ-307282
            );

            $aRows = $this -> database() -> select('*') -> from(Phpfox::getT('custom_field')) -> execute('getSlaveRows');

            foreach ($aRows as $aRow)
            {
                $key = 'cf_' . $aRow['field_name'];
                $label = Phpfox::getPhrase($aRow['phrase_var_name']);
                $this -> _usersFields[$key] = $label;
            }
        }
        return $this -> _usersFields;
    }

    /**
     * @param  string  $sListId
     * @param  int     $iLastUserId
     * @param  int     $limit
     * @return array
     */
    function fetchUsers($sListId, $iLastUserId = 0, $iLimit = 500)
    {
        $aGroups = $this -> getGroupsMap($sListId);

        // Get group 0 as default.
        $aGroups[] = 0;

        $sCond = ' u.user_group_id IN(' . implode(',', $aGroups) . ') AND u.user_id > ' . (int)$iLastUserId;

        $sCond .= ' AND u.email is not NULL';

        $query = $this -> database() -> select('cf.*,uf.*,u.*,ug.title as group_name') -> from(Phpfox::getT('user'), 'u') -> leftjoin(Phpfox::getT('user_field'), 'uf', 'uf.user_id=u.user_id') -> leftjoin(Phpfox::getT('user_custom'), 'cf', 'cf.user_id=u.user_id') -> leftjoin(Phpfox::getT('user_group'), 'ug', 'u.user_group_id=ug.user_group_id') -> order('u.user_id');

        $query -> where($sCond) -> limit(0, $iLimit);

        $aUsers = $query -> execute('getSlaveRows');

        if($aUsers)
        {
            foreach($aUsers as $index=>$aUser)
            {
                $cfgs = $this->getMultiOptionsOfCustomFieldForUser($aUser['user_id']);

                if($cfgs){
                    foreach($cfgs as $cfg){
                        $aUser[$index][$cfg['field_name']] =  Phpfox::getPhrase($cfg['phrase_var_name']);
                    }
                }

            }
        }
        return $aUsers;
    }

    /**
     * get group id that associate with list
     * @return array
     */
    function getGroupsMap($listId)
    {
        if (NULL == $this -> _groupMap)
        {
            $aRows = $this -> database() -> select('*') -> from(Phpfox::getT('mailchimp_list_map')) -> where('enabled=1') -> execute('getSlaveRows');

            foreach ($aRows as $aRow)
            {
                $this -> _groupMap[$aRow['list_id']][] = $aRow['group_id'];
            }
        }

        if (isset($this -> _groupMap[$listId]))
        {
            return $this -> _groupMap[$listId];
        }
        return array();
    }

    public function getMergeTagsForUser($sListId, $aUser)
    {
        $aMergeTags = array();

        $aFields = $this -> getFieldsMap($sListId);

        // process user first name/last name issue.
        if (!isset($aUser['first_name']) && !isset($aUser['last_name']) && !isset($aUser['full_name']))
        {
            $aParts = explode(' ', $aUser['full_name'], 2);

            if (isset($aParts[0]))
            {
                $aUser['first_name'] = $aParts[0];
            }
            if (isset($aParts[1]))
            {
                $aUser['last_name'] = $aParts[1];
            }
        }

        // remap users
        foreach ($aFields as $k1 => $k2)
        {
            $aMergeTags[$k2] = isset($aUser[$k2]) ? $aUser[$k2] : '';
        }

        return $aMergeTags;
    }

    /**
     * @param string $listId
     * @param array $aVals
     * @return void
     */
    function updateMapSettings($listId, $aVals)
    {
        // delete old data then create new one.
        $this -> database() -> delete(Phpfox::getT('mailchimp_list_map'), "list_id='{$listId}'");

        // insert new row
        $enabledGroups = $aVals['groups'];
        $enabled = $aVals['enabled'];
        $confirm = $aVals['confirm'];

        if ($enabledGroups)
        {
            foreach ($enabledGroups as $group_id)
            {
                $bResult = $this -> database() -> insert(Phpfox::getT('mailchimp_list_map'), array(
                    'list_id' => $listId,
                    'group_id' => $group_id,
                    'enabled' => 1
                ));
            }
        }

        // update enable setting
        $this -> database() -> update(Phpfox::getT('mailchimp_list'), array(
            'enabled' => $enabled,
            'confirm' => $confirm,
            'description' => $aVals['description'],
            'last_user_id' => 0
        ), "id='{$listId}'");

        // field mapping
        // delete old data then create new one.
        $this -> database() -> delete(Phpfox::getT('mailchimp_field_map'), "list_id='{$listId}'");

        $fields = $aVals['fields'];

        // auto append required field: email to
        $fields['EMAIL'] = 'email';

        // insert new row
        foreach ($fields as $mailchimp_tag => $phpfox_field)
        {
            if ($phpfox_field != '' && $phpfox_field != 'none')
            {
                $this -> database() -> insert(Phpfox::getT('mailchimp_field_map'), array(
                    'list_id' => $listId,
                    'mailchimp_tag' => $mailchimp_tag,
                    'phpfox_field' => $phpfox_field
                ));
            }
        }

        // Get list infor.
        $aList = $this -> getListByListId($listId);

        $sListName = isset($aList['name']) ? $aList['name'] : $listId;

        Phpfox::getService('mailchimp.log.process') -> add('Update merge tags in the list: ' . $sListName);

        $this -> clearCacheAll();
    }

    public function getListByListId($sListId)
    {
        $aLists = $this -> getLists();

        foreach ($aLists as $aItem)
        {
            if ($aItem['id'] == $sListId)
                return $aItem;
        }

        return array();
    }

    function fetchUserByUserId($sListId, $iUserId)
    {
        $aGroups = $this -> getGroupsMap($sListId);

        // Get group 0 as default.
        $aGroups[] = 0;

        $sCond = ' u.user_group_id IN(' . implode(',', $aGroups) . ') AND u.user_id = ' . (int)$iUserId;

        $sCond .= ' AND u.email is not NULL';

        $query = $this -> database() -> select('cf.*,uf.*,u.*,ug.title as group_name') -> from(Phpfox::getT('user'), 'u') -> leftjoin(Phpfox::getT('user_field'), 'uf', 'uf.user_id=u.user_id') -> leftjoin(Phpfox::getT('user_custom'), 'cf', 'cf.user_id=u.user_id') -> leftjoin(Phpfox::getT('user_group'), 'ug', 'u.user_group_id=ug.user_group_id') -> order('u.user_id');

        $query -> where($sCond);

        $aUser =   $query -> execute('getSlaveRow');

        if($aUser)
        {

            $cfgs = $this->getMultiOptionsOfCustomFieldForUser($aUser['user_id']);
            if($cfgs){
                foreach($cfgs as $cfg){
                    $aUser[$cfg['field_name']] =  Phpfox::getPhrase($cfg['phrase_var_name']);
                }
            }
        }

        return $aUser;
    }

    /**
     * WARNING: called by cron job
     * @return void
     */
    function doBatchSubscribe()
    {
        /**
         * @var bool
         */
        $bUpdateExist = TRUE;
        // yes, update currently subscribed users

        /**
         * @var bool
         */
        $bReplaceInterest = FALSE;
        // no, add interest, don't replace

        $iLimit = Phpfox::getParam('mailchimp.limit_subscribe_sent');
        /**
         * @var array
         */
        $aAllLists = $this -> getAvailableListsForCronJob();

        $count = 0;

        foreach ($aAllLists as $aList)
        {
            // Get users
            $aUsers = $this -> fetchUsers($aList['id'], $aList['last_user_id'], $iLimit);

            $count += count($aUsers);

            if (!$aUsers)
            {
                continue;
            }

            // Get batch data.
            $aBatch = $this -> getMapUserData($aList['id'], $aUsers);

            $aResult = $this -> listBatchSubscribe($aList['id'], $aBatch, (bool)$aList['confirm'], $bUpdateExist, $bReplaceInterest);

            // Get the last user to save in last user id.
            $aUser = array_pop($aUsers);

            if ($aResult !== FALSE)
            {
                $this -> updateLastUserIdOfListForCronJob($aList['id'], $aUser['user_id']);
            }

            if ($count >= $iLimit)
            {
                return;
            }
        }

    }

    /**
     * @param string $listId
     * @param array $users array of array
     * @return array
     */
    function getMapUserData($listId, $users)
    {
        $fields = $this -> getFieldsMap($listId);

        $result = array();

        foreach ($users as $user)
        {
            $row = array();
            $row1 = array();

            // process user first name/last name issue.
            if (!isset($user['first_name']) && !isset($user['last_name']))
            {
                $fullName = isset($user['full_name'])?$user['full_name']:'';
                $parts = explode(' ', $fullName, 2);
                if (isset($parts[0]))
                {
                    $user['first_name'] = $parts[0];
                }
                if (isset($parts[1]))
                {
                    $user['last_name'] = $parts[1];
                }
            }

            // remap users
            foreach ($fields as $k1 => $k2)
            {
                if($k2 == 'birthday')
                {
                    $row[$k1] = $this->getMailChimpBirthDay($user[$k2]);
                }else{
                    $row[$k1] = isset($user[$k2]) ? $user[$k2] : '';
                }
            }

            $row1['merge_vars'] = $row;
            $row1['email_type'] = 'text';
            $row1['email'] = array('email' => $user['email']);

            $result[] = $row1;


        }

        return $result;
    }

    /**
     * @param string $listId
     * @param int $iUserId
     * @return array
     */
    function getMapForOneUserData($listId, $iUserId)
    {
        $fields = $this -> getFieldsMap($listId);

        $user= $this->fetchUserByUserId($listId, $iUserId);

        $result = array();

        $row = array();

        // process user first name/last name issue.
        if (!isset($user['first_name']) && !isset($user['last_name']))
        {
            $fullName = isset($user['full_name'])?$user['full_name']:'';
            $parts = explode(' ', $fullName, 2);
            if (isset($parts[0]))
            {
                $user['first_name'] = $parts[0];
            }
            if (isset($parts[1]))
            {
                $user['last_name'] = $parts[1];
            }
        }

        // remap users
        foreach ($fields as $k1 => $k2)
        {
            if($k2 == 'birthday')
            {
                $row[$k1] = $this->getMailChimpBirthDay($user[$k2]);
            }else{
                $row[$k1] = isset($user[$k2]) ? $user[$k2] : '';
            }
        }

        return $row;
    }

    public function getAvailableListforUserToSubscribe()
    {
        $aLists = $this -> getLists();

        $aSubcribeList = $this -> getSubcribeLists();

        $aCheckSubcribeList = array();

        foreach ($aSubcribeList as $sList)
        {
            $aCheckSubcribeList[$sList] = true;
        }

        foreach ($aLists as $iKey => $aList)
        {
            if ($aList['enabled'] == 0)
            {
                unset($aLists[$iKey]);
            }
            elseif (isset($aCheckSubcribeList[$aList['id']]))
            {
                unset($aLists[$iKey]);
            }
            else
            {
                $sExistListId = Phpfox::getLib('session') -> get(Phpfox::getUserId() . $aList['id']);

                if ($sExistListId !== false)
                {
                    unset($aLists[$iKey]);
                }
            }
        }

        return $aLists;
    }

    public function getAllList()
    {
        // Get available list.
        $aLists = $this -> getAvailableListforUserToSubscribe();

        $aSubcribeList = $this -> getSubcribeLists();

        $aCheckSubcribeList = array();

        foreach ($aSubcribeList as $sList)
        {
            $aCheckSubcribeList[$sList] = true;
        }

        foreach ($aLists as $iKey => $aList)
        {
            if ($aList['enabled'] == 0)
            {
                unset($aLists[$iKey]);
            }
            elseif (isset($aCheckSubcribeList[$aList['id']]))
            {
                unset($aLists[$iKey]);
            }
            else
            {
                $aLists[$iKey]['subscribeStatus'] = false;
            }
        }

        return $aLists;
    }


    public function getAvailableListsForCronJob()
    {
        return Phpfox::getLib('database') -> select('l.*') -> from(Phpfox::getT('mailchimp_list'), 'l') -> where('l.enabled = 1') -> order('l.last_time DESC') -> execute('getSlaveRows');
    }

    public function updateLastUserIdOfListForCronJob($sListId, $iLastUserId)
    {
        $this -> database() -> update(Phpfox::getT('mailchimp_list'), array(
            'last_user_id' => $iLastUserId,
            'last_time' => time(),
        ), 'id = "' . $sListId . '"');
    }

    /**
     * Get data for specfic mailchimp list.
     * @param string $sListId List id in MailChimp
     * @return null
     */
    function getList($sListId)
    {
        $aLists = $this -> getLists();

        foreach ($aLists as $aList)
        {
            if ($aList['id'] == $sListId)
            {
                return $aList;
            }
        }

        return NULL;
    }

    /**
     * get mapping fields
     * @return array TAG=>FIELD
     */
    function getFieldsMap($listId)
    {
        // this is not stupid code, it's used when need cacheing and improve performance when we subcribe user to 1/more mailchimp list.
        if (NULL == $this -> _fieldsMap)
        {
            $sTable = Phpfox::getT('mailchimp_field_map');

            $aRows = $this -> database() -> select('*') -> from($sTable) -> execute('getSlaveRows');

            foreach ($aRows as $aRow)
            {
                $this -> _fieldsMap[$aRow['list_id']][$aRow['mailchimp_tag']] = $aRow['phpfox_field'];
            }
        }

        if (isset($this -> _fieldsMap[$listId]))
        {
            return $this -> _fieldsMap[$listId];
        }

        // if there are no map, please return only email mapping only.
        return array('EMAIL' => 'email');
    }

    /**
     * get group id that associate with list
     * @return array
     */
    function getListsMap($groupId)
    {
        if (NULL == $this -> _listMap)
        {
            $sTable = Phpfox::getT('mailchimp_list_map');

            $aRows = $this -> database() -> select('*') -> from($sTable) -> where('enabled=1') -> execute('getSlaveRows');

            foreach ($aRows as $aRow)
            {
                $this -> _listMap[$aRow['group_id']][] = $aRow['list_id'];
            }
        }

        if (isset($this -> _listMap[$groupId]))
        {
            return $this -> _listMap[$groupId];
        }
        return array();
    }

    function getMultiOptionsOfCustomFieldForUser($iUserId)
    {
        //->select("mv.user_id, concat('cf_',cf.field_name) as field_name, co.option_id, co.phrase_var_name")


        $query = $this->database()
            ->select("concat('cf_',cf.field_name) as field_name, co.phrase_var_name")
            ->from(Phpfox::getT('custom_field'),'cf')
            ->leftJoin(Phpfox::getT('custom_option'),'co','co.field_id = cf.field_id')
            ->join(Phpfox::getT('user_custom_multiple_value'),'mv','co.option_id =  mv.option_id')
            ->where("cf.var_type in ('select','checkbox','radio','multiselect') AND user_id=".(int)$iUserId);

        return $query->execute('getSlaveRows');

    }

    /**
     * @param int $iLastUserId
     * @param int $limit
     * @return array
     */
    public function getLastUsersForBatchSubscribe($iLastUserId = 0, $limit = 5000)
    {
        return Phpfox::getLib('database') -> select('u.*') -> from(Phpfox::getT('user'), 'u') -> where('u.user_id > ' . (int)$iLastUserId) -> limit($limit) -> execute('getSlaveRows');
    }


    public function getMailChimpBirthDay($sAge)
    {
        //$iYear = substr($sAge,4);
        $iMonth = substr($sAge,0,2);
        $iDay = substr($sAge,2,2);
        return $iMonth.'/'. $iDay;//. '/'. $iYear;
    }

    public function sendMailWhenAdminChangeGroupUser($iUserId, $aListSubscribeMail)
    {
        if (Phpfox::getParam('mailchimp.send_notification_to_user_when_we_request_user_to_a_list'))
        {
            if (Phpfox::isModule('mail'))
            {
                $this -> sendEmail($iUserId, $aListSubscribeMail, false);
            }
        }
    }

    public function checkEmailExist($iOwnerUserId, $iViewerUserId)
    {
        $aMail = Phpfox::getLib('database') -> select('m.*') -> from(Phpfox::getT('mail'), 'm') -> where('m.owner_user_id = ' . (int)$iOwnerUserId . ' AND m.viewer_user_id = ' . (int)$iViewerUserId) -> execute('getrow');

        if (is_array($aMail) && count($aMail) > 0)
            return true;

        return false;
    }


    public function updateListsWhenAdminUpdateGroupUserId($iUserId)
    {
        $this->updateSubscribeWhenUserChangeProfile($iUserId);
    }

    public function getListsByGroupUserId($iGroupUserId)
    {
        $aLists = Phpfox::getLib('database') -> select('lm.*') -> from(Phpfox::getT('mailchimp_list'), 'l') -> leftJoin(Phpfox::getT('mailchimp_list_map'), 'lm', 'l.id = lm.list_id') -> where('lm.group_id = ' . (int)$iGroupUserId . ' AND l.enabled = 1') -> execute('getrows');

        return $aLists;
    }

    public function getLoginUser($iUserId)
    {
        return Phpfox::getLib('database') -> select('u.*') -> from(Phpfox::getT('user'), 'u') -> where('u.user_id = ' . (int)$iUserId) -> execute('getrow');
    }

    public function getUserByEmail($sEmail)
    {
        return Phpfox::getLib('database') -> select('u.*') -> from(Phpfox::getT('user'), 'u') -> where('u.email = "' . Phpfox::getLib('parse.input') -> clean($sEmail) . '"') -> execute('getrow');
    }

    public function customNotification($sType, $iItemId, $iOwnerUserId, $iSenderUserId)
    {
        if (defined('SKIP_NOTIFICATION'))
        {
            return true;
        }

        $aInsert = array(
            'type_id' => $sType,
            'item_id' => $iItemId,
            'user_id' => $iOwnerUserId,
            'owner_user_id' => $iSenderUserId,
            'time_stamp' => PHPFOX_TIME
        );

        $this -> database() -> insert(Phpfox::getT('notification'), $aInsert);
    }

    public function updateTotalRequestByListId($sListId)
    {
        return Phpfox::getLib('database') -> query('UPDATE ' . PhpFox::getT('mailchimp_list') . ' SET total_request = total_request + 1 WHERE id = "' . Phpfox::getLib('parse.input') -> clean($sListId) . '"');
    }

    public function getUsersByListId($sListId, $iPage = 0, $iLimit = 20)
    {
        Phpfox::getLib('database') -> select('u.user_id, ug.title, u.email, u.full_name');
        Phpfox::getLib('database') -> from(Phpfox::getT('user'), 'u');
        Phpfox::getLib('database') -> leftJoin(Phpfox::getT('mailchimp_list_map'), 'lm', 'u.user_group_id = lm.group_id');
        Phpfox::getLib('database') -> leftJoin(Phpfox::getT('user_group'), 'ug', 'ug.user_group_id = u.user_group_id');
        Phpfox::getLib('database') -> where('lm.list_id = "' . Phpfox::getLib('parse.input') -> clean($sListId) . '"');
        Phpfox::getLib('database') -> limit($iPage, $iLimit);

        $aItems = Phpfox::getLib('database') -> execute('getRows');

        return $aItems;
    }

    public function getTotalUSersByListId($sListId)
    {
        Phpfox::getLib('database') -> select('COUNT(u.user_id)');
        Phpfox::getLib('database') -> from(Phpfox::getT('user'), 'u');
        Phpfox::getLib('database') -> leftJoin(Phpfox::getT('mailchimp_list_map'), 'lm', 'u.user_group_id = lm.group_id');
        Phpfox::getLib('database') -> leftJoin(Phpfox::getT('user_group'), 'ug', 'ug.user_group_id = u.user_group_id');
        Phpfox::getLib('database') -> where('lm.list_id = "' . Phpfox::getLib('parse.input') -> clean($sListId) . '"');

        $aItem = Phpfox::getLib('database') -> execute('getRow');

        foreach ($aItem as $value)
            return $value;

        return 0;
    }

    /**
     * Get the list of subcribes in MailChimp server.
     * @param string $sListId List of subcribes.
     * @return type
     */
    public function getSubcribeFromMailChimp($sListId, $sStatus = 'subscribed', $iPage, $iPageSize)
    {
        return $this -> getMailChimpApi() -> lists -> members($sListId, $sStatus, NULL, $iPage - 1, $iPageSize, 'ASC');
    }

    public function getTotalSubcribeFromMailChimp($sListId, $sStatus = 'subscribed')
    {
        $aTotal = $this -> getMailChimpApi() -> lists -> members($sListId, $sStatus, NULL, 0, 15000, 'ASC');

        if (is_array($aTotal))
            return $aTotal['total'];
        else
            return 0;
    }

    /**
     * Get the list of unsubcribes in MailChimp server.
     * @param string $sListId List of subcribes.
     * @return type
     */
    public function getUnsubcribeFromMailChimp($sListId)
    {
        return $this -> getMailChimpApi() -> lists -> members($sListId, 'unsubscribed', NULL, 0, 100, 'ASC');
    }

    /**
     * bactch subscribe user
     * @see MCAPI::listBatchSubscribe($id, $batch, $double_optin=true, $update_existing=false, $replace_interests=true)
     * @PARAM BATCH USER
     * @return FALSE| array
     * Mail chimp response array format: array(4) { ["add_count"]=> int(5) ["update_count"]=> int(0) ["error_count"]=> int(0) ["errors"]=> array(0) { } }
     * check errors to get all errors messages.
     */
    function listBatchSubscribe($listId, $batch, $double_optin = FALSE, $update_existing = TRUE, $replace_interests = FALSE)
    {
        $api = $this -> getMailChimpApi();

        //listBatchSubscribe
        $result = $api -> lists -> batchSubscribe($listId, $batch, $double_optin, $update_existing, $replace_interests);

        $sMessage = '';

        if ($api -> errorCode)
        {
            $sMessage = "Batch Subscribe failed! Code:" . $api -> errorCode . " Message:" . $api -> errorMessage;
        }
        else
        {
            $sMessage = "Added:   " . $result['add_count'] . " Updated: " . $result['update_count'] . " Errors:  " . $result['error_count'];
            foreach ($result['errors'] as $val)
            {
                $sMessage .= " + Email: " . $val['email'] . " failed. Code:" . $val['code'] . " Message :" . $val['error'];
            }
        }

        Phpfox::getService('mailchimp.log.process') -> add($sMessage);

        return $result;
    }

    public function getLastMailUsersForSendMail($sListId, $iStart)
    {
        $iLimit = Phpfox::getParam('mailchimp.limit_mail_send');

        $aResult = $this -> getMailChimpApi() -> lists -> members($sListId, 'subscribed', NULL, $iStart, $iLimit);

        $sMessage = '';
        // When connect with error, set error connection.
        $bErrorConnection = false;

        if ($this -> getMailChimpApi() -> errorCode)
        {
            $sMessage = "Unable to load listMembers()! Code=" . $this -> getMailChimpApi() -> errorCode . " Msg=" . $this -> getMailChimpApi() -> errorMessage;
            // Set error connection.
            $bErrorConnection = true;
        }
        else
        {
            $sMessage = "Members matched: " . $aResult['total'] . " Members returned: " . sizeof($aResult['data']);
            foreach ($aResult['data'] as $member)
            {
                $sMessage .= " + " . $member['email'] . " - " . $member['timestamp'];
            }
        }

        Phpfox::getService('mailchimp.log.process') -> add($sMessage);

        return isset($aResult['data']) ? $aResult['data'] : ($bErrorConnection ? false : array());
    }

    public function getSubcribeLists()
    {

        $aUser = $this -> getLoginUser(Phpfox::getUserId());

        if (count($aUser) > 0)
        {
            $aSubcribeLists = $this -> getMailChimpApi() -> helper -> listsForEmail($aUser['email']);

            if (is_array($aSubcribeLists) && count($aSubcribeLists) > 0)
            {
                return $aSubcribeLists;
            }
        }

        return array();
    }

    public function checkEmailExistInList($sListId, $sEmail)
    {
        $aListId = $this -> getMailChimpApi() -> helper -> listsForEmail($sEmail);

        if (is_array($aListId))
        {
            foreach ($aListId as $sItem)
            {
                if ($sItem == $sListId)
                {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Checks to validate an email.
     *
     * @param string $sEmail email to check
     * @param boolean $bDoDnsCheck http://php.net/checkdnsrr check for domain name, this could slow down the function so use wisely
     * @return boolean
     */


    public function subscribeNonUserToList($sListId, $sEmail)
    {
        $aMergeVars = array();

        $bResult = $this -> getMailChimpApi() -> lists -> subscribe($sListId, $sEmail, $aMergeVars, 'html', false);

        if ($this -> getMailChimpApi() -> errorCode)
        {
            $sMessage = "Unable to load listSubscribe()! Code=" . $this -> getMailChimpApi() -> errorCode . " Msg=" . $this -> getMailChimpApi() -> errorMessage;
        }
        else
        {
            $sMessage = "Subscribed - look for the confirmation email!\n";
        }

        Phpfox::getService('mailchimp.log.process') -> add($sMessage);

        // Get list infor.
        $aList = $this -> getListByListId($sListId);

        $sListName = isset($aList['name']) ? $aList['name'] : $sListId;

        Phpfox::getService('mailchimp.log.process') -> add('Subscribed - email: ' . $sEmail . ' to the list: ' . $sListName);

        return $bResult;
    }

    public function subcribeLoginUserToList($sListId, $bOption = TRUE)
    {
        $aUser = $this -> getLoginUser(Phpfox::getUserId());

        if (count($aUser) == 0)
            return;

        $aMergeVars = $this -> getMergeTagsForUser($sListId, $aUser);

        $bResult = $this -> getMailChimpApi() -> lists -> subscribe($sListId, $aUser['email'], $aMergeVars, $email_type = 'html', $bOption);

        if ($this -> getMailChimpApi() -> errorCode)
        {
            $sMessage = "Unable to load listSubscribe()! Code=" . $this -> getMailChimpApi() -> errorCode . " Msg=" . $this -> getMailChimpApi() -> errorMessage;
        }
        else
        {
            // Get list infor.
            $aList = $this -> getListByListId($sListId);

            $sListName = isset($aList['name']) ? $aList['name'] : $sListId;

            $sMessage = 'Subscribed - email: ' . $aUser['email'] . ' to the list: ' . $sListName;
        }
        Phpfox::getService('mailchimp.log.process') -> add($sMessage);

        if ($bResult)
        {
            // Add feed to wall.
            if (Phpfox::isModule('feed'))
            {
                $iFeedId = 0;

                $iFeedId = Phpfox::getService('feed.process') -> add('mailchimp', $aUser['user_id']);

                Phpfox::getService('mailchimp.feed.process') -> add($iFeedId, $sListId);
            }

            Phpfox::getLib('session') -> set(Phpfox::getUserId() . $sListId, $sListId);

            //Phpfox::getService('mailchimp.info.process') -> add($sListId, Phpfox::getUserId(), EMAIL_INFO_SEND);
        }

        return $bResult;
    }

    public function unsubcribeLoginUserToList($sListId)
    {
        $aUser = $this -> getLoginUser(Phpfox::getUserId());

        if (count($aUser) == 0)
            return;

        $aMergeVars = $this -> getMergeTagsForUser($sListId, $aUser);

        $bResult = $this -> getMailChimpApi() -> lists -> unsubscribe($sListId, $aUser['email'], $aMergeVars);

        if ($this -> getMailChimpApi() -> errorCode)
        {
            $sMessage = "Unable to load listUnsubscribe()! Code=" . $this -> getMailChimpApi() -> errorCode . " Msg=" . $this -> getMailChimpApi() -> errorMessage;
        }
        else
        {
            $sMessage = "Unsubscribed - look for the confirmation email!\n";
        }
        Phpfox::getService('mailchimp.log.process') -> add($sMessage);
        Phpfox::getService('mailchimp.log.process') -> add('Unsubscribed - email: ' . $aUser['email'] . ' to the list: ' . $sListId);

        return $bResult;
    }

    public function sendRequestSubcribeAfterRegister($iUserId)
    {

        if ($iUserId < 1)
            return;

        $aInsert  =  Phpfox::getService('user')->get($iUserId);


        // Get list by group user id.
        $aLists = $this -> getListsMap($aInsert['user_group_id']);

        if (!is_array($aLists))
        {
            return;
        }


        if(defined('TESTING') and TESTING)
        {
            //var_dump($aLists);
        }


        $aListSubscribeMail = array();

        // Subscribe to all list.
        foreach ($aLists as $sListId)
        {
            // Get merge variable.
            $aMergeVars = $this -> getMapForOneUserData($sListId, $iUserId);

            $aListInfo = $this -> getList($sListId);
            $sListName = $aListInfo['name'];

            // Subscribe user to list.

            $aResult = $this -> getMailChimpApi() -> lists -> subscribe($sListId, array('email' => $aMergeVars['EMAIL']), $aMergeVars);

            if ($this -> getMailChimpApi() -> errorCode)
            {
                $sMessage = "Unable to load listSubscribe()! Code=" . $this -> getMailChimpApi() -> errorCode . " Msg=" . $this -> getMailChimpApi() -> errorMessage;
            }
            else
            {
                $aListSubscribeMail[] = $aListInfo;
                $sMessage = 'Subcribe email: ' . $aInsert['email'] . ' to the list: ' . $sListName;
            }



            Phpfox::getService('mailchimp.log.process') -> add($sMessage);

            //Phpfox::getService('mailchimp.info.process') -> add($sListId, $iUserId, EMAIL_INFO_SEND);
        }

        if (count($aListSubscribeMail) > 0)
        {
            if (Phpfox::getParam('mailchimp.send_notification_to_user_when_we_request_user_to_a_list'))
            {
                if (Phpfox::isModule('mail'))
                {
                    if (!$this -> checkEmailExist(ADMIN_USER_ID, $iUserId))
                    {
                        $this -> sendEmail($iUserId, $aListSubscribeMail);
                    }
                }
            }
        }
    }

    /**
     * User has logged in.
     * @param type $aVals
     */
    public function updateSubscribeWhenUserChangeProfile($iUserId)
    {
        $aUser = Phpfox::getService('user')->get($iUserId);

        $aLists = $this -> getMailChimpApi() -> helper -> listsForEmail($aUser['email']);

        if (!is_array($aLists))
        {
            return;
        }

        // Add subscribe all list.
        foreach ($aLists as $sListId)
        {
            $aMergeVars = $this -> getMapForOneUserData($sListId, $iUserId);

            $sReturn = $this -> getMailChimpApi() -> lists -> updateMember($sListId, array('email' => $aMergeVars['EMAIL']), $aMergeVars);

            if ($this -> getMailChimpApi() -> errorCode)
            {
                $sMessage = "Unable to update member info! Code=" . $this -> getMailChimpApi() -> errorCode . " Msg=" . $this -> getMailChimpApi() -> errorMessage;
            }
            else
            {
                $sMessage = "Returned: " . $sReturn . "\n";
            }
            Phpfox::getService('mailchimp.log.process') -> add($sMessage);

            // Get full information of this list.
            $aListInfo = $this -> getList($sListId);

            if (isset($aListInfo['name']))
            {
                $sListName = $aListInfo['name'];
            }
            else
            {
                $sListName = $sListId;
            }

            Phpfox::getService('mailchimp.log.process') -> add('Update information for email: ' . $aUser['email'] . ' to the list: ' . $sListName);
        }
    }
}
?>