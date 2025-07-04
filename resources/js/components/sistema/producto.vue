<template>
    <tr>
        <td>
            {{producto.nombre}}
        </td>
        <td>
            {{producto.descripcion}}
        </td>
        <td>
            {{producto.valor}}
        </td>
        <td>
            <b-btn variant="danger" v-on:click="borrar" v-if="permiso_destroy">
                <font-awesome-icon icon="trash"></font-awesome-icon>
            </b-btn>
            <b-btn variant="primary" v-on:click="showModal" v-if="permiso_update">
                <font-awesome-icon icon="pen"></font-awesome-icon>
            </b-btn>
            <b-modal ref="mymodal1" hide-footer :title="'Editar Sede - ' + producto.nombre">
                <form class="row" v-on:submit.prevent="actualizar">
                    <div class="form-group col-sm-6">
                        Nombre
                        <input type="text" class="form-control" v-model="producto.nombre" placeholder="Nombre del Producto" required>
                    </div>
                    <div class="form-group col-sm-6">
                        Valor
                        <input type="number" step="0.01" class="form-control" v-model="producto.valor" required>
                    </div>
                    <div class="form-group col-sm-6">
                        Porcentaje
                        <input type="number" step="0.01" class="form-control" v-model="producto.porcentaje" required>
                    </div>
                    <div class="form-group col-sm-6">
                        Proveedor
                        <select class="form-control" v-model="producto.proveedor_id">
                            <option value="0">NINGUNO</option>
                            <option v-for="(proveedor, index) in proveedores" :key="index" :value="producto.proveedor_id">
                                {{ proveedor.nombre }}
                            </option>
                        </select>
                    </div>

                    <div class="form-group col-12">
                        Descripcion
                        <textarea class="form-control" rows="4" v-model="producto.descripcion"></textarea>
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
        props: ['base','producto','permiso_update','permiso_destroy','proveedores'],
        methods: {
            showModal(){
                this.$refs.mymodal1.show();
            },
            hideModal(){
                this.$refs.mymodal1.hide();
            },
            borrar(){
                axios.delete(this.base + '/productos/' + this.producto.id).then((res) => {
                    this.$emit('delete');
                    Toastr.success("Producto Eliminado.");
                }).catch((err) => {
                    Toastr.error("Error al intentar eliminar.");
                    console.log(err);
                });
            },
            actualizar(){
                axios.put(this.base + '/productos/' + this.producto.id, this.producto).then((res) => {
                    let producto = res.data;
                    
                    this.$emit('update', producto);
                    Toastr.success("Producto Actualizada.");
                }).catch((err) => {
                    Toastr.error("Error al intentar Actualizar.");
                    console.log(err);
                });
            }
        }
    }
</script>
