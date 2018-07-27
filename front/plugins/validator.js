import VeeValidate, { Validator } from 'vee-validate'
//import en from 'vee-validate/dist/locale/en'
import ru from 'vee-validate/dist/locale/ru'

Validator.localize('ru', ru);

export default [
    VeeValidate
]