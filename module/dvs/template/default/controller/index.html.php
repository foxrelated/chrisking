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
{if isset($sMessage) && $sMessage}
	{literal}
		<script type="text/javascript">
			$(document).ready(function() {
				$('#dvs_message').show('slow');
				$('#dvs_message').animate({top: 0}, 1000).hide('slow');
			});
		</script>
	{/literal}
	<div class="message" id="dvs_message" style="display:none;">
		{$sMessage}
	</div>
{/if}

<div id="add_dvs_button" {if !$bCanAddDvss}style="display:none;"{/if}>
	<a href="{url link='dvs.settings'}" class="button-link" style="width:90px;height:10px;padding:2px 2px 15px 2px;margin:0px;">{phrase var='dvs.add_dvs'}</a>
	<div class="main_break"></div>
	<div class="main_break"></div>
</div>



{if $aDvss}
	<div id="dvss" {if $bCanAddDvss}class="separate"{/if} style="margin:15px 0px 0px 0px;">
		<table style="width:100%;border-collapse:collapse;">
			<tr>
				<th align="left" style="padding-bottom: .5em; padding-right: 1em; font-weight:bold;">
					{phrase var='dvs.showroom_name'}
				</th>
				<th align="left" style="padding-bottom: .5em; padding-right: 1em; text-align: center; font-weight:bold;">
					{phrase var='dvs.dealer_name'}
				</th>
				<th align="left" style="padding-bottom: .5em; padding-right: 1em; text-align: center; font-weight:bold;">
					{phrase var='dvs.settings'}
				</th>
				<th align="left" style="padding-bottom: .5em; padding-right: 1em; text-align: center; font-weight:bold;">
					{phrase var='dvs.customize'}
				</th>
				<th align="left" style="padding-bottom: .5em; padding-right: 1em; text-align: center; font-weight:bold;">
					{phrase var='dvs.player'}
				</th>
				<th align="left" style="padding-bottom: .5em; padding-right: 1em; text-align: center; font-weight:bold;">
					{phrase var='dvs.share_links'}
				</th>
				<th align="left" style="padding-bottom: .5em; padding-right: 1em; text-align: center; font-weight:bold;">
					{phrase var='dvs.share_report'}
				</th>
				<th align="left" style="padding-bottom: .5em; padding-right: 1em; text-align: center; font-weight:bold;">
					{phrase var='dvs.sales_team'}
				</th>
				<th align="left" style="padding-bottom: .5em; padding-right: 1em; text-align: center; font-weight:bold;">
					{phrase var='dvs.gallery_link'}
				</th>
				<th align="left" style="padding-bottom: .5em; padding-right: 1em; text-align: center; font-weight:bold;">
					{phrase var='dvs.delete'}
				</th>
			</tr>

			{foreach from=$aDvss item=aDvs}
				<tr id="dvs_{$aDvs.dvs_id}">
					<td style="padding-bottom: .5em; padding-right: 1em;">
						<a href="{if $bSubdomainMode}{url link=$aDvs.title_url}{else}{url link='dvs.'$aDvs.title_url}{/if}" target="_blank">{$aDvs.dvs_name}</a>
					</td>
					<td style="padding-bottom: .5em; padding-right: 1em; text-align: center;">
						{$aDvs.dealer_name}
					</td>
					<td style="padding-bottom: .5em; padding-right: 1em; text-align: center;">
						<a href="{url link='dvs.settings' id=$aDvs.dvs_id}">{phrase var='dvs.edit'}</a>
					</td>
					<td style="padding-bottom: .5em; padding-right: 1em; text-align: center;">
						<a href="{url link='dvs.customize' id=$aDvs.dvs_id}">{phrase var='dvs.edit'}</a>
					</td>
					<td style="padding-bottom: .5em; padding-right: 1em; text-align: center;">
						<a href="{url link='dvs.player.add' id=$aDvs.dvs_id}">{phrase var='dvs.edit'}</a>
					</td>
					<td style="padding-bottom: .5em; padding-right: 1em; text-align: center;">
						<a href="{if $bSubdomainMode}{url link=$aDvs.title_url}{else}{url link='dvs.'$aDvs.title_url}{/if}share">{phrase var='dvs.share_links'}</a>
					</td>
					<td style="padding-bottom: .5em; padding-right: 1em; text-align: center;">
						<a href="{url link='dvs.reports.share.'$aDvs.title_url}">{phrase var='dvs.share_report'}</a>
					</td>
					<td style="padding-bottom: .5em; padding-right: 1em; text-align: center;">
						<a href="{url link='dvs.salesteam' id=$aDvs.dvs_id}">{phrase var='dvs.manage'}</a>
					</td>
					<td style="padding-bottom: .5em; padding-right: 1em; text-align: center;">
						<a href="#" onclick="$('#dvs_gallery_link_{$aDvs.dvs_id}').dialog({l}width: 500{r});">{phrase var='dvs.gallery_link'}</a>
					</td>
					<td style="padding-bottom: .5em; padding-right: 1em; text-align: center;">
						<a href="#" onclick="if (confirm('{phrase var='core.are_you_sure' phpfox_squote=true}')) {left_curly} $(this).parents('#dvss:first').find('#dvs_{$aDvs.dvs_id}:first').hide('slow'); $.ajaxCall('dvs.deleteDvs', 'dvs_id={$aDvs.dvs_id}');{right_curly}">{phrase var='dvs.delete'}</a>
					</td>
				</tr>
				
				<div id="dvs_gallery_link_{$aDvs.dvs_id}" title="{phrase var='dvs.gallery_iframe_embed_code'}" class="dvs_gallery_link_popup" style="display:none;">
					<p>
						<textarea rows="4" cols="71">&lt;iframe src="{if $bSubdomainMode}{url link=$aDvs.title_url}{else}{url link='dvs.'$aDvs.title_url}{/if}gallery" scrolling="no" frameborder="0" width="800" height="600"&gt;&lt;/iframe&gt;</textarea>
					</p>
				</div>
				
			{/foreach}

		</table>
	</div>
{/if}