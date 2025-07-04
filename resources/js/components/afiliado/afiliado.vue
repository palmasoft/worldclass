<template>
    <div class="card">
        <div class="card-header">
            <strong class="mx-2">
                {{ contrato.titularNombre }} - {{ contrato.sede + contrato.consecutivo }}
            </strong>
            <a :href="destino + '/vercontrato/' + contrato.id" class="m-1 btn btn-primary" v-b-tooltip.hover title="Ver Contrato">
                <font-awesome-icon icon="eye"></font-awesome-icon>
            </a>
            <a :href="destino + '/tikets-cliente/' + titular.id" class="m-1 btn btn-warning" v-b-tooltip.hover title="Ver tikets">
                <font-awesome-icon icon="eye"></font-awesome-icon>
            </a>
            <a :href="destino + '/productos-cliente/' + titular.id" class="m-1 btn btn-secondary" v-b-tooltip.hover title="Ver productos">
                <font-awesome-icon icon="eye"></font-awesome-icon>
            </a>
            <b-btn variant="dark" v-on:click="showModal1" b-v-tooltip.hover title="Asignar Counters">
                <font-awesome-icon icon="user"></font-awesome-icon>
            </b-btn>
            
            <b-btn v-if="contrato.beneficiarios > 0" class="ml-1" v-on:click="showModal2" variant="info" v-b-tooltip.hover title="Beneficiarios">
                <font-awesome-icon icon="eye"></font-awesome-icon>
            </b-btn>

            <b-modal ref="myModal1" hide-footer :title="'Counters - ' + contrato.titularNombre">
                <form class="row" v-on:submit.prevent="asignarSoportes">
                    <div class="form-group col-12">
                        Counter 1
                        <select class="form-control" v-model="titular.soporte1">
                            <option value="0">Ninguno</option>
                            <option v-for="(usuario, index) in usuarios" :key="index" :value="usuario.id">
                                {{ usuario.name }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group col-12">
                        Counter 2
                        <select class="form-control" v-model="titular.soporte2">
                            <option value="0">Ninguno</option>
                            <option v-for="(usuario, index) in usuarios" :key="index" :value="usuario.id">
                                {{ usuario.name }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group col-12">
                        Counter 3
                        <select class="form-control" v-model="titular.soporte3">
                            <option value="0">Ninguno</option>
                            <option v-for="(usuario, index) in usuarios" :key="index" :value="usuario.id">
                                {{ usuario.name }}
                            </option>
                        </select>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <b-btn v-on:click="hideModal1">Cancelar</b-btn>
                    </div>
                </form>
            </b-modal>

            <b-modal ref="myModal2" hide-footer :title="'Beneficiarios del Contrato' + contrato.sede + contrato.consecutivo">
                <form v-if="contrato.beneficiarios > beneficiarios.length" class="row" v-on:submit.prevent="nuevoBeneficiario">
                    <div class="form-group col-6 col-md-3">
                        Primer Nombre
                        <input required type="text" class="form-control" v-model="beneficiarioN.nombre1">
                    </div>
                    <div class="form-group col-6 col-md-3">
                        Segundo Nombre
                        <input required type="text" class="form-control" v-model="beneficiarioN.nombre2">
                    </div>
                    <div class="form-group col-6 col-md-3">
                        Primer Apellido
                        <input required type="text" class="form-control" v-model="beneficiarioN.apellido1">
                    </div>
                    <div class="form-group col-6 col-md-3">
                        Segundo Apellido
                        <input required type="text" class="form-control" v-model="beneficiarioN.apellido2">
                    </div>
                    <div class="form-group col-6">
                        Cedula
                        <input type="text" class="form-control" v-model="beneficiarioN.cedula">
                    </div>
                    <div class="form-group col-6">
                        Pasaporte
                        <input type="text" class="form-control" v-model="beneficiarioN.pasaporte">
                    </div>
                    <div class="form-group col-6">
                        Celular
                        <input type="number" class="form-control" v-model="beneficiarioN.celular">
                    </div>
                    <div class="form-group col-6">
                        Telefono
                        <input type="number" class="form-control" v-model="beneficiarioN.telefono">
                    </div>
                    <div class="form-group col-6">
                        Correo Electronico
                        <input type="text" class="form-control" v-model="beneficiarioN.email">
                    </div>
                    <div class="form-group col-6">
                        Edad
                        <input required type="number" class="form-control" v-model="beneficiarioN.edad">
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <b-btn v-on:click="hideModal2">Cancelar</b-btn>
                    </div>
                </form>
                <hr>
                <ol>
                    <li v-for="(beneficiario, index) in beneficiarios" :key="index">
                        {{ beneficiario.nombre + ' ' + beneficiario.apellido }}
                        <b-btn variant="danger" v-b-tooltip.hover title="Eliminar" v-on:click="borrarBeneficiarios(index)">
                            <font-awesome-icon icon="trash"></font-awesome-icon>
                        </b-btn>
                    </li>
                </ol>
            </b-modal>
        </div>
        <div class="card-body">
            <strong>
                Counters: 
            </strong>
             {{ sup1 + ' - ' + sup2 + ' - ' + sup3 }}
             <br>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Afiliado</th>
                                    <th>Contrato</th>
                                    <th>Tikets</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        
                                        Nombre:    <strong>{{ titular.nombre }}</strong>
                                        <br>
                                        Apellido:  <strong>{{ titular.apellido }}</strong>
                                        <br>
                                        Telefonos: <strong>{{ titular.celular + ' / ' + titular.telefono }}</strong>
                                        <br>
                                        Email: <strong>{{ titular.email + ' / ' + titular.email2 }}</strong>
                                        <br>
                                        <span v-if="titular.cedula">
                                            Cedula:    <strong>{{ titular.cedula }}</strong>
                                        </span>
                                        <span v-else-if="titular.pasaporte">
                                            Pasaporte: <strong>{{ titular.pasaporte }}</strong>
                                        </span>
                                    </td>
                                    <td>
                                        Contrato: <strong>{{ contrato.sede + contrato.consecutivo }}</strong>
                                        <br>
                                        Fecha: <strong>{{ fechaCreacion }}</strong>
                                        <br>
                                        Estado Pago: 
                                        <strong>
                                            {{ contrato.estadoContrato }}
                                        </strong>
                                        <br>
                                        Estado CTO: 
                                            <strong v-if="contrato.estadoServicio < 2">
                                                <span class="text-success">Activo</span>
                                            </strong>
                                            <strong v-else-if="contrato.estadoServicio == 2">
                                                <span class="text-danger">Anulado</span>
                                            </strong>
                                            <strong v-else-if="contrato.estadoServicio == 3">
                                                <span class="text-danger">Anulado C.M.</span>
                                            </strong>
                                            <strong v-else-if="contrato.estadoServicio == 4">
                                                <span class="text-danger">Anulado E.D.</span>
                                            </strong>
                                        <br>
                                        Estado Servicio: 
                                            <strong v-if="contrato.estadoServicio == 0">
                                                <span class="text-success">Activo</span>
                                            </strong>
                                            <strong v-else-if="contrato.estadoServicio == 1">
                                                <span class="text-danger">Inactivo</span>
                                            </strong>                                        
                                    </td>
                                    <td>
                                        Abiertos:             <strong>{{ info.abiertos }}</strong>
                                        <br>
                                        Cerrados:             <strong>{{ info.cerrados }}</strong>
                                        <br>
                                        Contestados:          <strong>{{ info.respondidos }}</strong>
                                        <br>
                                        R. de Cliente: <strong>{{ info.respuestaCliente }}</strong>
                                    </td>
                                    <td>
                                        Pendiente: <strong>{{ infox.P }}</strong>
                                        <br>
                                        Gestion: <strong>{{ infox.G }}</strong>
                                        <br>
                                        Seguimiento: <strong>{{ infox.S }}</strong>
                                        <br>
                                        Venta: <strong>{{ infox.V }}</strong>
                                        <br>
                                        Cerrado: <strong>{{ infox.C }}</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['base','contratoid','destino','titularid'],
    data() {
        return {
            usuarios: [],
            contrato: {},
            titular: {},
            tikets: [],
            fechaCreacion: '',
            info: {
                abiertos: 0,
                respuestaCliente: 0,
                respondidos: 0,
                cerrados: 0
            },
            infox: {
                P: 0,
                G: 0,
                S: 0,
                V: 0,
                C: 0
            },
            sup1: '',
            sup2: '',
            sup3: '',

            beneficiarios: [],
            beneficiarioN: {
                nombre1: '',
                nombre2: '',
                nombre: '',
                apellido1: '',
                apellido2: '',
                apellido: '',
                cedula: '',
                pasaporte: '',
                celular: '',
                telefono: '',
                email: '',
                edad: 0,
            }
        }
    },
    mounted() {
        this.getInicio();
    },
    methods: {
        borrarBeneficiarios(index){
            axios.delete(this.base + '/contratosbeneficiarios/' + this.beneficiarios[index].id).then((res) => {
                this.beneficiarios.splice(index,1);
            }).catch((err) => {
                console.log(err);
            });
        },
        getMisBeneficiarios(){
            this.beneficiarios = [];
            axios.get(this.base + '/contratosbeneficiarios/' + this.contratoid).then((res) => {
                this.beneficiarios = res.data;
            }).catch((err) => {
                console.log(err);
            });
        },
        nuevoBeneficiario(){
            axios.post(this.base + '/contratosbeneficiarios/' + this.contratoid, this.beneficiarioN).then((res) => {
                this.beneficiarios.push(res.data);
                this.beneficiarioN = {
                    nombre1: '',
                    nombre2: '',
                    nombre: '',
                    apellido1: '',
                    apellido2: '',
                    apellido: '',
                    cedula: '',
                    pasaporte: '',
                    celular: '',
                    telefono: '',
                    email: '',
                    edad: 0,
                };
            }).catch((err) => {
                console.log(err);
            });
        },
        asignarSoportes(){
            axios.post(this.base + '/soporteasignado',this.titular).then((res) => {
                Toastr.success("Soporte asignado exitosamente.");
            }).catch((err) => {
                Toastr.error("Error.");
                console.log(err);
            });
        },
        showModal1(){
            this.$refs.myModal1.show();
            this.getUsuarios();
        },
        hideModal1(){
            this.$refs.myModal1.hide();
        },
        showModal2(){
            this.$refs.myModal2.show();
            this.getMisBeneficiarios();
        },
        hideModal2(){
            this.$refs.myModal2.hide();
        },
        getUsuarios(){
            this.usuarios = [];
            axios.get(this.base + '/usuarios').then((res) => {
                for (let i = 0; i < res.data.length; i++) {
                    axios.get(this.base + '/userroles/' + res.data[i].id).then((res2) => {
                            if (res2.data == '17' || res2.data == '18' || res2.data == '19') {
                                this.usuarios.push(res.data[i]);   
                            }
                    }).catch((err2) => {
                        console.log(err2);
                    });                    
                }
            }).catch((err) => {
                console.log(err);
            });
        },
        getInicio(){
            axios.get(this.base + '/contratos/' + this.contratoid).then((res) => {
                this.contrato = res.data;
                this.fechaCreacion = moment(this.contrato.created_at).format('LLLL').toUpperCase();
                if (res.data.factura) {
                    this.factura = true;
                }
            }).catch((err) => {
                console.log(err);
            });

                axios.get(this.base + '/clientes/' + this.titularid).then((res2) => {
                    this.titular = res2.data;

                    axios.get(this.base + '/usuarios/' + this.titular.soporte1).then((resX) => {
                        this.sup1 = resX.data.name;                        
                    }).catch((errX) => {
                        console.log(errX);
                    }); 
                    axios.get(this.base + '/usuarios/' + this.titular.soporte2).then((resX) => {
                        this.sup2 = resX.data.name;                        
                    }).catch((errX) => {
                        console.log(errX);
                    }); 
                    axios.get(this.base + '/usuarios/' + this.titular.soporte3).then((resX) => {
                        this.sup3 = resX.data.name;                        
                    }).catch((errX) => {
                        console.log(errX);
                    }); 
                }).catch((err2) => {
                    console.log(err2);
                });

                axios.get(this.base + '/tikets/' + this.titularid).then((res3) => {
                    this.tikets = res3.data;
                    for (let i = 0; i < res3.data.length; i++) {
                        if (res3.data[i].estado == 0) {
                            this.info.abiertos++;
                        } else if (res3.data[i].estado == 1) {
                            this.info.abiertos++;
                            this.info.respondidos++;
                        } else if (res3.data[i].estado == 2) {
                            this.info.abiertos++;
                            this.info.respuestaCliente++;
                        } else if (res3.data[i].estado == 3) {
                            this.info.cerrados++;
                        }   
                        
                        if (res3.data[i].estado2 == 'P') {
                            this.infox.P++;
                        } else if (res3.data[i].estado2 == 'G') {
                            this.infox.G++;
                        } else if (res3.data[i].estado2 == 'S') {
                            this.infox.S++;
                        } else if (res3.data[i].estado2 == 'V') {
                            this.infox.V++;
                        } else if (res3.data[i].estado2 == 'C') {
                            this.infox.C++;
                        }   
                    }
                }).catch((err3) => {
                    console.log(err3);
                });
        }
    },
}
</script>