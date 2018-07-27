import translator from '../utils'

const install = (Vue) => {
    Vue.prototype.$trans = function (...args) {
        return translator.trans(...args)
    }
}

export default [
    { install }
]