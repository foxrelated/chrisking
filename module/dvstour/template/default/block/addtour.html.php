<?php
    defined('PHPFOX') or exit('NO DICE!');
?>

{if $aSetting.custom_theme}
<link rel='stylesheet' type='text/css' href='{param var='core.path'}module/dvstour/static/css/default/default/custom_style.css' />
{/if}

<script type="text/javascript">
    $Behavior.loadBlockTour = function(){l}
        $('.block_add_newtour').appendTo('body');
        $('.block_begin_tour').appendTo('body');
        $Core.tourSetting = {php}echo json_encode($this->_aVars['aSetting']);{/php};
    {r}
</script>


{if $bCanAdd}
<div class="block_add_newtour" {if isset($aAddTourPosition)}style="left:{$aAddTourPosition.left}px;top:{$aAddTourPosition.top}px;"{/if}>
    <ul class="new_tour_menu">
        <li class="bt_add_new_tour">{phrase var='dvstour.add_new_step'}</li>
        <li class="bt_stop_setup_tour">{phrase var='dvstour.cancel_setup_step'}</li>
        <li class="bt_preview_tour">{phrase var='dvstour.preview_tour'}</li>
        <li class="bt_save_tour">{phrase var='dvstour.save_tour'}</li>
        <li class="bt_reset_tour">{phrase var='dvstour.reset_tour'}</li>
    </ul>
</div>
{/if}
{if isset($aTour) && $bCanPlayTour}
    <script type="text/javascript">
        $Behavior.initTour = function(){l}
            if( typeof $Core.initted === 'undefined'){l}
                $Core.initted = true;
                $Core.myDomOutline = null;
                
                $Core.TourInfo = {php}echo json_encode($this->_aVars['aTour']);{/php};
                $Core.Steps = {php}echo json_encode($this->_aVars['aSteps']);{/php};
                {if $aTour.is_autorun}$Core.startTour();{/if}
            {r}
        {r}
    </script>

    {if !$aTour.is_autorun}
    <div class="block_begin_tour" {if isset($aPlayTourPosition)}style="left:{$aPlayTourPosition.left}px;top:{$aPlayTourPosition.top}px;"{/if}>
        <div class="block_begin_panel">
            <div class="bt_star_tour"></div>
            <div class="bt_end_tour"></div>
        </div>
    </div>
    {/if}
{/if}