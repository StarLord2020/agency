<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform" xmlns="http://www.w3.org/1999/html">

    <table-admin :items="grades" :fields="fields" :routes="routes" :action="action"></table-admin>

</template>

<script>
    export default {
        props:['grades'],
        created() {
            console.log(this.grades);
        },
        data() {
            return {
                routes:{
                    Create:'/admin/super/grade/create',
                    Edit:'/admin/super/grade/',
                    Delete:'/admin/super/grade/'
                },
                fields: [
                    { key: 'id', label: 'id', sortable: true, class: 'text-center' },
                    { key: 'name', label: 'Класс', sortable: true, class: 'text-center' },
                    { key: 'surname', label: 'фамилия', sortable: true, class: 'text-center' },
                    { key: 'secondName', label: 'Имя', sortable: true, sortDirection: 'desc' },
                    { key: 'patronymic', label: 'Отчество', sortable: true, sortDirection: 'desc' },
                    { key: 'classroom', label: 'Кабинет', sortable: true, sortDirection: 'desc' },
                    { key: 'actions', label: 'Действия' }

                ],
                action: {
                    route:'/admin/super/student/index/',
                    content:'Ученики'
                }
            }
        },
    }
</script>

<style scoped>

</style>
