<template>
    <div class="card">
        <div class="card-header">
            <strong class="mr-2">Empleados</strong>
            <b-btn v-b-tooltip.hover title="Nuevo Empleado" v-on:click="showModal1" v-if="permiso_store">
                <font-awesome-icon icon="plus"></font-awesome-icon>
            </b-btn>
            <b-modal ref="myModal1" hide-footer title="Nuevo Empleado">
                <form class="row" v-on:submit.prevent="nuevo">
                    <div class="form-group col-sm-6">
                        Nombre
                        <input type="text" class="form-control" v-model="empleadoN.nombre" placeholder="Nombre">
                    </div>
                    <div class="form-group col-sm-6">
                        Apellido
                        <input type="text" class="form-control" v-model="empleadoN.apellido" placeholder="Apellido">
                    </div>
                    <div class="form-group col-sm-6">
                        Cedula
                        <input type="text" class="form-control" v-model="empleadoN.cedula" placeholder="Cedula">
                    </div>
                    <div class="form-group col-sm-6">
                        Pasaporte
                        <input type="text" class="form-control" v-model="empleadoN.pasaporte" placeholder="Pasaporte">
                    </div>
                    <div class="form-group col-sm-6">
                        Usuario
                        <select class="form-control" v-model="empleadoN.user_id">
                            <option value="0">-Ninguno-</option>
                            <option v-for="(usuario, index) in usuarios" :key="index" :value="usuario.id">
                                {{ usuario.name }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group col-12">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <b-btn v-on:click="hideModal1">Cancelar</b-btn>
                    </div>
                </form>
            </b-modal>
        </div>
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="form-group col-11">
                    <input type="text" class="form-control" v-model="buscar" placeholder="Buscar...">
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-12 mt-1 mb-1" v-for="(empleado, index) in empleados" :key="index">
                    <empleado-component v-if="(empleado.nombre + ' ' + empleado.apellido + ' ' + empleado.cedula + ' ' + empleado.pasaporte + ' ' + empleado.codigo1 + ' ' + empleado.codigo2).toLowerCase().indexOf(('' + buscar).toLowerCase()) != -1" 
                                :empleado="empleado" :base="base" :usuarios="usuarios"
                                @delete="borrar(index)" @update="actualizar(index)"
                                :permiso_update="permiso_update" :permiso_destroy="permiso_destroy"
                                :permiso_cargo="permiso_cargo">
                    </empleado-component>
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
            permiso_store: false,
            permiso_update: false,
            permiso_destroy: false,
            permiso_cargo: false,

            buscar: '',
            empleados: [],
            usuarios: [],
            empleadoN: {
                nombre: '',
                apellido: '',
                cedula: '',
                pasaporte: '',
                user_id: 0
            }
        }
    },
    mounted() {
        this.getUsuarios();
        this.getEmpleados();
        this.getMisPermisos();
    },
    methods: {
        getMisPermisos(){
            axios.get(this.base + '/permisoExiste/empleado.store').then((res) => {
                this.permiso_store = res.data.existe;
            }).catch((err) => {
                console.log(err);
            });
            axios.get(this.base + '/permisoExiste/empleado.update').then((res) => {
                this.permiso_update = res.data.existe;
            }).catch((err) => {
                console.log(err);
            });
            axios.get(this.base + '/permisoExiste/empleado.destroy').then((res) => {
                this.permiso_destroy = res.data.existe;
            }).catch((err) => {
                console.log(err);
            });
            axios.get(this.base + '/permisoExiste/empleado.cargo').then((res) => {
                this.permiso_cargo = res.data.existe;
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
        getUsuarios(){
            axios.get(this.base + '/usuarios').then((res) => {
                this.usuarios = res.data;
            }).catch((err) => {
                console.log(err);
            });
        },
        getEmpleados(){
            axios.get(this.base + '/empleados').then((res) => {
                this.empleados = res.data;
            }).catch((err) => {
                console.log(err);
            });
        },
        nuevo(){
            axios.post(this.base + '/empleados',this.empleadoN).then((res) => {
                this.empleados.push(res.data);
                this.empleadoN = {
                    nombre: '',
                    apellido: '',
                    cedula: '',
                    pasaporte: '',
                    user_id: 0
                };
                this.hideModal1();
                Toastr.success("Empleado registrado.");
            }).catch((err) => {
                Toastr.error("Error al intentar registrar.");
                console.log(err);
            });
        },
        borrar(index){
            this.empleados.splice(index,1);
        },
        actualizar(index,empleado){
            this.empleados[index] = empleado;
        }
    },
}
</script>