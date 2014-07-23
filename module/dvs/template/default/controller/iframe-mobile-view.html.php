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
        {template file='dvs.controller.player.player-mobile}
    </section>

    <div id="player_right">
        <section id="select_new">
            {if $aVideoSelectYears}
            <h3>{phrase var='dvs.choose_new_vehicle'}:</h3>

            {if isset($aVideoSelectYears.1)}
            <ul id="year">
                <li class="init"><span class="init_selected">Select Year</span>
                    <ul>
                        {foreach from=$aVideoSelectYears item=iYear}
                        <li onclick="$.ajaxCall('dvs.getMakes', 'iYear={$iYear}&amp;sDvsName={$aDvs.title_url}');">
                            {$iYear}
                        </li>
                        {/foreach}
                    </ul>
                </li>
            </ul>
            {/if}

            <ul id="makes">
                <li class="init">
                    {phrase var='dvs.select_make'}
                    <ul>
                        <li>
                            {phrase var='dvs.please_select_a_year_first'}
                        </li>
                    </ul>
                </li>
            </ul>

            <ul id="models">
                <li class="init">
                    {phrase var='dvs.select_model'}
                    <ul>
                        <li>
                            {phrase var='dvs.please_select_a_year_first'}
                        </li>
                    </ul>
                </li>
            </ul>
            {/if}
        </section>
        <section id="dealer_links">

            {if $aDvs.inventory_url}
            <a href="{$aDvs.inventory_url}" onclick="menuInventory('Call To Action Menu Clicks');" rel="nofollow">
                {phrase var='dvs.cta_inventory'}
            </a>
            {/if}
            {if $aDvs.specials_url}
            <a href="{$aDvs.specials_url}" onclick="menuOffers('Call To Action Menu Clicks');" rel="nofollow">
                {phrase var='dvs.cta_specials'}
            </a>
            {/if}
            <aside>
                <div id="contact_box">
                    <h2>Contact {$aDvs.dealer_name}</h2>
                    {template file='dvs.block.contact-iframe}
                </div>
            </aside>
        </section>
    </div>
    <br><br>
</article>