function newPlayerType(iType) {

	if (iType == 1) {

		$('.tr_interactive').hide('', function() {
			if ($('.tr_interactive').css('display') == 'block')
			{
				$('.tr_interactive').css('display', '');
			}
		});

		iPreviewWidth = 640;
		iPreviewHeight = 360;
	}
	else
	{

		$('.tr_interactive').show('', function() {
			if ($('.tr_interactive').css('display') == 'block')
			{
				$('.tr_interactive').css('display', '');
			}
		});

		iPreviewWidth = 920;
		iPreviewHeight = 522;
	}


}
$(document).ready(function(){
//    alert('asdasdad');
    $("#video_end_screen_container .endscreen_template").on('click',function(){
//        alert('asd');
        var vall = $(this).attr('value');
        var radio = $(this).attr('id').replace('video_endscreen_','');
        if(vall == 1){
        $("."+radio+"_endbuttons").slideDown(700);    
        }else{
         $("."+radio+"_endbuttons").slideUp(700);   
        }
        
    })
})
//$(document).ready(function(){
//      //  alert('zxzxzx');
//        $(document).on('change','#ui-multiselect-makes-option-0',function(){
//            if($(this).is(':checked')){
//                $(".ui-multiselect-checkboxes input[type='checkbox']").prop("checked",true);
//                $("#makes option").prop("selected",true);
//                
//            }else{
//                $(".ui-multiselect-checkboxes input[type='checkbox']").prop("checked",false);
//                $("#makes option").prop("selected",false);
//            }
//        //    alert('sad');
//        })
//    })
