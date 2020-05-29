<template>
    <div class="bides_container mx-auto">
        <div class="search pt-4 pb-4 border">
            <div class="row">
                <div class="col-2">
                    <span class="d-block mt-1" >Поиск</span>
                </div>
                <div class="col-5">
                    <div class="form-group">
                        <v-select
                            v-model="search.specialty_id"
                            :options="specialty"
                            :reduce="specialty => specialty.name"
                            label="name"
                            placeholder = "Специальность..."
                        >
                            <template v-slot:no-options="{ search, searching }">
                                <template v-if="searching">
                                    Совпадений не найдено
                                </template>
                                <em style="opacity: 0.5;" v-else>Нет элементов</em>
                            </template>
                        </v-select>
                    </div>
                </div>
                <div class="col-5">
                    <input
                        name="address"
                        type="text"
                        placeholder="Город..."
                        class="form-control city"
                        v-model = "search.city"
                    >
                </div>
            </div>
        </div>
        <div class="border search pt-4 pb-4" v-if="!pages.length">
            <span>Нет резюме...</span>
        </div>
        <div class="bid border pb-2" v-for="resume in displayedPosts">
            <a :href="'/employer/resume/'+resume.id" class="d-block">
                <span class="d-block mb-2 mt-2"><b class="mr-3">ФИО:</b>{{resume.fio}}</span>
                <span class="company d-block mb-2"><b class="mr-3">Образование:</b> {{resume.education}}</span>
                <span class="address d-block mb-2"><b class="mr-3">Специальность:</b>{{resume.specialty}}</span>
                <span class="address d-block mb-2"><b class="mr-3">Адресс:</b>{{resume.address}}</span>
                <span class="salary d-block mb-2"><b class="mr-3">Опыт работы:</b>{{resume.experience}}</span>
                <span class="description d-block mb-2"><b class="mr-3">Навыки:</b>{{resume.skills|cutText(195)}}</span>
            </a>
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
    import paginate from '../../paginate';
    export default {
        name: "SearchForResumes",
        props:['resumes','specialty'],
        mixins:[paginate],
        data() {
            return {
                search:{
                    city:null,
                    specialty_id:null
                },
                page: 1,
                perPage: 9,
                pages: [],
            }
        },
        filters: {
            cutText(value, symbolsCount) {
                return value.length > symbolsCount
                    ? value.slice(0, symbolsCount - 3) + '...'
                    : value;
            }
        },
        methods: {
            setPages () {
                let numberOfPages = Math.ceil(this.filteredList().length / this.perPage);
                console.log(this.resumes.length);
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
            filteredList: function() {

                if(!this.search.specialty_id&&!this.search.city){

                    return this.resumes;
                }

                return this.resumes.filter(resume =>
                    (this.search.specialty_id? resume.specialty == this.search.specialty_id:true)
                    &&
                    (this.search.city?
                        !resume.address.toLowerCase().indexOf(this.search.city.toLowerCase())
                        ||
                        resume.address.toLowerCase().indexOf(this.search.city.toLowerCase())>0:true)
                );

                console.log();
            },
            openSlide(){
                window.scrollTo(0, 0)
            }
        },

        computed: {
            displayedPosts () {

                let resumes =this.paginate(this.filteredList())
                this.setPages();
                return resumes;
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
    .city::placeholder {

        color:black;
    }
    .city {
        height:35px;
    }
    .search {
        padding-left:15px;
        padding-right:15px;
    }
</style>
