import security from '../security'

const isGranted = security.isGranted

const install = function (Vue) {
    Vue.mixin({
        methods: {
            isGranted
        }
    })
}

export default [
    { install }
]