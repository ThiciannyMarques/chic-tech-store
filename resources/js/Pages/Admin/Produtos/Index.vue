<template>
    <AdminLayout>
        <ListaProdutos :produtos = "produtos" ></ListaProdutos>
    </AdminLayout>
</template>
<script setup>
    import AdminLayout from '../Components/AdminLayout.vue'
    import ListaProdutos from './ListaProdutos.vue'

    props({
        produtos:Array
    })
</script>