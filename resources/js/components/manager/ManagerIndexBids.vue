<template>
    <div class="bides_container mx-auto">
        <div class="bid border pb-2" v-for="(bid,index) in bidList">
            <a href="" class="d-block">
                <span class="status d-block mb-2"><b class="mr-3">Специальность:</b>{{bid.specialty}}</span>
                <span class="position d-block mb-2 mt-2"><b class="mr-3">Должность:</b>{{bid.position}}</span>
                <span class="company d-block mb-2"><b class="mr-3">Предприятие:</b> {{bid.company}}</span>
                <span class="address d-block mb-2"><b class="mr-3">Адресс:</b>{{bid.address}}</span>
                <span class="salary d-block mb-2"><b class="mr-3">Зароботная плата:</b>{{bid.salary}}</span>
                <span class="description d-block mb-2"><b class="mr-3">Описание:</b>{{bid.description|cutText(195)}}</span>
                <span class="status d-block mb-2"><b class="mr-3">Статус:</b>{{bid.name}}</span>
            </a>
            <publish-refuse  @delete="deleteRecord(bidList,$event)" :index="index" :id="bid.id" :route="route"></publish-refuse>
        </div>
    </div>
</template>

<script>

    export default {
        name: "IndexBids",
        props:['bids'],
        data() {
            return {
                route:'/manager/bids/',
                bidList:''
            }
        },
        filters: {
            cutText(value, symbolsCount) {
                return value.length > symbolsCount
                    ? value.slice(0, symbolsCount - 3) + '...'
                    : value;
            }
        },
        methods:{
            deleteRecord(array,item)
            {
                console.log(item);
                console.log(array,23213);
               array.splice(item,1)
            },

        },
        created() {
            this.bidList=this.bids
        }

    }
</script>

<style scoped>
    .bides_container {
        max-width:700px;
        /*border: 1px solid gray;*/
        border-radius: 3px;
    }
    .bid {
        padding: 0 15px;
    }
    .bid:hover {
        border: 1px solid gray!important;
    }
    a {
        text-decoration:none;
        color:black;
    }
    .edit {
        color:#fff;
    }
</style>
