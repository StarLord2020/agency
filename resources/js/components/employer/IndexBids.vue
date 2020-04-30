<template>
    <div class="bides_container mx-auto">
        <div class="bid border pb-2" v-for="(bid,index) in MyBids">
            <a href="" class="d-block">
                <span class="position d-block mb-2 mt-2"><b class="mr-3">Должгость:</b>{{bid.position}}</span>
                <span class="company d-block mb-2"><b class="mr-3">Предприятие:</b> {{bid.company}}</span>
                <span class="address d-block mb-2"><b class="mr-3">Адресс:</b>{{bid.address}}</span>
                <span class="salary d-block mb-2"><b class="mr-3">Зароботная плата:</b>{{bid.salary}}</span>
                <span class="description d-block mb-2"><b class="mr-3">Описание:</b>{{bid.description|cutText(195)}}</span>
                <span class="status d-block mb-2"><b class="mr-3">Статус:</b>{{bid.name}}</span>
            </a>
            <a :href="'/employer/bid/'+bid.id+'/edit'" class="edit btn btn-primary">Редактировать</a>
            <button @click="deleleteBid(bid.id,index)" class="btn btn-danger">Удалить</button>
        </div>
    </div>
</template>

<script>
    export default {
        name: "IndexBides",
        props:['bids'],
        data() {
            return {
                MyBids:{}
            }
        },
        methods: {
            deleleteBid(id, index) {
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
                            axios.delete('/employer/bid/' + id).then((response) => {
                                if (response.data.response == 'deleted') {
                                    this.MyBids.splice(index, 1)
                                    this.$toaster.success("Запись успешно удалена");
                                }
                            }).catch(e => {
                                this.$toaster.error("Пользователь не найден");
                            });
                        }
                    })
                    .catch(err => {
                    })
            },
        },
        filters: {
            cutText(value, symbolsCount) {
                return value.length > symbolsCount
                    ? value.slice(0, symbolsCount - 3) + '...'
                    : value;
            }
        },
        created() {
            this.MyBids=this.bids;
            console.log(this.bids);
        },
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
</style>
