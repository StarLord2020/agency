<template>
    <div class="bides_container mx-auto">
        <div class="search pt-4 pb-4 border">
            <div>Выбирите резюме</div>
        </div>
        <div class="resume border pb-2" v-if="displayedPosts.length" v-for="resume in displayedPosts">
            <span class="company d-block mb-2"><b class="mr-3">Образование:</b> {{resume.education}}</span>
            <span class="d-block mb-2 mt-2"><b class="mr-3">Специальность:</b>{{resume.name}}</span>
            <span class="salary d-block mb-2"><b class="mr-3">Стаж:</b>{{resume.experience}}</span>
            <span class="description d-block mb-2"><b class="mr-3">Навыки:</b>{{resume.skills|cutText(195)}}</span>
            <button @click="" class="btn btn-primary">Отправить</button>
        </div>
        <div class="search pt-4 pb-4 border" v-if="!displayedPosts.length">
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
    import paginate from '../../paginate'
    export default {
        name: "SendResume",
        props: ['resumes','bid'],
        mixins:[paginate],
        data(){
            return {

            }
        },
        methods: {
            sendResume() {
                axios.get('/employee/bid-offer/'+this.bid.id)
                    .then((response) => {
                        console.log(response.data)
                        if(response.data.response == 'created') {

                            this.$toaster.success('Резюме отправлено');
                        }
                        else if(response.data.response == 'duplicated'){

                            this.$toaster.warning('Резюме уже отправлено');
                        }
                    })
                    .catch(e => {
                        this.$toaster.error(e.response.data.message);
                    })
            }
        },
        created(){
            this.paginateList=this.resumes;
            this.setPages();
        }
    }
</script>

<style scoped>
    a {
        text-decoration:none;
        color:black;
    }
    .search {
        padding-left:15px;
        padding-right:15px;
    }
    .resume:hover {
        border: 1px solid gray!important;
    }
    .resume {
        padding: 0 15px;
    }
</style>
