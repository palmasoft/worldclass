<template>
    <div class="card">
        <div class="card-header">
            <strong class="mr-3">Enunciados Contrato</strong>
            <b-btn v-on:click="showModal">
                <font-awesome-icon icon="plus"></font-awesome-icon>
            </b-btn>
            <b-modal ref="mymodal1" hide-footer title="Nuevo Enunciado">
                <form class="row" v-on:submit.prevent="nuevo">
                    <div class="form-group col-sm-6">
                        Enunciado
                        <input type="text" class="form-control" v-model="enunciadoN.enunciado" placeholder="enunciado" required>
                    </div>
                    <div class="form-group col-sm-6">
                        Activo
                        <select class="form-control" v-model="enunciadoN.activo">
                            <option value="0">Inactivo</option>
                            <option value="1">Activo</option>
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
                            <th>Enunciado</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <enunciado-component v-for="(enunciado, index) in enunciados" :key="index" :enunciado="enunciado"
                            :base="base" @delete="borrar(index)" @update="actualizar(index)">                            
                        </enunciado-component>
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
            enunciados: [],
            enunciadoN: {
                enunciado: '',
                activo: 0,
            }
        }
    },
    mounted() {
        this.getEnunciados();
    },
    methods: {
        showModal(){
            this.$refs.mymodal1.show();
        },
        hideModal(){
            this.$refs.mymodal1.hide();
        },
        getEnunciados(){
            axios.get(this.base + '/enunciados').then((res) => {
                this.enunciados = res.data;
            }).catch((err) => {
                console.log(err);
            });
        },
        nuevo(){
            axios.post(this.base + '/enunciados',this.enunciadoN).then((res) => {
                this.enunciados.push(res.data);
                this.enunciadoN = {
                    enunciado: '',
                    activo: 0,
                };
                this.hideModal();
                Toastr.success("Enunciado Creado");
            }).catch((err) => {
                Toastr.error("Error.");
                console.log(err);
            });
        },
        borrar(index){
            this.enunciados.splice(index,1);
        },
        actualizar(index,enunciado){
            this.enunciados[index] = enunciado;
        }
    },
}
</script>