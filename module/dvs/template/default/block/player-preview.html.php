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
  .js_box {l} width:920px !important;left:30% !important; top:1760px !important;{r}
  @-moz-document url-prefix() {l} .js_box {l} top:1820px !important; {r} {r}
</style>
<iframe src="{$sIframeUrl}" width="{if $aVals.player_type}620{else}920{/if}" height="{if $aVals.player_type}360{else}560{/if}"/>