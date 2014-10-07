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
<div class="table" style="display: none;">
	<div class="table_left">
		<label for="user_type">{required}{phrase var='idrive.user_type'}:</label>
	</div>
	<div class="table_right">
		<select name="val[user_type]" onchange="if ($(this).val() == {$iDealerUserGroup}){l}$('#dealer_extra_info').show();{r}else{l}$('#dealer_extra_info').hide();{r}">
			{foreach from=$aUserTypes key=sUserTypeKey item=sUserType}
				<option value="{$sUserTypeKey}" {if $sUserTypeKey == $iSalesTeamUserGroup && $salesteam_invite}selected="selected"{elseif $sUserTypeKey == $iManagerTeamUserGroup && $managersteam_invite}selected="selected"{elseif $sUserType =='Free Trial'}selected="selected"{/if}>{$sUserType}</option>
			{/foreach}
		</select>
	</div>
</div>

<div id="dealer_extra_info"{if $salesteam_invite || $managersteam_invite} style="display:none;"{/if}>
	<div class="table">
		<div class="table_left">
			<label for="website_rep">{required}{phrase var='dvs.website_rep'}:</label>
		</div>
		<div class="table_right">
			<input type="text" name="val[website_rep]" id="website_rep" value="{value type='input' id='website_rep'}"  />
		</div>			
	</div>

	<div class="table">
		<div class="table_left">
			<label for="contact_name">{required}{phrase var='dvs.contact_name'}:</label>
		</div>
		<div class="table_right">
			<input type="text" name="val[contact_name]" id="contact_name" value="{value type='input' id='contact_name'}"  />
		</div>			
	</div>

	<div class="table">
		<div class="table_left">
			<label for="contact_phone">{required}{phrase var='dvs.contact_phone'}:</label>
		</div>
		<div class="table_right">
			<input type="text" name="val[contact_phone]" id="contact_phone" value="{value type='input' id='contact_phone'}"  />
		</div>			
	</div>

	<div class="table">
		<div class="table_left">
			<label for="billing_name">{required}{phrase var='dvs.billing_name'}:</label>
		</div>
		<div class="table_right">
			<input type="text" name="val[billing_name]" id="billing_name" value="{value type='input' id='billing_name'}"  />
		</div>			
	</div>

	<div class="table">
		<div class="table_left">
			<label for="billing_address_1">{required}{phrase var='dvs.billing_address_1'}:</label>
		</div>
		<div class="table_right">
			<input type="text" name="val[billing_address_1]" id="billing_address_1" value="{value type='input' id='billing_address_1'}"  />
		</div>			
	</div>

	<div class="table">
		<div class="table_left">
			<label for="billing_address_2">{phrase var='dvs.billing_address_2'}:</label>
		</div>
		<div class="table_right">
			<input type="text" name="val[billing_address_2]" id="billing_address_2" value="{value type='input' id='billing_address_2'}"  />
		</div>			
	</div>

	<div class="table">
		<div class="table_left">
			<label for="billing_city">{required}{phrase var='dvs.billing_city'}:</label>
		</div>
		<div class="table_right">
			<input type="text" name="val[billing_city]" id="billing_city" value="{value type='input' id='billing_city'}"  />
		</div>			
	</div>

	<div class="table">
		<div class="table_left">
			<label for="billing_state">{required}{phrase var='dvs.billing_state'}:</label>
		</div>
		<div class="table_right">
			<input type="text" name="val[billing_state]" id="billing_state" value="{value type='input' id='billing_state'}"  />
		</div>			
	</div>

	<div class="table">
		<div class="table_left">
			<label for="billing_zip_code">{required}{phrase var='dvs.billing_zip_code'}:</label>
		</div>
		<div class="table_right">
			<input type="text" name="val[billing_zip_code]" id="billing_zip_code" value="{value type='input' id='billing_zip_code'}"  />
		</div>			
	</div>
</div>