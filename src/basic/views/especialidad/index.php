<?php
/* @var $this yii\web\View */

//$this->registerCssFile("https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css",['position'=>$this::POS_HEAD]);
$this->registerCssFile("//unpkg.com/bootstrap/dist/css/bootstrap.min.css", ['position' => $this::POS_HEAD]);
$this->registerCssFile("//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.css", ['position' => $this::POS_HEAD]);

$this->registerJsFile("https://cdn.jsdelivr.net/npm/vue/dist/vue.js", ['position' => $this::POS_HEAD]);
$this->registerJsFile("https://unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.js", ['position' => $this::POS_HEAD]);

$this->registerJsFile("https://unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue-icons.min.js", ['position' => $this::POS_HEAD]);

$this->registerJsFile("https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js", ['position' => $this::POS_HEAD]);
$this->registerJsFile("https://cdn.jsdelivr.net/npm/sweetalert2@9", ['position' => $this::POS_HEAD]);
?>

<b-container fluid id="app" class="bg-info bv-example-row  text-center text-light">
    <div class="mb-4 p-3 bg-dark">
        <b-row>
            <b-col font-scale='1'>
                <h1>{{msg}}
                    <b-icon icon="card-checklist" animation="throb" font-scale="1" class="rounded-circle  p-2" variant="light"></b-icon>
                </h1>
            </b-col>
        </b-row>
    </div>
    
    <!-- Comienza el modal -->
    <b-modal v-model="showModal" title="Especialidades" :header-bg-variant="headerBgVariant" :header-text-variant="headerTextVariant" :body-bg-variant="bodyBgVariant" :body-text-variant="bodyTextVariant" :footer-bg-variant="footerBgVariant" :footer-text-variant="footerTextVariant" id="my-modal">
        <form action="">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input v-model="especialidad.nombre" type="text" name="nombre" id="nombre" class="form-control" placeholder="Ingrese especialidad" aria-describedby="helpId">
                <small id="titlehelpId" class="text-muted"></small>
                <span class="text-danger" v-if="errors.nombre"> {{ errors.nombre }} </span>
            </div>
            <div class="form-group">
                <label for="detalle">Detalle</label>
                <input v-model="especialidad.detalle" type="text" name="detalle" id="detalle" class="form-control" placeholder="Ingrese descripcion" aria-describedby="helpId">
                <small id="bodyhelpId" class="text-muted"></small>
                <span class="text-danger" v-if="errors.detalle">{{ errors.detalle }}</span>
            </div>

        </form>
        <template v-slot:modal-footer="{ok, cancel, hide}">
            <button v-if="isNewRecord" @click="addEspecialidad()" type="button" class="btn btn-primary m-3">Crear</button>
            
            <button v-if="!isNewRecord" @click="updateEspecialidad(especialidad.id_especialidad)" type="button" class="btn btn-primary m-3">Actualizar</button>

        </template>
    </b-modal>
    <!-- Termina el modal -->
    <p>
        <template>
            <div>
                <b-table-simple stacked='md' class="table bordered" bordered :head-variant="headVariant" :table-variant="tableVariant">
                    <b-thead head-variant="dark">
                        <template>
                            <b-tr>
                                <b-th>Id</b-th>
                                <b-th>Nombre</b-th>
                                <b-th>Detalle</b-th>
                                <b-th>Opciones</b-th>
                            </b-tr><div id="app">
                        </template>
                        <template>
                            <b-tr>
                                <b-td>
                                    <input v-on:change="getEspecialidades()" class="form-control" v-model="filter.id_especialidad">
                                </b-td>
                                <b-td>
                                    <input v-on:change="getEspecialidades()" class="form-control" v-model="filter.nombre">
                                </b-td>
                                <b-td>
                                    <input v-on:change="getEspecialidades()" class="form-control" v-model="filter.detalle">
                                </b-td>
                                <b-td>
                                    <b-container>
                                        <b-row class="justify-content-md-center">
                                            <b-row class="justify-content-md-center">
                                                <button @click="showModal=true" type='button' class="btn btn-primary">Nueva Especialidad</button>
                                            </b-row>
                                        </b-row>
                                    </b-container>
                                </b-td>
                            </b-tr>
                        </template>
                    </b-thead>
                    <template>
                        <b-tbody table-variant="warning">
                            <b-tr v-for="(espec,key) in especialidades" v-bind:key="espec.id_especialidad">
                                <b-td scope="row">{{espec.id_especialidad}}</b-td>
                                <b-td>{{espec.nombre}}</b-td>
                                <b-td>{{espec.detalle}}</b-td>
                                <b-td>
                                    <button @click="showModal=true" v-on:click="editEspecialidad(key)" type="button" class="btn btn-success">Editar</button>
                                    <button v-on:click="deleteEspecialidad(espec.id_especialidad)" type="button" class="btn btn-danger">Borrar</button>
                                </b-td>
                            </b-tr>
                        </b-tbody>
                    </template>
                    </b-table>
                    <b-container class="m-3">
                        <b-pagination v-model="currentPage" :total-rows="pagination.total" :per-page="pagination.perPage" aria-controls="my-table"></b-pagination>
                    </b-container>
            </div>
        </template>
    </p>
</b-container>

<script>
    var app = new Vue({

        el: "#app",
        data: function() {
            return {
                msg: "Especialidades",
                especialidades: [],
                especialidad: {},
                filter: {},
                errors: {},
                isNewRecord: true,
                currentPage: 1,
                pagination: {},
                visible: true,
                showModal: false,
                headerBgVariant: 'dark',
                headerTextVariant: 'warning',
                bodyBgVariant: 'info',
                bodyTextVariant: 'dark',
                footerBgVariant: 'dark',
                footerTextVariant: 'dark',
                headVariant: 'dark',
                borderer: true,
                tableVariant: 'primary',
            }
        },
        mounted() {
            this.getEspecialidades();
        },
        watch: {
            currentPage: function() {
                this.getEspecialidades();
            }
        },
        methods: {
            normalizeErrors: function(errors) {
                var allErrors = {};
                for (var i = 0; i < errors.length; i++) {
                    allErrors[errors[i].field] = errors[i].message;
                }
                return allErrors;

            },

            getEspecialidades: function() {
                var self = this;
                axios.get('/apiv1/especialidad?page=' + self.currentPage, {
                        params: self.filter
                    })
                    .then(function(response) {
                        console.log(response.data);
                        console.log("Se obtuvo todas las especialidades");
                        self.pagination.total = parseInt(response.headers['x-pagination-total-count']);
                        self.pagination.totalPages = parseInt(response.headers['x-pagination-page=count']);
                        self.pagination.perPage = parseInt(response.headers['x-pagination-per-page']);
                        self.especialidades = response.data;
                    })
                    .catch(function(error) {
                        // handle error
                        self.errors = self.normalizeErrors(error.response.data);
                        console.log(self.errors);
                    })
                    .then(function() {
                        // always executed
                    });
            },
            deleteEspecialidad: function(id) {
                Swal.fire({
                    title: 'Esta seguro que desea borrar el registro ' + id + '?',
                    icon: 'warning',
                    showCancelButton: true,
                    showConfirmButton: true,
                    confirmButtonText: 'Si borrar!',
                    cancelButtonText: 'No, regresar.',
                }).then((result) => {
                    if (result.value) {
                        var self = this;
                        axios.delete('/apiv1/especialidad/' + id)
                            .then(function(response) {
                                // handle success
                                console.log("borra especialidad id: " + id);
                                console.log(response.data);
                                self.getEspecialidades();
                                Swal.fire({
                                    title: 'Se ha borrado con exito',
                                    icon: 'success',
                                })
                            })
                            .catch(function(error) {
                                // handle error
                                console.log(error);
                            })
                            .then(function() {
                                // always executed
                            });
                        
                    }
                }, );
            },

            editEspecialidad: function(key) {
                this.especialidad = Object.assign({}, this.especialidades[key]);
                this.especialidad.key = key;
                this.isNewRecord = false;
            },
            addEspecialidad: function() {
                var self = this;
                axios.post('/apiv1/especialidad', self.especialidad)
                    .then(function(response) {
                        console.log(response.data);
                        self.getEspecialidades()
                        self.especialidad = {};
                        self.showModal = false;
                        Swal.fire({
                            title: 'Se creo el registro correctamente',
                            icon: 'success',
                            showConfirmButton: true,
                            confirmButtonText: 'Aceptar',
                        })
                    })
                    .catch(function(error) {
                        // handle error
                        self.errors = self.normalizeErrors(error.response.data);
                        console.log(self.errors);

                    })
                    .then(function() {
                        // always executed
                    });
                

            },
            updateEspecialidad: function(key) {
                var self = this;
                const params = new URLSearchParams();
                params.append('nombre', self.especialidad.nombre);
                params.append('detalle', self.especialidad.detalle);
                axios.patch('/apiv1/especialidad/' + key, params)
                    .then(function(response) {
                        // handle success
                        console.log(response.data);
                        self.getEspecialidades();
                        self.especialidad = {};
                        self.isNewRecord = true;
                        self.showModal = false;
                    })
                    .catch(function(error) {
                        // handle error
                        console.log(error);
                    })
                    .then(function() {
                        // always executed
                    });
            }

        }

    })
</script>