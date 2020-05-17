<template>
    <div class="bides_container mx-auto">
        <div class="search pt-4 pb-4 border">
            <div>Выбраная вакансия</div>
        </div>
        <div class="bid border pb-2">
                <span class="d-block mb-2 mt-2"><b class="mr-3">ФИО:</b>{{bid.fio}}</span>
                <span class="status d-block mb-2"><b class="mr-3">Специальность:</b>{{bid.specialty}}</span>
                <span class="position d-block mb-2 mt-2"><b class="mr-3">Должность:</b>{{bid.position}}</span>
                <span class="company d-block mb-2"><b class="mr-3">Предприятие:</b> {{bid.company}}</span>
                <span class="address d-block mb-2"><b class="mr-3">Адресс:</b>{{bid.address}}</span>
                <span class="salary d-block mb-2"><b class="mr-3">Зароботная плата:</b>{{bid.salary}}</span>
                <span class="description d-block mb-2"><b class="mr-3">Описание:</b>{{bid.description}}</span>
                <span class="status d-block mb-2"><b class="mr-3">Статус:</b>{{bid.name}}</span>
            <publish-refuse  @delete="redirect()" :id="bid.id" :route="route"></publish-refuse>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ShowBid",
        props:['bid'],
        data() {
            return {
                route:'/manager/bids/',
            }
        },
        methods:{
            redirect()
            {
                document.location.href = "/manager/bids/"
            },
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
    .search {
        padding-left:15px;
        padding-right:15px;
    }
</style>
