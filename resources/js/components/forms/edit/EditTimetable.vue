<template>
    <div class="container">
        <div class="containerForm">
            <form @submit.prevent="SendData" class="">
                <div class="form-group row">
                    <label class="mx-auto col-form-label col-form-label-lg text-center">Редактиррование урока</label>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-4 col-form-label">№ Урока</label>
                    <div class="col-sm-8">
                        <label >{{this.rec.lesson}}</label>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="subject_id" class="col-sm-4 col-form-label">Выберите предмет</label>
                    <div class="col-sm-8">
                        <select v-model="timetableData['currentSubject']"
                                :name="'subject'"
                                id="subject_id"
                                class="form-control"
                                v-validate="'required'"
                                :class="{'input': true, 'alert-danger':errors.has('subject')}">
                            <option v-for="subject in db['subjects']"
                                    :value="subject.id">
                                {{subject.name}}
                            </option>
                        </select>
                        <span v-if="errors.has('subject')" class="d-block help is-danger">Поле обязательно для заполнения</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="teacher_id" class="col-sm-4 col-form-label">Выберите преподователя</label>
                    <div class="col-sm-8">
                        <select v-model="timetableData['currentTeacher']"
                                :name="'teacher'"
                                id="teacher_id"
                                class="form-control"
                                v-validate="'required'"
                                :class="{'input': true, 'alert-danger':errors.has('teacher')}">
                            <option v-for="teacher in db['teachers']"
                                    v-if="timetableData['currentSubject']==teacher.subject_id"
                                    :value="teacher.id">
                                     {{teacher.surname}} {{teacher.name}} {{teacher.patronymic}}
                            </option>
                        </select>
                        <span v-if="errors.has('teacher')" class="d-block help is-danger">Поле обязательно для заполнения</span>
                        <span v-if="duplicateTeacher['lesson']" class=" d-block help is-danger">У этого преподователя уже есть занятие на этом уроке</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="classroom_id" class="d-block col-sm-4 col-form-label">Выберите класс</label>
                    <div class="col-sm-8">
                        <select :name="'classroom'"
                                class="form-control"
                                id="classroom_id"
                                v-model="timetableData['classroom_id']"
                                v-validate="'required'"
                                :class="{'input': true, 'alert-danger':errors.has('classroom')}">
                            <option v-for="classroom in db['classrooms']" :value="classroom.id">{{classroom.name}}</option>
                        </select>
                        <span v-if="errors.has('classroom')" class="d-block help is-danger">Поле обязательно для заполнения</span>
                        <span v-if="duplicateClassroom['lesson']" class="d-block help is-danger">Кабинет занят</span>
                    </div>
                </div>
                <button type="submit"  class=" btn btn-danger ok ">Редактировать</button>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        name: "EditTimetable",
        props:['db','rec'],
        data(){
            return{
                timetableData:
                    {
                        currentSubject:'',
                        currentTeacher:"",
                        classroom_id:'',
                    },

                counter:1,
                duplicateTeacher:{
                    'lesson':'',
                },
                duplicateClassroom:{
                    'lesson':'',
                }
                }
        },
        methods: {
            SendData() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                            let lesson={};
                            if(this.timetableData['currentSubject']!='-')
                            {
                                if (this.timetableData['currentTeacher']!=this.db['info'][0].id
                                    || this.timetableData['currentSubject']!=this.db['info'][0].subject_id
                                    || this.timetableData['classroom_id']!=this.rec.classroom_id) {
                                    lesson = {
                                        'lesson':this.rec.lesson,
                                        'day': this.rec.day,
                                        'grade_id': this.rec.grade_id,
                                        'subject_user_id': this.timetableData['currentTeacher'],
                                        'classroom_id': this.timetableData['classroom_id'],
                                        'semester': this.rec.semester
                                    }

                                    axios.put('/admin/teacher/head-teacher/timetable/'+this.rec.id, lesson)
                                        .then((response) => {
                                            if (response.data.result=='OK') {
                                                this.$toaster.success('Запись успешно изменина');
                                                document.location.href = "/admin/teacher/head-teacher/timetable/index/"+lesson['grade_id']+"/"+lesson['semester'];
                                            }
                                            else {

                                                if (Object.keys(response.data.duplicateTeacher).length > 0) {

                                                    this.duplicateTeacher['lesson'] = response.data.duplicateTeacher['lesson'+this.rec.lesson];
                                                }
                                                 if (Object.keys(response.data.duplicateClassroom).length > 0) {

                                                    this.duplicateClassroom['lesson'] = response.data.duplicateClassroom['lesson'+this.rec.lesson];
                                                }
                                            }
                                        })
                                        .catch(e => {
                                        })
                                    }
                                else {
                                    this.$toaster.info('Вы не внесли изменений', {timeout: 5000})
                                }
                            }
                        }
                    else{
                        this.$toaster.warning('Будьте внимательны при заполнении полей', {timeout: 5000})
                    }
                })

            }
        },
        computed :{
           trackSubject()
            {
                if(this.timetableData['currentSubject']!=this.db['info'][0].subject_id)
                this.timetableData['currentTeacher']='none';
            }
        },
        created() {

            this.timetableData['currentTeacher']=this.db['info'][0].id;
            this.timetableData['currentSubject']=this.db['info'][0].subject_id;
            this.timetableData['classroom_id']=this.rec.classroom_id;
        },
        updated() {
        }

    }
</script>
<style scoped>
    .is-danger {
        color: red;
    }
    .containerForm {
        max-width: 750px;
        margin: 0 auto;
    }
</style>
