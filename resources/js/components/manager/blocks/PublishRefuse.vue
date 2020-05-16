<template>
<div>
    <button @click="SetStatusPublish()" class="edit btn btn-primary">Опубликовать</button>
    <button @click="SetStatusRefuse()" class="btn btn-danger">Отказать</button>
</div>
</template>
<script>
    export default {
        props:['id','route'],
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
                            this.$toaster.success('Данные успешно отредактированы');
                            this.RefreshTable(true);
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

                axios.put(this.route + this.id,{status_id:"3",publication_date:this.today.toISOString().substring(0, 10)})
                    .then((response) => {
                        if (response.data.response == 'updated') {
                            this.$toaster.success('Данные успешно отредактированы');
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
        }

    }
</script>

<style scoped>

</style>
