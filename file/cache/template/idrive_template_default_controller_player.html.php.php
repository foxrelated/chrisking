<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 22, 2014, 11:16 pm */ ?>
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
 * @package 		iDrive
 */

?>
<style>
	#player {
		background-color: #<?php echo $this->_aVars['aPlayer']['player_background']; ?>;
	}
	
	#playlist_wrapper button.playlist-button {
		background-color: #<?php echo $this->_aVars['aPlayer']['player_buttons']; ?>;
		color: #<?php echo $this->_aVars['aPlayer']['playlist_arrows']; ?>;
	}
	
	#playlist_wrapper button.playlist-button:hover {
		opacity: 0.5;
	}
	
	#overview_playlist li {
		border: 2px #<?php echo $this->_aVars['aPlayer']['playlist_border']; ?> solid;
	}
</style>
<section id="player">
	<?php
						Phpfox::getLib('template')->getBuiltFile('dvs.controller.player.player');						
						?>
</section>
