<template>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Fecha Cita</th>
                    <th>Invitado</th>
                    <th>Acompa&ntilde;ante</th>
                    <th>Estado</th>
                    <th>Accion</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        {{ invitado.fechaCita + ' ' + invitado.horaCita }}
                    </td>
                    <td>
                        {{ invitado.nombre + ' ' + invitado.apellido }}
                    </td>
                    <td>
                        <p v-if="invitado.acompanante">
                            {{ acompanante.nombre + ' ' + acompanante.apellido }}
                        </p>
                        <p v-else>
                            <b-btn>Sin Acompa&ntilde;ante</b-btn>
                        </p>
                    </td>
                    <td>
                        <b-btn class="m-1" variant="info" v-if="invitado.estadoCita == 'CC'" v-b-tooltip.hover title="Cita Concreta">CC</b-btn>
                        <b-btn class="m-1" variant="info" v-if="invitado.estadoCita == 'CT'" v-b-tooltip.hover title="Cita Tentativa">CT</b-btn>
                        <b-btn class="m-1" variant="info" v-if="invitado.estadoCita == 'CR'" v-b-tooltip.hover title="Cita Reprogramada">CR</b-btn>
                        <b-btn class="m-1" variant="danger" v-if="invitado.estadoCita == 'LI'" v-b-tooltip.hover title="Lista Negra">LI</b-btn>
                        <b-btn class="m-1" variant="secondary" v-if="invitado.confirmacion == 'CC'" v-b-tooltip.hover title="Cita Concreta">CC</b-btn>
                        <b-btn class="m-1" variant="secondary" v-if="invitado.confirmacion == 'CT'" v-b-tooltip.hover title="Cita Tentativa">CT</b-btn>
                        <b-btn class="m-1" variant="danger" v-if="invitado.confirmacion == 'CA'" v-b-tooltip.hover title="Cita Anulada">CA</b-btn>
                        <b-btn class="m-1" variant="danger" v-if="invitado.confirmacion == 'LI'" v-b-tooltip.hover title="Lista Negra">LI</b-btn>
                        <b-btn class="m-1" variant="success" v-if="invitado.rastreo == 'OK'" v-b-tooltip.hover title="OK">OK</b-btn>

                        <b-btn class="m-1" variant="success" v-if="invitado.calificacion == 'Q'" v-b-tooltip.hover title="Califica">Q</b-btn>
                        <b-btn class="m-1" variant="danger" v-if="invitado.calificacion == 'NQ'" v-b-tooltip.hover title="No Califica">NQ</b-btn>
                        <b-btn class="m-1" variant="success" v-if="invitado.calificacion == 'TC'" v-b-tooltip.hover title="Tour">TC</b-btn>
                        <b-btn class="m-1" variant="danger" v-if="invitado.calificacion == 'NT'" v-b-tooltip.hover title="No Tour">NT</b-btn>
                        <b-btn class="m-1" variant="info" v-if="invitado.calificacion == 'TCD'" v-b-tooltip.hover title="Tour de Cortesia">TCD</b-btn>
                    </td>
                    <td>
                        <b-btn class="m-1" variant="primary" v-b-tooltip.hover title="Confirmar" v-on:click="showModal" v-if="permiso_confirmar && (!invitado.confirmacion || invitado.confirmacion == '')">
                            <font-awesome-icon icon="calendar-check"></font-awesome-icon>
                        </b-btn>
                        <b-btn class="m-1" variant="primary" v-b-tooltip.hover title="Rastrear" v-on:click="showModal2" v-if="permiso_rastrear && (!invitado.rastreo || invitado.rastreo == '')">
                            <font-awesome-icon icon="search"></font-awesome-icon>
                        </b-btn>
                        <b-btn class="m-1" variant="primary" v-b-tooltip.hover title="Calificar" v-on:click="showModal3" v-if="permiso_calificar && (!invitado.calificacion || invitado.calificacion == '')">
                            <font-awesome-icon icon="user-check"></font-awesome-icon>
                        </b-btn>
                        <b-btn v-if="permiso_tarjetas" class="m-1" variant="warning" v-on:click="showModal4" v-b-tooltip.hover title="Tarjetas del Invitado">
                            <font-awesome-icon icon="credit-card"></font-awesome-icon>
                        </b-btn>
                        <b-btn v-if="permiso_comerciales" variant="info" v-b-tooltip.hover title="Comerciales" v-on:click="showModal5">
                            <font-awesome-icon icon="user-tie"></font-awesome-icon>
                        </b-btn>
                        <a :href="baseorigen + '/editarinvitado/' + invitado.id" v-b-tooltip.hover title="Editar" class="btn btn-success m-1">
                            <font-awesome-icon icon="pen"></font-awesome-icon>
                        </a>
                        <a v-if="permiso_contrato" :href="baseorigen + '/crearcontrato/' + invitado.id" v-b-tooltip.hover title="Crear Contrato" class="btn btn-secondary m-1">
                            <font-awesome-icon icon="scroll"></font-awesome-icon>
                        </a>

                        <b-modal ref="myModal4" hide-footer :title="'Tarjetas del Invitado - ' + invitado.nombre + ' ' + invitado.apellido">
                            <invitado-tarjetas-component :base="base" :invitado="invitado.id" :acompanante="invitado.acompanante"></invitado-tarjetas-component>
                        </b-modal>

                        <b-modal v-if="!invitado.confirmacion || invitado.confirmacion == ''" ref="myModal1" hide-footer :title="'Confirmar Cita - ' + invitado.nombre + ' ' + invitado.apellido">
                            <form class="row" v-on:submit.prevent="confirmar">
                                <div class="form-group col-12 col-sm-6">
                                    Confirmacion
                                    <select class="form-control" v-model="confirmacion.confirmacion">
                                        <option value="">-Estado de Confirmacion-</option>
                                        <option value="CC">Cita Concreta</option>
                                        <option value="CT">Cita Tentativa</option>
                                        <option value="CA">Cita Anulada</option>
                                        <option value="LI">Lista Negra</option>
                                        <option value="CR">Reprogramar Cita</option>
                                    </select>
                                </div>
                                <div v-if="confirmacion.confirmacion == 'CR'" class="form-group col-6">
                                    Fecha
                                    <input class="form-control" type="date" v-model="reprogramar.fechaCita">
                                </div>
                                <div v-if="confirmacion.confirmacion == 'CR'" class="form-group col-6">
                                    Hora
                                    <input class="form-control" type="time" v-model="reprogramar.horaCita">
                                </div>
                                <div class="form-group col-12">
                                    Comentario
                                    <textarea class="form-control" rows="3" v-model="confirmacion.comentario"></textarea>
                                </div>
                                <div class="form-group col-12">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                    <b-btn v-on:click="hideModal">Cancelar</b-btn>
                                </div>
                            </form>
                        </b-modal>
                        
                        <b-modal v-if="!invitado.rastreo || invitado.rastreo == ''" ref="myModal2" hide-footer :title="'Rastrear Invitado - ' + invitado.nombre + ' ' + invitado.apellido">
                            <form class="row" v-on:submit.prevent="rastrear">
                                <div class="form-group col-12 col-sm-6">
                                    Rastrear
                                    <select class="form-control" v-model="rastreo.rastreo">
                                        <option value="">-Estado de Rastreo-</option>
                                        <option value="OK">OK</option>
                                        <option value="CR">Reprogramar Cita</option>
                                    </select>
                                </div>
                                <div v-if="rastreo.rastreo == 'CR'" class="form-group col-6">
                                    Fecha
                                    <input class="form-control" type="date" v-model="reprogramar.fechaCita">
                                </div>
                                <div v-if="rastreo.rastreo == 'CR'" class="form-group col-6">
                                    Hora
                                    <input class="form-control" type="time" v-model="reprogramar.horaCita">
                                </div>
                                <div class="form-group col-12">
                                    Comentario
                                    <textarea class="form-control" rows="3" v-model="rastreo.comentario"></textarea>
                                </div>
                                <div class="form-group col-12">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                    <b-btn v-on:click="hideModal2">Cancelar</b-btn>
                                </div>
                            </form>
                        </b-modal>

                        <b-modal v-if="!invitado.calificacion || invitado.calificacion == ''" ref="myModal3" hide-footer :title="'Calificar Invitado - ' + invitado.nombre + ' ' + invitado.apellido">
                            <form class="row" v-on:submit.prevent="calificar">
                                <div class="form-group col-12 col-sm-6">
                                    Calificacion
                                    <select class="form-control" v-model="calificacion.calificacion">
                                        <option value="">-Elija la Calificacion-</option>
                                        <option value="Q">Q - Califica</option>
                                        <option value="NQ">NQ - No Califica</option>
                                        <option value="TC">TC - Tour</option>
                                        <option value="NT">NT - No Tour</option>
                                        <option value="TCD">TCD - Tour de Cortesia</option>
                                    </select>
                                </div>
                                <div class="form-group col-12">
                                    Comentario
                                    <textarea class="form-control" rows="3" v-model="calificacion.comentario"></textarea>
                                </div>
                                <div class="form-group col-12">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                    <b-btn v-on:click="hideModal3">Cancelar</b-btn>
                                </div>
                            </form>
                        </b-modal>

                        <b-modal ref="myModal5" hide-footer :title="'Comerciales del Invitado - ' + invitado.nombre + ' ' + invitado.apellido">
                            <form class="row" v-on:submit.prevent="upParticipantes">
                                <div class="form-group col-sm-6">
                                    Jefe de Sala
                                    <select class="form-control" v-model="participantes.jefe_sala">
                                        <option value="0">-Ninguno-</option>
                                        <option v-for="(jefes_salax, index) in jefes_sala" :key="index" :value="jefes_salax.id">
                                            {{ jefes_salax.nombre + ' ' + jefes_salax.apellido }}
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    Liner
                                    <select class="form-control" v-model="participantes.liner">
                                        <option value="0">-Ninguno-</option>
                                        <option v-for="(liner, index) in liners" :key="index" :value="liner.id">
                                            {{ liner.nombre + ' ' + liner.apellido }}
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    Closer 1
                                    <select class="form-control" v-model="participantes.closer1">
                                        <option value="0">-Ninguno-</option>
                                        <option v-for="(closer, index) in closers" :key="index" :value="closer.id">
                                            {{ closer.nombre + ' ' + closer.apellido }}
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    Closer 2
                                    <select class="form-control" v-model="participantes.closer2">
                                        <option value="0">-Ninguno-</option>
                                        <option v-for="(closer, index) in closers" :key="index" :value="closer.id">
                                            {{ closer.nombre + ' ' + closer.apellido }}
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-12">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                    <b-btn v-on:click="hideModal5">Cancelar</b-btn>
                                </div>
                            </form>
                        </b-modal>

                    </td>
                </tr>
            </tbody>
        </table>
    </div>    
</template>
<script>
export default {
    props: ['base','invitado','acompanante','baseorigen'],
    data() {
        return {
            permiso_confirmar: false,
            permiso_rastrear: false,
            permiso_calificar: false,
            permiso_tarjetas: false,
            permiso_comerciales: false,
            permiso_contrato: false,

            liners: [],
            jefes_sala: [],
            closers: [],
            cargos: {
                liner: 0,
                jefe_sala: 0,
                closer: 0
            },
            participantes: {
                liner: 0,
                jefe_sala: 0,
                closer1: 0,
                closer2: 0
            },
            confirmacion: {
                confirmacion: '',
                comentario: ''
            },
            rastreo: {
                rastreo: '',
                comentario: ''
            },
            calificacion: {
                calificacion: '',
                comentario: ''
            },
            reprogramar: {
                fechaCita: '',
                horaCita: '',
                comentario: ''
            }
        }
    },
    mounted() {
        this.getMisPermisos();
    },
    methods: {
        getMisPermisos(){
            axios.get(this.base + '/permisoExiste/invitado.confirmar').then((res) => {
                this.permiso_confirmar = res.data.existe;
            }).catch((err) => {
                console.log(err);
            });
            axios.get(this.base + '/permisoExiste/invitado.rastrear').then((res) => {
                this.permiso_rastrear = res.data.existe;
            }).catch((err) => {
                console.log(err);
            });
            axios.get(this.base + '/permisoExiste/invitado.calificar').then((res) => {
                this.permiso_calificar = res.data.existe;
            }).catch((err) => {
                console.log(err);
            });
            axios.get(this.base + '/permisoExiste/invitado.tarjetas').then((res) => {
                this.permiso_tarjetas = res.data.existe;
            }).catch((err) => {
                console.log(err);
            });
            axios.get(this.base + '/permisoExiste/invitado.comerciales').then((res) => {
                this.permiso_comerciales = res.data.existe;
            }).catch((err) => {
                console.log(err);
            });
            axios.get(this.base + '/permisoExiste/contrato.store').then((res) => {
                this.permiso_contrato = res.data.existe;
            }).catch((err) => {
                console.log(err);
            });
        },
        showModal(){
            this.$refs.myModal1.show();
        },
        hideModal(){
            this.$refs.myModal1.hide();
        },
        showModal2(){
            this.$refs.myModal2.show();
        },
        hideModal2(){
            this.$refs.myModal2.hide();
        },
        showModal3(){
            this.$refs.myModal3.show();
        },
        hideModal3(){
            this.$refs.myModal3.hide();
        },
        showModal4(){
            this.$refs.myModal4.show();
        },
        hideModal4(){
            this.$refs.myModal4.hide();
        },
        showModal5(){
            this.$refs.myModal5.show();
            this.getEmpleados('CLOSER');
            this.getEmpleados('LINER');
            this.getEmpleados('JEFE DE SALA');
            this.getParticipantes();
        },
        hideModal5(){
            this.$refs.myModal5.hide();
        },
        upParticipantes(){
            var estaBien = true;
            
                axios.delete(this.base + '/eliparticipantes/' + this.invitado.id).then((res) => {
                    axios.post(this.base + '/participantes/' + this.invitado.id, participa).then((res) => {
                    
                    }).catch((err) => {
                        estaBien = false;
                        console.log(err);
                    });
                    
                    participa = {
                        empleado_id: this.participantes.jefe_sala,
                        cargo_id: this.cargos.jefe_sala
                    };
                    axios.post(this.base + '/participantes/' + this.invitado.id, participa).then((res) => {
                        
                    }).catch((err) => {
                        estaBien = false;
                        console.log(err);
                    });
                    
                    participa = {
                        empleado_id: this.participantes.closer1,
                        cargo_id: this.cargos.closer
                    };
                    axios.post(this.base + '/participantes/' + this.invitado.id, participa).then((res) => {
                        
                    }).catch((err) => {
                        estaBien = false;
                        console.log(err);
                    });
                    
                    participa = {
                        empleado_id: this.participantes.closer2,
                        cargo_id: this.cargos.closer
                    };
                    axios.post(this.base + '/participantes/' + this.invitado.id, participa).then((res) => {
                        
                    }).catch((err) => {
                        estaBien = false;
                        console.log(err);
                    });    
                }).catch((err) => {
                    console.log(err);
                });

                let participa = {
                    empleado_id: this.participantes.liner,
                    cargo_id: this.cargos.liner
                };
                
            

            if (estaBien) {
                Toastr.success("Participantes registrados.");
                this.hideModal5();
            } else {
                Toastr.error("Error al registrar participantes.");
            }
            
        },
        getEmpleados(cargo){
            axios.get(this.base + '/empleadoscargo/' + cargo).then((res) => {
                if (cargo == 'CLOSER') {
                    this.closers = res.data;
                    if (this.closers.length > 0) {
                        this.cargos.closer = this.closers[0].cargo_id;
                    }
                } else if (cargo == 'LINER'){
                    this.liners = res.data;    
                    
                    if (this.liners.length > 0) {
                        this.cargos.liner = this.liners[0].cargo_id;
                    }                
                } else if (cargo == 'JEFE DE SALA'){
                    this.jefes_sala = res.data;
                    
                    if (this.jefes_sala.length > 0) {
                        this.cargos.jefe_sala = this.jefes_sala[0].cargo_id;
                    }                    
                }
            }).catch((err) => {
                console.log(err);
            });
        },
        getParticipantes(){
            axios.get(this.base + '/participantes/' + this.invitado.id).then((res) => {
                if (res.data) {
                    var xclos = 0;
                    for (let i = 0; i < res.data.length; i++) {
                        if (res.data[i].cargo_id == this.cargos.closer) {
                            if (xclos == 0) {
                                this.participantes.closer1 = res.data[i].empleado_id;
                                xclos++;
                            } else {
                                this.participantes.closer2 = res.data[i].empleado_id;
                            }
                        } else if (res.data[i].cargo_id == this.cargos.liner){
                            this.participantes.liner = res.data[i].empleado_id;
                        } else if (res.data[i].cargo_id == this.cargos.jefe_sala){
                            this.participantes.jefe_sala = res.data[i].empleado_id;
                        }
                    }
                }
            }).catch((err) => {
                console.log(err);
            });
        },
        calificar(){  
            axios.put(this.base + '/calificarclientes/' + this.invitado.id, this.calificacion).then((res) => {
                this.invitado = res.data;
                this.hideModal3();
                Toastr.success("Invitado Calificado.");
            }).catch((err) => {
                Toastr.error("Error al calificar al invitado.");
                console.log(err);
            });
        },
        confirmar(){
            if (this.confirmacion.confirmacion != 'CR') {     
                axios.put(this.base + '/confirmarclientes/' + this.invitado.id, this.confirmacion).then((res) => {
                    this.invitado = res.data;
                    this.hideModal();
                    Toastr.success("Cita Confimada.");
                }).catch((err) => {
                    Toastr.error("Error al confirmar la cita.");
                    console.log(err);
                });
            } else {
                this.reprogramar.comentario = this.confirmacion.comentario;
                this.reprogramaCita();
                this.hideModal();
            }
        },
        rastrear(){
            if (this.rastreo.rastreo != 'CR') {     
                axios.put(this.base + '/rastrearclientes/' + this.invitado.id, this.rastreo).then((res) => {
                    this.invitado = res.data;
                    this.hideModal2();
                    Toastr.success("Invitado Rastreado.");
                }).catch((err) => {
                    Toastr.error("Error al rastrear Invitado.");
                    console.log(err);
                });
            } else {
                this.reprogramar.comentario = this.rastreo.comentario;
                this.reprogramaCita();
                this.hideModal2();
            }
        },
        reprogramaCita(){
            axios.put(this.base + '/reprogramarclientes/' + this.invitado.id, this.reprogramar).then((res) => {
                this.invitado = res.data;
                Toastr.success("Cita Reprogramada.");
            }).catch((err) => {
                Toastr.error("Error al reprogramar la cita.");
                console.log(err);
            });
        }
    },
}
</script>