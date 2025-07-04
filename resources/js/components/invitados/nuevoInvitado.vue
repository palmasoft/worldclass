<template>
    <div class="card">
        <div class="card-header">
            <strong v-if="cliente == 0">
                <h2>Nuevo Invitado</h2>
            </strong>
            <strong v-else>
                <h2>Editar Invitado</h2>
            </strong>
        </div>
        <div class="card-body">
            <form class="row mt-1 mb-1 justify-content-center" v-on:submit.prevent="guardar">
                <div class="col-12">
                    <strong>Datos de la Cita</strong>
                </div>
                <div class="form-group col-12">
                    Sede
                    <select class="form-control" v-model="invitado.sede" required>
                        <option v-for="(sede, index) in sedes" :key="index" :value="sede.sede">
                            {{ sede.sede + ' - ' + sede.nombre }}
                        </option>
                    </select>
                </div>
                <div class="form-group col-md-3 col-sm-6">
                    TMK
                    <input type="text" class="form-control" v-model="invitado.tmk" v-on:change="existeTmk" placeholder="Codigo TMK" required>
                    <span v-html="alerta.tmk"></span>
                </div>
                <div class="form-group col-md-3 col-sm-6">
                    Fecha
                    <input type="date" class="form-control" v-model="invitado.fechaCita" required>
                </div>
                <div class="form-group col-md-3 col-sm-6">
                    Hora
                    <input type="time" class="form-control" v-model="invitado.horaCita" required>
                </div>
                <div class="form-group col-md-3 col-sm-6">
                    Estado de Cita
                    <select class="form-control" v-model="invitado.estadoCita" required>
                        <option value="CC">
                            Cita Concreta
                        </option>
                        <option value="CT">
                            Cita Tentativa
                        </option>
                        <option value="LI">
                            Lista Negra
                        </option>
                    </select>
                </div>

                <hr class="col-11 mt-1">

                <div class="col-12 mt-1">
                    <strong>Datos del Invitado</strong>
                </div>
                <div class="form-group col-sm-6 col-md-4 col-lg-3">
                    Nombre
                    <input type="text" class="form-control" v-model="invitado.nombre" placeholder="Nombre" required>
                </div>
                <div class="form-group col-sm-6 col-md-4 col-lg-3">
                    Apellido
                    <input type="text" class="form-control" v-model="invitado.apellido" placeholder="Apellido" required>
                </div>
                <div class="form-group col-sm-6 col-md-4 col-lg-3">
                    Email 1
                    <input type="email" class="form-control" v-model="invitado.email" placeholder="eMail">
                </div>
                <div class="form-group col-sm-6 col-md-4 col-lg-3">
                    Email 2
                    <input type="email" class="form-control" v-model="invitado.email2" placeholder="eMail">
                </div>
                <div class="form-group col-sm-6 col-md-4 col-lg-3">
                    Celular
                    <input type="number" class="form-control" v-on:change="limitarChr" v-model="invitado.celular" placeholder="Celular">
                </div>
                <div class="form-group col-sm-6 col-md-4 col-lg-3">
                    Telefono
                    <input type="number" class="form-control" v-on:change="limitarChr" v-model="invitado.telefono" placeholder="Telefono">
                </div>
                <div class="form-group col-sm-6 col-md-4 col-lg-3">
                    Profesión
                    <input type="text" class="form-control" v-model="invitado.ocupacion" placeholder="Profesión">
                </div>
                <div class="form-group col-sm-6 col-md-4 col-lg-3">
                    Edad
                    <input type="number" class="form-control" v-model="invitado.edad" placeholder="Edad">
                </div>
                <div class="form-group col-sm-6 col-md-4 col-lg-3">
                    Estado Civil
                    <select class="form-control" v-model="invitado.estadoCivil">
                        <option></option>
                        <option>SOLTERO</option>
                        <option>CASADO</option>
                        <option>DIVORCIADO</option>
                        <option>VIUDO</option>
                        <option>UNION LIBRE</option>
                    </select>
                </div>

                
                <div v-if="invitado.rastreo == 'OK'" class="form-group col-sm-6 col-md-4 col-lg-3">
                    Cedula
                    <input type="number" class="form-control" v-model="invitado.cedula" placeholder="Cedula">
                </div>
                <div v-if="invitado.rastreo == 'OK'" class="form-group col-sm-6 col-md-4 col-lg-3">
                    Pasaporte
                    <input type="text" class="form-control" v-model="invitado.pasaporte" placeholder="Pasaporte">
                </div>
                <div v-if="invitado.rastreo == 'OK'" class="form-group col-sm-6 col-md-4 col-lg-3">
                    Fecha de nacimiento
                    <input type="date" class="form-control" v-model="invitado.fechaNacimiento">
                </div>

                <hr class="col-11 mt-1">

                <div class="form-check col-12">
                    <input class="form-check-input" type="checkbox" id="defaultCheck1" v-model="conacompanante">
                    <label class="form-check-label" for="defaultCheck1">
                        <strong>Acompa&ntilde;ante</strong>
                    </label>
                </div>

                <div v-if="conacompanante" class="form-group col-sm-6 col-md-4 col-lg-3">
                    Nombre
                    <input type="text" class="form-control" v-model="acompanante.nombre" placeholder="Nombre" required>
                </div>
                <div v-if="conacompanante" class="form-group col-sm-6 col-md-4 col-lg-3">
                    Apellido
                    <input type="text" class="form-control" v-model="acompanante.apellido" placeholder="Apellido" required>
                </div>
                <div v-if="conacompanante" class="form-group col-sm-6 col-md-4 col-lg-3">
                    Email 1
                    <input type="email" class="form-control" v-model="acompanante.email" placeholder="eMail">
                </div>
                <div v-if="conacompanante" class="form-group col-sm-6 col-md-4 col-lg-3">
                    Email 2
                    <input type="email" class="form-control" v-model="acompanante.email2" placeholder="eMail">
                </div>
                <div v-if="conacompanante" class="form-group col-sm-6 col-md-4 col-lg-3">
                    Celular
                    <input type="number" class="form-control" v-on:change="limitarChr" v-model="acompanante.celular" placeholder="Celular">
                </div>
                <div v-if="conacompanante" class="form-group col-sm-6 col-md-4 col-lg-3">
                    Telefono
                    <input type="number" class="form-control" v-on:change="limitarChr" v-model="acompanante.telefono" placeholder="Telefono">
                </div>
                <div v-if="conacompanante" class="form-group col-sm-6 col-md-4 col-lg-3">
                    Profesión
                    <input type="text" class="form-control" v-model="acompanante.ocupacion" placeholder="Profesión">
                </div>
                <div v-if="conacompanante" class="form-group col-sm-6 col-md-4 col-lg-3">
                    Edad
                    <input type="number" class="form-control" v-model="acompanante.edad" placeholder="Edad">
                </div>
                <div v-if="conacompanante" class="form-group col-sm-6 col-md-4 col-lg-3">
                    Estado Civil
                    <select class="form-control" v-model="acompanante.estadoCivil">
                        <option></option>
                        <option>SOLTERO</option>
                        <option>CASADO</option>
                        <option>DIVORCIADO</option>
                        <option>VIUDO</option>
                        <option>UNION LIBRE</option>
                    </select>
                </div>

                
                <div v-if="conacompanante && invitado.rastreo == 'OK'" class="form-group col-sm-6 col-md-4 col-lg-3">
                    Cedula
                    <input type="number" class="form-control" v-model="acompanante.cedula" placeholder="Cedula">
                </div>
                <div v-if="conacompanante && invitado.rastreo == 'OK'" class="form-group col-sm-6 col-md-4 col-lg-3">
                    Pasaporte
                    <input type="text" class="form-control" v-model="acompanante.pasaporte" placeholder="Pasaporte">
                </div>
                <div v-if="conacompanante && invitado.rastreo == 'OK'" class="form-group col-sm-6 col-md-4 col-lg-3">
                    Fecha de nacimiento
                    <input type="date" class="form-control" v-model="acompanante.fechaNacimiento">
                </div>
                                
                <hr class="col-11 mt-1">

                <div class="form-group col-12">
                    <button type="submit" class="btn btn-danger">Guardar</button>
                    <b-btn v-if="invitado.id" variant="primary" v-on:click="showModal">
                        <font-awesome-icon icon="money-check"></font-awesome-icon>
                        Tarjetas
                    </b-btn>
                    <b-modal v-if="invitado.id > 0" ref="myModal" hide-footer title="Tarjetas">
                        <invitado-tarjetas-component :base='base' :invitado='invitado.id' :acompanante="invitado.acompanante"></invitado-tarjetas-component>
                        <div v-if="cliente == 0" class="row">
                            <div class="col-12">
                                <a :href="destino + '/nuevoinvitado'" class="btn btn-danger">Finalizar</a>
                                <b-btn variant="secondary" v-on:click="hideModal">Cancelar</b-btn>
                            </div>
                        </div>
                    </b-modal>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
export default {
    props: ['base','cliente','destino'],
    data() {
        return {
            alerta: {
                tmk: ''
            },

            invitado: {},
            acompanante: {},

            sedes: [],

            conacompanante: false,

            nuevoCliente: {
                tipo: 1,

                sede: '',
                tmk: '',
                fechaCita: '',
                horaCita: '',
                estadoCita: '',

                acompanante: 0,

                nombre: '',
                edad: '',
                apellido: '',
                cedula: '',
                pasaporte: '',
                celular: '',
                telefono: '',
                email: '',
                email2: '',
                pais: '',
                provincia: '',
                ciudad: '',
                direccion: '',
                estadoCivil: '',
                ocupacion: '',
                fechaNacimiento: '',
            },
            nuevoAcompanante: {
                tipo: 3,

                nombre: '',
                edad: '',
                apellido: '',
                cedula: '',
                pasaporte: '',
                celular: '',
                telefono: '',
                email: '',
                email2: '',
                pais: '',
                provincia: '',
                ciudad: '',
                direccion: '',
                estadoCivil: '',
                ocupacion: '',
                fechaNacimiento: '',
            }
        }
    },
    mounted() {
        this.iniciar();
        this.getSedes();
    },
    methods: {
        limitarChr(){
            this.invitado.celular = (this.invitado.celular + '').substring(0,10);
            this.invitado.telefono = (this.invitado.telefono + '').substring(0,9);
            this.acompanante.celular = (this.acompanante.celular + '').substring(0,10);
            this.acompanante.telefono = (this.acompanante.telefono + '').substring(0,9);
        },
        existeTmk(){
            axios.get(this.base + '/getTmk/' + this.invitado.tmk).then((res) => {
                if (res.data.length > 0) {
                    this.alerta.tmk = '<span class="text-success">Codigo confirmado .</span>';
                }else{
                    this.alerta.tmk = '<span class="text-danger">Codigo no existe.</span>';
                }
            }).catch((err) => {
                console.log(err);
            });
        },
        showModal(){
            this.$refs.myModal.show();
        },
        hideModal(){
            this.$refs.myModal.hide();
        },
        iniciar(){
            if(this.cliente == 0){
                this.invitado = this.nuevoCliente;
            }else{
                axios.get(this.base + '/clientes/' + this.cliente).then((res) => {
                    this.invitado = res.data;

                    axios.get(this.base + '/clientes/' + this.invitado.acompanante).then((res2) => {
                        this.acompanante = res2.data;
                        this.conacompanante = true;
                    }).catch((err2) => {
                        this.acompanante = this.nuevoAcompanante;
                    });

                }).catch((err) => {
                    this.invitado = this.nuevoCliente;
                });
            }
        },
        getSedes(){
            axios.get(this.base + '/sedes').then((res) => {
                this.sedes = res.data;
            }).catch((err) => {
                console.log(err);
            });
        },
        guardar(){
            if (this.invitado.id) {
                if (this.conacompanante) {
                    if (this.acompanante.id) {
                        axios.put(this.base + '/clientes/' + this.acompanante.id,this.acompanante).then((res) => {
                            this.acompanante = res.data;
                            this.invitado.acompanante = this.acompanante.id;

                            axios.put(this.base + '/clientes/' + this.invitado.id,this.invitado).then((res2) => {
                                this.invitado = res2.data;
                                Toastr.success("Invitado Editado con exito.");
                            }).catch((err2) => {
                                Toastr.error("Error en el Invitado.");
                                console.log(err2);
                            });
                        }).catch((err) => {
                            Toastr.error("Error en el Acompañante.");
                            console.log(err);
                        });                        
                    } else {
                        this.acompanante.tipo = 3;
                        this.acompanante.acompanante = 0;
                        this.acompanante.sede = this.invitado.sede;
                        
                        axios.post(this.base + '/clientes',this.acompanante).then((res) => {
                            this.acompanante = res.data;
                            this.invitado.acompanante = this.acompanante.id;

                            axios.put(this.base + '/clientes/' + this.invitado.id,this.invitado).then((res2) => {
                                this.invitado = res2.data;
                                Toastr.success("Invitado Editado con exito.");
                            }).catch((err2) => {
                                Toastr.error("Error en el Invitado.");
                                console.log(err2);
                            });
                        }).catch((err) => {
                            Toastr.error("Error en el Acompañante.");
                            console.log(err);
                        });                        
                    }
                } else {
                    if (this.acompanante.id) {
                        axios.delete(this.base + '/clientes/' + this.acompanante.id).then((res) => {                    
                            this.acompanante = this.nuevoAcompanante;
                            console.log(res);
                        }).catch((err) => {
                            console.log(err);
                        });
                    }
                    this.invitado.acompanante = 0;

                    axios.put(this.base + '/clientes/' + this.invitado.id,this.invitado).then((res) => {
                        this.invitado = res.data;
                        Toastr.success("Invitado Editado con exito.");
                    }).catch((err) => {
                        Toastr.error("Error en el Invitado.");
                        console.log(err);
                    });
                }                
            } else {
                if (this.conacompanante) {
                    this.acompanante.tipo = 3;
                    this.acompanante.acompanante = 0;
                    this.acompanante.sede = this.invitado.sede;

                    axios.post(this.base + '/clientes',this.acompanante).then((res) => {
                        this.acompanante = res.data;
                        this.invitado.acompanante = this.acompanante.id;

                        axios.post(this.base + '/clientes',this.invitado).then((res2) => {
                            this.invitado = res2.data;
                            this.showModal();
                            Toastr.success("Invitado Creado, ahora Agregue las Tarjetas.");
                        }).catch((err2) => {
                            Toastr.error("AHORA AGREGA LAS TARJETAS.");
                            console.log(err2);
                        });
                    }).catch((err) => {
                        Toastr.error("Error en el Acompañante.");
                        console.log(err);
                    });
                } else {
                    axios.post(this.base + '/clientes',this.invitado).then((res) => {
                        this.invitado = res.data;
                        this.showModal();
                        Toastr.success("Invitado Creado, ahora Agregue las Tarjetas.");
                    }).catch((err) => {
                        Toastr.error("Agregue Tarjetas AHORA.");
                        console.log(err);
                    });
                }
            }
        }
    },
}
</script>