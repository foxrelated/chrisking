function validateError(sError, sInputId, bUseName){
	$('#dvs_error_messages').append('<div class="error_message">' + sError + '</div>');
	$('#dvs_error_messages').show('fast');
	window.bIsValid = false;
	
	if (sInputId != ''){
		$((bUseName ? "input[name='" + sInputId + "']" : '#' + sInputId)).animate({
			boxShadow: '3px 3px 5px 6px #b70000'
		},500);
		$((bUseName ? "input[name='" + sInputId + "']" : '#' + sInputId)).addClass('dvs_input_error');
	}
}

function clearErrors(){
	$('#dvs_error_messages').hide('fast').html('');
	$('.dvs_input_error').animate({
		boxShadow: ''
	},100);
	$('.dvs_input_error').removeClass('dvs_input_error');
	window.bIsValid = true;
}