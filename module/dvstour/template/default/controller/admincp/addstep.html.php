<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright        [PHPFOX_COPYRIGHT]
 * @author          Raymond_Benc
 * @package         Phpfox
 * @version         $Id: add.html.php 5387 2013-02-19 12:19:37Z Miguel_Espinoza $
 */
 
defined('PHPFOX') or exit('NO DICE!'); 

?>

{literal}
<style type="text/css">
#main_body_holder{
    display: none;
}
</style>
{/literal}
<div class="table_header">{phrase var='dvstour.add_a_new_step_for_tour_in_site'} {$aTour.title}</div>

<form method="post" action="">
    
    <div class="table">
        <div class="table_left">{phrase var='dvstour.url'}:</div>
        <div class="table_right">
            <a href="{$aTour.url}">{$aTour.url}</a>
        </div>
        <div class="clear"></div>        
    </div>
    
    <div class="table">
        <div class="table_left">{phrase var='dvstour.element'}:</div>
        <div class="table_right">
            <input type="text" name="val[element]" value="{value id='title' type='input'}" size="30" />
        </div>
        <div class="clear"></div>        
    </div>
    
    <div class="table">
        <div class="table_left">
            {phrase var='dvstour.title'}:
        </div>
        <div class="table_right">
            <input type="text" name="val[title]" value="{value id='title' type='input'}" size="30" />
        </div>
        <div class="clear"></div>        
    </div>
    
    <div class="table">
        <div class="table_left">
            Content:
        </div>
        <div class="table_right">
            <textarea name="val[content]" style="width: 200px;"></textarea>
        </div>
        <div class="clear"></div>        
    </div>
    
    <div class="table">
        <div class="table_left">{phrase var='dvstour.auto_transition'}</div>
        <div class="table_right">
            <input type="checkbox" name="val[is_auto]" value="1">
        </div>
        <div class="clear"></div>        
    </div>
    
    <div class="table">
        <div class="table_left">{phrase var='dvstour.time_duration'}:</div>
        <div class="table_right">
            <input type="text" name="val[duration]" value="{value id='title' type='input'}" size="30" />
        </div>
        <div class="clear"></div>        
    </div>
    
    <div class="table_clear">
        <input name="addmore" type="submit" value="Add More" class="button" />
        <input name="submit" type="submit" value="Finished" class="button" />
    </div>
</form>