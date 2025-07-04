<template>
    <div class="card">
        <div class="card-header">
            <strong class="mr-3">Servicios</strong>
            <b-btn v-on:click="showModal" v-if="permiso_store">
                <font-awesome-icon icon="plus"></font-awesome-icon>
            </b-btn>
            <b-modal ref="mymodal1" hide-footer title="Nuevo Bono">
                <form class="row" v-on:submit.prevent="nuevo">
                    <div class="form-group col-sm-4">
                        Servicio
                        <input type="text" class="form-control" v-model="servicioN.servicio" placeholder="Servicio" required>
                    </div>
                    <div class="form-group col-sm-4">
                        Tipo
                        <b-form-select 
                        :options="{ '1': 'NACIONAL', '2': 'INTERNACIONAL'}"
                        class="form-control" 
                        v-model="servicioN.tipo"
                        required placeholder="Tipo de servicio">
                        </b-form-select>
                        
                    </div>
                    <div class="form-group col-sm-4">
                        Porcentaje
                        <input type="text" class="form-control" v-model="servicioN.porcentaje" placeholder="Porcentaje">
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
                            <th>Servicio</th>
                            <th>Tipo</th>
                            <th>Porcentaje</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <servicio-component v-for="(servicio, index) in servicios" :key="index" :servicio="servicio"
                            :base="base" @delete="borrar(index)" @update="actualizar(index)"
                            :permiso_update="permiso_update" :permiso_destroy="permiso_destroy">                            
                        </servicio-component>
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

            servicios: [],
            servicioN: {
                servicio: '',
                tipo:'',
                porcentaje:''
            },
        }
    },
    mounted() {
        this.getServicios();
        this.getMisPermisos();
    },
    methods: {
        getMisPermisos(){
            axios.get(this.base + '/permisoExiste/servicio.store').then((res) => {
                this.permiso_store = res.data.existe;
            }).catch((err) => {
                console.log(err);
            });
            axios.get(this.base + '/permisoExiste/servicio.update').then((res) => {
                this.permiso_update = res.data.existe;
            }).catch((err) => {
                console.log(err);
            });
            axios.get(this.base + '/permisoExiste/servicio.destroy').then((res) => {
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
        getServicios(){
            axios.get(this.base + '/servicios').then((res) => {
                this.servicios = res.data;
            }).catch((err) => {
                console.log(err);
            });
        },
        nuevo(){
            axios.post(this.base + '/servicios',this.servicioN).then((res) => {
                this.servicios.push(res.data);
                this.servicioN = {
                    servicio: '',
                    tipo:'',
                    porcentaje:''
                };
                this.hideModal();
                Toastr.success("Servicio Creado");
            }).catch((err) => {
                Toastr.error("Error al intentar Crear Un Servicio.");
                console.log(err);
            });
        },
        borrar(index){
            this.servicios.splice(index,1);
        },
        actualizar(index,servicio){
            this.servicios[index] = servicio;
        }
    },
}
</script>