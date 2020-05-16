<template>
    <div class="search pt-4 pb-4 border">
        <div>Вашы предложения</div>
    </div>
    <div class="offers border pb-2"  v-if="resume" v-for="bid in displayedPosts">
        <a :href="'/employee/watch-offer/'+bid.id" class="d-block">
            <span class="d-block mb-2 mt-2"><b class="mr-3">ФИО:</b>{{bid.fio}}</span>
            <span class="address d-block mb-2"><b class="mr-3">Предприятие:</b>{{bid.company}}</span>
            <span class="address d-block mb-2"><b class="mr-3">Адресс:</b>{{bid.address}}</span>
            <span class="salary d-block mb-2"><b class="mr-3">Контакты:</b>{{bid.contacts}}</span>
            <span class="salary d-block mb-2"><b class="mr-3">Должность:</b>{{bid.position}}</span>
            <span class="salary d-block mb-2"><b class="mr-3">Заработная плата:</b>{{bid.salary}}</span>
            <span class="description d-block mb-2"><b class="mr-3">Описание:</b>{{bid.description|cutText(195)}}</span>
        </a>
    </div>
        <div class="search pt-4 pb-4 border" v-if="!offers.length||!resume">
        <div>Предложений пока нет...</div>
    </div>
</template>

<script>
    import paginate from '../../paginate'
    export default {
        name: "OffersList",
        props:['offers'],
        mixins:['paginate']
    }
</script>

<style scoped>

</style>
