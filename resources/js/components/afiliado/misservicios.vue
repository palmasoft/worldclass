<template>
    <div class="card">
        <div class="card-header">
            <strong>Mis Servicios</strong>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <strong class="m-1">
                                MI CONTRATO
                            </strong>
                            <b-btn v-if="servicios" class="ml-1" v-on:click="showModal1" v-b-tooltip.hover title="Mis Servicios">
                                <font-awesome-icon icon="eye"></font-awesome-icon>
                            </b-btn>
                            <b-btn v-if="contrato.beneficiarios > 0" class="ml-1" v-on:click="showModal2" variant="primary" v-b-tooltip.hover title="Mis Beneficiarios">
                                <font-awesome-icon icon="eye"></font-awesome-icon>
                            </b-btn>

                            <b-modal ref="myModal1" hide-footer title="Servicios de mi Contrato">
                                <ol>
                                    <li v-for="(servicio, index) in servicios" :key="index">
                                        {{ servicio.servicio }}
                                        <strong v-if="servicio.tipo == 1">
                                           - NACIONAL
                                        </strong>
                                        <strong v-if="servicio.tipo == 2">
                                           - INTERNACIONAL
                                        </strong>
                                    </li>
                                </ol>
                            </b-modal>

                            <b-modal ref="myModal2" hide-footer title="Beneficiarios de mi Contrato">
                                <p>
                                    <strong>Advertencia:</strong>
                                    Una vez agregado el beneficiario no podra cambiarlo por otro en 1 a&ntilde;o.
                                    Solo puede agregar un numero maximo de {{ contrato.beneficiarios }} beneficiarios.
                                </p>
                                <hr>
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
                                    </li>
                                </ol>
                            </b-modal>
                        </div>
                    </div>
                </div>

                <div class="col-12" v-for="(factura, index) in productoss" :key="index">
                    <div class="card">
                        <div class="card-body">
                            <strong class="m-1">
                                {{ factura.numero + ' - ' + factura.created_at }}
                                <span class="text-danger" v-if="factura.estado == 1">
                                    Venta Anulada
                                </span>
                            </strong>
                            <a :href="base + '/facturaclipro/' + factura.id" target="_blank" class="btn btn-secondary">
                                Prefactura
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['base','cliente','contratoid'],
    data() {
        return {
            productos: [],
            contrato: {},
            fechaCreacion: '',
            servicios: [],
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
        this.getContrato();
        this.getMisProductos();
        this.getMisServicios();
        this.getMisBeneficiarios();
    },
    methods: {
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
        getContrato(){
            axios.get(this.base + '/contratos/' + this.contratoid).then((res) => {
                this.contrato = res.data;
                this.fechaCreacion = moment(this.contrato.created_at).format('LLLL').toUpperCase();
            }).catch((err) => {
                console.log(err);
            });
        },
        getMisProductos(){
            axios.get(this.base + '/clienteprods/' + this.cliente).then((res) => {
                this.productos = res.data;
            }).catch((err) => {
                console.log(err);
            });
        },
        getMisServicios(){
            this.servicios = [];
            axios.get(this.base + '/contratoservicio/' + this.contratoid).then((res) => {
                this.servicios = res.data;
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
        }
    },
}
</script>