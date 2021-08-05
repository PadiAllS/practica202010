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
    <b-modal v-model="showModal" title="Horarios de Atención" :header-bg-variant="headerBgVariant" :header-text-variant="headerTextVariant" :body-bg-variant="bodyBgVariant" :body-text-variant="bodyTextVariant" :footer-bg-variant="footerBgVariant" :footer-text-variant="footerTextVariant" id="my-modal">
    <div class="row">
        <form action="">
                <div class="col md-4">
                    <div class="form-group">
                        <label for="dia">Día de la Semana</label>
                        <b-form-select v-model="horarioAtencion.dia" :options="dias"></b-form-select>
                    </div>
                </div>
                <div class="col md-4">
                    <div class="form-group">
                        <label for="desde">Desde</label>
                        <input v-model="horarioAtencion.deste" type="time" name="desde" id="desde" class="form-control" placeholder="Ingrese horario" aria-describedby="helpId">
                        <small id="bodyhelpId" class="text-muted"></small>
                        <span class="text-danger" v-if="errors.deste">{{ errors.deste }}</span>
                    </div>
                </div>
                <div class="col md-4">
                    <div class="form-group">
                        <label for="hasta">Hasta</label>
                        <input v-model="horarioAtencion.hasta" type="time" name="hasta" id="hasta" class="form-control" placeholder="Ingrese horario" aria-describedby="helpId">
                        <small id="bodyhelpId" class="text-muted"></small>
                        <span class="text-danger" v-if="errors.hasta">{{ errors.hasta }}</span>
                    </div>
                </div>
            </div>
        </form>


        <template v-slot:modal-footer="{ok, cancel, hide}">
            <button v-if="isNewRecord" @click="addHorarioatencion()" type="button" class="btn btn-primary m-3">Crear</button>
            
            <button v-if="!isNewRecord" @click="updateHorarioatencion(horarioAtencion.id_horarioAtencion)" type="button" class="btn btn-primary m-3">Actualizar</button>

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
                                <b-th>Día</b-th>
                                <b-th>Desde</b-th>
                                <b-th>Hasta</b-th>
                                <b-th>Opciones</b-th>
                            </b-tr>
                        </template>
                        <template>
                            <b-tr>
                                <b-td>
                                    <input v-on:change="getHorarioAtencion()" class="form-control" v-model="filter.id_horarioAtencion">
                                </b-td>
                                <b-td>
                                    
                                </b-td>
                                <b-td>
                                    
                                </b-td>
                                <b-td>
                                    <b-container>
                                        <b-row class="justify-content-md-center">
                                            <b-row class="justify-content-md-center">
                                                <button @click="showModal=true" type='button' class="btn btn-primary">Nuevo horario</button>
                                            </b-row>
                                        </b-row>
                                    </b-container>
                                </b-td>
                            </b-tr>
                        </template>
                    </b-thead>
                    <template>
                        <b-tbody table-variant="warning">
                            <b-tr v-for="(hora,key) in horarios" v-bind:key="hora.id_horarioAtencion">
                                <b-td scope="row">{{hora.dia}}</b-td>
                                <b-td>{{hora.deste}}</b-td>
                                <b-td>{{hora.hasta}}</b-td>
                                <b-td>
                                    <button @click="showModal=true" v-on:click="editHorarioatencion(key)" type="button" class="btn btn-success">Editar</button>
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
                msg: "Horarios de Atención",
                dias: ['LUNES', 'MARTES', 'MIERCOLES', 'JUEVES', 'VIERNES'],
                horarios: [],
                horarioAtencion: {},
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
            this.getHorarioatencion();
        },
        watch: {
            currentPage: function() {
                this.getHorarioatencion();
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

            getHorarioatencion: function() {
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
                                self.getHorarioatencion();
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
                        self.getHorarioatencion();
                        // self.posts.unshift(response.data);
                        self.horarioAtencion = {};
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
                        self.getHorarioatencion();
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