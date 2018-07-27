//import translator from '../utils'
import config from '../config'
import moment from 'moment'

//export const trans = (...args) => translator.trans(...args)

export const conf = key => config.value(key)

export const dateFormat = (date, format) => {
    if (date) {
        return moment(String(date)).format(format);
    }
}

export const percent = value => Math.round(value * 10000) * 0.01 + '%'

export const passport = number => {
    const str = number.toString().padStart(10, '0')

    return `${str.substr(0, 2)} ${str.substr(2, 2)} ${str.substr(4)}`
}

export const phone = number => {
    // +7 911 111-11-11
    const str = number.toString()

    return `+${str[0]} ${str.substr(1, 3)} ${str.substr(4, 3)}-${str.substr(7, 2)}-${str.substr(9, 2)}`
}

export const fileSize = size => {
    const units = ['B', 'KB', 'MB', 'GB']
    const precision = { 'B': 0, 'KB': 0, 'MB': 1, 'GB': 2 }

    let value = parseFloat(size, 10)
    let label = units.shift()

    while (value > 1024 && units.length) {
        value = value / 1024
        label = units.shift()
    }

    return `${value.toFixed(precision[label])} ${label}`
}