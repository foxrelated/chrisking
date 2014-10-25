<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 22, 2014, 12:22 am */ ?>
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
<header></header>
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
            <aside>
                <div id="contact_box">
                    <h2>Contact <?php echo $this->_aVars['aDvs']['dealer_name']; ?></h2>
                    <?php
						Phpfox::getLib('template')->getBuiltFile('dvs.block.contact-iframe');						
						?>
                </div>
            </aside>
        </section>
    </div>
    <br><br>
</article>
