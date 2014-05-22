// general code for addtestuser //

$(document).ready(function(){
    $("#package").change(function(){
 
        if ($(this).val() > "0" ) {
 
            $("#user_group_div").slideUp("fast"); //Slide Down Effect
 
        } else {
 
            $("#user_group_div").slideDown("fast");    //Slide Up Effect
 
        }
    });
});
