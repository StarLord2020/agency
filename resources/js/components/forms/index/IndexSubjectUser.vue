<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform" xmlns="http://www.w3.org/1999/html">
    <div>
        <div class="container-fluid">
            <span class="title d-block mb-3">Преподаватели по предмету: {{subject.name}}</span>
        </div>
        <table-admin :items="teachers" :fields="fields" :routes="routes"></table-admin>
    </div>
</template>

<script>
    export default {
        props:['subject','teachers'],
        created(){
            console.log(this.teachers)
        },
        data() {
            return {
                routes:{
                    Create:'/admin/super/subject-user/create/'+this.subject.id+'/'+this.subject.name,
                    Edit:'',
                    Delete:'/admin/super/subject-user/'
                },
                fields: [
                    { key: 'id',label: 'id', sortable: true,sortDirection: 'desc', class: 'text-center' },
                    { key: 'name', label: 'Имя', sortable: true,sortDirection: 'desc', class: 'text-center' },
                    { key: 'surname', label: 'фамилия', sortable: true, sortDirection: 'desc' ,class: 'text-center'},
                    { key: 'patronymic', label: 'Отчество', sortable: true, sortDirection: 'desc',class: 'text-center' },
                    { key: 'actions', label: 'Действия' }
                ],
                action: {
                    route:'',
                    content:'Преподаватели'
                }
            }
        }
    }
</script>

<style scoped>
    .title {
        font-size: 28px;
    }
</style>
