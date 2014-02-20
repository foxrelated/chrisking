<?php

/**
 * [PHPFOX_HEADER]
 */
defined('PHPFOX') or exit('No direct script access allowed.');

/**
 *
 *
 * @copyright		Konsort.org 
 * @author  		Konsort.org
 * @package 		DVS
 */
class Dvs_Component_Controller_Admincp_Test extends Phpfox_Component {

	public function process()
	{
		$oDatabase = Phpfox::getLib('database');

		if (!(Phpfox::getLib('database')->isField(Phpfox::getT('ko_dvs_players'), "featured_make")))
		{
			//Upgrading from DVS 4.x


			$oDatabase->query("CREATE TABLE IF NOT EXISTS `" . Phpfox::getT('ko_dvs_player_makes') . "` (
		`pmake_id` int(11) NOT NULL AUTO_INCREMENT,
		`player_id` int(11) NOT NULL,
		`make` varchar(32) NOT NULL,
		PRIMARY KEY (`pmake_id`),
		KEY `player_id` (`player_id`,`make`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ");

			$oDatabase->query("CREATE TABLE IF NOT EXISTS `" . Phpfox::getT('ko_idrive_player_makes') . "` (
		`pmake_id` int(11) NOT NULL AUTO_INCREMENT,
		`player_id` int(11) NOT NULL,
		`make` varchar(32) NOT NULL,
		PRIMARY KEY (`pmake_id`),
		KEY `player_id` (`player_id`,`make`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ");

			// Add featured make column
			$oDatabase->query("ALTER TABLE `" . Phpfox::getT('ko_dvs_players') . "` ADD `featured_make` VARCHAR( 64 ) NOT NULL AFTER `google_id`");
			$oDatabase->query("ALTER TABLE `" . Phpfox::getT('ko_idrive_players') . "` ADD `featured_make` VARCHAR( 64 ) NOT NULL AFTER `google_id`");

			// Add make for each DVS player, set featured make
			$aDvsPlayers = $oDatabase
				->select('*')
				->from(Phpfox::getT('ko_dvs_players'))
				->execute('getRows');

			foreach ($aDvsPlayers as $aPlayer)
			{
				// Add make to player
				$oDatabase->insert(Phpfox::getT('ko_dvs_player_makes'), array(
					'player_id' => (int) $aPlayer['player_id'],
					'make' => Phpfox::getLib('parse.input')->clean($aPlayer['make'])
				));

				// If there is a featured model, set featured make
				if ($aPlayer['featured_model'])
				{
					$oDatabase->update(Phpfox::getT('ko_dvs_players'), array(
						'featured_make' => Phpfox::getLib('parse.input')->clean($aPlayer['make'])
						), 'player_id = ' . (int) $aPlayer['player_id']);
				}
			}

			// Add make for each DVS player, set featured make
			$iDrivePlayers = $oDatabase
				->select('*')
				->from(Phpfox::getT('ko_idrive_players'))
				->execute('getRows');

			foreach ($iDrivePlayers as $aPlayer)
			{
				// Add make to player
				$oDatabase->insert(Phpfox::getT('ko_idrive_player_makes'), array(
					'player_id' => (int) $aPlayer['player_id'],
					'make' => Phpfox::getLib('parse.input')->clean($aPlayer['make'])
				));

				// If there is a featured model, set featured make
				if ($aPlayer['featured_model'])
				{
					$oDatabase->update(Phpfox::getT('ko_idrive_players'), array(
						'featured_make' => Phpfox::getLib('parse.input')->clean($aPlayer['make'])
						), 'player_id = ' . (int) $aPlayer['player_id']);
				}
			}

			// Remove make column from players
			$oDatabase->query("ALTER TABLE `" . Phpfox::getT('ko_dvs_players') . "` DROP `make`");
			$oDatabase->query("ALTER TABLE `" . Phpfox::getT('ko_idrive_players') . "` DROP `make`");
		}
	}


}

?>