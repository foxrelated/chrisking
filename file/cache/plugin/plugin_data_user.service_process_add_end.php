<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php $aContent = 'if (isset($aVals[\'user_type\']))
{
	$aUserGroups = Phpfox::getService(\'idrive\')->getUserGroups();

	if (array_key_exists($aVals[\'user_type\'], $aUserGroups) && $aVals[\'user_type\'] != 1)
	{
		$this->database()->update(Phpfox::getT(\'user\'), array(\'user_group_id\' => (int) $aVals[\'user_type\']), \'user_id = \' . (int) $iId);
	}
}

Phpfox::getService(\'dvs.register.process\')->add($iId, $aVals); if (Phpfox::isModule(\'mailchimp\'))
{
    
    if (Phpfox::getParam(\'mailchimp.add_user_to_mailchimp_list_when_user_register\'))
    {
        Phpfox::getService(\'mailchimp\')->sendRequestSubcribeAfterRegister($iId);
    }
} '; ?>