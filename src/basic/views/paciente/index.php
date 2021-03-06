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

    <!-- modal Paciente -->
    <b-modal v-model="showModal" title="Paciente" :header-bg-variant="headerBgVariant" :header-text-variant="headerTextVariant" :body-bg-variant="bodyBgVariant" :body-text-variant="bodyTextVariant" :footer-bg-variant="footerBgVariant" :footer-text-variant="footerTextVariant" id="my-modal">
        <div class="panel with-nav-tabs panel-primary">
            <div class="panel-heading">
                <ul class="nav nav-tabs">
                    <div class="form-group">
                        <div class="row ml-5">
                            <div>
                            <!-- <b-button-group size="md"> -->
                            <b-tabs content-class="mt-3" fill>

                                <b-tab active variant="warning" href="#datos" data-toggle="tab">Datos Paciente</b-tab>

                                <b-tab  variant="dark" href="#enfermedad" data-toggle="tab">Enfermedades preexistentes</b-tab>
                            </b-tabs>
                            </div>

                                <!-- <b-button variant="warning" href="#tratamiento" data-toggle="tab">Tratamientos</b-button> -->
                            <!-- </b-button-group> -->
                        </div>
                    </div>
                </ul>
            </div>

            <div class="panel-body">
                <div class="tab-content">
                    <!-- pestaña datos paciente -->
                    <div class="tab-pane fade in active" id="datos">
                        <form action="">
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input v-model="paciente.nombre" type="text" name="nombre" id="nombre" class="form-control" placeholder="Ingrese nombre" aria-describedby="helpId">
                                <small id="titlehelpId" class="text-muted"></small>
                                <span class="text-danger" v-if="errors.nombre"> {{ errors.nombre }} </span>
                            </div>
                            <div class="form-group">
                                <label for="apellido">Apellido</label>
                                <input v-model="paciente.apellido" type="text" name="apellido" id="apellido" class="form-control" placeholder="Ingrese apellido" aria-describedby="helpId">
                                <small id="bodyhelpId" class="text-muted"></small>
                                <span class="text-danger" v-if="errors.apellido">{{ errors.apellido }}</span>
                            </div>
                            <div class="form-group">
                                <label for="obrasocial">Selecciona la Obra-Social</label>
                                <select class="form-control" v-model="paciente.obrasocial_id">
                                    <option :value="pac.id" v-for="pac in obrasocial">
                                        {{pac.nombre}}
                                    </option>
                                </select>
                            </div>
                        </form>
                    </div>

                    <!-- pestaña enfermedades paciente -->
                    <div class="tab-pane fade" id="enfermedad">
                        <div>
                            <legend>Seleccione patologias pre-existentes</legend>
                            <ul>
                                <li v-for="(pat,i) in patologias">
                                    <label :for="pat.nombre">{{pat.nombre}}</label>
                                    <input v-if="paciente" type="checkbox" :id="pat.nombre" v-model="patologias[i].estado">
                                </li>
                            </ul>
                            <legend>Patologias del paciente</legend>
                            <div v-for="pato in paciente.patologias">
                                <span>{{pato.nombre}} -</span>
                            </div>
                        </div>
                    </div>
                    <!-- pestaña tratamientos paciente -->
                    <div class="tab-pane fade" id="tratamiento">
                        <b-table-simple stacked='md' class="table bordered" bordered :head-variant="headVariant" :table-variant="tableVariant">
                            <b-thead head-variant="dark">
                                <template>
                                    <b-tr>
                                        <b-th>Id</b-th>
                                        <b-th>Nombre</b-th>
                                        <b-th>Apellido</b-th>
                                        <b-th>Obra Social</b-th>
                                        <b-th>Opciones</b-th>
                                    </b-tr>
                                    <div id="app">
                                </template>
                                <template>
                                    <b-tr>
                                        <b-td>
                                            <input v-on:change="getPacientes()" class="form-control" v-model="filter.id_paciente">
                                        </b-td>
                                        <b-td>
                                            <input v-on:change="getPacientes()" class="form-control" v-model="filter.nombre">
                                        </b-td>
                                        <b-td>
                                            <input v-on:change="getPacientes()" class="form-control" v-model="filter.apellido">
                                        </b-td>
                                        <b-td>

                                        </b-td>
                                        <b-td>
                                            <b-container>
                                                <b-row class="justify-content-md-center">
                                                    <b-row class="justify-content-md-center">
                                                        <button @click="showModal=true" type='button' class="btn btn-primary">Nuevo Paciente</button>
                                                    </b-row>
                                                </b-row>
                                            </b-container>
                                        </b-td>
                                    </b-tr>
                                </template>
                            </b-thead>
                            <template>
                                <b-tbody table-variant="warning">
                                    <b-tr v-for="(pacie,key) in pacientes" v-bind:key="pacie.id_paciente">
                                        <b-td scope="row">{{pacie.id_paciente}}</b-td>
                                        <b-td>{{pacie.nombre}}</b-td>
                                        <b-td>{{pacie.apellido}}</b-td>
                                        <b-td>{{pacie.obrasocial.nombre}}</b-td>
                                        <b-td>
                                            <button @click="showModal=true" v-on:click="editPaciente(key)" type="button" class="btn btn-success">Editar</button>
                                            <button v-on:click="deletePaciente(pacie.id_paciente)" type="button" class="btn btn-danger">Borrar</button>
                                        </b-td>
                                    </b-tr>
                                </b-tbody>
                            </template>
                            </b-table>
                    </div>
                </div>
            </div>
        </div>
        <template v-slot:modal-footer="{ok, cancel, hide}">
            <button v-if="isNewRecord" @click="addPacientes()" type="button" class="btn btn-primary m-3">Crear</button>
            <!-- <button v-if="!isNewRecord" @click="isNewRecord = !isNewRecord" v-on:click="especialidad={}" type="button" class="btn btn-success m-3">Nuevo</button> -->
            <button v-if="!isNewRecord" @click="updatePacientes(paciente.id_paciente)" type="button" class="btn btn-primary m-3">Actualizar</button>
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
                                <b-th>Apellido</b-th>
                                <b-th>Obra Social</b-th>
                                <b-th>Opciones</b-th>
                            </b-tr>
                            <div id="app">
                        </template>
                        <template>
                            <b-tr>
                                <b-td>
                                    <input v-on:change="getPacientes()" class="form-control" v-model="filter.id_paciente">
                                </b-td>
                                <b-td>
                                    <input v-on:change="getPacientes()" class="form-control" v-model="filter.nombre">
                                </b-td>
                                <b-td>
                                    <input v-on:change="getPacientes()" class="form-control" v-model="filter.apellido">
                                </b-td>
                                <b-td>

                                </b-td>
                                <b-td>
                                    <b-container>
                                        <b-row class="justify-content-md-center">
                                            <b-row class="justify-content-md-center">
                                                <button @click="showModal=true" type='button' class="btn btn-primary">Nuevo Paciente</button>
                                            </b-row>
                                        </b-row>
                                    </b-container>
                                </b-td>
                            </b-tr>
                        </template>
                    </b-thead>
                    <template>
                        <b-tbody table-variant="warning">
                            <b-tr v-for="(pacie,key) in pacientes" v-bind:key="pacie.id_paciente">
                                <b-td scope="row">{{pacie.id_paciente}}</b-td>
                                <b-td>{{pacie.nombre}}</b-td>
                                <b-td>{{pacie.apellido}}</b-td>
                                <b-td>{{pacie.obrasocial.nombre}}</b-td>
                                <b-td>
                                    <button @click="showModal=true" v-on:click="editPacientes(key)" type="button" class="btn btn-success">Editar</button>
                                    <button v-on:click="deletePacientes(pacie.id_paciente)" type="button" class="btn btn-danger">Borrar</button>
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
    </tag>
</b-container>
<script>
    var app = new Vue({
        el: "#app",
        data: function() {
            return {
                msg: "PACIENTES",
                obrasocial: [],
                pacientes: [],
                paciente: {},
                patologiasElegidas: [],
                patologias: [],
                patologia: {},
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
            this.getPacientes();
            this.getObrasociales();
            this.getPatologias();
        },
        watch: {
            currentPage: function() {
                this.getPacientes();
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
            getObrasociales: function() {
                var self = this;
                axios.get('/apiv1/obrasocial?page=' + self.currentPage, {
                        params: self.filter
                    })
                    .then(function(response) {
                        // handle success
                        console.log(response.data);
                        console.log("Se obtuvo todas las obras sociales");
                        self.pagination.total = parseInt(response.headers['x-pagination-total-count']);
                        self.pagination.totalPages = parseInt(response.headers['x-pagination-page=count']);
                        self.pagination.perPage = parseInt(response.headers['x-pagination-per-page']);
                        self.obrasocial = response.data;
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
            getPatologias() {
                var self = this;
                axios.get('/apiv1/patologia')
                    .then(function(response) {
                        console.log(response.data);
                        console.log("Se trajo las patologias");
                        self.patologias = response.data;
                    })
                    .catch(function(error) {
                        console.log(error);
                    })
                    .then(function() {});
            },
            normalizeErrors: function(errors) {
                var allErrors = {};
                for (var i = 0; i < errors.length; i++) {
                    allErrors[errors[i].field] = errors[i].message;
                }
                return allErrors;
            },
            getPacientes: function() {
                var self = this;
                axios.get('/apiv1/paciente?page=' + self.currentPage, {
                        params: self.filter
                    })
                    .then(function(response) {
                        // handle success
                        console.log(response.data);
                        console.log("Se obtuvo todos los pacientes");
                        self.pagination.total = parseInt(response.headers['x-pagination-total-count']);
                        self.pagination.totalPages = parseInt(response.headers['x-pagination-page=count']);
                        self.pagination.perPage = parseInt(response.headers['x-pagination-per-page']);
                        self.pacientes = response.data;
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
            deletePacientes: function(id) {
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
                        axios.delete('/apiv1/paciente/' + id)
                            .then(function(response) {
                                // handle success
                                console.log("borra paciente id: " + id);
                                console.log(response.data);
                                self.getPacientes();
                            })
                            .catch(function(error) {
                                // handle error
                                console.log(error);
                            })
                            .then(function() {
                                // always executed
                            });
                        Swal.fire({
                            title: 'Se ha borrado con exito',
                            icon: 'success',
                        })
                    }
                }, );
            },
            editPacientes: function(key) {
                this.paciente = Object.assign({}, this.pacientes[key]);
                this.paciente.key = key;
                this.isNewRecord = false;
            },
            addPacientes: function() {
                var self = this;
                axios.post('/apiv1/paciente', self.paciente)
                    .then(function(response) {
                        // handle success
                        console.log(response.data);
                        self.getPacientes()
                        // self.posts.unshift(response.data);
                        self.paciente = {};
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
            getPatElegidas() {
                var selected = [];
                for (var i in this.patologias) {
                    if (this.patologias[i].estado) {
                        selected.push(this.patologias[i]);
                    }
                }
                return selected;
            },
            updatePacientes: function(key) {
                var self = this;
                var patElegidas = self.getPatElegidas();
                const params = new URLSearchParams();
                params.append('nombre', self.paciente.nombre);
                params.append('apellido', self.paciente.apellido);
                params.append('id', self.paciente.obrasocial_id);
                axios.patch('/apiv1/paciente/' + key, params)

                params.append("patElegidas", patElegidas);
                self.paciente.patElegidas = self.getPatElegidas();
                axios.patch('/apiv1/paciente/' + key, self.paciente)
                    .then(function(response) {
                        // handle success
                        console.log(response.data);
                        self.getPacientes();
                        self.paciente = {};
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