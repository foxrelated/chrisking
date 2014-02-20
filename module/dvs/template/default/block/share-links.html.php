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

<div id="dvs_share_links_container">
	{foreach from=$aDvss item=aDvs}
		<div class="dvs_share_link" style="padding-bottom: 10px">
			 <a href="{if $bSubdomainMode}{url link=$aDvs.title_url}{else}{url link='dvs.'$aDvs.title_url}{/if}share"  style="padding-bottom:5px;font-size:12px">{phrase var='dvs.share_links_for_dvs_name' dvs_name=$aDvs.dealer_name}</a>
		</div>
	{/foreach}
</div>