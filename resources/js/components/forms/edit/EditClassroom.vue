<template>
    <div class="form_container">
        <form class="form-horizontal" @submit.prevent = "updateClassroom">
            <span class="d-block mb-4 title">Редактирование кабинета</span>
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
                            v-model="editClassroom.name"
                        >
                        <span v-show="errors.has('name')" class="help is-danger">{{ errors.first('name') }}</span>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block mt-4">Редактировать</button>
        </form>
    </div>
</template>

<script>
    export default {
        name: "EditClassroom",
        props:['classroom'],
        data() {
            return {
                editClassroom: {}
            }
        },
        created() {

            this.editClassroom = this.classroom;
        },
        methods: {
            updateClassroom() {

                this.$validator.validateAll().then((result) => {
                    if (result) {
                        axios.put('/admin/super/classroom/' + this.classroom.id, this.editClassroom)
                            .then((response) => {
                                if (response.data.response == 'updated') {

                                    this.$toaster.success('Данные успешно отредактированы');
                                    document.location.href = "/admin/super/classroom"
                                }
                                else if (response.data.response == 'duplicate') {

                                    this.$toaster.warning('Запись уже существует');
                                }
                                else {

                                    this.$toaster.error('Ошибка');
                                }
                                console.log(response);

                            })
                            .catch(e => {
                                console.log(e);
                                if(e.response.data.errors.name[0]) {
                                    this.$toaster.warning(e.response.data.errors.name[0]);
                                }
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
