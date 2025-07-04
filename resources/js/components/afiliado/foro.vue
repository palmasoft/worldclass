<template>
    <div class="card">
        <div class="card-header">
            <strong class="m-1">
                {{ foro.titulo }} - {{ foro.created_at }}
            </strong>
            <b-btn variant="primary" v-on:click="showModal1">
                <font-awesome-icon icon="eye"></font-awesome-icon> Ver
            </b-btn>

            <b-modal ref="myModal1" hide-footer :title="'TEMA: ' + foro.titulo">
                <div class="row">
                    <div class="col-12">
                        <strong>
                            {{ foro.mensaje }}
                        </strong>
                    </div>
                </div>

                <hr>
                <p>
                    <strong>Responder:</strong>
                </p>
                <form class="row" v-on:submit.prevent="responder">
                    <div class="form-group col-12">
                        Mensaje
                        <textarea class="form-control" rows="4" v-model="msg.mensaje"></textarea>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <b-btn v-on:click="hideModal1">Cancelar</b-btn>
                    </div>
                </form>

                <hr>

                <div class="row">
                    <div class="col-12" v-for="(mensaje, index) in mensajes" :key="index">
                        <div v-if="mensaje.tipo == 0" class="card-header bg-info">
                            SOPORTE: {{ mensaje.usuario }} - {{ mensaje.created_at }}                         
                        </div>
                        <div v-else class="card-header bg-secondary">
                            AFILIADO: {{ mensaje.usuario }} - {{ mensaje.created_at }}                        
                        </div>
                        <div class="card-body">
                            {{ mensaje.mensaje }}
                        </div>
                    </div>
                </div>

            </b-modal>
        </div>
        <div class="card-body">
            <p>
                {{ foro.mensaje }}
            </p>
        </div>
    </div>
</template>
<script>
export default {
    props: ['base','tipo','foro'],
    data() {
        return {
            msg: {
                mensaje:''
            },
            mensajes:[],
        }
    },
    methods: {
        showModal1(){
            this.getMsg();
            this.$refs.myModal1.show();
        },
        hideModal1(){
            this.$refs.myModal1.hide();
        },
        getMsg(){
            axios.get(this.base + '/foros/' + this.foro.id).then((res) => {
                this.mensajes = res.data
            }).catch((e) => {
                console.log(e);
            });
        },
        responder(){
            axios.post(this.base + '/foros/' + this.foro.id, this.msg).then((res) => {
                this.mensajes.push(res.data);
                this.msg = {
                    mensaje:'',
                };
                Toastr.success("Respueta guardada");
            }).catch((e) => {
                Toastr.error("No se pudo guardar la respuesta, intentelo mas tarde.");
                console.log(e);
            });
        },
    },
}
</script>