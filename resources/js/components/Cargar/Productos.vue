<template>
    <div class="col-12">
        <div id="content" class="col-9 p-2 m-auto">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Cargar</a></li>
                <li class="breadcrumb-item active">PRODUCTOS</li>
            </ul>
            <h1 class="page-header">
            Búsqueda rápida <small>busqueda por nombre y descripción...</small>
            </h1>

            <div class="search-result">
                <div class="search-input">
                    <form v-on:submit.prevent="search()" action="#" method="POST" name="search_form">
                        <a href="#" class="search-close" v-on:click="clearInputSearch()" data-clear-form="#search">&times;</a>
                        <input type="text" class="form-control form-control-lg" v-model="searchValue" value="" placeholder="Buscar producto..." />
                    </form>
                </div>
                <button class="btn btn-sm btn-primary" v-on:click="search()"><i class="fa fa-retweet"></i> Refrescar datos</button>

        
                <ul class="search-tab nav nav-tabs" id="myTab" role="tablist">
                    <li class="search-tab-item">
                        <a class="search-tab-link active" id="busqueda-tab" data-toggle="tab" href="#busqueda" role="tab" aria-controls="busqueda" aria-selected="true">Busqueda</a>
                    </li>
                    <li class="search-tab-item">
                        <a class="search-tab-link" id="nuevo-tab" data-toggle="tab" href="#nuevo" role="tab" aria-controls="nuevo" aria-selected="true">Cargar nuevo</a>
                    </li>
                    <li class="search-tab-item">
                        <a class="search-tab-link" id="agotado-tab" data-toggle="tab" href="#agotado" role="tab" aria-controls="agotado" aria-selected="true">Agotados <span class="badge badge-danger">{{dataAgotados ? dataAgotados.length : '0'}}</span></a>
                    </li>
                </ul>


                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="busqueda" role="tabpanel" aria-labelledby="busqueda-tab">
                        <div class="search-result">
                            <div class="search-result-list">
                                <div class="mt-4 mb-5" v-if="(ultimaBusqueda !== '') && data && data.length === 0">
                                    No se han encontrado resultados de <b>{{ultimaBusqueda}}</b>
                                </div>
                                <div class="col-12 p-0" v-if="data && data.length > 0">
                                    <div class="search-result-item" v-for="item of data" v-bind:key="item.id">
                                        <div class="search-result-media">
                                            <a href="#" class="border"><img v-bind:src="JSON.parse(item.files)[0].path" alt="" /></a>
                                        </div>
                                        <div class="search-result-content">
                                            <div class="col-12 p-0 h-100" style="display: grid;">
                                                <div class="col-12 p-0">
                                                    <h3><a href="#">{{item.title}} <small>({{item.count}})</small></a></h3>
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered table-sm mt-2">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="p-0">Fecha de creación</td>
                                                                    <td class="p-0"><time-ago :refresh="60" :datetime="new Date(item.created_at)" locale="es" :long="true" tooltip></time-ago></td>
                                                                    <td class="p-0">Fecha de modificación</td>
                                                                    <td class="p-0"><time-ago :refresh="60" :datetime="new Date(item.updated_at)" locale="es" :long="true" tooltip></time-ago></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <p v-html="item.description" style="height: 42px;text-overflow: ellipsis;overflow: hidden;"></p>
                                                    </div>
                                                </div>
                                                <div class="col-12 p-0 d-flex align-items-end">
                                                    <a class="mr-4"><b>{{item.saleValue | currency}}</b></a>
                                                    <a href="#" class="mr-4">Estadísticas</a>
                                                    <a href="#" class="mr-4" style="cursor: pointer" v-on:click="editar(item)" data-toggle="modal" data-target=".bd-example-modal-lg">Editar</a>
                                                    <a href="#" v-if="!loadingDelete" class="mr-4 text-danger" v-on:click="deleteItem(item)">Eliminar</a>
                                                    <a href="#" v-if="loadingDelete" class="mr-4 text-danger"><div class="spinner-border spinner-border-sm mr-1" role="status"></div> Eliminando...</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
        
                        <div class="text-center mt-4 mb-5" v-if="data && data.length > 0">
                            <div class="pagination justify-content-center">
                                <div class="disabled page-item">
                                    <a href="#" class="page-link">
                                    <span>«</span>
                                    </a>
                                </div>
                                <div class="active page-item"><a href="#" class="page-link">1</a></div>
                                <div class="page-item"><a href="#" class="page-link">2</a></div>
                                <div class="page-item"><a href="#" class="page-link">3</a></div>
                                <div class="page-item"><a href="#" class="page-link">4</a></div>
                                <div class="page-item"><a href="#" class="page-link">5</a></div>
                                <div class="page-item">
                                    <a href="#" class="page-link">
                                    <span>»</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        
        
                        <div v-if="loadingSearch" class="col-9 position-fixed d-flex justify-content-center align-items-center"
                        style="z-index: 3; height: 200px">
                            <PulseLoader
                                class="custom-class"
                                v-bind:loading="true"
                                color='#1f6bff'
                                sizeUnit="px"
                            />
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nuevo" role="tabpanel" aria-labelledby="nuevo-tab">
                        <div class="col-9 position-fixed d-flex justify-content-center align-items-center"
                        style="z-index: 3; height: 200px">
                            <button type="button" class="btn btn-sm btn-success ml-2" style="height: 35px;" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fas fa-plus"></i> Cargar nuevo producto</button>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="agotado" role="tabpanel" aria-labelledby="agotado-tab">
                        <div class="search-result">
                            <div class="search-result-list">
                                <div class="col-12 p-0" v-if="dataAgotados && dataAgotados.length > 0">
                                    <div class="search-result-item" v-for="item of dataAgotados" v-bind:key="item.id">
                                        <div class="search-result-media">
                                            <a href="#" class="border">
                                                <img v-bind:src="JSON.parse(item.files)[0].path" alt="" />
                                            </a>
                                        </div>
                                        <div class="search-result-content">
                                            <h3>
                                                <a href="#" v-bind:class="item.count == 2 ? 'text-dark' : item.count == 1 ? 'text-warning' : 'text-danger'">
                                                    {{item.title}} <small>({{item.count}})</small>
                                                </a>
                                            </h3>
                                            <p v-html="item.description">
                                                {{item.description}}
                                            </p>
                                            <a class="mr-4"><b>{{item.saleValue | currency}}</b></a>
                                            <a href="#" class="mr-4">Estadísticas</a>
                                            <a href="#" class="mr-4" style="cursor: pointer" v-on:click="editar(item)" data-toggle="modal" data-target=".bd-example-modal-lg">Editar</a>
                                            <a href="#" v-if="!loadingDelete" class="mr-4 text-danger" v-on:click="deleteItem(item)">Eliminar</a>
                                            <a href="#" v-if="loadingDelete" class="mr-4 text-danger"><div class="spinner-border spinner-border-sm mr-1" role="status"></div> Eliminando...</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Cargar producto <small class="text-danger" v-if="formError">Error: {{formError}}</small></h5>
                        <button type="button" class="close d-none" id="closeModal" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="ppal-tab" data-toggle="tab" href="#ppal" role="tab" aria-controls="ppal" aria-selected="true">
                                        Principal
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="image-tab" data-toggle="tab" href="#image" role="tab" aria-controls="image" aria-selected="false">
                                        Imagenes
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="otros-tab" data-toggle="tab" href="#otros" role="tab" aria-controls="otros" aria-selected="false">
                                        Otros
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content p-2 border border-top-0" id="myTabContent" style="background: #F8FAFC">
                                <div class="tab-pane fade show active" id="ppal" role="tabpanel" aria-labelledby="ppal-tab">
                                    <div class="form-row">
                                        <div class="form-group col-md-5" :class="{ 'form-group--error': $v.form.title.$invalid }">
                                            <label for="inputEmail4">Titulo</label>
                                            <input v-on:change="detectChanges()" type="text" class="form-control" v-model.trim="form.title" id="title" placeholder="" autocomplete="off" >
                                            <div class="error" v-if="!$v.form.title.required">Campo requerido</div>
                                            <div class="error" v-if="!$v.form.title.minLength">El campo debe contener al menos {{$v.form.title.$params.minLength.min}} letras.</div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputEmail4">Valor de compra (ARS)</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">$</span>
                                                </div>
                                                <money class="col-auto" v-model="form.purchaseValue" v-bind="money"></money>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputEmail4">Valor de venta (ARS)</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">$</span>
                                                </div>
                                                <money class="col-auto" v-model="form.saleValue" v-bind="money"></money>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" :class="{ 'form-group--error': $v.form.description.$invalid }">
                                        <label for="inputAddress">Descripción</label>
                                        <vue-editor class="bg-white" v-model="form.description"></vue-editor>
                                        <div class="error" v-if="!$v.form.description.required">Campo requerido</div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="image" role="tabpanel" aria-labelledby="image-tab">
                                        <vue-upload-multiple-image
                                            @upload-success="uploadImageSuccess"
                                            @before-remove="beforeRemove"
                                            @mark-is-primary="markIsPrimary"
                                            :data-images="images"
                                            :showEdit="false"
                                            dragText="Agregar imagen"
                                            browseText="Click para explorar"
                                            dropText="Soltar"
                                            primaryText="Principal"
                                            markIsPrimaryText="Marcar como principal"
                                            popupText="Esta imagen sera la primera en mostrarse"
                                        ></vue-upload-multiple-image>
                                </div>
                                <div class="tab-pane fade" id="otros" role="tabpanel" aria-labelledby="otros-tab">
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label>Categoría</label>
                                            <select v-model.trim="form.categorieId" class="form-control" :class="{ 'form-group--error': $v.form.categorieId.$invalid }" v-on:change="detectChanges();loadSubCategories()">
                                                <option v-for="category in categories" v-bind:key="category.id" v-bind:value="category.id">{{category.name}}</option>
                                            </select>
                                            <div class="error" v-if="!$v.form.categorieId.required">Campo requerido</div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>SubCategoria</label>
                                            <select v-on:change="detectChanges()" v-model.trim="form.subCategorieId" class="form-control" :class="{ 'form-group--error': $v.form.subCategorieId.$invalid }">
                                                <option v-for="category in subCategories" v-bind:key="category.id" v-bind:value="category.id">{{category.name}}</option>
                                            </select>
                                            <div class="error" v-if="!$v.form.subCategorieId.required">Campo requerido</div>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Cant. de stock</label>
                                            <input v-on:change="detectChanges()" type="number" class="form-control" v-model="form.count" id="count" placeholder="" autocomplete="off" >
                                        </div>
                                        <!-- <div class="form-group col-md-4">
                                            <label for="inputAddress">Subcategoría</label>
                                            <select disabled v-model="subcategory" class="form-control">
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputAddress">Marca</label>
                                            <select disabled v-model="marca" class="form-control">
                                            </select>
                                        </div> -->
                                    </div>
                                    <div class="col-12 p-0">
                                        <div class="table-responsive col-md-12 p-0">
                                        <table id="sort2" class="grid table table-bordered table-sortable">
                                            <thead>
                                                <tr>
                                                    <th>Propiedad</th>
                                                    <th>Valor</th>
                                                    <th>Propiedad</th>
                                                    <th>Valor</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Alto</td>
                                                    <td><input v-on:change="detectChanges()" type="text" value="" v-model="form.high" class="form-control form-control-sm"></td>
                                                    <td>Ancho</td>
                                                    <td><input v-on:change="detectChanges()" type="text" value="" v-model="form.width" class="form-control form-control-sm"></td>
                                                </tr>
                                                <tr>
                                                    <td>Color</td>
                                                    <td><input v-on:change="detectChanges()" type="text" value="" v-model="form.colour" class="form-control form-control-sm"></td>
                                                    <td>Garantia</td>
                                                    <td><input v-on:change="detectChanges()" type="text" value="" v-model="form.warranty" class="form-control form-control-sm"></td>
                                                </tr>
                                                <tr>
                                                    <td>Modelo</td>
                                                    <td><input v-on:change="detectChanges()" type="text" value="" v-model="form.model" class="form-control form-control-sm"></td>
                                                    <td>Peso</td>
                                                    <td><input v-on:change="detectChanges()" type="text" value="" v-model="form.weight" class="form-control form-control-sm"></td>
                                                </tr>
                                                <tr>
                                                    <td>Memoria RAM</td>
                                                    <td><input v-on:change="detectChanges()" type="text" value="" v-model="form.RAM" class="form-control form-control-sm"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <span v-if="form.saleValue && form.purchaseValue" class="text-secondary">Ganancia:
                            <span class="text-primary" v-if="form.saleValue-form.purchaseValue > 0">${{(form.saleValue-form.purchaseValue).toFixed(2)}} ({{(((form.saleValue-form.purchaseValue)*100)/form.saleValue).toFixed(2)}}%)</span>
                            <span class="text-danger" v-if="form.saleValue-form.purchaseValue < 0">${{(form.saleValue-form.purchaseValue).toFixed(2)}} ({{(((form.saleValue-form.purchaseValue)*100)/form.saleValue).toFixed(2)}}%)</span>
                            <span class="text-primary" v-if="form.saleValue-form.purchaseValue === 0">$0 (0%)</span>
                        </span>
                        <span v-if="!form.saleValue || !form.purchaseValue" class="text-secondary">Ganancia: $0 (0%)</span>
                        <button v-if="!loadingForm" type="button" class="btn btn-primary" v-on:click="saveProduct()" v-bind:disabled="this.$v.$invalid || (this.form.files.length === 0)">Guardar</button>
                        <button v-if="loadingForm" type="button" class="btn btn-primary">
                            <div class="spinner-border spinner-border-sm" role="status"></div>
                        </button>
                        <button type="button" id="closeModal" class="btn btn-secondary" v-on:click="cancel()">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
    .error {
        color: red;
        font-size: 10px;
    }
    .form-group--error input {
        border-color: red!important;
    }
    input:focus { outline:0px !important; -webkit-appearance:none; box-shadow: none !important;}
</style>

<script>
    import { VueGoodTable } from 'vue-good-table';
    import { BarLoader } from '@saeris/vue-spinners';
    import { VueEditor } from "vue2-editor";
    import VueUploadMultipleImage from 'vue-upload-multiple-image';
    import {Money} from 'v-money'
    import TimeAgo from 'vue2-timeago'

    import { required, minLength, between } from 'vuelidate/lib/validators'
    const { validationMixin, default: Vuelidate } = require('vuelidate')
    export default {
            components: {
                VueGoodTable,
                VueEditor,
                VueUploadMultipleImage,
                Money,
                TimeAgo
            },
            data() {
                return {
                    images: [],
                    data: null,
                    dataAgotados: null,
                    loadingDelete: false,
                    loadingSearch: false,
                    searchValue: '',
                    ultimaBusqueda: '',
                    money: {
                        decimal: ',',
                        thousands: '.',
                        prefix: '',
                        suffix: '',
                        precision: 2,
                        masked: false
                    },
                    form: {
                    },
                    loadingForm: false,
                    categories: null,
                    subCategories: null,
                    formError: null,
                    editando: null,
                    changes: false
                }
            },
            methods: {
                search: function() {
                    this.loadingSearch = true;
                    const value = this.searchValue.trim() === '' ? '$' : this.searchValue;
                    axios.get('/api/products/search/'+ value)
                    .then((response)=>{
                        this.data = response.data;
                        this.loadingSearch = false;
                        this.ultimaBusqueda = this.searchValue;
                        document.getElementById("busqueda-tab").click();
                    })
                },
                clearInputSearch: function () {this.searchValue = '';},
                uploadImageSuccess(formData, index, fileList) {
                    this.form.files = JSON.stringify(fileList);
                    this.changes = true;
                },
                beforeRemove (index, done, fileList) {
                    var r = confirm("Eliminar imagen")
                    if (r == true) {
                        done();
                        this.form.files = JSON.stringify(fileList);
                        this.changes = true;
                    } else {
                    }
                },
                markIsPrimary (index, fileList) {
                    this.form.files = JSON.stringify(fileList);
                    this.changes = true;
                },
                detectChanges() {
                    this.changes = true;
                },
                saveProduct: function() {
                    this.loadingForm = true;
                    axios.post('/api/products', this.form)
                    .then((response)=>{
                        this.loadingForm = false;
                        this.changes = false;
                        this.editando = response.data;
                        document.getElementById("closeModal").click();
                        this.setFormValues();
                        this.search();
                        this.loadAgotados();
                    }).catch(error => {
                        console.log(error.response.data);
                        this.loadingForm = false;
                    });
                },
                setFormValues: function(values) {
                    const defaultValues = {
                        title: '',
                        description: '',
                        count: 0,
                        purchaseValue: 0.00,
                        saleValue: 0.00,
                        categorieId: '',
                        subCategorieId: '',
                        high: '',
                        width: '',
                        colour: '',
                        warranty: '',
                        model: '',
                        weight: '',
                        RAM: '',
                        files: null
                    }
                    this.form = values || defaultValues;
                },
                loadCategories: function() {
                    axios.get('/api/categories/all')
                    .then((response)=>{
                        this.categories = response.data;
                        // this.categorieId = (response.data.length > 0) && response.data[0].id;
                    }).catch(error => {
                        this.loadingForm = false;
                    });
                },
                loadSubCategories: function() {
                    axios.get('/api/categories/sub/' + this.form.categorieId)
                    .then((response)=>{
                        this.subCategories = response.data;
                        this.form.subCategorieId = response.data.length > 0 ? response.data[0].id : null;
                    }).catch(error => {
                            console.log(error.response.data);
                    });
                },
                editar: function(item) {
                    item = Object.assign({}, item, {saleValue: parseFloat(item.saleValue).toFixed(2), purchaseValue : parseFloat(item.purchaseValue).toFixed(2)})
                    this.editando = item;
                    this.setFormValues(item);
                    this.images = JSON.parse(item.files);
                    // document.getElementById("busqueda-tab").click();
                },
                cancel: function() {
                    if (this.changes) {
                        var r = confirm("Esta seguro que desea cancelar? Se perderan todos los datos no guardados.")
                        if (r == true) {
                            this.editando = null;
                            this.changes = false;
                            this.images = [];
                            this.setFormValues();
                            document.getElementById("closeModal").click();
                        }
                    } else {
                        this.editando = null;
                        this.changes = false;
                        this.images = [];
                        this.setFormValues();
                        document.getElementById("closeModal").click();
                    }
                },
                deleteItem(item) {
                    var r = confirm("Esta seguro que desea eliminar " + item.title)
                    if (r == true) {
                        this.loadingDelete = true;
                        axios.delete('/api/products/' + item.id)
                        .then((response)=>{
                            this.loadingDelete = false;
                            this.search();
                        }).catch(error => {
                            console.log(error.response.data);
                            this.loadingDelete = false;
                        });
                    }
                },
                loadAgotados() {
                    axios.get('/api/products/agotados')
                    .then((response)=>{
                        this.dataAgotados = response.data;
                    })
                }
            },
            mounted() {
                this.loadCategories();
                this.loadAgotados();
                this.setFormValues();
                this.search();
                // this.refreshTable();
            },
            validations: {
                form: {
                    title: { required, minLength: minLength(4) },
                    categorieId: { required },
                    subCategorieId: { required },
                    description: { required },
                }
            }
    };
</script>