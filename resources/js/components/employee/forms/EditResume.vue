<template>
    <div class="container">
        <div class="form-container mx-auto mt-2">
            <form @submit.prevent="addResume">
                <span class="title d-block mb-3">Резюме</span>
                <div class="form-group">
                    <div class="row">
                        <label for="education" class="col-sm-4 control-label">Образование</label>
                        <div class="col-sm-8">
                            <input
                                v-validate="'required|max:50'"
                                :class="{'input': true, 'alert-danger':errors.has('education')}"
                                name="education"
                                type="text"
                                id="education"
                                placeholder="Образование"
                                class="form-control"
                                v-model = "resume.education"
                            >
                            <span v-show="errors.has('education')" class="help is-danger">{{errors.first('education')}}</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4">
                            <label>Специальность</label>
                        </div>
                        <div class="form-group col-sm-8 m-0">
                            <v-select
                                v-validate="'required'"
                                name = "specialty"
                                v-model="resume.specialty_id"
                                :options="specialty"
                                :reduce="specialty => specialty.id"
                                label="name"
                            >
                                <template v-slot:no-options="{ search, searching }">
                                    <template v-if="searching">
                                        Совпадений не найдено
                                    </template>
                                    <em style="opacity: 0.5;" v-else>Нет элементов</em>
                                </template>
                            </v-select>
                            <span v-show="errors.has('specialty')" class="help is-danger">{{errors.first('specialty')}}</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="experience" class="col-sm-4 control-label">Стаж</label>
                        <div class="col-sm-8">
                            <input
                                v-validate="'required|max:200'"
                                :class="{'input': true, 'alert-danger':errors.has('experience')}"
                                name="experience"
                                type="text"
                                id="experience"
                                placeholder="Стаж"
                                class="form-control"
                                v-model="resume.experience"
                            >
                            <span v-show="errors.has('experience')" class="help is-danger">{{ errors.first('experience')}}</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-md-4 control-label" for="skills">Навыки</label>
                        <div class="col-md-8">
                            <textarea
                                v-validate="'required|max:2500'"
                                :class="{'input': true, 'alert-danger':errors.has('skills')}"
                                name="skills"
                                class="form-control"
                                id="skills"
                                placeholder="Навыки"
                                v-model="resume.skills"
                            >
                            </textarea>
                            <span v-show="errors.has('skills')" class="help is-danger">{{ errors.first('skills') }}</span>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block mt-4">Редактировать</button>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        name: "EditResume",
        props:['specialty','old-resume'],
        data() {
            return {
                resume: {
                    education:'',
                    specialty_id:'',
                    experience:'',
                    skills:''
                }
            }
        },
        created() {
            this.resume = this.oldResume;
        },
        methods: {
            addResume() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        axios.put('/employee/resume/'+this.resume.id, this.resume)
                            .then((response) => {
                                if (response.data.response === 'updated') {

                                    document.location.href = "/employee/employee-resume";
                                }
                                else {
                                    this.$toaster.error('Ошибка');
                                }
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
    .form-container {
        max-width: 600px;
        padding: 25px;
        border: 1px gray solid;
        border-radius:7px;
    }
    .title {
        font-size: 30px;
    }
    textarea {
        height: 195px!important;
        resize: none!important;
    }
    label {
        font-size: 16px;
    }
    form {
        margin:0;
    }
</style>
