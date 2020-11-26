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

    <div v-if="paciente != null">
                <b-table-simple stacked='md' class="table bordered" bordered :head-variant="headVariant" :table-variant="tableVariant">
                    <b-thead head-variant="dark">
                        <template>
                            <b-tr>
                                <b-th>Nombre</b-th>
                                <b-th>Apellido</b-th>
                                <b-th>Especialidad</b-th>
                                <b-th>Opciones</b-th>
                            </b-tr><div id="app">
                        </template>
                        <template>
                            <b-tr>
                                <b-td>
                                    <input v-on:keyup="getMedicos()" class="form-control" v-model="filterxMedico.nombre">
                                </b-td>
                                <b-td>
                                    <input v-on:keyup="getMedicos()" class="form-control" v-model="filterxMedico.apellido">
                                </b-td>
                                <b-td>
                                    <input v-on:keyup="getMedicos()" class="form-control" v-model="filterxMedico.especialidad">
                                </b-td>
                                
                                
                                <b-td>
                                    
                                </b-td>
                            </b-tr>
                        </template>
                    </b-thead>
                    <template>
                        <b-tbody table-variant="warning">
                            <b-tr v-for="(medic,key) in medicos" v-bind:key="medic.id_medico">
                                <b-td scope="row">{{medic.nombre}}</b-td>
                                <b-td>{{medic.apellido}}</b-td>
                                <b-td>{{medic.especialidad.nombre}}</b-td>
                                <b-td>{{medic.horarioatencions.dia}}</b-td>
                                <b-td>
                                    <button @click="editMedico(key)"  type="button" class="btn btn-success">Selecionar</button>
                                    
                                </b-td>
                            </b-tr>
                        </b-tbody>
                    </template>
                    </b-table>
                    <b-container class="m-3">
                        <b-pagination v-model="currentPage" :total-rows="pagination.total" :per-page="pagination.perPage" aria-controls="my-table"></b-pagination>
                    </b-container>
            </div>
  
    
    
       
    <div class="form-group" v-if="medico.especialidad">
        <h4>Dr. {{ medico.nombre }} {{ medico.apellido }}  -  Especialidad: {{ medico.especialidad.nombre }}</h4>
    </div>

    <!-- Inicio Modal -->
    <b-modal v-model="showModal" title="Turnos" :header-bg-variant="headerBgVariant" :header-text-variant="headerTextVariant" :body-bg-variant="bodyBgVariant" :body-text-variant="bodyTextVariant" :footer-bg-variant="footerBgVariant" :footer-text-variant="footerTextVariant" id="my-modal">
        <form action="">
            <div class="form-group">
                <label for="paciente">Elija un paciente</label>
                <input v-on:keyup="getPaciente()" class="form-control" v-model="filterxPaciente.apellido">
                <div class="form-group" v-if="paciente.obrasocial">
                    <!-- <span>{{ paciente.nombre }} {{ paciente.apellido }} - Obra Social: {{ paciente.obrasocial.nombre }}</span> -->
                </div>  
                <!-- <select class="form-control" v-model=paciente.id_paciente @change="getPaciente"  >
                    <option v-for="paci in pacientes" :value="paci.id_paciente">
                        {{paci.apellido}}
                    </option>
                </select> -->
            </div>
            <div class="form-group">
                <label for="nroOrden">Nro. de Orden</label>
                <input v-model="turno.nro_orden" type="namber" name="nroOrden" id="nroOrden" class="form-control" placeholder="Ingrese nro de orden " aria-describedby="helpId">
                <small id="bodyhelpId" class="text-muted"></small>
                <span class="text-danger" v-if="errors.nro_orden">{{ errors.detalle }}</span>
            </div>
            <div class="form-group">
                <label for="fechaConsulta">Fecha</label>
                <input v-model="turno.fecha_consulta" type="date" name="fechaConsulta" id="fechaConsulta" class="form-control" placeholder="Ingrese fecha" aria-describedby="helpId">
                <small id="bodyhelpId" class="text-muted"></small>
                <span class="text-danger" v-if="errors.fehca_consulta">{{ errors.detalle }}</span>
            </div>

            <div class="form-group">
                <label for="horaConsulta">Hora</label>
                <input v-model="turno.hora_consulta" type="time" name="horaConsulta" id="horaConsulta" class="form-control" placeholder="Ingrese hora" aria-describedby="helpId">
                <small id="bodyhelpId" class="text-muted"></small>
                <span class="text-danger" v-if="errors.hora_consulta">{{ errors.detalle }}</span>
            </div>

        </form>
        <template v-slot:modal-footer="{ok, cancel, hide}">
            <button v-if="isNewRecord" @click="addturno()" type="button" class="btn btn-primary m-3">Crear</button>
            <!-- <button v-if="!isNewRecord" @click="isNewRecord = !isNewRecord" v-on:click="especialidad={}" type="button" class="btn btn-success m-3">Nuevo</button> -->
            <button v-if="!isNewRecord" @click="updateTurno(turno.id_turno)" type="button" class="btn btn-primary m-3">Actualizar</button>

        </template>
    </b-modal>
    <!-- Termina el modal -->

    <p>
        <template>
            <div :key="mykey">
                <b-table-simple stacked='md' class="table bordered" bordered :head-variant="headVariant" :table-variant="tableVariant">
                    <b-thead head-variant="dark">
                        <template>
                            <b-tr>
                                <b-th>Id</b-th>
                                <b-th>Día</b-th>
                                <b-th>Desde</b-th>
                                <b-th>Hasta</b-th>
                                <b-th>Opciones</b-th>
                            </b-tr><div id="app">
                        </template>
                        <template>
                            
                        </template>
                    </b-thead>
                    <template>
                        <b-tbody table-variant="warning">
                            <b-tr v-for="hora in medico.horarioatencions" :key="hora.id_horarioAtencion">
                                <b-td scope="row">{{hora.id_horarioAtencion}}</b-td>
                                <b-td>{{hora.dia}}</b-td>
                                <b-td>{{hora.deste}}</b-td>
                                <b-td>{{hora.hasta}}</b-td>
                                <b-td>
                                    <button @click="showModal=true" type='button' class="btn btn-primary">Agregar Turno</button>
                                    <!-- <button @click="showModal=true" v-on:click="editHorarioatencion(key)" type="button" class="btn btn-success">Editar</button> -->
                                    <!-- <button v-on:click="deleteHorarioatencion(hora.id_horarioAtencion)" type="button" class="btn btn-danger">Borrar</button> -->
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
                mykey: 0,
                msg: "TURNOS",
                dias: [],
                horarioAtencion: [],
                pacientes: [], //tabla de todos los pacientes
                paciente: {}, //el paciente seleccionado
                medicos: [], //todos los medicos
                medico:{} , //el medico seleccionado
                turno: {}, //nuevo turno
                turnos: [], //todos los turnos
                //horarioxMedico: {}, //lista los datos de un medico (especialidad y horariosatencion)
                filterxMedico: {}, //filtra los medicos
                filterxPaciente: {},
                filter: {}, // filtra los horariosatencion
                errors: {},
                isNewRecord: true,
                currentPage: 1,
                pagination: {},
                visible: true,
                showModal: false,
                showModal1: false,
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
            this.getMedicos();
            this.getTurnos();
        },
        watch: {
            currentPage: function() {
                this.getHorariosatencion();
            }
            
        },

        computed: {
            
        },
        methods: {
            normalizeErrors: function(errors) {
                var allErrors = {};
                for (var i = 0; i < errors.length; i++) {
                    allErrors[errors[i].field] = errors[i].message;
                }
                return allErrors;
            },
     
            //operaciones tabla medicos

            getMedicos: function() {
                var self = this;
                axios.get('/apiv1/medico?page=' + self.currentPage, {
                        params: self.filterxMedico
                    })
                    .then(function(response) {
                        // handle success
                        console.log(response.data);
                        console.log("Se obtuvo todos los medicos");
                        self.medicos = response.data;
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
            getMedico: function(key) {
                var self = this;
                axios.get('/apiv1/medico/'+self.medico.id_medico, )
                    .then(function(response) {
                        // handle success
                        console.log(response.data);
                        console.log("Se trajo al medico");
                        self.medico = response.data;
                        self.mykey += 1;
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

            editMedico: function(key) {
                this.medico = Object.assign({}, this.medicos[key]);
                this.medico.key = key;
                this.isNewRecord = false;
            },
            // operaciones con tabla pacientes
            getPacientes: function() {
                var self = this;
                axios.get('/apiv1/paciente?page=' + self.currentPage, {
                        params: self.filterxPaciente
                    })
                    .then(function(response) {
                        // handle success
                        console.log(response.data);
                        console.log("Se obtuvo todos los pacientes");
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
            getPaciente: function() {
                var self = this;
                axios.get('/apiv1/paciente/'+self.paciente.id_paciente, )
                    .then(function(response) {
                        // handle success
                        console.log(response.data);
                        console.log("Se trajo al paciente");
                        self.paciente = response.data;
                        self.mykey += 1;
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
            
            //operaciones tabla Turno

            getTurnos: function() {
                var self = this;
                axios.get('/apiv1/turno?page=' + self.currentPage, {
                        params: self.filter
                    })
                    .then(function(response) {
                        // handle success
                        console.log(response.data);
                        console.log("Se obtuvo todas los turnos");
                        self.pagination.total = parseInt(response.headers['x-pagination-total-count']);
                        self.pagination.totalPages = parseInt(response.headers['x-pagination-page=count']);
                        self.pagination.perPage = parseInt(response.headers['x-pagination-per-page']);
                        self.turnos = response.data;
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

            deleteTurno: function(id) {
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
                        axios.delete('/apiv1/turno/' + id)
                            .then(function(response) {
                                // handle success
                                console.log("borra turno id: " + id);
                                console.log(response.data);
                                self.getTurnos();
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

            
            editTurno: function(key) {
                this.turno = Object.assign({}, this.turno[key]);
                this.turno.key = key;
                this.isNewRecord = false;
            },

            addTurno: function() {
                var self = this;
                axios.post('/apiv1/turno', self.turno)
                    .then(function(response) {
                        // handle success
                        console.log(response.data);
                        self.getTurnos();
                        // self.posts.unshift(response.data);
                        self.turno = {};
                        self.showModal = false;
                    })
                    .catch(function(error) {
                        // handle error
                        self.errors = self.normalizeErrors(error.response.data);
                        console.log(self.errors);

                    })
                    .then(function() {
                        // always executed
                    });
                Swal.fire({
                    title: 'Se creo el registro correctamente',
                    icon: 'success',
                    showConfirmButton: true,
                    confirmButtonText: 'Aceptar',
                })
            },
            updateTurno: function(key) {
                var self = this;
                const params = new URLSearchParams();
                params.append('nro_orden', self.turno.nro_orden);
                params.append('fecha_registro', self.turno.fecha_registro);
                params.append('fecha_consulta', self.turno.fecha_consulta);
                params.append('hora_consulta', self.turno.hora_consulta);
                axios.patch('/apiv1/turno/' + key, params)
                    .then(function(response) {
                        // handle success
                        console.log(response.data);
                        self.getTurnos();
                        self.turno = {};
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