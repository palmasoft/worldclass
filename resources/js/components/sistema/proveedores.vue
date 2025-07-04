<template>
    <div class="card">
        <div class="card-header">
            <strong class="mr-3">Proveedores</strong>
            <b-btn v-on:click="showModal" v-if="permiso_store">
                <font-awesome-icon icon="plus"></font-awesome-icon>
            </b-btn>
            <b-modal ref="mymodal1" hide-footer title="Nuevo Proveedor">
                <form class="row" v-on:submit.prevent="nuevo">
                    <div class="form-group col-sm-6">
                        Nombre
                        <input type="text" class="form-control" v-model="proveedorN.nombre" placeholder="Nombre del Proveedor" required>
                    </div>
                    <div class="form-group col-sm-6">
                        Correo
                        <input type="email" step="0.01" class="form-control" v-model="proveedorN.correo" placeholder="Email" required>
                    </div>
                    <div class="form-group col-sm-6">
                        Porcentaje
                        <input type="number" step="0.01" class="form-control" v-model="proveedorN.porcentaje" required>
                    </div>
                    <div class="form-group col-sm-6">
                        Banco
                        <input type="text" class="form-control" v-model="proveedorN.banco" placeholder="Banco" required>
                    </div>
                    <div class="form-group col-sm-6">
                        Nro. Cuenta
                        <input type="text" class="form-control" v-model="proveedorN.cuenta_numero" placeholder="Numero de cuenta bancaria" required>
                    </div>
                    <div class="form-group col-sm-6">
                        Proveedor
                        <select class="form-control" v-model="proveedorN.cuenta_tipo">
                            <option>CORRIENTE</option>
                            <option>AHORROS</option>
                        </select>
                    </div>
                    

                    
                    <div class="form-group col-sm-6">
                        Banco 2
                        <input type="text" class="form-control" v-model="proveedorN.banco2" placeholder="Banco">
                    </div>
                    <div class="form-group col-sm-6">
                        Nro. Cuenta 2
                        <input type="text" class="form-control" v-model="proveedorN.cuenta_numero2" placeholder="Numero de cuenta bancaria">
                    </div>
                    <div class="form-group col-sm-6">
                        Tipo de Cuenta 2
                        <select class="form-control" v-model="proveedorN.cuenta_tipo2">
                            <option>CORRIENTE</option>
                            <option>AHORROS</option>
                        </select>
                    </div>
                    
                    <div class="form-group col-sm-6">
                        Banco 3
                        <input type="text" class="form-control" v-model="proveedorN.banco3" placeholder="Banco">
                    </div>
                    <div class="form-group col-sm-6">
                        Nro. Cuenta 3
                        <input type="text" class="form-control" v-model="proveedorN.cuenta_numero3" placeholder="Numero de cuenta bancaria">
                    </div>
                    <div class="form-group col-sm-6">
                        Tipo de Cuenta 3
                        <select class="form-control" v-model="proveedorN.cuenta_tipo3">
                            <option>CORRIENTE</option>
                            <option>AHORROS</option>
                        </select>
                    </div>
                    
                    <div class="form-group col-sm-6">
                        Banco 4
                        <input type="text" class="form-control" v-model="proveedorN.banco4" placeholder="Banco">
                    </div>
                    <div class="form-group col-sm-6">
                        Nro. Cuenta 4
                        <input type="text" class="form-control" v-model="proveedorN.cuenta_numero4" placeholder="Numero de cuenta bancaria">
                    </div>
                    <div class="form-group col-sm-6">
                        Tipo de Cuenta 4
                        <select class="form-control" v-model="proveedorN.cuenta_tipo4">
                            <option>CORRIENTE</option>
                            <option>AHORROS</option>
                        </select>
                    </div>

                    <div class="form-group col-12">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <b-btn variant="secondary" v-on:click="hideModal">Cancelar</b-btn>
                    </div>
                </form>
            </b-modal>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Proveedor</th>
                            <th>Correo</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <proveedor-component v-for="(proveedor, index) in proveedores" :key="index" :proveedor="proveedor"
                            :base="base" @delete="borrar(index)" @update="actualizar(index)"
                            :permiso_update="permiso_update" :permiso_destroy="permiso_destroy">                            
                        </proveedor-component>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['base'],
    data() {
        return {
            permiso_store: false,
            permiso_update: false,
            permiso_destroy: false,

            proveedores: [],
            proveedorN: {
                nombre: '',
                correo: '',
                banco: '',
                cuenta_numero: '',
                cuenta_tipo: 'AHORROS',
                porcentaje: 0.00
            }
        }
    },
    mounted() {
        this.getProveedores();
        this.getMisPermisos();
    },
    methods: {
        getMisPermisos(){
            axios.get(this.base + '/permisoExiste/producto.store').then((res) => {
                this.permiso_store = res.data.existe;
            }).catch((err) => {
                console.log(err);
            });
            axios.get(this.base + '/permisoExiste/producto.update').then((res) => {
                this.permiso_update = res.data.existe;
            }).catch((err) => {
                console.log(err);
            });
            axios.get(this.base + '/permisoExiste/producto.destroy').then((res) => {
                this.permiso_destroy = res.data.existe;
            }).catch((err) => {
                console.log(err);
            });
        },
        showModal(){
            this.$refs.mymodal1.show();
        },
        hideModal(){
            this.$refs.mymodal1.hide();
        },
        getProveedores(){
            axios.get(this.base + '/proveedores').then((res) => {
                this.proveedores = res.data;
            }).catch((err) => {
                console.log(err);
            });
        },
        nuevo(){
            axios.post(this.base + '/proveedores',this.proveedorN).then((res) => {
                this.proveedores.push(res.data);
                this.proveedorN = {
                    nombre: '',
                    correo: '',
                    banco: '',
                    cuenta_numero: '',
                    cuenta_tipo: '',
                    porcentaje: 0.00
                };
                this.hideModal();
                Toastr.success("Proveedor Creado");
            }).catch((err) => {
                Toastr.error("Error al intentar Crear Un Proveedor.");
                console.log(err);
            });
        },
        borrar(index){
            this.proveedores.splice(index,1);
        },
        actualizar(index,proveedor){
            this.proveedores[index] = proveedor;
        }
    },
}
</script>