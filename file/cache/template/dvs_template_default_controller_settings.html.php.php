<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 21, 2014, 8:26 pm */ ?>
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

 if ($this->_aVars['bCanAddDvss'] || $this->_aVars['bIsEdit']):  echo '
<script type="text/javascript">
	$Behavior.keyUp = function() {
		$(\'#vanity_url\').keyup(function(){
			if($(\'#vanity_url\').val()){
				'; ?>

<?php if ($this->_aVars['bIsEdit'] && isset ( $this->_aVars['aForms']['dvs_id'] )): ?>
						$.ajaxCall('dvs.updateTitleUrl','vanity_url='+this.value+'&dvs_id=<?php echo $this->_aVars['aForms']['dvs_id']; ?>');
<?php else: ?>
						$.ajaxCall('dvs.updateTitleUrl','vanity_url='+this.value);
<?php endif; ?>
				<?php echo '
			}
			else
			{
				$(\'#title_url_display\').html(\'Enter a vanity URL above to see a preview.\');
			}
		});
		'; ?>

<?php if (! $this->_aVars['bIsEdit']): ?>
		<?php echo '
		$(\'#js_country_child_id_value\').attr(\'required\',\'required\');
		$(\'#js_country_child_id_value option:first\').attr("value","");
		$(\'#js_country_child_id_value option:first\').attr("selected",false);
		$(\'#js_country_child_id_value option:first\').attr("selected",true);
		'; ?>

<?php endif; ?>
		<?php echo '
	}
</script>
<style type="text/css">
	'; ?>

<?php if ($this->_aVars['aForms']['inv_display_status'] == 0): ?>
	<?php echo '
		.inv_display_row_wrapper{
			display: none;
		}
	'; ?>

<?php endif; ?>
	<?php echo '
</style>

<script type="text/javascript">

	var total = 100;
	var totalvideos = 100;
	var job = "asdf";
	var run=true;
	current_progress = 0;

	$Behavior.domReady = function(){
		$(\'#inventory_import_button_ajax\').on(\'click\', function(){
			$(\'.progress_bar_wrapper\').show(\'slow\');
			setInterval(function(){process_increase()}, 1000);
            '; ?>

<?php if (isset ( $this->_aVars['aForms']['dvs_id'] )): ?>
                <?php echo '
                $.ajaxCall(\'dvs.instantImport\',
                    \'dvs_id=';  echo $this->_aVars['aForms']['dvs_id'];  echo '\'
                );
                '; ?>

<?php endif; ?>
            <?php echo '
		});
		$(\'#inv_display_status_on\').on(\'click\', function(){
			var confirm_res = confirm("';  echo Phpfox::getPhrase('dvs.inventory_settings_disclaimer');  echo '");
			if (confirm_res == true) {
				$(\'.inv_display_row_wrapper\').css(\'display\', \'block\');
				return true;
			} else {
				return false;
			}
		});
		$(\'#inv_display_status_off\').on(\'click\', function(){
			$(\'.inv_display_row_wrapper\').css(\'display\', \'none\');
		});
	};

	function autoUpdate(offset){
		if (offset < total && run){
            '; ?>

<?php if (isset ( $this->_aVars['aForms']['dvs_id'] )): ?>
                <?php echo '
                $.ajaxCall(\'dvs.instantImport\',
                    \'dvs_id=';  echo $this->_aVars['aForms']['dvs_id'];  echo '\'
                );
                '; ?>

<?php endif; ?>
            <?php echo '
		};
		if (run == false){
			$("#progress_running").toggle("slow");
			$("#progress_stopped").toggle("slow");
		};
		if (offset >= total){
			$("#progress_running").hide("slow");
			$("#progress_outer").hide("slow");
			$("#progress_update").hide("slow");
			$("#progress_complete").show("slow");
			
			$(\'#dvs_message\').show(\'slow\');
		};

	};
	function restart(offset){
		$("#progress_running").show("slow");
		$("#progress_stopped").hide("slow");
		run=true;
		autoUpdate(offset);
	};

	function finishProgress(){
		alert(\'';  echo $this->_aVars['sMessage'];  echo '\');
		current_progress = 100;
		$(\'#progress_inner\').stop().animate({
			width: \'100%\'
		}, 300, function() {});
		$("#progress_percentage").html("100%");

		// $("#progress_running").hide("slow");
		// $("#progress_outer").hide("slow");
		// $("#progress_update").hide("slow");
		// $("#progress_complete").show("slow");
		
		$(\'#dvs_message\').show(\'slow\');
	}

	function process_increase(){
		if(current_progress >= 99){
			return false;
		}
		current_progress = current_progress + 1;
		$(\'#progress_inner\').stop().animate({
			width: current_progress + \'%\'
		}, 300, function() {});
		$("#progress_percentage").html(current_progress + "%");
	};
</script>
<style type="text/css">
	#progress_outer{
		border: 1px solid #000;
		width: 600px;
		height: 15px;
	}
	#progress_inner{
		width: 0%;
		height: 15px;
		background: #ff8c22;
	}
	#progress_percentage{
		position: absolute;
		float: center;
		width: 600px;
		height:15px;
		color:#000;
		font-weight: bold;
		text-align: center;
		padding-top: 2px;
	}
</style>
'; ?>


<?php if (isset ( $this->_aVars['importInventoryRes'] ) && $this->_aVars['importInventoryRes']): ?>
	<?php echo '
		<script type="text/javascript">
			$Behavior.message = function() {
				$(\'#dvs_message\').show(\'slow\');
				// $(\'#dvs_message\').animate({top: 0}, 1000).hide(\'slow\');
			}
		</script>
	'; ?>

<?php endif; ?>
<div class="message" id="dvs_message" style="display:none;">
<?php echo $this->_aVars['sMessage']; ?>
</div>

<form method="post" action="" id="import_dvs" name="import_dvs">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>

</form>

<form method="post" action="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('dvs.index'); ?>" id="add_dvs" name="add_dvs">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>
	<fieldset>
		<ol>
			<li>
				<label for="dealer_name"><?php if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif;  echo Phpfox::getPhrase('dvs.dealer_name'); ?>:</label>
				<input type="text" name="val[dealer_name]" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['dealer_name']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['dealer_name']) : (isset($this->_aVars['aForms']['dealer_name']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['dealer_name']) : '')); ?>
" id="dealer_name" size="60" maxlength="60" required />
				
			</li>
			<li>
				<label for="showroom_name"><?php if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif;  echo Phpfox::getPhrase('dvs.showroom_name'); ?>:</label>
<?php if (! $this->_aVars['bIsEdit']): ?>
				<input type="text"  size="60" maxlength="60" required name="val[dvs_name]" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['dvs_name']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['dvs_name']) : (isset($this->_aVars['aForms']['dvs_name']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['dvs_name']) : '')); ?>
" id="dvs_name" />
<?php endif; ?>
<?php if ($this->_aVars['bIsEdit'] && Phpfox ::isAdmin()): ?>
				<input type="text" size="60" maxlength="60" required name="val[dvs_name]" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['dvs_name']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['dvs_name']) : (isset($this->_aVars['aForms']['dvs_name']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['dvs_name']) : '')); ?>
" id="dvs_name" />
<?php endif; ?>
<?php if ($this->_aVars['bIsEdit'] && ! Phpfox ::isAdmin()): ?>
				&nbsp;<?php echo $this->_aVars['aForms']['dvs_name']; ?>
<?php endif; ?>
				
			</li>
	
<?php if (! $this->_aVars['bIsEdit'] || Phpfox ::isAdmin()): ?>
			<li>
				<label for="vanity_url"><?php if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif;  echo Phpfox::getPhrase('dvs.vanity_url'); ?>:</label>
<?php if ($this->_aVars['bIsEdit']): ?>
				<input type="text" size="60" maxlength="60" required name="val[vanity_url]" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['title_url']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['title_url']) : (isset($this->_aVars['aForms']['title_url']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['title_url']) : '')); ?>
" id="vanity_url" />
<?php else: ?>
				<input type="text" size="60" maxlength="60" required name="val[vanity_url]" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['vanity_url']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['vanity_url']) : (isset($this->_aVars['aForms']['vanity_url']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['vanity_url']) : '')); ?>
" id="vanity_url" />
<?php endif; ?>
					
			</li>
<?php endif; ?>
	
			<li>
				<label for="preview_url">Preview URL:</label>
				<span id="title_url_display">&nbsp;<?php if ($this->_aVars['bIsEdit']):  if ($this->_aVars['bSubdomainMode']):  echo Phpfox::getLib('phpfox.url')->makeUrl($this->_aVars['aForms']['title_url']);  else:  echo Phpfox::getLib('phpfox.url')->makeUrl('dvs');  echo $this->_aVars['aForms']['title_url'];  endif;  else:  echo Phpfox::getPhrase('dvs.please_enter_a_vanity_url_above');  endif; ?></span>
			</li>
	
			<li>
				<label for="address"><?php if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif;  echo Phpfox::getPhrase('dvs.address'); ?>:</label>
				<input type="text" name="val[address]" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['address']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['address']) : (isset($this->_aVars['aForms']['address']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['address']) : '')); ?>
" id="address"  size="60" maxlength="60" required />
				
			</li>
	
			<li>
				<label for="city"><?php if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif;  echo Phpfox::getPhrase('dvs.city'); ?>:</label>
				<input type="text" name="val[city]" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['city']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['city']) : (isset($this->_aVars['aForms']['city']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['city']) : '')); ?>
" id="city" size="60" maxlength="60" required />
			</li>
	
			<li>
				<label for="state"><?php if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif; ?>State:</label>
<?php if ($this->_aVars['bIsEdit']): ?>
<?php Phpfox::getBlock('core.country-child', array('country_child_id' => $this->_aVars['aForms']['country_child_id'])); ?>
<?php else: ?>
<?php Phpfox::getBlock('core.country-child', array()); ?>
<?php endif; ?>
			</li>
	
			<li>
				<label for="zip_code"><?php echo Phpfox::getPhrase('dvs.zip_code'); ?>:</label>
				<input type="text" name="val[postal_code]" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['postal_code']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['postal_code']) : (isset($this->_aVars['aForms']['postal_code']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['postal_code']) : '')); ?>
" id="postal_code" size="60" maxlength="5" />
			</li>
	
			<li>
				<label for="contact_phone"><?php echo Phpfox::getPhrase('dvs.contact_phone'); ?>:</label>
				<input type="tel" name="val[phone]" size="60" maxlength="13" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['phone']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['phone']) : (isset($this->_aVars['aForms']['phone']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['phone']) : '')); ?>
" id="phone" />
				
			</li>
	
			<li>
				<label for="contact_email"><?php echo Phpfox::getPhrase('dvs.contact_email'); ?>:</label>
				<input type="email" name="val[email]" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['email']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['email']) : (isset($this->_aVars['aForms']['email']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['email']) : '')); ?>
" id="email"  size="60" maxlength="200" />
				
			</li>
	
			<li>
				<label for="website_url"><?php echo Phpfox::getPhrase('dvs.website_url'); ?>:</label>
				<input type="url" name="val[url]" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['url']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['url']) : (isset($this->_aVars['aForms']['url']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['url']) : '')); ?>
" id="url" size="60" maxlength="300"/>
				
			</li>
	
			<li>
				<label for="inventory_url"><?php echo Phpfox::getPhrase('dvs.inventory_url'); ?>:</label>
				<input type="url" name="val[inventory_url]" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['inventory_url']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['inventory_url']) : (isset($this->_aVars['aForms']['inventory_url']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['inventory_url']) : '')); ?>
" id="inventory_url" size="60" maxlength="300"/>
				
			</li>
	
			<li>
				<label for="dealer_specials_url"><?php echo Phpfox::getPhrase('dvs.dealer_specials_url'); ?>:</label>
				<input type="url" name="val[specials_url]" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['specials_url']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['specials_url']) : (isset($this->_aVars['aForms']['specials_url']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['specials_url']) : '')); ?>
" id="specials_url" size="60" maxlength="300" />
			</li>
	
			<li>
				<label for="welcome_greeting" style="width:250px;"><?php echo Phpfox::getPhrase('dvs.welcome_greeting_max_char_max', array('max' => $this->_aVars['iWelcomeGreetingMaxChars'])); ?>:</label>
				<?php Phpfox::getBlock('attachment.share');  echo Phpfox::getLib('phpfox.editor')->get('welcome', array (
  'id' => 'welcome',
  'rows' => '5',
)); ?>
				
			</li>
	
			<li>
				<label for="custom_seo_tags"><?php echo Phpfox::getPhrase('dvs.custom_seo_tags'); ?>:</label>
				<input type="text" name="val[seo_tags]" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['seo_tags']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['seo_tags']) : (isset($this->_aVars['aForms']['seo_tags']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['seo_tags']) : '')); ?>
" id="seo_tags" size="60" maxlength="100" />
				&nbsp;Note: Separate tags with commas
			</li>
	
			<li>
				<label for="google_analytics_id"><?php echo Phpfox::getPhrase('dvs.google_analytics_id'); ?>:</label>
				<input type="text" name="val[dvs_google_id]" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['dvs_google_id']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['dvs_google_id']) : (isset($this->_aVars['aForms']['dvs_google_id']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['dvs_google_id']) : '')); ?>
" id="dvs_google_id" size="60" maxlength="20" />
			</li>
		</ol>
		</fieldset>

		<div <?php if (Phpfox ::isAdmin()):  else: ?>style="display:none;"<?php endif; ?>>
		<h1>Admin Only Settings</h1>
		<h3>Layout Toggles</h3>
		<fieldset>
		<ol>
			<li>
				<label for="banner_toggle"><?php echo Phpfox::getPhrase('dvs.banner_toggle'); ?>:</label>
				<input type="radio" name="val[banner_toggle]" value="1" <?php if ($this->_aVars['bIsEdit'] && $this->_aVars['aForms']['banner_toggle'] == 1): ?>checked="checked"<?php endif; ?> <?php if (! $this->_aVars['bIsEdit']): ?>checked="checked" <?php endif; ?> /><?php echo Phpfox::getPhrase('dvs.dvs_inventory_status_on'); ?>
				<input type="radio" name="val[banner_toggle]" value="0" <?php if ($this->_aVars['bIsEdit'] && $this->_aVars['aForms']['banner_toggle'] == 0): ?>checked="checked"<?php endif; ?> /><?php echo Phpfox::getPhrase('dvs.dvs_inventory_status_off'); ?>
			</li>
			<li>
				<label for="top_menu_toggle"><?php echo Phpfox::getPhrase('dvs.top_menu_toggle'); ?>:</label>
				<input type="radio" name="val[topmenu_toggle]" value="1" <?php if ($this->_aVars['bIsEdit'] && $this->_aVars['aForms']['topmenu_toggle'] == 1): ?>checked="checked"<?php endif; ?> <?php if (! $this->_aVars['bIsEdit']): ?>checked="checked" <?php endif; ?> /><?php echo Phpfox::getPhrase('dvs.dvs_inventory_status_on'); ?>
				<input type="radio" name="val[topmenu_toggle]" value="0" <?php if ($this->_aVars['bIsEdit'] && $this->_aVars['aForms']['topmenu_toggle'] == 0): ?>checked="checked"<?php endif; ?> /><?php echo Phpfox::getPhrase('dvs.dvs_inventory_status_off'); ?>
			</li>
			<li>
				<label for="footer_toggle"><?php echo Phpfox::getPhrase('dvs.footer_toggle'); ?>:</label>
				<input type="radio" name="val[footer_toggle]" value="1" <?php if ($this->_aVars['bIsEdit'] && $this->_aVars['aForms']['footer_toggle'] == 1): ?>checked="checked"<?php endif; ?> <?php if (! $this->_aVars['bIsEdit']): ?>checked="checked" <?php endif; ?> /><?php echo Phpfox::getPhrase('dvs.dvs_inventory_status_on'); ?>
				<input type="radio" name="val[footer_toggle]" value="0" <?php if ($this->_aVars['bIsEdit'] && $this->_aVars['aForms']['footer_toggle'] == 0): ?>checked="checked"<?php endif; ?> /><?php echo Phpfox::getPhrase('dvs.dvs_inventory_status_off'); ?>
			</li>
		</ol>
		</fieldset>

		<h3>Gallery Link Target</h3>
		<fieldset>
		<ol>
			<li>
				<input type="radio" name="val[gallery_target_setting]" value="0" <?php if ($this->_aVars['bIsEdit'] && $this->_aVars['aForms']['gallery_target_setting'] == 0): ?>checked="checked"<?php endif; ?> <?php if (! $this->_aVars['bIsEdit']): ?>checked="checked"<?php endif; ?>/><?php echo Phpfox::getPhrase('dvs.open_on_same_page'); ?>
			</li>
		
			<li>
				<input type="radio" name="val[gallery_target_setting]" value="1" <?php if ($this->_aVars['bIsEdit'] && $this->_aVars['aForms']['gallery_target_setting'] == 1): ?>checked="checked"<?php endif; ?> /><?php echo Phpfox::getPhrase('dvs.open_in_new_window'); ?>
			</li>
		</ol>
		</fieldset>

		<h3><?php echo Phpfox::getPhrase('dvs.inventory_display_settings'); ?></h3>

		<fieldset>
		<ol>
			<li>
				<input type="radio" name="val[inv_display_status]" value="0" id="inv_display_status_off" <?php if ($this->_aVars['bIsEdit'] && $this->_aVars['aForms']['inv_display_status'] == 0): ?>checked="checked"<?php endif; ?> <?php if (! $this->_aVars['bIsEdit']): ?>checked="checked"<?php endif; ?>/><?php echo Phpfox::getPhrase('dvs.dvs_inventory_status_off'); ?>
				<input type="radio" name="val[inv_display_status]" value="1" id="inv_display_status_on" <?php if ($this->_aVars['bIsEdit'] && $this->_aVars['aForms']['inv_display_status'] == 1): ?>checked="checked"<?php endif; ?> /><?php echo Phpfox::getPhrase('dvs.dvs_inventory_status_on'); ?>
			</li>
			<div class="inv_display_row_wrapper">
			<li>
				<label for="inventory_settings_feed_type"><?php echo Phpfox::getPhrase('dvs.inventory_settings_feed_type'); ?>:</label>
				<select name="val[inv_feed_type]" id="inv_feed_type">
					<option value=""></option>
<?php if ($this->_aVars['connectors']): ?>
<?php if (count((array)$this->_aVars['connectors'])):  $this->_aPhpfoxVars['iteration']['iConnector'] = 0;  foreach ((array) $this->_aVars['connectors'] as $this->_aVars['connector']):  $this->_aPhpfoxVars['iteration']['iConnector']++; ?>

							<option value="<?php echo $this->_aVars['connector']['connector_id']; ?>" <?php if ($this->_aVars['aForms']['inv_feed_type'] == $this->_aVars['connector']['connector_id']): ?>selected="selected"<?php endif; ?>><?php echo $this->_aVars['connector']['title']; ?></option>
<?php endforeach; endif; ?>
<?php endif; ?>
				</select>
			</li>
			<li>
				<label for="inventory_settings_domain"><?php echo Phpfox::getPhrase('dvs.inventory_settings_domain'); ?>:</label>
				<input type="text" name="val[inv_domain]" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['inv_domain']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['inv_domain']) : (isset($this->_aVars['aForms']['inv_domain']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['inv_domain']) : '')); ?>
" id="inv_domain" maxlength=30 />
			</li>
			<li>
				<label for="dvs_inventory_schedule"><?php echo Phpfox::getPhrase('dvs.dvs_inventory_shedule'); ?>:</label>
<?php echo Phpfox::getPhrase('dvs.dvs_inventory_shedule_every'); ?> <input type="text" name="val[inv_schedule_hours]" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['inv_schedule_hours']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['inv_schedule_hours']) : (isset($this->_aVars['aForms']['inv_schedule_hours']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['inv_schedule_hours']) : '')); ?>
" id="inv_schedule_hours" maxlength=3 style="width:20px;" /> <?php echo Phpfox::getPhrase('dvs.dvs_inventory_shedule_hours'); ?>
			</li>
			<li>
				<div class="import_button_wrapper">
					<button class="button" id="inventory_import_button_ajax" name="inventory_import_button_ajax"><?php echo Phpfox::getPhrase('dvs.dvs_inventory_import'); ?></button>
				</div>
				<div class="progress_bar_wrapper">
					<div id="progress_outer">
						<div id="progress_percentage">0%</div>
						<div id="progress_inner"></div>
					</div>
					<div id="progress_update"></div>
				</div>
			</li>
			</div>
		</ol>
	</fieldset>

    <h3>Use Parent Url for Sitemap</h3>
    <fieldset>
        <ol>

            <li>
<?php if (! isset ( $this->_aVars['aForms']['parent_url'] )): ?>
                <h1 style="background: #FF0000; color: #FFFFFF; padding-left: 10px; font-size: 14px; line-height: 25px; height: 25px;">You need to embed the iframe code on the dealer site first!</h1>
<?php else: ?>
                <h1 style="background: #00FF00; color: #000000; padding-left: 10px; font-size: 14px; line-height: 25px; height: 25px;">DVS iFrame integrated: <a href="<?php echo $this->_aVars['aForms']['parent_url']; ?>"><b><?php echo $this->_aVars['aForms']['parent_url']; ?></b></a></h1>
<?php endif; ?>

                <input type="radio" name="val[sitemap_parent_url]" value="0" <?php if (! $this->_aVars['bIsEdit'] || ! isset ( $this->_aVars['aForms']['parent_url'] ) || ( $this->_aVars['bIsEdit'] && $this->_aVars['aForms']['sitemap_parent_url'] == 0 )): ?>checked="checked"<?php endif; ?> /><?php echo Phpfox::getPhrase('dvs.dvs_inventory_status_off'); ?>
                <input <?php if (! isset ( $this->_aVars['aForms']['parent_url'] )): ?>disabled="disabled"<?php endif; ?> type="radio" name="val[sitemap_parent_url]" value="1" <?php if ($this->_aVars['bIsEdit'] && $this->_aVars['aForms']['sitemap_parent_url'] == 1 && isset ( $this->_aVars['aForms']['parent_url'] )): ?>checked="checked"<?php endif; ?>/><?php echo Phpfox::getPhrase('dvs.dvs_inventory_status_on'); ?>
            </li>
        </ol>
    </fieldset>

    <h3>Video Types</h3>
    <fieldset>
        <ol>
            <li>
                <label for="new_car_videos">New Car Videos:</label>
                <input type="radio" name="val[new_car_videos]" value="1" <?php if ($this->_aVars['bIsEdit'] && $this->_aVars['aForms']['new_car_videos'] == 1): ?>checked="checked"<?php endif; ?> <?php if (! $this->_aVars['bIsEdit']): ?>checked="checked" <?php endif; ?> /><?php echo Phpfox::getPhrase('dvs.dvs_inventory_status_on'); ?>
                <input type="radio" name="val[new_car_videos]" value="0" <?php if ($this->_aVars['bIsEdit'] && $this->_aVars['aForms']['new_car_videos'] == 0): ?>checked="checked"<?php endif; ?> /><?php echo Phpfox::getPhrase('dvs.dvs_inventory_status_off'); ?>
            </li>

            <li>
                <label for="used_car_videos">Used Car Videos:</label>
                <input type="radio" name="val[used_car_videos]" value="1" <?php if ($this->_aVars['bIsEdit'] && $this->_aVars['aForms']['used_car_videos'] == 1): ?>checked="checked"<?php endif; ?> <?php if (! $this->_aVars['bIsEdit']): ?>checked="checked" <?php endif; ?> /><?php echo Phpfox::getPhrase('dvs.dvs_inventory_status_on'); ?>
                <input type="radio" name="val[used_car_videos]" value="0" <?php if ($this->_aVars['bIsEdit'] && $this->_aVars['aForms']['used_car_videos'] == 0): ?>checked="checked"<?php endif; ?> /><?php echo Phpfox::getPhrase('dvs.dvs_inventory_status_off'); ?>
            </li>
        </ol>
    </fieldset>
	</div>
<br>
	<div id="phrase_override_toggle">
		<a href="#" onclick="if ($('#phrase_override_wrapper').is(':visible')){$('#phrase_override_wrapper').hide('slow');wtvlt='Show Phrase Overrides'}else{$('#phrase_override_wrapper').show('slow');wtvlt='Hide Phrase Overrides (values will still be saved)';}$(this).text(wtvlt);return false;" id="phrase_override_toggle_link">Show Phrase Overrides</a>
	</div>
	<div id="phrase_override_wrapper" style="display:none;">
<?php if (count((array)$this->_aVars['aPhraseVars'])):  foreach ((array) $this->_aVars['aPhraseVars'] as $this->_aVars['sPhraseVar'] => $this->_aVars['sPhraseText']): ?>
			<div class="phrase_override_container">		
<?php $this->_aVars["sDescriptionPhraseVar"]=str_replace("override_","",$this->_aVars["sPhraseVar"]); // Get descrition variable name, assign it to sDescriptionPhraseVar?>
				<div class="phrase_override_row phrase_override_container">
					<div class="phrase_override_label">
<?php echo Phpfox::getPhrase('dvs.'.$this->_aVars['sDescriptionPhraseVar']); ?>:
					</div>
					<div class="phrase_override_input_container">
						<input class="phrase_override_input" type="text" name="val[phrase_overrides][<?php echo $this->_aVars['sPhraseVar']; ?>]" value="<?php if ($this->_aVars['sPhraseText']):  echo $this->_aVars['sPhraseText'];  endif; ?>" id="<?php echo $this->_aVars['sPhraseVar']; ?>" size="60" />
					</div>
				</div>
				<div class="phrase_override_row default_phrase_override_container">
					<div class="phrase_override_label phrase_override_default_label">
<?php echo Phpfox::getPhrase('dvs.default'); ?>:
					</div>
					<div class="phrase_override_default_input_container">
						<input class="phrase_override_default_input" type="text" value="<?php echo Phpfox::getPhrase('dvs.'.$this->_aVars['sPhraseVar']); ?>" readonly/>
					</div>
				</div>
			</div>
<?php endforeach; endif; ?>
		
		<h3><?php echo Phpfox::getPhrase('dvs.video_url_replacements'); ?></h3>
		
		<div class="phrase_override_container">		
			<div class="phrase_override_row phrase_override_container">
				<div class="phrase_override_label">
<?php echo Phpfox::getPhrase('dvs.new_car_videos'); ?>:
				</div>
				<div class="phrase_override_input_container">
					<input class="phrase_override_input" type="text" name="val[1onone_override]" value="<?php if ($this->_aVars['bIsEdit'] && isset ( $this->_aVars['aForms']['1onone_override'] )):  echo $this->_aVars['aForms']['1onone_override'];  endif; ?>" id="1onone_override" size="60" />
				</div>
			</div>
			<div class="phrase_override_row default_phrase_override_container">
				<div class="phrase_override_label phrase_override_default_label">
<?php echo Phpfox::getPhrase('dvs.default'); ?>:
				</div>
				<div class="phrase_override_default_input_container">
					<input class="phrase_override_default_input" type="text" value="<?php echo $this->_aVars['s1onOneDefault']; ?>" readonly/>
				</div>
			</div>
			
			<div class="phrase_override_container">		
				<div class="phrase_override_row phrase_override_container">
					<div class="phrase_override_label">
<?php echo Phpfox::getPhrase('dvs.used_car_review_videos'); ?>:
					</div>
					<div class="phrase_override_input_container">
						<input class="phrase_override_input" type="text" name="val[new2u_override]" value="<?php if ($this->_aVars['bIsEdit'] && isset ( $this->_aVars['aForms']['new2u_override'] )):  echo $this->_aVars['aForms']['new2u_override'];  endif; ?>" id="new2u_override" size="60" />
					</div>
				</div>
				<div class="phrase_override_row default_phrase_override_container">
					<div class="phrase_override_label phrase_override_default_label">
<?php echo Phpfox::getPhrase('dvs.default'); ?>:
					</div>
					<div class="phrase_override_default_input_container">
						<input class="phrase_override_default_input" type="text" value="<?php echo $this->_aVars['sNew2UDefault']; ?>" readonly/>
					</div>
				</div>
			</div>
						
			<div class="phrase_override_container">		
				<div class="phrase_override_row phrase_over<?php echo Phpfox::getPhrase('dvs.test_drive_videos'); ?>ride_container">
					<div class="phrase_override_label">
<?php echo Phpfox::getPhrase('dvs.test_drive_videos'); ?>:
					</div>
					<div class="phrase_override_input_container">
						<input class="phrase_override_input" type="text" name="val[top200_override]" value="<?php if ($this->_aVars['bIsEdit'] && isset ( $this->_aVars['aForms']['top200_override'] )):  echo $this->_aVars['aForms']['top200_override'];  endif; ?>" id="top200_override" size="60" />
					</div>
				</div>
				<div class="phrase_override_row default_phrase_override_container">
					<div class="phrase_override_label phrase_override_default_label">
<?php echo Phpfox::getPhrase('dvs.default'); ?>:
					</div>
					<div class="phrase_override_default_input_container">
						<input class="phrase_override_default_input" type="text" value="<?php echo $this->_aVars['sTop200Default']; ?>" readonly/>
					</div>
				</div>
			</div>
		</div>	
	</div>
		

	<div id="dvs_settings_save_button_container">
		<input type="hidden" name="val[step]" value="settings" />
		<input type="hidden" name="val[title_url]" id="title_url" value="<?php if ($this->_aVars['bIsEdit']):  echo $this->_aVars['aForms']['title_url'];  endif; ?>" />
<?php if ($this->_aVars['bIsEdit'] && ! Phpfox ::isAdmin()): ?>
		<input type="hidden" name="val[vanity_url]" id="vanity_url" value="<?php echo $this->_aVars['aForms']['title_url']; ?>" />
<?php endif; ?>
<?php if ($this->_aVars['bIsEdit'] && ! Phpfox ::isAdmin()): ?>
		<input type="hidden" name="val[dvs_name]" id="dvs_name" value="<?php echo $this->_aVars['aForms']['dvs_name']; ?>" />
<?php endif; ?>
		<input type="hidden" name="val[is_edit]" value="<?php if ($this->_aVars['bIsEdit'] && isset ( $this->_aVars['aForms']['dvs_id'] )): ?>1<?php else: ?>0<?php endif; ?>" />
<?php if ($this->_aVars['bIsEdit'] && isset ( $this->_aVars['aForms']['dvs_id'] )): ?><input type="hidden" name="val[dvs_id]" value="<?php echo $this->_aVars['aForms']['dvs_id']; ?>" /><?php endif; ?>
		<button class="button"><?php if ($this->_aVars['bIsEdit'] && isset ( $this->_aVars['aForms']['dvs_id'] )):  echo Phpfox::getPhrase('dvs.save_changes');  else:  echo Phpfox::getPhrase('dvs.save_and_continue');  endif; ?></button>
	</div>

</form>


<?php else: ?>

<div class="error_message">
<?php if ($this->_aVars['bIsEdit']): ?>
<?php echo Phpfox::getPhrase('dvs.error_editing_dvs'); ?>
<?php else: ?>
<?php echo Phpfox::getPhrase('dvs.error_adding_dvs'); ?>
<?php endif; ?>
</div>
<?php endif; ?>
