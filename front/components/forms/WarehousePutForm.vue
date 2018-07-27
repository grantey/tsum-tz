<template>    
    <form @submit.prevent="submit" novalidate>
        <h2 class="title is-4">Принять товар</h2>

        <b-loading :is-full-page="true" :active.sync="isLoading"></b-loading>

        <div class="amount">Товара на складе: {{ totalAmount }}</div>
        <b-field label="Количество"
            :type="errors.has('amount') ? 'is-danger' : ''" >
            <input
                v-model="formData.amount"
                name="amount"                
                v-validate="'required'"
                data-vv-as="Количество"
                class="input" />
        </b-field>
        <p v-if="errors.has('amount')" class="help is-danger">{{ errors.first('amount') }}</p>

        <input
            v-model="formData.productId"
            name="productId"
            type="hidden" />

        <button class="button is-link" :class="{'is-loading': inProgress}" :disabled="inProgress">Положить на склад</button>
    </form>
</template>

<script>
    import http from '../../http'
    import maskedInput from 'vue-masked-input'

    export default {
        name: "auth-form",
        components: {
            maskedInput
        },
        data () {
            return {
                inProgress: false,
                isLoading: false,
                totalAmount: 0,
                formData: {
                    amount: 0,
                    productId: 0
                },
                products: []   
            }
        },
        props: {
            owner: {
                type: String,
                required: false
            }
        },
        async created () {
            try {
                this.isLoading = true

                let response = await http.post('/api/?method=listproduct', {warehouseOwner: this.owner})
                this.products = response.data

                this.totalAmount = this.products[0].amount
                this.formData.productId = this.products[0].id

            } catch ({ message }) {
            } finally {
                this.isLoading = false
            }
        },
        methods: {
            async submit () {
                if (!await this.$validator.validateAll()) {
                    return
                }

                try {
                    this.inProgress = true

                    await http.post('/api/?method=putproduct', this.formData)

                    this.totalAmount += parseInt(this.formData.amount)

                    this.$toast.open({
                        message: 'Вы пополнили склад',
                        type: 'is-success'
                    })

                } catch ({ message }) {
                    this.$toast.open({
                        message: 'Не донесли!',
                        type: 'is-danger'
                    })
                } finally {
                    this.inProgress = false
                }
            }
        }
    }
</script>

<style scoped>
    .help {
        margin-bottom: 1rem;
    }

    .amount {
        font-size: 1.5rem;
        font-weight: bold;
        color: #888888;
        margin-bottom: 1rem;    
        letter-spacing: -1px;   
    }

</style>