<template>
    <table-student :items="subjects" :fields="fields" :action="action"></table-student>
</template>

<script>
    export default {
        name: "IndexHomeworkStudent",
        props:['subjects'],
        created(){
          console.log(this.subjects);
        },
        data(){
            return {
                fields:[
                    {key:'name',label:'Предмет'},
                    {key: 'actions', label: 'Действия'}
                ],
                action:{
                    route:'/student/homework-index/',
                    content:'Домашние задания'
                }
            }
        }

    }
</script>

<style scoped>

</style>
