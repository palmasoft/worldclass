<template>
    <div class="card" v-if="!borrar">
        <div class="card-header">
            <strong class="m-1">
                Contrato {{ contrato.sede + contrato.consecutivo }}
            </strong>      
            <b-btn v-if="!cartera && permiso_destroy" class="m-1" variant="danger" v-b-tooltip.hover title="Borrar" v-on:click="borrarContrato">
                <font-awesome-icon icon="trash"></font-awesome-icon>
            </b-btn>   
            <a v-if="!cartera" :href="destino + '/vercontrato/' + contrato.id" class="m-1 btn btn-primary" v-b-tooltip.hover title="Ver">
                <font-awesome-icon icon="eye"></font-awesome-icon>
            </a>
            <a v-else :href="destino + '/vercartera/' + contrato.id" class="m-1 btn btn-primary" v-b-tooltip.hover title="Ver">
                <font-awesome-icon icon="eye"></font-awesome-icon>
            </a>

            <b-btn class="m-1" v-if="permiso_anular && contrato.estadoServicio < 2 && !cartera" variant="warning" v-b-tooltip.hover title="Anular" v-on:click="estadoContrato(2)">
                <font-awesome-icon icon="ban"></font-awesome-icon>
            </b-btn>
            <b-btn class="m-1" v-else-if="permiso_anular && contrato.estadoServicio >= 2 && !cartera" variant="warning" v-b-tooltip.hover title="Activar" v-on:click="estadoContrato(0)">
                <font-awesome-icon icon="check-circle"></font-awesome-icon>
            </b-btn>
            
            <b-btn v-if="!cartera && permiso_consecutivo" class="m-1" variant="info" v-b-tooltip.hover title="Cambiar Consecutivo" v-on:click="showModal1">
                <font-awesome-icon icon="forward"></font-awesome-icon>
            </b-btn>
            <b-btn v-if="!factura && !cartera && permiso_factura" class="m-1" variant="secondary" v-b-tooltip.hover title="Numero de Factura" v-on:click="showModal2">
                <font-awesome-icon icon="dollar-sign"></font-awesome-icon>
            </b-btn>
            <b-btn v-if="!cartera" class="m-1" variant="light" v-b-tooltip.hover title="Comerciales" v-on:click="showModal3">
                <font-awesome-icon icon="user-tie"></font-awesome-icon>
            </b-btn>

            <b-btn v-if="!cartera" class="m-1" variant="info" v-b-tooltip.hover title="Legal" v-on:click="showModal4">
                <font-awesome-icon icon="balance-scale"></font-awesome-icon>
            </b-btn>
 
            <b-modal ref="myModal1" hide-footer :title="'Cambiar Consecutivo del Contrato ' + contrato.sede + contrato.consecutivo">
                <form class="row" v-on:submit.prevent="consecutivoUp">
                    <div class="form-group col-6">
                        Consecutivo
                        <input class="form-control" type="number" step="1" v-model="contrato.consecutivo" required>
                    </div>
                    <div class="form-group col-6">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </b-modal>

            <b-modal v-if="!factura" ref="myModal2" hide-footer :title="'Numero de Factura del Contrato ' + contrato.sede + contrato.consecutivo">
                <form class="row" v-on:submit.prevent="facturaUp">
                    <div class="form-group col-6">
                        Factura
                        <input class="form-control" type="text" v-model="contrato.factura" required>
                    </div>
                    <div class="form-group col-6">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </b-modal>

            <b-modal ref="myModal3" hide-footer :title="'Comerciales - ' + contrato.sede + contrato.consecutivo">
                <div v-if="permiso_comerciales" class="row">
                    <div class="col-12">
                        <button class="btn btn-danger" v-on:click="comicionablesUp">Cuadrar Comisión con el estado actual del Contrato</button>
                    </div>
                </div>
                <hr>
                <form v-if="permiso_comerciales" class="row" v-on:submit.prevent="comercialesUp">
                    <div class="form-group col-sm-6">
                        Cargo
                        <select class="form-control" v-model="participanteN.cargo_id" required @change="getEmpleados(participanteN.cargo_id)">
                            <option value="0">-Ninguno-</option>
                            <option v-for="(cargo, index) in cargos" :key="index" :value="cargo.id">
                                {{ cargo.nombre }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group col-sm-6">
                        Empleado
                        <select class="form-control" v-model="participanteN.empleado_id" required>
                            <option value="0">-Ninguno-</option>
                            <option v-for="(empleado, index) in empleados" :key="index" :value="empleado.id">
                                {{ empleado.nombre + ' ' + empleado.apellido }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group col-12">
                        <button type="submit" class="btn btn-primary">Agregar</button>
                    </div>
                </form>
                <hr>
                <div class="row">
                    <div class="col-12 mt-1 mb-1" v-for="(participante, index) in participantes" :key="index">
                        <div class="card">
                            <div class="card-body">
                                Cargo: {{ participante.cargo }}, Comercial: {{ participante.nombre+' '+participante.apellido }}.
                                <hr>
                                <b-btn v-if="permiso_comerciales" variant="danger" v-b-tooltip.hover title="Remover" v-on:click="comercialesDel(index,participante.id)">
                                    <font-awesome-icon icon="trash"></font-awesome-icon>
                                </b-btn>
                            </div>
                        </div>
                    </div>
                </div>
            </b-modal>

            <b-modal v-if="!factura" ref="myModal4" hide-footer :title="'Documento legal del Contrato ' + contrato.sede + contrato.consecutivo">
                <strong>
                    Valor: 
                    {{ contrato.valorContrato }} ,
                    P. Inicial: 
                    {{ contrato.pagoInicial }} ,
                    Saldo a Favor: 
                    {{ contrato.saldoFavor }} ,
                </strong>
                <hr>
                <form v-if="codigoL == ''" class="row" v-on:submit.prevent="enviarAutorizacion">
                    <div class="form-group col-sm-6">
                        Tipo de documento
                        <select v-model="formulario_legal.tipo" class="form-control" required>
                            <option value="1">
                                Acta de canje por servicios
                            </option>
                            <option value="2">
                                Acta de terminacion canje con penalidad
                            </option>
                            <option value="3">
                                Acta de terminacion canje sin penalidad
                            </option>
                            <option value="4">
                                Acta de terminacion devolucion cero penalidad
                            </option>
                            <option value="5">
                                Acta de terminacion devolucion total
                            </option>
                        </select>
                    </div>
                    <div class="form-group col-sm-6">
                        Penalidad
                        <input type="number" step="0.01" v-model="formulario_legal.retencion">
                    </div>
                    <div class="form-group col-sm-6">
                        Valor a Devolver
                        <input type="number" step="0.01" v-model="formulario_legal.devolucion">
                    </div>
                    <div class="form-group col-sm-6">
                        Vslor a Canjear
                        <input type="number" step="0.01" v-model="formulario_legal.canje_total">
                    </div>
                    <div class="form-group col-12">
                        Concepto/Descripcion
                        <textarea class="form-control" rows="4" v-model="formulario_legal.descripcion"></textarea>
                    </div>
                    <div class="form-group col-12">
                        Comentario
                        <textarea class="form-control" rows="4" v-model="formulario_legal.comentario"></textarea>
                    </div>
                    <div class="form-group col-12">
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                </form>
                <form v-else class="row" v-on:submit.prevent="autorizar">
                    <div class="col-12">
                        <strong>El codigo de Autorizacion ha sido enviado a sus superiores,solicitelo he ingreselo aqui para generar el documento.</strong>
                    </div>
                    <div class="form-group col-12">
                        Codigo de Autorizacion
                        <input type="text" class="form-control" v-model="codigox">
                    </div>
                    <div class="form-group col-12">
                        <button type="submit" class="btn btn-primary">Comprobar</button>
                    </div>
                </form>
                <hr>
                <div class="row">
                    <div class="form-group col-12">
                        <b-button v-b-toggle.collapse1 v-if="legales" class="form-control" variant="secondary">Actas Generadas</b-button>
                    </div>
                    <div class="col-12">
                        <b-collapse id="collapse1" class="mt-2">
                            <b-card>
                                <a target="_blanck" v-for="(legal, index) in legales" :key="index" :href="destino + '/documentos/actas/' + legal.acta" class="btn btn-link">
                                    Acta - {{ legal.created_at }}
                                </a>
                            </b-card>
                        </b-collapse>     
                    </div>
                </div>
            </b-modal>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>
                                        Fecha/Hora
                                    </td>
                                    <td>
                                        Agente
                                    </td>
                                    <td>
                                        Titular
                                    </td>
                                    <td v-if="contrato.cotitular > 0">
                                        Cotitular
                                    </td>
                                    <td>
                                        A&ntilde;os P.
                                    </td>
                                    <td>
                                        Vlr. Cto.
                                    </td>
                                    <td>
                                        P. I.
                                    </td>
                                    <td>
                                        Brdng
                                    </td>
                                    <td>
                                        Club
                                    </td>
                                    <td>
                                        Servicio
                                    </td>
                                    <td>
                                        Estado
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        {{ contrato.created_at }}
                                    </td>
                                    <td>
                                        {{ contrato.creador }}
                                    </td>
                                    <td>
                                        {{ contrato.titularNombre }}
                                    </td>
                                    <td v-if="contrato.cotitular > 0">
                                        {{ contrato.cotitularNombre }}
                                    </td>
                                    <td>
                                        {{ contrato.anosPactados }}
                                    </td>
                                    <td>
                                        {{ contrato.valorContrato }}
                                    </td>
                                    <td>
                                        {{ contrato.pagoInicial }}
                                    </td>
                                    <td>
                                        {{ contrato.boordingCard }}
                                    </td>
                                    <td>
                                        {{ contrato.club }}
                                    </td>
                                    <td>
                                        <p v-if="contrato.estadoServicio < 2">
                                            <b-btn class="m-1" v-b-tooltip.hover title="Estado del Contrato" variant="success">
                                                ACTIVO
                                            </b-btn>
                                            <b-btn class="m-1" v-b-tooltip.hover title="Estado del Servicio" v-if="contrato.estadoServicio == 0" variant="success">
                                                ACTIVO
                                            </b-btn>
                                            <b-btn class="m-1" v-b-tooltip.hover title="Estado del Servicio" v-else-if="contrato.estadoServicio == 1" variant="warning">
                                                INACTIVO
                                            </b-btn>
                                        </p>
                                        <b-btn class="m-1" v-else-if="contrato.estadoServicio == 2" variant="danger">
                                            ANULADO
                                        </b-btn>      
                                        <b-btn class="m-1" v-else-if="contrato.estadoServicio == 3" variant="danger">
                                            ANULADO C.M.
                                        </b-btn>  
                                        <b-btn class="m-1" v-else-if="contrato.estadoServicio == 4" variant="danger">
                                            ANULADO E.D.
                                        </b-btn>                                    
                                    </td>
                                    <td>
                                        {{ contrato.estadoContrato }}
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
    props: ['base','contratoid','destino','cartera'],
    data() {
        return {
            permiso_anular: false,
            permiso_comerciales: false,
            permiso_consecutivo: false,
            permiso_factura: false,
            permiso_destroy: false,

            cargos: [],
            empleados: [],
            participantes: [],
            participanteN: {
                cargo_id: 0,
                empleado_id: 0,
            },
            contrato: {},
            borrar: false,
            factura: false,

            autorizadoL: false,
            codigoL: '',

            codigox: '',
            formulario_legal: {
                tipo: 1,
                retencion: 0.00,
                devolucion: 0.00,
                canje_total: 0.00,
                descripcion: '',
                comentario: ''
            },
            legales: []
        }
    },
    mounted() {
        this.getContrato();
        this.getMisPermisos();
    },
    methods: {
        getLegales(){
            axios.get(this.base + '/getlegales/' + this.contratoid).then((res) => {
                this.legales = res.data;
            }).catch((err) => {
                console.log(err);
            });
        },
        autorizar(){
            if (this.codigox == this.codigoL) {
                axios.post(this.base + '/legalPdf/' + this.contratoid + '/' + this.formulario_legal.tipo,this.formulario_legal).then((res) => {
                    Toastr.success("Documento Generado.");
                    this.codigoL = '';
                    this.codigox = '';
                    this.formulario_legal= {
                        tipo: 1,
                        retencion: 0.00,
                        devolucion: 0.00,
                        canje_total: 0.00,
                        descripcion: '',
                        comentario: ''
                    };
                    this.getLegales();
                }).catch((err) => {
                    Toastr.error("Error al generar el documento.");
                    console.log(err);
                })
            }else{
                Toastr.error("El codigo introducido es erroneo.");
            }
        },
        enviarAutorizacion(){
            axios.get(this.base + '/legalsend/' + this.contratoid).then((res) => {
                this.codigoL = res.data;

            }).catch((err) => {
                Toastr.error("No se pudo enviar la autorizacion, intentelo mas tarde.")
                console.log(err);
            });
        },
        getMisPermisos(){
            axios.get(this.base + '/permisoExiste/contrato.anular').then((res) => {
                this.permiso_anular = res.data.existe;
            }).catch((err) => {
                console.log(err);
            });
            axios.get(this.base + '/permisoExiste/contrato.comerciales').then((res) => {
                this.permiso_comerciales = res.data.existe;
            }).catch((err) => {
                console.log(err);
            });
            axios.get(this.base + '/permisoExiste/contrato.consecutivo').then((res) => {
                this.permiso_consecutivo = res.data.existe;
            }).catch((err) => {
                console.log(err);
            });
            axios.get(this.base + '/permisoExiste/contrato.factura').then((res) => {
                this.permiso_factura = res.data.existe;
            }).catch((err) => {
                console.log(err);
            });
            axios.get(this.base + '/permisoExiste/contrato.destroy').then((res) => {
                this.permiso_destroy = res.data.existe;
            }).catch((err) => {
                console.log(err);
            });
        },
        comicionablesUp(){
            for (let i = 0; i < this.participantes.length; i++) {
                axios.post(this.base + '/comicionables/' + this.contrato.id, this.participantes[i]).then((res) => {
                    Toastr.success("Comisión Agregada.");
                }).catch((err) => {
                    Toastr.error("Hubo un error al calcular la Comisión.");
                    console.log(err);
                });                                
            }
        },
        showModal1(){
            this.$refs.myModal1.show();
        },
        hideModal1(){
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
            this.getParticipantes();
            this.getCargos();
        },
        hideModal3(){
            this.$refs.myModal3.hide();
        },
        showModal4(){
            this.$refs.myModal4.show();
            this.getLegales();
        },
        hideModal4(){
            this.$refs.myModal4.hide();
        },
        getParticipantes(){
            axios.get(this.base + '/participantes/' + this.contrato.titular).then((res) => {
                this.participantes = res.data;
            }).catch((err) => {
                console.log(err);
            });
        },
        getCargos(){
            axios.get(this.base + '/cargos').then((res) => {
                this.cargos = res.data;
            }).catch((err) => {
                console.log(err);
            });
        },
        getEmpleados(car){
            axios.get(this.base + '/empleadoscargo2/' + car).then((res) => {
                this.empleados = res.data;
            }).catch((err) => {
                console.log(err);
            });
        },
        getContrato(){
            axios.get(this.base + '/contratos/' + this.contratoid).then((res) => {
                this.contrato = res.data;
                if (res.data.factura) {
                    this.factura = true;
                }
            }).catch((err) => {
                console.log(err);
            });
        },
        borrarContrato(){
            axios.delete(this.base + '/contratos/' + this.contratoid).then((res) => {
                Toastr.success("Contrato Eliminado!!!");
                this.borrar = true;
            }).catch((err) => {
                Toastr.error("Error al eliminar el contrato.");
                console.log(err);
            });
        },
        estadoContrato(estado){
            axios.get(this.base + '/estadoserviciocontrato/' + estado + '/' + this.contratoid).then((res) => {
                this.contrato.estadoServicio = estado;
                if (estado == 0) {
                    Toastr.success("El contrato ha sido Activado!!");
                } else {
                    Toastr.success("El contrato ha sido Anulado!!");
                }
            }).catch((err) => {
                Toastr.error("Error al cambiar el estado del contrato.");
                console.log(err);
            });
        },
        consecutivoUp(){
            axios.get(this.base + '/consecutivocontrato/' + this.contrato.consecutivo + '/' + this.contratoid).then((res) => {
                Toastr.success("El consecutivo ha sido Actualizado!!");
                this.hideModal1();
            }).catch((err) => {
                Toastr.error("Error al cambiar el consecutivo del contrato.");
                console.log(err);
            });
        },
        facturaUp(){
            axios.get(this.base + '/facturacontrato/' + this.contrato.factura + '/' + this.contratoid).then((res) => {
                Toastr.success("La factura ha sido Registrada!!");
                this.hideModal2();
                this.factura = true;
            }).catch((err) => {
                Toastr.error("Error al registrar la factura del contrato.");
                console.log(err);
            });
        },
        comercialesUp(){
            axios.post(this.base + '/participantes/' + this.contrato.titular, this.participanteN).then((res) => {
                this.participanteN = {
                    cargo_id: 0,
                    empleado_id: 0,
                };
                this.getParticipantes();
                Toastr.success("Comercial Agregado!!");
            }).catch((err) => {
                Toastr.error("Error alintentar Agregar al comercial.");
                console.log(err);
            });
        },
        comercialesDel(index,participante){
            axios.delete(this.base + '/participantes/' + this.contrato.titular + '/' + participante).then((res) => {
                this.participantes.splice(index,1);
                Toastr.success("Comercial Removido!!");
            }).catch((err) => {
                Toastr.error("Error alintentar remover al comercial.");
                console.log(err);
            });
        }
    },
}
</script>