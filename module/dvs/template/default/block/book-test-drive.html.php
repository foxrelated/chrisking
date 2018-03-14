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
<script xmlns="http://www.w3.org/1999/html">
    {literal}
   
    $('#contact_dealer').submit(function (event) {
        // Cancels the form submission
        event.preventDefault();

        // Validation for Input Fields of Contact Form
        var cname = $('input#name').val();
        var email = $('input#email').val();
        var phone = $('input#phone').val();
        var zip = $('input#zip').val();

        var fieldName = /^[a-zA-Z]+$/i;
        var fieldNum = /^[0-9]+$/g;
        var fieldEmail = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

        var isValidEmail = fieldEmail.test(email);
        var hasLetterForPhone = !!(/[a-zA-Z]+/g).exec(phone);  
        
        // Reset the fields by removing error indicators when the submit button is clicked.
        $('#nameLabel').removeClass('hasError');
        $('#emailLabel').removeClass('hasError');
        $('#phoneLabel').removeClass('hasError');
        $('#zipLabel').removeClass('hasError');        
        $('.hasErrorIcon').remove();
             
        if ( (!!cname && !cname.match(fieldName)) || (!!email && !isValidEmail) || (!!phone && !!hasLetterForPhone) || (!!phone && phone.length < 10) || (!!zip && !zip.match(fieldNum)) || (!!zip && zip.length < 5) ) {
            if (!cname.match(fieldName)) {
                $('#nameLabel').addClass('hasError');
                $('input#name').parent().append('<i class="fa fa-exclamation-circle hasErrorIcon"></i>');
            }             
            if (!isValidEmail) {
                $('#emailLabel').addClass('hasError');
                $('input#email').parent().append('<i class="fa fa-exclamation-circle hasErrorIcon"></i>');
            } 
            if (!!hasLetterForPhone || phone.length < 10) {
                $('#phoneLabel').addClass('hasError');
                $('input#phone').parent().append('<i class="fa fa-exclamation-circle hasErrorIcon twoColErrorIconPosition" id="phoneInputError"></i>');
                $('input#zip').parent().append('<i class="fa fa-exclamation-circle hasErrorIcon twoColErrorIconPosition emptyZipError" style="visibility:hidden;"></i>');
            } 
            
            if (!zip.match(fieldNum) || zip.length < 5) {
                $('.emptyZipError').length > 0 ? $('.emptyZipError').remove() : ''; 
                $('#zipLabel').addClass('hasError');
                $('input#zip').parent().append('<i class="fa fa-exclamation-circle hasErrorIcon twoColErrorIconPosition" id="zipInputError"></i>');
            } 
        } else if ( (!!cname  && !!cname.match(fieldName)) && (!!email && !!isValidEmail) && (!!phone && !hasLetterForPhone) && (!!phone && phone.length >= 10) && (!!zip && !!zip.match(fieldNum)) && (!!zip && zip.length == 5) ) {
            $.ajaxCall('dvs.contactDealer', $('#contact_dealer').serialize());
        }
        
    });
    
    $('#dvs_contact_success').submit(function (event) {
        event.preventDefault();
        tb_remove();
        return js_box_remove(this);
    });
    
    $('input, textarea').placeholder();
    
    {/literal}
    


</script>
{if !empty($aDvs)}
<style>
    /*-- Thickbox.js (Overwriting) --*/
    .js_box {l}
       border-radius: 0;
       -webkit-border-radius: 0;
       background: none;
       width: 300px !important;
    {r}
    
    .js_box_title {l}
        text-align: center;
        font-weight: bold;
        font-family: Verdana, Geneva, sans-serif;
        font-size: 14px;
        background: none;
        background-color: rgba(25,25,25,0.88) !important;
        padding-top: 17px;
    {r}
    
    .js_box_content {l}
        background: none;
        background-color: rgba(25,25,25,0.88) !important;
        padding: 0px 15px;
        min-height:375px;
    {r}
    /*-- End of Thickbox.js --*/
    
    .closeContainer {l}
        display: block;
        top: -40px;
        right: -8px;
        float:right; 
        color:rgb(255,255,255); 
        font-size: 20px;   
    {r}
    
    .closeContainer .close, .closeContainer .close:hover {l}
        background: none;
        border-radius: 0;
        color: gray;
        border: 0 none;
        padding-right: 0;
        padding-top: 0;
        margin-right: 0;
        margin-top: 0;
        font-weight: normal;
    {r}
    
    .closeContainer .close:hover {l} color: white; {r}
    
    .overlaySubTitle {l}
        font-family: Verdana, Geneva, sans-serif;
        color: white;
        font-size: 10px !important;
    {r}    
        
    .hasError {l} color: red; {r}
    
    .hasErrorIcon {l} 
        position: relative;
        z-index: 1;
        left: 100px;
        top: -23px;
        color: red;
        width: 0;
        font-size: 16px !important;
    {r}
    
    .twoColErrorIconPosition {l} 
        left: 45px !important;
    {r}
    
    .no-padding{l} padding: 0 !important;{r}

    .no-margin{l} margin: 0 !important;{r}
    
    .commentsTextField {l} width: 97% !important; font-size: 12px !important; {r}
    
    .inputMaxHeight {l} 
        max-height: 65px;
    {r}
    
    .submitButton {l} 
        background: none;
        background-color: #4FC26F !important;
        width: 100%;
        font-size: 13px !important;
        border-radius: 0.1rem !important;
    {r}
    
    .submitButton:hover {l}
        background-color: #308c4a !important;
    {r}
    
    /*-- Placeholder --*/
    ::-webkit-input-placeholder {l} /* Chrome/Opera/Safari */
        font-size:10px;
        padding-top: 3px;
    {r}
    
    ::-moz-placeholder {l} /* Firefox 19+ */
        font-size:12px;
        padding-top: 3px;
    {r}
    
    :-ms-input-placeholder {l} /* IE 10+ */
        font-size:12px;
        padding-top: 3px;
    {r}
      
    :-moz-placeholder {l} /* Firefox 18- */
        font-size:12px;
        padding-top: 3px;
    {r}
    /*-- End of Placeholder --*/
 
    /*-- Grid Style --*/ 
    .grid-container{l}
        width: 100%; 
        max-width: 1200px;      
    {r}

    .row:before, 
    .row:after {l}
        content:"";
        display: table ;
        clear:both;
    {r}

    [class*='col-'] {l}
        float: left; 
        min-height: 1px; 
        width: 16.66%; 
        /*-- gutter --*/
        padding: 12px; 
    {r}

    .col-1{l} width: 16.66%; {r}
    .col-2{l} width: 33.33%; {r}
    .col-2a{l} width: 36.33%; {r}
    .col-3{l} width: 50%;    {r}
    .col-4{l} width: 66.66%; {r}
    .col-5{l} width: 83.33%; {r}
    .col-6{l} width: 100%;   {r}
    /*-- End of Grid Style --*/ 
    
    /*-- form styles --*/
    input.dvs_form_button {l}
        background-color: #{$aDvs.button_background};
        background-image: -webkit-linear-gradient(top, #{$aDvs.button_top_gradient}, #{$aDvs.button_bottom_gradient});
        background-image: -moz-linear-gradient( center top, #{$aDvs.button_top_gradient} 5%, #{$aDvs.button_bottom_gradient} 100% );
        background-image: -ms-linear-gradient(bottom, #{$aDvs.button_top_gradient} 0%, #{$aDvs.button_bottom_gradient} 100%);
        background-image: linear-gradient(to bottom, #{$aDvs.button_top_gradient} 0%, #{$aDvs.button_bottom_gradient} 100%);
        background-image: -o-linear-gradient(bottom, #{$aDvs.button_top_gradient} 0%, #{$aDvs.button_bottom_gradient} 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#{$aDvs.button_top_gradient}', endColorstr='#{$aDvs.button_bottom_gradient}');
        border: 1px solid #{$aDvs.button_border};
        color: #{$aDvs.button_text};
    {r}

    input.dvs_form_button:hover {l}
        background-image: -webkit-linear-gradient(top, #{$aDvs.button_bottom_gradient}, #{$aDvs.button_top_gradient});
        background-image: -moz-linear-gradient( center top, #{$aDvs.button_bottom_gradient} 5%, #{$aDvs.button_top_gradient} 100% );
        background-image: -ms-linear-gradient(bottom, #{$aDvs.button_bottom_gradient} 0%, #{$aDvs.button_top_gradient} 100%);
        background-image: linear-gradient(to bottom, #{$aDvs.button_bottom_gradient} 0%, #{$aDvs.button_top_gradient} 100%);
        background-image: -o-linear-gradient(bottom, #{$aDvs.button_bottom_gradient} 0%, #{$aDvs.button_top_gradient} 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#{$aDvs.button_bottom_gradient}', endColorstr='#{$aDvs.button_top_gradient}');
        background-color: #{$aDvs.button_background};
        border: 1px solid #{$aDvs.button_border};
        color: #{$aDvs.button_text};
    {r}
    
    .form-group {l}
        margin-bottom: 1rem;
        margin: 0 15px;
    {r}
    
    label {l}
        display: inline-block;
        margin-top: 15px;
        margin-bottom: .2rem;
        font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";
        font-size: 12px;
        font-weight: 400;
        line-height: 1.5;
        text-align: left;
        float: left;
        color: white;
    {r}
    
    .form-control {l}
        display: block;
        width: 91%;
        padding: .375rem .75rem;
        font-size: 12px;
        line-height: 1;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: 0.1rem;
        transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    {r}
    
    .btn-primary {l}
        color: #fff;
        background-color: #4FC26F;
        border-color: #232426;
    {r}
    
    .btn {l}
        display: inline-block;
        font-weight: 400;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        border: 1px solid transparent;
        padding: .375rem .75rem;
        font-size: 1rem;
        line-height: 1.5;
        border-radius: .25rem;
        transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    {r}
    /*-- End of form styles --*/
    
    /*-- Success modal --*/
    .dvsContactSuccessText {l}  
        min-height: 52px;
        color: #DAD5D5;
        text-align: center;
        font-size: 14px;
        margin: 10px;
        margin-bottom: 35px;
        font-family: Verdana, Geneva, sans-serif;
    {r}
    
    .cotactSuccessImgContainer {l}
        display:flex; 
        justify-content:center; 
        align-items:center; 
        min-height: 75px; 
        text-align: center; 
    {r}
    
    .cotactSuccessImgContent {l} 
        margin-left: 15px; 
        margin-top: 50px; 
        margin-bottom: 20px; 
        height: 55px;
    {r}
    /*-- End of Success modal --*/
</style>
{/if}
<!--Contact Form-->
<form id="contact_dealer" name="contact_dealer" action="javascript:void(0);">
    <div class="js_box_close closeContainer" aria-label="Close">
        <a class="close" onclick="return js_box_remove(this);" aria-hidden="true">&times;</a>
        <span class="js_box_history">dvs.showGetContactFormForTestDrive</span>
    </div>
    
    <p class="overlaySubTitle"><strong>{$aVideo.year} {$aVideo.make} {$aVideo.model}</strong></p>
    
    <div class="form-group inputMaxHeight">
        <label for="name"  id="nameLabel">Name</label>
        <input type="text" name="val[contact_name]" id="name" placeholder="Enter your name" {if Phpfox::getParam('dvs.get_price_validate_name')} required {/if} class="form-control"></input>
    </div>

    <div class="form-group inputMaxHeight">
        <label for="email" id="emailLabel">E-mail</label>
        <input type="email" name="val[contact_email]" id="email" placeholder="mymail@" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$" {if Phpfox::getParam('dvs.get_price_validate_email')} required {/if} class="form-control" />
    </div>

    <div class="form-group grid-container no-margin">
        <div class="form-group col-2a no-padding inputMaxHeight" >
            <label for="phone" id="phoneLabel">Phone number</label>
            <input type="text" name="val[contact_phone]" id="phone" placeholder="Phone number" maxlength="12" {if Phpfox::getParam('dvs.get_price_validate_phone')} required {/if} class="form-control" />
        </div>

        <div class="form-group col-2a no-padding inputMaxHeight" >
            <label for="zip" id="zipLabel">Zip code</label>
            <input type="text" name="val[contact_zip]" id="zip" placeholder="{phrase var='dvs.get_price_placeholder_zip'}" maxlength="5" {if Phpfox::getParam('dvs.get_price_validate_zip_code')} required {/if} class="form-control" />
        </div>
    </div>

    <div class="form-group">
        <label for="comments">Comment</label>
        <textarea id="comments" class="commentsTextField" name="val[contact_comments]" cols="16" rows="3" placeholder="   {phrase var='dvs.get_price_placeholder_comments'}" {if Phpfox::getParam('dvs.get_price_validate_comments')} required {/if} class="form-control"></textarea>
    </div>

    <input type="hidden" name="val[contact_video_ref_id]" id="video_ref_id" value="{$aVideo.referenceId}"/>
    
    {if !empty($aDvs)}
        <input type="hidden" name="val[contact_dvs_id]" id="dvs_id" value="{$aDvs.dvs_id}"/>
    {/if}
       
    <div class="form-group">
        <input class="btn btn-primary submitButton" type="submit" value="Book your test drive"/>
    </div>

</form>

<!--Success Modal-->
<form id="dvs_contact_success" style="display:none;">
    <div class="js_box_close closeContainer" aria-label="Close" style="top:4px;">
        <a class="close" onclick="return js_box_remove(this);" aria-hidden="true">&times;</a>
    </div>
    
    <div class="cotactSuccessImgContainer">
        <img class="cotactSuccessImgContent" src="/module/dvs/static/image/icon-complete-checkbox.png"/>
    </div>
    
    <div class="dvsContactSuccessText">
        <p>Got it, a friendly member of the dealership will get in touch shortly to confirm your test drive.</p>
    </div>
    
    <div class="form-group">
        <input class="btn btn-primary submitButton" id="dvsContactSuccessBtn" type="submit" value="Back to Virtual Test Drive"/>
    </div>      
</form>
