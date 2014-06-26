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
{literal}
<script type="text/javascript">
    $Behavior.shortenText = function() {
        $("#car_description").shorten({
            "showChars" : {/literal}{$iLongDescLimit}{literal},
    "ellipsesText" : "...",
        "moreText"  : "See More",
        "lessText"  : "See Less",
    });
    }
</script>
{/literal}

{if $bc == 'refid' || $bPreview}
{literal}
<style type="text/css">
    #site_content{
        width: auto;
    }
</style>
{/literal}
{module name='dvstour.addtour'}
<section id="player">
    {template file='dvs.controller.player.player}
</section>
{else}
<div id="dvs_background"></div>
{if $sBrowser == 'mobile'}
{template file='dvs.controller.view-mobile}
{else}
{if !$bPreview}

{/if}
<header></header>
<article>
    <section id="player">
        {template file='dvs.controller.player.player}
    </section>

    <div id="player_right">
        <section id="select_new">
            {if $aVideoSelectYears}
            <h3>{phrase var='dvs.choose_new_vehicle'}:</h3>

            {if isset($aVideoSelectYears.1)}
            <ul id="year">
                <li class="init"><span class="init_selected">Select Year</span>
                    <ul>
                        {foreach from=$aVideoSelectYears item=iYear}
                        <li onclick="$.ajaxCall('dvs.getMakes', 'iYear={$iYear}&amp;sDvsName={$aDvs.title_url}');">
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
            {/if}
        </section>
        <section id="dealer_links">
            {if $aDvs.inventory_url}
            <a href="{$aDvs.inventory_url}" onclick="menuInventory('Call To Action Menu Clicks');" rel="nofollow" target="_parent">
                {phrase var='dvs.cta_inventory'}
            </a>
            {/if}
            {if $aDvs.specials_url}
            <a href="{$aDvs.specials_url}" onclick="menuOffers('Call To Action Menu Clicks');" rel="nofollow" target="_parent">
                {phrase var='dvs.cta_specials'}
            </a>
            {/if}
        </section>
        <section id="action_links">
            <p>Click to Share:</p>
            <a href="#" onclick="tb_show('{phrase var='dvs.share_via_email'}', $.ajaxBox('dvs.emailForm', 'height=400&amp;width=360&amp;longurl=1&amp;iDvsId={$iDvsId}&amp;sRefId=' + aCurrentVideoMetaData.referenceId)); showEmailShare(); return false;">
                <img src="{$sImagePath}email-share.png" alt="Share Via Email"/>
            </a>
            <a href="#" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(location.href), '', 'width=626,height=436'); facebookShareClick('Share Links'); return false;">
                <img src="{$sImagePath}facebook-share.png" alt="Share to Facebook"/>
            </a>
          <span id="twitter_button_wrapper">
            <a href="https://twitter.com/intent/tweet?text={phrase var='dvs.twitter_default_share_text' video_year=$aDvs.featured_year video_make=$aDvs.featured_make video_model=$aDvs.featured_model dvs_dealer_name=$aDvs.dealer_name}&url={$sCurrentUrlEncoded}" id="twitter_share"><img src="{$sImagePath}twitter-button.png" alt="Tweet" /></a>
          </span>
            <a href="#" onclick="window.open('https://plus.google.com/share?url=' + encodeURIComponent(location.href)); googleShareClick('Share Links'); return false;">
                <img src="{$sImagePath}google-share.png" alt="Google+" title="Google+"/>
            </a>
        </section>
    </div>

    <section id="video_information">
        <h3 id="video_name">
            <a href="location.href">
                {$aDvs.phrase_overrides.override_video_name_display}
            </a>
        </h3>

        <p class="model_description" id="car_description">{$aDvs.phrase_overrides.override_video_description_display}</p>

        {if empty($aOverrideVideo.ko_id)}
        <section>
            <h2>{$aDvs.dealer_name} of {$aDvs.city}, {$aDvs.state_string}</h2>
            <p itemprop="description" class="model_description">{$aDvs.text_parsed}</p>
        </section>
        {/if}
    </section>

    <aside>
        
    </aside>
</article>

{/if}
{/if}
{module name='dvstour.addtour'} <!--nplkoder add this line-->