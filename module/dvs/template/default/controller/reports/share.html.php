
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
	<h3>{phrase var='dvs.team_members'}</h3>
	<form method="post" action="{url link='current'}" id="generate_sales_report" name="select_team_member">
		<table id="select_team_member_table">
			<tr>
				<th>
					{phrase var='dvs.member_name'}:
				</th>
				<th>
					{phrase var='dvs.start_date'}:
				</th>
				<th>
					{phrase var='dvs.end_date'}:
				</th>
				<th>
					{phrase var='dvs.limit_video_entries'}:
				</th>
				<th>
					{phrase var='dvs.generate_report'}:
				</th>
			</tr>
			<tr>
				<td class="share_report_td">
					<select name="val[user_id]" id="user_id">
						<option value="">{phrase var='dvs.select_a_member'}</option>
						{foreach from=$aTeamMembers item=aUser}
							<option value="{$aUser.user_id}"{if isset($aForms.user_id) && $aUser.user_id == $aForms.user_id} selected="selected"{/if}>{$aUser.full_name} ({$aUser.email})</option>
						{/foreach}
					</select>
				</td>
				<td class="share_report_td">
					<div style="position:relative">
						{select_date prefix='start_' id='_start' start_year=$sStartYear end_year=$sEndYear field_separator=' / ' field_order='MDY' default_all=true}
					</div>
				</td>
				<td class="share_report_td">
					<div style="position:relative">
						{select_date prefix='end_' id='_start' start_year=$sStartYear end_year=$sEndYear field_separator=' / ' field_order='MDY' default_all=true}
					</div>
				</td>
				<td class="share_report_td">
					<input type="text" name="val[limit]" value="{if !isset($aForms.limit)}5{else}{$aForms.limit}{/if}" size="5"/>
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

<h3>Share Report</h3>
{if !empty($aShareReport)}
	<div id="dvs_share_report_container">
		<table width="792" class="share_report_table">
			<tr>
				<td colspan="7">
					<strong>
						{phrase var='dvs.share_report_for_name' name=$aMember.full_name}
					</strong>
				</td>
			</tr>
			<tr>
				<td colspan="7">
					&nbsp;
				</td>
			</tr>
			<tr>
				<td colspan="7">
					<em>
						Date Range: From: {$aForms.start_month}/{$aForms.start_day}/{$aForms.start_year}
						To: {$aForms.end_month}/{$aForms.end_day}/{$aForms.end_year}
					</em>
				</td>
			</tr>
			<tr>
				<td colspan="7">
					&nbsp;
				</td>
			</tr>
			<tr>
			</tr>
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
				<td width="7%">
					<strong>
						Totals
					</strong>
				</td>
				<td width="12%">
					&nbsp;
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
					<strong>
						{$aShareReport.total_generated.total}
					</strong>
				</td>
				<td>
					&nbsp;
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
					<strong>
						{$aShareReport.total_clicked.total}
					</strong>
				</td>
				<td>
					&nbsp;
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
					<strong>
						{$aShareReport.ctr.total}&#37;
					</strong>
				</td>
				<td>
					&nbsp;
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
				<td>
					&nbsp;
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
						<strong>
							{$aVideo.embed}
						</strong>
					</td>
					<td>
						&nbsp;
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
				<td>
					&nbsp;
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
						<strong>
							{$aVideo.total}
						</strong>
					</td>
					<td>
						&nbsp;
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
					<input type="submit" value="Export CSV"  onclick="$('#export_csv').val(1);$('#generate_sales_report').submit();"/>
				</td>
			</tr>
		</table>
	</div>
{else}
	{if empty($aForms)}
		Please select a Sales Team Member and a date range to display a Share Report.
	{else}
		No data to display
	{/if}
{/if}