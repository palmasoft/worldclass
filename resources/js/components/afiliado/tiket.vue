<template>
    <div class="card">
        <div class="card-header">
            <strong>Solicitud - Caso #{{ tiket.id }}</strong>
            <span> - {{ tiket.created_at }}</span>
            <b-btn v-if="tiket.prioridad == 'ALTA'" variant="danger">
                {{ tiket.prioridad }}
            </b-btn>
            <b-btn v-else-if="tiket.prioridad == 'MEDIA'" variant="warning">
                {{ tiket.prioridad }}
            </b-btn>
            <b-btn v-else-if="tiket.prioridad == 'BAJA'" variant="success">
                {{ tiket.prioridad }}
            </b-btn>

            <b-btn v-if="tiket.estado == 0" variant="danger">
                Abierto
            </b-btn>
            <b-btn v-else-if="tiket.estado == 1" variant="success">
                Respondido
            </b-btn>
            <b-btn v-else-if="tiket.estado == 2" variant="warning">
                Respuesta del cliente
            </b-btn>
            <b-btn v-else-if="tiket.estado == 3" variant="secondary">
                Cerrado
            </b-btn>

            

            <b-btn v-if="tiket.estado2 == 'P' && estado==1" variant="danger">
                Pendiente
            </b-btn>
            <b-btn v-else-if="tiket.estado2 == 'G' && estado==1" variant="success">
                Gestion
            </b-btn>
            <b-btn v-else-if="tiket.estado2 == 'S' && estado==1" variant="warning">
                Seguimiento
            </b-btn>
            <b-btn v-else-if="tiket.estado2 == 'V' && estado==1" variant="info">
                Venta
            </b-btn>
            <b-btn v-else-if="tiket.estado2 == 'C' && estado==1" variant="secondary">
                Cerrado
            </b-btn>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-8">
                    {{ tiket.asunto + ' / ' + tiket.departamento + ' / ' + tiket.servicio_relacionado }}
                </div>
                <div class="col-4">
                    <b-btn v-if="tiket.estado != 3 && estado==1" variant="secondary" v-b-tooltip.hover title="Cerrar" v-on:click="cerrartiket">
                        <font-awesome-icon icon="stop"></font-awesome-icon>
                    </b-btn>
                    <b-btn variant="primary" v-b-tooltip.hover title="Mensajes de Solicitud - Caso" v-on:click="showModal1">
                        <font-awesome-icon icon="comments"></font-awesome-icon>
                    </b-btn>
                    <b-btn v-if="estado==1 && tiket.estado2!='V'" variant="info" v-b-tooltip.hover title="Cambiar Estado de gestion Operativa" v-on:click="showModal2">
                        <font-awesome-icon icon="eye"></font-awesome-icon>
                    </b-btn>

                    <b-modal ref="myModal1" hide-footer :title="'Mensajes de Solicitud - Caso #' + tiket.id">
                        <strong v-if="estado==1">
                            Afiliado - {{ titular.nombre + ' ' + titular.apellido }}
                        </strong>
                        <hr>
                        <form v-if="tiket.estado != 3" class="row" v-on:submit.prevent="nuevoMsg" enctype="multipart/form-data">
                            <div class="form-group col-12">
                                Nuevo Mensaje
                                <textarea class="form-control" rows="3" v-model="mensajeN.mensaje" placeholder="Nuevo Mensaje..."></textarea>
                            </div>
                            <div class="form-group col-12">
                                Archivo Adjunto
                                <input type="file"  id="file" ref="file" v-on:change="handleFileUpload()">
                            </div>
                            <div class="form-group col-12">
                                Correo
                                <input type="email" class="form-control" v-model="mensajeN.email">
                            </div>
                            <div class="form-group col-12">
                                <button type="submit" class="btn btn-primary">Enviar</button>
                            </div>
                        </form>
                        <hr>
                        <div class="row">
                            <div class="col-12 mt-1 mb-1" v-for="(mensaje, index) in mensajes" :key="index">
                                <div class="card">
                                    <div class="card-header">
                                        <strong v-if="mensaje.empleado">
                                            Soporte ({{ mensaje.empleado }}) - {{ mensaje.created_at }}
                                        </strong>
                                        <strong v-else>
                                            Cliente - {{ mensaje.created_at }}
                                        </strong>
                                    </div>
                                    <div class="card-body">
                                        <div v-html="mensaje.mensaje"></div>
                                        <hr>
                                        <span v-if="mensaje.adjunto">
                                            <a :href="mensaje.adjunto" class="btn btn-secondary" target="_blank">Archivo Adjunto</a>
                                            <img class="img-fluid" v-if="mensaje.adjunto.indexOf('.jpg') != -1 || mensaje.adjunto.indexOf('.png') != -1 || mensaje.adjunto.indexOf('.gif') != -1" :src="mensaje.adjunto" alt="adjunto">
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </b-modal>

                    <b-modal ref="myModal2" hide-footer :title="'Cambiar Estado de gestion Operativa de Solicitud - Caso #' + tiket.id + ' ' + estado">
                        <form class="row" v-on:submit.prevent="gestionOprativa">
                            <div class="form-group col-12">
                                Estado de Gestion Operativa
                                <select class="form-control" v-model="tiket.estado2">
                                    <option value="G">Gestion</option>
                                    <option value="S">Seguimiento</option>
                                    <option value="V">Venta</option>
                                    <option value="C">Cerrado</option>
                                </select>
                            </div>
                            <div class="form-group col-12">
                                <button type="submit" class="btn btn-primary">Enviar</button>
                                <b-btn v-on:click="hideModal2">Cancelar</b-btn>
                            </div>
                        </form>
                    </b-modal>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['base','tiket','estado'],
    data() {
        return {
            mensajes: [],
            mensajeN: {
                mensaje: '',
                estado: this.estado,
                email: ''
            },
            file: '',
            titular: {}
        }
    },
    mounted() {
        
    },
    methods: {
        getCliente(){
            axios.get(this.base + '/clientes/' + this.tiket.cliente_id).then((res2) => {
                this.titular = res2.data;
                this.mensajeN.email = this.titular.email;
            }).catch((err2) => {
                console.log(err2);
            });
        },
        handleFileUpload(){
            this.file = this.$refs.file.files[0];
        },
        showModal1(){
            this.$refs.myModal1.show();
            this.getMensajes();
            this.getCliente();
        },
        hideModal1(){
            this.$refs.myModal1.hide();
        },
        showModal2(){
            this.$refs.myModal2.show();
            this.getMensajes();
        },
        hideModal2(){
            this.$refs.myModal2.hide();
        },
        getMensajes(){
            axios.get(this.base + '/smstiket/' + this.tiket.id).then((res) => {
                this.mensajes = res.data;
            }).catch((err) => {
                console.log(err);
            });
        },
        cerrartiket(){
            axios.delete(this.base + '/tikets/' + this.tiket.id).then((res) => {
                this.tiket.estado = 3;
                Toastr.success("Tiket Cerrado.");
            }).catch((err) => {
                Toastr.error("Error al cerrar el tiket.");
                console.log(err);
            });
        },
        gestionOprativa(){
            axios.get(this.base + '/tiketestadogestion/' + this.tiket.id + '/' + this.tiket.estado2).then((res) => {
                Toastr.success("Estado Modificado.");
            }).catch((err) => {
                Toastr.error("Error.");
                console.log(err);
            });
        },
        nuevoMsg(){
            axios.put(this.base + '/tikets/' + this.tiket.id, this.mensajeN).then((res) => {
                this.mensajes.push(res.data);
                this.tiket.estado = this.estado;

                this.mensajeN.mensaje = '';

                if (this.file) {
                    let formData = new FormData();

                    formData.append('archivo', this.file);

                    axios.post(this.base + '/tiket-archivo/' + res.data.id,
                        formData,
                        {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        }
                    ).then((res2) => {
                        this.getMensajes();
                        Toastr.success("Archivo Subido.");
                    })
                    .catch(function(){
                        Toastr.error("Error al intentar subir el archivo.");
                        console.log('FAILURE!!');
                    });
                }

                Toastr.success("MENSAJE ENVIADO.");
            }).catch((err) => {
                Toastr.error("Error alintentar enviar el mensaje. Intentelo otra vez mas tarde");
                console.log(err);
            });
        }
    },
}
</script>