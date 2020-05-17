<template>
    <div class="container">
        <div class="form-container mx-auto mt-2">
            <form @submit.prevent="createBid">
                <span class="title d-block mb-3">Вакансия</span>
                <div class="form-group">
                    <div class="row">
                        <label for="company" class="col-sm-4 control-label">Предприятие</label>
                        <div class="col-sm-8">
                            <input
                                v-model="bid.company"
                                v-validate="'required|alpha|min:4|max:20'"
                                :class="{'input': true, 'alert-danger':errors.has('company')}"
                                name="company"
                                type="text"
                                id="company"
                                placeholder="Предприятие"
                                class="form-control"
                            >
                            <span v-show="errors.has('company')" class="help is-danger">{{ errors.first('company') }}</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="address" class="col-sm-4 control-label">Адресс</label>
                        <div class="col-sm-8">
                            <input
                                v-model="bid.address"
                                v-validate="'required|alpha|min:4|max:20'"
                                :class="{'input': true, 'alert-danger':errors.has('address')}"
                                name="address"
                                type="text"
                                id="address"
                                placeholder="Адресс"
                                class="form-control"
                            >
                            <span v-show="errors.has('address')" class="help is-danger">{{ errors.first('address') }}</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4">
                            <label>Специальность</label>
                        </div>
                        <div class="form-group col-sm-8 m-0">
                            <v-select
                                v-model="bid.speciality"
                                :options="specialities"
                                :reduce="specialities => specialities.id"
                                label="name"
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
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="position" class="col-sm-4 control-label">Должность</label>
                        <div class="col-sm-8">
                            <input
                                v-model="bid.position"
                                v-validate="'required|alpha|min:4|max:20'"
                                :class="{'input': true, 'alert-danger':errors.has('position')}"
                                name="position"
                                type="text"
                                id="position"
                                placeholder="Должность"
                                class="form-control"
                            >
                            <span v-show="errors.has('position')" class="help is-danger">{{ errors.first('position') }}</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="salary" class="col-sm-4 control-label">Заработная плата в грн</label>
                        <div class="col-sm-8">
                            <input
                                v-model="bid.salary"
                                v-validate="'required|decimal:56'"
                                :class="{'input': true, 'alert-danger':errors.has('salary')}"
                                name="salary"
                                type="text"
                                id="salary"
                                placeholder="Заработная плата"
                                class="form-control"
                            >
                            <span v-show="errors.has('salary')" class="help is-danger">Зарабатная плата должна быть числовым значением </span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-md-4 control-label" for="description">Описание</label>
                        <div class="col-md-8">
                            <textarea
                                v-model="bid.description"
                                v-validate="'required|max:255'"
                                :class="{'input': true, 'alert-danger':errors.has('description')}"
                                name="description"
                                class="form-control"
                                id="description"
                                placeholder="Описание"
                            >
                            </textarea>
                            <span v-show="errors.has('description')" class="help is-danger">{{ errors.first('description') }}</span>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block mt-4">Создать</button>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        name: "CreateBid",
        props:['id','specialities'],
        data(){
            return {
                bid:
                    {   company:'',
                        address:'',
                        position:'',
                        salary:'',
                        description:'',
                        speciality:''
                    },
            }
        },
        methods:{
            createBid() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        let bid={
                            'company':this.bid.company,
                            'address':this.bid.address,
                            'position':this.bid.position,
                            'description':this.bid.description,
                            'salary':this.bid.salary,
                            'user_id':this.id,
                            'specialty_id':this.bid.speciality,
                            'status_id':'1'
                        }

                        axios.post('/employer/bid',bid)
                            .then((response) => {
                                if (response.data.result == 'ok') {

                                    document.location.href = "/employer/bid";
                                }
                            })
                            .catch(e => {
                                console.log(e);
                                this.$toaster.error(e.response.data.message);
                            })
                    }
                    else {
                        this.$toaster.warning("Заполните все поля!");
                    }
                })
            }
        }
    }
</script>

<style scoped>
    .form-container {
        max-width: 825px;
        padding: 25px;
        border: 1px gray solid;
        border-radius:7px;
    }
    .title {
        font-size: 30px;
    }
    textarea {
        height: 194px!important;
        resize: none!important;
    }
    label {
        font-size: 16px;
    }
    form {
        margin:0;
    }
</style>
