<template>
    <div class="form_container">
        <form class="form-horizontal" role="form" @submit.prevent="createSubjectUser">
            <span class="d-block mb-4 title">Добавление преподавателя</span>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-4">
                        <label>Преподаватель</label>
                    </div>
                    <div class="col-sm-8">
                        <v-select
                            v-validate="'required'"
                            :class="{'input': true, 'alert-danger':errors.has('name')}"
                            name="name"
                            v-model="teacher.user_id"
                            :options="teachers"
                            :reduce="teacher => teacher.id"
                            label="fullName"
                        >
                            <template v-slot:no-options="{ search, searching }">
                                <template v-if="searching">
                                    Совпадений не найдено
                                </template>
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
        name: "CreateSubjectUser",
        props:['teachers','subject'],
        data(){
            return {
                teacher:{
                    user_id:'',
                    subject_id:this.subject.id
                }
            }
        },
        created(){
            console.log(this.subject);
        },
        methods: {
            createSubjectUser() {
                console.log(this.teacher);
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        axios.post('/admin/super/subject-user', this.teacher)
                            .then((response) => {
                                if (response.data.response == 'created') {

                                    this.$toaster.success('Преподаватель успешно добавлен');
                                    document.location.href = "/admin/super/subject-user/index/"+this.subject.id+'/'+this.subject.name;
                                }
                                else if (response.data.response == 'duplicate') {

                                    this.$toaster.warning('Преподаватель уже добавлен');
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
