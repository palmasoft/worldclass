<template>
    <div class="card">
        <div class="card-header">
            <strong class="mr-3">Productos</strong>
            <b-btn v-on:click="showModal" v-if="permiso_store">
                <font-awesome-icon icon="plus"></font-awesome-icon>
            </b-btn>
            <b-modal ref="mymodal1" hide-footer title="Nuevo Producto">
                <form class="row" v-on:submit.prevent="nuevo">
                    <div class="form-group col-sm-6">
                        Nombre
                        <input type="text" class="form-control" v-model="productoN.nombre" placeholder="Nombre del Producto" required>
                    </div>
                    <div class="form-group col-sm-6">
                        Valor
                        <input type="number" step="0.01" class="form-control" v-model="productoN.valor" required>
                    </div>
                    <div class="form-group col-sm-6">
                        Porcentaje
                        <input type="number" step="0.01" class="form-control" v-model="productoN.porcentaje" required>
                    </div>
                    <div class="form-group col-sm-6">
                        Proveedor
                        <select class="form-control" v-model="productoN.proveedor_id">
                            <option value="0">NINGUNO</option>
                            <option v-for="(proveedor, index) in proveedores" :key="index" :value="proveedor.id">
                                {{ proveedor.nombre }}
                            </option>
                        </select>
                    </div>

                    <div class="form-group col-12">
                        Descripcion
                        <textarea class="form-control" rows="4" v-model="productoN.descripcion"></textarea>
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
                            <th>Producto</th>
                            <th>Descripcion</th>
                            <th>Valor</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <producto-component v-for="(producto, index) in productos" :key="index" :producto="producto"
                            :base="base" @delete="borrar(index)" @update="actualizar(index)" :proveedores="proveedores"
                            :permiso_update="permiso_update" :permiso_destroy="permiso_destroy">                            
                        </producto-component>
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

            productos: [],
            proveedores: [],
            productoN: {
                nombre: '',
                descripcion: '',
                valor: 0.00,
                porcentaje: 0.00,
                proveedor_id: 0
            }
        }
    },
    mounted() {
        this.getProveedores();
        this.getProductos();
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
        getProductos(){
            axios.get(this.base + '/productos').then((res) => {
                this.productos = res.data;
            }).catch((err) => {
                console.log(err);
            });
        },
        getProveedores(){
            axios.get(this.base + '/proveedores').then((res) => {
                this.proveedores = res.data;
            }).catch((err) => {
                console.log(err);
            });
        },
        nuevo(){
            axios.post(this.base + '/productos',this.productoN).then((res) => {
                this.productos.push(res.data);
                this.productoN = {
                    nombre: '',
                    descripcion: '',
                    valor: 0.00,
                    porcentaje: 0.00,
                    proveedor_id: 0
                };
                this.hideModal();
                Toastr.success("Producto Creado");
            }).catch((err) => {
                Toastr.error("Error al intentar Crear Un Producto.");
                console.log(err);
            });
        },
        borrar(index){
            this.productos.splice(index,1);
        },
        actualizar(index,producto){
            this.productos[index] = producto;
        }
    },
}
</script>