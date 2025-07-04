<template>
    <div class="card">
        <div class="card-header bg-danger text-white">
            <strong>Registro de Tmk/Opc</strong>
        </div>
        <div class="card-body">
            <form class="row" v-on:submit.prevent="nuevo">
                <div class="form-group col-sm-6 col-lg-3">
                    Primer Nombre
                    <input type="text" v-model="tmkN.name1" class="form-control" placeholder="Primer Nombre" required>
                </div>
                <div class="form-group col-sm-6 col-lg-3">
                    Segundo Nombre
                    <input type="text" v-model="tmkN.name2" class="form-control" placeholder="Segundo Nombre" required>
                </div>
                
                <div class="form-group col-sm-6 col-lg-3">
                    Primer Apellido
                    <input type="text" v-model="tmkN.name3" class="form-control" placeholder="Primer Apellido" required>
                </div>
                <div class="form-group col-sm-6 col-lg-3">
                    Segundo Apellido
                    <input type="text" v-model="tmkN.name4" class="form-control" placeholder="Segundo Apellido" required>
                </div>

                <div class="form-group col-sm-6 col-lg-3">
                    Cedula
                    <input type="text" v-model="tmkN.cedula" class="form-control" placeholder="Cedula">
                </div>
                <div class="form-group col-sm-6 col-lg-3">
                    Pasaporte
                    <input type="text" v-model="tmkN.pasaporte" class="form-control" placeholder="Pasaporte">
                </div>
                <div class="form-group col-12">
                    Cargo
                    <select v-model="cargo" class="form-control">
                        <option value="4">TMK</option>
                        <option value="5">OPC</option>
                    </select>
                </div>
                <div class="form-group col-12">
                    <button type="submit" class="btn btn-danger">Registrarse</button>
                </div>
            </form>
            <b-modal ref="myModal" hide-footer title="Su CODIGO ES:">
                <h1>
                    {{ codigo }}
                </h1>
            </b-modal>
        </div>
    </div>
</template>
<script>
export default {
    props: ['base'],
    data() {
        return {
            codigo: '',
            tmkN:{
                name1: '',
                name2: '',
                name3: '',
                name4: '',
                nombre: '',
                apellido: '',
                cedula: '',
                pasaporte: '',
            },
            cargo: 4
        }
    },
    methods: {
        nuevo(){

            this.tmkN.nombre = this.tmkN.name1 + ' ' + this.tmkN.name2;
            this.tmkN.apellido = this.tmkN.name3 + ' ' + this.tmkN.name4;

            axios.post(this.base + '/empleados',this.tmkN).then((res) => {
                
                let upCargosd = {
                    cargos: [
                        this.cargo
                    ]
                };

                axios.post(this.base + '/empleadocargos/' + res.data.id,upCargosd).then((res2) => {
                    this.$refs.myModal.show();
                    axios.get(this.base + '/empleados/' + res.data.id).then((res3) => {
                        if (this.cargo == 4) {
                            this.codigo = 'TM' + res3.data.codigo1;
                        } else if(this.cargo == 5){
                            this.codigo = 'OP' + res3.data.codigo2;
                        }
                    }).catch((err3) => {
                        console.log(err3);
                    });
                }).catch((err2) => {
                    console.log(err2);
                });
            }).catch((err) => {
                console.log(err);
            });
        }
    },
}
</script>