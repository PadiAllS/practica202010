<?php
/* @var $this yii\web\View */

//$this->registerCssFile("https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css",['position'=>$this::POS_HEAD]);
$this->registerCssFile("//unpkg.com/bootstrap/dist/css/bootstrap.min.css", ['position' => $this::POS_HEAD]);
$this->registerCssFile("//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.css", ['position' => $this::POS_HEAD]);

$this->registerJsFile("https://cdn.jsdelivr.net/npm/vue/dist/vue.js", ['position' => $this::POS_HEAD]);
$this->registerJsFile("https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js", ['position' => $this::POS_HEAD]);$this->registerJsFile("https://unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.js", ['position' => $this::POS_HEAD]);


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
        <label for="medico">Elija un paciente</label>
        <select class="form-control" v-model=paciente.id_paciente @change="getPaciente" v-model=filterxhorario.paciente_id>
            <option v-for="paci in pacientes" :value="paci.id_paciente">
                Sr/a: {{ paci.apellido}} {{paci.nombre}}
            </option>
        </select>
    </div>

    <div class="form-group">
        <label for="medico">Elija un medico</label>
        <select class="form-control" v-model=medico.id_medico @change="getMedico"  v-model=filterxhorario.medico_id>
            <option v-for="medic in medicos" :value="medic.id_medico">
                {{medic.apellido}}
            </option>
        </select>
    </div>

    <!-- COMIENZA MODAL -->
    <b-modal v-model="showModal" title="Turno" :header-bg-variant="headerBgVariant" :header-text-variant="headerTextVariant" :body-bg-variant="bodyBgVariant" :body-text-variant="bodyTextVariant" :footer-bg-variant="footerBgVariant" :footer-text-variant="footerTextVariant" id="my-modal">
        <div class="">
            <ul>
                <li><span class="">Nro de orden: {{turno.nroOrden}}</span></li>
                <li><span class="">Fecha de consulta: {{turno.fechaConsulta}}</span></li>
                <li><span class="">Hora de consulta: {{turno.horaConsulta}}</span></li>
                <li><span class="">Doctor: {{turno.medico_id}}</span></li>
                <li><span class="">Paciente: {{turno.paciente_id}}</span></li>
            </ul>


        </div>
        <template v-slot:modal-footer="{ok, cancel, hide}">
            <button v-if="isNewRecord" @click="addTurno()" type="button" class="btn btn-primary m-3">Crear</button>
            <button v-if="!isNewRecord" @click="updateObrasocial(obrasocial.id)" type="button" class="btn btn-primary m-3">Actualizar</button>
        </template>
    </b-modal>

    <!-- TERMINA MODAL -->

    <p>
        <template>
    <div class="row">

        <div class="col-12 col-md-4">
            <div class="form-group" v-if="medico.especialidad">
                <h4> Horarios de Atención del Dr. {{ medico.nombre }} {{ medico.apellido }} - Especialidad: {{ medico.especialidad.nombre }}</h4>
            </div>
            <div :key="mykey">
                <b-table-simple stacked='md' class="table bordered" bordered :head-variant="headVariant" :table-variant="tableVariant">
                    <b-thead head-variant="dark">
                        <template>
                            <b-tr>
                                <b-th>Día</b-th>
                                <b-th>Desde</b-th>
                                <b-th>Hasta</b-th>
                            </b-tr>
                            <div id="app">
                        </template>
                        <template>

                        </template>
                    </b-thead>
                    <template>
                        <b-tbody table-variant="warning">
                            <b-tr v-for="hora in medico.horarioatencions" :key="hora.id_horarioAtencion">
                                <b-td scope="row">{{hora.dia}}</b-td>
                                <b-td>{{hora.deste}}</b-td>
                                <b-td>{{hora.hasta}}</b-td>
                            </b-tr>
                        </b-tbody>
                    </template>
                    </b-table>
            </div>
        </div>

        <div class="col-12 col-md-8">

            <div class="form-group">
                <label for="fechaConsulta">Fecha</label>
                <input  v-model="fechaConsulta" type="date" name="fechaConsulta" id="fechaConsulta" class="form-control" placeholder="Ingrese fecha" aria-describedby="helpId">
                <small id="bodyhelpId" class="text-muted"></small>
                <span class="text-danger" v-if="errors.fecha_consulta">{{ errors.detalle }}</span>
            </div>
            <div class="form-group" v-if="turno.fecha_consulta" @click="diaDeLaSemana(turno.fecha_consulta)">
                <h4>Consultas del dia {{ diaDeConsulta }}</h4>
            </div>

            <div :key="mykey">
                <b-table-simple stacked='md' class="table bordered" bordered :head-variant="headVariant" :table-variant="tableVariant">
                    <b-thead head-variant="dark">
                        <template>
                            <b-tr>
                                <b-th>Nro</b-th>
                                <b-th>Hora</b-th>
                                <b-th>Dar/Cancelar</b-th>
                            </b-tr>
                            <div id="app">
                        </template>
                        <template>

                        </template>
                    </b-thead>
                    <b-tbody table-variant="warning">
                        <b-tr v-for="(turno,i) in horarioAtencion" :key="i">
                            <b-td scope="row">{{turno.nroOrden}}</b-td>
                            <b-td>{{turno.horaInicio}}</b-td>
                            <b-td>
                                <button v-if="turno.estado" @click="showModal=true" v-on:click="armarTurno(turno.nroOrden,turno.horaInicio)" type="button" class="btn btn-success">Dar turno</button>
                                <button v-if="!turno.estado" v-on:click="deleteTurno(turno.id)" type="button" class="btn btn-danger">Cancelar Turno</button>
                            </b-td>
                        </b-tr>
                    </b-tbody>
                    </b-table>

            </div>
        </div>
        </template>
        </p>
</b-container>

<script>

    var today = new Date().toISOString().slice(0, 19).replace('T', ' ');

    console.log("fecha de hoy");
    console.log(today);

    var app = new Vue({

        el: "#app",
        data: function() {
            return {
                mykey: 0,
                msg: "TURNOS",
                intervalo: 30,
                fecha: new Date(),
                fechaConsulta: null,
                dias: [],
                horarioAtencion: [],
                diasAtencion: [],
                diaAtencion: {},
                horariosxDia: [],
                pacientes: [], //tabla de todos los pacientes
                paciente: {}, //el paciente seleccionado
                medicos: [], //todos los medicos
                medico: {}, //el medico seleccionado
                turno: {}, //nuevo turno
                turnos: [], //todos los turnos
                //horarioxMedico: {}, //lista los datos de un medico (especialidad y horariosatencion)
                diaDeConsulta: null,
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
                options: ['Apple', 'Banana', 'Grape', 'Kiwi', 'Orange'],
                dias: ['LUNES','MARTES','MIERCOLES','JUEVES','VIERNES','SABADO','DOMINGO']
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

            },
            fechaConsulta: function(){
                this.getHorarioCompleto();
                // this.getArrayTurnos();
            }

        },

        computed: {

            // horarioCompleto: function (){
            //     for (let selectMedico of this.turnos){
            //         console.log("hora medico hora consulta");
            //         console.log(selectMedico.hora_consulta);
            //         if (this.medico.id_medico == selectMedico.medico_id && this.fechaConsulta == selectMedico.fecha_consulta){
            //             for(let i = 0; i < this.horarioAtencion.length ; i++){
            //                 console.log("hora consulta array horarios");
            //                 console.log(this.horarioAtencion[i].horaInicio);

            //                 if (selectMedico.hora_consulta == this.horarioAtencion[i].horaInicio){

            //                     this.horarioAtencion[i].estado = false;
            //                     console.log("el estado es falso");
            //                     // return this.horarioAtencion;
                                

            //                 } 
            //                 else { 
            //                     console.log("el estado es verdadero")
            //                 }
                            
            //             };
            //         };
            //     };
                
                // return this.horarioAtencion;
            // },




            // arrayTurnos: function(){
            //     return this.getArrayTurnos();
            // },

            // armarTurno: function (){
            //     this.turno.nroOrden = this.horarioAtencion.nroOrd;
            //     this.turno.fechaRegistro = new Date();
            //     this.turno.fehcaConsulta = this.fechaConsulta;
            //     this.turno.horaConsulta = this.horarioAtencion.horaInicio;
            //     this.turno.paciente_id = this.paciente.id_paciente;
            //     this.turno.medico_id = this.medico.id_medico;

            //     return this.turno;
            // }


        },

        methods: {
            diaDeLaSemana: function() {
                var dia = new Date(this.fechaConsulta);
                var dianro = dia.getDay();
                this.diaDeConsulta = this.dias[dianro];
                return this.diaDeConsulta;
            },

            arrayDeHorarioAtencion: function() {
                var diasAtenc = [];
                diasAtenc = this.medico.horarioatencions.slice();
                this.diasAtencion = diasAtenc.slice();
                return this.diasAtencion;
            },

            selectDia : function(){
                for(let selDia of this.diasAtencion){
                    if (this.diaDeConsulta == selDia.dia) {
                        this.diaAtencion.dia = selDia.dia;
                        this.diaAtencion.deste = selDia.deste;
                        this.diaAtencion.hasta = selDia.hasta;
                        return this.diaAtencion;
                    }else {
                        this.diaAtencion = {};
                    }

                };
            },

           getArrayTurnos(){
                this.horarioAtencion = [];
                this.diaDeLaSemana();
                this.arrayDeHorarioAtencion();
                this.selectDia();
                const intervalo= 30;
                const desde = moment(this.diaAtencion.deste,'HH:mm:ss');
                const hasta = moment(this.diaAtencion.hasta,'HH:mm:ss');
                hasta.subtract(intervalo,'m');
                let nroOrd = 0;
                let estado = true;

                while (desde.isBefore(hasta)){
                    // console.log('Entre al bucle de getArrayTurnos')
                    nroOrd += 1;
                    console.log(nroOrd);
                    if (nroOrd == 1){
                        this.horarioAtencion.push({
                            nroOrden: nroOrd,
                            horaInicio: desde.format('HH:mm:ss'),
                            estado: true,
                        });
                        console.log(desde.format('HH:mm:ss'));

                    } else {
                        desde.add(intervalo, 'm').format('HH:mm:ss');
                        console.log(desde.format('HH:mm:ss'));
                        this.horarioAtencion.push({
                            nroOrden: nroOrd,
                            horaInicio: desde.format('HH:mm:ss'),
                            estado: true,
                        });
                    }

                };
                // for (let selectMedico of this.turnos){
                //     console.log("hora medico hora consulta");
                //     console.log(selectMedico.hora_consulta);
                //     if (this.medico.id_medico == selectMedico.medico_id && this.fechaConsulta == selectMedico.fecha_consulta){
                //         for(let i = 0; i < this.horarioAtencion.length ; i++){
                //             console.log("hora consulta array horarios");
                //             console.log(this.horarioAtencion[i].horaInicio);

                //             if (selectMedico.hora_consulta == this.horarioAtencion[i].horaInicio){

                //                 this.horarioAtencion[i].estado = false;
                //                 console.log("el estado es falso");
                //                 // return this.horarioAtencion;
                                

                //             } 
                //             else { 
                //                 console.log("el estado es verdadero")
                //             }
                            
                //         };
                //     };
                // };

                this.mykey++;
                // return this.horarioAtencion;

            },

            getHorarioCompleto: function (){
                this.getArrayTurnos();
                for (let selectMedico of this.turnos){
                    if (this.medico.id_medico == selectMedico.medico_id && this.fechaConsulta == selectMedico.fecha_consulta){
                        for(let i = 0; i < this.horarioAtencion.length ; i++){
                            if (selectMedico.hora_consulta == this.horarioAtencion[i].horaInicio){

                                this.horarioAtencion[i].estado = false;
                                this.horarioAtencion[i].id = selectMedico.id_turno;
                                console.log("el estado es falso");
                                // return this.horarioAtencion;
                                

                            } 
                            else { 
                                console.log("el estado es verdadero")
                            }
                            
                        };
                    };
                };
                this.mykey++;
                // return this.horarioAtencion;
            },

            

            normalizeErrors: function(errors) {
                var allErrors = {};
                for (var i = 0; i < errors.length; i++) {
                    allErrors[errors[i].field] = errors[i].message;
                }
                return allErrors;
            },

            armarTurno: function (nro,inicio){
                //debugger;
                this.turno.nro_orden = parseInt(nro);
                // this.turno.fecha_registro = this.fecha.getFullYear() + "-" +this.fecha.getMonth() + "-" + this.fecha.getDate()
                this.turno.fecha_registro = today
                this.turno.fecha_consulta = this.fechaConsulta;
                this.turno.hora_consulta = inicio;
                this.turno.paciente_id = this.paciente.id_paciente;
                this.turno.medico_id = this.medico.id_medico;
                console.log(this.turno);

                return this.turno;
            },


            //operaciones tabla medicos

            getMedicos: function() {
                var self = this;
                const params = this.filterxMedico;
                axios.get('/apiv1/medico?page=' + self.currentPage,params)
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
                const params = {
                    expand:['especialidad','horarioatencions'].toString()
                }
                axios.get('/apiv1/medico/' + self.medico.id_medico,{params})
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
                axios.get('/apiv1/paciente/' + self.paciente.id_paciente, )
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
                params.append('nro_orden', self.turno.nroOrden);
                params.append('fecha_registro', self.turno.fechaRegistro);
                params.append('fecha_consulta', self.turno.fechaConsulta);
                params.append('hora_consulta', self.turno.horaConsulta);
                params.append('paciente_id', self.turno.paciente_id);
                params.append('medico_id', self.turno.medico_id);
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