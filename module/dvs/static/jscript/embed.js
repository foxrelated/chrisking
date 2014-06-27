if (!window.WTVDVS) {
    window.WTVDVS = {
        render_iframe:function (params) {
            var height = params.height, width = params.width;
            delete params.height;
            delete params.width;
            var sIframe = '<iframe src="' + params.iframeUrl + '/parent_' + encodeURI(window.location.pathname + window.location.search) + '"></iframe>';

            var wrapper = document.getElementById(params.id);
            if (wrapper) {
                wrapper.innerHTML = sIframe, wrapper.style.width = parseInt(width) + 'px', wrapper.style.height = parseInt(height) + 'px', wrapper.style.padding = 0, wrapper.style.display = 'block';
            } else if (window.console && console.error)console.error('TrialPay: Could not find DOM element with ID: ' + id)
        }
    }
}