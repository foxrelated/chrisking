gapi.analytics.ready(function() {
    gapi.analytics.createComponent('DateSelector', {
        execute: function() {
            var options = this.get();
            options['start-date'] = options['start-date'] || '7daysAgo';
            this.container = typeof options.container == 'string' ? document.getElementById(options.container) : options.container;
            if (options.template) this.template = options.template;

            this.container.innerHTML = this.template;

            var selects = this.container.querySelector('select');
            this.container.onchange = this.onChange.bind(this, selects);

            return this;
        },

        onChange: function(select) {
            this.emit('change', {
                'start-date': select.value + 'daysAgo',
                'end-date': 'yesterday'
            });
        },

        template:
            '<span class="DVSDateLabel">Date Range:</span>' +
            '<select class="DVSDateSelector">' +
            '   <option value="7">Past 7 Days</option>' +
            '   <option value="30">Past 30 Days</option>' +
            '   <option value="90">Past 90 Days</option>' +
            '</select>'
    });
});