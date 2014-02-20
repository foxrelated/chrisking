<?php

$oDatabase = Phpfox::getLib('database');
$oFile = Phpfox::getLib('file');

//From 1.0
$oDatabase->query("CREATE TABLE IF NOT EXISTS `" . Phpfox::getT('ko_idrive_files') . "` (
	  `id` int(11) NOT NULL auto_increment,
	  `file_name` varchar(64) NOT NULL,
	  `user_id` int(11) NOT NULL,
	  `timestamp` int(11) NOT NULL,
	  PRIMARY KEY  (`id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ");

$oDatabase->query("CREATE TABLE IF NOT EXISTS `" . Phpfox::getT('ko_idrive_players') . "` (
	  `player_id` int(11) NOT NULL auto_increment,
	  `user_id` int(11) NOT NULL,
	  `player_name` varchar(64) NOT NULL,
	  `player_type` tinyint(1) NOT NULL,
	  `domain` varchar(64) NOT NULL,
	  `make` varchar(64) NOT NULL,
	  `file_id` int(11) NOT NULL,
	  `logo_branding_url` varchar(64) NOT NULL,
	  `player_background` varchar(6) NOT NULL,
	  `player_text` varchar(6) NOT NULL,
	  `player_buttons` varchar(6) NOT NULL,
	  `player_progress_bar` varchar(6) NOT NULL,
	  `player_button_icons` varchar(6) NOT NULL,
	  `playlist_arrows` varchar(6) NOT NULL,
	  `playlist_border` varchar(6) NOT NULL,
	  `timestamp` int(11) NOT NULL,
	  PRIMARY KEY  (`player_id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ");

//From 2.0
if (!($oDatabase->isField(Phpfox::getT('ko_idrive_players'), 'preroll_file_id')))
{
	//Create new table
	$oDatabase->query("CREATE TABLE IF NOT EXISTS `" . Phpfox::getT('ko_idrive_preroll_files') . "` (
	  `preroll_id` int(11) NOT NULL auto_increment,
	  `preroll_file_name` varchar(64) NOT NULL,
	  `preroll_duration` int(11) default NULL,
	  `user_id` int(11) NOT NULL,
	  `timestamp` int(11) NOT NULL,
	  PRIMARY KEY  (`preroll_id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ");

	//Change logo file table name
	$oDatabase->query("RENAME TABLE `" . Phpfox::getT('ko_idrive_files') . "` TO `" . Phpfox::getT('ko_idrive_logo_files') . "` ;");

	//Alter logo file table column names
	$oDatabase->query("ALTER TABLE `" . Phpfox::getT('ko_idrive_logo_files') . "` CHANGE `id` `logo_id` INT( 11 ) NOT NULL AUTO_INCREMENT ;");
	$oDatabase->query("ALTER TABLE `" . Phpfox::getT('ko_idrive_logo_files') . "` CHANGE `file_name` `logo_file_name` VARCHAR( 64 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ;");

	//Alter players table logo id column name
	$oDatabase->query("ALTER TABLE `" . Phpfox::getT('ko_idrive_players') . "` CHANGE `file_id` `logo_file_id` INT( 11 ) NOT NULL ;");

	//Adds preroll columns to players table
	$oDatabase->query("ALTER TABLE `" . Phpfox::getT('ko_idrive_players') . "` ADD `preroll_file_id` INT( 11 ) NULL AFTER `logo_file_id` ;");
	$oDatabase->query("ALTER TABLE `" . Phpfox::getT('ko_idrive_players') . "` ADD `preroll_url` VARCHAR( 64 ) NULL AFTER `logo_branding_url` ;");

	//Cleans up orphaned files
	$aLogoFiles = $oDatabase
		->select('*')
		->from(Phpfox::getT('ko_idrive_logo_files'))
		->execute('getRows');

	foreach ($aLogoFiles as $aLogo)
	{
		$iPlayerId = $oDatabase
			->select('player_id')
			->from(Phpfox::getT('ko_idrive_players'))
			->where('logo_file_id =' . $aLogo['logo_id'])
			->execute('getField');

		if (!$iPlayerId)
		{
			$oFile->unlink(Phpfox::getParam('core.dir_file') . 'idrive/logo/' . $aLogo['logo_file_name']);
			$oDatabase->delete(Phpfox::getT('ko_idrive_logo_files'), 'logo_id =' . $aLogo['logo_id']);
		}
	}
}

// From 4.0
if (!(Phpfox::getLib('database')->isField(Phpfox::getT('ko_idrive_players'), "autoplay")))
{
	Phpfox::getLib('database')->addField(array(
		'table' => Phpfox::getT('ko_idrive_players'),
		'field' => 'autoplay',
		'type' => 'TINYINT',
		'null' => 0
	));
}

// From 8.0
if (!(Phpfox::getLib('database')->isField(Phpfox::getT('ko_idrive_players'), "email")))
{
	Phpfox::getLib('database')->addField(array(
		'table' => Phpfox::getT('ko_idrive_players'),
		'field' => 'email',
		'type' => 'VARCHAR',
		'attribute' => '(255)',
		'null' => 0
	));
}

if (!(Phpfox::getLib('database')->isField(Phpfox::getT('ko_idrive_players'), "show_playlist")))
{
	Phpfox::getLib('database')->addField(array(
		'table' => Phpfox::getT('ko_idrive_players'),
		'field' => 'show_playlist',
		'type' => 'TINYINT',
		'attribute' => '(1)',
		'default' => '1',
		'null' => 0
	));
}

?>
