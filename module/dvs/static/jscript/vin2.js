if (!window.WTVVIN) {
    window.WTVVIN = {
        sApiUrl: '',
        iDvsId: 0,
        init: function (params) {

            this.sApiUrl = params.apiUrl;
            this.iDvsId = params.dvs;

            if (typeof params.scriptUrl != 'undefined') {
                var sScriptUrl = params.scriptUrl;
            } else {
                var sScriptUrl = params.styleUrl.replace('vin/style/id', 'vin/script/id');
            }

            var cchead = document.getElementsByTagName("head");
            var cclink = document.createElement('link');
            cclink.href = params.styleUrl;
            cclink.type = 'text/css';
            cclink.charset = 'utf-8';
            cclink.rel = 'stylesheet';
            cchead[0].appendChild(cclink);

            var sAllVin = '';
            var x = this.GEBCN('dvs_vin_btn');
            for (i = 0; i < x.length; i++) {
                sVinId = x[i].getAttribute('vin');
                sAllVin += sVinId + ',';

                x[i].setAttribute('id', 'dvs_vin_btn_' + sVinId);

                var aLink = document.createElement('a');
                aLink.style.display = 'none';
                aLink.setAttribute('href', '#');
                aLink.setAttribute('onClick', 'WTVVIN.show_popup(this); return false;');
                x[i].appendChild(aLink);

                var divLoading = document.createElement('div');
                divLoading.className = 'dvs_vin_loading';
                x[i].appendChild(divLoading);

                /*var sHTML = '<a style="display: none;" href="#" onClick="WTVVIN.show_popup(this); return false;">' + x[i].getAttribute('title') + '</a><div class="dvs_vin_loading"></div>';
                 x[i].innerHTML = sHTML;*/
            }
            if(sAllVin.length > 0) {
                sAllVin = sAllVin.substring(0, sAllVin.length - 1);
            }

            var ccscript = document.createElement('script');
            ccscript.src = sScriptUrl + 'vin_' + sAllVin + '/';
            ccscript.type = 'text/javascript';
            cchead[0].appendChild(ccscript);

            var popupWrapper = document.createElement('div');
            popupWrapper.setAttribute('id', 'dvs_vin_popup_wrapper');
            if(popupWrapper.addEventListener) {
                popupWrapper.addEventListener('click', function() {
                    WTVVIN.close_popup(); return false;
                });
            } else {
                popupWrapper.attachEvent('onclick', function() {
                    WTVVIN.close_popup(); return false;
                });
            }

            var popup =document.createElement('div');
            popup.setAttribute('id', 'dvs_vin_popup');
            popupWrapper.appendChild(popup);

            var closeButton = document.createElement('a');
            closeButton.setAttribute('id', 'dvs_vin_close_btn');
            closeButton.setAttribute('href', '#');
            if(closeButton.addEventListener) {
                closeButton.addEventListener('click', function() {
                    WTVVIN.close_popup(); return false;
                });
            } else {
                closeButton.attachEvent('onclick', function() {
                    WTVVIN.close_popup(); return false;
                });
            }

            var text = document.createTextNode('Close');
            closeButton.appendChild(text);
            popup.appendChild(closeButton);

            var popupContent = document.createElement('div');
            popupContent.setAttribute('id', 'dvs_vin_popup_content');
            popup.appendChild(popupContent);

            document.getElementsByTagName('body')[0].appendChild(popupWrapper);
        },

        GEBCN: function(cn){
            if(document.getElementsByClassName) // Returns NodeList here
                return document.getElementsByClassName(cn);

            cn = cn.replace(/ *$/, '');

            if(document.querySelectorAll) // Returns NodeList here
                return document.querySelectorAll((' ' + cn).replace(/ +/g, '.'));

            cn = cn.replace(/^ */, '');

            var classes = cn.split(/ +/), clength = classes.length;
            var els = document.getElementsByTagName('*'), elength = els.length;
            var results = [];
            var i, j, match;

            for(i = 0; i < elength; i++){
                match = true;
                for(j = clength; j--;)
                    if(!RegExp(' ' + classes[j] + ' ').test(' ' + els[i].className + ' '))
                        match = false;
                if(match)
                    results.push(els[i]);
            }

            // Returns Array here
            return results;
        },

        show_popup: function(oLink) {
            var sLink = oLink.getAttribute('href');
            document.getElementById('dvs_vin_popup_content').innerHTML = '<iframe allowfullscreen="true" webkitallowfullscreen="true" mozallowfullscreen="true" src="' + sLink + '" height="600" width="930" frameborder="0" scrolling="no"></iframe>';
            this.fadeIn('dvs_vin_popup_wrapper');

            return false;
        },

        close_popup: function() {
            document.getElementById('dvs_vin_popup_content').innerHTML = '';
            this.fadeOut('dvs_vin_popup_wrapper');

            return false;
        },

        fadeOut: function(id, val){
            if(isNaN(val)){
                val = 9;
            }
            document.getElementById(id).style.opacity='0.'+val;
            document.getElementById(id).style.filter='alpha(opacity='+val+'0)';
            if(val>0) {
                val--;
                setTimeout('WTVVIN.fadeOut("'+id+'",'+val+')', 20);
            } else {
                document.getElementById(id).style.display = 'none';
                return false;
            }
            return false;
        },

        fadeIn: function(id, val) {
            if(isNaN(val)) {
                val = 0;
            }
            document.getElementById(id).style.display = 'block';
            document.getElementById(id).style.opacity='0.'+val;
            document.getElementById(id).style.filter='alpha(opacity='+val+'0)';
            if(val<9) {
                val++;
                setTimeout('WTVVIN.fadeIn("'+id+'",'+val+')', 20);
            } else {
                document.getElementById(id).style.opacity='1';
                return false;
            }
            return false;
        }
    }
}