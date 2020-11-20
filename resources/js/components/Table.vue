<template>
    <div>
        <div class="col-12 d-flex justify-content-between align-center pl-0">
            <h1 class="text-white">{{title}}</h1>
            <div class="d-flex align-center">
                <button v-on:click="refreshData" class="btn btn-sm btn-light" style="height: 35px;" ><i class="fas fa-retweet"></i></button>
            </div>
        </div>

        <vue-good-table
                :columns="columns"
                :rows="dataRefresh && (dataRefresh.length > 0) ? dataRefresh : data"
                :search-options="{ enabled: true, placeholder: 'Buscar transacción' }"
                :line-numbers="true"
                :sort-options="{
                    enabled: true,
                    initialSortBy: {field: 'created_at', type: 'desc'}
                }"
                :pagination-options="{
                    enabled: true,
                    mode: 'pages',
                    perPage: 7,
                    dropdownAllowAll: false,
                    nextLabel: 'siguiente',
                    prevLabel: 'anterior',
                    rowsPerPageLabel: 'Filas por página:',
                    ofLabel: 'de',
                    pageLabel: 'paginas', // for 'pages' mode
                    allLabel: 'Todo',
                }">
                <template slot="table-row" slot-scope="props">
                    <span v-if="props.column.field === 'status'">
                        <a v-if="props.formattedRow[props.column.field] ==='success'">
                            <span class="badge badge-success">Pagado</span>
                        </a>
                        <a v-else-if="props.formattedRow[props.column.field] ==='failure'">
                            <span class="badge badge-danger">Fallido</span>
                        </a>
                        <a v-else-if="props.formattedRow[props.column.field] ==='pending'">
                            <span class="badge badge-info">Pendiente</span>
                        </a>
                        <a v-else>
                            <span class="badge badge-light">{{props.formattedRow[props.column.field]}}</span>
                        </a>
                    </span>
                    <span v-else-if="props.column.field === 'created_at'">
                        {{ new Date(props.formattedRow[props.column.field]).toLocaleDateString() }}
                        {{ new Date(props.formattedRow[props.column.field]).toLocaleTimeString() }}
                    </span>
                    <!-- <span v-else-if="props.column.field === 'delete'">
                        <a :href="`/user/${props.row.id}/delete`"><span class="badge badge-danger">Delete</span></a>
                    </span> -->
                    <span v-else>
                        {{ props.formattedRow[props.column.field] }}
                    </span>
                </template>
            </vue-good-table>
            <div v-if="loading" class="col-12 position-fixed d-flex justify-content-center align-items-center"
            style="top: 0;left:0;height: 100%;z-index: 3; background: rgba(100,100,100,.7)">
                <FadeLoader
                    class="custom-class"
                    v-bind:loading="true"
                    color='#000'
                    sizeUnit="px"
                />
            </div>
        </div>
</template>

<script>
    import { VueGoodTable } from 'vue-good-table';
    import { BarLoader } from '@saeris/vue-spinners';
    export default {
        props: ['data', 'columns', 'title'],
        components: {
            VueGoodTable,
        },
        data() {
            return {
              dataRefresh: [],
              loading: false
            }
        },
        methods: {
            refreshData: function() {
                this.loading = true;
                axios.get('/api/compras')
                .then((response)=>{
                    console.log(response.data);
                    this.dataRefresh = response.data;
                    this.loading = false;
                })
            }
        }
    };
</script>