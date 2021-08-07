<?php
/* @var $this yii\web\View */

//$this->registerCssFile("https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css",['position'=>$this::POS_HEAD]);
$this->registerCssFile("//unpkg.com/bootstrap/dist/css/bootstrap.min.css", ['position' => $this::POS_HEAD]);
$this->registerCssFile("//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.css", ['position' => $this::POS_HEAD]);

$this->registerJsFile("https://cdn.jsdelivr.net/npm/vue/dist/vue.min.js", ['position' => $this::POS_HEAD]);
$this->registerJsFile("https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js", ['position' => $this::POS_HEAD]);
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
        <select class="form-control" v-model=medico.id_medico @change="getMedico" v-model=filterxhorario.medico_id>
            <option v-for="medic in medicos" :value="medic.id_medico">
                {{medic.apellido}}
            </option>
        </select>
    </div>

    <div class="form-group">
        <label for="fechaConsulta">Fecha</label>
        <input v-model="fechaConsulta" type="date" name="fechaConsulta" id="fechaConsulta" class="form-control" placeholder="Ingrese fecha" aria-describedby="helpId">
        <small id="bodyhelpId" class="text-muted"></small>
        <span class="text-danger" v-if="errors.fecha_consulta">{{ errors.detalle }}</span>
    </div>
    <div class="form-group" v-if="fechaConsulta" @click="diaDeLaSemana(turno.fecha_consulta)">
        <h4>Consultas del dia {{ diaDeConsulta + ' ' + fechaConsulta }}</h4>
    </div>

    <div :key="mykey">
        <b-table-simple stacked='md' class="table bordered" bordered :head-variant="headVariant" :table-variant="tableVariant">
            <b-thead head-variant="dark">
                <template>
                    <b-tr>
                        <b-th>Nro</b-th>
                        <b-th>Hora</b-th>
                        <b-th>Paciente</b-th>
                        <b-th>Ficha</b-th>
                    </b-tr>
                    <div id="app">
                </template>

            </b-thead>
            <b-tbody table-variant="warning">
                <b-tr v-for="(turno,i) in horarioAtencion" :key="i">
                    <b-td scope="row">{{turno.nroOrden}}</b-td>
                    <b-td>{{turno.horaInicio}}</b-td>
                    <b-td>{{turno.paciente}}</b-td>
                    <b-td>
                        <b-button @click="showModal=true" v-on:click="editPacientes(turno.paciente_id)" variant="warning" size="lg">Ver Ficha</b-button>
                    </b-td>
                </b-tr>
            </b-tbody>
            </b-table>


            <!-- COMIENZA MODAL -->
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
                                <form action="">
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
                                                <div class="form-group">
                                                    <label for="localidad">Localidad</label>
                                                    <input v-model="paciente.localidad" type="text" name="localidad" id="localidad" class="form-control" placeholder="Ingrese Localidad" aria-describedby="helpId">
                                                    <small id="bodyhelpId" class="text-muted"></small>
                                                    <span class="text-danger" v-if="errors.localidad">{{ errors.apellido }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group text-center">
                                        <div class="row">
                                            <div class="col-12 col-md-4">
                                                <label for="sexo">Sexo</label>
                                                <b-form-select v-model="paciente.sexo" :options="sexos" id="sexo"></b-form-select>
                                            </div>
                                            <div class="col-6 col-md-4">
                                                <div class="form-group text-center">
                                                    <label for="fecha_nacimiento">Fecha-Nacimiento</label>
                                                    <b-form-datepicker v-model="paciente.fecha_nacimiento" placeholder="Click aqui para seleccionar fecha" id="datepicker-valid"></b-form-datepicker>
                                                    <!-- <input v-model=" paciente.fecha_nacimiento" type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" placeholder="Ingrese su fecha de nacimiento" aria-describedby="helpId"> -->
                                                    <small id="bodyhelpId" class="text-muted"></small>
                                                    <span class="text-danger" v-if="errors.fecha_nacimiento">{{ errors.fecha_nacimiento }}</span>

                                                </div>
                                            </div>
                                            <div class="col-6 col-md-4">
                                                <div class="form-group text-center">
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
                                            <div class="col-5 col-md-4">
                                                <label for="cod_post">Cod Postal</label>
                                                <input v-model="paciente.codigo_postal" type="text" name="cod_p" id="cod_p" class="form-control" placeholder="Cod-Postal" aria-describedby="helpId">
                                                <small id="bodyhelpId" class="text-muted"></small>
                                                <span class="text-danger" v-if="errors.codigo_postal">{{ errors.mail }}</span>
                                            </div>

                                            <div class="col-3 col-md-4">
                                                <div class="form-group">
                                                    <label for="tipo_documento">Tipo DOC</label>
                                                    <b-form-select v-model="paciente.tipo_documento" ref='selected' :options="docs" id="doc"></b-form-select>
                                                    <div class="mt-3"><strong>{{ paciente.tipo_docomento}}</strong></div>
                                                </div>
                                            </div>
                                            <div class="col-4 col-md-4">
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
                                                <label for="direccion">Direccion</label>
                                                <input v-model="paciente.direccion" type="text" name="direccion" id="direccion" class="form-control" placeholder="Ingrese Direccion" aria-describedby="helpId">
                                                <small id="bodyhelpId" class="text-muted"></small>
                                                <span class="text-danger" v-if="errors.direccion">{{ errors.direccion }}</span>
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
                                            <div class="col-12 col-md-4">
                                                <div class="form-group">
                                                    <label for="sexo">Nombre y Apellido Materno</label>
                                                    <input v-model="paciente.ape_nomb_materno" type="text" name="nom_mat" id="nom_mat" class="form-control" placeholder="Nombre y Apellido Materno" aria-describedby="helpId">
                                                    <small id="bodyhelpId" class="text-muted"></small>
                                                    <span class="text-danger" v-if="errors.ape_nomb_materno">{{ errors.nom_ape_mat }}</span>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <div class="form-group">
                                                    <label for="sexo">Nombre y Apellido Paterno</label>
                                                    <input v-model="paciente.ape_nomb_paterno" type="text" name="nom_pat" id="nom_pat" class="form-control" placeholder="Nombre y Apellido Paterno" aria-describedby="helpId">
                                                    <small id="bodyhelpId" class="text-muted"></small>
                                                    <span class="text-danger" v-if="errors.ape_nomb_paterno">{{ errors.nom_ape_pat }}</span>
                                                </div>
                                            </div>

                                            <div class="col-6 col-md-4">
                                                <div class="form-group">
                                                    <label for="sexo">Nombre del responsable</label>
                                                    <input v-model="paciente.responsable_nombre" type="text" name="responsable_nombre" id="responsable_nombre" class="form-control" placeholder="Ingrese su nombre" aria-describedby="helpId">
                                                    <small id="bodyhelpId" class="text-muted"></small>
                                                    <span class="text-danger" v-if="errors.responsable_nombre">{{ errors.responsable_nombre }}</span>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="Tel-Resp">Tel- Responsable</label>
                                                    <input v-model="paciente.responsable_telefono" type="text" name="responsable_telefono" id="responsable_telefono" class="form-control" placeholder="Ingrese su Tel" aria-describedby="helpId">
                                                    <small id="bodyhelpId" class="text-muted"></small>
                                                    <span class="text-danger" v-if="errors.responsable_telefono">{{ errors.responsable_telef }}</span>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-6">
                                                <label for="sexo">Email</label>
                                                <input v-model="paciente.mail" type="text" name="mail" id="mail" class="form-control" placeholder="Ingrese su email" aria-describedby="helpId">
                                                <small id="bodyhelpId" class="text-muted"></small>
                                                <span class="text-danger" v-if="errors.mail">{{ errors.mail }}</span>
                                            </div>
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
            </b-modal>
        </b-table-simple>
    </div>
</b-container>

<!-- TERMINA MODAL -->



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
                obrasocial: [],
                patologias: [],
                patologia: {},
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
                docs: ['DNI', 'CARNET EXTRANJERO', 'RUC', 'PASAPORTE', 'P.NAC', 'OTROS'],
                sexos: ['Masculino', 'Femenino', 'Bisexual', 'Transexual', 'Indefinido'],
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
                dias: ['LUNES', 'MARTES', 'MIERCOLES', 'JUEVES', 'VIERNES', 'SABADO', 'DOMINGO']
            }
        },
        mounted() {
            this.getPacientes();
            this.getMedicos();
            this.getTurnos();
            this.getObrasociales();
            this.getPatologias();
        },
        watch: {
            currentPage: function() {
                this.getHorariosatencion();

            },
            fechaConsulta: function() {
                this.getHorarioCompleto();
            }

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

            selectDia: function() {
                for (let selDia of this.diasAtencion) {
                    if (this.diaDeConsulta == selDia.dia) {
                        this.diaAtencion.dia = selDia.dia;
                        this.diaAtencion.deste = selDia.deste;
                        this.diaAtencion.hasta = selDia.hasta;
                        return this.diaAtencion;
                    } else {
                        this.diaAtencion = {};
                    }

                };
            },

            getArrayTurnos() {
                this.horarioAtencion = [];
                this.diaDeLaSemana();
                this.arrayDeHorarioAtencion();
                this.selectDia();
                const intervalo = this.medico.duracion_consulta;
                let desde = moment(this.diaAtencion.deste, 'HH:mm:ss');
                let hasta = moment(this.diaAtencion.hasta, 'HH:mm:ss');
                hasta.subtract(intervalo, 'm');
                let nroOrd = 0;
                let estado = true;

                while (desde.isBefore(hasta)) {
                    nroOrd += 1;
                    if (nroOrd == 1) {
                        this.horarioAtencion.push({
                            nroOrden: nroOrd,
                            horaInicio: desde.format('HH:mm:ss'),
                            estado: true,
                        });
                    } else {
                        desde.add(intervalo, 'm').format('HH:mm:ss');
                        this.horarioAtencion.push({
                            nroOrden: nroOrd,
                            horaInicio: desde.format('HH:mm:ss'),
                            estado: true,
                        });
                    }

                };


            },

            getHorarioCompleto: function() {
                this.getArrayTurnos();
                for (let selectMedico of this.turnos) {
                    if (this.medico.id_medico == selectMedico.medico.id_medico && this.fechaConsulta == selectMedico.fecha_consulta) {
                        for (let i = 0; i < this.horarioAtencion.length; i++) {
                            if (selectMedico.hora_consulta == this.horarioAtencion[i].horaInicio) {

                                this.horarioAtencion[i].estado = false;
                                this.horarioAtencion[i].id = selectMedico.id_turno;
                                this.horarioAtencion[i].paciente = selectMedico.paciente.apellido + ' ' + selectMedico.paciente.nombre;
                                // this.horarioAtencion[i].pacienteNo = selectMedico.paciente.nombre;
                            }

                        };
                    };
                };
                this.mykey++;
            },



            normalizeErrors: function(errors) {
                var allErrors = {};
                for (var i = 0; i < errors.length; i++) {
                    allErrors[errors[i].field] = errors[i].message;
                }
                return allErrors;
            },

            armarTurno: function(nro, inicio) {
                this.turno.nro_orden = parseInt(nro);
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
                axios.get('/apiv1/medico?page=' + self.currentPage, params)
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
                    expand: ['especialidad', 'horarioatencions'].toString()
                }
                axios.get('/apiv1/medico/' + self.medico.id_medico, {
                        params
                    })
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
            },
            editPacientes: function(key) {
                this.paciente = Object.assign({}, this.pacientes[key]);
                this.paciente.key = key;
                this.isNewRecord = false;
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
                                self.turno = {};
                                self.paciente = {};
                                self.medico = {};
                                self.fechaConsulta = null;
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
                        self.paciente = {};
                        self.medico = {};
                        self.fechaConsulta = null;
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
                        self.paciente = {};
                        self.medico = {};
                        self.fechaConsulta = null;
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
            },

        }

    })
</script>