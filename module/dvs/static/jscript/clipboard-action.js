$(document).ready(function(){
$('.copybtn').tooltip({
  trigger: 'click',
  placement: 'bottom'
});
});
function setTooltip(elem,message) {
  $(elem).tooltip('hide').attr('data-original-title', message).tooltip('show');
}

function hideTooltip(elem) {
  setTimeout(function() {
    $(elem).tooltip('hide');
  }, 1000);
}