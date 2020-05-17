<template>
    <div class="bides_container mx-auto">
        <div class="search pt-4 pb-4 border">
            <div>Ваши ответы</div>
        </div>
        <div class="resume border pb-2" v-if="displayedPosts.length" v-for="bid in displayedPosts">
            <span class="position d-block mb-2 mt-2"><b class="mr-3">Должность:</b>{{bid.position}}</span>
            <span class="position d-block mb-2 mt-2"><b class="mr-3">Контакты:</b>{{bid.email}}</span>
            <span class="position d-block mb-2 mt-2"><b class="mr-3">Специальность:</b>{{bid.specialty}}</span>
            <span class="company d-block mb-2"><b class="mr-3">Предприятие:</b> {{bid.company}}</span>
            <span class="address d-block mb-2"><b class="mr-3">Адресс:</b>{{bid.address}}</span>
            <span class="salary d-block mb-2"><b class="mr-3">Зароботная плата:</b>{{bid.salary}}</span>
            <span class="description d-block mb-2"><b class="mr-3">Описание:</b>{{bid.description|cutText(195)}}</span>
            <span class="salary d-block mb-2"><b class="mr-3">Статус:</b>{{bid.status}}</span>
            <button @click="cancelResume(bid.id)" class="btn btn-danger">Отменить</button>
        </div>
        <div class="search pt-4 pb-4 border" v-if="!displayedPosts.length">
            <div>Нет отправленных резюме...</div>
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
        name: "SendResumeIndex",
        props:['resumes'],
        mixins:[paginate],
        created(){
            this.paginateList=this.resumes;
            this.setPages();
        },
        methods:{
            cancelResume(id) {
                this.$bvModal.msgBoxConfirm('Вы действительно хотите отменить запрос?', {
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
                            axios.delete('/employee/resumes/'+id).then((response) => {
                                let index =this.paginateList.findIndex(el => el.id === id)
                                this.paginateList.splice(index,1)
                            }).catch(e => {
                                console.log(e);
                                this.$toaster.error("Ошибка");
                            });
                        }
                    })
                    .catch(err => {
                    })
            },
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
