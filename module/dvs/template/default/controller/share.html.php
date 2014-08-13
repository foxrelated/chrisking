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
        <h3>{phrase var='dvs.choose_new_vehicle'}:</h3>

        {if isset($aVideoSelectYears.1)}
        <ul id="year">
            <li class="init"><span class="init_selected">Select Year</span>
                <ul>
                    {foreach from=$aVideoSelectYears item=iYear}
                    <li onclick="$.ajaxCall('dvs.getShareMakes', 'iYear={$iYear}&amp;sDvsName={$aDvs.title_url}');">
                        {$iYear}
                    </li>
                    {/foreach}
                </ul>
            </li>
        </ul>
        {/if}

        <ul id="makes">
            <li class="init">
                {phrase var='dvs.select_make'}
                <ul>
                    <li>
                        {phrase var='dvs.please_select_a_year_first'}
                    </li>
                </ul>
            </li>
        </ul>

        <ul id="models">
            <li class="init">
                {phrase var='dvs.select_model'}
                <ul>
                    <li>
                        {phrase var='dvs.please_select_a_year_first'}
                    </li>
                </ul>
            </li>
        </ul>
        <div class="clear"></div>
        {/if}
    </section>


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