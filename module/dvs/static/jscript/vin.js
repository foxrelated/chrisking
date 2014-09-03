if (!window.WTVVIN) {
    window.WTVVIN = {
        render_all_button: function (params) {
            var x = document.getElementsByClassName('dvs_vin_btn');
            for (i = 0; i < x.length; i++) {
                sVinId = x[i].getAttribute('rel');
                sIframe = '<iframe frameborder="0" width="' + params.width  + '" height="' + params.height + '" src="' + params.iframeUrl + 'vin/height_' + params.height + '/dvs_' + params.dvs + '/vin_' + sVinId + '"></iframe>';
                console.log(sIframe);
                x[i].innerHTML = sIframe;
            }
        },

        get_dvs_style: function (iDvsId) {
            return {backcolor: 123};
        },

        loadXMLDoc: function (sServer) {
            var xmlhttp;

            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {
                // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }

            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4) {
                    if (xmlhttp.status == 200) {
                        return xmlhttp.responseText;
                    }
                    else if (xmlhttp.status == 400) {
                        return false;
                    }
                    else {
                        return false;
                    }
                }
            }

            xmlhttp.open("GET", sServer, true);
            xmlhttp.send();
        }
    }
}