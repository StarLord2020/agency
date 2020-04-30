<template>
    <div class="container">
        <div class="form-container mx-auto mt-2">
            <form @submit.prevent="EditBid">
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
                        <label for="salary" class="col-sm-4 control-label">Заработная плата</label>
                        <div class="col-sm-8">
                            <input
                                v-model="bid.salary"
                                v-validate="'required|min:4|max:20'"
                                :class="{'input': true, 'alert-danger':errors.has('salary')}"
                                name="salary"
                                type="text"
                                id="salary"
                                placeholder="Заработная плата"
                                class="form-control"
                            >
                            <span v-show="errors.has('salary')" class="help is-danger">{{ errors.first('salary') }}</span>
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
                <button type="submit" class="btn btn-primary btn-block mt-4">Отредактировать</button>
            </form>
        </div>
    </div>
</template>
<script>
    export default {
        name: "EditBid",
        props:['bid'],
        methods:{
            EditBid(){
                console.log(this.bid);
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        axios.put('/employer/bid/' + this.bid.id, this.bid)
                            .then((response) => {
                                if (response.data.response == 'updated') {
                                    this.$toaster.success('Данные успешно отредактированы');
                                    document.location.href = "/employer/bid";
                                }
                                else {
                                    this.$toaster.error('Ошибка');
                                }
                            })
                            .catch(e => {
                                // if(e.response.data.errors.email[0]){
                                //     this.duplicateEmail=this.editUser.email;
                                //     this.emailErr='Пользователь с данным email уже существует';
                                //     this.$toaster.warning(e.response.data.errors.email[0]);
                                // }
                                // else {
                                //     this.$toaster.error(e.response.data.errors);
                                // }
                            })
                    }
                    else {
                        this.$toaster.warning("Заполните все поля!");
                    }
                })
            }
        },
        created() {
            console.log((this.bid));
        }
    }
</script>

<style scoped>

</style>
