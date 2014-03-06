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
<meta name="viewport" content="width=600, initial-scale=0.5, maximum-scale=1.0, user-scalable=0">
<header>
	{if $aDvs.branding_file_name}
	<a href="{if $bSubdomainMode}{url link=$aDvs.title_url}{else}{url link='dvs.'$aDvs.title_url}{/if}">{img path='core.url_file' file='dvs/branding/'.$aDvs.branding_file_name style="vertical-align:middle"}</a>
	{else}
	<h1>{$aDvs.dealer_name}</h1>
	{/if}
</header>
<article>
	<section id="player">
		{template file='dvs.controller.player.player-mobile}
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
			<a href="#" onclick="tb_show('{phrase var='dvs.contact_dealer'}', $.ajaxBox('dvs.showGetPriceForm', 'height=600&amp;width=460&amp;iDvsId={$iDvsId}&amp;sRefId=' + aCurrentVideoMetaData.referenceId)); menuContact('Call To Action Menu Clicks'); return false;">
				{phrase var='dvs.cta_contact'}
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
		<p><strong>{$aDvs.dealer_name} Contact Information</strong>
		{if $aDvs.url}
			{phrase var='dvs.website'}: <a href="{$aDvs.url}" rel="nofollow">{$aDvs.url}</a>
			{/if}
			{if $aDvs.phone}<br />{phrase var='dvs.phone'}: <span itemprop="telephone">{$aDvs.phone}</span>{/if}</p>
		<p itemscope itemtype="http://schema.org/PostalAddress">
			{if $aDvs.address}Address: <span itemprop="streetAddress">{$aDvs.address}</span>{/if}</p>
		<p><span itemprop="addressLocality">{$aDvs.city}</span>, <span itemprop="addressRegion">{$aDvs.state_string}</span>, <span itemprop="postalCode">{$aDvs.postal_code}</span>
		</p>
	</aside>
	
	<section id="action_links">
		<p>Click to Share:</p> 
		<a href="#" onclick="tb_show('{phrase var='dvs.share_via_email'}', $.ajaxBox('dvs.emailForm', 'height=600&amp;width=460&amp;iDvsId={$iDvsId}&amp;sRefId=' + aCurrentVideoMetaData.referenceId)); return false;">
			<img src="{$sImagePath}email-share.png" alt="Share Via Email"/>
		</a>					
		<a href="#" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(location.href), 'facebook-share-dialog', 'width=626,height=436'); facebookShareClick(); return false;">
			<img src="{$sImagePath}facebook-share.png" alt="Share to Facebook"/>
		</a><br />
		<span id="twitter_button_wrapper">
			<a href="https://twitter.com/share" class="twitter-share-button twitter_popup" data-size="large" data-count="none" id="dvs_twitter_share_link" ></a>
		</span>
	</section>
</article>