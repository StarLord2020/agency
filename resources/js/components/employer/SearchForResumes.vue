<template>
    <div class="bides_container mx-auto">
        <div class="search pt-4 pb-4 border">
            <div class="row">
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
                <div class="col-4">
                    <input
                        name="address"
                        type="text"
                        placeholder="Город..."
                        class="form-control"
                    >
                </div>
                <div class="col-4">
                    <button class="btn btn-primary">Найти</button>
                </div>
            </div>
        </div>
        <div class="bid border pb-2" v-for="resume in displayedPosts">
            <a :href="'/manager/resumes/'+resume.id" class="d-block">
                <span class="d-block mb-2 mt-2"><b class="mr-3">ФИО:</b>{{resume.fio}}</span>
                <span class="company d-block mb-2"><b class="mr-3">Образование:</b> {{resume.education}}</span>
                <span class="address d-block mb-2"><b class="mr-3">Специальность:</b>{{resume.specialty}}</span>
                <span class="salary d-block mb-2"><b class="mr-3">Опыт работы:</b>{{resume.experience}}</span>
                <span class="description d-block mb-2"><b class="mr-3">Навыки:</b>{{resume.skills|cutText(195)}}</span>
            </a>
        </div>
        <nav aria-label="Page navigation example" class="pt-2" v-if="pages.length>1">
            <ul class="pagination">
                <li class="page-item">
                    <button type="button" class="page-link" v-if="page != 1" @click="page--">Назад</button>
                </li>
                <li class="page-item">
                    <button type="button" class="page-link" v-for="pageNumber in pages.slice(page-1, page+5)" @click="page = pageNumber"> {{pageNumber}} </button>
                </li>
                <li class="page-item">
                    <button type="button" @click="page++" v-if="page < pages.length" class="page-link">Вперед</button>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
    import paginate from '../../paginate';
    export default {
        name: "SearchForResumes",
        props:['resumes','specialty'],
        mixins:[paginate],
        data() {
            return {
                search:{
                    city:null,
                    specialty_id:null
                },
                resumeList:''
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
            this.resumeList=this.resumes;
            this.paginateList=this.resumes;
            this.setPages();
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
    .search {
        padding-left:15px;
        padding-right:15px;
    }
</style>
