<template>
    <div class="bides_container mx-auto">
        <div class="search pt-4 pb-4 border">
            <div>Выбраное предложение</div>
        </div>
        <div class="offers border pb-2">
            <span class="d-block mb-2 mt-2"><b class="mr-3">ФИО:</b>{{offer.fio}}</span>
            <span class="address d-block mb-2"><b class="mr-3">Предприятие:</b>{{offer.company}}</span>
            <span class="address d-block mb-2"><b class="mr-3">Адресс:</b>{{offer.address}}</span>
            <span class="salary d-block mb-2"><b class="mr-3">Контакты:</b>{{offer.contacts}}</span>
            <span class="salary d-block mb-2"><b class="mr-3">Должность:</b>{{offer.position}}</span>
            <span class="salary d-block mb-2"><b class="mr-3">Заработная плата:</b>{{offer.salary}}</span>
            <span class="description d-block mb-2"><b class="mr-3">Описание:</b>{{offer.description}}</span>
            <button @click = "deleleteOffer(offer.id)" class="send btn btn-danger">Удалить</button>
        </div>
    </div>
</template>

<script>
    export default {
        name: "WatchOffer",
        props:['offer'],
        methods: {
            deleleteOffer(id) {
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
                            console.log(id)
                            axios.delete('/employee/offer/' + id).then((response) => {
                                if (response.data.response == 'deleted') {

                                    document.location.href = "/employee/employee-resume";
                                }
                            }).catch(e => {
                                this.$toaster.error("Ошибка");
                            });
                        }
                    })
                    .catch(err => {
                    })
            },
        },
        created() {

            console.log(this.offer);
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
