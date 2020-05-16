<template>
    <div class="bides_container mx-auto">
        <div class="bid border pb-2">
            <span class="d-block mb-2 mt-2"><b class="mr-3">ФИО:</b>{{resume[0].fio}}</span>
            <span class="company d-block mb-2"><b class="mr-3">Образование:</b> {{resume[0].education}}</span>
            <span class="address d-block mb-2"><b class="mr-3">Специальность:</b>{{resume[0].specialty}}</span>
            <span class="salary d-block mb-2"><b class="mr-3">Опыт работы:</b>{{resume[0].experience}}</span>
            <span class="description d-block mb-2"><b class="mr-3">Навыки:</b>{{resume[0].skills}}</span>
            <span class="address d-block mb-2"><b class="mr-3">Стутус:</b>{{resume[0].name}}</span>
            <publish-refuse  @delete="redirect()" :id="resume[0].id" :route="route"></publish-refuse>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ShowResume",
        props:['resume'],
        data() {
            return {
                route:'/manager/resumes/',
            }
        },
        methods:{
            redirect()
            {
                document.location.href = "/manager/resumes/"
            },
        },
        created() {
            console.log(this.resume);
        },
    }
</script>

<style scoped>
    .bides_container {
        max-width:700px;
        /*border: 1px solid gray;*/
        border-radius: 3px;
    }
    button.page-link {
        display: inline-block;
    }
    button.page-link {
        font-size: 20px;
        color: #29b3ed;
        font-weight: 500;
    }
    .bid {
        padding: 0 15px;
    }
    .bid:hover {
        border: 1px solid gray!important;
    }
    a {
        text-decoration:none;
        color:black;
    }
    .edit {
        color:#fff;
    }
</style>
