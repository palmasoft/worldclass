<template>
    <div class="card">
        <div class="card-header">
            <strong>Nomina</strong>
        </div>
        <div class="card-body">
            <form class="row" v-on:submit.prevent="getContratos2">
                <div class="form-group col-md-3 col-6">
                    Fecha Inicio
                    <input type="date" class="form-control" v-model="buscar.f1">
                </div>
                <div class="form-group col-md-3 col-6">
                    Fecha Fin
                    <input type="date" class="form-control" v-model="buscar.f2">
                </div>
                <div class="form-group col-md-6 col-12">
                    Sede
                    <select class="form-control" v-model="buscar.sede">
                        <option value="">-Elija Sede-</option>
                        <option v-for="(sede, index) in sedes" :key="index" :value="sede.sede">
                            {{  sede.sede + ' - ' + sede.nombre }}
                        </option>
                    </select>
                </div>
                <div class="form-group col-12">
                    <button type="submit" class="btn btn-danger">Buscar</button>
                </div>
            </form>
            <hr>
            <div class="row">
                <div class="form-group col-12">
                    <b-form-radio-group v-model="detallado" :options="options" name="radioInline" />
                </div>
            </div>
            <hr>
            <div class="row" v-if="detallado == 'A'">
                <div class="col-12" v-for="(contrato, index) in contratos" :key="index">
                    <nomina-component :base="base" :contrato="contrato" :empleados="empleados" :cargos="cargos"></nomina-component>
                </div>
            </div>
            <div class="row" v-else-if="detallado == 'B'">
                <div class="col-12" v-for="(empleado, index) in empleados" :key="index" :id="index + 'nom2'">
                    <nomina-component :base="base" :empleado="empleado" :cargos="cargos" @vacio="ocultar(index + 'nom2')"></nomina-component>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['base'],
    data() {
        return {
            detallado: 'B',
            options: [                
                { text: 'Detallado', value: 'A' },
                { text: 'Resumen', value: 'B' },
            ],
            contratos:  [],
            empleados:  [],
            cargos: [],
            buscar: {
                f1: '',
                f2: '',
                sede: ''
            },
            sedes: []
        }
    },
    mounted() {
        this.getEmpleados();
        this.getCargos();
        this.getSedes();
    },
    methods: {
        ocultar(id){
            document.getElementById(id).style.display = 'none';
        },
        getSedes(){
            axios.get(this.base + '/sedes').then((res) => {
                this.sedes = res.data;
            }).catch((err) => {
                console.log(err);
            });
        },
        getContratos(){
            axios.get(this.base + '/comicionablescontratos').then((res) => {
                this.contratos = res.data;
            }).catch((err) => {
                console.log(err);
            });
        },
        getContratos2(){
            axios.get(this.base + '/comicionablescontratos/' + this.buscar.f1 + '|' + this.buscar.f2 + '|' + this.buscar.sede).then((res) => {
                this.contratos = res.data;
                Toastr.success(this.buscar.f1 + '|' + this.buscar.f2 + '|' + this.buscar.sede);
            }).catch((err) => {
                console.log(err);
            });
        },
        getEmpleados(){
            axios.get(this.base + '/empleados').then((res) => {
                this.empleados = res.data;
            }).catch((err) => {
                console.log(err);
            });
        },
        getCargos(){
            axios.get(this.base + '/cargos').then((res) => {
                this.cargos = res.data;
            }).catch((err) => {
                console.log(err);
            });
        }
    },
}
</script>