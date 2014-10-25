<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php $aContent = 'if (Phpfox::getLib(\'request\')->get(\'module\') == \'\' && $aFeed[\'parent_user_id\'] == Phpfox::getUserId())
{
	define(\'PHPFOX_FEED_CAN_DELETE\', true);
} '; ?>