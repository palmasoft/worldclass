<template>
    <div class="card">
        <div class="card-header">
            <strong class="mr-2">Cargos</strong>
            <b-btn v-b-tooltip:hover title="Nuevo Cargo" v-on:click="showModal" v-if="permiso_store">
                <font-awesome-icon icon="plus"></font-awesome-icon>
            </b-btn>
            <b-modal ref="myModal" hide-footer title="Nuevo Cargo">
                <form class="row" v-on:submit.prevent="nuevo">
                    <div class="form-group col-12">
                        Nombre
                        <input class="form-control" type="text" v-model="cargoN.nombre" placeholder="Nombre...">
                    </div>
                    <div class="form-group col-6">
                        Proce
                        <input class="form-control" type="number" step="0.01" v-model="cargoN.comicion_proce">
                    </div>
                    <div class="form-group col-6">
                        Cash
                        <input class="form-control" type="number" step="0.01" v-model="cargoN.comicion_cash">
                    </div>
                    <div class="form-group col-6">
                        Pack
                        <input class="form-control" type="number" step="0.01" v-model="cargoN.pack">
                    </div>
                    <div class="form-group col-6">
                        Xpack
                        <input class="form-control" type="number" step="0.01" v-model="cargoN.xpack">
                    </div>

                    <div class="form-group col-12">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <button class="btn btn-secondary" v-on:click="hideModal">cancelar</button>
                    </div>
                </form>
            </b-modal>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Cargo</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <cargo-component v-for="(cargo, index) in cargos" :key="index" :base="base" 
                                        :cargo="cargo" @delete="borrar(index)"
                                        :permiso_update="permiso_update" :permiso_destroy="permiso_destroy">
                                </cargo-component>
                            </tbody>
                        </table>
                    </div>
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

            cargos: [],
            cargoN: {
                nombre: '',
                comicion_proce: 0.00,
                comicion_cash: 0.00,
                pack: 0.00,
                xpack: 0.00,
            }
        }
    },
    mounted() {
        this.getCargos();
        this.getMisPermisos();
    },
    methods: {
        getMisPermisos(){
            axios.get(this.base + '/permisoExiste/cargo.store').then((res) => {
                this.permiso_store = res.data.existe;
            }).catch((err) => {
                console.log(err);
            });
            axios.get(this.base + '/permisoExiste/cargo.update').then((res) => {
                this.permiso_update = res.data.existe;
            }).catch((err) => {
                console.log(err);
            });
            axios.get(this.base + '/permisoExiste/cargo.destroy').then((res) => {
                this.permiso_destroy = res.data.existe;
            }).catch((err) => {
                console.log(err);
            });
        },
        showModal(){
            this.$refs.myModal.show();
        },
        hideModal(){
            this.$refs.myModal.hide();
        },
        getCargos(){
            axios.get(this.base + '/cargos').then((res) => {
                this.cargos = res.data;
            }).catch((err) => {
                console.log(err);
            });
        },
        nuevo(){
            axios.post(this.base + '/cargos',this.cargoN).then((res) => {
                this.cargoN = {
                    nombre: '',
                    comicion_proce: 0.00,
                    comicion_cash: 0.00,
                    pack: 0.00,
                    xpack: 0.00,
                };
                this.cargos.push(res.data);
                this.hideModal();   
                Toastr.success("Cargo Creado.");
            }).catch((err) => {
                Toastr.error("Error al crear Cargo.");
                console.log(err);
            });
        },
        borrar(index){
            this.cargos.splice(index,1);
        }
    },
}
</script>