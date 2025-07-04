<template>
    <tr>
        <td>
            {{servicio.servicio}}
        </td>
        <td>
            <strong v-if="servicio.tipo == 1">Nacional</strong>
            <strong v-else-if="servicio.tipo == 2">Internacional</strong>
            <strong v-else>Desconocido</strong>
        </td>
        <td>
            {{servicio.porcentaje}}
        </td>
        <td>
            <b-btn variant="danger" v-on:click="borrar" v-if="permiso_destroy">
                <font-awesome-icon icon="trash"></font-awesome-icon>
            </b-btn>
            <b-btn variant="primary" v-on:click="showModal" v-if="permiso_update">
                <font-awesome-icon icon="pen"></font-awesome-icon>
            </b-btn>
            <b-modal ref="mymodal1" hide-footer :title="'Editar Sede - ' + servicio.servicio">
                <form class="row" v-on:submit.prevent="actualizar">
                    <div class="form-group col-sm-4">
                        Servicio
                        <input type="text" class="form-control" v-model="servicio.servicio" placeholder="Nombre" required>
                    </div>
                    <div class="form-group col-sm-4">
                        Tipo
                        <input type="text" class="form-control" v-model="servicio.tipo" placeholder="Nombre" required>
                    </div>
                    <div class="form-group col-sm-4">
                        porcentaje
                        <input type="text" class="form-control" v-model="servicio.porcentaje" placeholder="Nombre" required>
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
        props: ['base','servicio','permiso_update','permiso_destroy'],
        methods: {
            showModal(){
                this.$refs.mymodal1.show();
            },
            hideModal(){
                this.$refs.mymodal1.hide();
            },
            borrar(){
                axios.delete(this.base + '/servicios/' + this.servicio.id).then((res) => {
                    this.$emit('delete');
                    Toastr.success("Bono Eliminada.");
                }).catch((err) => {
                    Toastr.error("Error al intentar eliminar.");
                    console.log(err);
                });
            },
            actualizar(){
                axios.put(this.base + '/servicios/' + this.servicio.id, this.servicio).then((res) => {
                    let servicio = res.data;
                    
                    this.$emit('update', servicio);
                    Toastr.success("Bono Actualizada.");
                }).catch((err) => {
                    Toastr.error("Error al intentar Actualizar.");
                    console.log(err);
                });
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
