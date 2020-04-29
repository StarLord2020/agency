<template>
    <div class="container">
        <div class="containerForm">
            <form @submit.prevent="SendData" class="">
                <div class="form-group row">
                    <label class="mx-auto col-form-label col-form-label-lg text-center">Создание расписания</label>
                </div>
                <div class="form-group row">
                    <label for="day_id" class="col-sm-4 col-form-label">Выберите день</label>
                    <div class="col-sm-8">
                        <select name="day"
                                class="form-control"
                                v-model="timetableData.day"
                                v-validate="'required|excluded:none'"
                                id="day_id" :class="{'input': true, 'alert-danger':errors.has('day')}">
                             <option value="none">Выберите день недели</option>
                             <option v-for="day in days">{{day}}</option>
                         </select>
                         <span v-if="errors.has('day')" class="help is-danger">{{ errors.first('day') }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="grade_id" class="col-sm-4 col-form-label">Выберите класс</label>
                    <div class="col-sm-8">
                        <select name="grade"
                                v-model="timetableData.grade_id"
                                v-validate="'required|excluded:none'"
                                class="form-control"
                                id="grade_id"
                                :class="{'input': true, 'alert-danger':errors.has('grade')}">
                             <option value="none">Выберите класс</option>
                             <option v-for="grade in teachersAndSubjects['grades']" :value="grade.id">{{grade.name}}</option>
                         </select>
                         <span v-if="errors.has('grade')" class="help is-danger">{{ errors.first('grade') }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="semester_id" class="col-sm-4 col-form-label">Выберите семестер</label>
                    <div class="col-sm-8">
                        <select name="semester"
                                id="semester_id"
                                class="form-control"
                                v-model="timetableData.semester"
                                 v-validate="'required|excluded:none'"
                                 :class="{'input': true, 'alert-danger':errors.has('semester')}">
                             <option value="none">Выберите семестр</option>
                             <option >1</option>
                             <option >2</option>
                         </select>
                         <span v-if="errors.has('semester')" class="help is-danger">{{ errors.first('semester') }}</span>
                        <span v-if="errors.has('grade_id')" class="help is-danger">{{ errors.first('grade_id') }}</span>
                    </div>
                </div>
                <div class="form-row border border-dark">
                    <div class="col-md-1 pb-2">
                        <span >Урок</span>
                    </div>
                    <div class="col-md-4 pb-2">
                        <span >Предмет</span>
                    </div>
                    <div class="col-md-4 pb-2">
                        <span >Преподователь</span>
                    </div>
                    <div class="col-md-3 mb-2">
                        <span >Класс</span>
                    </div>
                </div>
                <div class="form-row border border-dark">
                     <div class="col-12 " v-if="n<=counter" v-for="n in 8">
                         <div class="form-row border border-dark">
                             <div class="col-md-1">
                                  <span :name="'lesson'+n">{{n}}</span>
                                  <input type="hidden" :name="'lesson'+n":value="n" >
                             </div>
                             <div class="col-md-4">
                                  <select v-model="timetableData['currentSubject'+n]"
                                          :name="'subject'+n"
                                          class="form-control"
                                          v-validate="'required|excluded:none'"
                                          :class="{'input': true, 'alert-danger':errors.has('subject'+n)}">
                                      <option value="none">Выберите предмет</option>
                                      <option value="-">Урока нет</option>
                                      <option v-for="subject in teachersAndSubjects['subjects']"
                                              :value="subject.id">
                                          {{subject.name}}
                                      </option>
                                  </select>
                                  <span v-if="errors.has('subject'+n)" class="d-block help is-danger">Поле обязательно для заполнения</span>
                             </div>
                             <template v-if="timetableData['currentSubject'+n]!='-'">
                                 <div class="col-md-4">
                                      <select
                                              v-model="timetableData['currentTeacher'+n]"
                                             :name="'teacher'+n"
                                              class="form-control"
                                              v-validate="'required|excluded:none'"
                                              :class="{'input': true, 'alert-danger':errors.has('teacher'+n)}">
                                          <option value="none">Выберите преподователя</option>
                                          <option v-for="teacher in teachersAndSubjects['teachers']"
                                                  v-if="timetableData['currentSubject'+n]==='none'|| timetableData['currentSubject'+n]==teacher.subject_id"
                                                  :value="teacher">
                                              {{teacher.surname}} {{teacher.name}} {{teacher.patronymic}}
                                          </option>
                                      </select>
                                      <span v-if="errors.has('teacher'+n)" class=" d-block help is-danger">Поле обязательно для заполнения</span>
                                      <span v-if="duplicateTeacher['lesson'+n]" class=" d-block help is-danger">У этого преподователя уже есть занятие на этом уроке</span>
                                 </div>
                                 <div class="col-md-3">
                                      <select
                                              :name="'classroom_id'+n"
                                              v-model="timetableData['classroom_id'+n]"
                                              v-validate="'required|excluded:none'"
                                              class="form-control"
                                              :class="{'input': true, 'alert-danger':errors.has('classroom_id'+n)}">
                                          <option value='none'>Выберите кабинет</option>
                                          <option v-for="classroom in teachersAndSubjects['classrooms']" :value="classroom.id">{{classroom.name}}</option>
                                      </select>
                                      <span v-if="errors.has('classroom_id'+n)" class=" d-block help is-danger">Поле обязательно для заполнения</span>
                                      <span v-if="duplicateClassroom['lesson'+n]" class=" d-block help is-danger">Кабинет занят</span>
                                 </div>
                             </template>

                         </div>
                     </div>
                </div>
                <div class="form-row mt-3">
                    <div class="col-4">
                        <button type="button"  class=" btn btn-danger ok " v-if="counter<8" @click="AddLesson">Добавить поле</button>
                    </div>
                    <div class="col-4">
                        <b-button type="button"  v-if="counter>1" @click="RemoveLesson">Убрать поле</b-button>
                    </div>
                </div>
                <b-button  class="btn btn-primary add mt-4" type="submit">Создать</b-button>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        name: "CreateTimetable.vue",
        props:['teachers-and-subjects'],
        data(){
            return {
                timetableData:
                {
                    currentSubject1:'none',
                    currentTeacher1:'none',
                    classroom_id1:'none',
                    grade_id:'none',
                    day:'none',
                    semester:'none',
                },
                counter:1,
                request:{},
                days:['Понедельник','Вторник','Среда','Четверг','Пятница','Суббота'],
                duplicateTeacher:{
                    'lesson1':'',
                    'lesson2':'',
                    'lesson3':'',
                    'lesson4':'',
                    'lesson5':'',
                    'lesson6':'',
                    'lesson7':'',
                    'lesson8':''
                },
                duplicateClassroom:{
                    'lesson1':'',
                    'lesson2':'',
                    'lesson3':'',
                    'lesson4':'',
                    'lesson5':'',
                    'lesson6':'',
                    'lesson7':'',
                    'lesson8':''
                }
            }
        },
        methods: {
            SendData() {
                for( let lesson in this.duplicateTeacher)
                {
                    this.duplicateTeacher[lesson]='';
                }
                for( let lesson in this.duplicateClassroom)
                {
                    this.duplicateClassroom[lesson]='';
                }
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        for ( let i=1;i<=this.counter;i++) {
                            let lesson={};
                            if(this.timetableData['currentSubject' + i]!='-')
                            {
                                lesson = {
                                    'lesson': i, 'day': this.timetableData.day,
                                    'grade_id': this.timetableData.grade_id,
                                    'subject_user_id':this.timetableData['currentTeacher'+i].id,
                                    'classroom_id':this.timetableData['classroom_id'+i],
                                    'semester': this.timetableData.semester
                                }
                                this.request[i] =lesson;
                            }
                        }
                             axios.post(window.routes['admin.teacher.head-teacher.timetable.store'], this.request)
                            .then((response) => {
                                if (response.data.result=='OK') {
                                    this.$toaster.success('Расписание успешно добавленно');

                                    document.location.href = "/admin/teacher/head-teacher/timetable/index/"+this.timetableData['grade_id']+"/"+this.timetableData['semester'];
                                }
                                else {
                                    if (response.data.result == 'isset') {

                                        this.Redirect();
                                    }
                                    else {
                                        if (Object.keys(response.data.duplicateTeacher).length > 0) {
                                            for (let i = 1; i <= 8; i++) {
                                                this.duplicateTeacher['lesson' + i] = response.data.duplicateTeacher['lesson' + i];

                                            }
                                        }
                                        if (Object.keys(response.data.duplicateClassroom).length > 0) {
                                            for (let i = 1; i <= 8; i++) {
                                                this.duplicateClassroom['lesson' + i] = response.data.duplicateClassroom['lesson' + i];
                                            }
                                        }
                                    }
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
            ,
            Redirect(){
                this.$bvModal.msgBoxConfirm('Расписание на этот день для этого класса уже есть,перейдите в раздел редактирования?', {
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
                        document.location.href = "/admin/teacher/head-teacher/timetable/index/"+this.timetableData['grade_id']+"/"+this.timetableData['semester'];
                    });
            },
            AddLesson() {
                this.counter++;
               let item=this.counter;
                this.timetableData['currentSubject'+item]='none';
                this.timetableData['currentTeacher'+item]='none';
                this.timetableData['classroom_id'+item]='none';
            },
            RemoveLesson(){
                let item=this.counter;
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
                                delete this.timetableData['currentSubject'+item]
                                && delete this.timetableData['currentTeacher'+item]
                                && delete this.timetableData['classroom_id'+item];
                                this.counter--;
                            }
                        });
                 }
        },
        created() {

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
    .ok{
        color: #fff;
        background-color: #dc3545;
        border-color: #dc3545;
    }
    .alert-danger{
        border:2px solid red!important;
    }
    .add {
        color: #fff;
        background-color: #3490dc;
        border-color: #3490dc;
    }
</style>
