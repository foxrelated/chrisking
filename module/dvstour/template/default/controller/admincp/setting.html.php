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
<style type="text/css">#main_body_holder{l}display: none;{r}</style>
{literal}
<style type="text/css">
input.toggle {
    max-height: 0;
    max-width: 0;
    opacity: 0;
    position:absolute;
}
input.toggle + label {
    display: inline-block;
    position: relative;
    box-shadow: inset 0 0 0px 1px #d5d5d5; 
    text-indent: -5000px;
    height: 20px;
    width: 50px;
    border-radius: 15px;
}
input.toggle + label:before {
    content: "";
    position: absolute;
    display: block;
    height: 20px;
    width: 20px;
    top: 0;
    left: 30;
    border-radius: 15px;
    background: rgba(19,191,17,0);
    -moz-transition: .25s ease-in-out;
    -webkit-transition: .25s ease-in-out;
    transition: .25s ease-in-out;
}
input.toggle + label:after {
    content: "";
    position: absolute;
    display: block;
    height: 20px;
    width: 20px;
    top: 0;
    left: 30px;
    border-radius: 15px;
    background: -webkit-linear-gradient(left, #E28A31 , #B8603B); 
    background: -o-linear-gradient(right, #E28A31, #B8603B); 
    background: -moz-linear-gradient(right, #E28A31, #B8603B); 
    background: linear-gradient(to right, #E28A31 , #B8603B); 
    box-shadow: inset 0 0 0 1px rgba(0,0,0,.2), 0 2px 4px rgba(0,0,0,.2);
    -moz-transition: .25s ease-in-out;
    -webkit-transition: .25s ease-in-out;
    transition: .25s ease-in-out;
}
input.toggle:checked + label:before {
    width: 50px;  
}
input.toggle:checked + label:after {
    left: 0px;
    background: -webkit-linear-gradient(left, #B2CA4B , #97AE55);
    background: -o-linear-gradient(right, #B2CA4B, #97AE55);
    background: -moz-linear-gradient(right, #B2CA4B, #97AE55); 
    background: linear-gradient(to right, #B2CA4B , #97AE55);
}
input#tour_mode + label:after {
    background: -webkit-linear-gradient(left, #B2CA4B , #97AE55) !important;
    background: -o-linear-gradient(right, #B2CA4B, #97AE55) !important;
    background: -moz-linear-gradient(right, #B2CA4B, #97AE55) !important; 
    background: linear-gradient(to right, #B2CA4B , #97AE55) !important;
}
</style>
<script type="text/javascript">
    $Behavior.manageSetting = function(){
        $('.toggle').change(function(e){
            $(this).prev().val(1-$(this).prev().val());
        });
        $('#default_setting').change(function(e){
           if($(this).prop('checked')){
               $('.option_default').show();
           } 
           else{
               $('.option_default').hide();
               $('#tour_mode').attr('checked',false);
               $('#tb_tour_mode').val(0);
               $('#duration').val(5000);
               $('#show_backdrop option:eq(0)').prop('selected', true);
               $('#custom_theme option:eq(0)').prop('selected', true);
               $('#show_number_step option:eq(0)').prop('selected', true);
               $('#show_tour_first_time option:eq(0)').prop('selected', true);
           }
        });
    }
</script>
{/literal}

<div class="table_header">Setting For DVSTour</div>

<form action="" method="POST" enctype="multipart/form-data">
    <!--- Default Setting ----->
    <div class="table_header2">
        <div class="go_left" style="float: none;">  
            <a style="color:#333333" name="#show_backdrop">Default Setting</a>
        </div>
    </div>

    <div class="table3">
        <div class="row_left">If this setting is true, DVSTour will reset default setting.</div>
        <div style="margin-bottom:20px;" class="row_right">
            <input type="hidden" name="val[default_setting]" value="{$aSetting.default_setting}">
            <input type="checkbox" id="default_setting" {if !$aSetting.default_setting}checked="checked"{/if} class="toggle cb_input">
            <label for="default_setting"></label>
        </div>
        <div class="clear"></div>
    </div>
    
    <div class="option_default" {if $aSetting.default_setting}style="display:none;"{/if}>
        <!--- Tour Mode ----->
        <div class="table_header2">
            <div class="go_left" style="float: none;">  
                <a style="color:#333333" name="#show_backdrop">{phrase var='dvstour.tour_mode'}</a>
            </div>
        </div>

        <div class="table3">
            <div class="row_left">{phrase var='dvstour.auto_play_or_manual'}</div>
            <div style="margin-bottom:20px;" class="row_right">
                <label style="position:relative;top:-5px;margin-right:10px;">{phrase var='dvstour.manual'}</label>
                <input type="hidden" id="tb_tour_mode" name="val[tour_mode]" value="{$aSetting.tour_mode}">
                <input type="checkbox" {if $aSetting.tour_mode}checked="checked"{/if} id="tour_mode" class="toggle">
                <label for="tour_mode"></label>
                <label style="position:relative;top:-5px;margin-left:10px;">{phrase var='dvstour.automotive'}</label>
            </div>
            <div class="clear"></div>
        </div>
        
        <!--- Default Time -------->
        <div class="table_header2">
            <div class="go_left" style="float: none;">  
                <a style="color:#333333" name="#show_backdrop">{phrase var='dvstour.default_time'}</a>
            </div>
        </div>

        <div class="table3">
            <div class="row_left">{phrase var='dvstour.default_time_for_each_step'}</div>
            <div style="margin-bottom:20px;" class="row_right">
                <input type="text" id="duration" name="val[duration]" value="{$aSetting.duration}">
            </div>
            <div class="clear"></div>
        </div>
        
        <!-- Show Backdrop ---->
        <div class="table_header2">
            <div class="go_left" style="float: none;">  
                <a style="color:#333333" name="#show_backdrop">{phrase var='dvstour.show_backdrop'}</a>
            </div>
        </div>

        <div class="table3">
            <div class="row_left">{phrase var='dvstour.if_this_setting_is_true_when_tour_play_it_s_hightlight_current_step'}</div>
            <div style="margin-bottom:20px;" class="row_right">
                <select id="show_backdrop" name="val[show_backdrop]">
                    <option {if !$aSetting.show_backdrop}selected="selected"{/if} value="0">{phrase var='dvstour.false'}</option>
                    <option {if $aSetting.show_backdrop}selected="selected"{/if} value="1">{phrase var='dvstour.true'}</option>
                </select>
            </div>
            <div class="clear"></div>
        </div>

        <!--- Custom theme ------>
        <div class="table_header2">
            <div class="go_left" style="float: none;">  
                <a style="color:#333333" name="#show_backdrop">{phrase var='dvstour.custom_theme'}</a>
            </div>
        </div>

        <div class="table3">
            <div class="row_left">{phrase var='dvstour.if_this_setting_is_true_dvstour_will_use_custom_theme_default_it_uses_theme_of_bootstrap_theme'}</div>
            <div style="margin-bottom:20px;" class="row_right">
                <select id="custom_theme" name="val[custom_theme]">
                    <option {if !$aSetting.custom_theme}selected="selected"{/if} value="0">{phrase var='dvstour.false'}</option>
                    <option {if $aSetting.custom_theme}selected="selected"{/if} value="1">{phrase var='dvstour.true'}</option>
                </select>
            </div>
            <div class="clear"></div>
        </div>

        <!--- Show Step Number --->
        <div class="table_header2">
            <div class="go_left" style="float: none;">  
                <a style="color:#333333" name="#show_backdrop">{phrase var='dvstour.show_step_number'}</a>
            </div>
        </div>

        <div class="table3">
            <div class="row_left">{phrase var='dvstour.if_this_setting_is_true_when_dvstour_play_it_will_show_number_step_and_hightlight_it'}</div>
            <div style="margin-bottom:20px;" class="row_right">
                <select id="show_number_step" name="val[show_number_step]">
                    <option {if !$aSetting.show_number_step}selected="selected"{/if} value="0">{phrase var='dvstour.false'}</option>
                    <option {if $aSetting.show_number_step}selected="selected"{/if} value="1">{phrase var='dvstour.true'}</option>
                </select>
            </div>
            <div class="clear"></div>
        </div>
        
        <!--- Show Tour first Time --->
        <div class="table_header2">
            <div class="go_left" style="float: none;">  
                <a style="color:#333333" name="#show_backdrop">{phrase var='dvstour.show_tour_first_time'}</a>
            </div>
        </div>

        <div class="table3">
            <div class="row_left">{phrase var='dvstour.if_this_setting_is_true_dvstour_only_show_first_time_when_user_visit_site'}</div>
            <div style="margin-bottom:20px;" class="row_right">
                <select id="show_tour_first_time" name="val[show_tour_first_time]">
                    <option {if !$aSetting.show_tour_first_time}selected="selected"{/if} value="0">{phrase var='dvstour.false'}</option>
                    <option {if $aSetting.show_tour_first_time}selected="selected"{/if} value="1">{phrase var='dvstour.true'}</option>
                </select>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <div class="table_clear table_hover_action">
        <input type="submit" class="button" value="Submit">
    </div>
</form>

