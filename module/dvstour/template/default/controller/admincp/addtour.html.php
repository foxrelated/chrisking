<?php
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright        [PHPFOX_COPYRIGHT]
 * @author          Raymond Benc
 * @package         Phpfox
 * @version         $Id: add.html.php 1121 2009-10-01 12:59:13Z Raymond_Benc $
 */
defined('PHPFOX') or exit('NO DICE!');
?>
<div class="main_beark">
    <div class="table_header">
        {phrase var='dvstour.add_new_tour_backend'}
    </div>
    {$sCreateJs}
    <form method="post" action="{url link='admincp.dvstour.addtour'}" id="core_js_tour_form" onsubmit="{$sGetJsForm}" enctype="multipart/form-data">
        <div class="table">
            <div class="table_left">
                <label for="name">{required}{phrase var='dvstour.tour_name'}:</label>
            </div>
            <div class="table_right">
                <input type="text" name="val[name]" value="{value type='input' id='name'}" id="name" />
            </div>			
        </div>
        <div class="table">
            <div class="table_left">
                <label for="name">{required}{phrase var='dvstour.site_tour_link'}:</label>
            </div>
            <div class="table_right">
                <input type="text" name="val[url]" value="{value type='input' id='url'}" id="url" />
            </div>			
        </div>
        <div class="table">
            <div class="table_left">
                <label for="text">{required}{phrase var='dvstour.visiable_with_user_group'}:</label>
            </div>
            <div class="table_right">
                <select name="val[user_group]">
                    <option value="0">Anybody</option>
                    {foreach from=$aUserGroup item=aGroup}
                    <option value="{$aGroup.user_group_id}">{$aGroup.title}</option>
                    {/foreach}
                </select>
            </div>			
        </div>
        <div class="table">
            <div class="table_left">
                <label for="text">{required}{phrase var='dvstour.is_auto_run'}:</label>
            </div>
            <div class="table_right">
                <label><input value="1" checked="yes" type="radio" name="val[is_auto]" id="is_auto" class="checkbox" {value type='checkbox' id='is_auto' default='1'}/> {phrase var='core.yes'}</label>
                 <label><input value="0" type="radio" name="val[is_auto]" id="is_auto" class="checkbox" {value type='checkbox' id='is_auto' default='0'}/> {phrase var='core.no'}</label>
            </div>
        </div>
        <div class='table'>
            <input type="submit" name="val[submit]" value="{phrase var='dvstour.add'}" class="button" />
        </div>
    </form>
</div>