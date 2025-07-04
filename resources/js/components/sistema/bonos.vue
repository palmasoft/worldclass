<template>
    <div class="card">
        <div class="card-header">
            <strong class="mr-3">Bonos</strong>
            <b-btn v-on:click="showModal" v-if="permiso_store">
                <font-awesome-icon icon="plus"></font-awesome-icon>
            </b-btn>
            <b-modal ref="mymodal1" hide-footer title="Nuevo Bono">
                <form class="row" v-on:submit.prevent="nuevo">
                    <div class="form-group col-sm-6">
                        Bono
                        <input type="text" class="form-control" v-model="bonoN.bono" placeholder="Bono" required>
                    </div>
                    <div class="form-group col-sm-6">
                        Dias
                        <input type="number" class="form-control" v-model="bonoN.dias" required>
                    </div>
                    <div class="form-group col-sm-6">
                        Noches
                        <input type="number" class="form-control" v-model="bonoN.noches" required>
                    </div>
                    <div class="form-group col-sm-6">
                        Personas
                        <input type="number" class="form-control" v-model="bonoN.personas" required>
                    </div>
                    <div class="form-group col-sm-6">
                        Tipo
                        <select class="form-control" v-model="bonoN.tipo">
                            <option value="0">Bono</option>
                            <option value="1">Tarjeta</option>
                        </select>
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
                            <th>Bono</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <bono-component v-for="(bono, index) in bonos" :key="index" :bono="bono"
                            :base="base" @delete="borrar(index)" @update="actualizar(index)"
                            :permiso_update="permiso_update" :permiso_destroy="permiso_destroy">                            
                        </bono-component>
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

            bonos: [],
            bonoN: {
                bono: '',
                dias: 0,
                noches: 0,
                personas: 0,
                tipo: 0
            }
        }
    },
    mounted() {
        this.getBonos();
        this.getMisPermisos();
    },
    methods: {
        getMisPermisos(){
            axios.get(this.base + '/permisoExiste/bono.store').then((res) => {
                this.permiso_store = res.data.existe;
            }).catch((err) => {
                console.log(err);
            });
            axios.get(this.base + '/permisoExiste/bono.update').then((res) => {
                this.permiso_update = res.data.existe;
            }).catch((err) => {
                console.log(err);
            });
            axios.get(this.base + '/permisoExiste/bono.destroy').then((res) => {
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
        getBonos(){
            axios.get(this.base + '/bonos').then((res) => {
                this.bonos = res.data;
            }).catch((err) => {
                console.log(err);
            });
        },
        nuevo(){
            axios.post(this.base + '/bonos',this.bonoN).then((res) => {
                this.bonos.push(res.data);
                this.bonoN = {
                    bono: '',
                    dias: 0,
                    noches: 0,
                    personas: 0,
                };
                this.hideModal();
                Toastr.success("Bono Creado");
            }).catch((err) => {
                Toastr.error("Error al intentar Crear Un Bono.");
                console.log(err);
            });
        },
        borrar(index){
            this.bonos.splice(index,1);
        },
        actualizar(index,bono){
            this.bonos[index] = bono;
        }
    },
}
</script>