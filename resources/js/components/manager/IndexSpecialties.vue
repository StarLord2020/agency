<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform" xmlns="http://www.w3.org/1999/html">
    <table-manager :items="specialties" :fields="fields" :routes="routes"></table-manager>
</template>

<script>
    export default {
        props:['specialties'],
        data() {
            return {
                routes:{
                    Create:'/manager/specialties/create',
                    Edit:'/manager/specialties/',
                    Delete:'/manager/specialties/'
                },
                fields: [
                    { key: 'id',label: 'id', sortable: true,sortDirection: 'desc', class: 'text-center' },
                    { key: 'name', label: 'Имя', sortable: true, sortDirection: 'desc' ,class: 'text-center'},
                    { key: 'actions', label: 'Действия' }
                ],
            }
        },
    }
</script>

<style scoped>

</style>
