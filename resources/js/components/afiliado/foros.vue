<template>
    <div class="card">
        <div class="card-head">
            <strong class="m-1">
                Foro de Soporte
            </strong>
            <b-btn variant="primary" b-v-tooltip.hover title="Nuevo Tema" v-on:click="showModal1">
                <font-awesome-icon icon="plus"></font-awesome-icon>
            </b-btn>

            <b-modal ref="myModal1" hide-footer title="Nuevo Tema">
                <form class="row" v-on:submit.prevent="nuevo">
                    <div class="form-group col-12">
                        Titulo
                        <input type="text" class="form-control" v-model="foroN.titulo">
                    </div>
                    <div class="form-group col-12">
                        Mensaje
                        <textarea class="form-control" rows="4" v-model="foroN.mensaje"></textarea>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <b-btn v-on:click="hideModal1">Cancelar</b-btn>
                    </div>
                </form>
            </b-modal>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12" v-for="(foro, index) in foros" :key="index">
                    <foro-component :foro="foro" :base="base" :tipo="tipo" @delete="borrar(index)">
                    </foro-component>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['base','tipo'],
    data() {
        return {
            foros: [],
            foroN: {
                titulo:'',
                mensaje:'',
            }
        }
    },
    mounted() {
        this.getForos();
    },
    methods: {
        showModal1(){
            this.$refs.myModal1.show();
        },
        hideModal1(){
            this.$refs.myModal1.hide();
        },
        getForos(){
            axios.get(this.base + '/foros').then((res) => {
                this.foros = res.data;
            }).catch((e) => {
                console.log(e);
            });
        },
        borrar(index){
            this.foros.splice(index,1);
        },
        nuevo(){
            axios.post(this.base + '/foros', this.foroN).then((res) => {
                this.foros.push(res.data);
                this.foroN = {
                    titulo:'',
                    mensaje:'',
                };
                Toastr.success("Tema creado");
            }).catch((e) => {
                Toastr.error("No se pudo crear el tema,intentelo mas tarde.");
                console.log(e);
            });
        },
    },
}
</script>