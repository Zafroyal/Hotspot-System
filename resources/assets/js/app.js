require('./bootstrap');

window.Vue = require('vue');

Vue.component('home-component', require('./components/HomeComponent.vue'));

import Router from './routes.js'


const app = new Vue({
    el: '#app',
    router: Router
});
