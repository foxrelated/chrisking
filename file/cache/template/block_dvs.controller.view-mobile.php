<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 21, 2014, 8:13 pm */ ?>
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
<meta name="viewport" content="width=600, initial-scale=0.5, maximum-scale=1.0, user-scalable=0">
<header>
<?php if ($this->_aVars['aDvs']['branding_file_name']): ?>
	<a href="<?php if ($this->_aVars['bSubdomainMode']):  echo Phpfox::getLib('phpfox.url')->makeUrl($this->_aVars['aDvs']['title_url']);  else:  echo Phpfox::getLib('phpfox.url')->makeUrl('dvs.'.$this->_aVars['aDvs']['title_url']);  endif; ?>"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('path' => 'core.url_file','file' => 'dvs/branding/'.$this->_aVars['aDvs']['branding_file_name'],'style' => "vertical-align:middle")); ?></a>
<?php else: ?>
	<h1><?php echo $this->_aVars['aDvs']['dealer_name']; ?></h1>
<?php endif; ?>
</header>
<article>
	<section id="player">
		<?php
						Phpfox::getLib('template')->getBuiltFile('dvs.controller.player.player-mobile');						
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
			
<?php if ($this->_aVars['aDvs']['inventory_url']): ?>
			<a href="<?php echo $this->_aVars['aDvs']['inventory_url']; ?>" onclick="menuInventory('Call To Action Menu Clicks');" rel="nofollow">
<?php echo Phpfox::getPhrase('dvs.cta_inventory'); ?>
			</a>
<?php endif; ?>
<?php if ($this->_aVars['aDvs']['specials_url']): ?>
			<a href="<?php echo $this->_aVars['aDvs']['specials_url']; ?>" onclick="menuOffers('Call To Action Menu Clicks');" rel="nofollow">
<?php echo Phpfox::getPhrase('dvs.cta_specials'); ?>
			</a>
<?php endif; ?>
			<a href="#" onclick="tb_show('<?php echo Phpfox::getPhrase('dvs.contact_dealer'); ?>', $.ajaxBox('dvs.showGetPriceForm', 'height=600&amp;width=520&amp;iDvsId=<?php echo $this->_aVars['iDvsId']; ?>&amp;sRefId=' + aCurrentVideoMetaData.referenceId)); menuContact('Call To Action Menu Clicks'); return false;">
<?php echo Phpfox::getPhrase('dvs.cta_contact'); ?>
			</a>
		</section>
	</div>

	<section id="video_information">
		
<?php if (empty ( $this->_aVars['aOverrideVideo']['ko_id'] )): ?>
		<section>
			<h2><?php echo $this->_aVars['aDvs']['dealer_name']; ?> of <?php echo $this->_aVars['aDvs']['city']; ?>, <?php echo $this->_aVars['aDvs']['state_string']; ?></h2>
			<p itemprop="description" class="model_description"><?php echo $this->_aVars['aDvs']['text_parsed']; ?></p>
		</section>
<?php endif; ?>
	</section>

	<aside>
		<p><strong><?php echo $this->_aVars['aDvs']['dealer_name']; ?> Information</strong><br>
<?php if ($this->_aVars['aDvs']['url']): ?>
<?php echo Phpfox::getPhrase('dvs.website'); ?>: <a href="<?php echo $this->_aVars['aDvs']['url']; ?>" rel="nofollow"><?php echo $this->_aVars['aDvs']['url']; ?></a>
<?php endif; ?>
<?php if ($this->_aVars['aDvs']['phone']): ?><br /><?php echo Phpfox::getPhrase('dvs.phone'); ?>: <span itemprop="telephone"><?php echo $this->_aVars['aDvs']['phone']; ?></span><?php endif; ?></p>
		<p itemscope itemtype="http://schema.org/PostalAddress">
<?php if ($this->_aVars['aDvs']['address']): ?>Address: <span itemprop="streetAddress"><?php echo $this->_aVars['aDvs']['address']; ?></span><?php endif; ?></p>
		<p><span itemprop="addressLocality"><?php echo $this->_aVars['aDvs']['city']; ?></span>, <span itemprop="addressRegion"><?php echo $this->_aVars['aDvs']['state_string']; ?></span>, <span itemprop="postalCode"><?php echo $this->_aVars['aDvs']['postal_code']; ?></span>
		</p>
	</aside>
	
	
</article>
