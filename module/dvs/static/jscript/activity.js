$Behavior.DvsActivityInit = function() {
    $('.js_item_active_link').click(function() {
        aParams = $.getParams(this.href);
        var sParams = '';
        for (sVar in aParams) {
            sParams += '&' + sVar + '=' + aParams[sVar] + '';
        }
        sParams = sParams.substr(1, sParams.length);

        if (aParams['active'] == '1') {
                $(this).parent().parent().find('.js_item_is_not_active:first').hide();
                $(this).parent().parent().find('.js_item_is_active:first').show();
        } else {
            if(confirm('Do you want to deactivate this DVS?')) {
                $(this).parent().parent().find('.js_item_is_active:first').hide();
                $(this).parent().parent().find('.js_item_is_not_active:first').show();
            } else {
                return false;
            }
        }

        $Core.ajaxMessage();
        $.ajaxCall(aParams['call'], sParams + '&global_ajax_message=true');

        return false;
    });
}