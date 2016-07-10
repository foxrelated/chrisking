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

<style type="text/css">
  .js_box_content {l} padding: 0; {r}
  .js_box {l} width:920px !important;left:5% !important; top:0 !important; position:fixed;margin-left:0 !important;{r}
  
</style>
<iframe src="{$sIframeUrl}" width="{if $aVals.player_type}620{else}920{/if}" height="{if $aVals.player_type}360{else}560{/if}"/>