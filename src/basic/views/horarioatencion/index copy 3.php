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
  
    <div class="form-group">
        <label for="medico">Elija un medico</label>
        <select class="form-control" v-model=medico.id_medico @change="getMedico"  >
            <option v-for="medic in medicos" :value="medic.id_medico">
                {{medic.apellido}}
            </option>
        </select>
    </div>
       
    <div class="form-group" v-if="medico.especialidad">
        <h4>Especialidad: {{ medico.especialidad.nombre }}</h4>
    </div>

    <p>
        <b-button @click="showModal=true" type='button' block variant="primary">Nuevo Horario</button>
    </p>

    <p>
        <b-button @click="showModal1=true" type='button' block variant="primary">Asignar Horario</button>
    </p>
    <!-- Primer Modal -->
    <b-modal v-model="showModal" title="Horarioatencion" :header-bg-variant="headerBgVariant" :header-text-variant="headerTextVariant" :body-bg-variant="bodyBgVariant" :body-text-variant="bodyTextVariant" :footer-bg-variant="footerBgVariant" :footer-text-variant="footerTextVariant" id="my-modal">
        <form action="">
            <div class="form-group">
                <label for="dia">Día de la Semana</label>
                <b-form-select v-model="horarioatencion.dia" :options="dias"></b-form-select>
                <div class="mt-3"><strong>{{ horarioatencion.dia }}</strong></div>
            </div>
            <div class="form-group">
                <label for="desde">Desde</label>
                <input v-model="horarioatencion.deste" type="time" name="desde" id="desde" class="form-control" placeholder="Ingrese horario" aria-describedby="helpId">
                <small id="bodyhelpId" class="text-muted"></small>
                <span class="text-danger" v-if="errors.deste">{{ errors.detalle }}</span>
            </div>
            <div class="form-group">
                <label for="hasta">Hasta</label>
                <input v-model="horarioatencion.hasta" type="time" name="hasta" id="hasta" class="form-control" placeholder="Ingrese horario" aria-describedby="helpId">
                <small id="bodyhelpId" class="text-muted"></small>
                <span class="text-danger" v-if="errors.hasta">{{ errors.detalle }}</span>
            </div>

        </form>
        <template v-slot:modal-footer="{ok, cancel, hide}">
            <button v-if="isNewRecord" @click="addHorarioatencion()" type="button" class="btn btn-primary m-3">Crear</button>
            <!-- <button v-if="!isNewRecord" @click="isNewRecord = !isNewRecord" v-on:click="especialidad={}" type="button" class="btn btn-success m-3">Nuevo</button> -->
            <button v-if="!isNewRecord" @click="updateHorarioatencion(horarioatencion.id_horarioAtencion)" type="button" class="btn btn-primary m-3">Actualizar</button>

        </template>
    </b-modal>
    <!-- Termina el modal -->

    <!-- Segundo Modal -->
    <b-modal v-model="showModal1" title="asignarHorario" :header-bg-variant="headerBgVariant" :header-text-variant="headerTextVariant" :body-bg-variant="bodyBgVariant" :body-text-variant="bodyTextVariant" :footer-bg-variant="footerBgVariant" :footer-text-variant="footerTextVariant" id="my-modal">
        <form action="">
            <div class="form-group">
                <label for="medico">Elija un horario</label>
                <select class="form-control"  v-model="medicohorario.horario_atencion_id">
                    <option v-for="hora in horarios" :value="hora.id_horarioAtencion">
                        {{hora.dia}} - {{hora.deste}} - {{hora.hasta}}
                    </option>
                </select>
            </div>
    
        </form>

        <template v-slot:modal-footer="{ok, cancel, hide}">
            <button v-if="isNewRecord" @click="addMedicoHorarioatencion()" type="button" class="btn btn-primary m-3">Crear</button>
            <!-- <button v-if="!isNewRecord" @click="isNewRecord = !isNewRecord" v-on:click="especialidad={}" type="button" class="btn btn-success m-3">Nuevo</button> -->
            <!-- <button v-if="!isNewRecord" @click="updateHorarioatencion(horarioatencion.id_horarioAtencion)" type="button" class="btn btn-primary m-3">Actualizar</button> -->

        </template>

    </b-modal> 
    <!-- Termina el modal  -->
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
                        <b-tbody table-variant="warning" v-if= 'medico.id_medico != medicohorario.medico_id' >
                            <b-tr v-for="hora in medico.horarioatencions" :key="hora.id_horarioAtencion">
                                <b-td scope="row">{{hora.id_horarioAtencion}}</b-td>
                                <b-td>{{hora.dia}}</b-td>
                                <b-td>{{hora.deste}}</b-td>
                                <b-td>{{hora.hasta}}</b-td>
                                <b-td>
                                    <!-- <button @click="showModal=true" v-on:click="editHorarioatencion(key)" type="button" class="btn btn-success">Editar</button> -->
                                    <button v-on:click="deleteHorarioatencion(hora.id_horarioAtencion)" type="button" class="btn btn-danger">Borrar</button>
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
                mykey:0,
                msg: "HORARIOS DE ATENCION",
                dias: ['LUNES', 'MARTES', 'MIERCOLES', 'JUEVES', 'VIERNES'],
                horarios: [], //horarios de todos los medicos
                horarioatencion: {}, //nuevo horario de la tabla horarioatencion
                medicos: [], //todos los medicos
                medico:{} ,//el medico seleccionado
                medicohorario: {}, //nuevo horario de la tabla medicohorarioatencion
                medicoHoraioAtencion: [], //todos las relaciones medico-horario
                horarioxMedico: {}, //lista los datos de un medico (especialidad y horariosatencion)
                filterxmedico: {}, //filtra los medicos
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
            this.getHorariosatencion();
            this.getMedicos();
            this.getMedicoHorarioAtencion();
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

            // getHorarioxMedico: function (medicos){
            //     //var horarioxMedico = [];
            //     for (var i = 0; i < medicos.length; i++) { 
            //         if (this.horarioxMedico.length != 0) {
            //             this.horarioxMedico.shift();
            //             if ( medicos[i].id_medico === this.medicohorario.medico_id) {
            //                 return this.horarioxMedico.push(medicos[i]);
            //             }                        
            //         } else {
            //             if ( medicos[i].id_medico === this.medicohorario.medico_id) {
            //                 return this.horarioxMedico.push(medicos[i]);
            //             }
            //         }
            //     }
            // },

            //operaciones tabla medicos


            getMedicos: function() {
                var self = this;
                axios.get('/apiv1/medico?page=' + self.currentPage, {
                        params: self.filterxmedico
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
            getMedico: function() {
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
            
            //operaciones tabla MedicoHorarioAtencion

            getMedicoHorarioAtencion: function() {
                var self = this;
                axios.get('/apiv1/medicohorarioatencion?page=' + self.currentPage, {
                        params: self.filterxhorario
                    })
                    .then(function(response) {
                        // handle success
                        console.log(response.data);
                        console.log("Se obtuvo todos los horarios por medicos");
                        self.medicoHorarioAtencion = response.data;
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

            addMedicoHorarioatencion: function() {
                var self = this;
                self.medicohorario.medico_id = self.medico.id_medico;
                axios.post('/apiv1/medicohorarioatencion', self.medicohorario)
                    .then(function(response) {
                        // handle success
                        console.log(response.data);
                        //self.getMedicoHorariosAtencion();
                        // self.posts.unshift(response.data);
                        //self.medicohorario = {};
                        self.getMedico();
                        self.showModal1 = false;
                    
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

            deleteMedicoHorarioatencion: function(id) {
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
                        axios.delete('/apiv1/medicohorarioatencion/' + id)
                            .then(function(response) {
                                // handle success
                                console.log("borra medicohorarioatencion id: " + id);
                                console.log(response.data);
                                self.getMedico();
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

            //operaciones tabla horarioAtencion
            getHorariosatencion: function() {
                var self = this;
                axios.get('/apiv1/horarioatencion?page=' + self.currentPage, {
                        params: self.filter
                    })
                    .then(function(response) {
                        // handle success
                        console.log(response.data);
                        console.log("Se obtuvo todas los horarios");
                        self.pagination.total = parseInt(response.headers['x-pagination-total-count']);
                        self.pagination.totalPages = parseInt(response.headers['x-pagination-page=count']);
                        self.pagination.perPage = parseInt(response.headers['x-pagination-per-page']);
                        self.horarios = response.data;
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

            deleteHorarioatencion: function(id) {
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
                        axios.delete('/apiv1/horarioatencion/' + id)
                            .then(function(response) {
                                // handle success
                                console.log("borra horarioatencion id: " + id);
                                console.log(response.data);
                                self.getHorariosatencion();
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

            // deleteHorarioatencion: function(id) {
            //     Swal.fire({
            //         title: 'Esta seguro que desea borrar el registro ' + id + '?',
            //         icon: 'warning',
            //         showCancelButton: true,
            //         showConfirmButton: true,
            //         confirmButtonText: 'Si borrar!',
            //         cancelButtonText: 'No, regresar.',
            //     }).then((result) => {
            //         if (result.value) {
            //             var self = this;
            //             axios.delete('/apiv1/horarioatencion/' + id)
            //                 .then(function(response) {
            //                     // handle success
            //                     console.log("borra horarioatencion id: " + id);
            //                     console.log(response.data);
            //                     self.getMedico();
            //                 })
            //                 .catch(function(error) {
            //                     // handle error
            //                     console.log(error);
            //                 })
            //                 .then(function() {
            //                     // always executed
            //                 });
            //             Swal.fire({
            //                 title: 'Se ha borrado con exito',
            //                 icon: 'success',
            //             })
            //         }
            //     }, );
            // },

            editHorarioatencion: function(key) {
                this.horarioatencion = Object.assign({}, this.horarios[key]);
                this.horarioatencion.key = key;
                this.isNewRecord = false;
            },
            addHorarioatencion: function() {
                var self = this;
                axios.post('/apiv1/horarioatencion', self.horarioatencion)
                    .then(function(response) {
                        // handle success
                        console.log(response.data);
                        self.getHorariosatencion();
                        // self.posts.unshift(response.data);
                        self.horarioatencion = {};
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
            updateHorarioatencion: function(key) {
                var self = this;
                const params = new URLSearchParams();
                params.append('dia', self.horarioatencion.dia);
                params.append('deste', self.horarioatencion.deste);
                params.append('hasta', self.horarioatencion.hasta);
                axios.patch('/apiv1/horarioatencion/' + key, params)
                    .then(function(response) {
                        // handle success
                        console.log(response.data);
                        self.getHorariosatencion();
                        self.horarioatencion = {};
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