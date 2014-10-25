<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 21, 2014, 8:05 pm */ ?>
<?php
/**
 * [PHPFOX_HEADER]
 */
defined('PHPFOX') or exit('No direct script access allowed.');

/**
 *
 *
 * @copyright   Konsort.org
 * @author      Konsort.org
 * @package     DVS
 */
 echo '
<script type="text/javascript">
  $Behavior.shortenText = function() {
    $("#car_description").shorten({
      "showChars" : ';  echo $this->_aVars['iLongDescLimit'];  echo ',
      "ellipsesText" : "...",
      "moreText"  : "See More",
      "lessText"  : "See Less",
    });
  }
</script>
'; ?>


<?php if ($this->_aVars['bc'] == 'refid' || $this->_aVars['bPreview']):  echo '
<style type="text/css">
  #site_content{
    width: auto;
  }
</style>
'; ?>

<?php Phpfox::getBlock('dvstour.addtour', array()); ?>
  <section id="player">
    <?php
						Phpfox::getLib('template')->getBuiltFile('dvs.controller.player.player');						
						?>
  </section>
<?php else: ?>
<?php if ($this->_aVars['sBrowser'] == 'mobile'): ?>
    <?php
						Phpfox::getLib('template')->getBuiltFile('dvs.controller.view-mobile');						
						?>
<?php else: ?>
<?php if (! $this->_aVars['bPreview']): ?>
<?php if ($this->_aVars['aDvs']['banner_toggle'] == 1): ?> <!--phpmasterminds added this code for header toggle -->
<?php if ($this->_aVars['aDvs']['branding_file_name']): ?>
			<a href="<?php echo $this->_aVars['aDvs']['url']; ?>" target="_parent">
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('path' => 'core.url_file','file' => 'dvs/branding/'.$this->_aVars['aDvs']['branding_file_name'],'style' => "vertical-align:middle; max-width: 100% !important; height: auto !important;",'max_width' => 1117)); ?>
			</a>
<?php else: ?>
        <h1><a href="<?php echo $this->_aVars['aDvs']['url']; ?>" target="_parent"><?php echo $this->_aVars['aDvs']['dealer_name']; ?></a></h1>
<?php endif; ?>
<?php endif; ?> <!--phpmasterminds added this code for header toggle -->
<?php endif; ?>
<?php if ($this->_aVars['aDvs']['topmenu_toggle'] == 1): ?> <!--phpmasterminds added this code for Menu toggle -->
    <header>
      <nav>
        <ul>
          <li>
            <a href="<?php echo $this->_aVars['aDvs']['url']; ?>" onclick="menuHome('Top Menu Clicks');" target="_parent"><?php echo Phpfox::getPhrase('dvs.home'); ?></a>
          </li>
<?php if ($this->_aVars['aDvs']['inventory_url']): ?>
            <li>
              <a href="<?php echo $this->_aVars['aDvs']['inventory_url']; ?>" class="dvs_inventory_link" onclick="menuInventory('Top Menu Clicks');" rel="nofollow" target="_parent">
<?php echo Phpfox::getPhrase('dvs.show_inventory'); ?>
              </a>
            </li>
<?php endif; ?>

<?php if ($this->_aVars['aDvs']['specials_url']): ?>
            <li>
              <a href="<?php echo $this->_aVars['aDvs']['specials_url']; ?>" onclick="menuOffers('Top Menu Clicks');" rel="nofollow" target="_parent">
<?php echo Phpfox::getPhrase('dvs.special_offers'); ?>
              </a>
            </li>
<?php endif; ?>

          <li>
            <a href="#" onclick="menuContact('Top Menu Clicks'); tb_show('<?php echo Phpfox::getPhrase('dvs.contact_dealer'); ?>', $.ajaxBox('dvs.showGetPriceForm', 'height=400&amp;width=360&amp;iDvsId=<?php echo $this->_aVars['iDvsId']; ?>&amp;sRefId=' + aCurrentVideoMetaData.referenceId)); return false;"><?php echo Phpfox::getPhrase('dvs.contact_dealer'); ?></a>
          </li>
        </ul>
      </nav>
    </header>
<?php endif; ?><!--phpmasterminds added this code for Menu toggle ends -->
    <article>
      <section>
        <div class="dvs-info" style="padding-top:10px;font-size:13px;font-weight:bold;"><p>To start your video test drive, select a year, make and model or click on the play button below. Instantly view what's important to you by clicking the chapter buttons to the right.</p></div>
      </section>
      <section id="player">
        <?php
						Phpfox::getLib('template')->getBuiltFile('dvs.controller.player.player');						
						?>
      </section>

      <div id="player_right">
        <section id="select_new">
<?php if ($this->_aVars['aVideoSelectYears']): ?>
          <h3><?php echo Phpfox::getPhrase('dvs.choose_new_vehicle'); ?>:</h3>

<?php if (isset ( $this->_aVars['aVideoSelectYears']['1'] )): ?>
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
<?php endif; ?>

          <ul id="makes">
            <li class="init">
<?php echo Phpfox::getPhrase('dvs.select_make'); ?>
              <ul>
                <li>
<?php echo Phpfox::getPhrase('dvs.please_select_a_year_first'); ?>
                </li>
              </ul>
            </li>
          </ul>

          <ul id="models">
            <li class="init">
<?php echo Phpfox::getPhrase('dvs.select_model'); ?>
              <ul>
                <li>
<?php echo Phpfox::getPhrase('dvs.please_select_a_year_first'); ?>
                </li>
              </ul>
            </li>
          </ul>
<?php endif; ?>
        </section>
        <section id="dealer_links">
          <a href="<?php echo $this->_aVars['aDvs']['url']; ?>" onclick="menuHome('Call To Action Menu Clicks');" target="_parent">
<?php echo Phpfox::getPhrase('dvs.cta_home'); ?>
          </a>
<?php if ($this->_aVars['aDvs']['inventory_url']): ?>
          <a href="<?php echo $this->_aVars['aDvs']['inventory_url']; ?>" onclick="menuInventory('Call To Action Menu Clicks');" rel="nofollow" target="_parent">
<?php echo Phpfox::getPhrase('dvs.cta_inventory'); ?>
          </a>
<?php endif; ?>
<?php if ($this->_aVars['aDvs']['specials_url']): ?>
          <a href="<?php echo $this->_aVars['aDvs']['specials_url']; ?>" onclick="menuOffers('Call To Action Menu Clicks');" rel="nofollow" target="_parent">
<?php echo Phpfox::getPhrase('dvs.cta_specials'); ?>
          </a>
<?php endif; ?>
          <a href="#" onclick="tb_show('<?php echo Phpfox::getPhrase('dvs.contact_dealer'); ?>', $.ajaxBox('dvs.showGetPriceForm', 'height=400&amp;width=360&amp;iDvsId=<?php echo $this->_aVars['iDvsId']; ?>&amp;sRefId=' + aCurrentVideoMetaData.referenceId)); menuContact('Call To Action Menu Clicks'); return false;">
<?php echo Phpfox::getPhrase('dvs.cta_contact'); ?>
          </a>
<?php if (Phpfox ::isUser()): ?>
          	<br /><br />
            <p><b>Dealer-Only Links:</b></p><br />
            <a href="<?php if ($this->_aVars['bSubdomainMode']):  echo Phpfox::getLib('phpfox.url')->makeUrl($this->_aVars['aDvs']['title_url']);  else:  echo Phpfox::getLib('phpfox.url')->makeUrl('dvs.'.$this->_aVars['aDvs']['title_url']);  endif; ?>share" onclick="" rel="nofollow" target="_blank" style="font-size:14px;">
<?php echo Phpfox::getPhrase('dvs.dealer_share_links'); ?>
          	</a>
<?php if (Phpfox ::getUserId() == $this->_aVars['aDvs']['user_id'] || Phpfox ::isAdmin()): ?>
            <a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('dvs.salesteam', array('id' => $this->_aVars['aDvs']['dvs_id'])); ?>" onclick="" rel="nofollow" target="_blank"  style="font-size:14px;">
<?php echo Phpfox::getPhrase('dvs.manage_sales_team'); ?>
          	</a>
<?php endif; ?>
<?php endif; ?>
        </section>
        
        <section id="action_links">
<?php if (! Phpfox ::isUser()): ?>
			  <p>Click to Share:</p>
			  <a href="#" onclick="tb_show('<?php echo Phpfox::getPhrase('dvs.share_via_email'); ?>', $.ajaxBox('dvs.emailForm', 'height=400&amp;width=360&amp;longurl=1&amp;iDvsId=<?php echo $this->_aVars['iDvsId']; ?>&amp;sRefId=' + aCurrentVideoMetaData.referenceId)); showEmailShare(); return false;">
				<img src="<?php echo $this->_aVars['sImagePath']; ?>email-share.png" alt="Share Via Email"/>
			  </a>
			  <a href="#" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(location.href), '', 'width=626,height=436'); facebookShareClick('Share Links'); return false;">
				<img src="<?php echo $this->_aVars['sImagePath']; ?>facebook-share.png" alt="Share to Facebook"/>
			  </a>
			  <span id="twitter_button_wrapper">
				<a href="https://twitter.com/intent/tweet?text=<?php echo Phpfox::getPhrase('dvs.twitter_default_share_text', array('video_year' => $this->_aVars['aDvs']['featured_year'],'video_make' => $this->_aVars['aDvs']['featured_make'],'video_model' => $this->_aVars['aDvs']['featured_model'],'dvs_dealer_name' => $this->_aVars['aDvs']['dealer_name'])); ?>&url=<?php echo $this->_aVars['sCurrentUrlEncoded']; ?>" id="twitter_share"><img src="<?php echo $this->_aVars['sImagePath']; ?>twitter-button.png" alt="Tweet" /></a>
			  </span>
			  <a href="#" onclick="window.open('https://plus.google.com/share?url=' + encodeURIComponent(location.href)); googleShareClick('Share Links'); return false;">
				<img src="<?php echo $this->_aVars['sImagePath']; ?>google-share.png" alt="Google+" title="Google+"/>
			  </a>
<?php endif; ?>
        </section>
      </div>

      <section id="video_information">
        <h3 id="video_name">
          <a href="location.href">
<?php echo $this->_aVars['aDvs']['phrase_overrides']['override_video_name_display']; ?>
          </a>
        </h3>

        <p class="model_description" id="car_description"><?php echo $this->_aVars['aDvs']['phrase_overrides']['override_video_description_display']; ?></p>

<?php if (empty ( $this->_aVars['aOverrideVideo']['ko_id'] )): ?>
        <section>
          <h2><?php echo $this->_aVars['aDvs']['dealer_name']; ?> of <?php echo $this->_aVars['aDvs']['city']; ?>, <?php echo $this->_aVars['aDvs']['state_string']; ?></h2>
          <p itemprop="description" class="model_description"><?php echo $this->_aVars['aDvs']['text_parsed']; ?></p>
        </section>
<?php endif; ?>
      </section>

      <aside>
        <div id="dvs_geomap_container" itemprop="map"></div>
        <p><?php if ($this->_aVars['aDvs']['url']): ?>
<?php echo Phpfox::getPhrase('dvs.website'); ?>: <a href="<?php echo $this->_aVars['aDvs']['url']; ?>" rel="nofollow" target="_parent"><?php echo $this->_aVars['aDvs']['url']; ?></a>
<?php endif; ?>
<?php if ($this->_aVars['aDvs']['phone']): ?><br /><?php echo Phpfox::getPhrase('dvs.phone'); ?>: <span itemprop="telephone"><?php echo $this->_aVars['aDvs']['phone']; ?></span><?php endif; ?></p>
        <p itemscope itemtype="http://schema.org/PostalAddress">
<?php if ($this->_aVars['aDvs']['address']): ?>Address: <span itemprop="streetAddress"><?php echo $this->_aVars['aDvs']['address']; ?></span><?php endif; ?></p>
        <p><span itemprop="addressLocality"><?php echo $this->_aVars['aDvs']['city']; ?></span>, <span itemprop="addressRegion"><?php echo $this->_aVars['aDvs']['state_string']; ?></span>, <span itemprop="postalCode"><?php echo $this->_aVars['aDvs']['postal_code']; ?></span>
        </p>
      </aside>
      <div class="clear"></div>
    </article>
<?php if ($this->_aVars['aDvs']['footer_toggle'] == 1): ?> <!--phpmasterminds added this code for footer toggle -->
    <footer>
      <h3><?php echo Phpfox::getPhrase('dvs.more_videos'); ?></h3>
      <ul id="related_videos">
<?php Phpfox::getBlock('dvs.related-video', array('aDvs' => $this->_aVars['aDvs'],'aVideo' => $this->_aVars['aFirstVideo'])); ?>
      </ul>
    </footer>
<?php endif; ?> <!--phpmasterminds added this code for footer toggle -->
<?php endif;  endif;  Phpfox::getBlock('dvstour.addtour', array()); ?> <!--nplkoder add this line-->
