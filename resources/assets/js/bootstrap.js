
window._ = require('lodash');

window.Vue = require('vue');
window.axios = require('axios');
window.Chart = require('chart.js');

window.axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest'
};