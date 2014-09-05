if (!window.WTVVIN) {
    window.WTVVIN = {
        render_all_button: function (params) {
            var x = document.getElementsByClassName('dvs_vin_btn');
            for (i = 0; i < x.length; i++) {
                sVinId = x[i].getAttribute('rel');
                sUrl = params.iframeUrl + 'vin/dvs_' + params.dvs + '/vin_' + sVinId + '/';
                x[i].setAttribute('href', sUrl);
            }
        }
    }
}