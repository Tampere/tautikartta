
window._ = require('lodash');

window.Vue = require('vue');
window.axios = require('axios');
window.Chart = require('chart.js');

var Promise = require('es6-promise').Promise;

window.axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest'
};