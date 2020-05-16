<template>
    <div class="bides_container mx-auto">
        <div class="bid border pb-2" v-for="(bid,index) in displayedPosts">
            <a href="" class="d-block">
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

    export default {
        name: "IndexBids",
        props:['bids'],
        data() {
            return {
                page: 1,
                perPage: 3,
                pages: [],
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
        methods:{
            deleteRecord(array,id)
            {
               let index =array.findIndex(el => el.id === id)
               array.splice(index,1)
            },
            setPages () {
                let numberOfPages = Math.ceil(this.bidList.length / this.perPage);
                console.log(this.bids.length);
                this.pages=[];
                for (let index = 1; index <= numberOfPages; index++) {
                    this.pages.push(index);
                }
            },
            paginate (posts) {
                let page = this.page;
                let perPage = this.perPage;
                let from = (page * perPage) - perPage;
                let to = (page * perPage);
                return  posts.slice(from, to);
            },
            openSlide(){
                window.scrollTo(0, 0)
            }

        },
        created() {
            this.bidList=this.bids
        },
        computed: {
            displayedPosts () {

                let bids =this.paginate(this.bidList)
                this.setPages();
                return bids;
            }
        },
        watch:{
            page(){
                this.openSlide();
            }
        }

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
