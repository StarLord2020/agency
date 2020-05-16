<template>
    <div>
        <button @click="successOffer" class="btn btn-primary">Принять</button>
        <button @click="refuseOffer" class="btn btn-danger">Отказать</button>
    </div>
</template>

<script>
    export default {
        name: "ButtonsComponent",
        props:['routes'],
        methods:{
            refuseOffer() {
                this.$bvModal.msgBoxConfirm('Вы действительно хотите отказать?', {
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
                            this.query('Отказано');
                        }
                    })
                    .catch(err => {
                    })
            },
            successOffer(){
                this.query('Принято');
            },
            query(status){
                axios.put(this.routes.success,{status:status}).then((response) => {
                    document.location.href = this.routes.redirect;
                }).catch(e => {
                    console.log(e);
                    this.$toaster.error("Ошибка");
                });
            }
        },
        created(status){

        }
    }
</script>

<style scoped>

</style>
