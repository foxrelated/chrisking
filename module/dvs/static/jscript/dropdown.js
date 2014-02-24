$('#select_new ul').on('click', '.init', function() {
	$(this).closest('ul').children('li:not(.init)').toggle();
});

var allOptions = $("#select_new ul").children('li:not(.init)');

$("#select_new ul").on("click", "li:not(.init)", function() {
    allOptions.removeClass('selected');
    $(this).addClass('selected');
    $("#select_new ul").children('.init').html($(this).html());
    allOptions.toggle();
});