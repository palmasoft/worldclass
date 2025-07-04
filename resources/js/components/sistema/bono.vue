<template>
    <tr>
        <td>
            {{bono.bono}}

            <b-btn variant="info" v-if="bono.tipo == 1">
                Tarjeta
            </b-btn>
        </td>
        <td>
            <b-btn variant="danger" v-on:click="borrar" v-if="permiso_destroy">
                <font-awesome-icon icon="trash"></font-awesome-icon>
            </b-btn>
            <b-btn variant="primary" v-on:click="showModal" v-if="permiso_update">
                <font-awesome-icon icon="pen"></font-awesome-icon>
            </b-btn>
            <b-modal ref="mymodal1" hide-footer :title="'Editar Sede - ' + bono.bono">
                <form class="row" v-on:submit.prevent="actualizar">
                    <div class="form-group col-sm-4">
                        Bono
                        <input type="text" class="form-control" v-model="bono.bono" placeholder="Nombre" required>
                    </div>
                    <div class="form-group col-sm-6">
                        Dias
                        <input type="number" class="form-control" v-model="bono.dias" required>
                    </div>
                    <div class="form-group col-sm-6">
                        Noches
                        <input type="number" class="form-control" v-model="bono.noches" required>
                    </div>
                    <div class="form-group col-sm-6">
                        Personas
                        <input type="number" class="form-control" v-model="bono.personas" required>
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
        props: ['base','bono','permiso_update','permiso_destroy'],
        methods: {
            showModal(){
                this.$refs.mymodal1.show();
            },
            hideModal(){
                this.$refs.mymodal1.hide();
            },
            borrar(){
                axios.delete(this.base + '/bonos/' + this.bono.id).then((res) => {
                    this.$emit('delete');
                    Toastr.success("Bono Eliminada.");
                }).catch((err) => {
                    Toastr.error("Error al intentar eliminar.");
                    console.log(err);
                });
            },
            actualizar(){
                axios.put(this.base + '/bonos/' + this.bono.id, this.bono).then((res) => {
                    let bono = res.data;
                    
                    this.$emit('update', bono);
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
