<template>
    <div class="bides_container mx-auto">
        <div class="search pt-4 pb-4 border">
            <div>Ваше резюме</div>
        </div>
        <div class="resume border pb-2" v-if="resume">
            <a href="" class="d-block">
                <span class="d-block mb-2 mt-2"><b class="mr-3">Специальность:</b>{{resume.name}}</span>
                <span class="company d-block mb-2"><b class="mr-3">Образование:</b> {{resume.education}}</span>
                <span class="salary d-block mb-2"><b class="mr-3">Стаж:</b>{{resume.experience}}</span>
                <span class="description d-block mb-2"><b class="mr-3">Навыки:</b>{{resume.skills|cutText(195)}}</span>
            </a>
            <a href="" class="edit btn btn-primary">Редактировать</a>
            <button class="btn btn-danger">Удалить</button>
        </div>
        <div class="search pt-4 pb-4 border" v-if="!resume">
            <div>У вас еще нет резюме...</div>
        </div>
        <div class="search pt-4 pb-4 border">
            <div>Вашы предложения</div>
        </div>
        <div class="offers border pb-2"  v-for="bid in offers">
            <a href="" class="d-block">
                <span class="d-block mb-2 mt-2"><b class="mr-3">ФИО:</b>{{bid[0].fio}}</span>
                <span class="address d-block mb-2"><b class="mr-3">Адресс:</b>{{bid[0].address}}</span>
                <span class="salary d-block mb-2"><b class="mr-3">Контакты:</b>{{bid[0].contacts}}</span>
                <span class="description d-block mb-2"><b class="mr-3">Сообщение:</b>{{bid[0].description|cutText(195)}}</span>
            </a>
        </div>
        <div class="search pt-4 pb-4 border" v-if="!offers.length">
            <div>Предложений пока нет...</div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "EmployeeResume",
        props:['resume','offers'],
        data() {
            return {

                bid:[
                    // {
                    //     fio:'Petrov Aleks Semonovich',
                    //     address:'Kramatorsk',
                    //     contacts:'dd($this->skills)',
                    //     description:'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus debitis doloremque eligendi enim non odit\n' +
                    //         '    quaerat quasi, repellendus repudiandae rerum vel velit voluptas! Architecto nobis sed soluta, sunt vero\n' +
                    //         '    voluptatibus?'
                    // }
                ]
            }
        },
        filters: {
            cutText(value, symbolsCount) {
                return value.length > symbolsCount
                    ? value.slice(0, symbolsCount - 3) + '...'
                    : value;
            }
        },
        created() {
            console.log(this.resume)
            console.log(this.offers)
        }
    }
</script>

<style scoped>
    .bides_container {
        max-width:730px;
        border-radius: 3px;
        padding-left:15px;
        padding-right:15px;
    }
    .resume,.offers {
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

