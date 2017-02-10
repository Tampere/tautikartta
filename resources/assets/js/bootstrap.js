
require('es6-promise').polyfill();
window.axios = require('axios');
window.Chart = require('chart.js');

window.axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest'
};