<template>
    <div class="warehouse-container columns">  

        <div class="column is-6">
            <div class="owner" :class="[owner, isSuccessAuth ? 'good' : 'bad']"></div>   
        </div>

        <div class="column is-6">
            <auth-form v-if="!isSuccessAuth" :owner="owner" @success="successAuth"></auth-form>
            <warehouse-get-form v-else-if="type === 'get'" :owner="owner"></warehouse-get-form>
            <warehouse-put-form v-else-if="type === 'put'" :owner="owner"></warehouse-put-form>
        </div>

    </div>
</template>

<script>
    import http from '../../http'
    import AuthForm from '../forms/AuthForm.vue'
    import WarehouseGetForm from '../forms/WarehouseGetForm.vue'
    import WarehousePutForm from '../forms/WarehousePutForm.vue'

    export default {
        name: "warehouse-block",
        components: {
            AuthForm,
            WarehouseGetForm,
            WarehousePutForm
        },
        data () {
            return {
                isSuccessAuth: false
            }
        },
        props: {
            owner: {
                type: String,
                required: true
            },
            type: {
                type: String,
                required: true
            }
        },
        created: function () {
            this.isSuccessAuth = (this.type === 'put')
        },
        methods: {
            successAuth () {
                this.isSuccessAuth = true
            }
        }
    }
</script>

<style lang="scss">
    .warehouse-container {
        max-width: 600px;
        margin: 40px auto;
        border: 1px solid #7957d5;
        padding: 30px;
    }

    .owner {
        height: 400px;
        background-repeat: no-repeat;
        background-size: cover;

        &.zina.good, &.valya.good {
            background-image: url(/web/images/babka_1.jpg);
        }
        &.zina.bad, &.valya.bad {
            background-image: url(/web/images/babka_2.jpg);
        }
        &.robot.good {
            background-image: url(/web/images/robot_1.jpg);
        }
        &.robot.bad {
            background-image: url(/web/images/robot_2.jpg);
        }
    }
</style>