<template>
    <div class="card">
        <div class="card-header">
            <strong class="mt-1 mr-1">
                Mis Solicitudes
            </strong>
            <b-btn v-b-tooltip.hover title="Nueva Solicitud" variant="success" v-on:click="showModal1">
                <font-awesome-icon icon="plus"></font-awesome-icon>
            </b-btn>

            <b-modal ref="myModal1" hide-footer title="Abrir nueva Solicitud">
                <form class="row" v-on:submit.prevent="nuevo">
                    <div class="form-group col-12">
                        Asunto
                        <input type="text" class="form-control" placeholder="Asunto" v-model="tiketN.asunto">
                    </div>
                    <div class="form-group col-sm-4">
                        Departamento
                        <select class="form-control" v-model="tiketN.departamento">
                            <option>Servicio al Cliente</option>
                            <option>Pagos y Facturacion</option>
                            <option>Servicios VIP</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-4">
                        Servicios Relacionados
                        <select class="form-control" v-model="tiketN.servicio_relacionado">
                            <option>Nada</option>
                            <option>Sobre mi Contrato</option>
                            <option>Cotizar</option>
                            <option>Comprar</option>
                            <option>Anulacion</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-4">
                        Prioridad
                        <select class="form-control" v-model="tiketN.prioridad">
                            <option>ALTA</option>
                            <option>MEDIA</option>
                            <option>BAJA</option>
                        </select>
                    </div>
                    <div v-if="tiketN.departamento == 'Servicios VIP'" class="form-group col-12">
                        <b-form-checkbox-group
                            v-model="cotizar.selected"
                            :options="cotizar.options"
                        />
                    </div>
                    <div v-if="tiketN.departamento == 'Servicios VIP'" class="col-12">
                        <div v-if="this.cotizar.selected.length > 0" class="row">
                            <div class="form-group col-sm-6">
                                Fecha de Inicio
                                <input type="date" class="form-control" v-model="cotizar.fecha1">
                            </div>
                            <div class="form-group col-sm-6">
                                Fecha de Fin
                                <input type="date" class="form-control" v-model="cotizar.fecha2">
                            </div>
                            <div class="form-group col-sm-6">
                                Ni&ntilde;os
                                <input type="number" class="form-control" v-model="cotizar.ninos">
                            </div>
                            <span v-for="(edad, index) in cotizar.edades" :key="index">
                                <div v-if="index<cotizar.ninos" class="form-group col-sm-6">
                                    Ni&ntilde;o {{ index + 1 }} (Edad)
                                    <input type="number" class="form-control" v-model="cotizar.edades[index]">
                                </div>
                            </span>
                            <div class="form-group col-sm-6">
                                Adultos
                                <input type="number" class="form-control" v-model="cotizar.adultos">
                            </div>
                            <div v-if="cotizar.selected.indexOf('Vuelo') != -1 || cotizar.selected.indexOf('Crucero') != -1" class="form-group col-sm-6">
                                Origen
                                <input type="text" class="form-control" v-model="cotizar.origen">
                            </div>
                            <div class="form-group col-sm-6">
                                Destino
                                <input type="text" class="form-control" v-model="cotizar.destino">
                            </div>
                            <div v-if="cotizar.selected.indexOf('Vuelo') != -1" class="form-group col-sm-6">
                                Tipo de Vuelo
                                <select class="form-control" v-model="cotizar.tipoV">
                                    <option>Ida y Vuelta</option>
                                    <option>Solo Ida</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-12">
                        Mensaje
                        <textarea class="form-control" rows="5" placeholder="Mensaje..." v-model="mensajeN"></textarea>
                    </div>
                    <div class="form-group col-12">
                        <button type="submit" class="btn btn-primary">Abrir</button>
                        <b-btn v-on:click="hideModal1">Cancelar</b-btn>
                    </div>
                </form>
            </b-modal>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-12" v-for="(tiket, index) in tikets" :key="index">
                    <tiket-component :base="base" :tiket="tiket" :estado="tipo">
                    </tiket-component>
                </div>
            </div>

        </div>
    </div>
</template>
<script>
export default {
    props: ['base','cliente','tipo'],
    data() {
        return {
            tiketN: {
                asunto: '',
                departamento: '',
                servicio_relacionado: '',
                prioridad: '',
                cliente_id: this.cliente,
            },
            mensajeN: '',
            tikets: [],

            cotizar: {
                selected: [],
                options: [
                    { text: 'Vuelo', value: 'Vuelo' },
                    { text: 'Hotel', value: 'Hotel' },
                    { text: 'Auto', value: 'Auto' },
                    { text: 'Crucero', value: 'Crucero' },
                    { text: 'Asesoria de Visas', value: 'Asesoria de Visas' },
                    { text: 'Seguro', value: 'Seguro' }
                ],
                fecha1: '',
                fecha2: '',
                tipoV: '',
                ninos: 0,
                adultos: 0,
                origen: '',
                destino: '',
                edades: [
                    0,0,0,0,0,0,0,0,0,0
                ]
            }
            
        }
    },
    mounted() {
        this.getTikets();        
    },
    methods: {
        showModal1(){
            this.$refs.myModal1.show();
        },
        hideModal1(){
            this.$refs.myModal1.hide();
        },
        getTikets(){
            axios.get(this.base + '/tikets/' + this.cliente).then((res) => {
                this.tikets = res.data;
            }).catch((err) => {
                console.log(err);
            });
        },
        nuevo(){
            let msgdd='';

            if (this.tiketN.departamento == 'Servicios VIP') {
                for (let i = 0; i < this.cotizar.selected.length; i++) {
                    msgdd = msgdd + "<strong>" + this.cotizar.selected[i] + "</strong>, ";
                    if (i == 0) {
                        msgdd = msgdd + '<br>';
                    }
                }
    
                if (this.cotizar.fecha1) {
                    msgdd = msgdd + 'Desde: <strong>' + this.cotizar.fecha1+ "</strong>. ";
                }
                if (this.cotizar.fecha2) {
                    msgdd = msgdd + 'Hasta: <strong>' + this.cotizar.fecha2+ "</strong><br>";
                }
                if (this.cotizar.origen) {
                    msgdd = msgdd + 'Origen: <strong>' + this.cotizar.origen+ "</strong><br>";
                }
                if (this.cotizar.destino) {
                    msgdd = msgdd + 'Destino: <strong>' + this.cotizar.destino+ "</strong><br>";
                }
                if (this.cotizar.ninos) {
                    msgdd = msgdd + 'Niños: <strong>' + this.cotizar.ninos+ "</strong><br>De ";
                    for (let i = 0; i < this.cotizar.ninos && i < this.cotizar.edades.length; i++) {
                        msgdd = msgdd + this.cotizar.edades[i] + ' años, ';                        
                    }
                    msgdd = msgdd + '<br>'; 
                }
                if (this.cotizar.adultos) {
                    msgdd = msgdd + 'Adultos: <strong>' + this.cotizar.adultos+ "</strong><br>";
                }
            }


            axios.post(this.base + '/tikets/' + this.cliente, this.tiketN).then((res) => {
                this.tikets.push(res.data);
                this.tiketN = {
                    asunto: '',
                    departamento: '',
                    servicio_relacionado: '',
                    prioridad: '',
                    cliente_id: this.cliente,
                };

                let msgN = {
                    mensaje: msgdd + '<hr>' + this.mensajeN,
                    estado: 0
                };

                axios.put(this.base + '/tikets/' + res.data.id, msgN).then((res2) => {
                    
                }).catch((err2) => {
                    Toastr.error("Error alintentar enviar el mensaje. Intentelo otra vez mas tarde");
                    console.log(err2);
                });

                this.mensajeN = '';
                Toastr.success("Solicitud Abierta.");
            }).catch((err) => {
                Toastr.error("Error alintentar abrir la Solicitud. Intentelo otra vez mas tarde");
                console.log(err);
            });
        }
    },
}
</script>