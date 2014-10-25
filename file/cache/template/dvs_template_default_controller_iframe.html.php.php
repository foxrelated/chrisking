<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 21, 2014, 8:10 pm */ ?>
<?php if ($this->_aVars['sBrowser'] == 'mobile'): ?>
	<?php
						Phpfox::getLib('template')->getBuiltFile('dvs.controller.iframe-mobile-view');						
						 else: ?>
<header>
	<section id="select_new">
<?php if ($this->_aVars['aVideoSelectYears']): ?>
			<table width="100%">
				<tr>
					<td>
						<h3><?php echo Phpfox::getPhrase('dvs.choose_new_vehicle'); ?>:</h3>
					</td>
<?php if (isset ( $this->_aVars['aVideoSelectYears']['1'] )): ?>
					<td>
						<ul id="year">
						<li class="init"><span class="init_selected">Select Year</span>
						  <ul>
<?php if (count((array)$this->_aVars['aVideoSelectYears'])):  foreach ((array) $this->_aVars['aVideoSelectYears'] as $this->_aVars['iYear']): ?>
							<li onclick="$.ajaxCall('dvs.getMakes', 'iYear=<?php echo $this->_aVars['iYear']; ?>&amp;sDvsName=<?php echo $this->_aVars['aDvs']['title_url']; ?>');">
<?php echo $this->_aVars['iYear']; ?>
							</li>
<?php endforeach; endif; ?>
						  </ul>
						</li>
						</ul>
					</td>
<?php endif; ?>
					<td>
						<ul id="makes">
						<li class="init">
						  &nbsp;&nbsp;<?php echo Phpfox::getPhrase('dvs.select_make'); ?>
						  <ul>
							<li>
<?php echo Phpfox::getPhrase('dvs.please_select_a_year_first'); ?>
							</li>
						  </ul>
						</li>
						</ul>
					</td>
					<td>
						<ul id="models">
						<li class="init">
						  &nbsp;&nbsp;<?php echo Phpfox::getPhrase('dvs.select_model'); ?>
						  <ul>
							<li>
<?php echo Phpfox::getPhrase('dvs.please_select_a_year_first'); ?>
							</li>
						  </ul>
						</li>
						</ul>
					</td>
				</tr>
			</table>
<?php endif; ?>
	</section>
</header>
<article>
	<section id="player">
		<?php
						Phpfox::getLib('template')->getBuiltFile('dvs.controller.player.iframe-player');						
						?>
	</section>

    <aside>
<?php if ($this->_aVars['aDvs']['title_url'] == 'bobmooresubaru' && 'bobmoorecadillacnorman' && 'bobmoorecadillacokc'): ?>
<?php elseif ($this->_aVars['aDvs']['title_url'] == 'bobmoorecadillacnorman'): ?>
<?php elseif ($this->_aVars['aDvs']['title_url'] == 'bobmoorecadillacokc'): ?>
<?php else: ?>
        <div id="contact_box">
            <h2>Contact <?php echo $this->_aVars['aDvs']['dealer_name']; ?></h2>
            <?php
						Phpfox::getLib('template')->getBuiltFile('dvs.block.contact-iframe');						
						?>
        </div>
<?php endif; ?>
    </aside>
	
	<section id="dealer_links">
	  <table>
	  <tr>
	  <td>
<?php if ($this->_aVars['aDvs']['inventory_url']): ?>
	  <a href="<?php echo $this->_aVars['aDvs']['inventory_url']; ?>" onclick="menuInventory('Call To Action Menu Clicks');" rel="nofollow" target="_parent">
<?php echo Phpfox::getPhrase('dvs.cta_inventory'); ?>
	  </a>
<?php endif; ?>
	  </td>
	  <td>&nbsp;</td>
	  <td>
<?php if ($this->_aVars['aDvs']['specials_url']): ?>
	  <a href="<?php echo $this->_aVars['aDvs']['specials_url']; ?>" onclick="menuOffers('Call To Action Menu Clicks');" rel="nofollow" target="_parent">
<?php echo Phpfox::getPhrase('dvs.cta_specials'); ?>
	  </a>
<?php endif; ?>
	  </td>
	  </tr>
	  </table>
	</section>

    <section id="video_information">
        <h3 id="video_name">
            <a id="current_video_link" href="<?php echo $this->_aVars['sNewParentUrl']; ?>" onclick="return false;">
<?php echo $this->_aVars['aDvs']['phrase_overrides']['override_video_name_display']; ?>
            </a>
        </h3>
        <p class="model_description" id="car_description"><?php echo $this->_aVars['aDvs']['phrase_overrides']['override_video_description_display']; ?></p>
    </section>
	
<?php if (Phpfox ::isUser()): ?>
	<section id="dealer_links">
		<table style="border-top:1px solid #ccc;">
			<tr><td colspan="4">&nbsp;</td></tr>
			<tr>
				<td>
					<p><b>Dealer-Only Links:</b>&nbsp;</p>
				</td>
				<td>
					<a href="<?php if ($this->_aVars['bSubdomainMode']):  echo Phpfox::getLib('phpfox.url')->makeUrl($this->_aVars['aDvs']['title_url']);  else:  echo Phpfox::getLib('phpfox.url')->makeUrl('dvs.'.$this->_aVars['aDvs']['title_url']);  endif; ?>share" onclick="" rel="nofollow" target="_blank" style="font-size:16px;">
<?php echo Phpfox::getPhrase('dvs.dealer_share_links'); ?>
					</a>
				</td>
				<td>&nbsp;</td>
				<td>
<?php if (Phpfox ::getUserId() == $this->_aVars['aDvs']['user_id'] || Phpfox ::isAdmin()): ?>
					<a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('dvs.salesteam', array('id' => $this->_aVars['aDvs']['dvs_id'])); ?>" onclick="" rel="nofollow" target="_blank"  style="font-size:16px;">
<?php echo Phpfox::getPhrase('dvs.manage_sales_team'); ?>
					</a>
<?php endif; ?>
				</td>
			</tr>
			<tr><td colspan="4"><p><i>*Dealer-Only Links (and this message) are not seen by the public. You are seeing this because you are logged into the DVS backend at http://www.wtvdvs.com</i></p></td></tr>
		</table>
	</section>
    <div class="clear"></div>
<?php else: ?>
    <section id="share_links">
        <input type="hidden" value="<?php echo $this->_aVars['sNewParentUrl']; ?>" id="parent_url">
        <input type="hidden" value="<?php echo $this->_aVars['sVideoUrl']; ?>" id="video_url">
        <input type="hidden" value="<?php echo Phpfox::getPhrase('dvs.twitter_default_share_text', array('video_year' => $this->_aVars['aDvs']['featured_year'],'video_make' => $this->_aVars['aDvs']['featured_make'],'video_model' => $this->_aVars['aDvs']['featured_model'],'dvs_dealer_name' => $this->_aVars['aDvs']['dealer_name'])); ?>" id="share_title">
        <input type="hidden" value="<?php echo $this->_aVars['sVideoThumb']; ?>" id="video_thumbnail">
        <table cellpadding="4" cellspacing="4" border="0">
            <tr>
            	<td style="vertical-align:middle;">
            	<p style="font-size:14px;"><b>Share This:</b>&nbsp;</p>
            	</td>
                <td style="vertical-align:middle;">
                    <a href="#" onclick="tb_show('<?php echo Phpfox::getPhrase('dvs.share_via_email'); ?>', $.ajaxBox('dvs.emailFormIframe', 'height=400&amp;width=360&amp;sParentUrl=' + encodeURIComponent($('#parent_url').val().replace('WTVDVS_VIDEO_TEMP', $('#video_url').val())) + '&amp;longurl=1&amp;iDvsId=<?php echo $this->_aVars['iDvsId']; ?>&amp;sRefId=' + aCurrentVideoMetaData.referenceId));  showEmailShare(); return false;">
                        <img src="<?php echo $this->_aVars['sImagePath']; ?>email-share.png" alt="Share Via Email"/>
                    </a>
                </td>
<?php if (Phpfox ::isModule('redirect')): ?>
               <td style="vertical-align:middle;">
                    <a href="#" onclick="window.open('https://www.facebook.com/share.php?u=' + encodeURI('<?php echo Phpfox::getLib('phpfox.url')->makeUrl('share.'.$this->_aVars['sDvsRequest']); ?>parent_<?php echo $this->_aVars['sParentUrlEncode']; ?>/video_' + $('#video_url').val()), 'Facebook Share', 'width=626,height=436'); facebookShareClick('Share Links'); return false;">
                        <img src="<?php echo $this->_aVars['sImagePath']; ?>facebook-share.png" alt="Share to Facebook"/>
                    </a>
                </td>
<?php endif; ?>
                <td style="vertical-align:middle;padding-left:2px;padding-right:2px;">
					<span id="twitter_button_wrapper">
					<a href="https://twitter.com/intent/tweet?text=<?php echo Phpfox::getPhrase('dvs.twitter_default_share_text', array('video_year' => $this->_aVars['aDvs']['featured_year'],'video_make' => $this->_aVars['aDvs']['featured_make'],'video_model' => $this->_aVars['aDvs']['featured_model'],'dvs_dealer_name' => $this->_aVars['aDvs']['dealer_name'])); ?>&url=<?php echo $this->_aVars['sParentUrl']; ?>" id="twitter_share"><img src="<?php echo $this->_aVars['sImagePath']; ?>twitter-button.png" alt="Tweet" /></a>
					</span>
                </td>
<?php if (Phpfox ::isModule('redirect')): ?>
                <td style="vertical-align:middle;">
                    <a href="#" onclick="window.open('https://plus.google.com/share?url=' + encodeURI('<?php echo Phpfox::getLib('phpfox.url')->makeUrl('share.'.$this->_aVars['sDvsRequest']); ?>parent_<?php echo $this->_aVars['sParentUrlEncode']; ?>/video_' + $('#video_url').val())); googleShareClick('Share Links'); return false;">
                        <img src="<?php echo $this->_aVars['sImagePath']; ?>google-share.png" alt="Google+" title="Google+"/>
                    </a>
                </td>
<?php endif; ?>
            </tr>
        </table>
    </section>
<?php endif; ?>
</article>
<div class="clear"></div>
<footer></footer>
<?php endif; ?>

<?php echo '
<script type="text/javascript">
    $Behavior.loadUrlVideo = function() {
        setInterval(function() {
            if (!bUpdatedShareUrl) {
                $.ajaxCall(\'dvs.updateShareUrl\', \'ref-id=\'+ aCurrentVideoMetaData.referenceId + \'&iDvsId=\' + iDvsId);
                bUpdatedShareUrl = true;
            }
        }, 1000);
    }
</script>
'; ?>

