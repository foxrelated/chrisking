
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
<div id="sales_team_members">
	<form method="post" action="{url link='current'}" id="generate_sales_report" name="select_team_member">
		<table id="select_team_member_table" width="100%">
			<tr>
				<td class="share_report_td">
				Name: 
					<select name="val[user_id]" id="user_id">
						<option value="">-- Select a User --</option>
						{foreach from=$aTeamMembers item=aUser}
							<option value="{$aUser.user_id}"{if isset($aForms.user_id) && $aUser.user_id == $aForms.user_id} selected="selected"{/if}>{$aUser.full_name} ({$aUser.email})</option>
						{/foreach}
					</select>
				</td>
				<td class="share_report_td">
					<table><tr><td>Start Date:&nbsp;&nbsp;</td><td>
					<div style="position:relative;">
						{select_date prefix='start_' id='_start' start_year=$sStartYear end_year=$sEndYear field_separator=' / ' field_order='MDY' default_all=true}
					</div>
					</td></tr></table>
				</td>
				<td class="share_report_td">
				<table><tr><td>End Date:&nbsp;&nbsp;</td><td>
					<div style="position:relative">
						{select_date prefix='end_' id='_start' start_year=$sStartYear end_year=$sEndYear field_separator=' / ' field_order='MDY' default_all=true}
					</div>
					</td></tr></table>
					<input type="hidden" name="val[limit]" value="{if !isset($aForms.limit)}500{else}{$aForms.limit}{/if}" size="5"/>
				</td>
				<td class="share_report_td">
					<input type="submit" value="{phrase var='dvs.display_share_report'}" class="button" />
					<input type="hidden" value="0" name="val[csv]" id="export_csv" />
				</td>
			</tr>
		</table>

		<div id="dvs_settings_save_button_container">

		</div>
	</form>
</div>
{if !empty($aShareReport)}
	<div id="dvs_share_report_container" style="padding-top:30px;">
	<h1 align="center" style="font-size:34px;font-weight:bold;">{phrase var='dvs.share_report_for_name' name=$aMember.full_name}<br> <span style="color:#666666;">{$aForms.start_month}/{$aForms.start_day}/{$aForms.start_year} to {$aForms.end_month}/{$aForms.end_day}/{$aForms.end_year}</span></h1>
	<br>
	<table id="stats_box" width="100%">
		<tr>
			<td align="center" valign="middle" width="33%">
			<div id="totals_box">
				<div class="stat_label_big">{$aShareReport.total_generated.total}</div>
				<div class="stat_label_small">Total Shares</div>
			</div>
		</td>
		<td align="center" valign="middle" width="33%">
			<div id="totals_box">
				<div class="stat_label_big">{$aShareReport.total_clicked.total}</div>
				<div class="stat_label_small">Total Clicks</div>
			</div>
		</td>
		<td align="center" valign="middle" width="33%">
			<div id="totals_box">
				<div class="stat_label_big">{$aShareReport.ctr.total}&#37;</div>
				<div class="stat_label_small">Average CTR</div>
			</div>
		</td>
	</tr>
	</table>
	<br>
	<table id="piechart_stats_box" width="100%">
		<tr>
			<td align="center" valign="middle" width="50%">
			<h1>Click-Through Rate</h1>
				<div id="piechart"></div>
			</td>
			
			<td align="center" valign="middle" width="50%">
			<h1>Best Performing Share Types</h1>
				<div id="piechart"></div>
			</td>
			
		</tr>
	</table>
	<br><br>
	<table id="shares_vs_clicks_stats_box" width="100%">
		<tr>
			<td align="center" valign="middle">
			<h1>Shares vs. Clicks</h1>
			<div id="linechart"></div>
			</td>
		</tr>
	</table>
	<br><br>
	<table id="top_links_stat_box" width="100%">
		<tr>
			<td align="center" valign="middle">
			<h1>Most Shared Links</h1>
			<ul id="list">
				{foreach from=$aShareReport.top_generated item=aVideo}
					<li>{$aVideo.video_title_url} (Email: {$aVideo.email} / Facebook: {$aVideo.facebook} / Twitter: {$aVideo.twitter} / Google+: {$aVideo.google} / CRM Embed: {$aVideo.embed} // {$aVideo.total})</li>
				{/foreach}
				</ul>
			</td>
			<td align="center" valign="middle">
			<h1>Most Clicked Links</h1>
				<ul id="list">				
				{foreach from=$aShareReport.top_clicked item=aVideo}
					<li>{$aVideo.video_title_url} (Email: {$aVideo.email} / Facebook: {$aVideo.facebook} / Twitter: {$aVideo.twitter} / Google+: {$aVideo.google} / CRM Embed: {$aVideo.embed} // {$aVideo.total})</li>
				{/foreach}
				</ul>
			</td>
		</tr>
	</table>
	<br>
		<table width="100%" class="share_report_table">
			<tr>
				<td width="28%">
					<strong>
						Best Performing Shares:
					</strong>
				</td>
				<td width="12%">
					<strong>
						Email
					</strong>
				</td>
				<td width="14%">
					<strong>
						Facebook
					</strong>
				</td>
				<td width="14%">
					<strong>
						Twitter
					</strong>
				</td>
				<td width="13%">
					<strong>
						Google+
					</strong>
				</td>
				<td width="12%">
					<strong>
						Embed
					</strong>
				</td>
				<td width="7%">
					<strong>
						Totals
					</strong>
				</td>
			</tr>
			<tr>
				<td>
					<em>
						Shares Sent:
					</em>
				</td>
				<td>
					{$aShareReport.total_generated.email}
				</td>
				<td>
					{$aShareReport.total_generated.facebook}
				</td>
				<td>
					{$aShareReport.total_generated.twitter}
				</td>
				<td>
					{$aShareReport.total_generated.google}
				</td>
				<td>
					{$aShareReport.total_generated.embed}
				</td>
				<td>
					<strong>
						{$aShareReport.total_generated.total}
					</strong>
				</td>
			</tr>
			<tr>
				<td>
					<em>
						Links Clicked:
					</em>
				</td>
				<td>
					{$aShareReport.total_clicked.email}
				</td>
				<td>
					{$aShareReport.total_clicked.facebook}
				</td>
				<td>
					{$aShareReport.total_clicked.twitter}
				</td>
				<td>
					{$aShareReport.total_clicked.google}
				</td>
				<td>
					{$aShareReport.total_clicked.embed}
				</td>
				<td>
					<strong>
						{$aShareReport.total_clicked.total}
					</strong>
				</td>
			</tr>
			<tr>
				<td>
					<em>
						CTR:
					</em>
				</td>
				<td>
					{$aShareReport.ctr.email}&#37;
				</td>
				<td>
					{$aShareReport.ctr.facebook}&#37;
				</td>
				<td>
					{$aShareReport.ctr.twitter}&#37;
				</td>
				<td>
					{$aShareReport.ctr.google}&#37;
				</td>
				<td>
					{$aShareReport.ctr.embed}&#37;
				</td>
				<td>
					<strong>
						{$aShareReport.ctr.total}&#37;
					</strong>
				</td>
			</tr>
			<tr>
				<td colspan="7">
					&nbsp;
				</td>
			</tr>
			<tr>
				<td>
					<strong>
						Most Shared Links:
					</strong>
				</td>
				<td>
					<strong>
						Email
					</strong>
				</td>
				<td>
					<strong>
						Facebook
					</strong>
				</td>
				<td>
					<strong>
						Twitter
					</strong>
				</td>
				<td>
					<strong>
						Google+
					</strong>
				</td>
				<td>
					<strong>
						Embed
					</strong>
				</td>
			</tr>
			{foreach from=$aShareReport.top_generated item=aVideo}
				<tr>
					<td>
						<em>
							{$aVideo.video_title_url}
						</em>
					</td>
					<td>
						{$aVideo.email}
					</td>
					<td>
						{$aVideo.facebook}
					</td>
					<td>
						{$aVideo.twitter}
					</td>
					<td>
						{$aVideo.google}
					</td>
					<td>
						{$aVideo.embed}
					</td>
					<td>
						<strong>
							{$aVideo.embed}
						</strong>
					</td>
				</tr>
			{/foreach}
			<tr>
				<td>
					&nbsp;
				</td>
				<td>
					&nbsp;
				</td>
				<td>
					&nbsp;
				</td>
				<td>
					&nbsp;
				</td>
				<td>
					&nbsp;
				</td>
				<td>
					&nbsp;
				</td>
				<td>
					&nbsp;
				</td>
			</tr>
			<tr>
				<td>
					<strong>
						Most Clicked Links:
					</strong>
				</td>
				<td>
					<strong>
						Email
					</strong>
				</td>
				<td>
					<strong>
						Facebook
					</strong>
				</td>
				<td>
					<strong>
						Twitter
					</strong>
				</td>
				<td>
					<strong>
						Google+
					</strong>
				</td>
				<td>
					<strong>
						Embed
					</strong>
				</td>
			</tr>
			{foreach from=$aShareReport.top_clicked item=aVideo}
				<tr>
					<td>
						<em>
							{$aVideo.video_title_url}
						</em>
					</td>
					<td>
						{$aVideo.email}
					</td>
					<td>
						{$aVideo.facebook}
					</td>
					<td>
						{$aVideo.twitter}
					</td>
					<td>
						{$aVideo.google}
					</td>
					<td>
						{$aVideo.embed}
					</td>
					<td>
						<strong>
							{$aVideo.total}
						</strong>
					</td>
				</tr>
			{/foreach}
			<tr>
				<td>
					&nbsp;
				</td>
				<td>
					&nbsp;
				</td>
				<td>
					&nbsp;
				</td>
				<td>
					&nbsp;
				</td>
				<td>
					&nbsp;
				</td>
				<td>
					&nbsp;
				</td>
				<td>
					&nbsp;
				</td>
			</tr>
			<tr>
				<td colspan="7">
				<input type="submit" value="Export CSV" class="button" onclick="$('#export_csv').val(1);$('#generate_sales_report').submit();"/>	
				</td>
			</tr>
		</table>
	</div>
{else}
	{if empty($aForms)}
		<br><div class="share_report_message" align="center">Please select a user and date range to display their sharing activity.</div><br>
	{else}
		<br><div class="share_report_message" align="center"><span style="color:#ff0000;">No user selected.</span> Please select a user and date range to display their sharing activity.</div><br>
	{/if}
{/if}