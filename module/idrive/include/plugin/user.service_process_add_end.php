<?php

if (isset($aVals['user_type']))
{
	$aUserGroups = Phpfox::getService('idrive')->getUserGroups();

	if (array_key_exists($aVals['user_type'], $aUserGroups) && $aVals['user_type'] != 1)
	{
		$this->database()->update(Phpfox::getT('user'), array('user_group_id' => (int) $aVals['user_type']), 'user_id = ' . (int) $iId);
	}
}

Phpfox::getService('dvs.register.process')->add($iId, $aVals);

?>