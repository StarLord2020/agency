<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform" xmlns="http://www.w3.org/1999/html">
    <div>
        <b-container fluid>
            <b-row>
                <b-col md="8" lg="6" class="">
                    <b-form-group class="mb-1">
                        <b-input-group size="sm">
                            <b-form-input
                                v-model="filter"
                                type="search"
                                id="filterInput"
                                placeholder="Поиск"
                            >
                            </b-form-input>
                            <b-input-group-append>
                                <b-button
                                    :disabled="!filter"
                                    @click="filter = ''"
                                    class="bg-info"
                                >
                                    Очистить
                                </b-button>
                            </b-input-group-append>
                        </b-input-group>
                    </b-form-group>
                </b-col>
            </b-row>
            <b-table
                show-empty
                small
                stacked="lg"
                :items="items"
                :fields="fields"
                :current-page="currentPage"
                :per-page="perPage"
                :filter="filter"
                :filterIncludedFields="filterOn"
                :sort-by.sync="sortBy"
                :sort-desc.sync="sortDesc"
                :sort-direction="sortDirection"
                @filtered="onFiltered"
                ref="table"
                bordered
                class="mb-0 table"
                head-variant="light"
            >
                <template v-slot:empty="scope">
                    <span class="d-flex justify-content-center">Нет записей</span>
                </template>
                <template v-slot:emptyfiltered="scope">
                    <span class="d-flex justify-content-center">К сожалению,совпадений не найдено</span>
                </template>
                <template v-slot:cell(actions)="row">
                    <template v-if="action.route">
                        <a class="btn btn-info edit" :href="action.route+row.item.id+'/'+row.item.name">{{action.content}}</a>
                    </template>
                </template>
            </b-table>
            <b-row>
                <b-col sm="12" md="6" class="my-1">
                    <b-pagination
                        v-model="currentPage"
                        :total-rows="totalRows"
                        :per-page="perPage"
                        align="fill"
                        size="sm"
                        class="my-0"
                    >
                    </b-pagination>
                </b-col>
                <b-col sm="12" md="6" class="my-1">
                    <b-form-group
                        label="Выводить по"
                        label-cols-sm="9"
                        label-align-sm="right"
                        label-size="sm"
                        label-for="perPageSelect"
                        class="mb-0"
                    >
                        <b-form-select
                            sm="3"
                            class="perPageSelect"
                            v-model="perPage"
                            id="perPageSelect"
                            size="sm"
                            :options="pageOptions"
                        >
                        </b-form-select>
                    </b-form-group>
                </b-col>
            </b-row>
        </b-container>
    </div>
</template>

<script>
    export default {
        name:'TableStudent',
        props:['fields','items','action'],
        data() {
            return {
                totalRows: 1,
                currentPage: 1,
                perPage: 10,
                pageOptions: [5, 10, 15],
                sortBy: '',
                sortDesc: false,
                sortDirection: 'asc',
                filter: null,
                filterOn: [],

            }
        },
        mounted() {
            console.log(this.$refs.table.items)
            this.totalRows = this.items.length
        },
        methods: {
            onFiltered(filteredItems) {
                // Trigger pagination to update the number of buttons/pages due to filtering
                this.totalRows = filteredItems.length
                this.currentPage = 1
            }
        }
    }
</script>

<style scoped>
    .edit {
        padding: 4px 8px;
        font-size: 14px;
    }
    .perPageSelect {
        max-width:100px;
    }
</style>

