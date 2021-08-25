<?php
/* @var $this yii\web\View */
//$this->registerCssFile("https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css",['position'=>$this::POS_HEAD]);
$this->registerCssFile("//unpkg.com/bootstrap/dist/css/bootstrap.min.css", ['position' => $this::POS_HEAD]);
$this->registerCssFile("//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.css", ['position' => $this::POS_HEAD]);
$this->registerJsFile("https://cdn.jsdelivr.net/npm/vue/dist/vue.min.js", ['position' => $this::POS_HEAD]);
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
                <b-modal v-model="showModal" title="Sistema de Pacientes" :header-bg-variant="headerBgVariant" :header-text-variant="headerTextVariant" :body-bg-variant="bodyBgVariant" :body-text-variant="bodyTextVariant" :footer-bg-variant="footerBgVariant" :footer-text-variant="footerTextVariant" size="xl" id="my-modal">
                    <div class="panel with-nav-tabs panel-primary ml-5">
                        <div class="panel-heading ">
                            <ul class="nav nav-tabs justify-content-md-center">
                                <div class="form-group ">
                                    <div class="row ">
                                        <b-button-group size="md" class="center">

                                            <b-button variant="warning" href="#datos" data-toggle="tab">Datos Paciente</b-button>

                                            <b-button variant="dark" href="#enfermedad" data-toggle="tab">Enfermedades preexistentes</b-button>

                                            <!-- <b-button variant="warning" href="#tratamiento" data-toggle="tab">Tratamientos</b-button> -->
                                        </b-button-group>
                                    </div>
                                </div>
                            </ul>
                        </div>

                        <div class="panel-body">
                            <div class="tab-content">
                                <!-- pestaña datos paciente -->
                                <div class="tab-pane  active" id="datos">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-12 col-md-4">
                                                <label for="nombre">Nombre</label>
                                                <input v-model="paciente.nombre" type="text" ref="focusButton" name="nombre" id="nombre" class="form-control" placeholder="Ingrese nombre del paciente" aria-describedby="helpId">
                                                <small id="titlehelpId" class="text-muted"></small>
                                                <span class="text-danger" v-if="errors.nombre"> {{ errors.nombre }} </span>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <div class="form-group">
                                                    <label for="apellido">Apellido</label>
                                                    <input v-model="paciente.apellido" type="text" name="apellido" id="apellido" class="form-control" placeholder="Ingrese Apellido" aria-describedby="helpId">
                                                    <small id="bodyhelpId" class="text-muted"></small>
                                                    <span class="text-danger" v-if="errors.apellido">{{ errors.apellido }}</span>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="direccion">Direccion</label>
                                                <input v-model="paciente.direccion" type="text" name="direccion" id="direccion" class="form-control" placeholder="Ingrese Direccion" aria-describedby="helpId">
                                                <small id="bodyhelpId" class="text-muted"></small>
                                                <span class="text-danger" v-if="errors.direccion">{{ errors.direccion }}</span>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-3 col-md-3">
                                                <div class="form-group">
                                                    <label for="localidad">Localidad</label>
                                                    <input v-model="paciente.localidad" type="text" name="localidad" id="localidad" class="form-control" placeholder="Ingrese Localidad" aria-describedby="helpId">
                                                    <small id="bodyhelpId" class="text-muted"></small>
                                                    <span class="text-danger" v-if="errors.localidad">{{ errors.apellido }}</span>
                                                </div>
                                            </div>
                                            <div class="col-3 col-md-3">
                                                <label for="cod_post">Cod Postal</label>
                                                <input v-model="paciente.codigo_postal" type="text" name="cod_p" id="cod_p" class="form-control" placeholder="Cod-Postal" aria-describedby="helpId">
                                                <small id="bodyhelpId" class="text-muted"></small>
                                                <span class="text-danger" v-if="errors.codigo_postal">{{ errors.mail }}</span>
                                            </div>

                                            <div class="col-3 col-md-3">
                                                <div class="form-group">
                                                    <label for="tipo_documento">Tipo DOC</label>
                                                    <b-form-select v-model="paciente.tipo_documento" ref='selected' :options="docs" id="doc"></b-form-select>
                                                    <div class="mt-3"><strong>{{ paciente.tipo_docomento}}</strong></div>
                                                </div>
                                            </div>
                                            <div class="col-3 col-md-3">
                                                <div class="form-group">
                                                    <label for="nro_doc">Num DOC</label>
                                                    <input v-model="paciente.nro_documento" type="text" name="nro_doc" id="nro_doc" class="form-control" placeholder="Ingrese num de documento" aria-describedby="helpId">
                                                    <small id="bodyhelpId" class="text-muted"></small>
                                                    <span class="text-danger" v-if="errors.nro_documento">{{ errors.nro_documento }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-12 col-md-4">
                                                <label for="sexo">Sexo</label>
                                                <b-form-select v-model="paciente.sexo" :options="sexos" id="sexo"></b-form-select>
                                            </div>
                                            <div class="col-6 col-md-4">
                                                <div class="form-group">
                                                    <label for="fecha_nacimiento">Fecha-Nacimiento</label>
                                                    <input v-model="paciente.fecha_nacimiento" type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" placeholder="Ingrese fecha de nacimiento" aria-describedby="helpId">
                                                    <small id="titlehelpId" class="text-muted"></small>
                                                    <small id="bodyhelpId" class="text-muted"></small>
                                                    <span class="text-danger" v-if="errors.fecha_nacimiento">{{ errors.fecha_nacimiento }}</span>

                                                </div>
                                            </div>
                                            <div class="col-6 col-md-4">
                                                <div class="form-group">
                                                    <label for="obrasocial">Selecciona la Obra-Social</label>
                                                    <select id="selectObraSocial" class="form-control" v-model="paciente.obrasocial_id">
                                                        <option :value="pac.id" v-for="pac in obrasocial">
                                                            {{pac.nombre}}
                                                        </option>
                                                    </select>
                                                    <small id="bodyhelpId" class="text-muted"></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-4 col-md-4">
                                                <label for="sexo">Email</label>
                                                <input v-model="paciente.mail" type="text" name="mail" id="mail" class="form-control" placeholder="Ingrese su email" aria-describedby="helpId">
                                                <small id="bodyhelpId" class="text-muted"></small>
                                                <span class="text-danger" v-if="errors.mail">{{ errors.mail }}</span>
                                            </div>
                                            <div class="col-6 col-md-4">
                                                <div class="form-group">
                                                    <label for="celular">Celular</label>
                                                    <input v-model="paciente.celular" type="text" name="celular" id="celular" class="form-control" placeholder="Ingrese num de Cel" aria-describedby="helpId">
                                                    <small id="bodyhelpId" class="text-muted"></small>
                                                    <span class="text-danger" v-if="errors.celular">{{ errors.celular }}</span>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-4">
                                                <div class="form-group">
                                                    <label for="telefono">Telefono</label>
                                                    <input v-model="paciente.telefono" type="text" name="telefono" id="telefono" class="form-control" placeholder="Ingrese num de Tel" aria-describedby="helpId">
                                                    <small id="bodyhelpId" class="text-muted"></small>
                                                    <span class="text-danger" v-if="errors.detalle">{{ errors.telefono }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-3 col-md-3">
                                                <div class="form-group">
                                                    <label for="sexo">Nombre y Apellido Materno</label>
                                                    <input v-model="paciente.ape_nomb_materno" type="text" name="nom_mat" id="nom_mat" class="form-control" placeholder="Nombre y Apellido Materno" aria-describedby="helpId">
                                                    <small id="bodyhelpId" class="text-muted"></small>
                                                    <span class="text-danger" v-if="errors.ape_nomb_materno">{{ errors.nom_ape_mat }}</span>
                                                </div>
                                            </div>
                                            <div class="col-3 col-md-3">
                                                <div class="form-group">
                                                    <label for="sexo">Nombre y Apellido Paterno</label>
                                                    <input v-model="paciente.ape_nomb_paterno" type="text" name="nom_pat" id="nom_pat" class="form-control" placeholder="Nombre y Apellido Paterno" aria-describedby="helpId">
                                                    <small id="bodyhelpId" class="text-muted"></small>
                                                    <span class="text-danger" v-if="errors.ape_nomb_paterno">{{ errors.nom_ape_pat }}</span>
                                                </div>
                                            </div>

                                            <div class="col-3 col-md-3">
                                                <div class="form-group">
                                                    <label for="sexo">Nombre del responsable</label>
                                                    <input v-model="paciente.responsable_nombre" type="text" name="responsable_nombre" id="responsable_nombre" class="form-control" placeholder="Ingrese su nombre" aria-describedby="helpId">
                                                    <small id="bodyhelpId" class="text-muted"></small>
                                                    <span class="text-danger" v-if="errors.responsable_nombre">{{ errors.responsable_nombre }}</span>
                                                </div>
                                            </div>
                                            <div class="col-3 col-md-3">
                                                <div class="form-group">
                                                    <label for="Tel-Resp">Tel- Responsable</label>
                                                    <input v-model="paciente.responsable_telefono" type="text" name="responsable_telefono" id="responsable_telefono" class="form-control" placeholder="Ingrese su Tel" aria-describedby="helpId">
                                                    <small id="bodyhelpId" class="text-muted"></small>
                                                    <span class="text-danger" v-if="errors.responsable_telefono">{{ errors.responsable_telef }}</span>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">


                                        </div>

                                    </div>

                                </div>
                                <!-- pestaña enfermedades paciente -->
                                <div class="tab-pane fade" id="enfermedad">
                                    <div class="justify-content-center">
                                        <legend>Seleccione patologias pre-existentes</legend>
                                        <ul>
                                            <li v-for="(pat,i) in patologias">
                                                <label :for="pat.nombre">{{pat.nombre}}</label>
                                                <input v-if="paciente" type="checkbox" :id="pat.nombre" v-model="patologias[i].estado">
                                            </li>
                                        </ul>
                                        <div v-if="!isNewRecord">
                                            <legend>Patologias del paciente :</legend>
                                            <div v-for="pato in paciente.patologias">
                                                <label>- {{pato.nombre}}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>

                    <template v-slot:modal-footer="{ok, cancel, hide}">

                        <button v-if="isNewRecord" @click="addPacientes()" type="button" class="btn btn-primary m-3">Nuevo Paciente</button>
                        <button v-if="!isNewRecord" @click="updatePacientes(paciente.id_paciente)" type="button" class="btn btn-primary m-3">Actualizar</button>

                    </template>
                    <!-- <template v-slot:modal-footer="{ok, cancel, hide}">
                        <b-row class="justify-content-center">
                            <div>
                                <b-button v-if="isNewRecord" @click="addPacientes()" variant="warning" size="lg">Crear Nuevo Paciente</b-button>
                                <b-button v-if="!isNewRecord" @click=updatePacientes(paciente.id_paciente) variant="warning" size="lg">Actualizar</b-button>
                            </div>
                        </b-row>
                    </template> -->
                </b-modal>
                <!-- Termina el modal -->
                <p>
                    <template>
                        <div>
                            <b-table-simple stacked='md' class="table bordered" bordered :head-variant="headVariant" :table-variant="tableVariant">
                                <b-thead head-variant="dark">
                                    <template>
                                        <b-tr>
                                            <b-th>Nombre y Apellido</b-th>
                                            <b-th>Dni</b-th>
                                            <b-th>Celular</b-th>
                                            <b-th>Tel. responsable</b-th>
                                            <b-th>Opciones</b-th>
                                        </b-tr>
                                        <div id="app">
                                    </template>
                                    <template>
                                        <b-tr>
                                            <b-td>
                                                <input v-on:change="getPacientes()" class="form-control" v-model="filter.nombre">
                                            </b-td>
                                            <b-td>
                                                <input v-on:change="getPacientes()" class="form-control" v-model="filter.apellido">
                                            </b-td>
                                            <b-td>

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
                                        <b-tr v-for="(pac,key) in pacientes" v-bind:key="pac.id_paciente">
                                            <b-td>{{pac.nombre}} {{pac.apellido}}</b-td>
                                            <b-td>{{pac.nro_documento}}</b-td>
                                            <b-td>{{pac.celular}}</b-td>
                                            <b-td>{{pac.responsable_telefono}}</b-td>
                                            <b-td>
                                                <button @click="showModal=true" v-on:click="editPacientes(key)" type="button" class="btn btn-success">Editar</button>
                                                <button v-on:click="deletePacientes(pac.id_paciente)" type="button" class="btn btn-danger">Borrar</button>
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
</b-col>
</b-row>
</div>

<!-- modal Paciente -->

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
                docs: ['DNI', 'CARNET EXTRANJERO', 'RUC', 'PASAPORTE', 'P.NAC', 'OTROS'],
                sexos: ['FEMENINO', 'MASCULINO', 'OTROS'],
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
            showModal() {
                if (!this.showModal) {
                    this.paciente = {};
                    this.errors = [];
                }
            },
            currentPage: function() {
                this.getPacientes();
            }
        },
        computed: {
            sortedArray: function() {
                function compare(a, b) {
                    if (a.this.getObrasociales() < b.this.getObrasociales())
                        return -1;
                    if (a.this.getObrasociales() > b.this.getObrasociales())
                        return 1;
                    return 0;
                }

                return this.arrays.sort(compare);
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
                        self.obrasocial.sort((a, b) => {
                            let obraA = a.nombre.toUpperCase();
                            let obraB = b.nombre.toUpperCase();
                            if (obraA < obraB) {
                                return -1;
                            }
                            if (obraA > obraB) {
                                return 1;
                            }
                            return 0;
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
                params.append('localidad', self.paciente.localidad);
                params.append('direccion', self.paciente.direccion);
                params.append('codigo_postal', self.paciente.codigo_postal);
                params.append('telefono', self.paciente.telefono);
                params.append('celular', self.paciente.celular);
                params.append('sexo', self.paciente.sexo);
                params.append('tipo_documento', self.paciente.tipo_documento);
                params.append('nro_documento', self.paciente.nro_documento);
                params.append('ape_nomb_materno', self.paciente.ape_nomb_materno);
                params.append('ape_nomb_paterno', self.paciente.ape_nomb_paterno);
                params.append('obrasocial_id', self.paciente.obrasocial_id);
                params.append('fecha_nacimiento', self.paciente.fecha_nacimiento);
                params.append('responsable_nombre', self.paciente.responsable_nombre);
                params.append('responsable_telefono', self.paciente.responsable_telef);
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