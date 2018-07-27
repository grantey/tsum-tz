<template>
    <header>
        <nav class="navbar is-fixed-top is-link" role="navigation" aria-label="main navigation">
            <div class="container">
                <div class="navbar-brand">
                    <router-link :to="{ name: 'site_index'}" class="navbar-item">
                        На главную
                    </router-link>

                    <button class="button navbar-burger" data-target="navMenu">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                </div>
                <div class="navbar-menu" id="navMenu">
                    <div class="navbar-end">

                        <router-link
                            class="navbar-item"
                            v-for="(item, index) in menu"
                            :key="index"
                            v-if="item.path && item.meta.granted"
                            :to="{ name: item.name }">
                            <i class="fa" :class="item.meta.icon"></i> {{ item.meta.label }}
                        </router-link>

                        <a v-if="logoutBtn" class="navbar-item" :href="'logout'">
                            <i class="fa fa-sign-out"></i>{{ 'menu.logout' }} ({{ 'username' | conf }})
                        </a>

                    </div>
                </div>
            </div>
        </nav>
    </header>
</template>

<script>
    import { menu } from '../router'
    import { BASE_URL } from '../config'

    export default {
        name: "nav-bar",
        data () {
            return {
                menu,
                BASE_URL: BASE_URL,
                logoutBtn: false
            }
        }
    }
</script>

<style lang="scss">
    .navbar > .container .navbar-brand, .container > .navbar .navbar-brand {
        margin-left: 0rem;
    }
    .navbar > .container .navbar-menu, .container > .navbar .navbar-menu {
        margin-right: 0rem;
    }
</style>