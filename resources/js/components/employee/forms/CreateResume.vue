<template>
    <div class="container">
        <div class="form-container mx-auto mt-2">
            <form>
                <span class="title d-block mb-3">Резюме</span>
                <div class="form-group">
                    <div class="row">
                        <label for="education" class="col-sm-4 control-label">Образование</label>
                        <div class="col-sm-8">
                            <input
                                v-validate="'required|alpha|min:4|max:20'"
                                :class="{'input': true, 'alert-danger':errors.has('education')}"
                                name="education"
                                type="text"
                                id="education"
                                placeholder="Образование"
                                class="form-control"
                            >
                            <span v-show="errors.has('education')" class="help is-danger">{{errors.first('education')}}</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="specialty" class="col-sm-4 control-label">Специальность</label>
                        <div class="col-sm-8">
                            <input
                                v-validate="'required|alpha|min:4|max:20'"
                                :class="{'input': true, 'alert-danger':errors.has('specialty')}"
                                name="specialty"
                                type="text"
                                id="specialty"
                                placeholder="Специальность"
                                class="form-control"
                            >
                            <span v-show="errors.has('Специальность')" class="help is-danger">{{ errors.first('specialty') }}</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="expirience" class="col-sm-4 control-label">Стаж</label>
                        <div class="col-sm-8">
                            <input
                                v-validate="'required|alpha|min:4|max:20'"
                                :class="{'input': true, 'alert-danger':errors.has('expirience')}"
                                name="expirience"
                                type="text"
                                id="expirience"
                                placeholder="Стаж"
                                class="form-control"
                            >
                            <span v-show="errors.has('expirience')" class="help is-danger">{{ errors.first('expirience') }}</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-md-4 control-label" for="skills">Навыки</label>
                        <div class="col-md-8">
                            <textarea
                                v-validate="'required|max:255'"
                                :class="{'input': true, 'alert-danger':errors.has('skills')}"
                                name="skills"
                                class="form-control"
                                id="skills"
                                placeholder="Навыки"
                            >
                            </textarea>
                            <span v-show="errors.has('skills')" class="help is-danger">{{ errors.first('skills') }}</span>
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
        name: "CreateResume"
    }
</script>

<style scoped>
    .form-container {
        max-width: 600px;
        padding: 25px;
        border: 1px gray solid;
        border-radius:7px;
    }
    .title {
        font-size: 30px;
    }
    textarea {
        height: 195px!important;
        resize: none!important;
    }
    label {
        font-size: 16px;
    }
    form {
        margin:0;
    }
</style>
