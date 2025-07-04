<template>
    <div class="card">
        <div class="card-body">
            <table class="table">
                <tbody>
                    <tr>
                        <td>
                            Nombre: <strong>{{ empleado.nombre }}</strong>
                            <br>
                            Apellido: <strong>{{ empleado.apellido }}</strong>
                            <br>
                            <span v-if="empleado.cedula">
                                Cedula: <strong>{{ empleado.cedula }}</strong>
                            </span>
                            <span v-else>
                                Pasaporte: <strong>{{ empleado.pasaporte }}</strong>
                            </span>
                            <br>
                            <span v-if="parseInt(empleado.codigo1) > 0 || parseInt(empleado.codigo2) > 0" class="text-success">
                                Codigos: 
                                <strong v-if="parseInt(empleado.codigo1) > 0">
                                    TM{{ empleado.codigo1 }}
                                </strong> / <strong v-if="parseInt(empleado.codigo2) > 0">
                                    OP{{ empleado.codigo2 }}
                                </strong>
                            </span>
                        </td>
                        <td>
                            <b-btn v-if="permiso_destroy" class="m-1" v-b-tooltip.hover title="Eliminar" variant="danger" v-on:click="borrar">
                                <font-awesome-icon icon="trash"></font-awesome-icon>
                            </b-btn>
                            <b-btn v-if="permiso_update" class="m-1" v-b-tooltip.hover title="Editar" variant="primary" v-on:click="showModal1">
                                <font-awesome-icon icon="pen"></font-awesome-icon>
                            </b-btn>
                            <b-modal ref="myModal1" hide-footer :title="'Editar Empleado ' + empleado.nombre + ' ' +empleado.apellido">
                                <form class="row" v-on:submit.prevent="actualizar">
                                    <div class="form-group col-sm-6">
                                        Nombre
                                        <input type="text" class="form-control" v-model="empleado.nombre" placeholder="Nombre">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        Apellido
                                        <input type="text" class="form-control" v-model="empleado.apellido" placeholder="Apellido">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        Cedula
                                        <input type="text" class="form-control" v-model="empleado.cedula" placeholder="Cedula">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        Pasaporte
                                        <input type="text" class="form-control" v-model="empleado.pasaporte" placeholder="Pasaporte">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        Usuario
                                        <select class="form-control" v-model="empleado.user_id">
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
                            
                            <b-btn v-if="permiso_cargo" class="m-1" v-b-tooltip.hover title="Cargos" variant="warning" v-on:click="showModal2">
                                <font-awesome-icon icon="briefcase"></font-awesome-icon>
                            </b-btn>
                            <b-modal ref="myModal2" hide-footer :title="'Cargos del Empleado ' + empleado.nombre + ' ' +empleado.apellido">
                                <form class="row" v-on:submit.prevent="upCargos">
                                    <div class="form-group col-12">
                                        <b-form-checkbox-group v-model="cargos" :options="options">
                                        </b-form-checkbox-group>
                                    </div>
                                    <div class="form-group col-12">
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                        <b-btn v-on:click="hideModal2">Cancelar</b-btn>
                                    </div>
                                </form>
                            </b-modal>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script>
export default {
    props: ['base','empleado','usuarios','permiso_cargo','permiso_update','permiso_destroy'],
    data() {
        return {
            cargos: [],
            options: []
        }
    },
    methods: {
        showModal1(){
            this.$refs.myModal1.show();
        },
        hideModal1(){
            this.$refs.myModal1.hide();
        },
        showModal2(){
            this.$refs.myModal2.show();
            this.options=[];
            this.getOptions();
            this.getCargos();
        },
        hideModal2(){
            this.$refs.myModal2.hide();
        },
        getOptions(){
            axios.get(this.base + '/cargos').then((res) => {
                for (let i = 0; i < res.data.length; i++) {
                    this.options.push({
                        text: res.data[i].nombre,
                        value: res.data[i].id,
                    });
                }
            }).catch((err) => {
                console.log(err);
            });
        },
        getCargos(){
            axios.get(this.base + '/empleadocargos/' + this.empleado.id).then((res) => {
                for (let i = 0; i < res.data.length; i++) {
                    this.cargos.push(''+res.data[i].cargo_id);
                }
            }).catch((err) => {
                console.log(err);
            });
        },
        actualizar(){
            axios.put(this.base + '/empleados/' + this.empleado.id,this.empleado).then((res) => {
                let empleado = res.data;
                this.$emit('update',empleado);
                this.hideModal1();
                Toastr.success("Empleado actualizado.");
            }).catch((err) => {
                Toastr.error("Error al intentar actualizar.");
                console.log(err);
            });
        },
        borrar(){
            axios.delete(this.base + '/empleados/' + this.empleado.id).then((res) => {
                this.$emit('delete');
                Toastr.success("Empleado eliminado.");
            }).catch((err) => {
                Toastr.error("Error al intentar eliminar.");
                console.log(err);
            });
        },
        upCargos(){
            let upCargosd = {
                cargos: this.cargos
            };
            axios.post(this.base + '/empleadocargos/' + this.empleado.id,upCargosd).then((res) => {
                Toastr.success('Cargos Guardados.');
            }).catch((err) => {
                Toastr.error('Error al Guardar.');
                console.log(err);
            });
        }
    },
}
</script>