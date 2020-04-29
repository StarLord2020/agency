<template>
    <div>
        <div class="container-fluid">
            <span class="title d-block mb-3">Ученики класса: {{grade.name}}</span>
        </div>
        <table-admin :items="students" :fields="fields" :routes="routes"></table-admin>
    </div>
</template>

<script>
    export default {
        name: "IndexStudent",
        props:['students','grade'],
        created(){

        },
        data() {
            return {
                routes:{
                    Create:'/admin/super/student/create/'+this.grade.id+'/'+this.grade.name,
                    Edit:'',
                    Delete:'/admin/super/student/'
                },
                fields: [
                    { key: 'id',label: 'id', sortable: true,sortDirection: 'desc', class: 'text-center' },
                    { key: 'surname', label: 'фамилия', sortable: true,sortDirection: 'desc', class: 'text-center' },
                    { key: 'name', label: 'Имя', sortable: true, sortDirection: 'desc' ,class: 'text-center'},
                    { key: 'patronymic', label: 'Отчество', sortable: true, sortDirection: 'desc',class: 'text-center' },
                    { key: 'actions', label: 'Действия' }
                ]
            }
        }
    }
</script>

<style scoped>
    .title {
        font-size: 28px;
    }
</style>
