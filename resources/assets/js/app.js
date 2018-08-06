window.Vue = require('vue');

require('./bootstrap');


window.VueAxios = require('vue-axios').default;

window.Axios = require('axios').default;


import {store} from './store.js'

import VueRouter from 'vue-router';

import Router from './routes.js'



const app = new Vue({
    el: '#app',
    store,
    router: Router
});
