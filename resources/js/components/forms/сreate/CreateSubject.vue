<template>
    <div class="form_container">
        <form class="form-horizontal" role="form" @submit.prevent="sendSubject">
            <span class="d-block mb-4 title">Добавление предмета</span>
            <div class="form-group">
                <div class="row">
                    <label for="Name" class="col-sm-4 control-label">Предмет</label>
                    <div class="col-sm-8">
                        <input
                            v-validate="'required'"
                            :class="{'input': true, 'alert-danger':errors.has('name')}"
                            type="text"
                            name="name"
                            id="Name"
                            placeholder="Предмет..."
                            class="form-control"
                            v-model="subject.name"
                        >
                        <span v-show="errors.has('name')" class="help is-danger">{{ errors.first('name') }}</span>
                        <span v-if="nameErr&&duplicateName==subject.name" class="is-danger">{{nameErr}}</span>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block mt-4">Добавить</button>
        </form>
    </div>
</template>

<script>
    export default {
        name: "CreateSubject",
        props:['teachers'],
        data(){
            return {
               subject:{
                   name:'',
               },
                nameErr:'',
                duplicateName:''
            }
        },
        created(){
            console.log(this.teachers);
        },
        methods: {
            sendSubject() {
                console.log(this.subject);
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        axios.post('/admin/super/subject', this.subject)
                            .then((response) => {
                                if (response.data.response == 'created') {

                                    this.$toaster.success('Предмет успешно добавлен');
                                    document.location.href = "/admin/super/subject"
                                }
                                else if (response.data.response == 'duplicate') {
                                    this.duplicateName=this.subject.name;
                                    this.nameErr='Предмет уже добавлен';
                                    this.$toaster.warning('Предмет уже добавлен');
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
