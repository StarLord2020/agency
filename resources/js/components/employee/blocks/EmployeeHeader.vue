<template>
    <header>
        <nav class="navbar navbar-expand-md w-100" >
            <div class="row w-100">
                <div class="col-4">
                    <div>
                        <img class="logo" src="/images/employer/logo.png" alt="">
                    </div>
                </div>
                <div class="col-8">
                    <div class="d-flex justify-content-end">
                        <div class="collapse navbar-collapse" id="navbarsExample04">
                            <ul class="navbar-nav d-flex justify-content-end w-100 mt-2">
                                <li class="nav-item mr-5">
                                    <a class="nav-link" href="/employee/search-for-bid" >Поиск по вакансиям</a>
                                </li>
                                <li class="nav-item mr-5">
                                    <a class="nav-link" href="/employee/resumes">Ответы</a>
                                </li>
                                <li class="nav-item mr-5">
                                    <a class="nav-link" href="/employee/resume/create" >Создать резюме</a>
                                </li>
                                <li class="nav-item mr-5">
                                    <a class="nav-link" href="/employee/employee-resume">Резюме</a>
                                </li>
                            </ul>
                        </div>
                        <button class="navbar-toggler navbar-dark mt-2" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="logout mt-3" @click="logout()">Выйти</div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
</template>

<script>
    export default {
        name: "EmployeeHeader",
        methods:{
            logout(){
                axios.post('/logout')
                    .then((response)=>{
                    })
                document.location.href = "/login";
            }
        }
    }
</script>

<style scoped>
    a {
        color: #fff;
        font-size: 17px;
    }
    a:hover {
        color: #fff;
    }
    .dropdown-menu {
        left: -35px;
    }
    .active
    {
        color: goldenrod!important;
    }
    .logo {
        max-width: 200px;
    }
    .logout {
        color:#fff;
        font-size: 17px;
        cursor:pointer;
    }
</style>
