<template>
    <div class="card">
        <div class="card-header">
            <strong v-if="tipo == 2">
                Mis Productos
            </strong>
            <strong v-if="tipo == 1">
                Productos - 
                {{ cliente.nombre + ' ' + cliente.apellido }}
            </strong>
            <b-btn v-if="tipo == 1" v-b-tooltip.hover title="Nueva Venta" variant="success" v-on:click="showModal1">
                <font-awesome-icon icon="plus"></font-awesome-icon>
            </b-btn>
            <b-modal ref="myModal1" hide-footer title="Nueva Venta">
                <strong v-if="saldo>0">Saldo a favor: {{saldo}}</strong>
                <hr>
                <form class="row" v-on:submit.prevent="nuevo">
                    <div class="form-group col-md-6">
                        Proveedor
                        <select v-model="productoN.proveedor" class="form-control" v-on:change="getProductos">
                            <option value="0">NINGUNO</option>
                            <option v-for="(provee, index) in proveedores" :key="index" :value="provee.id">
                                {{ provee.nombre }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        Producto
                        <select v-model="productoN.producto" class="form-control">
                            <option v-for="(producto, index) in productos" :key="index">
                                {{ producto.nombre }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group col-12">
                        A nombre de:
                        <select v-model="productoN.clifact" class="form-control">
                            <option v-for="(prospecto, index) in prospectos" :key="index" :value="index">
                                {{ prospecto.tipo + ' - ' + prospecto.nombre + ' ' + prospecto.apellido }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group col-sm-5">
                        Valor U.
                        <input type="number" step="0.01" class="form-control" v-model="productoN.valor_unitario">
                    </div>
                    <div class="form-group col-sm-5">
                        Cantidad
                        <input type="number" step="1" class="form-control" v-model="productoN.cantidad">
                    </div>
                    <div class="col-sm-5">
                        <b-btn v-on:click="addProducto">
                            <font-awesome-icon icon="plus"></font-awesome-icon>
                        </b-btn>
                    </div>
                    <div class="col-12">
                        <hr>
                        
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
                                        <th>
                                            Eliminar
                                        </th>
                                        <th>
                                            Beneficiarios
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(producto, index) in facturaN.productos" :key="index">
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
                                        <td>
                                            <b-btn variant="danger" v-on:click="eliminar(index)">
                                                Eliminar
                                            </b-btn>
                                        </td>
                                        <td>
                                            <b-button v-b-toggle.collapse-1 variant="primary">Beneficiarios Producto</b-button>
                                            <b-collapse id="collapse-1" class="mt-2">
                                                <div class="form-group">
                                                    Nombre
                                                    <input type="text" class="form-control" v-model="beneficiarioN.nombre">
                                                </div>
                                                <div class="form-group">
                                                    Apellido
                                                    <input type="text" class="form-control" v-model="beneficiarioN.apellido">
                                                </div>
                                                <div class="form-group">
                                                    Cedula
                                                    <input type="text" class="form-control" v-model="beneficiarioN.cedula">
                                                </div>
                                                <div class="form-group">
                                                    Pasaporte
                                                    <input type="text" class="form-control" v-model="beneficiarioN.pasaporte">
                                                </div>
                                                <div class="form-group" v-if="beneficiarioN.pasaporte">
                                                    Caducidad Pasaporte
                                                    <input type="date" class="form-control" v-model="beneficiarioN.caducidadPasaporte">
                                                </div>
                                                <div class="form-group">
                                                    Fecha de Nacimiento
                                                    <input type="date" class="form-control" v-model="beneficiarioN.fechaNacimiento">
                                                </div>
                                                <div class="form-group">
                                                    Edad
                                                    <input type="number" class="form-control" v-model="beneficiarioN.edad">
                                                </div>
                                                <b-btn v-on:click="beneficiar(index)">
                                                    Agregar
                                                </b-btn>
                                                <hr>
                                                <ol>
                                                    <li v-for="(beneficia, index2) in producto.beneficiarios" :key="index2">
                                                        {{ beneficia.nombre + ' ' + beneficia.apellido + ', CI: ' + beneficia.cedula }}
                                                        
                                                        <span v-if="beneficia.pasaporte">
                                                            {{ ', Pasaporte: ' + beneficia.pasaporte + ' caduca ' + beneficia.caducidadPasaporte }} 
                                                        </span>

                                                        ; {{ 'Fecha de Nacimiento: ' + beneficia.fechaNacimiento + ', edad ' +  beneficia.edad + ' años.' }}
                                                    </li>
                                                </ol>
                                            </b-collapse>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <hr>
                    </div>
                    <div class="form-group col-sm-4">
                        Descuento.
                        <input type="number" step="0.01" class="form-control" v-model="facturaN.descuento" v-on:change="calcularTotal">
                    </div>
                    <div class="form-group col-sm-4">
                        IVA
                        <input type="number" step="0.01" class="form-control" v-model="facturaN.iva">
                    </div>
                    <div class="form-group col-sm-4">
                        TOTAL.
                        <input type="number" step="0.01" class="form-control" v-model="facturaN.total">
                    </div>
                    <div class="form-group col-sm-4">
                        Efectivo.
                        <input type="number" step="0.01" class="form-control" v-model="facturaN.efectivo">
                    </div>
                    <div class="form-group col-sm-4">
                        Deposito.
                        <input type="number" step="0.01" class="form-control" v-model="facturaN.deposito">
                    </div>
                    <div class="form-group col-sm-4">
                        Transferencia.
                        <input type="number" step="0.01" class="form-control" v-model="facturaN.transferencia">
                    </div>
                    <div class="form-group col-sm-4">
                        Cheque.
                        <input type="number" step="0.01" class="form-control" v-model="facturaN.cheque">
                    </div>
                    <div class="form-group col-sm-4">
                        Tarjeta.
                        <input type="number" step="0.01" class="form-control" v-model="facturaN.tarjeta">
                    </div>
                    <div class="form-group col-sm-4" v-if="facturaN.tarjeta > 0">
                        DIferido.
                        <input type="number" step="0.01" class="form-control" v-model="facturaN.diferido">
                    </div>
                    <div class="form-group col-sm-4" v-if="saldo>0">
                        Canje.
                        <input type="number" step="0.01" class="form-control" v-model="facturaN.canje">
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <b-btn v-on:click="hideModal1">Cancelar</b-btn>
                    </div>
                </form>
            </b-modal>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12" v-for="(miFactura, index) in misFacturas" :key="index">
                    <producto-afiliado-component :base="base" :tipo="tipo" :factura="miFactura"
                                @delete="borrar(index)" @update="actualizar(index)"
                                :permiso_anular="permiso_anular" :proveedores="proveedores">                        
                    </producto-afiliado-component>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['base','clienteid','tipo','saldo','contratoid'],
    data() {
        return {
            permiso_anular: false,
            
            prospectos: [],

            cliente: {},
            productos: [],
            proveedores: [],
            proveedor: 0,
            productoN: {
                valor: 0.0,
                cantidad: 0,
                valor_unitario: 0.0,
                producto: '',
                proveedor: 0,
                beneficiarios: []
            },
            beneficiarioN: {
                nombre:'', 
                apellido:'',
                cedula:'',
                pasaporte:'',
                fechaNacimiento:'',
                edad:0, 
                caducidadPasaporte:'',
            },
            facturaN: {
                productos: [],
                total: 0.0,
                descuento: 0.0,
                iva: 0.0,
                efectivo: 0.0,
                deposito: 0.0,
                transferencia: 0.0,
                tarjeta: 0.0,
                cheque: 0.0,
                canje: 0.0,
                diferido: 0,

                clifact: 0,

                nombre: '',
                apellido: '',
                cedula: '',
                email: '',
                codigo: '',
            },
            misFacturas: [],
        }
    },
    mounted() {
        this.getCliente();
        this.getProveedores();
        this.getProductos();
        this.getMisProductos();
        this.getMisPermisos();
        this.getProspectos();
    },
    methods: {
        beneficiar(index){
            this.facturaN.productos[index].beneficiarios.push(this.beneficiarioN);
            this.beneficiarioN = {
                nombre:'', 
                apellido:'',
                cedula:'',
                pasaporte:'',
                fechaNacimiento:'',
                edad:0, 
                caducidadPasaporte:'',
            };
        },
        getProspectos(){
            axios.get(this.base + '/clientes/' + this.clienteid).then((res) => {
                let datocc = {
                        tipo: 'Titular',
                        nombre: res.data.nombre,
                        apellido: res.data.apellido,
                        cedula: res.data.cedula,
                        email: res.data.email,
                    };
                this.prospectos.push(datocc);  
            }).catch((err) => {
                console.log(err);
            });
            axios.get(this.base + '/contratos/' + this.contratoid).then((res) => {
                axios.get(this.base + '/clientes/' + res.data.cotitular).then((res2) => {
                    let datocc = {
                        tipo: 'Cotitular',
                        nombre: res2.data.nombre,
                        apellido: res2.data.apellido,
                        cedula: res2.data.cedula,
                        email: res2.data.email,
                    };
                    this.prospectos.push(datocc);   
                }).catch((err) => {
                    console.log(err);
                });
            }).catch((err) => {
                console.log(err);
            });
            axios.get(this.base + '/contratosbeneficiarios/' + this.contratoid).then((res) => {
                for (let i = 0; i < res.data.length; i++) {
                    let datocc = {
                        tipo: 'Beneficiario',
                        nombre: res.data[i].nombre,
                        apellido: res.data[i].apellido,
                        cedula: res.data[i].cedula,
                        email: res.data[i].email,
                    };
                    this.prospectos.push(datocc);                    
                }
            }).catch((err) => {
                console.log(err);
            });
        },
        getMisPermisos(){
            axios.get(this.base + '/permisoExiste/producto.afiliado.anular').then((res) => {
                this.permiso_anular = res.data.existe;
            }).catch((err) => {
                console.log(err);
            });
        },
        showModal1(){
            this.$refs.myModal1.show();
        },
        hideModal1(){
            this.$refs.myModal1.hide();
        },
        getCliente(){
            axios.get(this.base + '/clientes/' + this.clienteid).then((res) => {
                this.cliente = res.data;
            }).catch((err) => {
                console.log(err);
            });
        },
        getProductos(){
            this.productos = [];
            axios.get(this.base + '/productos').then((res) => {
                for (let i = 0; i < res.data.length; i++) {
                    if(this.productoN.proveedor == res.data[i].proveedor_id){
                        this.productos.push(res.data[i]);
                    }                    
                }                
            }).catch((err) => {
                console.log(err);
            });
        },
        getMisProductos(){
            axios.get(this.base + '/clienteprods/' + this.clienteid).then((res) => {
                this.misFacturas = res.data;
            }).catch((err) => {
                console.log(err);
            });
        },
        nuevo(){
            this.facturaN.nombre = this.prospectos[this.facturaN.clifact].nombre;
            this.facturaN.apellido = this.prospectos[this.facturaN.clifact].apellido;
            this.facturaN.cedula = this.prospectos[this.facturaN.clifact].cedula;
            this.facturaN.email = this.prospectos[this.facturaN.clifact].email;
            
            axios.post(this.base + '/clienteprods/' + this.clienteid, this.facturaN).then((res) => {
                this.misFacturas.push(res.data);
                Toastr.success("Venta registrada.");
            }).catch((err) => {
                Toastr.error("No generar la venta.");
                console.log(err);
            });
        },
        borrar(index){
            this.misFacturas.splice(index,1);
        },
        actualizar(index,producto){
            this.misFacturas[index] = producto;
        },
        addProducto(){
            this.productoN.valor = parseFloat(this.productoN.valor_unitario) * parseFloat(this.productoN.cantidad);

            this.facturaN.productos.push(this.productoN);
            this.productoN = {
                valor: 0.0,
                cantidad: 0,
                valor_unitario: 0.0,
                producto: '',
                proveedor: 0,
                beneficiarios: []
            };
            this.calcularTotal();
        },
        getProveedores(){
            axios.get(this.base + '/proveedores').then((res) => {
                this.proveedores = res.data;
            }).catch((err) => {
                console.log(err);
            });
        },
        calcularTotal(){
            this.facturaN.total = 0.0;
            for (let i = 0; i < this.facturaN.productos.length; i++) {
                this.facturaN.total = parseFloat(this.facturaN.total) + parseFloat(this.facturaN.productos[i].valor);
            }
            this.facturaN.total = parseFloat(this.facturaN.total) - parseFloat(this.facturaN.descuento)
            
            this.facturaN.iva = parseFloat(this.facturaN.total) * 12 /100;
            this.facturaN.total = parseFloat(this.facturaN.total) + parseFloat(this.facturaN.iva);
        },
        eliminar(index){
            this.facturaN.productos.splice(index,1);
        },
    },
}
</script>