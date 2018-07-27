<template>
    <div class="container">

        <h1 class="title is-3">Приём товара</h1>

        <b-tabs position="is-centered" class="block">
            <b-tab-item label="Склад бабы Зины">
                <warehouse-block owner="zina" type="put"></warehouse-block>
            </b-tab-item>
            <b-tab-item label="Склад бабы Вали">
                <warehouse-block owner="valya" type="put"></warehouse-block>
            </b-tab-item>
            <b-tab-item label="Склад робота">
                <warehouse-block owner="robot" type="put"></warehouse-block>
            </b-tab-item>
        </b-tabs>

    </div>
</template>

<script>
    import WarehouseBlock from '../widgets/WarehouseBlock.vue'

    export default {
        name: "warehouse",
        components: {
            WarehouseBlock
        },
        data () {
            return {
            }
        }
    }
</script>

<style scoped>

</style>