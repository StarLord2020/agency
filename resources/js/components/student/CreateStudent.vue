<template>
    <div class="form_container">
        <form class="form-horizontal" role="form" @submit.prevent="createStudent">
            <span class="d-block mb-4 title">Добавление ученика</span>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-4">
                        <label>Ученик</label>
                    </div>
                    <div class="col-sm-8">
                        <v-select
                            v-validate="'required'"
                            :class="{'input': true, 'alert-danger':errors.has('name')}"
                            name="name"
                            v-model="student.user_id"
                            :options="students"
                            :reduce="student => student.id"
                            label="fullName"
                        >
                            <template v-slot:no-options="{ search, searching }">
                                <template v-if="searching">
                                    Совпадений не найдено
                                </template>
                                <em style="opacity: 0.5;" v-else>Start typing to search for a country.</em>
                            </template>
                        </v-select>
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
        name: "CreateStudent",
        props:['students','grade'],
        data(){
            return {
                student:{
                    user_id:'',
                    grade_id:this.grade.id
                }
            }
        },
        methods: {
            createStudent() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        console.log(this.student)
                        axios.post('/admin/super/student', this.student)
                            .then((response) => {

                                if (response.data.response == 'created') {

                                    this.$toaster.success('Запись успешно добавлена');
                                    document.location.href = "/admin/super/student/index/"+this.grade.id+'/'+this.grade.name;
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
    .is-danger {
        color: red;
    }
    .alert-danger{
        border:1px solid red!important;
    }
    .form_container {
        padding: 25px;
        border:1px solid grey;
        margin-bottom:30px;
        border-radius:10px;
    }
    .title {
        font-size: 30px;
    }
</style>
