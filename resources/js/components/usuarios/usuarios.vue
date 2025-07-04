<template>
    <div class="card">
        <div class="card-header">
            <strong class="m-1">
                Usuarios
            </strong>
            <b-btn variant="success" v-b-tooltip.hover title="Nuevo Usuario" v-on:click="showModal1">
                <font-awesome-icon icon="plus"></font-awesome-icon>
            </b-btn>

            <b-modal ref="myModal1" hide-footer title="Nuevo Usuario">
                <form class="row" v-on:submit.prevent="nuevo">
                    <div class="form-group col-sm-6">
                        Primer Nombre
                        <input v-model="userN.name1" type="text" class="form-control" placeholder="Primer nombre">
                    </div>
                    <div class="form-group col-sm-6">
                        Segundo Nombre
                        <input v-model="userN.name2" type="text" class="form-control" placeholder="Segundo nombre">
                    </div>
                    
                    <div class="form-group col-sm-6">
                        Primer Apellido
                        <input v-model="userN.name3" type="text" class="form-control" placeholder="Primer Apellido">
                    </div>
                    <div class="form-group col-sm-6">
                        Segundo Apellido
                        <input v-model="userN.name4" type="text" class="form-control" placeholder="Segundo Apellido">
                    </div>
                                        
                    <div class="form-group col-sm-6">
                        Email
                        <input v-model="userN.email" type="email" class="form-control" placeholder="Email">
                    </div>
                    <div class="form-group col-sm-6">
                        Clave
                        <input v-model="userN.password" type="password" class="form-control" placeholder="Clave">
                    </div>

                    <div class="form-group col-12">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <b-btn v-on:click="hideModal1">Cancelar</b-btn>
                    </div>
                </form>
            </b-modal>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 mt-1 mb-1" v-for="(usuario, index) in usuarios" :key="index">
                    <usuario-component :base="base" :usuario="usuario" @delete="borrar(index)"></usuario-component>
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
            userN: {
                name: '',
                name1: '',
                name2: '',
                name3: '',
                name4: '',
                email: '',
                password: '',
            },
            usuarios: []
        }
    },
    mounted() {
        this.getUsuarios();
    },
    methods: {
        showModal1(){
            this.$refs.myModal1.show();
        },
        hideModal1(){
            this.$refs.myModal1.hide();
        },
        getUsuarios(){
            axios.get(this.base + '/usuarios').then((res) => {
                this.usuarios = res.data;
            }).catch((err) => {
                console.log(err);
            });
        },
        nuevo(){

            this.userN.name = this.userN.name1 + ' ' + this.userN.name2 + ' ' + this.userN.name3 + ' ' + this.userN.name4;
            axios.post(this.base + '/usuarios', this.userN).then((res) => {
                this.usuarios.push(res.data);
                this.hideModal1();
                this.userN = {
                    name: '',
                    name1: '',
                    name2: '',
                    name3: '',
                    name4: '',
                    email: '',
                    password: '',
                };
                Toastr.success("Usuario creado.");
            }).catch((err) => {
                Toastr.error("Error al intentar crear al usuario.");
                console.log(err);
            });
        },
        borrar(index){
            this.usuarios.splice(index,1);
        }
    },
}
</script>