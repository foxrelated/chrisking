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