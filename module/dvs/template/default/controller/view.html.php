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
		$("#car_description").shorten({
			"showChars" : {/literal}{$iLongDescLimit}{literal},
			"ellipsesText" : "...",
			"moreText"  : "See More",
			"lessText"  : "See Less",
		});
	}
</script>
{/literal}
<style>
	/* This CSS is generated for the base DVS page */
	header h1 {l}
		color: #{$aDvs.page_text};
	{r}
	
	header nav {l}
		background-color: #{$aDvs.menu_background};
		border: 5px solid #{$aDvs.menu_background};
	{r}
	
	header nav a,
	header nav a:hover,
	nav li + li:before {l}
		color: #{$aDvs.menu_link};
	{r}
	
	body {l}
		background-color: #{$aDvs.page_background};
	{r}
	
	#dvs_background {l}
		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		background-image: url('{$sBackgroundPath}');
		background-attachment: fixed;
		opacity: {$iBackgroundOpacity / 100};
		filter:alpha(opacity={$iBackgroundOpacity});
		z-index: -1;
	{r}
	
	#video_information h3,
	#video_information a,
	.model_description,
	footer h3,
	article aside,
	#video_information section h2,
	#select_new h3,
	#action_links p {l}
		color: #{$aDvs.page_text};
	{r}
	
	aside a,
	aside a:hover {l}
		color: #{$aDvs.text_link};
	{r}
	
	footer a,
	footer a:hover {l}
		color: #{$aDvs.footer_link};
	{r}
	
	#dealer_links a {l}
		background-color: #{$aDvs.button_background};
		background-image: -webkit-linear-gradient(top, #{$aDvs.button_top_gradient}, #{$aDvs.button_bottom_gradient});
		background: -moz-linear-gradient( center top, #{$aDvs.button_top_gradient} 5%, #{$aDvs.button_bottom_gradient} 100% );
		filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#{$aDvs.button_top_gradient}', endColorstr='#{$aDvs.button_bottom_gradient}');
		border: 1px solid #{$aDvs.button_border};
		color: #{$aDvs.button_text};
	{r}
	
	#dealer_links a:hover {l}
		background-image: -webkit-linear-gradient(top, #{$aDvs.button_bottom_gradient}, #{$aDvs.button_top_gradient});
		background: -moz-linear-gradient( center top, #{$aDvs.button_bottom_gradient} 5%, #{$aDvs.button_top_gradient} 100% );
		filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#{$aDvs.button_bottom_gradient}', endColorstr='#{$aDvs.button_top_gradient}');
		background-color: #{$aDvs.button_background};
		border: 1px solid #{$aDvs.button_border};
		color: #{$aDvs.button_text};
	{r}
	
	/* This CSS is generated for the DVS player block */
	#player {l}
		background-color: #{$aDvs.player_background};
	{r}
	
	#playlist_wrapper button.playlist-button {l}
		background-color: #{$aDvs.player_buttons};
		color: #{$aDvs.playlist_arrows};
	{r}
	
	#playlist_wrapper button.playlist-button:hover {l}
		opacity: 0.5;
	{r}
	
	#overview_playlist li {l}
		border: 2px #{$aDvs.playlist_border} solid;
	{r}
</style>
<div id="dvs_background"></div>
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
				<a href="#" onclick="menuContact('Top Menu Clicks'); tb_show('{phrase var='dvs.contact_dealer'}', $.ajaxBox('dvs.showGetPriceForm', 'height=400&amp;width=360&amp;iDvsId={$iDvsId}&amp;sRefId=' + aCurrentVideoMetaData.referenceId)); return false;">{phrase var='dvs.contact_dealer'}</a>
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

	<div id="player_right">
		<section id="select_new">
			{if $aVideoSelectYears}
			<h3>{phrase var='dvs.choose_new_vehicle'}:</h3>

			{if isset($aVideoSelectYears.1)}
			<ul id="year">
				<li class="init"><span class="init_selected">Select Year</span>
					<ul>
						{foreach from=$aVideoSelectYears item=iYear}
						<li onclick="$.ajaxCall('dvs.getMakes', 'iYear={$iYear}&sDvsName={$aDvs.title_url}');">
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
			<a href="#" onclick="tb_show('{phrase var='dvs.contact_dealer'}', $.ajaxBox('dvs.showGetPriceForm', 'height=400&amp;width=360&amp;iDvsId={$iDvsId}&amp;sRefId=' + aCurrentVideoMetaData.referenceId)); menuContact('Call To Action Menu Clicks'); return false;">
				{phrase var='dvs.cta_contact'}
			</a>
		</section>
		<section id="action_links">
			<p>Click to Share:</p> 
			<a href="#" onclick="tb_show('{phrase var='dvs.share_via_email'}', $.ajaxBox('dvs.emailForm', 'height=400&amp;width=360&amp;iDvsId={$iDvsId}&amp;sRefId=' + aCurrentVideoMetaData.referenceId)); return false;">
				<img src="{$sImagePath}email-share.png" alt="Share Via Email"/>
			</a>					
			<a href="#" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(location.href), 'facebook-share-dialog', 'width=626,height=436'); facebookShareClick(); return false;">
				<img src="{$sImagePath}facebook-share.png" alt="Share to Facebook"/>
			</a>
			<span id="twitter_button_wrapper">
				<a href="https://twitter.com/share" class="twitter-share-button twitter_popup" data-size="large" data-count="none" id="dvs_twitter_share_link"></a>
			</span>
			<a href="#" onclick="window.open('https://plus.google.com/share?url=' + encodeURIComponent(location.href)); googleShareClick(); return false;">
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
			{phrase var='dvs.website'}: <a href="{$aDvs.url}" rel="nofollow">{$aDvs.url}</a>
			{/if}
			{if $aDvs.phone}<br />{phrase var='dvs.phone'}: <span itemprop="telephone">{$aDvs.phone}</span>{/if}</p>
		<p itemscope itemtype="http://schema.org/PostalAddress">
			{if $aDvs.address}Address: <span itemprop="streetAddress">{$aDvs.address}</span>{/if}</p>
		<p><span itemprop="addressLocality">{$aDvs.city}</span>, <span itemprop="addressRegion">{$aDvs.state_string}</span>, <span itemprop="postalCode">{$aDvs.postal_code}</span>
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