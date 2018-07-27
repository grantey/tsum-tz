export const BASE_URL = ''

class Config {
    constructor (storage) {
        this.storage = storage
    }

    value (key) {
        return this.storage.getItem(key)
    }

    get ['locale'] () {
        return this.value('locale')
    }

    get ['roles'] () {
        return this.value('roles')
    }

    get ['token'] () {
        return this.value('token')
    }

    get ['username'] () {
        return this.value('username')
    }
}

export default new Config(localStorage)