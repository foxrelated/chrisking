if (!window.WTVDVS) {
    window.WTVDVS = {
        render_iframe:function (params) {
            var sParentUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + window.location.search;
            var height = params.height, width = params.width;
            var wrapper = document.getElementById(params.id);
            var iMaxWidth = wrapper.offsetWidth;
            var sWrapperWidth = '100%';
            if(iMaxWidth == 0) {
	            iMaxWidth = window.innerWidth;
	            if (iMaxWidth > 980) {
	            	sWrapperWidth = '980px';
	            }
            }

            delete params.height;
            delete params.width;

            var sIframe = '<iframe frameborder="0" width="100%" height="1000px" style="height:100%;width:100%;" src="' + params.iframeUrl + 'parent_' + this.encode_base64(encodeURIComponent(sParentUrl)) + '/maxwidth_' + iMaxWidth + '/"></iframe>';

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
        }
    }
}