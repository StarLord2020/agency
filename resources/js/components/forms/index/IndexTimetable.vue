<template>
    <div>
        <div class="container-fluid">
            <form method="get" @submit.prevent="SendData">
                <div class="form-container">
                    <div class="row">
                        <div class="col-5">
                            <select class="form-control input" v-model="timetableData.grade_id"  name="grade"
                                    v-validate="'required|excluded:none|integer'"
                                    :class="{'input': true, 'alert-danger':errors.has('grade')}">
                                <option value="none">Выберите класс</option>
                                <option v-for="grade in teachersAndSubjects['grades']" :value="grade.id">{{grade.name}}</option>
                            </select>
                            <span v-if="errors.has('grade')" class="help is-danger">{{ errors.first('grade') }}</span>
                        </div>
                        <div class="col-5">
                            <select class="form-control input" v-model="timetableData.semester" name="semester"
                                    v-validate="'required|excluded:none|integer'"
                                    :class="{'input': true, 'alert-danger':errors.has('semester')}">
                                <option value="none">Выберите семестр</option>
                                <option >1</option>
                                <option>2</option>
                            </select>
                            <span v-if="errors.has('semester')" class="help is-danger">{{ errors.first('semester') }}</span>
                        </div>
                        <div class="col-2">
                           <b-button  variant="info" type="submit">Выбрать</b-button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    <b-container fluid >
        <b-table
            bordered
            show-empty
            small
            stacked="md"
            :items="items"
            :fields="fields"
            ref="table">
            <template v-slot:empty="scope">
                <span class="d-flex justify-content-center">Нет записей</span>
            </template>
            <template v-slot:cell(monday)="row">
                <div class="d-flex justify-content-start">
                    <b-button variant="danger" @click="deleleteLesson(row.value.id,row.index,'monday')" v-if="row.value.subject" class="mr-3"><b-icon-trash-fill></b-icon-trash-fill></b-button>
                    <b-button v-if="!row.value.subject" @click="OpenModal('Понедельник',row.item.lesson,'monday')" variant="primary"><b-icon-plus-square-fill></b-icon-plus-square-fill></b-button>
                </div>
                <a :href="'/admin/teacher/head-teacher/timetable/'+row.value.id+'/edit'">
                    <span class="d-block text-center">{{row.value.subject}}</span>
                    <span class="d-block text-center">{{row.value.surname}} {{row.value.name}} {{row.value.patronymic}}</span>
                    <span class="d-block text-center">{{ row.value.classroom}}</span>
                </a>
            </template>
            <template v-slot:cell(tuesday)="row">
                <div class="d-flex justify-content-start">
                    <b-button variant="danger" @click="deleleteLesson(row.value.id,row.index,'tuesday')" v-if="row.value.subject" class="mr-3"><b-icon-trash-fill></b-icon-trash-fill></b-button>
                    <b-button  v-if="!row.value.subject" @click="OpenModal('Вторник',row.item.lesson,'tuesday')" variant="primary"><b-icon-plus-square-fill></b-icon-plus-square-fill></b-button>
                </div>
                <a :href="'/admin/teacher/head-teacher/timetable/'+row.value.id+'/edit'">
                    <span class="d-block text-center">{{row.value.subject}}</span>
                    <span class="d-block text-center">{{row.value.surname}} {{row.value.name}} {{row.value.patronymic}}</span>
                    <span class="d-block text-center">{{ row.value.classroom}}</span>
                </a>
            </template>
            <template v-slot:cell(wednesday)="row">
                <div class="d-flex justify-content-start">
                    <b-button variant="danger" @click="deleleteLesson(row.value.id,row.index,'wednesday')" v-if="row.value.subject" class="mr-3"><b-icon-trash-fill></b-icon-trash-fill></b-button>
                    <b-button  v-if="!row.value.subject" @click="OpenModal('Среда',row.item.lesson,'wednesday')" variant="primary"><b-icon-plus-square-fill></b-icon-plus-square-fill></b-button>
                </div>
                <a :href="'/admin/teacher/head-teacher/timetable/'+row.value.id+'/edit'">
                    <span class="d-block text-center">{{row.value.subject}}</span>
                    <span class="d-block text-center">{{row.value.surname}} {{row.value.name}} {{row.value.patronymic}}</span>
                    <span class="d-block text-center">{{ row.value.classroom}}</span>
                </a>
            </template>
            <template  v-slot:cell(thursday)="row">
                <div class="d-flex justify-content-start">
                    <b-button  variant="danger" @click="deleleteLesson(row.value.id,row.index,'thursday')" v-if="row.value.subject" class="mr-3"><b-icon-trash-fill></b-icon-trash-fill></b-button>
                    <b-button  v-if="!row.value.subject" @click="OpenModal('Четверг',row.item.lesson,'thursday')" variant="primary"><b-icon-plus-square-fill></b-icon-plus-square-fill></b-button>
                </div>
                <a :href="'/admin/teacher/head-teacher/timetable/'+row.value.id+'/edit'"><span class="d-block text-center">{{row.value.subject}}</span>
                    <span class="d-block text-center">{{row.value.surname}} {{row.value.name}} {{row.value.patronymic}}</span>
                    <span class="d-block text-center">{{ row.value.classroom}}</span>
                </a>
            </template>
            <template  v-slot:cell(friday)="row">
                <div class="d-flex justify-content-start">
                    <b-button  variant="danger"@click="deleleteLesson(row.value.id,row.index,'friday')" v-if="row.value.subject" class="mr-3"><b-icon-trash-fill></b-icon-trash-fill></b-button>
                    <b-button v-if="!row.value.subject" @click="OpenModal('Пятница',row.item.lesson,'friday')" variant="primary"><b-icon-plus-square-fill></b-icon-plus-square-fill></b-button>
                </div>
                <a :href="'/admin/teacher/head-teacher/timetable/'+row.value.id+'/edit'">
                    <span class="d-block text-center">{{row.value.subject}}</span>
                    <span class="d-block text-center">{{row.value.surname}} {{row.value.name}} {{row.value.patronymic}}</span>
                   <span class="d-block text-center">{{ row.value.classroom}}</span>
                </a>
            </template>
            <template  v-slot:cell(saturday)="row">
                <div class="d-flex justify-content-start">
                    <b-button variant="danger" @click="deleleteLesson(row.value.id,row.index,'saturday')" v-if="row.value.subject" class="mr-3"><b-icon-trash-fill></b-icon-trash-fill></b-button>
                    <b-button v-if="!row.value.subject" @click="OpenModal('Суббота',row.item.lesson,'saturday')" variant="primary"><b-icon-plus-square-fill></b-icon-plus-square-fill></b-button>
                </div>
                <a :href="'/admin/teacher/head-teacher/timetable/'+row.value.id+'/edit'">
                    <span class="d-block text-center">{{row.value.subject}}</span>
                    <span class="d-block text-center">{{row.value.surname}} {{row.value.name}} {{row.value.patronymic}}</span>
                    <span class="d-block text-center">{{ row.value.classroom}}</span>
                </a>
            </template>
        </b-table>
    </b-container>

        <div>
            <add-lesson @hide="show=$event" :teachers-and-subjects="teachersAndSubjects"
                        :timetable="timetableData"
                        :visible="show"
                        @lesson="RefreshTimetable($event)"
            ></add-lesson>
        </div>
    </div>
</template>
<script>

    export default {
        name: "IndexTimetable",
        props:['teachers-and-subjects','params'],
        data(){
            return {
                timetableData:
                    {   lesson:'',
                        grade_id:'',
                        day:'',
                        semester:'',
                        rowDay:''
                    },
                counter:1,
                request:{},
                items:[],
                lesson: {
                },
                isVisible:"",
                fields: [
                    { key: 'lesson', label: '№ урока' ,class: 'text-center'},
                    { key: 'monday', label: 'Понедельник' ,class: 'text-center'},
                    { key: 'tuesday', label: 'Вторник' ,class: 'text-center'},
                    { key: 'wednesday', label: 'Среда' ,class: 'text-center'},
                    { key: 'thursday', label: 'Четверг' ,class: 'text-center'},
                    { key: 'friday', label: 'Пятница' ,class: 'text-center'},
                    { key: 'saturday', label: 'Суббота' ,class: 'text-center'},
                ],
                totalRows: 1,
                currentPage: 1,
                perPage: 8,
                show:false,
            }
        },
        methods:{
            RefreshTimetable(lesson)
            {
                this.items[lesson.lesson-1][lesson.dayRow]={
                    'id':lesson.id,
                    'classroom':lesson.classroom,
                    'subject':lesson.subject,
                    'name':lesson.name,
                    'surname':lesson.surname,
                    'patronymic':lesson.patronymic
                };
                this.show=lesson.show;
                this.$refs.table.refresh();
            },
            SendData(){
                this.$validator.validateAll().then((result) => {
                    if (result) {

                        if(this.timetableData['grade_id']==this.lastMeaningGrade&&this.timetableData['semester']==this.lastMeaningSemester)
                        {
                            this.$toaster.info('Вы уже выбрали расписание для этого класса', {timeout: 5000})

                        }
                        else {
                            this.lastMeaningGrade=this.timetableData['grade_id'];
                            this.lastMeaningSemester=this.timetableData['semester'];
                        axios.post(window.routes['admin.teacher.head-teacher.timetable.indexTimetable'], this.timetableData)
                            .then((response) => {
                                if (response.data.result=='OK') {
                                    this.items=response.data.timetable;
                                    this.isVisible=1;
                                }
                            })
                            .catch(e => {
                                this.$toaster.error(e.response.data.message);
                            })
                        }
                    }

                    else{

                        this.$toaster.warning('Будьте внимательны при заполнении полей', {timeout: 5000})
                    }
                })
            },
            deleleteLesson(id,index,day) {
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

                            axios.delete('/admin/teacher/head-teacher/timetable/'+id).then((response) =>{
                                if(response.data.response=='deleted')
                                {
                                    this.items[index][day]=null;
                                    this.$refs.table.refresh();
                                    this.$toaster.success("Запись успешно удалена");

                                }

                            }).catch(e => {
                                this.$toaster.error("Пользователь не найден");

                            });
                        }
                    })
                    .catch(err => {

                    })
            },
            OpenModal: function (day,number,rowDay) {
                this.timetableData.rowDay=rowDay;
                this.timetableData.day=day;
                this.timetableData.lesson=number;
                this.show=true;
            },
        },
        computed: {
        },
        mounted() {
            this.totalRows = this.items.length

        },
        created() {
            this.timetableData['grade_id']=(this.params['grade'])?this.params['grade']:"none";
            this.timetableData['semester']=(this.params['semester'])?this.params['semester']:"none"
            if (this.timetableData['grade_id']!='none'&&this.timetableData['semester']!='none')
            {
                this.SendData();
            }
        }
    }
</script>

<style scoped>

    .btn .b-icon.bi{
        font-size: 80%;
    }
    .is-danger {
        color: red;
    }
    .alert-danger{
        border:2px solid red!important;
    }
    table a{
        text-decoration: none;
    }
    .form-container {
        max-width:700px;
    }
</style>
