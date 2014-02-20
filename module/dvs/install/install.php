<?php

//From 1.0
Phpfox::getLib('database')->query("CREATE TABLE IF NOT EXISTS `" . Phpfox::getT('ko_dvs') . "` (
		`dvs_id` int(11) NOT NULL auto_increment,
		`user_id` int(11) NOT NULL,
		`dvs_name` varchar(255) NOT NULL,
		`dealer_name` varchar(255) NOT NULL,
		`title_url` varchar(255) NOT NULL,
		`address` varchar(255) NOT NULL,
		`city` varchar(255) NOT NULL,
		`country_child_id` int(11) NOT NULL,
		`postal_code` varchar(16) NOT NULL,
		`phone` varchar(16) NOT NULL,
		`email` varchar(255) NOT NULL,
		`url` varchar(255) NOT NULL,
		`inventory_url` varchar(255) NOT NULL,
		`seo_tags` varchar(255) NOT NULL,
		PRIMARY KEY  (`dvs_id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ");

Phpfox::getLib('database')->query("CREATE TABLE IF NOT EXISTS `" . Phpfox::getT('ko_dvs_branding_files') . "` (
		`branding_id` int(11) NOT NULL auto_increment,
		`branding_file_name` varchar(64) NOT NULL,
		`user_id` int(11) NOT NULL,
		`timestamp` int(11) NOT NULL,
		PRIMARY KEY  (`branding_id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ");

Phpfox::getLib('database')->query("CREATE TABLE IF NOT EXISTS `" . Phpfox::getT('ko_dvs_logo_files') . "` (
		`logo_id` int(11) NOT NULL auto_increment,
		`logo_file_name` varchar(64) NOT NULL,
		`user_id` int(11) NOT NULL,
		`timestamp` int(11) NOT NULL,
		PRIMARY KEY  (`logo_id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ");

Phpfox::getLib('database')->query("CREATE TABLE IF NOT EXISTS `" . Phpfox::getT('ko_dvs_players') . "` (
		`player_id` int(11) NOT NULL auto_increment,
		`dvs_id` int(11) NOT NULL,
		`player_name` varchar(64) NOT NULL,
		`player_type` tinyint(1) NOT NULL,
		`domain` varchar(64) NOT NULL,
		`make` varchar(64) NOT NULL,
		`logo_file_id` int(11) NOT NULL,
		`preroll_file_id` int(11) NOT NULL,
		`logo_branding_url` varchar(64) NOT NULL,
		`preroll_url` varchar(64) default NULL,
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

Phpfox::getLib('database')->query("CREATE TABLE IF NOT EXISTS `" . Phpfox::getT('ko_dvs_preroll_files') . "` (
		`preroll_id` int(11) NOT NULL auto_increment,
		`preroll_file_name` varchar(64) NOT NULL,
		`preroll_duration` int(11) default NULL,
		`user_id` int(11) NOT NULL,
		`timestamp` int(11) NOT NULL,
		PRIMARY KEY  (`preroll_id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ");

Phpfox::getLib('database')->query("CREATE TABLE IF NOT EXISTS `" . Phpfox::getT('ko_dvs_style') . "` (
		`dvs_id` int(11) NOT NULL,
		`branding_file_id` int(11) NOT NULL,
		`menu_background` varchar(6) NOT NULL,
		`menu_text` varchar(6) NOT NULL,
		`page_background` varchar(6) NOT NULL,
		`page_text` varchar(6) NOT NULL,
		`button_background` varchar(6) NOT NULL,
		`button_text` varchar(6) NOT NULL,
		PRIMARY KEY  (`dvs_id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ");

Phpfox::getLib('database')->query("CREATE TABLE IF NOT EXISTS `" . Phpfox::getT('ko_dvs_text') . "` (
		`dvs_id` int(11) NOT NULL,
		`text` mediumtext NOT NULL,
		`text_parsed` mediumtext NOT NULL,
		PRIMARY KEY  (`dvs_id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ");

Phpfox::getLib('database')->query("CREATE TABLE IF NOT EXISTS `" . Phpfox::getT('ko_dvs_themes') . "` (
		`theme_id` int(11) NOT NULL auto_increment,
		`theme_name` varchar(255) NOT NULL,
		`theme_menu_background` varchar(6) NOT NULL,
		`theme_menu_text` varchar(6) NOT NULL,
		`theme_page_background` varchar(6) NOT NULL,
		`theme_page_text` varchar(6) NOT NULL,
		`theme_button_background` varchar(6) NOT NULL,
		`theme_button_text` varchar(6) NOT NULL,
		PRIMARY KEY  (`theme_id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ");


// From 1.3
if (!(Phpfox::getLib('database')->isField(Phpfox::getT('ko_dvs'), "total_emails_sent")))
{
	Phpfox::getLib('database')->addField(array(
		'table' => Phpfox::getT('ko_dvs'),
		'field' => 'total_emails_sent',
		'type' => 'int',
		'attribute' => '(11)',
		'null' => 0
	));
}


// From 2.0
if (!(Phpfox::getLib('database')->isField(Phpfox::getT('ko_dvs'), "dvs_google_id")))
{
	//Upgrading from DVS 1.x
	Phpfox::getLib('database')->query("DROP TABLE IF EXISTS `" . Phpfox::getT('ko_dvs') . "`;");
	Phpfox::getLib('database')->query("DROP TABLE IF EXISTS `" . Phpfox::getT('ko_dvs_branding_files') . "`;");
	Phpfox::getLib('database')->query("DROP TABLE IF EXISTS `" . Phpfox::getT('ko_dvs_logo_files') . "`;");
	Phpfox::getLib('database')->query("DROP TABLE IF EXISTS `" . Phpfox::getT('ko_dvs_players') . "`;");
	Phpfox::getLib('database')->query("DROP TABLE IF EXISTS `" . Phpfox::getT('ko_dvs_preroll_files') . "`;");
	Phpfox::getLib('database')->query("DROP TABLE IF EXISTS `" . Phpfox::getT('ko_dvs_style') . "`;");
	Phpfox::getLib('database')->query("DROP TABLE IF EXISTS `" . Phpfox::getT('ko_dvs_text') . "`;");
	Phpfox::getLib('database')->query("DROP TABLE IF EXISTS `" . Phpfox::getT('ko_dvs_themes') . "`;");
	Phpfox::getLib('database')->query("DROP TABLE IF EXISTS `" . Phpfox::getT('ko_idrive_files') . "`;");
	Phpfox::getLib('database')->query("DROP TABLE IF EXISTS `" . Phpfox::getT('ko_idrive_logo_files') . "`;");
	Phpfox::getLib('database')->query("DROP TABLE IF EXISTS `" . Phpfox::getT('ko_idrive_players') . "`;");
	Phpfox::getLib('database')->query("DROP TABLE IF EXISTS `" . Phpfox::getT('ko_idrive_preroll_files') . "`;");

	Phpfox::getLib('database')->query("CREATE TABLE IF NOT EXISTS `" . Phpfox::getT('ko_dvs') . "` (
	  `dvs_id` int(11) NOT NULL AUTO_INCREMENT,
	  `user_id` int(11) NOT NULL,
	  `dvs_name` varchar(255) NOT NULL,
	  `dealer_name` varchar(255) NOT NULL,
	  `title_url` varchar(255) NOT NULL,
	  `address` varchar(255) NOT NULL,
	  `city` varchar(255) NOT NULL,
	  `country_child_id` int(11) NOT NULL,
	  `postal_code` varchar(16) NOT NULL,
	  `phone` varchar(16) NOT NULL,
	  `email` varchar(255) NOT NULL,
	  `url` varchar(255) NOT NULL,
	  `inventory_url` varchar(255) NOT NULL,
	  `seo_tags` varchar(255) NOT NULL,
	  `total_emails_sent` int(11) NOT NULL,
	  `dvs_google_id` varchar(16) NOT NULL,
	  `contact_url` varchar(255) NOT NULL,
	  `youtube_url` varchar(255) NOT NULL,
	  `facebook_url` varchar(255) NOT NULL,
	  `twitter_url` varchar(255) NOT NULL,
	  `google_url` varchar(255) NOT NULL,
	  `specials_url` varchar(255) NOT NULL,
	  `latitude` varchar(16) NOT NULL,
	  `longitude` int(16) NOT NULL,
	  `dvs_time_stamp` int(11) NOT NULL,
	  PRIMARY KEY (`dvs_id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ");

	Phpfox::getLib('database')->query("CREATE TABLE IF NOT EXISTS `" . Phpfox::getT('ko_dvs_background_files') . "` (
	  `background_id` int(11) NOT NULL AUTO_INCREMENT,
	  `background_file_name` varchar(64) NOT NULL,
	  `user_id` int(11) NOT NULL,
	  `timestamp` int(11) NOT NULL,
	  PRIMARY KEY (`background_id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ");

	Phpfox::getLib('database')->query("CREATE TABLE IF NOT EXISTS `" . Phpfox::getT('ko_dvs_branding_files') . "` (
	  `branding_id` int(11) NOT NULL AUTO_INCREMENT,
	  `branding_file_name` varchar(64) NOT NULL,
	  `user_id` int(11) NOT NULL,
	  `timestamp` int(11) NOT NULL,
	  PRIMARY KEY (`branding_id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ");

	Phpfox::getLib('database')->query("CREATE TABLE IF NOT EXISTS `" . Phpfox::getT('ko_dvs_logo_files') . "` (
	  `logo_id` int(11) NOT NULL AUTO_INCREMENT,
	  `logo_file_name` varchar(64) NOT NULL,
	  `user_id` int(11) NOT NULL,
	  `timestamp` int(11) NOT NULL,
	  PRIMARY KEY (`logo_id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ");

	Phpfox::getLib('database')->query("CREATE TABLE IF NOT EXISTS `" . Phpfox::getT('ko_dvs_players') . "` (
	  `player_id` int(11) NOT NULL AUTO_INCREMENT,
	  `dvs_id` int(11) NOT NULL,
	  `player_name` varchar(64) NOT NULL,
	  `player_type` tinyint(1) NOT NULL,
	  `domain` varchar(64) NOT NULL,
	  `make` varchar(64) NOT NULL,
	  `logo_file_id` int(11) NOT NULL,
	  `preroll_file_id` int(11) NOT NULL,
	  `logo_branding_url` varchar(64) NOT NULL,
	  `preroll_url` varchar(64) DEFAULT NULL,
	  `player_background` varchar(6) NOT NULL,
	  `player_text` varchar(6) NOT NULL,
	  `player_buttons` varchar(6) NOT NULL,
	  `player_progress_bar` varchar(6) NOT NULL,
	  `player_button_icons` varchar(6) NOT NULL,
	  `playlist_arrows` varchar(6) NOT NULL,
	  `playlist_border` varchar(6) NOT NULL,
	  `featured_model` varchar(64) NOT NULL,
	  `timestamp` int(11) NOT NULL,
	  PRIMARY KEY (`player_id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ");

	Phpfox::getLib('database')->query("CREATE TABLE IF NOT EXISTS `" . Phpfox::getT('ko_dvs_preroll_files') . "` (
	  `preroll_id` int(11) NOT NULL AUTO_INCREMENT,
	  `preroll_file_name` varchar(64) NOT NULL,
	  `preroll_duration` int(11) DEFAULT NULL,
	  `user_id` int(11) NOT NULL,
	  `timestamp` int(11) NOT NULL,
	  PRIMARY KEY (`preroll_id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ");

	Phpfox::getLib('database')->query("CREATE TABLE IF NOT EXISTS `" . Phpfox::getT('ko_dvs_style') . "` (
	  `dvs_id` int(11) NOT NULL,
	  `branding_file_id` int(11) NOT NULL,
	  `background_file_id` int(11) NOT NULL,
	  `background_opacity` varchar(8) NOT NULL,
	  `menu_background` varchar(6) NOT NULL,
	  `menu_link` varchar(6) NOT NULL,
	  `page_background` varchar(6) NOT NULL,
	  `page_text` varchar(6) NOT NULL,
	  `button_background` varchar(6) NOT NULL,
	  `button_text` varchar(6) NOT NULL,
	  `button_top_gradient` varchar(6) NOT NULL,
	  `button_bottom_gradient` varchar(6) NOT NULL,
	  `button_border` varchar(6) NOT NULL,
	  `text_link` varchar(6) NOT NULL,
	  `footer_link` varchar(6) NOT NULL,
	  PRIMARY KEY (`dvs_id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ");

	Phpfox::getLib('database')->query("CREATE TABLE IF NOT EXISTS `" . Phpfox::getT('ko_dvs_text') . "` (
	  `dvs_id` int(11) NOT NULL,
	  `text` mediumtext NOT NULL,
	  `text_parsed` mediumtext NOT NULL,
	  PRIMARY KEY (`dvs_id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ");

	Phpfox::getLib('database')->query("CREATE TABLE IF NOT EXISTS `" . Phpfox::getT('ko_dvs_themes') . "` (
	  `theme_id` int(11) NOT NULL AUTO_INCREMENT,
	  `theme_name` varchar(255) NOT NULL,
	  `theme_menu_background` varchar(6) NOT NULL,
	  `theme_menu_link` varchar(6) NOT NULL,
	  `theme_page_background` varchar(6) NOT NULL,
	  `theme_page_text` varchar(6) NOT NULL,
	  `theme_button_background` varchar(6) NOT NULL,
	  `theme_button_text` varchar(6) NOT NULL,
	  `theme_button_top_gradient` varchar(6) NOT NULL,
	  `theme_button_bottom_gradient` varchar(6) NOT NULL,
	  `theme_button_border` varchar(6) NOT NULL,
	  `theme_text_link` varchar(6) NOT NULL,
	  `theme_footer_link` varchar(6) NOT NULL,
	  PRIMARY KEY (`theme_id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ");

	Phpfox::getLib('database')->query("CREATE TABLE IF NOT EXISTS `" . Phpfox::getT('ko_idrive_files') . "` (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `file_name` varchar(64) NOT NULL,
	  `user_id` int(11) NOT NULL,
	  `timestamp` int(11) NOT NULL,
	  PRIMARY KEY (`id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ");

	Phpfox::getLib('database')->query("CREATE TABLE IF NOT EXISTS `" . Phpfox::getT('ko_idrive_logo_files') . "` (
	  `logo_id` int(11) NOT NULL AUTO_INCREMENT,
	  `logo_file_name` varchar(64) NOT NULL,
	  `user_id` int(11) NOT NULL,
	  `timestamp` int(11) NOT NULL,
	  PRIMARY KEY (`logo_id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ");

	Phpfox::getLib('database')->query("CREATE TABLE IF NOT EXISTS `" . Phpfox::getT('ko_idrive_players') . "` (
	  `player_id` int(11) NOT NULL AUTO_INCREMENT,
	  `user_id` int(11) NOT NULL,
	  `player_name` varchar(64) NOT NULL,
	  `player_type` tinyint(1) NOT NULL,
	  `domain` varchar(64) NOT NULL,
	  `make` varchar(64) NOT NULL,
	  `logo_file_id` int(11) NOT NULL,
	  `preroll_file_id` int(11) NOT NULL,
	  `logo_branding_url` varchar(64) NOT NULL,
	  `preroll_url` varchar(64) DEFAULT NULL,
	  `player_background` varchar(6) NOT NULL,
	  `player_text` varchar(6) NOT NULL,
	  `player_buttons` varchar(6) NOT NULL,
	  `player_progress_bar` varchar(6) NOT NULL,
	  `player_button_icons` varchar(6) NOT NULL,
	  `playlist_arrows` varchar(6) NOT NULL,
	  `playlist_border` varchar(6) NOT NULL,
	  `google_id` varchar(16) NOT NULL,
	  `featured_model` varchar(64) NOT NULL,
	  `timestamp` int(11) NOT NULL,
	  PRIMARY KEY (`player_id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ");

	Phpfox::getLib('database')->query("CREATE TABLE IF NOT EXISTS `" . Phpfox::getT('ko_idrive_preroll_files') . "` (
	  `preroll_id` int(11) NOT NULL AUTO_INCREMENT,
	  `preroll_file_name` varchar(64) NOT NULL,
	  `preroll_duration` int(11) DEFAULT NULL,
	  `user_id` int(11) NOT NULL,
	  `timestamp` int(11) NOT NULL,
	  PRIMARY KEY (`preroll_id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ");
}


// From 2.1
Phpfox::getLib('database')->query("ALTER TABLE `" . Phpfox::getT('ko_dvs') . "` CHANGE `longitude` `longitude` VARCHAR( 16 ) NOT NULL");


// From 4.0
if (!(Phpfox::getLib('database')->isField(Phpfox::getT('ko_dvs_players'), "autoplay")))
{
	Phpfox::getLib('database')->addField(array(
		'table' => Phpfox::getT('ko_dvs_players'),
		'field' => 'autoplay',
		'type' => 'TINYINT',
		'null' => 0
	));
}

if (!(Phpfox::getLib('database')->isField(Phpfox::getT('ko_idrive_players'), "autoplay")))
{
	Phpfox::getLib('database')->addField(array(
		'table' => Phpfox::getT('ko_idrive_players'),
		'field' => 'autoplay',
		'type' => 'TINYINT',
		'null' => 0
	));
}

// From 4.5
if (!(Phpfox::getLib('database')->isField(Phpfox::getT('ko_dvs_players'), "autoadvance")))
{
	Phpfox::getLib('database')->addField(array(
		'table' => Phpfox::getT('ko_dvs_players'),
		'field' => 'autoadvance',
		'type' => 'TINYINT',
		'null' => 0
	));
}

if (!(Phpfox::getLib('database')->isField(Phpfox::getT('ko_idrive_players'), "autoadvance")))
{
	Phpfox::getLib('database')->addField(array(
		'table' => Phpfox::getT('ko_idrive_players'),
		'field' => 'autoadvance',
		'type' => 'TINYINT',
		'null' => 0
	));
}

// From 5.0
if (!(Phpfox::getLib('database')->isField(Phpfox::getT('ko_dvs_players'), "featured_make")))
{
	//Upgrading from DVS 4.x

	Phpfox::getLib('database')->query("CREATE TABLE IF NOT EXISTS `" . Phpfox::getT('ko_dvs_player_makes') . "` (
		`pmake_id` int(11) NOT NULL AUTO_INCREMENT,
		`player_id` int(11) NOT NULL,
		`make` varchar(32) NOT NULL,
		PRIMARY KEY (`pmake_id`),
		KEY `player_id` (`player_id`,`make`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ");

	Phpfox::getLib('database')->query("CREATE TABLE IF NOT EXISTS `" . Phpfox::getT('ko_idrive_player_makes') . "` (
		`pmake_id` int(11) NOT NULL AUTO_INCREMENT,
		`player_id` int(11) NOT NULL,
		`make` varchar(32) NOT NULL,
		PRIMARY KEY (`pmake_id`),
		KEY `player_id` (`player_id`,`make`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ");

	// Add featured make column
	Phpfox::getLib('database')->query("ALTER TABLE `" . Phpfox::getT('ko_dvs_players') . "` ADD `featured_make` VARCHAR( 64 ) NOT NULL AFTER `google_id`");
	Phpfox::getLib('database')->query("ALTER TABLE `" . Phpfox::getT('ko_idrive_players') . "` ADD `featured_make` VARCHAR( 64 ) NOT NULL AFTER `google_id`");

	// Add make for each DVS player, set featured make
	$aDvsPlayers = Phpfox::getLib('database')
		->select('*')
		->from(Phpfox::getT('ko_dvs_players'))
		->execute('getRows');

	foreach ($aDvsPlayers as $aPlayer)
	{
		// Add make to player
		Phpfox::getLib('database')->insert(Phpfox::getT('ko_dvs_player_makes'), array(
			'player_id' => (int) $aPlayer['player_id'],
			'make' => Phpfox::getLib('parse.input')->clean($aPlayer['make'])
		));

		// If there is a featured model, set featured make
		if ($aPlayer['featured_model'])
		{
			Phpfox::getLib('database')->update(Phpfox::getT('ko_dvs_players'), array(
				'featured_make' => Phpfox::getLib('parse.input')->clean($aPlayer['make'])
				), 'player_id = ' . (int) $aPlayer['player_id']);
		}
	}

	// Add make for each DVS player, set featured make
	$iDrivePlayers = Phpfox::getLib('database')
		->select('*')
		->from(Phpfox::getT('ko_idrive_players'))
		->execute('getRows');

	foreach ($iDrivePlayers as $aPlayer)
	{
		// Add make to player
		Phpfox::getLib('database')->insert(Phpfox::getT('ko_idrive_player_makes'), array(
			'player_id' => (int) $aPlayer['player_id'],
			'make' => Phpfox::getLib('parse.input')->clean($aPlayer['make'])
		));

		// If there is a featured model, set featured make
		if ($aPlayer['featured_model'])
		{
			Phpfox::getLib('database')->update(Phpfox::getT('ko_idrive_players'), array(
				'featured_make' => Phpfox::getLib('parse.input')->clean($aPlayer['make'])
				), 'player_id = ' . (int) $aPlayer['player_id']);
		}
	}

	// Remove make column from players
	Phpfox::getLib('database')->query("ALTER TABLE `" . Phpfox::getT('ko_dvs_players') . "` DROP `make`");
	Phpfox::getLib('database')->query("ALTER TABLE `" . Phpfox::getT('ko_idrive_players') . "` DROP `make`");
}


// From 6.0
if ((Phpfox::getLib('database')->isField(Phpfox::getT('ko_dvs_players'), 'google_id')))
{
	//Upgrading from DVS 5.x
	// Add make for each DVS player, set featured make
	$aDvss = Phpfox::getLib('database')
		->select('*')
		->from(Phpfox::getT('ko_dvs'), 'd')
		->join(Phpfox::getT('ko_dvs_players'), 'p', 'p.dvs_id = d.dvs_id')
		->execute('getRows');

	foreach ($aDvss as $aDvs)
	{
		// If the dealer has set a DVS player google_id but not a DVS google_id, the dealer will no longer receive analytics
		// in DVS 6.0.  Let's move the player's google_id to the DVS google_id
		if ($aDvs['google_id'] && !$aDvs['dvs_google_id'])
		{
			Phpfox::getLib('database')->update(Phpfox::getT('ko_dvs'), array(
				'dvs_google_id' => Phpfox::getLib('parse.input')->clean($aDvs['google_id']),
				), 'dvs_id = ' . $aDvs['dvs_id']);
		}
	}

	// Remove now ununsed google_id column
	Phpfox::getLib('database')->query("ALTER TABLE `" . Phpfox::getT('ko_dvs_players') . "` DROP `google_id`");
}


if (!(Phpfox::getLib('database')->isField(Phpfox::getT('ko_dvs_players'), "featured_year")))
{
	//Upgrading from DVS 5.x
	// Add featured year column
	Phpfox::getLib('database')->query("ALTER TABLE `" . Phpfox::getT('ko_dvs_players') . "` ADD `featured_year` VARCHAR( 4 ) NOT NULL AFTER `featured_make`");
	Phpfox::getLib('database')->query("ALTER TABLE `" . Phpfox::getT('ko_idrive_players') . "` ADD `featured_year` VARCHAR( 4 ) NOT NULL AFTER `featured_make`");

	// Add make for each DVS player, set featured make
	$aDvsPlayers = Phpfox::getLib('database')
		->select('*')
		->from(Phpfox::getT('ko_dvs_players'))
		->execute('getRows');

	foreach ($aDvsPlayers as $aPlayer)
	{
		// If there is a featured model, set featured make
		if ($aPlayer['featured_model'])
		{
			Phpfox::getLib('database')->update(Phpfox::getT('ko_dvs_players'), array(
				'featured_year' => '2013'
				), 'player_id = ' . (int) $aPlayer['player_id']);
		}
	}

	// Add make for each DVS player, set featured make
	$aDrivePlayers = Phpfox::getLib('database')
		->select('*')
		->from(Phpfox::getT('ko_idrive_players'))
		->execute('getRows');

	foreach ($aDrivePlayers as $aPlayer)
	{
		// If there is a featured model, set featured make
		if ($aPlayer['featured_model'])
		{
			Phpfox::getLib('database')->update(Phpfox::getT('ko_idrive_players'), array(
				'featured_year' => '2013'
				), 'player_id = ' . (int) $aPlayer['player_id']);
		}
	}

	Phpfox::getLib('database')->delete(Phpfox::getT('setting'), 'module_id = "dvs" AND var_name="video_select_related_limit"');
	Phpfox::getLib('database')->delete(Phpfox::getT('user_group_setting'), 'module_id = "dvs" AND name="result_limit"');
	Phpfox::getLib('database')->delete(Phpfox::getT('user_group_setting'), 'module_id = "dvs" AND name="reference_id_search"');
	Phpfox::getLib('database')->delete(Phpfox::getT('user_group_setting'), 'module_id = "dvs" AND name="reference_id_search_overviews"');
	Phpfox::getLib('database')->delete(Phpfox::getT('user_group_setting'), 'module_id = "dvs" AND name="reference_id_search_test_drives"');
	Phpfox::getLib('database')->delete(Phpfox::getT('user_group_setting'), 'module_id = "idrive" AND name="reference_id_search"');
	Phpfox::getLib('database')->delete(Phpfox::getT('user_group_setting'), 'module_id = "idrive" AND name="result_limit"');
}


// From 7.0
Phpfox::getLib('database')->query("CREATE TABLE IF NOT EXISTS `" . Phpfox::getT('ko_dvs_phrase_overrides') . "` (
  `override_id` int(11) NOT NULL AUTO_INCREMENT,
  `dvs_id` int(11) NOT NULL,
  `var_name` varchar(512) NOT NULL,
  `text` varchar(2045) NOT NULL,
  PRIMARY KEY (`override_id`),
  KEY `dvs_id` (`dvs_id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ");

// From 8.0
Phpfox::getLib('database')->query("CREATE TABLE IF NOT EXISTS `" . Phpfox::getT('ko_shorturls') . "` (
  `shorturl_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `dvs_id` int(11) NOT NULL,
  `video_ref_id` varchar(64) NOT NULL,
  `shorturl` varchar(8) NOT NULL,
  `service` varchar(12) NOT NULL,
  `timestamp` int(11) NOT NULL,
  PRIMARY KEY (`shorturl_id`),
  KEY `user_id` (`user_id`,`dvs_id`,`video_ref_id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ");

Phpfox::getLib('database')->query("CREATE TABLE IF NOT EXISTS `" . Phpfox::getT('ko_shorturl_clicks') . "` (
  `click_id` int(11) NOT NULL AUTO_INCREMENT,
  `shorturl_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `timestamp` int(11) NOT NULL,
  PRIMARY KEY (`click_id`),
  KEY `shorturl_id` (`shorturl_id`,`user_id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ");

Phpfox::getLib('database')->query("CREATE TABLE IF NOT EXISTS `" . Phpfox::getT('ko_register') . "` (
  `register_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `website_rep` varchar(255) NOT NULL,
  `contact_name` varchar(255) NOT NULL,
  `contact_phone` varchar(32) NOT NULL,
  `billing_name` varchar(255) NOT NULL,
  `billing_address_1` varchar(255) NOT NULL,
  `billing_address_2` varchar(255) NOT NULL,
  `billing_city` varchar(255) NOT NULL,
  `billing_state` varchar(16) NOT NULL,
  `billing_zip_code` varchar(16) NOT NULL,
  PRIMARY KEY (`register_id`),
  KEY `user_id` (`user_id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ");

if (!(Phpfox::getLib('database')->isField(Phpfox::getT('ko_dvs_players'), "custom_overlay_1_type")))
{
	Phpfox::getLib('database')->query("ALTER TABLE `" . Phpfox::getT('ko_dvs_players') . "` 
		ADD `custom_overlay_1_type` INT NOT NULL ,
		ADD `custom_overlay_1_text` VARCHAR( 255 ) NOT NULL ,
		ADD `custom_overlay_1_url` VARCHAR( 255 ) NOT NULL ,
		ADD `custom_overlay_1_start` INT NOT NULL ,
		ADD `custom_overlay_1_duration` INT NOT NULL ,		
		ADD `custom_overlay_2_type` INT NOT NULL ,
		ADD `custom_overlay_2_text` VARCHAR( 255 ) NOT NULL ,
		ADD `custom_overlay_2_url` VARCHAR( 255 ) NOT NULL ,
		ADD `custom_overlay_2_start` INT NOT NULL ,
		ADD `custom_overlay_2_duration` INT NOT NULL ,		
		ADD `custom_overlay_3_type` INT NOT NULL ,
		ADD `custom_overlay_3_text` VARCHAR( 255 ) NOT NULL ,
		ADD `custom_overlay_3_url` VARCHAR( 255 ) NOT NULL ,
		ADD `custom_overlay_3_start` INT NOT NULL ,
		ADD `custom_overlay_3_duration` INT NOT NULL ; ");
}

if (!(Phpfox::getLib('database')->isField(Phpfox::getT('ko_dvs'), "1onone_override")))
{
	Phpfox::getLib('database')->addField(array(
		'table' => Phpfox::getT('ko_dvs'),
		'field' => '1onone_override',
		'type' => 'varchar',
		'attribute' => '(128)',
		'null' => 0
	));

	Phpfox::getLib('database')->addField(array(
		'table' => Phpfox::getT('ko_dvs'),
		'field' => 'new2u_override',
		'type' => 'varchar',
		'attribute' => '(128)',
		'null' => 0
	));

	Phpfox::getLib('database')->addField(array(
		'table' => Phpfox::getT('ko_dvs'),
		'field' => 'top200_override',
		'type' => 'varchar',
		'attribute' => '(128)',
		'null' => 0
	));

	Phpfox::getLib('database')->query("CREATE TABLE IF NOT EXISTS `" . Phpfox::getT('ko_dvs_salesteam') . "` (
	`salesteam_id` int(11) NOT NULL AUTO_INCREMENT,
	`dvs_id` int(11) NOT NULL,
	`user_id` int(11) NOT NULL,
	PRIMARY KEY (`salesteam_id`),
	KEY `dvs_id` (`dvs_id`,`user_id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ");
}


// From DVS 8.7
Phpfox::getLib('database')->query("CREATE TABLE IF NOT EXISTS `" . Phpfox::getT('phpfox_ko_dvs_salesteam_invites') . "` (
`invite_id` int(11) NOT NULL AUTO_INCREMENT,
 `dvs_id` int(11) NOT NULL,
 `email_address` varchar(255) NOT NULL,
 PRIMARY KEY (`invite_id`),
 KEY `dvs_id` (`dvs_id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ");

?>
