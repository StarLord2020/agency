<template>
    <div class="bides_container mx-auto">
        <div class="search pt-4 pb-4 border">
            <div>Ваши ответы</div>
        </div>
        <div class="resume border pb-2" v-if="displayedPosts.length" v-for="bidOffer in displayedPosts">
            <span class="d-block mb-2 mt-2"><b class="mr-3">ФИО:</b>{{bidOffer.fio}}</span>
            <span class="address d-block mb-2"><b class="mr-3">Контакты:</b>{{bidOffer.contacts}}</span>
            <span class="address d-block mb-2"><b class="mr-3">Адресс:</b>{{bidOffer.address}}</span>
            <span class="salary d-block mb-2"><b class="mr-3">Опыт работы:</b>{{bidOffer.experience}}</span>
            <span class="salary d-block mb-2"><b class="mr-3">Образование:</b>{{bidOffer.education}}</span>
            <span class="salary d-block mb-2"><b class="mr-3">Навыки:</b>{{bidOffer.skills}}</span>
            <span class="salary d-block mb-2"><b class="mr-3">Статус предложения:</b>{{bidOffer.status}}</span>
            <button @click="cancelResume(bidOffer.id)" class="btn btn-danger">Отменить</button>
        </div>
        <div class="search pt-4 pb-4 border" v-if="!displayedPosts.length">
            <div>Нет отправленных вакансий...</div>
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
        name: "SendBidIndex",
        props:['answers'],
        mixins:[paginate],
        created(){
            this.paginateList=this.answers;
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
                            axios.delete('/employer/bids/'+id).then((response) => {
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
