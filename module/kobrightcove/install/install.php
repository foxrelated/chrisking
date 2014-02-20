<?php

// From 1.0
Phpfox::getLib('database')->query("CREATE TABLE IF NOT EXISTS `" . Phpfox::getT('ko_brightcove') . "` (
`ko_id` INT( 12 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`id` bigint(12) NOT NULL ,
`name` text NOT NULL ,
`adKeys` text ,
`shortDescription` text ,
`longDescription` text ,
`creationDate` bigint(13) NOT NULL ,
`publishedDate` bigint(13) NOT NULL ,
`lastModifiedDate` bigint(13) NOT NULL ,
`linkURL` text ,
`linkText` text ,
`tags` text ,
`videoStillURL` text NOT NULL ,
`thumbnailURL` text NOT NULL ,
`referenceId` text NOT NULL ,
`length` bigint(8) NOT NULL default '0' ,
`economics` text ,
`playsTotal` int(16) NOT NULL default '0' ,
`playsTrailingWeek` int(16) NOT NULL default '0' ,
`year` int(4) default NULL ,
`make` text ,
`model` text ,
`bodyStyle` text ,
`timestamp` INT( 12 ) NOT NULL
) ENGINE=MyISAM ");

// From 3.0
if (!(Phpfox::getLib('database')->isField(Phpfox::getT('ko_brightcove'), "video_title_url")))
{
	Phpfox::getLib('database')->addField(array(
		'table' => Phpfox::getT('ko_brightcove'),
		'field' => 'video_title_url',
		'type' => 'VARCHAR',
		'attribute' => '(64)',
		'null' => 'Not Null'
	));
}


// From 4.0
if (!(Phpfox::getLib('database')->isField(Phpfox::getT('ko_brightcove'), "server_id")))
{
	Phpfox::getLib('database')->addField(array(
		'table' => Phpfox::getT('ko_brightcove'),
		'field' => 'server_id',
		'type' => 'TINYINT',
		'attribute' => '(1)',
		'null' => 0
	));

	Phpfox::getLib('database')->addField(array(
		'table' => Phpfox::getT('ko_brightcove'),
		'field' => 'thumbnail_image',
		'type' => 'varchar',
		'attribute' => '(128)',
		'null' => 0
	));

	Phpfox::getLib('database')->addField(array(
		'table' => Phpfox::getT('ko_brightcove'),
		'field' => 'video_still_image',
		'type' => 'varchar',
		'attribute' => '(128)',
		'null' => 0
	));
}

?>
