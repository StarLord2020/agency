<template>
    <div class="container">
        <div class="containerForm">
            <div class="border-form">
                <form @submit.prevent="SendData" class="">
                    <div class="form-group row mb-1">
                        <label for="name_id" class="col-sm-4 col-form-label">Тема</label>
                        <div class="col-sm-8">
                            <input :class="{'input': true, 'alert-danger':errors.has('name')}"
                                   class="form-control"
                                   v-validate="'required'" v-model="homeWork.name" id="name_id" :name="'name'"
                                   placeholder="Название домашней работы..."
                                   type="text">
                            <div v-if="errors.has('name')" class="help is-danger ">{{ errors.first('name') }}</div>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="description_id" class="col-sm-4 col-form-label">Описание</label>
                        <div class="col-sm-8">
                        <textarea :class="{'input': true, 'alert-danger':errors.has('description')}"
                                  class="form-control"
                                  v-validate="'required'"
                                  v-model="homeWork.description" id="description_id" :name="'description'"
                                  placeholder="Описание домашней работы..."
                                  type="text">
                        </textarea>
                            <div v-if="errors.has('description')" class="help is-danger ">{{ errors.first('description') }}</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 col-md-8"><button type="submit"  class="btn btn-info">Редактировать</button></div>
                        <div class="col-6 col-md-4"><button type="button" class="btn btn-danger" @click="deleleteHomeWork">Удалить</button></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "EditHomeWork",
        props:['homework'],
        data(){
            return{
                homeWork:
                    {
                        name:"",
                        description:""
                    },
            }
        },
        methods: {
        SendData() {
            this.$validator.validateAll().then((result) => {
                if (result) {
                    let homework={};
                        homework = {
                            'name':this.homeWork.name,
                            'description':this.homeWork.description
                            }
                            console.log(homework)
                            axios.put('/admin/teacher/homework/'+this.homework.id, homework)
                                .then((response) => {
                                    if (response.data.response=='updated') {
                                        this.$toaster.success('Запись успешно изменина');
                                        document.location.href = "/admin/teacher/homework/index/"+this.homework['grade_id']+"/"+this.homework['semester'];
                                    }
                                })
                                .catch(e => {
                                })

                             }
                    else
                        {

                        this.$toaster.warning('Будьте внимательны при заполнении полей', {timeout: 5000})
                    }
                })
            },
        deleleteHomeWork() {
                this.$bvModal.msgBoxConfirm('Вы действительно хотите удалить запись?', {
                    size: 'sm',
                    buttonSize: 'md',
                    okVariant: 'danger',
                    okTitle: 'Да',
                    cancelTitle: 'Отмена',
                    footerClass: 'p-2',
                    hideHeaderClose: false,
                    centered: true
                })
                    .then(value => {

                        if (value){

                            axios.delete('/admin/teacher/homework/'+this.homework.id).then((response) =>{
                                if(response.data.response=='deleted')
                                {
                                    this.$toaster.success("Запись успешно удалена");
                                    document.location.href = "/admin/teacher/homework/index/"+this.homework['grade_id']+"/"+this.homework['semester'];
                                }

                            }).catch(e => {
                                this.$toaster.error("Пользователь не найден");

                            });
                        }
                    })
                    .catch(err => {

                    })
            },
        },
        computed :{

        },
        created() {
            this.homeWork['name']=this.homework.name;
            this.homeWork['description']=this.homework.description;
        },
    }
</script>
<style scoped>
    .is-danger {
        color: red;
    }
    .containerForm {
        max-width: 500px;
        margin: 0 auto;
    }
    .border-form {
        max-width: 450px;
        padding:25px;
        border: 1px dashed black;
    }
    form{
        margin-top:55px;

    }
</style>
