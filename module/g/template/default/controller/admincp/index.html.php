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
 * @package 		G
 */

?>
{literal}
<script type="text/javascript">
	setInterval( "if ($('#keep_cache_count_updated').is(':checked') == true){ $.ajaxCall('g.updateCacheCount');}", 1000 );
</script>
{/literal}
<div id="g_status">
	No status messages	
</div>

<br />
<br />
<br />


<div id="container">
	<a onclick="$.ajaxCall('g.dumpCache');" style="background:#DFE4EE; color:#000; cursor:pointer; border:none; border:1px #B2B2B2 solid; font-size:10pt; margin:0px; padding:6px; vertical-align:middle; text-decoration: none;" href="#"><strong><span id="dump_cache_button_text">Dump Cache ({$iTotalCachedFiles} files)</span></strong></a>
	 ajax update: <input type="checkbox" id="keep_cache_count_updated"/>
</div>