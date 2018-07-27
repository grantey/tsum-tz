import Vue from 'vue'

import Vuex from 'vuex'
Vue.use(Vuex)

import Index from '../components/pages/Index'

export default new Vuex.Store({
    strict: true,
    modules: {
        Index
    }
})