<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php $aContent = 'if (Phpfox::isModule(\'mailchimp\'))
{
    if (Phpfox::getParam(\'mailchimp.update_subscribe_when_users_changed_their_information\'))
    {
        Phpfox::getService(\'mailchimp\')->updateSubscribeWhenUserChangeProfile($iUserId,$aVals);
    }
} '; ?>