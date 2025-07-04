<template>
    <tr>
        <td>
            {{ sede.sede }}
        </td>
        <td>
            {{ sede.consecutivo }}
        </td>
        <td>
            {{ sede.nombre }}
        </td>
        <td>
            {{ sede.ciudad }}
        </td>
        <td>
            <b-btn variant="danger" v-on:click="borrar" v-if="permiso_destroy">
                <font-awesome-icon icon="trash"></font-awesome-icon>
            </b-btn>
            <b-btn variant="primary" v-on:click="showModal" v-if="permiso_update">
                <font-awesome-icon icon="pen"></font-awesome-icon>
            </b-btn>
            <b-modal ref="mymodal1" hide-footer :title="'Editar Sede - ' + sede.sede">
                <form class="row" v-on:submit.prevent="actualizar">
                    <div class="form-group col-sm-4">
                        Sede(Siglas)
                        <input type="text" class="form-control" v-model="sede.sede" placeholder="Sede" required>
                    </div>
                    <div class="form-group col-sm-4">
                        Nombre
                        <input type="text" class="form-control" v-model="sede.nombre" placeholder="Nombre" required>
                    </div>
                    <div class="form-group col-sm-4">
                        Ciudad
                        <input type="text" class="form-control" v-model="sede.ciudad" placeholder="Ciudad">
                    </div>
                    <div class="form-group col-sm-4">
                        Consecutivo
                        <input type="text" class="form-control" v-model="sede.consecutivo" placeholder="Consecutivo" required>
                    </div>
                    <div class="form-group col-sm-8">
                        Direccion
                        <input type="text" class="form-control" v-model="sede.direccion" placeholder="Direccion">
                    </div>
                    <div class="form-group col-sm-4">
                        Meta 1
                        <input type="number" step="0.01" class="form-control" v-model="sede.metaq1" placeholder="Meta 1">
                    </div>
                    <div class="form-group col-sm-4">
                        Meta 2
                        <input type="number" step="0.01" class="form-control" v-model="sede.metaq2" placeholder="Meta 2">
                    </div>
                    <div class="form-group col-sm-4">
                        Meta 3
                        <input type="number" step="0.01" class="form-control" v-model="sede.metaq3" placeholder="Meta 3">
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
    props: ['base','sede','permiso_update','permiso_destroy'],
    methods: {
        showModal(){
            this.$refs.mymodal1.show();
        },
        hideModal(){
            this.$refs.mymodal1.hide();
        },
        borrar(){
            axios.delete(this.base + '/sedes/' + this.sede.id).then((res) => {
                this.$emit('delete');
                Toastr.success("Sede Eliminada.");
            }).catch((err) => {
                Toastr.error("Error alintentar eliminar.");
                console.log(err);
            });
        },
        actualizar(){
            axios.put(this.base + '/sedes/' + this.sede.id, this.sede).then((res) => {
                let sede = res.data;
                
                this.$emit('update',sede);
                Toastr.success("Sede Actualizada.");
            }).catch((err) => {
                Toastr.error("Error alintentar Actualizar.");
                console.log(err);
            });
        }
    },
}
</script>