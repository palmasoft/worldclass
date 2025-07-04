<template>
    <div class="card">
        <div class="card-header">
            <strong class="mr-3">Sedes</strong>
            <b-btn v-on:click="showModal" v-if="permiso_store">
                <font-awesome-icon icon="plus"></font-awesome-icon>
            </b-btn>
            <b-modal ref="mymodal1" hide-footer title="Nueva Sede">
                <form class="row" v-on:submit.prevent="nuevo">
                    <div class="form-group col-sm-4">
                        Sede(Siglas)
                        <input type="text" class="form-control" v-model="sedeN.sede" placeholder="Sede" required>
                    </div>
                    <div class="form-group col-sm-4">
                        Nombre
                        <input type="text" class="form-control" v-model="sedeN.nombre" placeholder="Nombre" required>
                    </div>
                    <div class="form-group col-sm-4">
                        Ciudad
                        <input type="text" class="form-control" v-model="sedeN.ciudad" placeholder="Ciudad">
                    </div>
                    <div class="form-group col-sm-4">
                        Consecutivo
                        <input type="text" class="form-control" v-model="sedeN.consecutivo" placeholder="Consecutivo" required>
                    </div>
                    <div class="form-group col-sm-8">
                        Direccion
                        <input type="text" class="form-control" v-model="sedeN.direccion" placeholder="Direccion">
                    </div>
                    <div class="form-group col-sm-4">
                        Meta 1
                        <input type="number" step="0.01" class="form-control" v-model="sedeN.metaq1" placeholder="Meta 1">
                    </div>
                    <div class="form-group col-sm-4">
                        Meta 2
                        <input type="number" step="0.01" class="form-control" v-model="sedeN.metaq2" placeholder="Meta 2">
                    </div>
                    <div class="form-group col-sm-4">
                        Meta 3
                        <input type="number" step="0.01" class="form-control" v-model="sedeN.metaq3" placeholder="Meta 3">
                    </div>
                    <div class="form-group col-12">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <b-btn variant="secondary" v-on:click="hideModal">Cancelar</b-btn>
                    </div>
                </form>
            </b-modal>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Sede</th>
                            <th>Consecutivo</th>
                            <th>Nombre</th>
                            <th>Ciudad</th>
                            <th>Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <sede-component v-for="(sede, index) in sedes" :key="index" :sede="sede"
                            :base="base" @delete="borrar(index)" @update="actualizar(index)"
                            :permiso_update="permiso_update" :permiso_destroy="permiso_destroy">                            
                        </sede-component>
                    </tbody>
                </table>
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

            sedes: [],
            sedeN: {
                sede: '',
                nombre: '',
                direccion: '',
                ciudad: '',
                consecutivo: '',
                metaq1: 0.00,
                metaq2: 0.00,
                metaq3: 0.00
            }
        }
    },
    mounted() {
        this.getSedes();
        this.getMisPermisos();
    },
    methods: {
        getMisPermisos(){
            axios.get(this.base + '/permisoExiste/sede.store').then((res) => {
                this.permiso_store = res.data.existe;
            }).catch((err) => {
                console.log(err);
            });
            axios.get(this.base + '/permisoExiste/sede.update').then((res) => {
                this.permiso_update = res.data.existe;
            }).catch((err) => {
                console.log(err);
            });
            axios.get(this.base + '/permisoExiste/sede.destroy').then((res) => {
                this.permiso_destroy = res.data.existe;
            }).catch((err) => {
                console.log(err);
            });
        },
        showModal(){
            this.$refs.mymodal1.show();
        },
        hideModal(){
            this.$refs.mymodal1.hide();
        },
        getSedes(){
            axios.get(this.base + '/sedes').then((res) => {
                this.sedes = res.data;
            }).catch((err) => {
                console.log(err);
            });
        },
        nuevo(){
            axios.post(this.base + '/sedes',this.sedeN).then((res) => {
                this.sedes.push(res.data);
                this.sedeN = {
                    sede: '',
                    nombre: '',
                    direccion: '',
                    ciudad: '',
                    consecutivo: '',
                    metaq1: 0.00,
                    metaq2: 0.00,
                    metaq3: 0.00
                };
                this.hideModal();
                Toastr.success("Sede Creada");
            }).catch((err) => {
                Toastr.error("Error al intentar Crear la sede.");
                console.log(err);
            });
        },
        borrar(index){
            this.sedes.splice(index,1);
        },
        actualizar(index,sede){
            this.sedes[index] = sede;
        }
    },
}
</script>