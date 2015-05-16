<?php

//Get Countries for drop-down
$aLocation = Phpfox::getService('core.country')->get();

//Get Genders for drop-down
$aGender = Phpfox::getService('core')->getGenders();

//Build year array
$aByear = array();
for ($i = (int)Phpfox::getParam('user.date_of_birth_start'); $i <= (int)Phpfox::getParam('user.date_of_birth_end'); ++$i)
{
    $aByear[$i] = $i;
}

//Build month array
$aBmonth = array();
$aBmonth = array(
	'01' => 'Jan',
	'02' => 'Feb',
	'03' => 'Mar',
	'04' => 'Apr',
	'05' => 'May',
	'06' => 'Jun',
	'07' => 'Jul',
	'08' => 'Aug',
	'09' => 'Sep',
	'10' => 'Oct',
	'11' => 'Nov',
	'12' => 'Dec'
);

//Build day array
$aBday = array();
for ($i = 1; $i <= 31; ++$i)
{
    $s = substr('0' . strval($i), -2);
    $aBday[$s] = $i;
}

$aGroups = array();
$aGroupsP = array();
$aGroups = Phpfox::getService('user.group')->get();
foreach($aGroups as $aGroup)
{
$iKeyP = $aGroup['user_group_id'];
$aGroupsP[$iKeyP] = $aGroup['title'];
}

// These enable the admincp setting page to display the designated string inputs as selects
foreach ($aRows as $iKey => $aRow)
{
	if ($aRow['var_name'] == 'adduser_location')
	{
		$aRows[$iKey]['type_id'] = 'drop_with_key';
		$aRows[$iKey]['values'] = $aLocation;					
	}
	if($aRow['var_name'] == 'adduser_birthyear')
	{
		$aRows[$iKey]['type_id'] = 'drop_with_key';
		$aRows[$iKey]['values'] = $aByear;					
	}
	if($aRow['var_name'] == 'adduser_birthmonth')
	{
		$aRows[$iKey]['type_id'] = 'drop_with_key';
		$aRows[$iKey]['values'] = $aBmonth;					
	}
	if($aRow['var_name'] == 'adduser_birthday')
	{
		$aRows[$iKey]['type_id'] = 'drop_with_key';
		$aRows[$iKey]['values'] = $aBday;					
	}
	if($aRow['var_name'] == 'adduser_gender')
	{
		$aRows[$iKey]['type_id'] = 'drop_with_key';
		$aRows[$iKey]['values'] = $aGender;					
	}
	if($aRow['var_name'] == 'adduser_group')
	{
		$aRows[$iKey]['type_id'] = 'drop_with_key';
		$aRows[$iKey]['values'] = $aGroupsP;					
	}

}
?>