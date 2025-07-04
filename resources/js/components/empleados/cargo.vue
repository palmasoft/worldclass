<template>
    <tr>
        <td>
            {{ cargo.nombre }}
        </td>
        <td>
            <b-btn v-if="cargo.id > 5 && permiso_destroy" variant="danger" v-b-tooltip:hover title="Borrar" v-on:click="borrar">
                <font-awesome-icon icon="trash"></font-awesome-icon>
            </b-btn>
            <b-btn v-if="permiso_update" variant="primary" v-b-tooltip:hover title="Editar" v-on:click="showModal1">
                <font-awesome-icon icon="pen"></font-awesome-icon>
            </b-btn>
            <b-modal ref="myModal1" hide-footer :title="'Editar cargo - ' + cargo.nombre">
                <form class="row" v-on:submit.prevent="editar">
                    <div class="form-group col-12">
                        Nombre
                        <input class="form-control" type="text" v-model="cargo.nombre" placeholder="Nombre...">
                    </div>
                    <div class="form-group col-6">
                        Proce
                        <input class="form-control" type="number" step="0.01" v-model="cargo.comicion_proce">
                    </div>
                    <div class="form-group col-6">
                        Cash
                        <input class="form-control" type="number" step="0.01" v-model="cargo.comicion_cash">
                    </div>
                    <div class="form-group col-6">
                        Pack
                        <input class="form-control" type="number" step="0.01" v-model="cargo.pack">
                    </div>
                    <div class="form-group col-6">
                        Xpack
                        <input class="form-control" type="number" step="0.01" v-model="cargo.xpack">
                    </div>

                    <div class="form-group col-12">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <button class="btn btn-secondary" v-on:click="hideModal1">cancelar</button>
                    </div>
                </form>
            </b-modal>
        </td>
    </tr>
</template>
<script>
export default {
    props: ['base','cargo','permiso_update','permiso_destroy'],
    methods: {
        showModal1(){
            this.$refs.myModal1.show();
        },
        hideModal1(){
            this.$refs.myModal1.hide();
        },
        borrar(){
            axios.delete(this.base + '/cargos/' + this.cargo.id).then((res) => {
                this.$emit('delete');
                Toastr.success("Cargo Borrado.");
            }).catch((err) => {
                Toastr.error("Error al eliminar cargo.");
                console.log(err);
            });
        },
        editar(){
            axios.put(this.base + '/cargos/' + this.cargo.id,this.cargo).then((res) => {
                this.hideModal1();   
                Toastr.success("Cargo Modificado.");
            }).catch((err) => {
                Toastr.error("Error al Modificar Cargo.");
                console.log(err);
            });
        }
    },
}
</script>