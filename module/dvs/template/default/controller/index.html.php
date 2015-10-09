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
<style type="text/css">
@charset 'UTF-8';
/* Starter CSS for Menu */
#cssmenu {
  /* 
padding: 0;
  margin: 0;
  border: 0;
 */
}
#cssmenu ul,
#cssmenu li {
  list-style: none;
  margin: 0;
  padding: 0;
}
#cssmenu ul {
  position: relative;
  /* z-index: 597; */
}
#cssmenu ul li {
  float: left;
  min-height: 1px;
  vertical-align: middle;
}
#cssmenu ul li.hover,
#cssmenu ul li:hover {
  position: relative;
  z-index: 599;
  cursor: default;
}
#cssmenu ul ul {
  visibility: hidden;
  position: absolute;
  top: 100%;
  left: 0;
  z-index: 598;
  width: 100%;
}
#cssmenu ul ul li {
  float: none;
}
#cssmenu ul ul ul {
  top: 0;
  left: 100%;
}
#cssmenu ul li:hover > ul {
  visibility: visible;
  
}
#cssmenu ul ul {
  margin-top: 0;
}
#cssmenu a {
  display: block;
  line-height: 1em;
  text-decoration: none;
}
#cssmenu ul li.last ul {
  left: auto;
  right: 0;
}
#cssmenu ul li.last ul ul {
  left: auto;
  right: 99.5%;
}
#cssmenu:after,
#cssmenu ul:after {
  content: '';
  display: block;
  clear: both;
}
/* Custom CSS Styles */
#cssmenu {
  width: auto;
  font-family: Helvetica, Arial, sans-serif;
}
#cssmenu:before {
  display: block;
  height: 8px;
}
#cssmenu > ul {

}
#cssmenu > ul > li {
  margin:0;
  padding-right:30px;
  
}
#cssmenu > ul > li.has-sub:hover > a {
  -moz-border-radius: 3px 3px 0 0;
  -webkit-border-radius: 3px 3px 0 0;
  border-radius: 3px 3px 0 0;
  -moz-background-clip: padding;
  -webkit-background-clip: padding-box;
  background-clip: padding-box;
  
}
#cssmenu > ul > li:hover > a {
  background-color: #e2e2e2;
  background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0, #ffffff), color-stop(1, #c8c8c8));
  background-image: -webkit-linear-gradient(top, #ffffff, #c8c8c8);
  background-image: -moz-linear-gradient(top, #ffffff, #c8c8c8);
  background-image: -o-linear-gradient(top, #ffffff, #c8c8c8);
  background-image: linear-gradient(#ffffff, #c8c8c8);
}
#cssmenu > ul > li.active:hover > a {
  background-color: #cb7b72;
  background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0, #f49b8e), color-stop(1, #bd584d));
  background-image: -webkit-linear-gradient(top, #f49b8e, #bd584d);
  background-image: -moz-linear-gradient(top, #f49b8e, #bd584d);
  background-image: -o-linear-gradient(top, #f49b8e, #bd584d);
  background-image: linear-gradient(#f49b8e, #bd584d);
}
#cssmenu ul a {
  background-color: #c2c2c2;
  background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0, #f1f1f1), color-stop(1, #a8a8a8));
  background-image: -webkit-linear-gradient(top, #f1f1f1, #a8a8a8);
  background-image: -moz-linear-gradient(top, #f1f1f1, #a8a8a8);
  background-image: -o-linear-gradient(top, #f1f1f1, #a8a8a8);
  background-image: linear-gradient(#f1f1f1, #a8a8a8);
  -moz-border-radius: 3px;
  -webkit-border-radius: 3px;
  border-radius: 3px;
  -moz-background-clip: padding;
  -webkit-background-clip: padding-box;
  background-clip: padding-box;
  -moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 1px 1px 1px rgba(0, 0, 0, 0.5);
  -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 1px 1px 1px rgba(0, 0, 0, 0.5);
  box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 1px 1px 1px rgba(0, 0, 0, 0.5);
  color: #3c444d;
  font-size: 12px;
  line-height: 27px;
  padding: 0 20px;
  position: relative;
  text-align: center;
  text-shadow: 0 1px 0 rgba(255, 255, 255, 0.4);
}
#cssmenu ul ul {
  width: 170px;
  
}
#cssmenu ul ul a {
  -moz-box-shadow: none;
  -webkit-box-shadow: none;
  box-shadow: none;
  -moz-border-radius: 0;
  -webkit-border-radius: 0;
  border-radius: 0;
  -moz-background-clip: padding;
  -webkit-background-clip: padding-box;
  background-clip: padding-box;
  line-height: 150%;
  
}
#cssmenu ul .active > a {
  color: #FFF;
  text-shadow: 0 1px 0 rgba(0, 0, 0, 0.4);
  background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAAbCAIAAAAyOnIjAAAAA3NCSVQICAjb4U/gAAAANUlEQVQImXXMsQ0AIRTD0FMmvRlYnAm+TQEIGronxcrX2x80hUEDpNx2em0lx9wNj37+rX4AhN5PdtvsqRUAAAAASUVORK5CYII=);
  background-color: #c46a60;
  background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0, #ef7260), color-stop(1, #b04c41));
  background-image: -webkit-linear-gradient(top, #ef7260, #b04c41);
  background-image: -moz-linear-gradient(top, #ef7260, #b04c41);
  background-image: -o-linear-gradient(top, #ef7260, #b04c41);
  background-image: linear-gradient(#ef7260, #b04c41);
}
#cssmenu ul .has-sub {
  position: relative;
  
  
}
#cssmenu ul .has-sub ul {
  -moz-border-radius: 0 3px 3px 3px;
  -webkit-border-radius: 0 3px 3px 3px;
  border-radius: 0 3px 3px 3px;
  -moz-background-clip: padding;
  -webkit-background-clip: padding-box;
  background-clip: padding-box;
  background-color: #c3c3c3;
  background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0, #e9e9e9), color-stop(1, #aaaaaa));
  background-image: -webkit-linear-gradient(top, #e9e9e9, #aaaaaa);
  background-image: -moz-linear-gradient(top, #e9e9e9, #aaaaaa);
  background-image: -o-linear-gradient(top, #e9e9e9, #aaaaaa);
  background-image: linear-gradient(#e9e9e9, #aaaaaa);
  padding: 3px 0;
  z-index:500px;
}
#cssmenu ul .has-sub ul a {
  background: none;
  padding: 8px 8px 8px 16px;
  border-bottom: 1px solid transparent;
  text-align: left;
  
}
#cssmenu ul .has-sub ul .has-sub a:after {
  content: none;
  
}
#cssmenu ul .has-sub li:hover > a {
  /* border-bottom: 1px solid #1D2024; */
  color: #FFF;
  background-color: #55616f;
  background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0, #56606f), color-stop(1, #3f4852));
  background-image: -webkit-linear-gradient(top, #56606f, #3f4852);
  background-image: -moz-linear-gradient(top, #56606f, #3f4852);
  background-image: -o-linear-gradient(top, #56606f, #3f4852);
  background-image: linear-gradient(#56606f, #3f4852);
  -moz-box-shadow: inset 1px 2px 0 #5c6778, inset 0 1px 0 #4e5866;
  -webkit-box-shadow: inset 1px 2px 0 #5c6778, inset 0 1px 0 #4e5866;
  box-shadow: inset 1px 2px 0 #5c6778, inset 0 1px 0 #4e5866;
  position: relative;
  text-shadow: 0 1px 0 rgba(0, 0, 0, 0.4);

}
#cssmenu ul .has-sub li:hover > a:after {
  border-left: 0 none;
  content: '';
  height: 100%;
  width: 6px;
  position: absolute;
  right: 0;
  top: 0;
  
}
#cssmenu ul .has-sub > a {
  padding-right: 0;
  
}
#cssmenu ul .has-sub > a:after {
  content: '▼';
  border-left: 1px solid rgba(100, 100, 100, 0.2);
  color: #5D6A7A;
  -moz-box-shadow: -1px 0 0 rgba(255, 255, 255, 0.2);
  -webkit-box-shadow: -1px 0 0 rgba(255, 255, 255, 0.2);
  box-shadow: -1px 0 0 rgba(255, 255, 255, 0.2);
  display: inline-block;
  font-size: 9px;
  margin-left: 6px;
  text-align: center;
  height: 25px;
  width: 25px;
  text-shadow: 0 -1px 0 #101417;
}
#cssmenu ul .active > a:after {
  color: #FFF;
}
#cssmenu ul ul a {
  font-size: 12px;
  
}

</style>
{/literal}

{if isset($sMessage) && $sMessage}
	{literal}
		<script type="text/javascript">
			$Behavior.message = function() {
				$('#dvs_message').show('slow');
				$('#dvs_message').animate({top: 0}, 1000).hide('slow');
			}
		</script>
	{/literal}

	<div class="message" id="dvs_message" style="display:none;">
		{$sMessage}
	</div>
{/if}


<div id="add_dvs_button" {if !$bCanAddDvss}style="display:none;"{/if}>
	<a href="{url link='dvs.settings'}" class="button-link" style="width:90px;height:10px;padding:2px 2px 15px 2px;margin:0px;">{phrase var='dvs.add_dvs'}</a>
	<div class="main_break"></div>
</div>

<div class="clear"></div>

{if $aDvss}
	<div id="dvss" {*if $bCanAddDvss}class="separate"{/if*} style="margin:50px 0px 0px 0px;">
		<table style="width:100%;border-collapse:collapse;">
			<tr style="border-bottom:1px solid #ccc;">
				{*<td valign="top" style="text-align:left;font-weight:bold;padding-bottom:5px;font-size:15px;">
					DVS Name
				</td>*}
				<td colspan="2" valign="top" style="text-align:left;font-weight:bold;padding-bottom:5px;font-size:15px;">
					{if Phpfox::getLib('request')->get('sort') == 'descending'}
                    <a class="dealer_heading_asc" href="{$aSearchTool.filters.Sort.data.0.link}">Dealership Name</a>
                    {else}
                    <a class="dealer_heading_desc" href="{$aSearchTool.filters.Sort.data.1.link}">Dealership Name</a>
                    {/if}
				</td>
				<td valign="top" style="text-align:left;font-weight:bold;padding-bottom:5px;font-size:15px;">
					Options{*phrase var='dvs.settings'*}
				</td>
			</tr>
			<tr><td colspan="3">&nbsp;</td></tr>
			{foreach from=$aDvss item=aDvs}
				<tr id="dvs_{$aDvs.dvs_id}">
					<td colspan="2" valign="middle" style="text-align:left;vertical-align:middle;font-size:15px;">
						<a href="{if $bSubdomainMode}{url link=$aDvs.title_url}{else}{url link='dvs.'$aDvs.title_url}{/if}" target="_blank">{$aDvs.dealer_name}</a>
					</td>
					{*<td valign="middle" style="text-align:left;vertical-align:middle;font-size:15px;">
						<a href="{if $bSubdomainMode}{url link=$aDvs.title_url}{else}{url link='dvs.'$aDvs.title_url}{/if}" target="_blank">{$aDvs.dvs_name}</a>
					</td>*}
					
					<td valign="middle" style="text-align:right;vertical-align:middle;">
						<div id="cssmenu">
						<ul>
						   <li class="has-sub"><a href="#"><span>Settings</span></a>
							  <ul>
								 <li><a href="{url link='dvs.settings' id=$aDvs.dvs_id}"><span>General Settings</span></a></li>
								 <li><a href="{url link='dvs.customize' id=$aDvs.dvs_id}"><span>Customize Styling</span></a></li>
								 <li><a href="{url link='dvs.player.add' id=$aDvs.dvs_id}"><span>Player Settings</span></a></li>
								 <li><a href="{url link='dvs.salesteam' id=$aDvs.dvs_id}"><span>Sales Team</span></a></li>
                                 {if Phpfox::isAdmin()}
                                 <li><a href="{url link='dvs.manager' id=$aDvs.dvs_id}"><span>Managers Team</span></a></li>
                                 {/if}
                                  <li><a href="{url link='dvs.analytics' id=$aDvs.dvs_id}"><span>Reporting</span></a></li>
							  </ul>
						   </li>
						   <li class=""><a href="{if $bSubdomainMode}{url link=$aDvs.title_url}{else}{url link='dvs.'$aDvs.title_url}{/if}share" onclick="mixpanel.track('Share Link Button');"><span>Share Links</span></a></a>
							  <!-- 
<ul>
								 <li><a href="{if $bSubdomainMode}{url link=$aDvs.title_url}{else}{url link='dvs.'$aDvs.title_url}{/if}share"><span>Share Links</span></a></li>
								 <li><a href="{url link='dvs.reports.share.'$aDvs.title_url}"><span>Share Report</span></a></li>
							  </ul>
 -->
						   </li>
						   <li class="has-sub"><a href="#"><span>Integrate</span></a>
							  <ul>
								<li><a href="#" onclick="$('#dvs_iframe_link_{$aDvs.dvs_id}').dialog({l}width: 500{r});"><span>DVS Embed Code</span></a></li>
                                <li><a href="#" onclick="$('#vdp_embed_link_{$aDvs.dvs_id}').dialog({l}width: 500{r});"><span>Inventory Embed Code</span></a></li>
                                <li><a href="#" onclick="$('#vin_url_player_{$aDvs.dvs_id}').dialog({l}width: 550{r});"><span>VIN URL Player Code</span></a></li>
                                <li><hr></li>
                                <li><a href="{url link='dvs.download-instruction' id=$aDvs.dvs_id}"><span><strong>Download Integration Instructions</strong></span></a></li>
							  </ul>
						   </li>
						   {if Phpfox::isAdmin()}
						   <li class="active"><a href="#" onclick="if (confirm('{phrase var='core.are_you_sure' phpfox_squote=true}')) {left_curly} $(this).parents('#dvss:first').find('#dvs_{$aDvs.dvs_id}:first').hide('slow'); $.ajaxCall('dvs.deleteDvs', 'dvs_id={$aDvs.dvs_id}');{right_curly}"><span>Delete</span></a>
						   </li>
						   {/if}
                            {if Phpfox::isAdmin()}
                            <li class="active activity_button">
                                <div class="js_item_is_active"{if !$aDvs.is_active} style="display:none;"{/if}>
                                    <a href="#?call=dvs.updateActivity&amp;id={$aDvs.dvs_id}&amp;active=0" class="js_item_active_link" title="Click to Deactivate"><span>Active</span></a>
                                </div>
                                <div class="js_item_is_not_active"{if $aDvs.is_active} style="display:none;"{/if}>
                                    <a href="#?call=dvs.updateActivity&amp;id={$aDvs.dvs_id}&amp;active=1" class="js_item_active_link" title="Click to Activate"><span>Not Active</span></a>
                                </div>
                            </li>
                            {/if}
						</ul>
						</div>
					</td>
					
				</tr>
				<tr><td colspan="3">&nbsp;</td></tr>
				<div id="dvs_iframe_link_{$aDvs.dvs_id}" title="DVS Embed Code" class="dvs_iframe_link_popup" style="display:none;">
					<p>Add this javascript code to a new page called "Virtual Test Drive" and link to it under New Inventory navigation menu:</p>
						<p><textarea rows="13" cols="71">&lt;div id="dvs_wrapper">&lt;/div&gt;
&lt;script type="text/javascript" src="{$sCorePath}module/dvs/static/jscript/embed.js"&gt;&lt;/script&gt;
&lt;script type="text/javascript"&gt;
    WTVDVS.render_iframe({l}
        "id" : "dvs_wrapper",
        "width" : 952,
        "height" : 1000,
        "iframeUrl" : "{if $bSubdomainMode}{url link=$aDvs.title_url}{else}{url link='dvs.'$aDvs.title_url}{/if}iframe/"
    {r});
&lt;/script&gt;</textarea>
					</p>
					
				</div>

            <div id="vdp_embed_link_{$aDvs.dvs_id}" title="Inventory Embed Code" class="dvs_iframe_link_popup" style="display:none;">
                <p>Step 1: Add this code right before the &lt;/body&gt; tag of the SRP and VDP template page:</p>
                    <textarea rows="10" cols="71">&lt;script type="text/javascript" src="{$sCorePath}module/dvs/static/jscript/vin.js"&gt;&lt;/script&gt;
&lt;script type="text/javascript"&gt;
WTVVIN.init({l}
    "dvs" : {$aDvs.dvs_id},
    "apiUrl" : "{url link=''}",
    "styleUrl" : "{url link='dvs.vin.style' id=$aDvs.dvs_id}",
    "scriptUrl" : "{url link='dvs.vin.script' id=$aDvs.dvs_id}"
{r});
&lt;/script&gt;</textarea>
                </p>
                <p>Step 2: Add button code for each vehicle listing and replace # with VIN:</p> 
					<textarea rows="1" cols="71">&lt;div class="dvs_vin_btn" vin="#"&gt;&lt;/div&gt; </textarea>
					</p>
            </div>
            
            <div id="vin_url_player_{$aDvs.dvs_id}" title="VIN URL Player code" class="dvs_iframe_link_popup" style="display:none;">
                <p>Use this URL to assign a video to the player using a VIN (replace # with VIN):</p>
                    <textarea rows="1" cols="50">{if $bSubdomainMode}{url link=$aDvs.title_url}{else}{url link='dvs.'$aDvs.title_url}{/if}inventory-player/id_{$aDvs.dvs_id}/vin_#</textarea>
                </p>
                <p>Note: This is mostly for Cobalt/CDK integrations who require the player be opened in a pop-up window or iframe that they control.</p>
            </div>
				
			{/foreach}
{pager}
		</table>
	</div>
{/if}