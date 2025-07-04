<template>
    <tr>
        <td>
            {{proveedor.nombre}}
        </td>
        <td>
            {{proveedor.correo}}
        </td>
        <td>
            <b-btn variant="danger" v-on:click="borrar" v-if="permiso_destroy">
                <font-awesome-icon icon="trash"></font-awesome-icon>
            </b-btn>
            <b-btn variant="primary" v-on:click="showModal" v-if="permiso_update">
                <font-awesome-icon icon="pen"></font-awesome-icon>
            </b-btn>
            <b-modal ref="mymodal1" hide-footer :title="'Editar Sede - ' + proveedor.nombre">
                <form class="row" v-on:submit.prevent="actualizar">
                    <div class="form-group col-sm-6">
                        Nombre
                        <input type="text" class="form-control" v-model="proveedor.nombre" placeholder="Nombre del Proveedor" required>
                    </div>
                    <div class="form-group col-sm-6">
                        Correo
                        <input type="email" step="0.01" class="form-control" v-model="proveedor.correo" placeholder="Email" required>
                    </div>
                    <div class="form-group col-sm-6">
                        Porcentaje
                        <input type="number" step="0.01" class="form-control" v-model="proveedor.porcentaje" required>
                    </div>
                    <div class="form-group col-sm-6">
                        Banco
                        <input type="text" class="form-control" v-model="proveedor.banco" placeholder="Banco" required>
                    </div>
                    <div class="form-group col-sm-6">
                        Nro. Cuenta
                        <input type="text" class="form-control" v-model="proveedor.cuenta_numero" placeholder="Numero de cuenta bancaria" required>
                    </div>
                    <div class="form-group col-sm-6">
                        Tipo de Cuenta
                        <select class="form-control" v-model="proveedor.cuenta_tipo">
                            <option>CORRIENTE</option>
                            <option>AHORROS</option>
                        </select>
                    </div>

                    
                    <div class="form-group col-sm-6">
                        Banco 2
                        <input type="text" class="form-control" v-model="proveedor.banco2" placeholder="Banco">
                    </div>
                    <div class="form-group col-sm-6">
                        Nro. Cuenta 2
                        <input type="text" class="form-control" v-model="proveedor.cuenta_numero2" placeholder="Numero de cuenta bancaria">
                    </div>
                    <div class="form-group col-sm-6">
                        Tipo de Cuenta 2
                        <select class="form-control" v-model="proveedor.cuenta_tipo2">
                            <option>CORRIENTE</option>
                            <option>AHORROS</option>
                        </select>
                    </div>
                    
                    <div class="form-group col-sm-6">
                        Banco 3
                        <input type="text" class="form-control" v-model="proveedor.banco3" placeholder="Banco">
                    </div>
                    <div class="form-group col-sm-6">
                        Nro. Cuenta 3
                        <input type="text" class="form-control" v-model="proveedor.cuenta_numero3" placeholder="Numero de cuenta bancaria">
                    </div>
                    <div class="form-group col-sm-6">
                        Tipo de Cuenta 3
                        <select class="form-control" v-model="proveedor.cuenta_tipo3">
                            <option>CORRIENTE</option>
                            <option>AHORROS</option>
                        </select>
                    </div>
                    
                    <div class="form-group col-sm-6">
                        Banco 4
                        <input type="text" class="form-control" v-model="proveedor.banco4" placeholder="Banco">
                    </div>
                    <div class="form-group col-sm-6">
                        Nro. Cuenta 4
                        <input type="text" class="form-control" v-model="proveedor.cuenta_numero4" placeholder="Numero de cuenta bancaria">
                    </div>
                    <div class="form-group col-sm-6">
                        Tipo de Cuenta 4
                        <select class="form-control" v-model="proveedor.cuenta_tipo4">
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
        </td>
    </tr>
</template>

<script>
    export default {
        props: ['base','proveedor','permiso_update','permiso_destroy'],
        methods: {
            showModal(){
                this.$refs.mymodal1.show();
            },
            hideModal(){
                this.$refs.mymodal1.hide();
            },
            borrar(){
                axios.delete(this.base + '/proveedores/' + this.proveedor.id).then((res) => {
                    this.$emit('delete');
                    Toastr.success("Proveedor Eliminado.");
                }).catch((err) => {
                    Toastr.error("Error al intentar eliminar.");
                    console.log(err);
                });
            },
            actualizar(){
                axios.put(this.base + '/proveedores/' + this.proveedor.id, this.proveedor).then((res) => {
                    let proveedor = res.data;
                    
                    this.$emit('update', proveedor);
                    Toastr.success("Proveedor Actualizado.");
                }).catch((err) => {
                    Toastr.error("Error al intentar Actualizar.");
                    console.log(err);
                });
            }
        }
    }
</script>
