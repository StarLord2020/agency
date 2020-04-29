<template>
    <div class="container">
        <div class="form-container mx-auto mt-2">
            <form>
                <span class="title">Создание вакансии</span>
                <div class="form-group">
                    <div class="row">
                        <label for="middleName" class="col-sm-4 control-label">Имя</label>
                        <div class="col-sm-8">
                            <input
                                v-validate="'required|alpha|min:4|max:20'"
                                :class="{'input': true, 'alert-danger':errors.has('name')}"
                                name="name"
                                type="text"
                                id="middleName"
                                placeholder="Имя"
                                class="form-control"

                            >
                            <span v-show="errors.has('name')" class="help is-danger">{{ errors.first('name') }}</span>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        name: "CreateBid"
    }
</script>

<style scoped>
    .form-container {
        max-width: 500px;
        padding: 25px;
        border: 1px gray solid;
        border-radius:7px;
    }
    .title {
        font-size: 30px;
    }
</style>
