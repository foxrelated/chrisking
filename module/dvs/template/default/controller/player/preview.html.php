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
?>
{$sJavascript}
<style>
	#player {l}
		background-color: #{$aPlayer.player_background};
	{r}
	
	#playlist_wrapper button.playlist-button {l}
		background-color: #{$aPlayer.player_buttons};
		color: #{$aPlayer.playlist_arrows};
	{r}
	
	#playlist_wrapper button.playlist-button:hover {l}
		opacity: 0.5;
	{r}
	
	#overview_playlist li {l}
		border: 2px #{$aPlayer.playlist_border} solid;
	{r}
</style>
<section id="player">
	{template file='dvs.controller.player.player}
</section>