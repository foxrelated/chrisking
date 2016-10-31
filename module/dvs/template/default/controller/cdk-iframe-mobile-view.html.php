<?php
defined('PHPFOX') or exit('NO DICE!');
?>

<meta name="viewport" content="width=600, initial-scale=0.5, maximum-scale=1.0, user-scalable=0">
<header></header>
<article>
    {if $aPlayer.player_type != "2"}
      <section id="player">
        {template file='dvs.controller.player.player-mobile}
    </section>
    {else}
    <section id="player">
    {template file='dvs.controller.player.player-mobilehtml5}
    </section>
    {/if}

    <div id="player_right">
        <section id="dealer_links">

            {if $aDvs.inventory_url}
            <a href="{$aDvs.inventory_url}" class="dvs_inventory_link" onclick="menuInventory('Call To Action Menu Clicks');" target="_parent">
                {phrase var='dvs.cta_inventory'}
            </a>
            {/if}
            {if $aDvs.specials_url}
            <a href="{$aDvs.specials_url}" onclick="menuOffers('Call To Action Menu Clicks');" target="_parent">
                {phrase var='dvs.cta_specials'}
            </a>
            {/if}
        </section>
        <br />
        <section id="select_new">
            {if $aVideoSelectYears}
            <h3>{phrase var='dvs.choose_new_vehicle'}:</h3>
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
        {if $aDvs.iframe_contact_form}
            <aside>
                <div id="contact_box">
                    <h2>Contact {$aDvs.dealer_name}</h2>
                    {template file='dvs.block.contact-iframe}
                </div>
            </aside>
            {/if}
    </div>
    <br><br>
</article>
