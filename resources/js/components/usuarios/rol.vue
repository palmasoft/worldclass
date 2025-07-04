<template>
    <div class="card">
        <div class="card-header">
            <strong class="m-1">
                {{ rol.name }}
            </strong>
            <b-btn class="m-1" v-b-tooltip.hover title="Borrar" variant="danger" v-on:click="borrar">
                <font-awesome-icon icon="trash"></font-awesome-icon>
            </b-btn>

            <b-btn class="m-1" v-b-tooltip.hover title="Editar" variant="primary" v-on:click="showModal1">
                <font-awesome-icon icon="pen"></font-awesome-icon>
            </b-btn>
            
            <b-btn class="m-1" v-b-tooltip.hover title="Permisos" variant="warning" v-on:click="showModal2">
                <font-awesome-icon icon="book"></font-awesome-icon>
            </b-btn>

            <b-modal ref="myModal1" hide-footer :title="'Editar Rol - ' + rol.name">
                <form class="row" v-on:submit.prevent="actualizar">
                    <div class="form-group col-12">
                        Nombre
                        <input v-model="rol.name" type="text" class="form-control" placeholder="Nombre...">
                    </div>
                    <div class="form-group col-12">
                        Descripcion
                        <textarea v-model="rol.description" rows="5" class="form-control" placeholder="Descripcion..."></textarea>
                    </div>
                    <div class="form-group col-12">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <b-btn v-on:click="hideModal1">Cancelar</b-btn>    
                    </div>
                </form>
            </b-modal>
            <b-modal ref="myModal2" hide-footer :title="'Permisos del Rol - ' + rol.name">
                <form class="row" v-on:submit.prevent="upPermisos">
                    <div class="form-group col-12">
                        <b-form-checkbox-group v-model="permisos" :options="options">
                        </b-form-checkbox-group>
                    </div>
                    <div class="form-group col-12">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <b-btn v-on:click="hideModal2">Cancelar</b-btn>
                    </div>
                </form>
            </b-modal>
        </div>
        <div class="card-body">
            {{ rol.description }}
        </div>
    </div>
</template>
<script>
export default {
    props: ['base','rol'],
    data() {
        return {
            permisos: [],
            options: []
        }
    },
    mounted() {
        this.getOptions();
    },
    methods: {
        upPermisos(){
            let data = {
                permisos: this.permisos
            };
            axios.post(this.base + '/permisosrole/' + this.rol.id,data).then((res) => {
                Toastr.success("Permisos actualizados.");
            }).catch((err) => {
                Toastr.error("Error en los permisos.");
                console.log(err);
            });
        },
        getOptions(){
            axios.get(this.base + '/permisos').then((res) => {
                for (let i = 0; i < res.data.length; i++) {
                    this.options.push({
                        text: res.data[i].name,
                        value: res.data[i].id,
                    });
                }
            }).catch((err) => {
                console.log(err);
            });
        },
        getPermisos(){
            axios.get(this.base + '/permisosrole/' + this.rol.id).then((res) => {
                this.permisos = res.data;
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
        showModal2(){
            this.$refs.myModal2.show();
            this.getPermisos();
        },
        hideModal2(){
            this.$refs.myModal2.hide();
        },
        borrar(){
            axios.delete(this.base + '/roles/' + this.rol.id).then((res) => {
                this.$emit('delete');
                Toastr.success("Rol Eliminado.");
            }).catch((err) => {
                Toastr.error("Error al intentar eliminar.");
                console.log(err);
            });
        },
        actualizar(){
            axios.put(this.base + '/roles/' + this.rol.id,this.rol).then((res) => {
                this.hideModal1();
                Toastr.success("Rol Actualizado.");
            }).catch((err) => {
                Toastr.error("Error al intentar Actualizar.");
                console.log(err);
            });
        }
    },
}
</script>