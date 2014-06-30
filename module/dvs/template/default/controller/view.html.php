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
  {if $sBrowser == 'mobile'}
    {template file='dvs.controller.view-mobile}
  {else}
    {if !$bPreview}
      {if $aDvs.banner_toggle == 1} <!--phpmasterminds added this code for header toggle -->
      	{if $aDvs.branding_file_name}
			<a href="{$aDvs.url}" target="_parent">
			  {img path='core.url_file'
				   file='dvs/branding/'.$aDvs.branding_file_name
				   style="vertical-align:middle; max-width: 100% !important; height: auto !important;"
				   max_width=1117}
			</a>
      	{else}
        <h1><a href="{$aDvs.url}" target="_parent">{$aDvs.dealer_name}</a></h1>
      	{/if}
      {/if} <!--phpmasterminds added this code for header toggle -->
    {/if}
	{if $aDvs.topmenu_toggle == 1} <!--phpmasterminds added this code for Menu toggle -->
    <header>
      <nav>
        <ul>
          <li>
            <a href="{$aDvs.url}" onclick="menuHome('Top Menu Clicks');" target="_parent">{phrase var='dvs.home'}</a>
          </li>
          {if $aDvs.inventory_url}
            <li>
              <a href="{$aDvs.inventory_url}" class="dvs_inventory_link" onclick="menuInventory('Top Menu Clicks');" rel="nofollow" target="_parent">
                {phrase var='dvs.show_inventory'}
              </a>
            </li>
          {/if}

          {if $aDvs.specials_url}
            <li>
              <a href="{$aDvs.specials_url}" onclick="menuOffers('Top Menu Clicks');" rel="nofollow" target="_parent">
                {phrase var='dvs.special_offers'}
              </a>
            </li>
          {/if}

          <li>
            <a href="#" onclick="menuContact('Top Menu Clicks'); tb_show('{phrase var='dvs.contact_dealer'}', $.ajaxBox('dvs.showGetPriceForm', 'height=400&amp;width=360&amp;iDvsId={$iDvsId}&amp;sRefId=' + aCurrentVideoMetaData.referenceId)); return false;">{phrase var='dvs.contact_dealer'}</a>
          </li>

          {if Phpfox::isUser()}
            <li>
              <a href="{if $bSubdomainMode}{url link=$aDvs.title_url}{else}{url link='dvs.'$aDvs.title_url}{/if}share" target="_blank">
                {phrase var='dvs.dealer_share_links'}
              </a>
            </li>
            {if Phpfox::getUserId() == $aDvs.user_id || Phpfox::isAdmin()}
              <li>
                <a href="{url link='dvs.salesteam' id=$aDvs.dvs_id}" target="_blank">
                  {phrase var='dvs.manage_sales_team'}
                </a>
              </li>
            {/if}
          {/if}
        </ul>
      </nav>
    </header>
	{/if}<!--phpmasterminds added this code for Menu toggle ends -->
    <article>
      <section>
        <div class="dvs-info" style="padding-top:10px;font-size:13px;font-weight:bold;"><p>To start your video test drive, select a year, make and model or click on the play button below. Instantly view what's important to you by clicking the chapter buttons to the right.</p></div>
      </section>
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
          <a href="{$aDvs.url}" onclick="menuHome('Call To Action Menu Clicks');" target="_parent">
            {phrase var='dvs.cta_home'}
          </a>
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
          <a href="#" onclick="tb_show('{phrase var='dvs.contact_dealer'}', $.ajaxBox('dvs.showGetPriceForm', 'height=400&amp;width=360&amp;iDvsId={$iDvsId}&amp;sRefId=' + aCurrentVideoMetaData.referenceId)); menuContact('Call To Action Menu Clicks'); return false;">
            {phrase var='dvs.cta_contact'}
          </a>
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
        <div id="dvs_geomap_container" itemprop="map"></div>
        <p>{if $aDvs.url}
          {phrase var='dvs.website'}: <a href="{$aDvs.url}" rel="nofollow" target="_parent">{$aDvs.url}</a>
          {/if}
          {if $aDvs.phone}<br />{phrase var='dvs.phone'}: <span itemprop="telephone">{$aDvs.phone}</span>{/if}</p>
        <p itemscope itemtype="http://schema.org/PostalAddress">
          {if $aDvs.address}Address: <span itemprop="streetAddress">{$aDvs.address}</span>{/if}</p>
        <p><span itemprop="addressLocality">{$aDvs.city}</span>, <span itemprop="addressRegion">{$aDvs.state_string}</span>, <span itemprop="postalCode">{$aDvs.postal_code}</span>
        </p>
      </aside>
    </article>
	{if $aDvs.footer_toggle == 1} <!--phpmasterminds added this code for footer toggle -->
    <footer>
      <h3>{phrase var='dvs.more_videos'}</h3>
      <ul>
        {foreach from=$aFooterLinks key=iKey item=aVideo name=videos}
        <li>
          <a href="{if $bSubdomainMode}{url link=$aDvs.title_url}{else}{url link='dvs.'$aDvs.title_url}{/if}{$aVideo.video_title_url}" onclick="menuFooter('Footer Link Clicks');" target="_parent">
            {$aVideo.year} {$aVideo.make} {$aVideo.model}
          </a>
          {/foreach}
      </ul>
    </footer>
	{/if} <!--phpmasterminds added this code for footer toggle -->
  {/if}
{/if}
{module name='dvstour.addtour'} <!--nplkoder add this line-->