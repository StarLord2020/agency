<template>
    <div class="bides_container mx-auto">
        <div class="bid border pb-2" v-for="bidt in 10">
            <a href="" class="d-block">
                <span class="position d-block mb-2 mt-2"><b class="mr-3">Должгость:</b>{{bid[0].position}}</span>
                <span class="company d-block mb-2"><b class="mr-3">Предприятие:</b> {{bid[0].company}}</span>
                <span class="address d-block mb-2"><b class="mr-3">Адресс:</b>{{bid[0].address}}</span>
                <span class="salary d-block mb-2"><b class="mr-3">Зароботная плата:</b>{{bid[0].salary}}</span>
                <span class="description d-block mb-2"><b class="mr-3">Описание:</b>{{bid[0].description|cutText(195)}}</span>
                <span class="status d-block mb-2"><b class="mr-3">Статус:</b>{{bid[0].status}}</span>
            </a>
            <button class="edit btn btn-primary">Опубликовать</button>
            <button class="btn btn-danger">Отказать</button>
        </div>
    </div>
</template>

<script>
    export default {
        name: "IndexBids",
        data() {
            return {
                bid:[
                    {
                        position:'Продавец',
                        company:'NKMZ',
                        address:'Kramatorsk',
                        salary:'100000',
                        description:'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus debitis doloremque eligendi enim non odit\n' +
                            '    quaerat quasi, repellendus repudiandae rerum vel velit voluptas! Architecto nobis sed soluta, sunt vero\n' +
                            '    voluptatibus?',
                        status:'na rasmotreniy'
                    }
                ]
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
    .edit {
        color:#fff;
    }
</style>
