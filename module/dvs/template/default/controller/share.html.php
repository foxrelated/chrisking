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
<div id="dvs_share_wrapper">
    <section id="select_new">
        {if $aVideoSelectYears}
		<table width="650px">
		<tr>
		<td style="vertical-align:bottom;padding-right:10px;"><h1 style="font-size:14px;font-weight:bold;">Filter Videos:</h1></td>
        
        {if isset($aVideoSelectYears.1)}
        <td style="vertical-align:top;">
        <ul id="year">
            <li class="init"><span class="init_selected">{if isset($iYear) && ($iYear > 0)}{$iYear}{else}Select Year{/if}</span>
                <ul>
                    {foreach from=$aVideoSelectYears item=iYear}
                    <li onclick="$.ajaxCall('dvs.getShareMakes', 'iYear={$iYear}&amp;sDvsName={$aDvs.title_url}');">
                        {$iYear}
                    </li>
                    {/foreach}
                </ul>
            </li>
        </ul>
        </td>
        {/if}
		<td style="vertical-align:top;">
        <ul id="makes">
            <li class="init">
                {if isset($sMake) && $sMake}<span class="init_selected">{$sMake}</span>{else}{phrase var='dvs.select_make'}{/if}
                <ul>
                    {if isset($aMakes) && count($aMakes)}
                    {foreach from=$aMakes item=aMake}
                    <li onclick="$.ajaxCall('dvs.getShareModels', 'sDvsName={$aDvs.title_url}&amp;iYear={$iYear}&amp;sMake={$aMake.make}');">{$aMake.make}</li>
                    {/foreach}
                    {else}
                    <li>
                        {phrase var='dvs.please_select_a_year_first'}
                    </li>
                    {/if}
                </ul>
            </li>
        </ul>
        </td>
        </tr>
        </table>
        {/if}
        <div class="clear"></div>
    </section>
<br>

	<div id="dvs_share_container">
		<input class="dvs_share_text_box" type="hidden" id="share_link_box">

		{assign var='baseUrl' value=''}
    {if $baseUrl = Phpfox::getParam('core.path')}{/if}
		<script type="text/javascript" src="{$baseUrl}module/dvs/static/jscript/clipboard/ZeroClipboard.js"></script>

        <div id="video_items">
            {module name='dvs.share-video' aShareVideos=$aDvsVideos aDvs=$aDvs}
        </div>
	</div>
</div>