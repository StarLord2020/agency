<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform" xmlns="http://www.w3.org/1999/html">
    <div>
        <div class="container">
            <transition :name="loaded?'fade':''">
                <div v-if="sideBar||!loaded" class="form_container mx-auto" :class="loaded?'side_bar':''">
                    <form @submit.prevent="getTimetable">
                        <div class="row">
                            <div class="col-sm-6"><span class="title d-flex d-sm-block mb-4 justify-content-center">Укажите класс</span></div>
                            <div class="col-sm-6">
                                <v-select
                                    v-model="grade.id"
                                    :options="grades"
                                    :reduce="grade => grade.id"
                                    label="name"
                                    name="grade"
                                    class="mb-4"
                                    v-validate="'required'"
                                    :class="{'input': true, 'alert-danger':errors.has('grade')}"
                                >
                                    <template v-slot:no-options="{ search, searching }">
                                        <template v-if="searching">
                                            Совпадений не найдено
                                        </template>
                                    </template>
                                    <template v-slot:no-options>
                                        Нет элементов
                                    </template>
                                </v-select>
                            </div>
                            <div class="col-sm-6"><span class="title d-flex d-sm-block mb-4 justify-content-center">Укажите семестр</span></div>
                            <div class="col-sm-6">
                                <select
                                    v-validate="'required'"
                                    :class="{'input': true, 'alert-danger':errors.has('semester')}"
                                    name="semester"
                                    id="inputState"
                                    class="form-control mb-4"
                                    v-model="grade.semester"
                                >
                                    <option selected value="">Семестр...</option>
                                    <option>1</option>
                                    <option>2</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <button
                                    type="submit"
                                    class="btn btn-primary btn-block"
                                    :disabled = '(oldGrade.id==grade.id&&oldGrade.semester==grade.semester)?true:false'
                                >
                                    Выбрать
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </transition>
        </div>
        <div v-if="loaded" class="side_bar_controll">
            <b-icon-box-arrow-right @click="sideBar=!sideBar" v-if="!sideBar" class="icon_controll"></b-icon-box-arrow-right>
            <b-icon-box-arrow-left @click="sideBar=!sideBar" v-if="sideBar" class="icon_controll"></b-icon-box-arrow-left>
        </div>
        <b-container fluid v-if="loaded">
            <b-table
                head-variant="light"
                show-empty
                small
                stacked="lg"
                :items="items"
                :fields="fields"
                ref="table"
                bordered
                class="mb-0 table"
            >
                <template v-slot:thead-top="data">
                    <b-tr>
                        <b-th></b-th>
                        <b-th v-for="date in dateNow" :key="date.key">
                            <span class="d-flex justify-content-center">{{date}}</span>
                        </b-th>
                    </b-tr>
                </template>


                <template v-slot:cell()="row">
                    <span class="d-flex justify-content-center align-items-center">{{row.value.Lesson}}</span>
                    <span class="d-flex justify-content-center">{{row.value.subject}}</span>
                    <span class="d-flex justify-content-center"> {{ row.value.classroom}}</span>
                    <span class="d-flex justify-content-center">{{row.value.surname}} {{row.value.name}} {{row.value.patronymic}}</span>
                </template>

                <template v-slot:cell(actions)="row">
                    <a
                        class="btn btn-primary edit"
                        v-if="routes.Edit"
                        :href="routes.Edit+row.item.id+'/edit'"
                    >
                        Редактировать
                    </a>
                    <template v-if="action">
                        <a class="btn btn-info edit" :href="action.route+row.item.id+'/'+row.item.name">{{action.content}}</a>
                    </template>
                    <b-button
                        @click="showMsgBoxDelete(row.item.id,row.index)"
                        size="sm"
                        class="btn btn-danger">
                        Удалить
                    </b-button>
                </template>
            </b-table>
        </b-container>
    </div>
</template>

<script>
    export default {
        name:'TableAdmin',
        props:['grades'],
        data() {
            return {
                grade:{
                    id:'',
                    semester:''
                },
                oldGrade: {
                    id:'#',
                    semester:'#'
                },
                loaded:false,
                sideBar:false,
                items:[],
                fields:[
                    {key:'lesson',label:'№ Урока',class: 'text-center'},
                    {key:'monday',label: 'Понедельник',class: 'text-center'},
                    {key:'tuesday',label: 'Вторник',class: 'text-center'},
                    {key:'wednesday',label: 'Среда',class: 'text-center'},
                    {key:'thursday',label: 'Четверг',class: 'text-center'},
                    {key:'friday',label: 'Пятница',class: 'text-center'},
                    {key:'saturday',label: 'Суббота',class: 'text-center'},
                    ],
                dateNow:[],
            }
        },
        methods: {
            getTimetable() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        axios.get('/student/timetable-index/'+this.grade.id+'/'+this.grade.semester, this.grade)
                            .then((response) => {
                                if (response.data.response == 'OK') {

                                    this.totalRows = this.items.length;
                                    this.dateNow=this.getNow();
                                    this.sideBar=false;
                                    this.items=response.data.timetable;
                                    this.loaded=true;
                                    this.oldGrade.id=this.grade.id;
                                    this.oldGrade.semester=this.grade.semester;
                                    this.$toaster.success('Расписание для выбраного класса');
                                    // document.location.href = "/admin/super/grade"
                                }
                                else if (response.data.response == 'duplicate') {

                                    this.$toaster.warning('Класс уже добавлен');
                                }
                                else {
                                    console.log(response)
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
            },
            getNow() {
                let currentWeek=[];
                let nowDate = new Date();
                nowDate.setDate(nowDate.getDate()-nowDate.getDay());
                for(let i=1;i<7;i++){
                    let param =new Date(nowDate.setDate(nowDate.getDate()+1))
                    let day = param.getDate()<10?'0'+param.getDate():param.getDate();
                    let month = param.getMonth()+1<10?'0'+(param.getMonth()+1):param.getMonth()+1;
                    let year = param.getFullYear();

                    currentWeek.push(day+"."+month+"."+year)
                }

                return currentWeek;
            }
        },
    }
</script>

<style scoped>
    .form_container {
        padding: 25px;
        border:1px solid grey;
        margin-bottom:30px;
        border-radius:10px;
        max-width: 395px;

    }
    .title {
        font-size: 20px;
    }
    .is-danger {
        color: red;
    }
    .alert-danger{
        border:1px solid red!important;
    }
    .side_bar {
        position: fixed;
        z-index:1000;
        background: #fff;
        top:140px;
        left:0;

    }

    .fade-enter-active, .fade-leave-active {
        transition: opacity .9s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active до версии 2.1.8 */ {
        opacity: 0;
    }
    .icon_controll {
        width:30px;
        height: 30px;
        position: fixed;
        left :0;
        top:100px;
    }
</style>
