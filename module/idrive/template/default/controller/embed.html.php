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
 * @package 		iDrive
 */

?>

{if !empty($aForms)}
	<h3>Generated embed code:</h3>
	<div id="players" style="margin:15px 0px 0px 0px;">
		<textarea id="player_code" rows="6" cols="80">&lt;iframe src="{url link='idrive.external'}key_{$aForms.key}/id_{$aForms.id}/width_{$aForms.width}/height_{$aForms.height}/playlist_{$aForms.playlist}/autoplay_{$aForms.autoplay}/new2u_{$aForms.new2u}/1onone_{$aForms.1onone}/top200_{$aForms.top200}/pov_{$aForms.pov}/showplaylist_{$aForms.showplaylist}/showgetprice_{$aForms.showgetprice}/email_{$aForms.email}/refid_{$aForms.refid}" scrolling="no" frameborder="0" width="{$aForms.width}" height="{$aForms.height}"&gt;&lt;/iframe&gt;</textarea>
	</div>
{/if}


<h3>Generate External Player:</h3>
<form method="post" action="{url link='current'}" name="generate_embed">
	<table style="border-collapse: collapse;">
		<tr>
			<td style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
				Player Key:
			</td>
			<td colspan="2" style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
				<input type="text" name="val[key]" value="{value type='input' id='key'}" id="key" />
			</td>
		</tr>
		
		<tr>
			<td style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
				Player ID:
			</td>
			<td colspan="2" style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
				<input type="text" name="val[id]" value="{value type='input' id='id'}" id="id" />
			</td>
		</tr>
		
		<tr>
			<td style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
				Video Ref ID:
			</td>
			<td colspan="2" style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
				<input type="text" name="val[refid]" value="{value type='input' id='refid'}" id="refid" />
			</td>
		</tr>
		
		<tr>
			<td style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
				Playlist ID:
			</td>
			<td colspan="2" style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
				<input type="text" name="val[playlist]" value="{value type='input' id='playlist'}" id="playlist" />
			</td>
		</tr>
		
		<tr>
			<td style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
				iFrame Width:
			</td>
			<td colspan="2" style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
				<input type="text" name="val[width]" value="{value type='input' id='width'}" id="width" />
			</td>
		</tr>
		
		<tr>
			<td style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
				iFrame Height:
			</td>
			<td colspan="2" style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
				<input type="text" name="val[height]" value="{value type='input' id='height'}" id="height" />
			</td>
		</tr>

		<tr>
			<td style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
				Autoplay:
			</td>
			<td colspan="2" style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
				<input type="checkbox" name="val[autoplay]" id="autoplay" value="1" {if isset($aForms.autoplay) && $aForms.autoplay == 'true'}checked=checked{/if}/>
			</td>
		</tr>
		
		<tr>
			<td style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
				Allow New2U:
			</td>
			<td colspan="2" style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
				<input type="checkbox" name="val[new2u]" id="new2u" value="1" {if isset($aForms.new2u) && $aForms.new2u == 'true'}checked=checked{/if}/>
			</td>
		</tr>
		<tr>
			<td style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
				Allow 1onOne:
			</td>
			<td colspan="2" style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
				<input type="checkbox" name="val[1onone]" id="1onone" value="1" {if isset($aForms.1onone) && $aForms.1onone == 'true'}checked=checked{/if}/>
			</td>
		</tr>
		<tr>
			<td style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
				Allow Top200:
			</td>
			<td colspan="2" style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
				<input type="checkbox" name="val[top200]" id="top200" value="1" {if isset($aForms.top200) && $aForms.top200 == 'true'}checked=checked{/if}/>
			</td>
		</tr>
		<tr>
			<td style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
				Allow POV:
			</td>
			<td colspan="2" style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
				<input type="checkbox" name="val[pov]" id="pov" value="1" {if isset($aForms.pov) && $aForms.pov == 'true'}checked=checked{/if}/>
			</td>
		</tr>
		<tr>
			<td style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
				Show Playlist:
			</td>
			<td colspan="2" style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
				<input type="checkbox" name="val[showplaylist]" id="showplaylist" value="1" {if isset($aForms.showplaylist) && $aForms.showplaylist == 'true'}checked=checked{/if}/>
			</td>
		</tr>
		<tr>
			<td style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
				Show Get Price:
			</td>
			<td colspan="2" style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
				<input type="checkbox" name="val[showgetprice]" id="showgetprice" value="1" {if isset($aForms.showgetprice) && $aForms.showgetprice == 'true'}checked=checked{/if}/>
			</td>
		</tr>
		
		<tr>
			<td style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
				Email Address:
			</td>
			<td colspan="2" style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
				<input type="text" name="val[email]" value="{value type='input' id='email'}" id="email" />
			</td>
		</tr>
		
	</table>			
		<input type="submit" value="Generate Embed Code" class="button" />
</form>