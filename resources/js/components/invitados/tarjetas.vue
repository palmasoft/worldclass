<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div role="tablist">
                    <b-card no-body class="mb-1">
                        <b-card-header header-tag="header" class="p-1" role="tab">
                            <b-btn block href="#" v-b-toggle.accordionx0 variant="info">Añadir Tarjeta</b-btn>
                        </b-card-header>
                        <b-collapse id="accordionx0" accordion="my-accordion2" role="tabpanel">
                            <b-card-body>
                                <form class="row" v-on:submit.prevent="nuevo(quien)">
                                    <div class="form-group col-sm-6">
                                        Tarjeta
                                        <select class="form-control" v-model="tarjetaN.tarjeta" required>
                                            <option>VISA</option>
                                            <option>MASTER CARD</option>
                                            <option>AMERICAN</option>
                                            <option>AMERICAN EXPRES</option>
                                            <option>DINNERS</option>
                                            <option>DISCOVER</option>
                                            <option>ALIA</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        Tipo
                                        <select class="form-control" v-model="tarjetaN.tipo">
                                            <option>ALTA</option>
                                            <option>CLASICA</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        Subtipo
                                        <select class="form-control" v-model="tarjetaN.subtipo">
                                            <option>SIGNATURE</option>
                                            <option>BLACK</option>
                                            <option>PLATINIUM</option>
                                            <option>TITANIUM</option>
                                            <option>DORADA</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        A&ntilde;adir a:
                                        <select class="form-control" v-model="quien" required>
                                            <option :value="1">Invitado</option>
                                            <option :value="2" v-if="acompanante > 0">Acompa&ntilde;ante</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-12">
                                        <button type="submit" class="btn btn-danger">Agregar</button>
                                    </div>
                                </form>
                            </b-card-body>
                        </b-collapse>
                    </b-card>
                    <b-card no-body class="mb-1">
                        <b-card-header header-tag="header" class="p-1" role="tab">
                            <b-btn block href="#" v-b-toggle.accordionx1 variant="info">Tarjetas del Invitado</b-btn>
                        </b-card-header>
                        <b-collapse id="accordionx1" visible accordion="my-accordion2" role="tabpanel">
                            <b-card-body>
                                <div v-for="(tarjeta, index) in tarjetas1" :key="index" class="card mt-2">
                                    <div class="card-body">
                                        {{ tarjeta.tarjeta + ' - ' + tarjeta.tipo + ' - ' + ' - ' + tarjeta.subtipo }}
                                        <b-btn variant="danger" v-on:click="borrar1(index,tarjeta.id)">
                                            <font-awesome-icon icon="trash"></font-awesome-icon>
                                        </b-btn>
                                    </div>
                                </div>
                            </b-card-body>
                        </b-collapse>
                    </b-card>
                    <b-card no-body class="mb-1" v-if="acompanante > 0">
                        <b-card-header header-tag="header" class="p-1" role="tab">
                            <b-btn block href="#" v-b-toggle.accordionx2 variant="info">Tarjetas del Acompa&ntilde;ante</b-btn>
                        </b-card-header>
                        <b-collapse id="accordionx2" accordion="my-accordion2" role="tabpanel">
                            <b-card-body>
                                <div v-for="(tarjeta, index) in tarjetas2" :key="index" class="card mt-2">
                                    <div class="card-body">
                                        {{ tarjeta.tarjeta + ' - ' + tarjeta.tipo + ' - ' + ' - ' + tarjeta.subtipo }}
                                        <b-btn variant="danger" v-on:click="borrar2(index,tarjeta.id)">
                                            <font-awesome-icon icon="trash"></font-awesome-icon>
                                        </b-btn>
                                    </div>
                                </div>                                
                            </b-card-body>
                        </b-collapse>
                    </b-card>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['base','invitado','acompanante'],
    data() {
        return {
            tarjetas1: [],
            tarjetas2: [],
            quien: 1,
            tarjetaN: {
                tarjeta: '',
                tipo: '',
                subtipo: ''
            }
        }
    },
    mounted() {
        this.iniciar();
    },
    methods: {
        iniciar(){
            axios.get(this.base + '/clientetarjetas/' + this.invitado).then((res) => {
                this.tarjetas1 = res.data;
            }).catch((err) => {
                console.log(err);
            });
            if (acompanante) {
                axios.get(this.base + '/clientetarjetas/' + this.acompanante).then((res) => {
                    this.tarjetas2 = res.data;
                }).catch((err) => {
                    console.log(err);
                });
            }
        },
        borrar1(index,id){
            axios.delete(this.base + '/clientetarjetas/' + this.invitado + '/' + id).then((res) => {
                Toastr.success("Tarjeta Eliminada.");
                this.tarjetas1.splice(index,1);
            }).catch((err) => {
                Toastr.error("Error al tratar de Eliminar.");
                console.log(err);
            });
        },
        borrar2(index,id){
            axios.delete(this.base + '/clientetarjetas/' + this.acompanante + '/' + id).then((res) => {
                Toastr.success("Tarjeta Eliminada.");
                this.tarjetas2.splice(index,1);
            }).catch((err) => {
                Toastr.error("Error al tratar de Eliminar.");
                console.log(err);
            });
        },
        nuevo(id){
            if (id == 1) {
                axios.post(this.base + '/clientetarjetas/' + this.invitado, this.tarjetaN).then((res) => {
                    this.tarjetas1.push(res.data);
                    this.tarjetaN = {
                        tarjeta: '',
                        tipo: '',
                        subtipo: ''
                    };
                    Toastr.success("Tarjeta Agregada.");
                }).catch((err) => {
                    Toastr.error("Error al tratar de Agregar.");
                    console.log(err);
                });                
            } else if(id == 2){
                axios.post(this.base + '/clientetarjetas/' + this.acompanante, this.tarjetaN).then((res) => {
                    this.tarjetas2.push(res.data);
                    this.tarjetaN = {
                        tarjeta: '',
                        tipo: '',
                        subtipo: ''
                    };
                    Toastr.success("Tarjeta Agregada.");
                }).catch((err) => {
                    Toastr.error("Error al tratar de Agregar.");
                    console.log(err);
                });
            }
        }
    },
}
</script>