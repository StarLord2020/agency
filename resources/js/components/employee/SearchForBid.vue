<template>
    <div class="bides_container mx-auto">
        <div class="search pt-4 pb-4 border">
            <div class="row">
                <div class="col-2">
                   <span class="d-block mt-1">Поиск</span>
                </div>
                <div class="col-5">
                    <div class="form-group">
                        <v-select
                            v-model="search.specialty_id"
                            :options="specialty"
                            :reduce="specialty => specialty.name"
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
                    </div>
                </div>
                <div class="col-5">
                    <input
                        name="address"
                        type="text"
                        placeholder="Город..."
                        class="form-control city"
                        v-model = "search.city"
                    >
                </div>
            </div>
        </div>
        <div class="border search pt-4 pb-4" v-if="!bids.length">
            <span>Нет вакансий...</span>
        </div>
            <a
                :href="'/employee/watch-bid/'+bid.id"
                class="d-block bid border pb-2"
                v-for="bid in bids"
                v-if ="(search.specialty_id?bid.specialty==search.specialty_id:true)&&(search.city?bid.address==search.city:true)"
            >
                <span class="position d-block mb-2 mt-2"><b class="mr-3">Должность:</b>{{bid.position}}</span>
                <span class="position d-block mb-2 mt-2"><b class="mr-3">Специальность:</b>{{bid.specialty}}</span>
                <span class="company d-block mb-2"><b class="mr-3">Предприятие:</b> {{bid.company}}</span>
                <span class="address d-block mb-2"><b class="mr-3">Адресс:</b>{{bid.address}}</span>
                <span class="salary d-block mb-2"><b class="mr-3">Зароботная плата:</b>{{bid.salary}}</span>
                <span class="description d-block mb-2"><b class="mr-3">Описание:</b>{{bid.description|cutText(195)}}</span>
            </a>

    </div>
</template>

<script>
    export default {
        name: "SearchForBid",
        props:['bids','specialty'],
        data() {
            return {
               search:{
                   city:null,
                   specialty_id:null
               },
            }
        },
        filters: {
            cutText(value, symbolsCount) {
                return value.length > symbolsCount
                    ? value.slice(0, symbolsCount - 3) + '...'
                    : value;
            }
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
    .search {
        padding-left:15px;
        padding-right:15px;
    }
    .city::placeholder {

        color:black;
    }
    .city {
        height:35px;
    }
</style>
