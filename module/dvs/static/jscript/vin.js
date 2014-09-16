if (!window.WTVVIN) {
    window.WTVVIN = {
        sApiUrl: '',
        iDvsId: 0,
        init: function (params) {
            this.sApiUrl = params.apiUrl;
            this.iDvsId = params.dvs;

            var sAllVin = '';
            var x = document.getElementsByClassName('dvs_vin_btn');
            for (i = 0; i < x.length; i++) {
                sVinId = x[i].getAttribute('vin');
                sAllVin += sVinId + ',';

                x[i].setAttribute('id', 'dvs_vin_btn_' + sVinId);
                var sHTML = '<a style="display: none;" href="#">' + x[i].getAttribute('title') + '</a><div class="dvs_vin_loading"></div>';
                x[i].innerHTML = sHTML;
            }
            if(sAllVin.length > 0) {
                sAllVin = sAllVin.substring(0, sAllVin.length - 1);
            }
            this.getJSON(this.sApiUrl + 'newapi.php?method=dvs.getVins&vin=' + sAllVin + '&dvs=' + this.iDvsId, this.render_buttons, this.render_errors);
        },

        render_buttons: function(data) {
            var aRows = data.output;
            for (var sKey in aRows) {
                if (aRows.hasOwnProperty(sKey)) {
                    aRow = aRows[sKey];
                    var element = document.getElementById('dvs_vin_btn_' + sKey);
                    var urlElement = element.childNodes[0];
                    var loadingElement = element.childNodes[1];
                    if(aRow.url != null && aRow.url != '') {
                        urlElement.setAttribute('href', aRow.url);
                        urlElement.style.display = 'block';
                        loadingElement.style.display = 'none';
                    } else {
                        loadingElement.style.display = 'none';
                    }
                }
            }
        },

        render_errors: function(data) {

        },

        getJSON: function(url, successHandler, errorHandler) {
            var xhr = typeof XMLHttpRequest != 'undefined'
                ? new XMLHttpRequest()
                : new ActiveXObject('Microsoft.XMLHTTP');
            xhr.open('get', url, true);
            xhr.onreadystatechange = function() {
                var status;
                var data;
                if (xhr.readyState == 4) {
                    status = xhr.status;
                    if (status == 200) {
                        data = JSON.parse(xhr.responseText);
                        successHandler && successHandler(data);
                    } else {
                        errorHandler && errorHandler(status);
                    }
                }
            };
            xhr.send();
        }
    }
}