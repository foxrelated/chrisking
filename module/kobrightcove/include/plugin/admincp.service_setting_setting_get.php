<?php
$aGroups = array();
$aGroupsP = array();
$aGroups = Phpfox::getService('user.group')->get();
foreach($aGroups as $aGroup)
{
$iKeyP = $aGroup['user_group_id'];
$aGroupsP[$iKeyP] = $aGroup['title'];
}

foreach ($aRows as $iKey => $aRow)
{
	if($aRow['var_name'] == 'notificationuser_group')
	{
		$aRows[$iKey]['type_id'] = 'drop_with_key';
		$aRows[$iKey]['values'] = $aGroupsP;					
	}

}
?>