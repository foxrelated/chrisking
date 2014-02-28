

$('#year').on('click', '.init', function() {
	$(this).closest('ul').children('ul').toggle();
});

$('#makes').on('click', '.init', function() {
	$(this).closest('ul').children('ul').toggle();
});

$('#models').on('click', '.init', function() {
	$(this).closest('ul').children('ul').toggle();
});

$("#makes").on("click", "li:not(.init)", function() {
    $("#makes").children('.init').html($(this).html());
    $("#makes").children('ul').toggle();
});

$("#models").on("click", "li:not(.init)", function() {
    $("#models").children('.init').html($(this).html());
    $("#models").children('ul').toggle();
});

$("#year").on("click", "li:not(.init)", function() {
    $("#year").children('.init').html($(this).html());
    $("#year").children('ul').toggle();
});

