<!--Start add user -->
{if defined('PHPFOX_IS_ADMIN_USERADD')}

{if isset($sCreateJs)}
{$sCreateJs}
{/if}

<div id="js_content">
<form method="post" action="{url link='admincp.addtestuser.add'}" id="js_form" name="js_form" onsubmit="{$sGetJsForm}" >
	<div class="table_header">
		{phrase var='addtestuser.menu_addtestuser_add_a_test_user_6d33be36dfb782099fb7b6ebc8b13f45'}
	</div>
	<div class="table">
		<div class="table_left">
			<label for="email">{required}{phrase var='user.email'}:</label>
		</div>
		<div class="table_right">
			<input type="text" name="val[email]" id="email" value="{value type='input' id='email'}" size="30" />
		</div>
	</div>

	<!-- add -->
		{if Phpfox::getLib('setting')->isParam('user.split_full_name') && Phpfox::getParam('user.split_full_name')}
		<div><input type="hidden" name="val[full_name]" id="full_name" value="{value type='input' id='full_name'}" size="30" /></div>
		<div class="table">
			<div class="table_left">
				<label for="first_name">{required}{phrase var='user.first_name'}:</label>
			</div>
			<div class="table_right">
				<input type="text" name="val[first_name]" id="first_name" value="{$aSettings.first_name}" size="30" />
			</div>			
		</div>		
		<div class="table">
			<div class="table_left">
				<label for="last_name">{required}{phrase var='user.last_name'}:</label>				
			</div>
			<div class="table_right">
				<input type="text" name="val[last_name]" id="last_name" value="{$aSettings.last_name}" size="30" />
			</div>			
		</div>		

		{else}		

		<div class="table">
			<div class="table_left">
				<label for="full_name">{required}{phrase var='user.full_name'}:</label>
			</div>
			<div class="table_right">
				<input type="text" name="val[full_name]" id="full_name" value="{$sFullName}" size="30" />
			</div>

		</div>
		{/if}

	<!-- add end-->			

{if !$bNoUsernames}
	<div class="table">
		<div class="table_left">
			<label for="user_name">{phrase var='user.choose_a_username'}:</label>
		</div>
		<div class="table_right">                           
			<input type="text" name="val[user_name]" id="user_name" title="{phrase var='user.your_username_is_used_to_easily_connect_to_your_profile'}" value="{$sUserName}" size="30" autocomplete="off" />				
		</div>			
	</div>
{/if}

{if !$bPassword}
	<div class="table">
		<div class="table_left">
			<label for="password">Enter your password:</label>
		</div>
		<div class="table_right">                           
			<input type="text" name="val[password]" id="password" title="Password" value="" size="30" autocomplete="off" />				
		</div>			
	</div>
{/if}
		
	<div class="table">
		<div class="table_left">
			{phrase var='user.birthday'}:
		</div>
		<div class="table_right">						
			{assign var=aSettingM value=$aSettings.adduser_birthmonth}
			<select name="val[month]">
			{foreach from=$aSettingM.values key=mKey item=sDropValue}
				<option value="{$mKey}"{if $aSettingM.value_actual == $mKey} selected="selected"{/if}>{$sDropValue}</option>
			{/foreach}
			</select>/
			{assign var=aSettingD value=$aSettings.adduser_birthday}
			<select name="val[day]">
			{foreach from=$aSettingD.values key=mKey item=sDropValue}
				<option value="{$mKey}"{if $aSettingD.value_actual == $mKey} selected="selected"{/if}>{$sDropValue}</option>
			{/foreach}
			</select>/
			{assign var=aSettingY value=$aSettings.adduser_birthyear}
			<select name="val[year]">
			{foreach from=$aSettingY.values key=mKey item=sDropValue}
				<option value="{$mKey}"{if $aSettingY.value_actual == $mKey} selected="selected"{/if}>{$sDropValue}</option>
			{/foreach}
			</select>



		</div>			
	</div>
	<div class="table">
		<div class="table_left">
			<label for="gender">{phrase var='user.gender'}:</label>
		</div>
		<div class="table_right">
			{assign var=aSettingG value=$aSettings.adduser_gender}
			<select name="val[gender]">
			{foreach from=$aSettingG.values key=mKey item=sDropValue}
				<option value="{$mKey}"{if $aSettingG.value_actual == $mKey} selected="selected"{/if}>{$sDropValue}</option>
			{/foreach}
			</select>
		</div>			
	</div>
	<div class="table">
		<div class="table_left">
			<label for="country_iso">{phrase var='user.location'}:</label>
		</div>
		<div class="table_right">
			{assign var=aSettingL value=$aSettings.adduser_location}
			<select name="val[value][{$aSettingL.var_name}]">
			{foreach from=$aSettingL.values key=mKey item=sDropValue}
				<option value="{$mKey}"{if $aSettingL.value_actual == $mKey} selected="selected"{/if}>{$sDropValue}</option>
			{/foreach}
			</select>
		</div>			
	</div>	
	<div class="table" id="user_group_div">
		<div class="table_left">
			<label for="group">{phrase var='user.group'}:</label>
		</div>
		<div class="table_right">
			{assign var=aSettingGr value=$aSettings.adduser_group}
			<select name="val[user_group_id]" id="user_group">
			{foreach from=$aSettingGr.values key=mKey item=sDropValue}
				<option value="{$mKey}"{if $aSettingGr.value_actual == $mKey} selected="selected"{/if}>{$sDropValue}</option>
			{/foreach}
			</select>
		</div>			
	</div>

{if count($aPackages) > 0}
	<div class="table">
		<div class="table_left">
			<label for="packages">{phrase var='subscribe.subscription_packages'}:</label>
		</div>
		<div class="table_right">
			<select name="val[package_id]" id="package">
				<option value="0" selected='selected'>None</option>
			{foreach from=$aPackages item=sDropValue}
				<option value="{$sDropValue.package_id}">{$sDropValue.title}</option>
			{/foreach}
			</select>
		</div>			
	</div>
{/if}



	{if $bCustomExists}
	<div class="table">

		{foreach from=$aCusFld item=aSetting}
		<div class="table js_custom_groups{if isset($aSetting.group_id)} js_custom_group_{$aSetting.group_id}{/if}">
			<div class="table_left">
			{if $aSetting.is_required && !Phpfox::isAdminPanel()}{required}{/if}{phrase var=$aSetting.phrase_var_name}:
			</div>
			<div class="table_right">
				{template file='custom.block.form'}
			</div>
		</div>
		{/foreach}

	</div>
	{/if}

	<div class="table_clear">
		<input type="submit" value="{phrase var='user.submit'}" class="button_register"  id="js_registration_submit"/>
	</div>

</form>
</div>
{/if}
<!--End add user-->