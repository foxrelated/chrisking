<?php
if (Phpfox::isModule('mailchimp'))
{
    Phpfox::getService('mailchimp')->updateListsWhenAdminUpdateGroupUserId($iUserid);
    if (is_array($aMailChimpOldUser) && count($aMailChimpOldUser) > 0)
    {
        if ($aVals['user_group_id'] != $aMailChimpOldUser['user_group_id'])
        {
        }
    }
}

?>
