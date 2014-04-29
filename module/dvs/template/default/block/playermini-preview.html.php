<?php
/**
 * [PHPFOX_HEADER]
 */
defined('PHPFOX') or exit('No direct script access allowed.');

/**
 *
 *
 * @copyright   Konsort.org
 * @author      Konsort.org
 * @package     DVS
 */

?>

<style type="text/css">
  .js_box_content {l} padding: 0; {r}
</style>
<iframe src="{$sIframeUrl}" width="{if $aVals.player_type}620{else}900{/if}" height="{if $aVals.player_type}360{else}600{/if}"/>{**}
{*template file='dvs.controller.player.player*}