<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform" xmlns="http://www.w3.org/1999/html">

    <table-admin :items="classrooms" :fields="fields" :routes="routes"></table-admin>

</template>

<script>
    export default {
        props:['classrooms'],
        data() {
            return {
                routes:{
                    Create:'/admin/super/classroom/create',
                    Edit:'/admin/super/classroom/',
                    Delete:'/admin/super/classroom/'
                },
                fields: [
                    { key: 'id', label: 'id', sortable: true, class: 'text-center',sortDirection: 'desc' },
                    { key: 'name', label: '№ Кабинета', sortable: true, class: 'text-center' },
                    { key: 'actions', label: 'Действия' }

                ],
            }
        },
    }
</script>

<style scoped>

</style>
