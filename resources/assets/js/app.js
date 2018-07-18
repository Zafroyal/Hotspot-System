window.Vue = require('vue');
require('./bootstrap');

import VueRouter from 'vue-router';



import Router from './routes.js'


const app = new Vue({
    el: '#app',
    router: Router
});
