<template>
    <form class="row" v-on:submit.prevent="enviar">
        <div class="form-group col-8">
            Nro. Factura
            <input type="text" class="form-control" v-model="datos.factura" placeholder="Nro de Factura">
        </div>
        <div class="form-group col-4">
            TOTAL(USD)
            <input type="text" step="0.01" class="form-control" v-model="datos.total">
        </div>
        <hr class="col-10">
        <div class="form-group col-5">
            Item
            <input type="text" class="form-control" v-model="item.nombre" placeholder="Nombre del item">
        </div>
        <div class="form-group col-5">
            Cantidad
            <input type="text" class="form-control" v-model="item.cantidad">
        </div>
        <div class="form-group col-2">
            <b-btn variant="success" b-v-tooltip.hover title="Agregar" v-on:click="anadir">
                <font-awesome-icon icon="plus"></font-awesome-icon>
            </b-btn>
        </div>
        <div class="col-12">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Cantidad</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(itemx, index) in datos.items" :key="index">
                            <td>
                                {{ itemx.nombre }}
                            </td>
                            <td>
                                {{ itemx.cantidad }}
                            </td>
                            <td>
                                <b-btn variant="danger" b-v-tooltip.hover title="Quitar" v-on:click="borrar(index)">
                                    <font-awesome-icon icon="trash"></font-awesome-icon>
                                </b-btn>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <hr class="col-10">
        
        <div class="col-12">
            <button type="submit" class="btn btn-primary">
                <font-awesome-icon icon="send"></font-awesome-icon> Enviar
            </button>
        </div>
    </form>
</template>
<script>
export default {
    props: ['destino','sede'],
    data() {
        return {
            item: {
                nombre: '',
                cantidad: 0
            },
            datos: {
                items: [],
                factura: '',
                total: 0.0,
            }
        }
    },
    methods: {
        enviar(){
            axios.post(this.destino + '/enviamanifiesto/' + this.sede,this.datos).then((res)=>{
                Toastr.success("Manifiesto enviado.");
                this.datos = {
                    items: [],
                    factura: '',
                    total: 0.0,
                };
            }).catch((e)=>{
                Toastr.error("El manifiesto no se pudo enviar!!");
                console.log(e);
            });
        },
        anadir(){
            this.datos.items.push(this.item);
            this.item = {
                nombre: '',
                cantidad: 0
            };
        },
        borrar(index){
            this.datos.items.splice(index,1);
        }
    },
}
</script>