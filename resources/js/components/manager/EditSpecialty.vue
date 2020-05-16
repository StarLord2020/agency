<template>
    <div class="form_container">
        <form class="form-horizontal" role="form" @submit.prevent="updateSubject">
            <span class="d-block mb-4 title">Редактирование предмета</span>
            <div class="form-group">
                <div class="row">
                    <label for="Name" class="col-sm-4 control-label">Предмет</label>
                    <div class="col-sm-8">
                        <input
                            v-validate="'required|max:20'"
                            :class="{'input': true, 'alert-danger':errors.has('name')}"
                            type="text"
                            name="name"
                            id="Name"
                            placeholder="Предмет..."
                            class="form-control"
                            v-model="editSpecialty.name"
                        >
                        <span v-show="errors.has('name')" class="help is-danger">{{ errors.first('name') }}</span>
                        <span v-if="nameErr&&duplicateName==editSpecialty.name" class="is-danger">{{nameErr}}</span>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block mt-4">Редактировать</button>
        </form>
    </div>
</template>

<script>
    export default {
        name: "EditSubject",
        props:['specialty'],
        data(){
            return {
                editSpecialty:{},
                nameErr:'',
                duplicateName:''
            }
        },
        created(){
            this.editSpecialty = this.specialty[0];
            console.log( this.editSpecialty);
        },
        methods:{
            updateSubject(){
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        console.log(this.editSpecialty);
                        axios.put('/manager/specialties/'+ this.editSpecialty.id, this.editSpecialty)
                            .then((response) => {
                                if (response.data.response == 'updated') {

                                    this.$toaster.success('Данные успешно отредактированы');
                                    document.location.href = "/manager/specialties"}
                                else {

                                    this.$toaster.error('Ошибка');
                                }
                            })
                            .catch(e => {
                                console.log(e.response.data.errors);
                                if(e.response.data.errors.name[0]){
                                    this.duplicateName=this.editSpecialty.name;
                                    this.nameErr='Запись уже существует';
                                    this.$toaster.warning(e.response.data.errors.name[0]);
                                }
                                else {
                                    this.$toaster.error(e.response.data.errors);
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
