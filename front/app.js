import Vue from 'vue'

import NProgress from 'vue-nprogress'

import { router } from './router'
//import store from './store'

import * as filters from './filters'
Object.keys(filters).forEach(key => Vue.filter(key, filters[key]));

import * as plugins from './plugins'
Object.values(plugins).forEach(args => Vue.use(...args));

import { App } from './components'

const options = {
    latencyThreshold: 200,
    router: true,
    http: true,
    axios: true
};
Vue.use(NProgress, options);

const nprogress = new NProgress({
    parent: '.nprogress-container',
    showSpinner: false });

Vue.config.productionTip = false;

new Vue({
    el: '#app',
    //delimiters: ['${', '}'],
    nprogress,
    router,
    //store,
    render: h => h(App),
});