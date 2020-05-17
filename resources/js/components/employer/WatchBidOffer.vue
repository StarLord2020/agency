<template>
    <div class="bides_container mx-auto">
        <div class="search pt-4 pb-4 border">
            <div>Выбраное предложение</div>
        </div>
        <div class="offers border pb-2">
            <span class="d-block mb-2 mt-2"><b class="mr-3">ФИО:</b>{{bidOffer.fio}}</span>
            <span class="address d-block mb-2"><b class="mr-3">Контакты:</b>{{bidOffer.contacts}}</span>
            <span class="address d-block mb-2"><b class="mr-3">Адресс:</b>{{bidOffer.address}}</span>
            <span class="salary d-block mb-2"><b class="mr-3">Опыт работы:</b>{{bidOffer.experience}}</span>
            <span class="salary d-block mb-2"><b class="mr-3">Образование:</b>{{bidOffer.education}}</span>
            <span class="salary d-block mb-2"><b class="mr-3">Навыки:</b>{{bidOffer.skills}}</span>
            <span class="salary d-block mb-2"><b class="mr-3">Статус предложения:</b>{{bidOffer.status}}</span>
            <buttons-component :routes="routes" :buttons="buttons"></buttons-component>
        </div>
    </div>
</template>

<script>
    import ButtonsComponent from '../ButtonsComponent'
    export default {
        name: "WatchBidOffer",
        components:{
            ButtonsComponent
        },
        props:['bid-offer'],
        data() {
            return {
                routes:{
                    success:'/employer/offer/'+this.bidOffer.id,
                    redirect:'/employer/bid-offers/'+this.bidOffer.bid_id,
                },
                buttons:{
                    success:this.bidOffer.status!='Принято'?true:false,
                    refuse:this.bidOffer.status!='Отказано'?true:false,
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
