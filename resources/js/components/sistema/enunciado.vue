<template>
    <tr>
        <td>
            {{enunciado.enunciado}}

            <b-btn variant="info" v-if="enunciado.activo == 1">
                Activo
            </b-btn>
            <b-btn variant="danger" v-else>
                Inactivo
            </b-btn>
        </td>
        <td>
            <b-btn variant="danger" v-on:click="borrar">
                <font-awesome-icon icon="trash"></font-awesome-icon>
            </b-btn>
            <b-btn variant="primary" v-on:click="showModal">
                <font-awesome-icon icon="pen"></font-awesome-icon>
            </b-btn>
            <b-modal ref="mymodal1" hide-footer title="Editar Enunciado">
                <form class="row" v-on:submit.prevent="actualizar">
                    <div class="form-group col-sm-6">
                        Enunciado
                        <input type="text" class="form-control" v-model="enunciado.enunciado" placeholder="enunciado" required>
                    </div>
                    <div class="form-group col-sm-6">
                        Activo
                        <select class="form-control" v-model="enunciado.activo">
                            <option value="0">Inactivo</option>
                            <option value="1">Activo</option>
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
        props: ['base','enunciado'],
        methods: {
            showModal(){
                this.$refs.mymodal1.show();
            },
            hideModal(){
                this.$refs.mymodal1.hide();
            },
            borrar(){
                axios.delete(this.base + '/enunciados/' + this.enunciado.id).then((res) => {
                    this.$emit('delete');
                    Toastr.success("Enunciado Eliminada.");
                }).catch((err) => {
                    Toastr.error("Error al intentar eliminar.");
                    console.log(err);
                });
            },
            actualizar(){
                axios.put(this.base + '/enunciados/' + this.enunciado.id, this.enunciado).then((res) => {
                    let enunciado = res.data;
                    
                    this.$emit('update', enunciado);
                    Toastr.success("Enunciado Actualizada.");
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
