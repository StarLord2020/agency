<template>
    <div class="container">
        <div class="chart-container">
            <line-chart :top-specialty-bids="topSpecialtyBids"></line-chart>
        </div>
    </div>
</template>

<script>
    import VueChartJs from 'vue-chartjs'
    import { Bar, Line } from 'vue-chartjs'
    Vue.component('line-chart', {
        extends: VueChartJs.Bar,
        props:['top-specialty-bids'],
        mounted () {
            this.renderChart({
                labels: [this.topSpecialtyBids.date],
                datasets: [
                    {
                        label:this.topSpecialtyBids[0].name,

                        backgroundColor: "rgb(255, 99, 132)",
                        data: [this.topSpecialtyBids[0].total,]
                    },
                    {
                        label: this.topSpecialtyBids[1].name,

                        backgroundColor: "rgb(54, 162, 235)",
                        data: [this.topSpecialtyBids[1].total]
                    },
                    {
                        label: this.topSpecialtyBids[2].name,

                        backgroundColor: "rgb(255, 205, 86)",
                        data: [this.topSpecialtyBids[2].total]
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
                    text: "Востребованные специальности за месяц",
                    fontColor: "#9c002d",
                    fontSize:'20'
                },
            }

            )
        },
    })

    export default {
        props:['top-specialty-bids'],
        name: "Statistic",
        created() {
            console.log(this.topSpecialtyBids)
        }
    }
</script>

<style scoped>
.chart-container
{
    border:1px solid #284257;
    padding:25px;
    max-width: 390px;
    box-shadow: 0 0 10px rgba(0,0,0,0.7);
}
</style>
