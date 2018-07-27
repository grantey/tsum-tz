import Vue from 'vue'
import Router from 'vue-router'
import NotFound from '../components/NotFound.vue'

import { generateRoutes, menu } from './menu'

Vue.use(Router)

const routes = [
    {
        path: '*',
        component: NotFound
    },
    ...generateRoutes()
];

const router = new Router({
    routes,
    linkActiveClass: 'is-active',
    mode: 'history'
});

router.beforeEach((to, from, next) => {
    if (to.meta && to.meta.redirect) {
        document.location.href = to.path
    } else {
        next()
    }
});

export {
    router,
    menu
}