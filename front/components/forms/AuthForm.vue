<template>    
    <form @submit.prevent="submit" novalidate>
        <b-field :label="authTypes[owners[owner].authType].label"
            :type="errors.has('authData') ? 'is-danger' : ''" >
            <masked-input
                v-model="formData.authData"
                name="authData"
                :mask="authTypes[owners[owner].authType].mask"
                :placeholder="authTypes[owners[owner].authType].placeholder"
                v-validate="'required'"
                :data-vv-as="authTypes[owners[owner].authType].label"
                class="input" />
        </b-field>
        <p v-if="errors.has('authData')" class="help is-danger">{{ errors.first('authData') }}</p>

        <button class="button is-link" :class="{'is-loading': inProgress}" :disabled="inProgress">Пройти идентификацию</button>
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
                formData: {
                    authData: '',
                    authOwner: ''
                },
                authTypes: {
                    passport: {
                        label: 'Паспорт',
                        mask: '11 11 111111',
                        placeholder: '33 00 000000'
                    },
                    card: {
                        label: 'Карточка',
                        mask: '1111 1111',
                        placeholder: '0000 0000'
                    }
                },
                owners: {
                    zina: {
                        authType: 'passport'
                    },
                    valya: {
                        authType: 'passport'
                    },
                    robot: {
                        authType: 'card'
                    }
                }        
            }
        },
        props: {
            owner: {
                type: String,
                required: false
            }
        },
        watch: {
        },
        methods: {
            async submit () {
                if (!await this.$validator.validateAll()) {
                    return
                }

                this.formData.authOwner = this.owner;

                try {
                    this.inProgress = true

                    await http.post('/api/?method=login', this.formData)

                    this.$emit('success')

                    this.$toast.open({
                        message: 'Вы на складе',
                        type: 'is-success'
                    })

                } catch ({ message }) {
                    this.$toast.open({
                        message: 'Иди отсюда!',
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
</style>