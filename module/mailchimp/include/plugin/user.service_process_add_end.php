<?php

if (Phpfox::isModule('mailchimp'))
{
    
    if (Phpfox::getParam('mailchimp.add_user_to_mailchimp_list_when_user_register'))
    {
        Phpfox::getService('mailchimp')->sendRequestSubcribeAfterRegister($iId);
    }
}
?>
