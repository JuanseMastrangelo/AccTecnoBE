<template>
    <div>
        <h4 class="mb-3 text-dark">Estados de compra</h4>
        <div class="col-12 custom-border-bottom rounded-top p-1 d-flex align-items-center" style="background: var(--orange);">
            <div class="d-inline-block">
                <select class="form-control form-control-sm d-inline-block col-6" v-on:change="sizeColumns()" v-model="completeView" type="checkbox">
                    <option value="0" selected>Vista parcial</option>
                    <option value="1">Vista completa</option>
                </select>
                <button v-on:click="loadTable()" class="btn btn-sm custom-buttons d-inline-block">
                    <i class="fa fa-sync-alt text-white"></i>
                </button>
                <button class="btn btn-sm custom-buttons d-inline-block"  v-on:click="exportAll(false)">
                    <i class="fa fa-download text-white"></i>
                </button>
                <button class="btn btn-sm custom-buttons d-inline-block">
                    <i class="fa fa-minus-square text-white"></i>
                </button>
            </div>
            <div class="custom-divider d-inline-block"></div>
            <div class="input-group col-3 p-0 d-inline-flex">
                <input type="search" v-on:change="onQuickFilterChanged()" v-model="quickFilter"
                    class="form-control form-control-sm rounded-1" placeholder="Busqueda rápida" style="font-size: 12px;" />
                <div class="input-group-append" style="font-size: 12px;height: 28px;">
                    <span class="input-group-text"><i class="fa fa-search"></i></span>
                </div>
            </div>
            <div class="custom-divider d-inline-block"></div>
            <div class="d-inline-block">
                <button v-on:click="edit(gridApi.getSelectedRows()[0])" class="btn btn-sm d-inline-block">
                    <i class="fa fa-pencil-alt text-white"></i>
                </button>
                <button v-if="gridApi" class="btn btn-sm d-inline-block" matTooltip="Delete selected" v-bind:disabled="gridApi.getSelectedRows().length === 0"
                    matTooltipPosition="above">
                    <i class="fa fa-trash text-white"></i>
                </button>
                <button class="btn btn-sm d-inline-block"
                    matTooltip="Download selected" matTooltipPosition="above">
                    <i class="fa fa-download text-white"></i>
                </button>
            </div>
        </div>
        <ag-grid-vue style="width: 100%; height: 500px;"
                    class="ag-theme-alpine"
                    :columnDefs="columnDefs"
                    :rowData="rowData"
                    rowSelection="multiple"
                    :colResizeDefault="'shift'"
                    :gridOptions="gridOptions"
                    :overlayLoadingTemplate="overlayLoadingTemplate"
                    :domLayout="'autoHeight'"
                    :suppressRowClickSelection="true"
                    @rowDoubleClicked="cellDoubleClicked($event)"
                    @grid-ready="onGridReady">
        </ag-grid-vue>

        <button type="button" id="openModal" class="btn btn-primary d-none" data-toggle="modal" data-target="#exampleModal"></button>

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document" v-if="elSelected">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{elSelected.idBuy}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card" v-for="item in JSON.parse(elSelected.items)" v-bind:key="item.id">
                        <div class="d-flex col-12 p-0">
                            <div class="col-md-3 card-image"
                            style="background-image: url('https://chequeado.com/wp-content/plugins/accelerated-mobile-pages/images/SD-default-image.png');
                            background-repeat: no-repeat;background-size: cover; border-radius: 5px 0px 0px 5px">
                            </div>
                            <div class="col-md-6 card-body">
                                <h4 class="card-title">{{item.title}}</h4>
                                <p class="card-text">{{item.quantity}} unidad/es - <b>$ {{item.unit_price}}</b></p>
                                <a href="#" class="link-btn">ID {{item.id}}</a>
                            </div>
                        </div>
                    </div>
                    <hr />
                    Total: ${{elSelectedTotal}}
                    <hr />
                    <form class="mt-3">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Nombre completo</label>
                                <input type="text" v-bind:value="JSON.parse(elSelected.userData).userData.name" disabled class="form-control" placeholder="">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Email</label>
                                <input type="text" class="form-control" v-bind:value="JSON.parse(elSelected.userData).userData.email" disabled>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-5">
                                <label>ID</label>
                                <input type="text" class="form-control" v-bind:value="JSON.parse(elSelected.userData).userData.id" disabled>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputAddress">Fecha de creación</label>
                                <input type="text" class="form-control" v-bind:value="new Date(elSelected.created_at).toLocaleDateString()" disabled>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputState">Estado</label>
                                <button type="button" class="btn btn-outline-success col-12">Comprobar</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {AgGridVue} from "ag-grid-vue";
    export default {
        name: 'App',
        props: ['data'],
        data() {
            return {
                columnDefs: null,
                rowData: null,
                gridApi: null,
                columnApi: null,
                quickFilter: '',
                overlayLoadingTemplate: '<span class="ag-overlay-loading-center">Receiving data, Please wait...</span>',
                gridOptions: {
                    defaultColDef: { minWidth: 100, resizable: true, sortable: true },
                    suppressRowClickSelection: true,
                    onCellClicked: (e) => { e.node.setSelected(!e.node.selected); },
                    onGridSizeChanged: () => { this.gridApi.sizeColumnsToFit(); }
                },
                completeView: "0",
                elSelected: null,
                elSelectedTotal: 0
            }
        },
        components: {
            AgGridVue
        },
        methods: {
            onGridReady(params) {
                this.gridApi = params.api;
                this.columnApi = params.columnApi;
                this.refreshTable(this.data); // Todo Listo para recibir informacion (PRIMER PEDIDO DE DATOS)
            },
            refreshTable(dataTable) {
                this.gridApi.showLoadingOverlay();
                const filterModel = this.gridApi.getFilterModel();
                const sortModel = this.gridApi.getSortModel();
                const selected = this.gridApi.getSelectedRows();
                this.gridApi.setRowData(dataTable);
                setTimeout(() => { // Se usa para mantener seleccionados, filtros, sortable al recargar la tabla
                    this.gridApi.setFilterModel(filterModel);
                    this.gridApi.setSortModel(sortModel);
                    this.gridApi.forEachNode(node => {
                        node.setSelected(selected.filter(el => el.Numero === node.data.Numero).length > 0);
                    });
                }, 0);
            },
            loadTable() {
                axios.get("/api/compras").then((response) => {
                    this.refreshTable(response.data);
                });
            },
            exportAll(selected) {
                const date = new Date();
                const dateTime = date.toLocaleDateString();
                const filterDateTime = dateTime.replace(" ", "");
                this.gridApi.exportDataAsCsv(
                    {
                        allColumns: true,
                        columnSeparator: ';',
                        onlySelectedAllPages: selected,
                        fileName: `Carro~${filterDateTime}.xls`
                    });
            },
            cellDoubleClicked(row) {
                this.edit(row.data);
            },
            edit(cellData) {
                let total = 0;
                JSON.parse(cellData.items).map(el => total += el.unit_price);
                this.elSelectedTotal = total;
                this.elSelected = cellData;
                document.getElementById('openModal').click();
            },
            onQuickFilterChanged() {
                this.gridApi.setQuickFilter(this.quickFilter);
            },
            sizeColumns() {
                console.log(this.completeView);
                if (this.completeView == '1') {
                    const allColumnIds = [];
                    this.columnApi.getAllColumns().forEach((column) => {
                        allColumnIds.push(column.colId);
                    });
                    this.columnApi.autoSizeColumns(allColumnIds, false); // False ya que no oculta las cabeceras
                } else {
                    this.gridApi.sizeColumnsToFit();
                }
            }
        },
        beforeMount() {
            this.columnDefs = [
                {
                    headerName: 'Identificador',
                    field: 'idBuy',
                    filter: true,
                    headerCheckboxSelection: true,
                    headerCheckboxSelectionFilteredOnly: true,
                    checkboxSelection: true
                },
                {
                    headerName: 'Estado',
                    field: 'status',
                    cellClass: 'text-center',
                    cellRenderer: data => ( data.value === 'success' ?
                                            '<i class="fa fa-check mr-1 text-success"></i> Compra' : 
                                            data.value === 'pending' ? '<i class="fa fa-check mr-1 text-info"></i> Pendiente' : 
                                            data.value === 'processing' ? '<i class="fa fa-check mr-1 text-secondary"></i> En proceso' :
                                            '<i class="fa fa-cross mr-1 text-danger"></i> Fallido'
                                            )
                },
                {
                    headerName: 'Precio y Cant prod',
                    field: 'items',
                    cellRenderer: data => { if (data.value) {let total = 0; JSON.parse(data.value).map(el => total += el.unit_price); return '$ '+total + ' ('+JSON.parse(data.value).length+')';} else {return ''} }
                },
                {
                    headerName: 'Comprador',
                    field: 'userData',
                    cellRenderer: data => {if (data.value) { return JSON.parse(data.value).userData.name }else {return ''}}
                }
            ];
        }
    }
</script>
<style lang="scss">
  @import "../../../../node_modules/ag-grid-community/dist/styles/ag-grid.css";
  @import "../../../../node_modules/ag-grid-community/dist/styles/ag-theme-alpine.css";
  
    .custom-divider {
        width: 1px;
        height: 20px;
        background: rgba(250,250,250,.2);
        margin-left: 12px;
        margin-right: 12px;
    }

    .custom-buttons:hover > i {
        color: rgba(100,100,100,.3) !important;
    }

    .bg-dark { background-color: #1c1c1c !important;}
    .btn:focus {
        outline: none!important;
        box-shadow: none!important;
    }

    button:disabled,
    button[disabled]{
        cursor: disabled;
    }

</style>