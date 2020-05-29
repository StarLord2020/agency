<template>
<div>
    <button @click="SetStatusPublish()" class="edit btn btn-primary">Опубликовать</button>
    <button @click="SetStatusRefuse()" class="btn btn-danger">Отказать</button>
</div>
</template>
<script>
    export default {
        props:['id','route','setPages'],
        name: "PublishRefuse",
        data(){
            return{
                today: new Date(),
        }
        },
        methods:{
            RefreshTable(record){
                this.$emit('delete', record);
            },
            SetStatusPublish()
            {
                axios.put(this.route + this.id,{status_id:'2',publication_date:this.today.toISOString().substring(0, 10)})
                    .then((response) => {
                        if (response.data.response == 'updated') {
                            this.$toaster.success('Успешно опубликовано');
                            this.RefreshTable(true);
                            this.setPages();
                        }
                        else {
                            this.$toaster.error('Ошибка');
                        }
                    })
                    .catch(e => {
                            this.$toaster.error(e.response.data.errors);
                    })
            },
            SetStatusRefuse()
            {
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

                        if (value){
                            axios.put(this.route + this.id,{status_id:"3",publication_date:this.today.toISOString().substring(0, 10)})
                                .then((response) => {
                                    if (response.data.response == 'updated') {

                                        this.$toaster.success('Отказано');
                                        this.RefreshTable(true);
                                    }
                                    else {
                                        this.$toaster.error('Ошибка');
                                    }
                                })
                                .catch(e => {
                                    this.$toaster.error(e.response.data.errors);
                                })
                        }
                    })
                    .catch(err => {

                    })
            }
        }

    }
</script>

<style scoped>

</style>
