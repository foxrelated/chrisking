gapi.analytics.ready(function() {
    gapi.analytics.createComponent('CircleGraph', {
        execute: function() {
            var options = this.get();
            options['title'] = options['title'] || '(not-set)';
            options['class'] = options['class'] || 'circle-graph-default';
            options['number'] = options['number'] || '...';
            options['type'] = options['type'] || 'default';
            this.container = typeof options.container == 'string' ? document.getElementById(options.container) : options.container;
            if (options.template) this.template = options.template;
            this.container.innerHTML = this.template;

            var div = this.container.querySelector('div');
            div.className += ' ' + options['class'];
            var p = this.container.querySelector('p');
            p.innerHTML = options['title'];
            var span = this.container.querySelector('span');
            var _that = this;

            if ((typeof options.query != "undefined") && ((options.type == 'default') || (typeof options['totalEvents'] != "undefined"))) {
                var request = gapi.client.analytics.data.ga.get(options.query);
                request.then(function(response) {
                    if (typeof response.result.rows != "undefined") {
                        _that.emit('loadedData', response.result.rows[0][0]);
                        span.innerHTML = _that.calculateData(response.result.rows[0][0]);
                    } else {
                        span.innerHTML = _that.calculateData(0);
                        _that.emit('loadedData', 0);
                    }
                }, function(reason) {
                    _that.emit('loadedData', 0);
                });
            } else {
                _that.emit('loadedData', 0);
            }

            return this;
        },

        calculateData: function(value) {
            var options = this.get();
            options['type'] = options['type'] || 'default';
            options['totalEvents'] = options['totalEvents'] || 0;
            if (options.type == 'conversion') {
                if (value > 0) {
                    var newValue = parseInt(parseInt(options.totalEvents) * 100 / parseInt(value));
                    return newValue + '%';
                } else {
                    return '0%';
                }
            } else {
                return value;
            }
        },

        clearTemplate: function() {
            var options = this.get();
            options['title'] = options['title'] || '(not-set)';
            options['class'] = options['class'] || 'circle-graph-default';
            this.container = typeof options.container == 'string' ? document.getElementById(options.container) : options.container;
            if (options.template) this.template = options.template;
            this.container.innerHTML = this.template;

            var div = this.container.querySelector('div');
            div.className += ' ' + options['class'];
            var p = this.container.querySelector('p');
            p.innerHTML = options['title'];
            var span = this.container.querySelector('span');
            span.innerHTML = '...';
        },

        template:
            '<div class="DVSCicleGraph">' +
                '<p class="DVSCircleLabel"></p>' +
                '<span class="DVSCircleNumber">...</span>' +
            '</div>'
    });
});