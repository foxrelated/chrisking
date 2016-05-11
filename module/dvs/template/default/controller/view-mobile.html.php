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
		<section id="dealer_links">
			
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
			{*<a href="#" onclick="tb_show('{phrase var='dvs.contact_dealer'}', $.ajaxBox('dvs.showGetPriceForm', 'height=600&amp;width=520&amp;iDvsId={$iDvsId}&amp;sRefId=' + aCurrentVideoMetaData.referenceId)); menuContact('Call To Action Menu Clicks'); return false;">
				{phrase var='dvs.cta_contact'}
			</a>*}
		</section>
		<section id="select_new">
			{if $aVideoSelectYears}
			<h3>{phrase var='dvs.choose_new_vehicle'}:</h3>
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
		{if $aDvs.iframe_contact_form}
            <aside>
                <div id="contact_box">
                    <h2>Contact {$aDvs.dealer_name}</h2>
                    {template file='dvs.block.contact-iframe}
                </div>
            </aside>
            {/if}
	</div>

	<section id="video_information">
		
		{if empty($aOverrideVideo.ko_id)}
		<section>
			<h2>{$aDvs.dealer_name} of {$aDvs.city}, {$aDvs.state_string}</h2>
			<p itemprop="description" class="model_description">{$aDvs.text_parsed}</p>
		</section>
		{/if}	
	</section>

	<aside>
		<p><strong>{$aDvs.dealer_name} Information</strong><br>
		{if $aDvs.url}
			{phrase var='dvs.website'}: <a href="{$aDvs.url}" rel="nofollow" target="_parent">{$aDvs.url}</a>
			{/if}
			{if $aDvs.phone}<br />{phrase var='dvs.phone'}: <span itemprop="telephone">{$aDvs.phone}</span>{/if}</p>
		<p itemscope itemtype="http://schema.org/PostalAddress">
			{if $aDvs.address}Address: <span itemprop="streetAddress">{$aDvs.address}</span>{/if}</p>
		<p><span itemprop="addressLocality">{$aDvs.city}</span>, <span itemprop="addressRegion">{$aDvs.state_string}</span>, <span itemprop="postalCode">{$aDvs.postal_code}</span>
		</p>
	</aside>
	
	
</article>