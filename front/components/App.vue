<template>
    <div class="app-content">

        <nprogress-container></nprogress-container>

        <nav-bar></nav-bar>

        <section class="section-page">

            <transition mode="out-in" enter-active-class="fadeIn" leave-active-class="fadeOut" appear>
                <router-view class="animated"></router-view>
            </transition>

        </section>

    </div>
</template>

<script>
	import NprogressContainer from 'vue-nprogress/src/NprogressContainer.vue'
    import NavBar from './NavBar.vue'

	export default {
        components: {
            NprogressContainer,
            NavBar,
        },
        data () {
            return {

            }
        },
        methods: {

        }
    }
</script>

<style lang="scss">
    //@import '~bulma';
    //@import '~font-awesome/scss/font-awesome';
    //@import '~buefy/lib/buefy.css';

    .app-content {
        //min-height: 100%;
    }
    .section-page {
        margin-top: 7rem;
        padding-bottom: 5rem;
    }

</style>