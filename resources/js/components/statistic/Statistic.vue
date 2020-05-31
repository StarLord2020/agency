<template>
    <div class="container">
        <div class="row">
            <div class="col-6">
                <div class="chart-container mb-5">
                    <line-chart :statistics="topSpecialtyBids" :title="bidsTitle"></line-chart>
                </div>
            </div>
            <div class="col-6">
                <div class="chart-container mb-5">
                    <line-chart :statistics="topSpecialtyResumes" :title="resumesTitle"></line-chart>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <div class="chart-container mt-3">
                        <div class="text-center title mb-4">Реализация вакансий по специальности</div>
                        <v-select
                            v-model="specialty_id"
                            :options="specialties"
                            :reduce="specialty => specialty.id"
                            label="name"
                            placeholder = "Специальность..."
                        >
                            <template v-slot:no-options="{ search, searching }">
                                <template v-if="searching">
                                    Совпадений не найдено
                                </template>
                                <em style="opacity: 0.5;" v-else>Нет элементов</em>
                            </template>
                        </v-select>
                         <div>
                            <pie-chart ref="bid" class="mt-4"></pie-chart>
                            <div class="text-center date mb-4">{{bidStatistic.date}}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <div class="chart-container mt-3">
                        <div class="text-center title mb-4">Статистика зарплаты по специальности</div>
                        <v-select
                            v-model="salary"
                            :options="specialties"
                            :reduce="specialty => specialty.id"
                            label="name"
                            placeholder = "Специальность..."
                        >
                            <template v-slot:no-options="{ search, searching }">
                                <template v-if="searching">
                                    Совпадений не найдено
                                </template>
                                <em style="opacity: 0.5;" v-else>Нет элементов</em>
                            </template>
                        </v-select>
                        <div>
                            <pie-chart-salary ref="salary" class="mt-4"></pie-chart-salary>
                            <div class="text-center date mb-4">{{salaryStatistic.date}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="/statistic/export"><img src="/images/export.png" alt="export" class="export"></a>
    </div>
</template>

<script>
    import VueChartJs from 'vue-chartjs'
    import { Bar, Line, Doughnut} from 'vue-chartjs'
    import 'chartjs-plugin-labels';

    Vue.component('line-chart', {
        extends: VueChartJs.Bar,
        props:['statistics','title'],
        mounted () {
            this.renderChart({
                labels: [this.statistics.date],
                datasets: [
                    {
                        label:this.statistics[0]?this.statistics[0].name:'',

                        backgroundColor: "rgb(255, 99, 132)",
                        data: [this.statistics[0]?this.statistics[0].total:'']
                    },
                    {
                        label: this.statistics[1]?this.statistics[1].name:'',

                        backgroundColor: "rgb(54, 162, 235)",
                        data: [this.statistics[1]?this.statistics[1].total:'']
                    },
                    {
                        label: this.statistics[2]?this.statistics[2].name:'',

                        backgroundColor: "rgb(255, 205, 86)",
                        data: [this.statistics[2]?this.statistics[2].total:'']
                    }
                ],
            },
            {responsive: true, maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            min:0,
                            fontSize: 16,
                            beginAtZero: true,
                            callback: function(value) {if (value % 1 === 0) {return value;}},
                        },
                    }],
                    xAxes: [{
                        ticks: {
                            fontSize: 16
                        },

                    }]
                },
                title: {
                    display: true,
                    text: this.title,
                    fontColor: "#9c002d",
                    fontSize:'20'
                },
                plugins: {
                    labels: false
                }
            }

            )
        },
    })
    Vue.component('pie-chart', {
        extends: VueChartJs.Doughnut,
         methods:{
            show (statistic) {
                console.log(statistic);
                 this.renderChart({
                     labels: ['Реализовано', 'Нереализовано'],
                     datasets: [
                         {
                             backgroundColor: [
                                 '#41B883',
                                 '#E46651',
                             ],
                             data: [statistic.success, statistic.cancel]
                         }
                     ]
                 }, {
                     responsive: true,
                     maintainAspectRatio: false,
                     pieceLabel: {
                         mode: 'percentage',
                     }
                 })
             }
         }
    })
    Vue.component('pie-chart-salary', {
        extends: VueChartJs.Doughnut,
        methods:{
            show (statistic) {
                console.log(statistic);
                this.renderChart({
                    labels: ['Максимальная', 'Средняя'],
                    datasets: [
                        {
                            backgroundColor: [
                                '#41B883',
                                '#E46651',
                            ],
                            data: [statistic.salaryMax, statistic.salaryAvg]
                        }
                    ]
                }, {
                    responsive: true,
                    maintainAspectRatio: false,
                    pieceLabel: {
                        mode: 'percentage',
                    }
                })
            }
        }
    })

    export default {
        props:['top-specialty-bids','top-specialty-resumes'],
        name: "Statistic",
        data(){
            return {
                bidsTitle:'Специальности по количеству вакансий',
                resumesTitle:'Специальности по количеству резюме',
                specialties:[],
                specialty_id:'',
                bidStatistic:[],
                salary:'',
                salaryStatistic:[]
            }
        },
        methods:{
            getSpecialties() {
                axios.get('/specialties')
                    .then((response) => {
                        console.log(response.data)
                        this.specialties = response.data;
                    })
                    .catch(e => {
                        console.log(e);
                    })
            },
            getSpecialtyStatistic(specialty){
                axios.get('/statistic/'+specialty)
                    .then((response) => {
                        this.bidStatistic=response.data;
                        console.log(this.bidStatistic);

                    })
                    .catch(e => {
                        console.log(e);
                    })
            },
            getStatisticSalary(specialty){
                axios.get('/statistic-salary/'+specialty)
                    .then((response) => {
                        this.salaryStatistic=response.data;
                        console.log(this.bidStatistic);

                    })
                    .catch(e => {
                        console.log(e);
                    })
            },
            showBid()
            {
                this.$refs.bid.show(this.bidStatistic);
            },
            showSalary()
            {
                this.$refs.salary.show(this.salaryStatistic);
            }
        },

        watch:{
            specialty_id(){
                this.getSpecialtyStatistic(this.specialty_id);

                setTimeout(()=>{
                    this.showBid()
                },900);
            },
            salary()
            {
                this.getStatisticSalary(this.salary);

                setTimeout(()=>{
                    this.showSalary()
                },900);
            }
        },
        created() {
            this.getSpecialties();
        }
    }
</script>

<style scoped>
.chart-container
{
    border:1px solid #cecece;
    padding:25px;
    box-shadow: 0 0 5px rgba(0,0,0,0.6);
}
.export {
    position: fixed;
    right:15px;
    top: 100px;
    width: 50px;
    height: 50px;
}
.export:hover {
    opacity: 0.94;
}
.chart-container:hover
{
    box-shadow: 0 0 10px rgba(0,0,0,0.6);
}
.title {
    font-size: 20px;
}
.date {
    font-size:16px;
}
</style>
