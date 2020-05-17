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
                    <div class="chart-container mt-3">
                        <pie-chart></pie-chart>
                    </div>
                </div>
            </div>
            <div class="col-6">

            </div>
        </div>
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
        mounted () {
            this.renderChart({
                labels: ['VueJs', 'EmberJs', 'ReactJs', 'AngularJs'],
                datasets: [
                    {
                        backgroundColor: [
                            '#41B883',
                            '#E46651',
                            '#00D8FF',
                            '#DD1B16'
                        ],
                        data: [4000, 20, 80, 10]
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

    })

    export default {
        props:['top-specialty-bids','top-specialty-resumes'],
        name: "Statistic",
        data(){
            return {
                bidsTitle:'Специальности по количеству вакансий',
                resumesTitle:'Специальности по количеству резюме',
                specialties:[],
                specialty_id:''
            }
        },
        methods:{
            getSpecialties() {
                axios.get('/specialties', this.resume)
                    .then((response) => {
                        console.log(response.data)
                        this.specialties = response.data;
                    })
                    .catch(e => {
                        console.log(e);
                    })
            },
            getSpecialtyStatistic(specialty){
                axios.get('/statistic/'+specialty, this.resume)
                    .then((response) => {
                        console.log(response.data)

                    })
                    .catch(e => {
                        console.log(e);
                    })
            }
        },
        watch:{
            specialty_id(){
                this.getSpecialtyStatistic(this.specialty_id);
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
.chart-container:hover
{
    box-shadow: 0 0 10px rgba(0,0,0,0.6);
}
</style>
