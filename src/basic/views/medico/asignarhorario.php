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
        <select class="form-control" v-model=medico.id_medico @change="getMedico" v-on:crange="getMedicoHorarioAtencion()" v-model=filterxhorario.medico_id>
            <option v-for="medic in medicos" :value="medic.id_medico">
                {{medic.apellido}}
            </option>
        </select>
    </div>

    <div class="form-group" v-if="medico.especialidad">
        <h4>Especialidad: {{ medico.especialidad.nombre }}</h4>
    </div>

    <p>
        <b-button @click="showModal1=true" type='button' block variant="primary">Asignar Horario</button>
    </p>

  
    <!-- Comienza Modal -->
    <b-modal v-model="showModal1" title="Asignar Horario" :header-bg-variant="headerBgVariant" :header-text-variant="headerTextVariant" :body-bg-variant="bodyBgVariant" :body-text-variant="bodyTextVariant" :footer-bg-variant="footerBgVariant" :footer-text-variant="footerTextVariant" id="my-modal">
        <form action="">
            <div class="form-group">
                <label for="medico">Elija un horario</label>
                <select class="form-control" v-model="medicoHorario.horario_atencion_id">
                    <option v-for="hora in horarios" :value="hora.id_horarioAtencion">
                        {{hora.dia}} - {{hora.deste}} - {{hora.hasta}}
                    </option>
                </select>
            </div>

        </form>

        <template v-slot:modal-footer="{ok, cancel, hide}">
            <button v-if="isNewRecord" @click="addMedicoHorarioAtencion()" type="button" class="btn btn-primary m-3">Crear</button>
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
                            </b-tr>
                            <div id="app">
                        </template>
                        <template>

                        </template>
                    </b-thead>
                    <b-tbody table-variant="warning" v-if='medico.id_medico != medicoHorario.medico_id'>
                        <b-tr v-for="hora in medico.horarioatencions" :key="medico.horarioatencions.id_horarioAtencion">
                        <!-- <b-tr v-for="hora in filtroHorariosxMedico"> -->
                            <b-td scope="row">{{hora.id_horarioAtencion}}</b-td>
                            <b-td>{{hora.dia}}</b-td>
                            <b-td>{{hora.deste}}</b-td>
                            <b-td>{{hora.hasta}}</b-td>
                            <b-td>
                                <!-- <button @click="showModal=true" v-on:click="editHorarioatencion(key)" type="button" class="btn btn-success">Editar</button> -->
                                <button v-on:click="deleteMedicoHorarioatencion(medico.id_medico,hora.id_horarioAtencion)" type="button" class="btn btn-danger">Borrar</button>
                            </b-td>
                        </b-tr>
                    </b-tbody>
                    </b-table>
                    
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
                msg: "HORARIOS DE ATENCION",
                dias: ['LUNES', 'MARTES', 'MIERCOLES', 'JUEVES', 'VIERNES'],
                horarios: [], //tabla horariosatencion de todos los medicos
                horarioAtencion: {}, //nuevo horario de la tabla horarioatencion
                medicos: [], //todos los medicos
                medico: {}, //el medico seleccionado
                medicoHorario: {}, //nuevo horario de la tabla medicohorarioatencion
                medicoHoraioAtencion: [], //todos las relaciones medico-horario
                //horarioxMedico: {}, //lista los datos de un medico (especialidad y horariosatencion)
                filterxMedico: {}, //filtra los medicos
                filter: {}, // filtra los horariosatencion
                filterxhorario: [], //filtrar hoarios por medicos
                filtroHorarioxMedico: [],
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
                // this.getHorariosatencion();
                
            }

        },

        computed: {
            filtroHorariosxMedico() {
                // if (this.medico.id_medico != null) 
                return this.medicoHoraioAtencion.filter(mHAtencion => {
                    return this.mHAtencion.medico_id != this.medico.id_medico;
                })
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
                        self.medicos.sort((a, b) => {
                            if (a.dia < b.dia){
                                return -1;
                            }
                            if (a.dia > b.dia){
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
            getMedico: function() {
                var self = this;
                axios.get('/apiv1/medico/' + self.medico.id_medico, )
                    .then(function(response) {
                        // handle success
                        console.log(response.data);
                        console.log("Se trajo al medico");
                        self.medico = response.data;
                        //self.mykey += 1;
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
                        self.medicoHoraioAtencion = response.data;
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

            addMedicoHorarioAtencion: function() {
                var self = this;
                self.medicoHorario.medico_id = self.medico.id_medico;
                axios.post('/apiv1/medicohorarioatencion', self.medicoHorario)
                    .then(function(response) {
                        // handle success
                        console.log(response.data);
                        //self.getMedicoHorariosAtencion();
                        // self.posts.unshift(response.data);
                        self.medicohorario = {};
                        self.getMedicoHorarioAtencion();
                        self.mykey += 1;
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

            deleteMedicoHorarioatencion: function(mid,id) {
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
                        axios.delete('/apiv1/medicohorarioatencion/' + mid + ',' + id)
                            .then(function(response) {
                                // handle success
                                console.log("borra medicohorarioatencion id: " + mid + id);
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
                axios.get('/apiv1/horarioatencion', {
                        params: self.filter
                    })
                    .then(function(response) {
                        // handle success
                        console.log(response.data);
                        console.log("Se obtuvo todas los horarios");
                        
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


            editHorarioatencion: function(key) {
                this.horarioAtencion = Object.assign({}, this.horarios[key]);
                this.horarioAtencion.key = key;
                this.isNewRecord = false;
            },

            addHorarioatencion: function() {
                var self = this;
                axios.post('/apiv1/horarioatencion', self.horarioAtencion)
                    .then(function(response) {
                        // handle success
                        console.log(response.data);
                        self.getHorariosatencion();
                        // self.posts.unshift(response.data);
                        self.horarioAtencion = {};
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
                params.append('dia', self.horarioAtencion.dia);
                params.append('deste', self.horarioAtencion.deste);
                params.append('hasta', self.horarioAtencion.hasta);
                axios.patch('/apiv1/horarioatencion/' + key, params)
                    .then(function(response) {
                        // handle success
                        console.log(response.data);
                        self.getHorariosatencion();
                        self.horarioAtencion = {};
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