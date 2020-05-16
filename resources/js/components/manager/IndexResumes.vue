<template>
    <div class="bides_container mx-auto">
        <div class="bid border pb-2" v-for="bidt in 10">
            <a href="" class="d-block">
                <span class="d-block mb-2 mt-2"><b class="mr-3">ФИО:</b>{{bid[0].fio}}</span>
                <span class="company d-block mb-2"><b class="mr-3">Образование:</b> {{bid[0].education}}</span>
                <span class="address d-block mb-2"><b class="mr-3">Адресс:</b>{{bid[0].address}}</span>
                <span class="salary d-block mb-2"><b class="mr-3">Опыт работы:</b>{{bid[0].expiriens}}</span>
                <span class="description d-block mb-2"><b class="mr-3">Навыки:</b>{{bid[0].scills|cutText(195)}}</span>
            </a>
            <button class="edit btn btn-primary">Опубликовать</button>
            <button class="btn btn-danger">Отказать</button>
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
        name: "IndexResumes",
        data() {
            return {
                page: 1,
                perPage: 9,
                pages: [],
                bid:[
                    {
                        fio:'Petrov Aleks Semonovich',
                        education:'NKMZ',
                        address:'Kramatorsk',
                        expiriens:'dd($this->skills)',
                        scills:'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus debitis doloremque eligendi enim non odit\n' +
                            '    quaerat quasi, repellendus repudiandae rerum vel velit voluptas! Architecto nobis sed soluta, sunt vero\n' +
                            '    voluptatibus?'
                    }
                ]
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
            setPages () {
                let numberOfPages = Math.ceil(this.filteredList().length / this.perPage);
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
        computed: {
            displayedPosts () {

                let bids =this.paginate(this.filteredList())
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
    .bid {
        padding: 0 15px;
    }
    .bid:hover {
        border: 1px solid gray!important;
    }
    button.page-link {
        display: inline-block;
    }
    button.page-link {
        font-size: 20px;
        color: #29b3ed;
        font-weight: 500;
    }
    a {
        text-decoration:none;
        color:black;
    }
    .edit {
        color:#fff;
    }
</style>
