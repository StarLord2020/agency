<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">
    <div class="form_container">
        <form class="form-horizontal" role="form" @submit.prevent = "sendGrade">
            <span class="d-block mb-4 title">Добавление класса</span>
            <div class="form-group">
                <div class="row">
                    <label for="Name" class="col-sm-4 control-label">Название класса</label>
                    <div class="col-sm-8">
                        <input
                            v-validate="'required'"
                            :class="{'input': true, 'alert-danger':errors.has('name')}"
                            type="text"
                            name="name"
                            id="Name"
                            placeholder="Класс..."
                            class="form-control"
                            v-model="grade.name"
                        >
                        <span v-show="errors.has('name')" class="help is-danger">{{ errors.first('name') }}</span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-4">
                        <label>Руководитель</label>
                    </div>
                    <div class="col-sm-8">
                        <v-select
                            v-model="grade.user_id"
                            :options="this.classroomsAndTeachers.users"
                            :reduce="teacher => teacher.id"
                            label="fullName"
                        >
                            <template v-slot:no-options="{ search, searching }">
                                <template v-if="searching">
                                    Совпадений не найдено
                                </template>
                                <em style="opacity: 0.5;" v-else>Нет элементов</em>
                            </template>
                        </v-select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-4">
                        <label>Укажите кабинет</label>
                    </div>
                    <div class="form-group col-sm-8">
                        <v-select
                            v-model="grade.classroom_id"
                            :options="this.classroomsAndTeachers.classrooms"
                            :reduce="teacher => teacher.id"
                            label="name"
                        >
                            <template v-slot:no-options="{ search, searching }">
                                <template v-if="searching">
                                    Совпадений не найдено
                                </template>
                                <em style="opacity: 0.5;" v-else>Нет элементов</em>
                            </template>
                        </v-select>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Добавить</button>
        </form>
    </div>
</template>



<script>

    export default {
        name: "CreateGrade",
        props:['classrooms-and-teachers'],
        created(){
          console.log(this.classroomsAndTeachers)
        },
        data(){
            return {
                grade:{
                    name:'',
                    user_id:'',
                    classroom_id:'',
                },
            }
        },
        methods: {
            sendGrade() {
                console.log(this.grade);
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        axios.post('/admin/super/grade', this.grade)
                            .then((response) => {
                                if (response.data.response == 'created') {

                                    this.$toaster.success('Класс успешно добавлен');
                                    document.location.href = "/admin/super/grade"
                                }
                                else if (response.data.response == 'duplicate') {

                                    this.$toaster.warning('Класс уже добавлен');
                                }
                                else {

                                    this.$toaster.error('Ошибка');
                                }
                                console.log(response);

                            })
                            .catch(e => {
                                console.log(e);
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
