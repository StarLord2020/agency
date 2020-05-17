<template>
    <div class="bides_container mx-auto">
        <div class="search pt-4 pb-4 border">
            <div>Выбраная вакансия</div>
        </div>
        <div class="bid border pb-2">
            <span class="position d-block mb-2 mt-2"><b class="mr-3">Должность:</b>{{bid.position}}</span>
            <span class="company d-block mb-2"><b class="mr-3">Предприятие:</b> {{bid.company}}</span>
            <span class="address d-block mb-2"><b class="mr-3">Адресс:</b>{{bid.address}}</span>
            <span class="salary d-block mb-2"><b class="mr-3">Зароботная плата:</b>{{bid.salary}}</span>
            <span class="description d-block mb-2"><b class="mr-3">Описание:</b>{{bid.description}}</span>
            <a :href="'/employee/send-resumes/'+bid.id" class="send btn btn-primary">Отправить резюме</a>
        </div>
    </div>
</template>

<script>
    export default {
        name: "WatchBid",
        props:['bid'],
    }
</script>

<style scoped>
    .bides_container {
        max-width:700px;
        /*border: 1px solid gray;*/
        border-radius: 3px;
    }
    .bid {
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
