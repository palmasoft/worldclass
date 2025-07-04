<template>
    <div class="card">
        <div class="card-header">
            <strong class="m-1">
                Roles del Sistema
            </strong>
            <b-btn class="m-1" variant="success" v-b-tooltip.hover title="Nuevo Rol" v-on:click="showModal1">
                <font-awesome-icon icon="plus"></font-awesome-icon>
            </b-btn>
            <b-modal ref="myModal1" hide-footer title="Nuevo Rol">
                <form class="row" v-on:submit.prevent="nuevo">
                    <div class="form-group col-12">
                        Nombre
                        <input v-model="rolN.name" type="text" class="form-control" placeholder="Nombre...">
                    </div>
                    <div class="form-group col-12">
                        Descripcion
                        <textarea v-model="rolN.description" rows="5" class="form-control" placeholder="Descripcion..."></textarea>
                    </div>
                    <div class="form-group col-12">
                        <button type="submit" class="btn btn-primary">Crear</button>
                        <b-btn v-on:click="hideModal1">Cancelar</b-btn>    
                    </div>
                </form>
            </b-modal>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12" v-for="(rol, index) in roles" :key="index">
                    <rol-component :base="base" :rol="rol" @delete="borrar(index)"></rol-component>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['base'],
    data() {
        return {
            roles: [],
            rolN: {
                name: '',
                description: ''
            }
        }
    },
    mounted() {
        this.getRoles();
    },
    methods: {
        showModal1(){
            this.$refs.myModal1.show();
        },
        hideModal1(){
            this.$refs.myModal1.hide();
        },
        nuevo(){
            axios.post(this.base + '/roles', this.rolN).then((res) => {
                this.roles.push(res.data);
                this.rolN = {
                    name: '',
                    description: ''
                };

                Toastr.success("Rol Creado.");
                this.hideModal1();
            }).catch((err) => {
                Toastr.error("Error al intentar crear el rol.")
                console.log(err);
            });
        },
        getRoles(){
            axios.get(this.base + '/roles').then((res) => {
                this.roles = res.data;
            }).catch((err) => {
                console.log(err);
            });
        },
        borrar(index){
            this.roles.splice(index,1);
        }
    },
}
</script>