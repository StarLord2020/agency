<template>
    <div class="form_container">
        <form class="form-horizontal" @submit.prevent = "sendClassroom">
            <span class="d-block mb-4 title">Добавление кабинета</span>
            <div class="form-group">
                <div class="row">
                    <label for="Name" class="col-sm-4 control-label">Номер кабинета</label>
                    <div class="col-sm-8">
                        <input
                            v-validate="'required'"
                            :class="{'input': true, 'alert-danger':errors.has('name')}"
                            name="name"
                            type="text"
                            id="Name"
                            placeholder="Кабинет..."
                            class="form-control"
                            v-model="classroom.name"
                        >
                        <span v-show="errors.has('name')" class="help is-danger">{{ errors.first('name') }}</span>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block mt-4">Добавить</button>
        </form>
    </div>
</template>

<script>
    export default {
        name: "CreateClassroom",
        data(){
            return {
                routes:{
                    classroomStore: '/admin/super/classroom'
                },
                classroom:{
                    name:''
                }
            }
        },
        methods: {
            sendClassroom() {
                console.log(this.user);
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        axios.post(this.routes.classroomStore, this.classroom)
                            .then((response) => {
                                if (response.data.response == 'created') {

                                    this.$toaster.success('Кабинет успешно добавлен');
                                    document.location.href = "/admin/super/classroom"
                                }
                                else if (response.data.response == 'nameDuplicate') {

                                    this.$toaster.warning('Кабинет уже существует');
                                }
                                else {

                                    this.$toaster.error('Ошибка');
                                }
                                console.log(response);

                            })
                            .catch(e => {
                                this.$toaster.error(e.response.data.message);
                            })

                    }
                    else {
                        this.$toaster.warning("Заполните все поля!");
                    }
                })

            }
        }
    }
</script>

<style scoped>
    .form_container {
        padding: 25px;
        border:1px solid grey;
        margin-bottom:30px;
        border-radius:10px;
    }
    .title {
        font-size: 30px;
    }
    .is-danger {
        color: red;
    }
    .alert-danger{
        border:1px solid red!important;
    }
</style>
