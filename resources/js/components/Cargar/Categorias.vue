<template>
    <div class="col-12">
        <div id="content" class="col-12 p-2 m-auto">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Cargar</a></li>
                <li class="breadcrumb-item active">CATEGORIAS</li>
            </ul>
            <h1 class="page-header">
                Categorias
            </h1>
            <button class="btn btn-sm btn-primary" v-on:click="getCategories()"><i class="fa fa-sync-alt"></i> Refrescar datos</button>


            <div class="search-result">

        
                <ul class="search-tab nav nav-tabs" id="myTab" role="tablist">
                    <li class="search-tab-item">
                        <a class="search-tab-link active" id="categories-tab" data-toggle="tab" href="#categories" role="tab" aria-controls="categories" aria-selected="true">Categorias</a>
                    </li>
                    <li class="search-tab-item">
                        <a class="search-tab-link" id="nuevo-tab" data-toggle="tab" href="#nuevo" role="tab" aria-controls="nuevo" aria-selected="true">
                            {{editando ? 'Modificando ' + editando.name : 'Cargar nuevo'}}
                        </a>
                    </li>
                </ul>


                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="categories" role="tabpanel" aria-labelledby="categories-tab">
                        <div class="col-12 py-4">
                            <div class="card" v-if="data && data.length > 0">
                                <div class="list-group list-group-flush" v-for="item in data.filter(el => el.idParent === null)" v-bind:key="item.id">
                                    <div class="list-group-item d-flex align-items-center bg-primary">
                                        <div class="flex-fill">
                                            <div class="text-white">{{item.name}}</div>
                                            <div class="text-white">{{data.filter(el => el.idParent == item.id).length}} subcategoria/s</div>
                                        </div>
                                        <div>
                                            <a v-on:click="edit(item)" data-toggle="modal" class="btn btn-default width-100">Modificar</a>
                                            <a v-if="data.filter(el => el.idParent == item.id).length === 0" v-on:click="deleteItem(item)" data-toggle="modal" class="btn btn-default">Eliminar</a>
                                        </div>
                                    </div>
                                    <div class="widget-reminder">
                                        <div v-for="itemChild in data.filter(el => el.idParent == item.id)" v-bind:key="itemChild.id" class="widget-reminder-item">
                                            <div class="widget-reminder-time">{{itemChild.count}} prod.</div>
                                            <div class="widget-reminder-divider bg-primary"></div>
                                            <div class="widget-reminder-content">
                                                <div class="d-flex align-items-center pr-5">
                                                    <div class="flex-fill">
                                                        <div>{{itemChild.name}}</div>
                                                    </div>
                                                    <div class="d-flex">
                                                            <a v-on:click="edit(itemChild)" data-toggle="modal" class="btn btn-default mr-2">Modificar</a>
                                                            <a v-if="!loadingDelete && (itemChild.count === 0)" v-on:click="deleteItem(itemChild)" data-toggle="modal" class="btn btn-default">Eliminar</a>
                                                            <a v-if="loadingDelete" v-on:click="deleteItem(itemChild)" data-toggle="modal" class="btn btn-default text-danger"><div class="spinner-border spinner-border-sm mr-1" role="status"></div> Eliminando...</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-4 mb-5" v-if="data && data.length === 0">
                                No hay categorias cargadas
                            </div>
                        </div>
                        
        
                        <div v-if="loadingCategories" class="col-9 position-fixed d-flex justify-content-center align-items-center"
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
                        <div class="col-12 py-3">
                            <form>
                                <div class="form-row">
                                    <div class="form-group col-md-5">
                                        <label for="inputEmail4">Nombre</label>
                                        <input type="title" class="form-control" v-model="form.name" id="title" placeholder="" autocomplete="off" />
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label for="inputEmail4">Padre</label>
                                        <select class="form-control" v-model="form.idParent" :disabled="editando">
                                            <option value="">No Padre</option>
                                            <option v-for="item in getPrimaryCategories" v-bind:key="item.id" v-bind:value="item.id">{{item.name}}</option>
                                        </select>
                                    </div>
                                    <vue-upload-multiple-image
                                            v-if="!form.idParent"
                                            @upload-success="uploadImageSuccess"
                                            @before-remove="beforeRemove"
                                            :data-images="images"
                                            :multiple="false"
                                            :showEdit="false"
                                            dragText="Agregar imagen"
                                            browseText="Click para explorar"
                                            dropText="Soltar"
                                            primaryText="Principal"
                                            markIsPrimaryText="Marcar como principal"
                                            popupText="Esta imagen sera la primera en mostrarse"
                                    ></vue-upload-multiple-image>
                                </div>
                            </form>
                            <div class="mt-3">
                                <button v-if="!loadingForm" type="button" class="btn btn-primary" v-on:click="saveCategorie()" v-bind:disabled="form.name.length === 0">Guardar</button>
                                <button v-if="loadingForm" type="button" class="btn btn-primary">
                                    <div class="spinner-border spinner-border-sm" role="status"></div>
                                </button>
                                <button type="button" v-on:click="cancel()" v-bind:disabled="loadingForm" id="closeModal" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    import VueUploadMultipleImage from 'vue-upload-multiple-image';
    export default {
            components: {
                VueUploadMultipleImage
            },
            data() {
                return {
                    images: [],
                    data: null,
                    loadingCategories: false,
                    loadingDelete: false,
                    loadingForm: false,
                    form: {
                        name: '',
                        idParent: '',
                        files: null
                    },
                    editando: null,
                    changes: false
                }
            },
            methods: {
                clearInputSearch: function () {this.searchValue = '';},
                getCategories: function() {
                    this.loadingCategories = true;
                    axios.get('/api/categories/all')
                    .then((response)=>{
                        this.data = response.data;
                        this.loadingCategories = false;
                    }).catch(error => {
                        console.log(error.response.data);
                        this.loadingCategories = false;
                    });
                },
                edit: function(item) {
                    this.editando = item;
                    document.getElementById('nuevo-tab').click();
                    this.form.name = item.name;
                    this.form.idParent = item.idParent;
                    this.images = (!item.files || (item.files == '')) ? [] : JSON.parse(item.files);
                },
                cancel: function() {
                    if (this.changes) {
                        var r = confirm("Esta seguro que desea cancelar? Se perderan todos los datos no guardados.");
                        if (r == true) {
                            this.editando = null;
                            this.form.name = '';
                            this.form.files = [];
                            this.images = [];
                            document.getElementById('categories-tab').click();
                        }
                    } else {
                        this.editando = null;
                        this.form.name = '';
                        this.form.files = [];
                        this.images = [];
                        document.getElementById('categories-tab').click();
                    }
                },
                deleteItem(item) {
                    var r = confirm("Esta seguro que desea eliminar " + item.name)
                    if (r == true) {
                        this.loadingDelete = true;
                        axios.delete('/api/categories/' + item.id)
                        .then((response)=>{
                            this.loadingDelete = false;
                            this.getCategories();
                        }).catch(error => {
                            console.log(error.response.data);
                            this.loadingDelete = false;
                        });
                    }
                },
                uploadImageSuccess(formData, index, fileList) {
                    this.form.files = JSON.stringify(fileList);
                    this.changes = true;
                },
                beforeRemove (index, done, fileList) {
                    var r = confirm("Eliminar imagen")
                    if (r == true) {
                        this.form.files = JSON.stringify([]);
                        this.changes = true;
                        done()
                    }
                },
                saveCategorie: function() {
                    this.loadingForm = true;
                    const body = {
                        id: this.editando ? this.editando.id : 0,
                        name: this.form.name.toUpperCase(),
                        idParent: this.editando ? this.editando.idParent : this.form.idParent,
                        files: this.form.files
                    }
                    console.log(body);

                    axios.post('/api/categories', body)
                    .then((response)=>{
                        this.loadingForm = false;
                        this.editando = null;
                        this.getCategories();
                        this.changes = false;
                        this.images = [];
                        this.form.name = '';
                        this.form.files = [];
                        document.getElementById('categories-tab').click();
                    }).catch(error => {
                        console.log(error.response.data);
                        this.loadingForm = false;
                    });
                },
            },
            mounted() {
                this.getCategories();
            },
            computed: {
                getPrimaryCategories: function () {
                    return this.data ? this.data.filter(el => el.idParent === null) : [];
                },
            }

    };
</script>