<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond_Benc
 * @package 		Phpfox
 * @version 		$Id: add.html.php 5387 2013-02-19 12:19:37Z Miguel_Espinoza $
 */
 
defined('PHPFOX') or exit('NO DICE!'); 

?>
<style type="text/css">#main_body_holder{l}display: none;{r}</style>
{if isset($aForms.step_id)}
    <div class="table_header">Step Detail</div>
{else}
<div class="table_header">{phrase var='dvstour.sitetour_detail'}</div>
{/if}

{if $bIsEdit}
<form method="post" action="{url link='admincp.dvstour.add'}">
    <div><input type="hidden" name="tour" value="{$aForms.sitetour_id}" /></div>
    {if isset($aForms.step_id)}
    <div><input type="hidden" name="step" value="{$iEditId}" /></div>
    {else}
    <div><input type="hidden" name="id" value="{$iEditId}" /></div>
    {/if}
    
    <div class="table">
        <div class="table_left">
            {phrase var='dvstour.title'}:
        </div>
        <div class="table_right">
           <input type="text" name="val[title]" value="{value id='title' type='input'}" size="30" />
        </div>
        <div class="clear"></div>        
    </div>
    {if isset($aForms.step_id)}
    <!--- Step option ---->
    <div class="table">
        <div class="table_left">
            {phrase var='dvstour.content'}:
        </div>
        <div class="table_right">
           <textarea style="width: 400px;" name="val[content]" >{$aForms.content}</textarea>
        </div>
        <div class="clear"></div>        
    </div>
    <!---- Element ----->
    <div class="table">
        <div class="table_left">{phrase var='dvstour.element'}</div>
        <div class="table_right">
           <textarea style="width: 400px;" name="val[element]" >{$aForms.element}</textarea>
        </div>
        <div class="clear"></div>        
    </div>
    
    <!---- Active ----->
    <div class="table">
        <div class="table_left">{phrase var='dvstour.active'}</div>
        <div class="table_right">
            <select name="val[is_active]">
                <option value="1" {if $aForms.is_active}selected="selected"{/if}>{phrase var='dvstour.true'}</option>
                <option value="0" {if !$aForms.is_active}selected="selected"{/if}>{phrase var='dvstour.false'}</option>
            </select>
        </div>
        <div class="clear"></div>        
    </div>
    
    <div class="table">
        <div class="table_left">Duration(milliseconds)</div>
        <div class="table_right">
            <input type="text" name="val[duration]" value="{$aForms.duration}">
            <em><br><br>{phrase var='dvstour.set_a_expiration_time_for_the_steps_when_the_step_expires_the_next_step_is_automatically_shown_se'}</em>
        </div>
        <div class="clear"></div>        
    </div>
    
    {else}
    <!--- Tour setting --->
    <div class="table">
        <div class="table_left">{phrase var='dvstour.user_group'}</div>
        <div class="table_right">
            <select name="val[user_group_id]">
                <option value="0">{phrase var='dvstour.anybody'}</option>
                {foreach from=$aUserGroup item=aGroup}
                <option value="{$aGroup.user_group_id}" {if $aForms.user_group_id==$aGroup.user_group_id}selected="selected"{/if}>{$aGroup.title}</option>
                {/foreach}
            </select>
        </div>
        <div class="clear"></div>        
    </div>
    
    <!--- Active --->
    <div class="table">
        <div class="table_left">{phrase var='dvstour.autorun'}</div>
        <div class="table_right">
            <select name="val[is_autorun]">
                <option value="1" {if $aForms.is_autorun}selected="selected"{/if}>{phrase var='dvstour.true'}</option>
                <option value="0" {if !$aForms.is_autorun}selected="selected"{/if}>{phrase var='dvstour.false'}</option>
            </select>
        </div>
        <div class="clear"></div>        
    </div>
    
    <div class="table">
        <div class="table_left">{phrase var='dvstour.active'}</div>
        <div class="table_right">
            <select name="val[is_active]">
                <option value="1" {if $aForms.is_active}selected="selected"{/if}>{phrase var='dvstour.true'}</option>
                <option value="0" {if !$aForms.is_active}selected="selected"{/if}>{phrase var='dvstour.false'}</option>
            </select>
        </div>
        <div class="clear"></div>        
    </div>
    {/if}
    
    <div class="table_clear">
        <input type="submit" value="{phrase var='dvstour.submit'}" class="button" />
    </div>
</form>
{/if}