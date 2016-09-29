if (!window.CDKDVS) {
    window.CDKDVS = {
        sApiUrl: '',
        iDvsId: 0,
        screenWidth: 0,
        screenHeight: 0,
        render_iframe:function (params) {
            var sParentUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + window.location.search;
            var height = params.height, width = params.width;
            var wrapper = document.getElementById(params.id);
            var iMaxWidth = wrapper.offsetWidth;
            var sWrapperWidth = '100%';
            if(iMaxWidth == 0) {
	            iMaxWidth = window.innerWidth;
	            if (iMaxWidth > 980) {
	            	sWrapperWidth = '980px';t
	            }
            }

            delete params.height;
            delete params.width;
            var iframeUrl = params.rootUrl.replace("www",  params.cdkWebId);
            //var iframeUrl = params.rootUrl + params.cdkWebId + '/';
            iframeUrl = iframeUrl + 'iframe/cdk/';
            var sIframe = '<iframe frameborder="0" width="100%" height="1000px" style="width:100%;height:1000px;" src="' + iframeUrl + 'parent_' + this.encode_base64(encodeURIComponent(sParentUrl)) + '/maxwidth_' + iMaxWidth + '/"></iframe>';

            if (wrapper) {
                wrapper.innerHTML = sIframe, wrapper.style.width = sWrapperWidth, wrapper.style.height = '100%', wrapper.style.padding = 0, wrapper.style.display = 'block'; wrapper.style.maxWidth = iMaxWidth;
            } else if (window.console && console.error)console.error('DVS: Could not find DOM element with ID: ' + id)
        },

        encode_base64: function(data) {
            var b64 = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=';
            var o1, o2, o3, h1, h2, h3, h4, bits, i = 0,
                ac = 0,
                enc = '',
                tmp_arr = [];

            if (!data) {
                return data;
            }

            do { // pack three octets into four hexets
                o1 = data.charCodeAt(i++);
                o2 = data.charCodeAt(i++);
                o3 = data.charCodeAt(i++);

                bits = o1 << 16 | o2 << 8 | o3;

                h1 = bits >> 18 & 0x3f;
                h2 = bits >> 12 & 0x3f;
                h3 = bits >> 6 & 0x3f;
                h4 = bits & 0x3f;

                // use hexets to index into b64, and append result to encoded string
                tmp_arr[ac++] = b64.charAt(h1) + b64.charAt(h2) + b64.charAt(h3) + b64.charAt(h4);
            } while (i < data.length);

            enc = tmp_arr.join('');

            var r = data.length % 3;

            return (r ? enc.slice(0, r - 3) : enc) + '==='.slice(r || 3);
        },
        init: function (params) {
            this.sApiUrl = params.apiUrl;
            this.iDvsId = params.cdkWebId;

            this.screenWidth = window.innerWidth;
            this.screenHeight = window.innerHeight;


            if (typeof params.scriptUrl != 'undefined') {
                var sScriptUrl = params.scriptUrl;
            } else {
                var sScriptUrl = params.styleUrl.replace('vin/style/id', 'vin/script/id');
            }

            var sAllVin = '';
            var sAllEdstyle = '';
            var x = this.GEBCN('dvs_vin_btn');
            for (i = 0; i < x.length; i++) {
                sVinId = x[i].getAttribute('vin');
                sEdstyleId = x[i].getAttribute('edstyleid');

                var sCurrentClass = x[i].getAttribute('class');
                if (sVinId) {
                    sAllVin += sVinId + ',';
                    x[i].setAttribute('id', 'dvs_vin_btn_' + sVinId + '_' + i);
                    x[i].setAttribute('class', sCurrentClass + ' dvs_vin_btn_' + sVinId);
                } else {
                    sAllEdstyle += sEdstyleId + ',';
                    x[i].setAttribute('id', 'dvs_vin_btn_' + sEdstyleId + '_' + i);
                    x[i].setAttribute('class', sCurrentClass + ' dvs_vin_btn_' + sEdstyleId);
                }

                var aLink = document.createElement('a');
                aLink.style.display = 'none';
                aLink.setAttribute('href', '#');
                x[i].appendChild(aLink);

                var divLoading = document.createElement('div');
                divLoading.className = 'dvs_vin_loading';
                x[i].appendChild(divLoading);

                /*var sHTML = '<a style="display: none;" href="#" onClick="CDKDVS.show_popup(this); return false;">' + x[i].getAttribute('title') + '</a><div class="dvs_vin_loading"></div>';
                 x[i].innerHTML = sHTML;*/
            }
            if(sAllVin.length > 0) {
                sAllVin = sAllVin.substring(0, sAllVin.length - 1);
            }

            if(sAllEdstyle.length > 0) {
                sAllEdstyle = sAllEdstyle.substring(0, sAllEdstyle.length - 1);
            }

            var layoutWrapper = document.createElement('div');
            layoutWrapper.setAttribute('id', 'dvs_vin_layout_wrapper');
            if(layoutWrapper.addEventListener) {
                layoutWrapper.addEventListener('click', function() {
                    CDKDVS.close_popup(); return false;
                });
            } else {
                layoutWrapper.attachEvent('onclick', function() {
                    CDKDVS.close_popup(); return false;
                });
            }
            document.body.appendChild(layoutWrapper);

            var popupWrapper = document.createElement('div');
            popupWrapper.setAttribute('id', 'dvs_vin_popup_wrapper');
            if(popupWrapper.addEventListener) {
                popupWrapper.addEventListener('click', function() {
                    CDKDVS.close_popup(); return false;
                });
            } else {
                popupWrapper.attachEvent('onclick', function() {
                    CDKDVS.close_popup(); return false;
                });
            }

            var popup =document.createElement('div');
            popup.setAttribute('id', 'dvs_vin_popup');
            popupWrapper.appendChild(popup);

            var closeButton = document.createElement('a');
            closeButton.setAttribute('id', 'dvs_vin_close_btn');
            //closeButton.setAttribute('href', '#');
            if(closeButton.addEventListener) {
                closeButton.addEventListener('click', function() {
                    CDKDVS.close_popup(); return false;
                });
            } else {
                closeButton.attachEvent('onclick', function() {
                    CDKDVS.close_popup(); return false;
                });
            }

            var text = document.createTextNode('Close');
            closeButton.appendChild(text);
            popup.appendChild(closeButton);

            var popupContent = document.createElement('div');
            popupContent.setAttribute('id', 'dvs_vin_popup_content');
            popup.appendChild(popupContent);

            document.body.appendChild(popupWrapper);

            var cclink = document.createElement('link');
            cclink.href = params.styleUrl + 'height_' + this.screenHeight + '/width_' + this.screenWidth + '/';
            cclink.type = 'text/css';
            cclink.charset = 'utf-8';
            cclink.rel = 'stylesheet';
            document.body.appendChild(cclink);

            var ccscript = document.createElement('script');
            ccscript.src = sScriptUrl + 'vin_' + sAllVin + '/edstyle_' + sAllEdstyle + '/height_' + this.screenHeight + '/width_' + this.screenWidth + '/';
            ccscript.type = 'text/javascript';
            document.body.appendChild(ccscript);
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

        show_popup: function(sLink) {
            console.log(sLink);
            //var sLink = oLink.getAttribute('href');
            document.getElementById('dvs_vin_popup_content').innerHTML = '<iframe src="' + sLink + '" height="100%" width="100%" style="height:100%;" frameborder="0" scrolling="no"></iframe>';
            CDKDVS.fadeIn('dvs_vin_layout_wrapper', 9);
            CDKDVS.fadeIn('dvs_vin_popup_wrapper', 10);
            return false;
        },

        close_popup: function() {
            document.getElementById('dvs_vin_popup_content').innerHTML = '';
            this.fadeOut('dvs_vin_layout_wrapper');
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
                setTimeout('CDKDVS.fadeOut("'+id+'",'+val+')', 20);
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
                setTimeout('CDKDVS.fadeIn("'+id+'",'+val+')', 20);
            } else {
                document.getElementById(id).style.opacity='1';
                return false;
            }
            return false;
        }
    }
}