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
                                <option v-for="grade in grades" :value="grade.id">{{grade.name}}</option>
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
                <template v-slot:thead-top="data">
                    <b-tr>
                        <b-th></b-th>
                        <b-th v-for="date in dateForWeek['currentWeek']" :key="date.key">
                            <span class="d-flex justify-content-center">{{date}}</span>
                        </b-th>
                    </b-tr>
                </template>
                <template v-slot:empty="scope">
                    <span class="d-flex justify-content-center">Нет записей</span>
                </template>
                <template v-slot:cell(monday)="row">
                    <div  :class="(teacher.includes(row.value.subject_user_id) && dateNow<dateForWeek['timestamp'][0])?'lesson':''">
                        <div class="d-flex row">
                            <div class="col-6 ">
                                <b-button  v-if="(!row.value.description&&teacher.includes(row.value.subject_user_id))
                                     && (dateNow<dateForWeek['timestamp'][0])"
                                           @click="OpenModal(dateForWeek['currentWeek'][0],'Понедельник','monday',row.item.lesson,row.value.subject_user_id)"
                                           variant="primary"><b-icon-plus-square-fill></b-icon-plus-square-fill>
                                </b-button>
                                <div class="d-flex ">
                                    <a class="edit" v-if="(row.value.description&&teacher.includes(row.value.subject_user_id)) && (dateNow<dateForWeek['timestamp'][0])"
                                       :href="'/admin/teacher/homework/'+row.value.idHomeWork+'/edit'">
                                        <b-icon-pencil-square></b-icon-pencil-square>
                                    </a>
                                </div>
                            </div>
                            <div class="col-6 d-flex justify-content-end ">
                                <div class="ok" v-if="(row.value.description&&teacher.includes(row.value.subject_user_id)) && (dateNow<dateForWeek['timestamp'][0])"><b-icon-check-circle></b-icon-check-circle></div>
                            </div>
                        </div>
                        <span class="d-block text-center">{{row.value.subject}}</span>
                        <span class="d-block text-center">{{row.value.surname}} {{row.value.name}} {{row.value.patronymic}}</span>
                        <span class="d-block text-center">{{ row.value.classroom}}</span>
                    </div>
                </template>
                <template v-slot:cell(tuesday)="row">
                    <div  :class="(teacher.includes(row.value.subject_user_id) && dateNow<dateForWeek['timestamp'][1])?'lesson':''">
                        <div class="d-flex row">
                            <div class="col-6 ">
                                <b-button  v-if="(!row.value.description&&teacher.includes(row.value.subject_user_id))
                                     && (dateNow<dateForWeek['timestamp'][1])"
                                           @click="OpenModal(dateForWeek['currentWeek'][1],'Вторник','tuesday',row.item.lesson,row.value.subject_user_id)"
                                           variant="primary"><b-icon-plus-square-fill></b-icon-plus-square-fill>
                                </b-button>
                                <div class="d-flex ">
                                    <a class="edit" v-if="(row.value.description&&teacher.includes(row.value.subject_user_id)) && (dateNow<dateForWeek['timestamp'][1])"
                                       :href="'/admin/teacher/homework/'+row.value.idHomeWork+'/edit'">
                                        <b-icon-pencil-square></b-icon-pencil-square>
                                    </a>
                                </div>
                            </div>
                            <div class="col-6 d-flex justify-content-end ">
                                <div class="ok" v-if="(row.value.description&&teacher.includes(row.value.subject_user_id)) && (dateNow<dateForWeek['timestamp'][1])"><b-icon-check-circle></b-icon-check-circle></div>
                            </div>
                        </div>
                        <span class="d-block text-center">{{row.value.subject}}</span>
                        <span class="d-block text-center">{{row.value.surname}} {{row.value.name}} {{row.value.patronymic}}</span>
                        <span class="d-block text-center">{{ row.value.classroom}}</span>
                    </div>
                </template>
                <template v-slot:cell(wednesday)="row">
                    <div  :class="(teacher.includes(row.value.subject_user_id) && dateNow<dateForWeek['timestamp'][2])?'lesson':''">
                        <div class="d-flex row">
                            <div class="col-6 ">
                                <b-button  v-if="(!row.value.description&&teacher.includes(row.value.subject_user_id))
                                     && (dateNow<dateForWeek['timestamp'][2])"
                                           @click="OpenModal(dateForWeek['currentWeek'][2],'Среда','wednesday',row.item.lesson,row.value.subject_user_id)"
                                           variant="primary"><b-icon-plus-square-fill></b-icon-plus-square-fill>
                                </b-button>
                                <div class="d-flex ">
                                    <a class="edit" v-if="(row.value.description&&teacher.includes(row.value.subject_user_id)) && (dateNow<dateForWeek['timestamp'][2])"
                                       :href="'/admin/teacher/homework/'+row.value.idHomeWork+'/edit'">
                                        <b-icon-pencil-square></b-icon-pencil-square>
                                    </a>
                                </div>
                            </div>
                            <div class="col-6 d-flex justify-content-end ">
                                <div class="ok" v-if="(row.value.description&&teacher.includes(row.value.subject_user_id)) && (dateNow<dateForWeek['timestamp'][2])"><b-icon-check-circle></b-icon-check-circle></div>
                            </div>
                        </div>
                        <span class="d-block text-center">{{row.value.subject}}</span>
                        <span class="d-block text-center">{{row.value.surname}} {{row.value.name}} {{row.value.patronymic}}</span>
                        <span class="d-block text-center">{{ row.value.classroom}}</span>
                    </div>
                 </template>
                <template  v-slot:cell(thursday)="row">
                    <div  :class="(teacher.includes(row.value.subject_user_id) && dateNow<dateForWeek['timestamp'][3])?'lesson':''">
                        <div class="d-flex row">
                            <div class="col-6 ">
                                <b-button  v-if="(!row.value.description&&teacher.includes(row.value.subject_user_id))
                                     && (dateNow<dateForWeek['timestamp'][3])"
                                           @click="OpenModal(dateForWeek['currentWeek'][3],'Четверг','thursday',row.item.lesson,row.value.subject_user_id)"
                                           variant="primary"><b-icon-plus-square-fill></b-icon-plus-square-fill>
                                </b-button>
                                <div class="d-flex ">
                                    <a class="edit" v-if="(row.value.description&&teacher.includes(row.value.subject_user_id)) && (dateNow<dateForWeek['timestamp'][3])"
                                       :href="'/admin/teacher/homework/'+row.value.idHomeWork+'/edit'">
                                        <b-icon-pencil-square></b-icon-pencil-square>
                                    </a>
                                </div>
                            </div>
                            <div class="col-6 d-flex justify-content-end ">
                                <div class="ok" v-if="(row.value.description&&teacher.includes(row.value.subject_user_id)) && (dateNow<dateForWeek['timestamp'][3])"><b-icon-check-circle></b-icon-check-circle></div>
                            </div>
                        </div>
                        <span class="d-block text-center">{{row.value.subject}}</span>
                        <span class="d-block text-center">{{row.value.surname}} {{row.value.name}} {{row.value.patronymic}}</span>
                        <span class="d-block text-center">{{ row.value.classroom}}</span>
                    </div>
                </template>
                <template  v-slot:cell(friday)="row">
                    <div  :class="(teacher.includes(row.value.subject_user_id)&& dateNow<dateForWeek['timestamp'][4])?'lesson':''">
                        <div class="d-flex row">
                            <div class="col-6 ">
                                <b-button  v-if="(!row.value.description&&teacher.includes(row.value.subject_user_id))
                                     && (dateNow<dateForWeek['timestamp'][4])"
                                           @click="OpenModal(dateForWeek['currentWeek'][4],'Пятница','friday',row.item.lesson,row.value.subject_user_id)"
                                           variant="primary">
                                    <b-icon-plus-square-fill></b-icon-plus-square-fill>
                                </b-button>
                                <div class="d-flex ">
                                    <a class="edit" v-if="(row.value.description&&teacher.includes(row.value.subject_user_id)) && (dateNow<dateForWeek['timestamp'][4])"
                                       :href="'/admin/teacher/homework/'+row.value.idHomeWork+'/edit'">
                                        <b-icon-pencil-square></b-icon-pencil-square>
                                    </a>
                                </div>
                            </div>
                            <div class="col-6 d-flex justify-content-end ">
                                <div class="ok" v-if="(row.value.description&&teacher.includes(row.value.subject_user_id)) && (dateNow<dateForWeek['timestamp'][4])"><b-icon-check-circle></b-icon-check-circle></div>
                            </div>
                        </div>
                        <span class="d-block text-center">{{row.value.subject}}</span>
                        <span class="d-block text-center">{{row.value.surname}} {{row.value.name}} {{row.value.patronymic}}</span>
                        <span class="d-block text-center">{{ row.value.classroom}}</span>
                    </div>
                </template>
                <template  v-slot:cell(saturday)="row">
                    <div  :class="(teacher.includes(row.value.subject_user_id) && dateNow<dateForWeek['timestamp'][5])?'lesson':''">
                        <div class="d-flex row">
                            <div class="col-6 ">
                                <b-button  v-if="(!row.value.description&&teacher.includes(row.value.subject_user_id))
                                     && (dateNow<dateForWeek['timestamp'][5])"
                                           @click="OpenModal(dateForWeek['currentWeek'][5],'Суббота','saturday',row.item.lesson,row.value.subject_user_id)"
                                           variant="primary">
                                    <b-icon-plus-square-fill></b-icon-plus-square-fill>
                                </b-button>
                                <div class="d-flex ">
                                    <a class="edit" v-if="(row.value.description&&teacher.includes(row.value.subject_user_id)) && (dateNow<dateForWeek['timestamp'][5])"
                                       :href="'/admin/teacher/homework/'+row.value.idHomeWork+'/edit'">
                                        <b-icon-pencil-square></b-icon-pencil-square>
                                    </a>
                                </div>
                            </div>
                            <div class="col-6 d-flex justify-content-end ">
                                <div class="ok" v-if="(row.value.description&&teacher.includes(row.value.subject_user_id)) && (dateNow<dateForWeek['timestamp'][5])"><b-icon-check-circle></b-icon-check-circle></div>
                            </div>
                        </div>
                        <span class="d-block text-center">{{row.value.subject}}</span>
                        <span class="d-block text-center">{{row.value.surname}} {{row.value.name}} {{row.value.patronymic}}</span>
                        <span class="d-block text-center">{{ row.value.classroom}}</span>
                    </div>
                </template>
            </b-table>
        </b-container>
        <div>
            <add-homework @hide="show=$event"
                :timetable="timetableData"
                :id="teacher"
                @homeWork="RefreshTimetable($event)"
                :visible="show">
            </add-homework>
        </div>
    </div>
</template>

<script>
    export default {
    name: "IndexHomework",
    props:['grades','params'],
     data(){
        return {
            timetableData:
                {   lesson:'',
                    grade_id:'none',
                    semester:'none',
                    rowDay:'',
                    day:'',
                    beginWeek:'',
                    endWeek:"",
                    id:''

                },
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
            teacher:'',
            show:false,
            showCell:true,
            dateNow:'',
            dateForWeek:{},
            days:['monday','tuesday','wednesday','thursday','friday','saturday']
        }
     },
        methods:{
            RefreshTimetable(homework)
            {
                this.items[homework.lesson-1][homework.dayRow].idHomeWork=(homework.id)?homework.id:0;
                this.items[homework.lesson-1][homework.dayRow].description=(homework.description)?homework.description:'';
                this.$refs.table.refresh();
            },
            OpenModal: function (date,day,rowDay,number,id) {
                this.timetableData.rowDay=rowDay;
                this.timetableData.day=day;
                this.timetableData.date=date;
                this.timetableData.lesson=number;
                this.timetableData.id=id;
                this.show=true;
            },
            SendData(){
                this.$validator.validateAll().then((result) => {
                    if (result) {

                        if(this.timetableData['grade_id']==this.lastMeaningGrade&&this.timetableData['semester']==this.lastMeaningSemester)
                        {
                            this.$toaster.info('Вы уже выбрали расписание для этого класса', {timeout: 5000})
                        }
                        else {
                            let getHomeWork={};
                            this.lastMeaningGrade=this.timetableData['grade_id'];
                            this.lastMeaningSemester=this.timetableData['semester'];
                            getHomeWork={
                                'grade_id': this.timetableData.grade_id,
                                'semester':this.timetableData.semester,
                                'begin':this.timetableData.beginWeek,
                                'end':this.timetableData.endWeek
                            }
                            console.log(getHomeWork);
                            axios.post('/admin/teacher/homework/indexTimetable', getHomeWork)
                                .then((response) => {

                                    if (response.data.result=='OK') {
                                        console.log(response.data);
                                        this.items=response.data['timetable'];
                                        this.teacher=response.data['teacher'];
                                        this.isVisible=1;
                                        console.log(this.teacher);
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
            getNow() {

                let currentWeek=[];
                let timestamp=[];
                let nowDate = new Date();
                nowDate.setDate(nowDate.getDate()-nowDate.getDay());
                for(let i=1;i<7;i++){
                    let param =new Date(nowDate.setDate(nowDate.getDate()+1))
                    let day = param.getDate()<10?'0'+param.getDate():param.getDate();
                    let month = param.getMonth()+1<10?'0'+(param.getMonth()+1):param.getMonth()+1;
                    let year = param.getFullYear();
                    timestamp.push(+new Date(param));
                    currentWeek.push(day+"."+month+"."+year)
                }
                return {'currentWeek':currentWeek,'timestamp':timestamp};
                }
        }
        ,computed:{

        },
        mounted() {
            this.totalRows = this.items.length

            this.totalRows = this.items.length

            this.getNow();
        },
        created() {
            console.log(this.params);
            console.log(this.grades)

            this.dateNow=+new Date()+60000;
            this.dateForWeek=this.getNow();
            this.timetableData.beginWeek=this.dateForWeek['currentWeek'][0];
            this.timetableData.endWeek=this.dateForWeek['currentWeek'][5];

            this.timetableData['grade_id']=(this.params['grade'])?this.params['grade']:"none";
            this.timetableData['semester']=(this.params['semester'])?this.params['semester']:"none"
            if (this.timetableData['grade_id']!='none'&&this.timetableData['semester']!='none')
            {
                this.SendData();
            }
            // console.log(this.timetableData['grade_id'])
            // console.log(this.timetableData['semester'])

        }
    }
</script>

<style scoped>
    .disabled{

    }
    .btn .b-icon.bi{
        font-size: 80%;
    }
    .active{
        color: blue;
    }
    .ok{
       color:#228B22;
        font-size:24px;
        padding-right: 5px;
    }
    .edit
    {
        font-size:24px;
        padding-left: 5px;
    }
    .is-danger {
        color: #ff0000;
    }
    .alert-danger{
        border:2px solid #ff0000;
    }
    table a{
        text-decoration: none;
    }
    .lesson{
        border:3px dashed darkslategrey;
    }
    .form-container {
        max-width:700px;
    }
</style>
