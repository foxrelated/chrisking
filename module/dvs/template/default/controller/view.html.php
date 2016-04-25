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
    {if $sBrowser == 'mobile'}
        {template file='dvs.controller.view-mobile}
    {else}
        {literal}
        <style type="text/css">
            #site_content{
                width: auto;
            }
        </style>
        {/literal}
        {module name='dvstour.addtour'}
        {if $aPlayer.player_type != "2"}
        <section id="player">
            {template file='dvs.controller.player.player}
        </section>
        {else}
        <section id="player">
            {template file='dvs.controller.player.playerhtml5}
        </section>
        {/if}
    {/if}
{else}
  {if $sBrowser == 'mobile'}
    {template file='dvs.controller.view-mobile}
  {else}
    {if !$bPreview}
      
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
      
    {/if}
	
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
        </ul>
      </nav>
    </header>
    <article>
    <!-- HTML5 V2 RealIT Services -->
    {if $aPlayer.player_type != "2"}
      <section id="player">
        {template file='dvs.controller.player.player}
      </section>
    {else}
    <section id="player">
    {template file = 'dvs.controller.player.playerhtml5}
    </section>
    {/if}  
      <div id="player_right">
        <section id="select_new">
          {if $aVideoSelectYears}
          <h3>{phrase var='dvs.choose_new_vehicle'}:</h3>

          {if isset($aVideoSelectYears.0)}
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
          <a href="{$aDvs.inventory_url}" class="dvs_inventory_link" onclick="menuInventory('Call To Action Menu Clicks');" target="_parent">
            {phrase var='dvs.cta_inventory'}
          </a>
          {/if}
          {if $aDvs.specials_url}
          <a href="{$aDvs.specials_url}" onclick="menuOffers('Call To Action Menu Clicks');" target="_parent">
            {phrase var='dvs.cta_specials'}
          </a>
          {/if}
          <a href="#" onclick="tb_show('{phrase var='dvs.contact_dealer'}', $.ajaxBox('dvs.showGetPriceForm', 'height=400&amp;width=360&amp;iDvsId={$iDvsId}&amp;sRefId=' + aCurrentVideoMetaData.referenceId)); menuContact('Call To Action Menu Clicks'); return false;">
            {phrase var='dvs.cta_contact'}
          </a>
          {if Phpfox::isUser()}
          	<br /><br />
            <p><b>Dealer-Only Links:</b></p><br />
            <a href="{if $bSubdomainMode}{url link=$aDvs.title_url}{else}{url link='dvs.'$aDvs.title_url}{/if}share" onclick="" rel="nofollow" target="_blank" style="font-size:14px;">
            {phrase var='dvs.dealer_share_links'}
          	</a>
            {if Phpfox::getUserId() == $aDvs.user_id || Phpfox::isAdmin()}
            <a href="{url link='dvs.salesteam' id=$aDvs.dvs_id}" onclick="" rel="nofollow" target="_blank"  style="font-size:14px;">
            {phrase var='dvs.manage_sales_team'}
          	</a>
            {/if}
          {/if}
        </section>

        <section id="action_links">
          <input type="hidden" value="{$sVideoHashCode}" id="video_hash_code" />
			 {if !Phpfox::isUser()}
			  <p>Click to Share:</p>
			  <a href="#" onclick="tb_show('{phrase var='dvs.share_via_email'}', $.ajaxBox('dvs.emailForm', 'height=400&amp;width=360&amp;longurl=1&amp;iDvsId={$iDvsId}&amp;sRefId=' + aCurrentVideoMetaData.referenceId)); showEmailShare(); return false;">
				<img src="{$sImagePath}email-share.png" alt="Share Via Email"/>
			  </a>
			  <a href="#" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURI('{url link='share'}' + $('#video_hash_code').val() + '{$sDvsHashCode}0'), '', 'width=626,height=436'); facebookShareClick('Share Links'); return false;">
				<img src="{$sImagePath}facebook-share.png" alt="Share to Facebook"/>
			  </a>
			  <span id="twitter_button_wrapper">
				<a href="https://twitter.com/intent/tweet?text={phrase var='dvs.twitter_default_share_text' video_year=$aFirstVideo.year video_make=$aFirstVideo.make video_model=$aFirstVideo.model dvs_dealer_name=$aDvs.dealer_name}&url={$sShareCode}1" id="twitter_share"><img src="{$sImagePath}twitter-button.png" alt="Tweet" /></a>
			  </span>
			  <a href="#" onclick="window.open('https://plus.google.com/share?url=' + encodeURI('{url link='share'}' + $('#video_hash_code').val() + '{$sDvsHashCode}2')); googleShareClick('Share Links'); return false;">
				<img src="{$sImagePath}google-share.png" alt="Google+" title="Google+"/>
			  </a>
			  {/if}
        </section>
      </div>

      <section id="video_information">
        <h3 id="video_name" itemprop="name">
          <a href="{$sOverrideLink}" itemprop="url" target="_parent">
            {$aDvs.phrase_overrides.override_video_name_display}
          </a>
        </h3>

        <p class="model_description" id="car_description" itemprop="description">{$aDvs.phrase_overrides.override_video_description_display}</p>
		
      </section>
      
	
      <div class="clear"></div>
    </article>
	
    <footer>
      <h3>{phrase var='dvs.more_videos'}</h3>
      <ul id="related_videos">
          {module name='dvs.related-video' aDvs=$aDvs aVideo=$aFirstVideo}
      </ul>
    </footer>
	
  {/if}
{/if}

{if $sVdpIframeUrl != ''}
<iframe src="{$sVdpIframeUrl}" height="1" width="1"></iframe>
{/if}

{module name='dvstour.addtour'}


{if !$aDvs.is_active}
    {template file='dvs.block.deactive'}
    <script type="text/javascript">
        $Behavior.googleDvsDeactive = function() {l}
            {if $sBrowser == 'mobile'}
                sendToGoogle('DVS Mobile', 'DVS Deactivated', 'Deactivation Message Shown');
                mixpanel.track("Deactivation Message Shown");
            {else}
                sendToGoogle('DVS Site', 'DVS Deactivated', 'Deactivation Message Shown');
                mixpanel.track("Deactivation Message Shown");
            {/if}
        {r}
    </script>
{/if}