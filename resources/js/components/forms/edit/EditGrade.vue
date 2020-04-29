<template>
    <div class="form_container">
        <form class="form-horizontal" role="form" @submit.prevent = "updateGrade">
            <span class="d-block mb-4 title">Редактирование класса</span>
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
                            v-model="editGrade.name"
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
                            v-model="editGrade.user_id"
                            :options="teachersClassrooms.users"
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
                            v-model="editGrade.classroom_id"
                            :options="teachersClassrooms.classrooms"
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
            <button type="submit" class="btn btn-primary btn-block">Редактировать</button>
        </form>
    </div>
</template>

<script>
    export default {
        name: "EditGrade",
        props: ['teachers-classrooms','grade'],
        data() {
            return {
                editGrade:{}
            }
        },
        created() {
            this.editGrade = this.grade;
            this.editGrade.classroom_id="";
            this.editGrade.user_id="";
        },
        methods: {
            updateGrade() {

                this.$validator.validateAll().then((result) => {
                    if (result) {
                        axios.put('/admin/super/grade/' + this.grade.id, this.editGrade)
                            .then((response) => {
                                if (response.data.response == 'updated') {

                                    this.$toaster.success('Данные успешно отредактированы');
                                    document.location.href = "/admin/super/grade"
                                }
                                else {

                                    this.$toaster.error('Ошибка');
                                }
                                console.log(response);

                            })
                            .catch(e => {
                                console.log(e);

                                this.$toaster.warning('Запись уже существует');
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
