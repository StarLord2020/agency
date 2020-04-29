<template>
    <b-modal
            no-close-on-backdrop
            no-close-on-esc
            size="md"
            v-model="show"
            :id="modal_id"
            title="Cоздание домашнего задания">
        <b-container fluid>
            {{Show}}
            <div class="form-group row mb-1">
                <label for="name_id" class="col-sm-4 col-form-label">Тема</label>
                <div class="col-sm-8">
                    <input :class="{'input': true, 'alert-danger':errors.has('name')}"
                           class="form-control"
                           v-validate="reactiveRules?'required':''" v-model="name" id="name_id" :name="'name'"
                           placeholder="Название домашней работы..."
                           type="text">
                    <div v-if="errors.has('name')" class="help is-danger ">{{ errors.first('name') }}</div>
                </div>
            </div>
            <div class="form-group row mb-1">
                <label for="description_id" class="col-sm-4 col-form-label">Описание</label>
                <div class="col-sm-8">
                    <textarea :class="{'input': true, 'alert-danger':errors.has('description')}"
                           class="form-control"
                           v-validate="reactiveRules?'required':''"
                              v-model="description" id="description_id" :name="'description'"
                           placeholder="Описание домашней работы..."
                           type="text">
                    </textarea>
                    <div v-if="errors.has('description')" class="help is-danger ">{{ errors.first('description') }}</div>
                </div>
            </div>
            <b-button @click="Cancel"variant="outline-light" class=" cross"><b-icon-x-square></b-icon-x-square></b-button>
        </b-container>
        <template v-slot:modal-footer>
            <div class="w-100">

                <b-button
                        squared variant="dark"
                        size="md"
                        class="float-left"
                        @click="Cancel()"
                >
                    Закрыть
                </b-button>
                <b-button
                        squared variant="warning"
                        size="md"
                        class="float-right"
                        @click="AddLesson()"
                >
                    Добавить
                </b-button>
            </div>
        </template>
    </b-modal>
</template>

<script>
    export default {
        name: "AddHomework",
        props:['timetable','visible','id'],
        data(){
            return{
                reactiveRules:false,
                name:'',
                description:'',
                show:false,
                modal_id:"modal"
            }
        },
        methods:{
            Cancel() {
                this.show=false;
                this.Refresh();
                this.$emit('hide', false)
            },
            DateForDb(date){

            },
            SendHomeForTable(homeWork){
                this.$emit('homeWork', homeWork);
            },
            Refresh()
            {
                this.name='',
                 this.description='',
                this.reactiveRules=false;
            },
            AddLesson(){
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        let homework={};

                            homework = {
                                'subject_user_id':this.timetable.id,
                                'day':this.timetable.day,
                                'lesson':this.timetable.lesson,
                                'grade_id':this.timetable.grade_id,
                                'deadline': this.timetable.date,
                                'semester':this.timetable.semester,
                                'name': this.name,
                                'description':this.description,
                            }
                        axios.post('/admin/teacher/homework/StoreHomeWork', homework)
                            .then((response) => {

                                if (response.data[0]=='OK') {
                                    this.$toaster.success('Расписание успешно добавленно');
                                    let homeWork = {
                                        'id':response.data[1],
                                        'lesson':this.timetable.lesson,
                                        'dayRow': this.timetable.rowDay,
                                        'description':this.description,
                                    }
                                    this.SendHomeForTable(homeWork);
                                    this.Cancel();
                                }
                                else {
                                }
                            })
                            .catch(e => {
                            })
                    }
                    else{
                        this.$toaster.warning('Будьте внимательны при заполнении полей', {timeout: 5000})
                    }
                })
            }
        },
        computed:{
            Show(){
                this.show=this.visible;
                this.reactiveRules=this.show;
            }
        },
        updated(){
        }
    }
</script>

}
<style scoped>
    .cross{
        position: absolute;
        width: 60px;
        height: 62px;
        background: #fff;
        top: -63px;
        right: 0px;
        color:#FF0000;
        border:none;
    }
    .is-danger {
        color: red;
    }
    textarea {
        height: 200px!important;
        resize: none;
    }
    .alert-danger {
        border: 2px solid red !important;
    }
</style>
