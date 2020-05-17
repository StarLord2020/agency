<template>
    <div class="form-container mx-auto">
        <form class="form-horizontal" role="form" @submit.prevent="sendSubject">
            <span class="d-block mb-4 title">Добавление специальности</span>
            <div class="form-group">
                <div class="row">
                    <label for="Name" class="col-sm-4 control-label">Специальность</label>
                    <div class="col-sm-8">
                        <input
                            v-validate="'required'"
                            :class="{'input': true, 'alert-danger':errors.has('name')}"
                            type="text"
                            name="name"
                            id="Name"
                            placeholder="Специальность..."
                            class="form-control"
                            v-model="spacialty.name"
                        >
                        <span v-show="errors.has('name')" class="help is-danger">{{ errors.first('name') }}</span>
                        <span v-if="nameErr&&duplicateName==spacialty.name" class="is-danger">{{nameErr}}</span>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block mt-4">Добавить</button>
        </form>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                spacialty:{
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
                console.log(this.spacialty);
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        axios.post('/manager/specialties', this.spacialty)
                            .then((response) => {
                                if (response.data.response == 'created') {

                                    document.location.href = "/manager/specialties"
                                }
                                else if (response.data.response == 'duplicate') {
                                    this.duplicateName=this.spacialty.name;
                                    this.nameErr='Специальность уже существует';
                                    this.$toaster.warning('Специальность уже существует');
                                }
                                else {

                                    this.$toaster.error('Ошибка');
                                }
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
    .form-container {
        max-width: 600px;
        padding: 25px;
        border: 1px gray solid;
        border-radius:7px;
    }
    .title {
        font-size: 30px;
    }
</style>
