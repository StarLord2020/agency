<template>
    <div class="bides_container mx-auto">
        <div class="search pt-4 pb-4 border">
            <div>Вакансии</div>
        </div>
        <div class="bid border pb-2" v-for="(bid,index) in displayedPosts">
            <a :href="'/manager/bids/'+bid.id" class="d-block">
                <span class="d-block mb-2 mt-2"><b class="mr-3">ФИО:</b>{{bid.fio}}</span>
                <span class="status d-block mb-2"><b class="mr-3">Специальность:</b>{{bid.specialty}}</span>
                <span class="position d-block mb-2 mt-2"><b class="mr-3">Должность:</b>{{bid.position}}</span>
                <span class="company d-block mb-2"><b class="mr-3">Предприятие:</b> {{bid.company}}</span>
                <span class="address d-block mb-2"><b class="mr-3">Адресс:</b>{{bid.address}}</span>
                <span class="salary d-block mb-2"><b class="mr-3">Зароботная плата:</b>{{bid.salary}}</span>
                <span class="description d-block mb-2"><b class="mr-3">Описание:</b>{{bid.description|cutText(195)}}</span>
                <span class="status d-block mb-2"><b class="mr-3">Статус:</b>{{bid.name}}</span>
            </a>
            <publish-refuse  @delete="deleteRecord(bidList,bid.id)" :id="bid.id" :route="route"></publish-refuse>
        </div>
        <div class="search pt-4 pb-4 border" v-if="!displayedPosts.length">
            <div>Нет вакансий на публикацию...</div>
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
        <statistic></statistic>
    </div>
</template>

<script>
    import paginate from '../../paginate';
    export default {
        name: "IndexBids",
        mixins:[paginate],
        props:['bids'],
        data() {
            return {
                route:'/manager/bids/',
                bidList:''
            }
        },
        filters: {
            cutText(value, symbolsCount) {
                return value.length > symbolsCount
                    ? value.slice(0, symbolsCount - 3) + '...'
                    : value;
            }
        },
        created() {
            this.bidList=this.bids;
            this.paginateList=this.bids;
            this.setPages();
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
