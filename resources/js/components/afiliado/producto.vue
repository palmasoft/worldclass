<template>
    <div class="card">
        <div class="card-header">
            <strong class="m-1">
                {{ factura.numero + ' - ' + factura.created_at }}
                <span class="text-danger" v-if="factura.estado == 1">
                    Venta Anulada
                </span>
                <span class="text-primary" v-if="factura.estado == 2">
                    Confirmacion
                </span>
                <span class="text-primary" v-if="factura.estado == 3">
                    Verificacion
                </span>
                <span class="text-primary" v-if="factura.estado == 4">
                    Reconfirmacion
                </span>
                <span class="text-success" v-if="factura.estado == 5">
                    Venta COMPLETADA
                </span>
            </strong>
            <b-btn variant="danger" v-if="tipo==1" v-on:click="borrar" class="m-1">
                <font-awesome-icon icon="trash"></font-awesome-icon>
            </b-btn>
            <b-btn variant="danger" v-if="tipo==1 && permiso_anular" v-on:click="anular" v-b-tooltip.hover title="Anular Venta" class="m-1">
                <font-awesome-icon icon="stop"></font-awesome-icon>
            </b-btn>
            <a :href="base + '/facturaclipro/' + factura.id" target="_blank" class="btn btn-secondary">
                Venta
            </a>

            <b-btn v-on:click="showModal" v-b-tooltip.hover title="Destalles">
                <font-awesome-icon icon="eye"></font-awesome-icon>
            </b-btn>

            <b-modal ref="myModal" hide-footer :title="'Detalles de la prefactura No. ' + factura.numero">
                <div class="row">
                    <div class="col-sm-6">
                        Nombre: 
                        <br>
                        <strong>
                            {{ factura.nombre }}
                        </strong>
                    </div>
                    <div class="col-sm-6">
                        Apellido: 
                        <br>
                        <strong>
                            {{ factura.apellido }}
                        </strong>
                    </div>
                    <div class="col-sm-6">
                        Cedula: 
                        <br>
                        <strong>
                            {{ factura.cedula }}
                        </strong>
                    </div>
                    <div class="col-sm-6">
                        Email: 
                        <br>
                        <strong>
                            {{ factura.email }}
                        </strong>
                    </div>
                </div>
                
                <hr>

                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>
                                            Proveedor
                                        </th>
                                        <th>
                                            Producto
                                        </th>
                                        <th>
                                            Cantidad
                                        </th>
                                        <th>
                                            V.Unitario
                                        </th>
                                        <th>
                                            Total
                                        </th>
                                        <th v-if="factura.estado > 1">
                                            Cuenta Bancaria
                                        </th>
                                        <th v-if="factura.estado > 1">
                                            Correo
                                        </th>
                                        <th v-if="factura.estado > 1">
                                            Valor del Proveedor
                                        </th>
                                        <th v-if="factura.estado > 1">
                                            Utilidad
                                        </th>
                                        <th v-if="factura.estado > 1">
                                            Deposito OCT/Cliente
                                        </th>
                                        <th v-if="factura.estado > 1">
                                            Transferencia OCT/Cliente
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(producto, index) in productos" :key="index">
                                        <td>
                                            <span v-for="(proveedorX, index) in proveedores" :key="index">
                                                <p v-if="proveedorX.id == producto.proveedor">
                                                    {{ proveedorX.nombre }}
                                                </p>
                                            </span>
                                        </td>
                                        <td>
                                            {{ producto.producto }}
                                        </td>
                                        <td>
                                            {{ producto.cantidad }}
                                        </td>
                                        <td>
                                            {{ producto.valor_unitario }}
                                        </td>
                                        <td>
                                            {{ producto.valor }}
                                        </td>
                                        <td v-if="factura.estado > 1">
                                            <span v-if="permiso_anular && factura.estado < 4">
                                                <span v-for="(proveedorX, index) in proveedores" :key="index">
                                                    <select v-if="proveedorX.id == producto.proveedor" class="form-control" v-model="producto.cuenta">
                                                        <option>
                                                            {{ 'Banco' + proveedorX.banco + ' - ' + proveedorX.cuenta_tipo + ' - ' + proveedorX.cuenta_numero }}
                                                        </option>
                                                        <option v-if="proveedorX.banco2">
                                                            {{ 'Banco' + proveedorX.banco2 + ' - ' + proveedorX.cuenta_tipo2 + ' - ' + proveedorX.cuenta_numero2 }}
                                                        </option>
                                                        <option v-if="proveedorX.banco3">
                                                            {{ 'Banco' + proveedorX.banco3 + ' - ' + proveedorX.cuenta_tipo3 + ' - ' + proveedorX.cuenta_numero3 }}
                                                        </option>
                                                        <option v-if="proveedorX.banco4">
                                                            {{ 'Banco' + proveedorX.banco4 + ' - ' + proveedorX.cuenta_tipo4 + ' - ' + proveedorX.cuenta_numero4 }}
                                                        </option>
                                                    </select>
                                                </span>
                                            </span>
                                            <span v-else>
                                                {{ producto.cuenta }}
                                            </span>
                                        </td>
                                        <td v-if="factura.estado > 1">
                                            <input v-if="permiso_anular && factura.estado < 4" type="text" v-model="producto.correo">
                                            <span v-else>
                                                {{ producto.correo }}
                                            </span>
                                        </td>
                                        <td v-if="factura.estado > 1">
                                            <input v-if="permiso_anular && factura.estado < 4" type="text" v-model="producto.valor_proveedor">
                                            <span v-else>
                                                {{ producto.valor_proveedor }}
                                            </span>
                                        </td>
                                        <td v-if="factura.estado > 1">
                                            <input v-if="permiso_anular && factura.estado < 4" type="text" v-model="producto.utilidad">
                                            <span v-else>
                                                {{ producto.utilidad }}
                                            </span>
                                        </td>
                                        <td v-if="factura.estado > 1">
                                            <input v-if="permiso_anular && factura.estado < 4" type="text" v-model="producto.deposito">
                                            <span v-else>
                                                {{ producto.deposito }}
                                            </span>
                                            /
                                            
                                            <input v-if="permiso_anular && factura.estado < 4" type="text" v-model="producto.deposito_directo">
                                            <span v-else>
                                                {{ producto.deposito_directo }}
                                            </span>
                                        </td>
                                        <td v-if="factura.estado > 1">
                                            <input v-if="permiso_anular && factura.estado < 4" type="text" v-model="producto.transferencia">
                                            <span v-else>
                                                {{ producto.transferencia }}
                                            </span>
                                            /
                                            
                                            <input v-if="permiso_anular && factura.estado < 4" type="text" v-model="producto.transferencia_directa">
                                            <span v-else>
                                                {{ producto.transferencia_directa }}
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-sm-6">
                        Descuento: 
                        <br>
                        <strong>
                            ${{ factura.descuento }}
                        </strong>
                    </div>
                    <div class="col-sm-6">
                        IVA: 
                        <br>
                        <strong>
                            ${{ factura.iva }}
                        </strong>
                    </div>
                    <div class="col-sm-6">
                        Total: 
                        <br>
                        <strong>
                            ${{ factura.total }}
                        </strong>
                    </div>
                    <div v-if="parseInt(factura.efectivo) > 0" class="col-sm-6">
                        Efectivo: 
                        <br>
                        <strong>
                            ${{ factura.efectivo }}
                        </strong>
                    </div>
                    <div v-if="parseInt(factura.deposito) > 0" class="col-sm-6">
                        Deposito: 
                        <br>
                        <strong>
                            ${{ factura.deposito }}
                        </strong>
                    </div>
                    <div v-if="parseInt(factura.transferencia) > 0" class="col-sm-6">
                        Transferencia: 
                        <br>
                        <strong>
                            ${{ factura.transferencia }}
                        </strong>
                    </div>
                    <div v-if="parseInt(factura.cheque) > 0" class="col-sm-6">
                        Cheque: 
                        <br>
                        <strong>
                            ${{ factura.cheque }}
                        </strong>
                    </div>
                    <div v-if="parseInt(factura.canje) > 0" class="col-sm-6">
                        Canje: 
                        <br>
                        <strong>
                            ${{ factura.canje }}
                        </strong>
                    </div>
                    <div v-if="parseInt(factura.tarjeta) > 0" class="col-sm-6">
                        Tarjeta: 
                        <br>
                        <strong>
                            ${{ factura.tarjeta }} diferido a {{ factura.diferido }} meses.
                        </strong>
                    </div>
                </div>

                <hr v-if="factura.estado == 4">

                <div v-if="factura.estado == 4" class="row">
                    <div class="form-group col-12">
                        <b-form-checkbox-group
                            v-model="emitir.seleccion"
                            :options="emitir.options"
                        ></b-form-checkbox-group>
                    </div>
                    <hr class="col-12">
                    <div class="col-12">
                        <div role="tablist">
                            <b-card no-body class="mb-1" v-if="emitir.seleccion.indexOf(1) != -1">
                                <b-card-header header-tag="header" class="p-1" role="tab">
                                    <b-button block href="#" v-b-toggle.accordion-1 variant="info">Vuelo</b-button>
                                </b-card-header>
                                <b-collapse id="accordion-1" accordion="my-accordion" role="tabpanel">
                                    <b-card-body>
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                Tipo de Servicio
                                                <select v-model="emitir.servicio" class="form-control">
                                                    <option>Emisión</option>
                                                    <option>Reemisión</option>
                                                    <option>Anulación</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                Boletos
                                                <select v-model="emitir.boletos" class="form-control">
                                                    <option>NACIONAL</option>
                                                    <option>INTERNACIONAL</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                Adultos
                                                <input v-model="emitir.adultos" type="number" class="form-control"/>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                Ni&ntilde;os
                                                <input v-model="emitir.ninos" type="number" class="form-control"/>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                Tercera Edad
                                                <input v-model="emitir.ancianos" type="number" class="form-control"/>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                Tercera Edad
                                                <input v-model="emitir.ancianos" type="number" class="form-control"/>
                                            </div>
                                            
                                            <div class="form-group col-sm-6">
                                                Record Localizador
                                                <input v-model="emitir.record" type="text" class="form-control"/>
                                            </div>
                                            <div class="form-group col-12">
                                                Forma de Pago
                                                <input v-model="emitir.formaPago" type="text" class="form-control"/>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                Valor Total a Pagar(En Caso de ser diferido no incluir intereses)
                                                <input v-model="emitir.total" type="number" step="0.01" class="form-control"/>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                Nombre del Agente
                                                <input v-model="emitir.agenteNombre" type="text" class="form-control"/>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                Cedula/Pasaporte del Agente
                                                <input v-model="emitir.agenteCedula" type="text" class="form-control"/>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                Nombre del Asesor
                                                <input v-model="emitir.asesor" type="text" class="form-control"/>
                                            </div>
                                            
                                            <div class="form-group col-sm-6">
                                                Valor a Pagar con Tarjeta
                                                <input v-model="emitir.pagoTc" type="number" step="0.01" class="form-control"/>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                Intereses del diferido de Tarjeta
                                                <input v-model="emitir.interesTc" type="number" step="0.01" class="form-control"/>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                Diferido (Meses)
                                                <input v-model="emitir.diferido" type="number" class="form-control"/>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                Total de Tarjeta
                                                <input v-model="emitir.totalTc" type="number" step="0.01" class="form-control"/>
                                            </div>
                                        </div>
                                    </b-card-body>
                                </b-collapse>
                            </b-card>
                            <b-card no-body class="mb-1" v-if="emitir.seleccion.indexOf(2) != -1">
                                <b-card-header header-tag="header" class="p-1" role="tab">
                                    <b-button block href="#" v-b-toggle.accordion-2 variant="info">Servicio Terrestre</b-button>
                                </b-card-header>
                                <b-collapse id="accordion-2" accordion="my-accordion" role="tabpanel">
                                    <b-card-body>
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                Tipo de Servicio
                                                <select v-model="emitir.servicioLan" class="form-control">
                                                    <option>Hotel</option>
                                                    <option>Renta de Autos</option>
                                                    <option>Asistencia</option>
                                                </select>
                                            </div>
                                            
                                            <div class="form-group col-sm-6">
                                                Record
                                                <input v-model="emitir.recordLan" type="text" class="form-control"/>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                Tarifa Cotizada
                                                <input v-model="emitir.cotizado" type="number" step="0.01" class="form-control"/>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                Valor a Pagar
                                                <input v-model="emitir.pagoLan" type="number" step="0.01" class="form-control"/>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                Forma de Pago
                                                <input v-model="emitir.formaPagoLan" type="text" class="form-control"/>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                Nombre del Agente
                                                <input v-model="emitir.agenteNombreLan" type="text" class="form-control"/>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                Cedula/Pasaporte del Agente
                                                <input v-model="emitir.agenteCedulaLan" type="text" class="form-control"/>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                Nombre del Asesor
                                                <input v-model="emitir.asesorLan" type="text" class="form-control"/>
                                            </div>
                                        </div>
                                    </b-card-body>
                                </b-collapse>
                            </b-card>
                            <b-card no-body class="mb-1" v-if="emitir.seleccion.indexOf(3) != -1">
                                <b-card-header header-tag="header" class="p-1" role="tab">
                                    <b-button block href="#" v-b-toggle.accordion-3 variant="info">Solicitud de servicio</b-button>
                                </b-card-header>
                                <b-collapse id="accordion-3" accordion="my-accordion" role="tabpanel">
                                    <b-card-body>
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                Tipo de Servicio
                                                <select v-model="emitir.servicio" class="form-control">
                                                    <option>Hotel</option>
                                                    <option>Renta de Autos</option>
                                                    <option>Asistencia</option>
                                                </select>
                                            </div>
                                            
                                            <div class="form-group col-sm-6">
                                                Reserva
                                                <input v-model="emitir.reservaX" type="text" class="form-control"/>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                Valor a Pagar
                                                <input v-model="emitir.pagoX" type="number" step="0.01" class="form-control"/>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                Forma de Pago
                                                <input v-model="emitir.formaPagoX" type="text" class="form-control"/>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                Nombre del Asesor
                                                <input v-model="emitir.asesorX" type="text" class="form-control"/>
                                            </div>
                                        </div>
                                    </b-card-body>
                                </b-collapse>
                            </b-card>
                        </div>
                    </div>
                </div>

                <hr>

                <div v-if="factura.estado != 1 && factura.estado != 5" class="row">
                    <div class="form-group col-12">
                        <textarea v-model="datos.comentario" rows="5" class="form-control"></textarea>
                    </div>
                    <div class="col-12">                       
                        <input  type="text" v-model="datos.codigo">
                        
                        <b-btn variant="success" v-if="tipo==1 && permiso_anular" v-on:click="confirmar" v-b-tooltip.hover title="Confirmacion" class="m-1">
                            <font-awesome-icon icon="stop"></font-awesome-icon>
                        </b-btn>
                    </div>
                </div>
            </b-modal>
        </div>
    </div>
</template>
<script>
export default {
    props: ['base','tipo','factura','permiso_anular','proveedores'],
    data() {
        return {
            productos: [],
            datos: {
                correos: '',
                codigo: '',
                estado: parseInt(this.factura.estado) + 1,
                comentario: '',
                lugar: 'PREFACTURA ' + this.factura.numero,
                productos: [],
            },
            emitir: {
                options: [
                    {text: 'Vuelo', value: 1},
                    {text: 'Servicio Terrestre', value: 2},
                    {text: 'Solicitud de servicio', value: 3}
                ],
                productos: [],
                estado: parseInt(this.factura.estado) + 1,
                seleccion: [],

                servicio: '',
                boletos: '',
                adultos: 0,
                ninos: 0,
                ancianos: 0,
                record: '',
                formaPago: '',
                total: this.factura.total,
                agenteNombre: '',
                agenteCedula: '',
                asesor: '',

                pagoTc: this.factura.tarjeta,
                diferido: this.factura.diferido,
                interesTc: 0,
                totalTc: this.factura.tarjeta,

                servicioLan: '',
                recordLan: '',
                cotizado: 0,
                pagoLan: 0,
                formaPagoLan: '',
                agenteNombreLan: '',
                agenteCedulaLan: '',
                asesorLan: '',

                servicioX: '',
                reservaX: '',
                pagoX: 0,
                formaPagoX: '',
                asesorX: ''
            }
        }
    },
    mounted() {
        this.getGlobales();
        this.getProductos();
    },
    methods: {
        showModal(){
            this.$refs.myModal.show();
        },
        hideModal(){
            this.$refs.myModal.hide();
        },
        confirmar(){
            if (this.factura.estado == '0') {
                this.datos.estado = '2';
            }
            if (this.datos.codigo == this.factura.codigo && this.factura.estado != this.datos.estado) {
                this.productos.forEach(productoX => {
                    productoX.utilidad = parseFloat(productoX.valor) - parseFloat(productoX.valor_proveedor);
                });

                this.datos.productos = this.productos;


                if (this.factura.estado != '4') {
                    axios.put(this.base + '/estadoclifactura/' + this.factura.id, this.datos).then((res) => {
                        Toastr.success("Venta Confirmada.");
    
                        this.factura.estado = this.datos.estado;
    
                        axios.post(this.base + '/comentarios/' + this.factura.cliente_id, this.datos).then((res2) => {
                            
                        }).catch((err2) => {
                            console.log(err2);
                        });
                    }).catch((e) => {
                        console.log(e);
                    });
                }else{
                    axios.put(this.base + '/estadoclifactura/' + this.factura.id, this.emitir).then((res) => {
                        Toastr.success("Venta Terminada.");
    
                        this.factura.estado = this.emitir.estado;
    
                        axios.post(this.base + '/comentarios/' + this.factura.cliente_id, this.datos).then((res2) => {
                            
                        }).catch((err2) => {
                            console.log(err2);
                        });
                    }).catch((e) => {
                        console.log(e);
                    });
                }
            }
        },
        getGlobales(){
            axios.get(this.base + '/variables').then((res) => {
                if (this.factura.estado == 0) {
                    this.correos = res.data[28].valor;                    
                }
                if (this.factura.estado == 2) {
                    this.correos = res.data[29].valor;                    
                }
                if (this.factura.estado == 3) {
                    this.correos = res.data[30].valor;                    
                }
                if (this.factura.estado == 4) {
                    this.correos = res.data[31].valor;                    
                }
            }).catch((err) => {
                console.log(err);
            });
        },
        getProductos(){
            axios.get(this.base + '/clienteprods/' + this.factura.cliente_id + '/' + this.factura.id).then((res) => {
                this.productos = res.data;
            }).catch((err) => {
                console.log(err);
            });
        },
        borrar(){
            axios.delete(this.base + '/clienteprods/' + this.factura.cliente_id + '/' + this.factura.id).then((res) => {
                this.$emit('delete');
                Toastr.success("Venta Eliminada.");
            }).catch((e) => {
                console.log(e);
            });
        },
        anular(){
            let datox = {
                estado: 1
            };
            axios.put(this.base + '/estadoclifactura/' + this.factura.id, datox).then((res) => {
                this.factura.estado = 1;
                Toastr.success("Venta Anulada.");
            }).catch((e) => {
                console.log(e);
            });
        }
    },
}
</script>