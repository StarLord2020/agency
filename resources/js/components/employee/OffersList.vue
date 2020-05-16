<template>
    <div class="bides_container mx-auto">
        <div class="search pt-4 pb-4 border">
            <div>Вашы предложения</div>
        </div>
        <div class="offer border pb-2"  v-if="displayedPosts.length" v-for="offer in displayedPosts">
            <a :href="'/employee/watch-offer/'+offer.id" class="d-block">
                <span class="d-block mb-2 mt-2"><b class="mr-3">ФИО:</b>{{offer.fio}}</span>
                <span class="address d-block mb-2"><b class="mr-3">Адресс:</b>{{offer.address}}</span>
                <span class="salary d-block mb-2"><b class="mr-3">Контакты:</b>{{offer.contacts}}</span>
                <span class="salary d-block mb-2"><b class="mr-3">Должность:</b>{{offer.position}}</span>
                <span class="salary d-block mb-2"><b class="mr-3">Заработная плата:</b>{{offer.salary}}</span>
                <span class="description d-block mb-2"><b class="mr-3">Описание:</b>{{offer.description|cutText(195)}}</span>
                <span class="salary d-block mb-2"><b class="mr-3">Статус предложения:</b>{{offer.status}}</span>
            </a>
        </div>
            <div class="search pt-4 pb-4 border" v-if="!displayedPosts.length">
            <div>Предложений пока нет...</div>
        </div>
        <nav aria-label="Page navigation example" class="pt-2" v-if="pages.length>1">
            <ul class="pagination">
                <li class="page-item">
                    <button type="button" class="page-link" v-if="page != 1" @click="page--">Назад</button>
                </li>
                <li class="page-item">
                    <button type="button" class="page-link" v-for="pageNumber in pages.slice(page-1, page+5)" @click="page = pageNumber"> {{pageNumber}} </button>
                </li>
                <li class="page-item">
                    <button type="button" @click="page++" v-if="page < pages.length" class="page-link">Вперед</button>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
    import paginate from '../../paginate'
    export default {
        name: "OffersList",
        props:['offers'],
        mixins:[paginate],
        data(){
            return {
                offerList:[]
            }
        },
        created(){
            this.paginateList=this.offers;
            this.setPages();
        }
    }
</script>

<style scoped>
    .offer {
        padding-left: 15px;
        padding-right: 15px;
    }
    a {
        text-decoration:none;
        color:black;
    }
    .offer:hover {
        border: 1px solid gray!important;
    }
</style>
