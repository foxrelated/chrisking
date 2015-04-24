<?php 
defined('PHPFOX') or exit('NO DICE!'); 

?>
{literal}
    <style type="text/css">
        .table_left
        {
            width:90px;
        }
        .table_right {
            margin-left: 100px;
        }

    </style>
{/literal}
{$sCreateJs}
<form method="post" action="{url link='admincp.dvs.blacklists.add'}" id="core_js_link_form" onsubmit="{$sGetJsForm}">
{if $bIsEdit}
    <div><input type="hidden" name="id" value="{$aForms.id}" /></div>
{/if}
<div class="table_header">
        
    </div>
     <div class="table">
        <div class="table_left">
            {required}{phrase var='dvs.name'}:
        </div>
        <div class="table_right">
               <input type="text" name="val[name]" size="50" value="{value type='input' id='name'}" id="name"/>
        </div>
        <div class="clear"></div>
    </div>
    <div class="table">
        <div class="table_left">
            {required}{phrase var='dvs.domain'}:
        </div>
        <div class="table_right">
               <input type="text" name="val[domain]" size="50" value="{value type='input' id='domain'}" id="domain"/>
        </div>
        <div class="clear"></div>
    </div>
    <div class="table_clear">
        <input type="submit" class="button" value="{if $bIsEdit}{phrase var='core.update'}{else}{phrase var='core.add'}{/if}" name="submit">
    </div>
</form>
<div class="clear p_4"></div>

