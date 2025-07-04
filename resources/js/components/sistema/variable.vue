<template>
    <tr>
        <td>
            <b-btn v-b-popover.hover="variable.valor" title="Contenido">
                {{variable.nombre}}
            </b-btn>
        </td>
        <td>
            <form class="row" v-on:keyup.prevent="actualizar">
                <b-form-input type="text" class="form-control" v-model="variable.valor" placeholder="Valor"></b-form-input>
            </form>
        </td>
    </tr>
</template>

<script>
    export default {
        props: ['base','variable'],
        methods: {
            showModal(){
                this.$refs.mymodal1.show();
            },
            hideModal(){
                this.$refs.mymodal1.hide();
            },
            actualizar(){
                axios.put(this.base + '/variables/' + this.variable.id, this.variable).then((res) => {
                    let variable = res.data;
                    
                    this.$emit('update', variable);
                    Toastr.success("Variable Actualizada.");
                }).catch((err) => {
                    Toastr.error("Error al intentar Actualizar.");
                    console.log(err);
                });
            }
        },
        
    }
</script>
