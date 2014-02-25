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
{literal}
<script type="text/javascript">
	$Behavior.shortenText = function() {
	$(".model_description").shorten({
	"showChars" : {/literal}{$iLongDescLimit}{literal},
			"ellipsesText" : "...",
			"moreText"  : "See More",
			"lessText"  : "See Less",
	});
	}</script>
{/literal}
{if $sBrowser == 'mobile'}
{template file='dvs.controller.view-mobile}
{else}
<header>
	{if $aDvs.branding_file_name}
	<a href="{if $bSubdomainMode}{url link=$aDvs.title_url}{else}{url link='dvs.'$aDvs.title_url}{/if}">{img path='core.url_file' file='dvs/branding/'.$aDvs.branding_file_name style="vertical-align:middle" max_width=1117 max_height=600}</a>
	{else}
	<h1>{$aDvs.dealer_name}</h1>
	{/if}
	<nav>
		<ul>
			<li>
				<a href="{if $bSubdomainMode}{url link=$aDvs.title_url}{else}{url link='dvs.'$aDvs.title_url}{/if}" onclick="menuHome('Top Menu Clicks');">{phrase var='dvs.home'}</a>
			</li>
			{if $aDvs.inventory_url}
			<li>
				<a href="{$aDvs.inventory_url}" onclick="menuInventory('Top Menu Clicks');" rel="nofollow">
					{phrase var='dvs.show_inventory'}
				</a>
			</li>
			{/if}
			{if $aDvs.specials_url}
			<li>
				<a href="{$aDvs.specials_url}" onclick="menuOffers('Top Menu Clicks');" rel="nofollow">
					{phrase var='dvs.special_offers'}
				</a>
			</li>
			{/if}
			<li>
				<a href="#" onclick="menuContact('Top Menu Clicks'); getPrice({$iDvsId});">{phrase var='dvs.contact_dealer'}</a>
			</li>
			{if Phpfox::isUser()}
			<li>
				<a href="{if $bSubdomainMode}{url link=$aDvs.title_url}{else}{url link='dvs.'$aDvs.title_url}{/if}share">
					{phrase var='dvs.dealer_share_links'}
				</a>
			</li>
			{if Phpfox::getUserId() == $aDvs.user_id || Phpfox::isAdmin()}
			<li>
				<a href="{url link='dvs.salesteam' id=$aDvs.dvs_id}">
					{phrase var='dvs.manage_sales_team'}
				</a>
			</li>
			{/if}
			{/if}
		</ul>
	</nav>
</header>

<article>
	<section id="player">
		{template file='dvs.controller.player.player}
	</section>

	<div id="player_left">
		<section id="select_new">
			{if $aVideoSelectYears}
			<h3>{phrase var='dvs.choose_new_vehicle'}:</h3>

			{if isset($aVideoSelectYears.1)}
			<ul>
				<li class="init">Select Year</li>
				{foreach from=$aVideoSelectYears item=iYear}
				<li onclick="$.ajaxCall('dvs.getMakes', 'iYear={$iYear}&sDvsName={$aDvs.dvs_name}');">
					{$iYear}
				</li>
				{/foreach}
			</ul>
			{/if}

			<ul id="makes">
				{if isset($aValidVSMakes.0)}
				{foreach from=$aValidVSMakes item=aMake}
				<li onclick="$('#dvs_select_box_make_text').html('{$aMake.make}'); $('#dvs_video_select_make_input').val('{$aMake.make}'); $.ajaxCall('dvs.getModels', 'iYear={$aVideoSelectYears.0}&amp;sMake={$aMake.make}&amp;iDvsId={$Dvs.dvs_id}');">
					{$aMake.make}
				</li>
				{/foreach}
				{else}
				<li class="init">
					{phrase var='dvs.please_select_a_year_first'}
				</li>
				{/if}
			</ul>

			<ul id="models">
				{if $aVideoSelectModels}
				{foreach from=$aVideoSelectModels item=aModel}
				<li onclick="$('#dvs_select_box_model_text').html('{$aModel.model}'); $.ajaxCall('dvs.videoSelect', 'sModel={$aModel.model}&amp;iYear=' + $('#dvs_video_select_year_input').val() + '&amp;sMake=' + $('#dvs_video_select_make_input').val() + '&amp;sPlaylistBorder=' + $('#dvs_playlist_border_color').val());">
					{$aModel.year} {$aModel.model}
				</li>
				{/foreach}
				{else}
				<li class="init">
					{phrase var='dvs.please_select_a_year_first'}
				</li>
				{/if}
			</ul>
			{/if}
		</section>
		<section id="dealer_links">
			<a href="./" onclick="menuHome('Call To Action Menu Clicks');">
				{phrase var='dvs.cta_home'}
			</a>
			{if $aDvs.inventory_url}
			<a href="{$aDvs.inventory_url}" onclick="menuInventory('Call To Action Menu Clicks');" rel="nofollow">
				{phrase var='dvs.cta_inventory'}
			</a>
			{/if}
			{if $aDvs.specials_url}
			<a href="{$aDvs.specials_url}" onclick="menuOffers('Call To Action Menu Clicks');" rel="nofollow">
				{phrase var='dvs.cta_specials'}
			</a>
			{/if}
			<a href="#" onclick="menuContact('Call To Action Menu Clicks'); getPrice({$iDvsId});">
				{phrase var='dvs.cta_contact'}
			</a>
		</section>
		<section id="action_links">
			<p>Click to Share:</p> 
			<a href="#" onclick="showShareEmail({$iDvsId});">
				<img src="{$sImagePath}email-share.png" alt="Share Via Email"/>
			</a>					
			<a href="#" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(location.href), 'facebook-share-dialog', 'width=626,height=436'); facebookShareClick(); return false;">
				<img src="{$sImagePath}facebook-share.png" alt="Share to Facebook"/>
			</a>
			<a href="https://twitter.com/share" data-size="large" data-count="none" id="dvs_twitter_share_link"></a>
			<a href="#" onclick="window.open('https://plus.google.com/share?url=' + encodeURIComponent(location.href)); googleShareClick(); return false;">
				<img src="{$sImagePath}google-share.png" alt="Google+" title="Google+"/>
			</a>
		</section>
	</div>

	<section id="video_information">
		<h3>
			<a href="location.href">
				{$aDvs.phrase_overrides.override_video_name_display}
			</a>
		</h3>

		<p class="model_description">{$aDvs.phrase_overrides.override_video_description_display}</p>

		{if empty($aOverrideVideo.ko_id)}
		<section>
			<h2>{$aDvs.dealer_name} of {$aDvs.city}, {$aDvs.state_string}</h2>
			<span itemprop="description">{$aDvs.text_parsed}</span>
		</section>
		{/if}	
	</section>

	<aside>
		<div id="dvs_geomap_container" itemprop="map"></div>
		{if $aDvs.url}
		{phrase var='dvs.website'}: <a href="{$aDvs.url}" rel="nofollow">{$aDvs.url}</a>
		{/if}
		{if $aDvs.phone}<br />{phrase var='dvs.phone'}: <span itemprop="telephone">{$aDvs.phone}</span>{/if}
		<p itemscope itemtype="http://schema.org/PostalAddress">
			{if $aDvs.address}Address: <span itemprop="streetAddress">{$aDvs.address}</span><br />{/if}
			<span itemprop="addressLocality">{$aDvs.city}</span>, <span itemprop="addressRegion">{$aDvs.state_string}</span>, <span itemprop="postalCode">{$aDvs.postal_code}</span>
		</p>
	</aside>
</article>

<footer>
	<h3>{phrase var='dvs.more_videos'}</h3>
	<ul>
		{foreach from=$aFooterLinks key=iKey item=aVideo name=videos}				
		<li>
			<a href="{if $bSubdomainMode}{url link=$aDvs.title_url}{else}{url link='dvs.'$aDvs.title_url}{/if}{$aVideo.video_title_url}">
				{$aVideo.year} {$aVideo.make} {$aVideo.model}
			</a>
		{/foreach}
	</ul>
</footer>
{/if}