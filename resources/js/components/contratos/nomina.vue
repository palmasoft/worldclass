<template>
    <div class="card">
        <div class="card-header">
            <strong v-if="contrato">
                Contrato {{ contrato.sede + contrato.consecutivo }}
                <b-button v-on:click="getComicionables" v-b-toggle="'collapseA' + contrato.id" class="m-1">Participantes</b-button>
            </strong>
            <strong v-if="empleado">
                Empleado "{{ empleado.nombre + ' ' + empleado.apellido }}"
            </strong>
        </div>
        <b-collapse :id="'collapseA' + contrato.id" v-if="contrato">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        Valor: <strong>$
                            {{ contrato.valorContrato }}
                        </strong>
                    </div>
                    <div class="col-sm-6">
                        Pago Inicial: <strong>$
                            {{ contrato.pagoInicial }}
                        </strong>
                    </div>
                    <div class="col-12">
                        Estado Contrato: <strong>
                            {{ contrato.estadoContrato }}
                        </strong>                        
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>
                                            Empleado
                                        </th>
                                        <th>
                                            Cargo
                                        </th>
                                        <th>
                                            Cms.
                                        </th>
                                        <th>
                                            Pack
                                        </th>
                                        <th>
                                            xPack
                                        </th>
                                        <th>
                                            Total
                                        </th>                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(comicionable, index) in comicionables" :key="index">
                                        <td>
                                            {{ comicionable.empleado }}
                                        </td>
                                        <td>
                                            {{ comicionable.cargo }}
                                        </td>
                                        <td>
                                            {{ comicionable.comicion }}
                                        </td>
                                        <td>
                                            {{ comicionable.pack }}
                                        </td>
                                        <td>
                                            {{ comicionable.xpack }}
                                        </td>
                                        <td>
                                            {{ comicionable.total }}
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td>
                                            
                                        </td>
                                        <td>
                                            Total
                                        </td>
                                        <td>
                                            {{ total1 }}
                                        </td>
                                        <td>
                                            {{ total2 }}
                                        </td>
                                        <td>
                                            {{ total3 }}
                                        </td>
                                        <td>
                                            {{ total }}
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>            
        </b-collapse>
        <div class="card-body" v-if="empleado">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        Cargo
                                    </th>
                                    <th>
                                        Cms
                                    </th>
                                    <th>
                                        Pack
                                    </th>
                                    <th>
                                        Xpack
                                    </th>
                                    <th>
                                        Total
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(comicionable, index) in comicionablesx" :key="index">
                                    <td>
                                        {{ comicionable.cargo }}
                                    </td>
                                    <td>
                                        {{ comicionable.comicion }}
                                    </td>
                                    <td>
                                        {{ comicionable.pack }}
                                    </td>
                                    <td>
                                        {{ comicionable.xpack }}
                                    </td>
                                    <td>
                                        {{ comicionable.total }}
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>
                                        Total
                                    </td>
                                    <td>
                                        {{ totalx1 }}
                                    </td>
                                    <td>
                                        {{ totalx2 }}
                                    </td>
                                    <td>
                                        {{ totalx3 }}
                                    </td>
                                    <td>
                                        {{ totalx }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['base','contrato','empleado','empleados','cargos','buscar'],
    data() {
        return {
            comicionables: [],
            comicionablesx: [],
            total: 0,
            total1: 0,
            total2: 0,
            total3: 0,
            totalx: 0,
            totalx1: 0,
            totalx2: 0,
            totalx3: 0
        }
    },
    mounted() {
        this.getCom();
    },
    methods: {
        getComicionables(){
            axios.get(this.base + '/comicionables/' + this.contrato.id).then((res) => {
                this.total = 0;
                this.total1 = 0;
                this.total2 = 0;
                this.total3 = 0;
                this.comicionables = [];

                if (res.data) {
                    for (let i = 0; i < res.data.length; i++) {
                        let compa = {
                            empleado: '',
                            cargo: '',
                            comicion: res.data[i].comicion,
                            pack: res.data[i].pack,
                            xpack: res.data[i].xpack,
                            total: parseFloat(res.data[i].pack) + parseFloat(res.data[i].xpack) + parseFloat(res.data[i].comicion)
                        };

                        this.total = parseFloat(this.total) + parseFloat(compa.total);
                        this.total1 = parseFloat(this.total1) + parseFloat(compa.comicion);
                        this.total2 = parseFloat(this.total2) + parseFloat(compa.pack);
                        this.total3 = parseFloat(this.total3) + parseFloat(compa.xpack);

                        for (let j = 0; j < this.empleados.length; j++) {
                            if (this.empleados[j].id == res.data[i].empleado_id) {
                                compa.empleado = this.empleados[j].nombre + ' ' + this.empleados[j].apellido;

                                break;
                            }
                        }
                        
                        for (let j = 0; j < this.cargos.length; j++) {
                            if (this.cargos[j].id == res.data[i].cargo_id) {
                                compa.cargo = this.cargos[j].nombre;

                                break;
                            }
                        }

                        this.comicionables.push(compa);
                    }
                }
            }).catch((err) => {
                console.log(err);
            });
        },
        getCom(){
            let buscador = '';
            
            axios.get(this.base + '/comicionablesem/' + this.empleado.id + '/' + buscador).then((res) => {
                if (res.data.length > 0) {
                    let comi = {
                        cargo_id: res.data[0].cargo_id,
                        cargo: '',
                        comicion: res.data[0].comicion,
                        pack: res.data[0].pack,
                        xpack: res.data[0].xpack,
                        total: parseFloat(res.data[0].pack) + parseFloat(res.data[0].xpack) + parseFloat(res.data[0].comicion)
                    };
                    this.comicionablesx.push(comi);

                    for (let i = 1; i < res.data.length; i++) {
                        if (res.data[i].cargo_id == comi.cargo_id) {
                            comi.comicion = parseFloat(comi.comicion) +  parseFloat(res.data[i].comicion);
                            comi.pack = parseFloat(comi.pack) +  parseFloat(res.data[i].pack);
                            comi.xpack = parseFloat(comi.xpack) +  parseFloat(res.data[i].xpack);
                            comi.total = parseFloat(comi.pack) + parseFloat(comi.xpack) + parseFloat(comi.comicion);
                        } else {
                            if (res.data[0].cargo_id != comi.cargo_id) {
                                this.comicionablesx.push(comi);
                            }
                                

                            comi = {
                                cargo_id: res.data[i].cargo_id,
                                cargo: '',
                                comicion: res.data[i].comicion,
                                pack: res.data[i].pack,
                                xpack: res.data[i].xpack,
                                total: parseFloat(res.data[i].pack) + parseFloat(res.data[i].xpack) + parseFloat(res.data[i].comicion)
                            };

                            if (comi.total == 0) {
                                this.$emit('vacio');
                            }
                        }
                    }

                    for (let i = 0; i < this.comicionablesx.length; i++) {
                        this.totalx = parseFloat(this.totalx) + parseFloat(this.comicionablesx[i].total);
                        this.totalx1 = parseFloat(this.totalx1) + parseFloat(this.comicionablesx[i].comicion);
                        this.totalx2 = parseFloat(this.totalx2) + parseFloat(this.comicionablesx[i].pack);
                        this.totalx3 = parseFloat(this.totalx3) + parseFloat(this.comicionablesx[i].xpack);
                    
                        for (let j = 0; j < this.cargos.length; j++) {
                            if (this.cargos[j].id == this.comicionablesx[i].cargo_id) {
                                this.comicionablesx[i].cargo = this.cargos[j].nombre;
                                break;
                            }
                        }
                    }
                }else{
                    this.$emit('vacio');
                }
            }).catch((err) => {
                console.log(err);
            });
        }
    },
}
</script>