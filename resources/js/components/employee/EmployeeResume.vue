<template>
    <div class="bides_container mx-auto">
        <div class="search pt-4 pb-4 border">
            <div>Ваше резюме</div>
        </div>
        <div class="resume border pb-2">
            <a href="" class="d-block">
                <span class="d-block mb-2 mt-2"><b class="mr-3">ФИО:</b>{{bid[0].fio}}</span>
                <span class="company d-block mb-2"><b class="mr-3">Образование:</b> {{bid[0].education}}</span>
                <span class="address d-block mb-2"><b class="mr-3">Адресс:</b>{{bid[0].address}}</span>
                <span class="salary d-block mb-2"><b class="mr-3">Опыт работы:</b>{{bid[0].expiriens}}</span>
                <span class="description d-block mb-2"><b class="mr-3">Навыки:</b>{{bid[0].scills|cutText(195)}}</span>
            </a>
        </div>
        <div class="search pt-4 pb-4 border">
            <div>Вашы предложения</div>
        </div>
        <div class="offers border pb-2" v-for="bidt in 10">
            <a href="" class="d-block">
                <span class="d-block mb-2 mt-2"><b class="mr-3">ФИО:</b>{{bid[0].fio}}</span>
                <span class="company d-block mb-2"><b class="mr-3">Образование:</b> {{bid[0].education}}</span>
                <span class="address d-block mb-2"><b class="mr-3">Адресс:</b>{{bid[0].address}}</span>
                <span class="salary d-block mb-2"><b class="mr-3">Опыт работы:</b>{{bid[0].expiriens}}</span>
                <span class="description d-block mb-2"><b class="mr-3">Навыки:</b>{{bid[0].scills|cutText(195)}}</span>
            </a>
        </div>
    </div>
</template>

<script>
    export default {
        name: "EmployeResume",
        data() {
            return {
                bid:[
                    {
                        fio:'Petrov Aleks Semonovich',
                        education:'NKMZ',
                        address:'Kramatorsk',
                        expiriens:'dd($this->skills)',
                        scills:'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus debitis doloremque eligendi enim non odit\n' +
                            '    quaerat quasi, repellendus repudiandae rerum vel velit voluptas! Architecto nobis sed soluta, sunt vero\n' +
                            '    voluptatibus?'
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
    .resume,offers {
        padding: 0 15px;
    }
    .resume:hover {
        border: 1px solid gray!important;
    }
    .offers:hover {
        border: 1px solid gray!important;
    }
    a {
        text-decoration:none;
        color:black;
    }
    .edit {
        color:#fff;
    }
    .search {
        padding-left:15px;
        padding-right:15px;
    }
</style>

