<template>
    <div class="bides_container mx-auto">
        <div class="search pt-4 pb-4 border">
            <div>Выбраное предложение</div>
        </div>
        <div class="offers border pb-2">
            <span class="d-block mb-2 mt-2"><b class="mr-3">ФИО:</b>{{offer.FIO}}</span>
            <span class="address d-block mb-2"><b class="mr-3">Предприятие:</b>{{offer.company}}</span>
            <span class="address d-block mb-2"><b class="mr-3">Адресс:</b>{{offer.address}}</span>
            <span class="salary d-block mb-2"><b class="mr-3">Контакты:</b>{{offer.email}}</span>
            <span class="salary d-block mb-2"><b class="mr-3">Специальность:</b>{{offer.name}}</span>
            <span class="salary d-block mb-2"><b class="mr-3">Должность:</b>{{offer.position}}</span>
            <span class="salary d-block mb-2"><b class="mr-3">Заработная плата:</b>{{offer.salary}}</span>
            <span class="description d-block mb-2"><b class="mr-3">Описание:</b>{{offer.description}}</span>
            <span class="salary d-block mb-2"><b class="mr-3">Статус:</b>{{offer.status}}</span>
            <buttons-component :routes="routes" :buttons="buttons"></buttons-component>
        </div>
    </div>
</template>

<script>
    import ButtonsComponent from '../ButtonsComponent'
    export default {
        name: "WatchOffer",
        components:{
            ButtonsComponent
        },
        props:['offer'],
        data() {
            return {
                routes:{
                    success:'/employee/offer/'+this.offer.id,
                    redirect:'/employee/offers/'+this.offer.resume_id,
                },
                buttons:{
                    success:this.offer.status!='Принято'?true:false,
                    refuse:this.offer.status!='Отказано'?true:false,
                }
            }
        },
        methods: {

        }
    }
</script>

<style scoped>
    .bides_container {
        max-width:700px;
        /*border: 1px solid gray;*/
        border-radius: 3px;
    }
    .offers {
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
