<template>
    <div class="bides_container mx-auto">
        <div class="search pt-4 pb-4 border">
            <div>Ваше резюме</div>
        </div>
        <div class="resume border pb-2" v-if="resumeList.length" v-for="resume in displayedPosts">
            <a :href="'/employee/offers/'+resume.id">
                <span class="company d-block mb-2"><b class="mr-3">Образование:</b> {{resume.education}}</span>
                <span class="d-block mb-2 mt-2"><b class="mr-3">Специальность:</b>{{resume.name}}</span>
                <span class="salary d-block mb-2"><b class="mr-3">Стаж:</b>{{resume.experience}}</span>
                <span class="description d-block mb-2"><b class="mr-3">Навыки:</b>{{resume.skills|cutText(195)}}</span>
                <span class="description d-block mb-2"><b class="mr-3">Статус:</b>{{resume.status}}</span>
            </a>
            <a :href="'/employee/resume/'+resume.id+'/edit'" class="edit btn btn-primary">Редактировать</a>
            <button @click="deleleteBid(resume.id,resume)" class="btn btn-danger">Удалить</button>
        </div>
        <div class="search pt-4 pb-4 border" v-if="!resumeList.length">
            <div>У вас еще нет резюме...</div>
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
        name: "EmployeeResume",
        props:['resumes','offers'],
        data() {
            return {
                page: 1,
                perPage: 5,
                pages: [],
                resumeList:[]
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
            deleleteBid(id,resume) {
                this.$bvModal.msgBoxConfirm('Вы действительно хотите удалить запись?', {
                    size: 'sm',
                    buttonSize: 'md',
                    okVariant: 'danger',
                    okTitle: 'Да',
                    cancelTitle: 'Отмена',
                    footerClass: 'p-2',
                    hideHeaderClose: false,
                    centered: true
                })
                    .then(value => {
                        if (value) {
                            axios.delete('/employee/resume/' + id).then((response) => {
                                if (response.data.response == 'deleted') {
                                    this.$toaster.success("Резюме удалено");
                                    let index =this.resumeList.findIndex(el => el.id === id)
                                    this.resumeList.splice(index,1)
                                }
                            }).catch(e => {
                                this.$toaster.error("Ошибка");
                            });
                        }
                    })
                    .catch(err => {
                    })
            },
            setPages () {
                let numberOfPages = Math.ceil(this.resumeList.length / this.perPage);
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

                return this.paginate(this.resumeList)
            }
        },
        watch:{
            page(){
                this.openSlide();
            }
        },
        created() {
            this.resumeList = this.resumes;
            this.setPages();
        }

    }
</script>

<style scoped>
    .bides_container {
        max-width:730px;
        border-radius: 3px;
        padding-left:15px;
        padding-right:15px;
    }
    .resume,.offers {
        padding: 0 15px;
    }
    .resume:hover {
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
    button.page-link {
        display: inline-block;
    }
    button.page-link {
        font-size: 20px;
        color: #29b3ed;
        font-weight: 500;
    }
</style>

