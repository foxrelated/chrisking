<?php
/**
 * [PHPFOX_HEADER]
 */
defined('PHPFOX') or exit('GO MICE!');

/**
 *
 *
 * @copyright	Konsort.org
 * @author  		Konsort.org
 * @package 		KOBrightcove
 */

?>
<div class="table">
	<div class="table_left">
		Total DVS:
	</div>
	<div class="table_right">
		{$iTotalDvs}
	</div>
</div>

<div class="table">
	<div class="table_left">
		Total DVS With Location Cache:
	</div>
	<div class="table_right">
		{$iTotalLocations}
	</div>
</div>

<div class="table">
	<div class="table_left">
		Total DVS Without Location Cache:
	</div>
	<div class="table_right">
		{$iTotalBlank}
	</div>
</div>

<div class="table">
	<div class="table_left">
		&nbsp;
	</div>
	<div class="table_right">
		<a href="{url link='current' rebuild=1}" onclick="return confirm('Warning: This script relies on an external API call.\nRebuilding the location cache could take longer than the script timeout allows for.\n\nIn the event this script times out, please reload the page.\n\nContinue reloading until all DVS locations are cached.\n\nClick OK to begin rebuilding the cache.');" class='button' style='text-decoration:none;font-size:1.5em;font-weight:bold'>Rebuild Cache</a>
	</div>
</div>