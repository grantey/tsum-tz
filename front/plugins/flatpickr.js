import flatpickr from 'flatpickr'
import flatPickr from 'vue-flatpickr-component'
import Cleave from 'cleave.js'

const Russian = require("flatpickr/dist/l10n/ru.js").default.ru;
flatpickr.localize(Object.assign({}, Russian, { rangeSeparator: ' до ' }))

flatpickr.setDefaults({
    //dateFormat: 'F j, Y',
    //altInput: true,
    //altFormat: 'd.m.Y',
    //allowInput: true,
    onReady: function () {
        if (!this.config.allowInput) {
            return
        }

        new Cleave(this.altInput, {
            date: true,
            datePattern: ['d', 'm', 'Y'],
            delimiter: '.'
        })
    },
   /* onChange: function (selDates, dateStr) {
        console.log(selDates+' '+dateStr);
        this._selDateStr = dateStr
    },
    onClose: function () {
        console.log('3');
        if (this.config.allowInput && this._input.value && this._input.value !== this._selDateStr) {
            this.setDate(this.altInput.value, true, this.config.altFormat)
        }
    }*/
})

const install = Vue => {
    Vue.component('flat-pickr', flatPickr)
}

export default [
    { install }
]