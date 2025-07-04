<template>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            
                            <th>Variable</th>
                            <th>valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <variable-component v-for="(variable, index) in variables" :key="index" :variable="variable"
                            :base="base" @update="actualizar(index)">                            
                        </variable-component>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['base'],
    data() {
        return {
            variables: [],
        }
    },
    mounted() {
        this.getVariables();
    },
    methods: {
        showModal(){
            this.$refs.mymodal1.show();
        },
        hideModal(){
            this.$refs.mymodal1.hide();
        },
        getVariables(){
            axios.get(this.base + '/variables').then((res) => {
                this.variables = res.data;
            }).catch((err) => {
                console.log(err);
            });
        },
        actualizar(index,variable){
            this.variables[index] = variable;
        }
        
    },
}
</script>