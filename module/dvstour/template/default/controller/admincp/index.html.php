<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond_Benc
 * @package 		Phpfox
 * @version 		$Id: index.html.php 3332 2011-10-20 12:50:29Z Raymond_Benc $
 */
 
defined('PHPFOX') or exit('NO DICE!'); 

?>
<style type="text/css">#main_body_holder{l}display: none;{r}</style>

{if !$bStep}
<div class="table_header">{phrase var='dvstour.manate_tours'}</div>
<table id="js_drag_drop" cellpadding="0" cellspacing="0">
    <tr>
        <th></th>
        <th style="width:20px;"></th>
        <th>{phrase var='dvstour.title'}</th>
        <th>User Group</th>
        <th>{phrase var='dvstour.link'}</th>
        <th class="t_center" style="width:60px;">{phrase var='dvstour.autorun'}</th>    
        <th class="t_center" style="width:60px;">{phrase var='dvstour.active'}</th>    
    </tr>
    {foreach from=$aTours key=iKey item=aTour}
    <tr class="checkRow{if is_int($iKey/2)} tr{else}{/if}">
        <td><input type="hidden" name="val[ordering][]" value="" /></td>
        <td class="t_center">
            <a href="#" class="js_drop_down_link" title="Manage">{img theme='misc/bullet_arrow_down.png' alt=''}</a>
            <div class="link_menu">
                <ul>
                    <li><a href="{url link='admincp.dvstour.add' id=$aTour.sitetour_id}">{phrase var='dvstour.edit'}</a></li>
                    <li><a href="{url link='admincp.dvstour.addstep' id=$aTour.sitetour_id}">{phrase var='dvstour.add_new_step'}</a></li>
                    {if count($aTour.total_step)}
                    <li><a href="{url link='admincp.dvstour' tour={$aTour.sitetour_id}">{phrase var='dvstour.manage_step' total=$aTour.total_step}</a></li>        
                    {/if}
                    <li><a href="{url link='admincp.dvstour' delete=$aTour.sitetour_id}" onclick="return confirm('{phrase var='dvstour.are_you_sure'}');">{phrase var='dvstour.delete'}</a></li>        
                </ul>
            </div>        
        </td>    
        <td>{$aTour.title|convert}</td>
        <td>{if $aTour.user_group_id}{$aTour.group_title}{else}Anybody{/if}</td>
        <td><a target="_new" href="{$aTour.url}">{$aTour.url}</a></td>
        
        <!--- Autorun ---->
        <td class="t_center">
            <div class="js_item_is_active"{if !$aTour.is_autorun} style="display:none;"{/if}>
                <a href="#?call=dvstour.updateAutoRun&amp;id={$aTour.sitetour_id}&amp;active=0" class="js_item_active_link" title="{phrase var='dvstour.deactivate'}">{img theme='misc/bullet_green.png' alt=''}</a>
            </div>
            <div class="js_item_is_not_active"{if $aTour.is_autorun} style="display:none;"{/if}>
                <a href="#?call=dvstour.updateAutoRun&amp;id={$aTour.sitetour_id}&amp;active=1" class="js_item_active_link" title="{phrase var='dvstour.active'}">{img theme='misc/bullet_red.png' alt=''}</a>
            </div>        
        </td>    
         
        <!-- Active --->
        <td class="t_center">
            <div class="js_item_is_active"{if !$aTour.is_active} style="display:none;"{/if}>
                <a href="#?call=dvstour.updateActivity&amp;id={$aTour.sitetour_id}&amp;active=0&amp;step=0" class="js_item_active_link" title="{phrase var='dvstour.deactivate'}">{img theme='misc/bullet_green.png' alt=''}</a>
            </div>
            <div class="js_item_is_not_active"{if $aTour.is_active} style="display:none;"{/if}>
                <a href="#?call=dvstour.updateActivity&amp;id={$aTour.sitetour_id}&amp;active=1&amp;step=0" class="js_item_active_link" title="{phrase var='dvstour.active'}">{img theme='misc/bullet_red.png' alt=''}</a>
            </div>        
        </td>        
    </tr>
    {/foreach}
</table>
{else}
<div class="table_header">{phrase var='dvstour.manage_steps_for_tour'}</div>
<table id="js_drag_drop" cellpadding="0" cellspacing="0">
    <tr>
        <th></th>
        <th style="width:20px;"></th>
        <th>{phrase var='dvstour.title'}</th>
        <th>Content</th>
        <th class="t_center" style="width:60px;">{phrase var='dvstour.active'}</th>    
    </tr>
    {foreach from=$aSteps key=iKey item=aStep}
    <tr class="checkRow{if is_int($iKey/2)} tr{else}{/if}">
        <td class="drag_handle"><input type="hidden" name="val[ordering][{$aStep.step_id}]" value="{$aStep.ordering}" /></td>
        <td class="t_center">
            <a href="#" class="js_drop_down_link" title="Manage">{img theme='misc/bullet_arrow_down.png' alt=''}</a>
            <div class="link_menu">
                <ul>
                    <li><a href="{url link='admincp.dvstour.add' step=$aStep.step_id}">{phrase var='dvstour.edit'}</a></li>        
                    <li><a href="{url link='admincp.dvstour' tour=$aStep.step_id delete=$aStep.step_id}" onclick="return confirm('{phrase var='dvstour.are_you_sure'}');">{phrase var='dvstour.delete'}</a></li>        
                </ul>
            </div>        
        </td>    
        <td>{$aStep.title|convert}</td>
        <td>{$aStep.content}</td>
        <td class="t_center">
            <div class="js_item_is_active"{if !$aStep.is_active} style="display:none;"{/if}>
                <a href="#?call=dvstour.updateActivity&amp;id={$aStep.step_id}&amp;active=0&amp;step=1" class="js_item_active_link" title="{phrase var='dvstour.deactivate'}">{img theme='misc/bullet_green.png' alt=''}</a>
            </div>
            <div class="js_item_is_not_active"{if $aStep.is_active} style="display:none;"{/if}>
                <a href="#?call=dvstour.updateActivity&amp;id={$aStep.step_id}&amp;active=1&amp;step=1" class="js_item_active_link" title="{phrase var='dvstour.active'}">{img theme='misc/bullet_red.png' alt=''}</a>
            </div>        
        </td>        
    </tr>
    {/foreach}
</table>
<div style="text-align: right;padding-top:10px;">
    <a style="text-decoration: none;" class="button" href="{url link='admincp.dvstour.addstep' id=$aStep.sitetour_id}">{phrase var='dvstour.add_new_step'}</a>
</div>
{/if}