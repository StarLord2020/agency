<template>
<div>
    <button class="edit btn btn-primary">Опубликовать</button>
    <button class="btn btn-danger">Отказать</button>
</div>
</template>
<script>
    export default {
        props:['id','route'],
        name: "PublishRefuse",
        methods:{
            SetStatusPublish()
            {
                axios.put(this.route + this.id,"2")
                    .then((response) => {
                        if (response.data.response == 'updated') {
                            this.$toaster.success('Данные успешно отредактированы');
                        }
                        else {
                            this.$toaster.error('Ошибка');
                        }
                    })
                    .catch(e => {
                        // if(e.response.data.errors.email[0]){
                        //     this.duplicateEmail=this.editUser.email;
                        //     this.emailErr='Пользователь с данным email уже существует';
                        //     this.$toaster.warning(e.response.data.errors.email[0]);
                        // }
                        // else {
                        //     this.$toaster.error(e.response.data.errors);
                        // }
                    })
            },
            SetStatusRefuse()
            {
                axios.put(this.route + this.id,"3")
                    .then((response) => {
                        if (response.data.response == 'updated') {
                            this.$toaster.success('Данные успешно отредактированы');

                        }
                        else {
                            this.$toaster.error('Ошибка');
                        }
                    })
                    .catch(e => {
                        // if(e.response.data.errors.email[0]){
                        //     this.duplicateEmail=this.editUser.email;
                        //     this.emailErr='Пользователь с данным email уже существует';
                        //     this.$toaster.warning(e.response.data.errors.email[0]);
                        // }
                        // else {
                        //     this.$toaster.error(e.response.data.errors);
                        // }
                    })
            }
        }
    }
</script>

<style scoped>

</style>
