<template>
    <div class="container">

        <h1 class="title is-3">Отгрузка товара</h1>

        <b-tabs position="is-centered" class="block">
            <b-tab-item label="Склад бабы Зины">
                <warehouse-block owner="zina" type="get"></warehouse-block>
            </b-tab-item>
            <b-tab-item label="Склад бабы Вали">
                <warehouse-block owner="valya" type="get"></warehouse-block>
            </b-tab-item>
            <b-tab-item label="Склад робота">
                <warehouse-block owner="robot" type="get"></warehouse-block>
            </b-tab-item>
        </b-tabs>

    </div>
</template>

<script>
    import WarehouseBlock from '../widgets/WarehouseBlock.vue'

    export default {
        name: "index",
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