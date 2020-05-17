<template>
    <div class="bides_container mx-auto">
        <div class="search pt-4 pb-4 border">
            <div>Выбраное резюме</div>
        </div>
        <div class="resume border pb-2">
            <span class="company d-block mb-2"><b class="mr-3">ФИО:</b>{{resume.fio}}</span>
            <span class="company d-block mb-2"><b class="mr-3">Адресс:</b>{{resume.address}}</span>
            <span class="company d-block mb-2"><b class="mr-3">Контакты:</b>{{resume.email}}</span>
            <span class="company d-block mb-2"><b class="mr-3">Образование:</b>{{resume.education}}</span>
            <span class="d-block mb-2 mt-2"><b class="mr-3">Специальность:</b>{{resume.specialty}}</span>
            <span class="salary d-block mb-2"><b class="mr-3">Стаж:</b>{{resume.experience}}</span>
            <span class="description d-block mb-2"><b class="mr-3">Навыки:</b>{{resume.skills}}</span>
            <a :href="'/employer/offer/'+resume.id" class="send btn btn-primary">Отправить вакансию</a>
        </div>
    </div>
</template>

<script>
    export default {
        name: "WatchResume",
        props:['resume']
    }
</script>

<style scoped>
    .resume {
        padding: 0 15px;
    }
    a {
        text-decoration:none;
        color:black;
    }
    .search {
        padding-left:15px;
        padding-right:15px;
    }
    .send {
        color:#fff;
    }
</style>
