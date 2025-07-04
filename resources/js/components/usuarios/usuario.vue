<template>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <td>
                                    <strong>
                                        {{usuario.name }} / {{ rol_name }}
                                    </strong>
                                </td>
                                <td>
                                    <b-btn variant="danger" v-b-tooltip.hover title="Borrar" v-on:click="borrar">
                                        <font-awesome-icon icon="trash"></font-awesome-icon>
                                    </b-btn>
                                    <b-btn variant="primary" v-b-tooltip.hover title="Editar" v-on:click="showModal">
                                        <font-awesome-icon icon="pen"></font-awesome-icon>
                                    </b-btn>
                                    <b-btn v-if="!esEmpleado" variant="warning" v-b-tooltip.hover title="Crear Empleado" v-on:click="crearEmpleado">
                                        <font-awesome-icon icon="user"></font-awesome-icon>
                                    </b-btn>


                                    <b-modal ref="myModal" hide-footer :title="'Editar usuario - ' + usuario.name">
                                        <form class="row" v-on:submit.prevent="actualizar">
                                            <div class="form-group col-12">
                                                Nombre
                                                <input v-model="usuario.name" type="text" class="form-control" placeholder="Nombre" disabled>
                                            </div>
                                                                
                                            <div class="form-group col-sm-6">
                                                Email
                                                <input v-model="usuario.email" type="email" class="form-control" placeholder="Email" disabled>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                Clave(Si no quiere cambiar la clave BORRE ESTE CAMPO)
                                                <input v-model="usuario.password" type="password" class="form-control" placeholder="Clave">
                                            </div>

                                            <div class="form-group col-12">
                                                Rol
                                                <select v-model="rol" class="form-control">
                                                    <option value="0">-Ninguno-</option>
                                                    <option v-for="(role, index) in roles" :key="index" :value="role.id">
                                                        {{ role.name }}
                                                    </option>
                                                </select>
                                            </div>

                                            <div class="form-group col-12">
                                                <button type="submit" class="btn btn-primary">Guardar</button>
                                                <b-btn v-on:click="hideModal">Cancelar</b-btn>
                                            </div>
                                        </form>
                                    </b-modal>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['base','usuario'],
    data() {
        return {
            esEmpleado: false,
            roles: [],
            rol: 0,
            rol_name: ''
        }
    },
    mounted() {
        this.getRoles();
        this.getEmployed();
    },
    methods: {
        actualizar(){
            axios.put(this.base + '/usuarios/' + this.usuario.id, this.usuario).then((res) => {
                Toastr.success("Usuario actualizado.");
            }).catch((err) => {
                Toastr.error("Error al intentar actualizar al usuario.");
                console.log(err);
            });

            if (this.rol > 0) {
                let data = {
                    rol: this.rol
                }
                axios.post(this.base + '/userroles/' + this.usuario.id,data).then((res) => {
                    Toastr.success("Rol asignado exitosamente.");
                    this.getRol();
                }).catch((err) => {
                    Toastr.error("Error en la asignacion de rol.")
                    console.log(err);
                });
            }
        },
        showModal(){
            this.$refs.myModal.show();
        },
        hideModal(){
            this.$refs.myModal.hide();
        },
        getRoles(){
            axios.get(this.base + '/roles').then((res) => {
                this.roles = res.data;
                this.getRol();
            }).catch((err) => {
                console.log(err);
            });
        },
        getRol(){
            axios.get(this.base + '/userroles/' + this.usuario.id).then((res) => {
                if (res.data) {
                    this.rol = res.data;
                    for (let i = 0; i < this.roles.length; i++) {
                        if (this.rol == this.roles[i].id) {
                            this.rol_name = this.roles[i].name;
                            break;
                        }
                    }                    
                }else{
                    this.rol = 0;
                    this.rol_name = 'NINGUNO'
                }
            }).catch((err) => {
                console.log(err);
            });
        },
        borrar(){
            axios.delete(this.base + '/usuarios/' + this.usuario.id).then((res) => {
                this.$emit('delete');
                Toastr.success("Usuario Elimiando");
            }).catch((err) => {
                Toastr.error("Error al intentar eliminar al usuario.");
                console.log(err);
            });            
        },
        crearEmpleado(){
            let nombrex = this.usuario.name.split(" ");
            let empleadoN = {
                nombre: nombrex[0] + ' ' + nombrex[1],
                apellido: nombrex[2] + ' ' + nombrex[3],
                user_id: this.usuario.id
            };
            axios.post(this.base + '/empleados',empleadoN).then((res) => {
                Toastr.success("Empleado registrado.");
                this.esEmpleado = true;
            }).catch((err) => {
                Toastr.error("Error al intentar registrar.");
                console.log(err);
            });
        },
        getEmployed(){
            axios.get(this.base + '/empleadousuario/' +this.usuario.id).then((res) => {
                if (res.data.length > 0) {
                    this.esEmpleado = true;
                }
            }).catch((err) => {
                console.log(err);
            });
        }
    },
}
</script>