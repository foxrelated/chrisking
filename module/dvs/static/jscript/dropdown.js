$("#year").on("click", "li:not(.init)", function() {
    $('#year .init_selected').html($(this).html());
});

$("#makes").on("click", "li:not(.init)", function() {
    $('#makes .init_selected').html($(this).html());
});

$("#models").on("click", "li:not(.init)", function() {
    $('#models .init_selected').html($(this).html());
});

$('#year').click(function(e) {
	$('#year ul').slideToggle(200);
	
	if ($('#makes ul').is(':visible'))
	{
		$('#makes ul').slideToggle(200);
	}
	
	if ($('#models ul').is(':visible'))
	{
		$('#models ul').slideToggle(200);
	}
	e.stopPropagation();
});

$('#makes').click(function(e) {
	$('#makes ul').slideToggle(200);
	if ($('#year ul').is(':visible'))
	{
		$('#year ul').slideToggle(200);
	}
	
	if ($('#models ul').is(':visible'))
	{
		$('#models ul').slideToggle(200);
	}
	e.stopPropagation();
});

$('#models').click(function(e) {
	$('#models ul').slideToggle(200);
	if ($('#year ul').is(':visible'))
	{
		$('#year ul').slideToggle(200);
	}
	
	if ($('#makes ul').is(':visible'))
	{
		$('#makes ul').slideToggle(200);
	}
	e.stopPropagation();
});

$(document).click(function() {
	if ($('#year ul').is(':visible'))
	{
		$('#year ul').slideToggle(200);
	}
	
	if ($('#makes ul').is(':visible'))
	{
		$('#makes ul').slideToggle(200);
	}
	
	if ($('#models ul').is(':visible'))
	{
		$('#models ul').slideToggle(200);
	}
});