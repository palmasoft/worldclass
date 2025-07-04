<template>
    <div class="card">
        <div class="card-header">
            <strong>Nuevo Contrato</strong>
        </div>
        <div class="card-body" v-if="!creandoContrato && !creadoContrato">
            <div class="row">
                <div class="col-12">

                    <div role="tablist">
                        <b-card no-body class="mb-1">
                            <b-card-header header-tag="header" class="p-1" role="tab">
                                <b-btn block href="#" v-b-toggle.accordion1 variant="info">Sede y TMK</b-btn>
                            </b-card-header>
                            <b-collapse id="accordion1" visible accordion="my-accordion" role="tabpanel">
                                <b-card-body>
                                    <div class="row">
                                        <div class="form-group col-12">
                                            Sede
                                            <select class="form-control" v-model="contrato.sede" v-on:change="setCiudadSede">
                                                <option value="">-Elija una Sede-</option>
                                                <option v-for="(sede, index) in sedes" :key="index" :value="sede.sede">
                                                    {{ sede.sede + ' - ' + sede.nombre }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group col-12">
                                            TMK
                                            <input type="text" class="form-control" v-model="contrato.tmk" v-on:change="existeTmk">
                                            <span v-html="alerta.tmk"></span>
                                        </div>
                                        <div class="form-group col-12">
                                            Ciudad de Firma del Contrato
                                            <input type="text" class="form-control" v-model="contrato.ciudadSede">
                                        </div>
                                        <div class="form-group col-12">
                                            <b-btn href="#" v-if="condicionalidad(1)" v-b-toggle.accordion1  variant="success">Siguiente</b-btn>
                                        </div>
                                    </div>
                                </b-card-body>
                            </b-collapse>
                        </b-card>
                        
                        <b-card no-body class="mb-1" v-if="condicionalidad(1)">
                            <b-card-header header-tag="header" class="p-1" role="tab">
                                <b-btn block href="#" v-b-toggle.accordion2 variant="info">Comerciales</b-btn>
                            </b-card-header>
                            <b-collapse id="accordion2" accordion="my-accordion" role="tabpanel">
                                <b-card-body>
                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            Jefe de Sala
                                            <select class="form-control" v-model="participantes.jefe_sala">
                                                <option value="0">-Ninguno-</option>
                                                <option v-for="(jefes_salax, index) in jefes_sala" :key="index" :value="jefes_salax.id">
                                                    {{ jefes_salax.nombre + ' ' + jefes_salax.apellido }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            Liner
                                            <select class="form-control" v-model="participantes.liner">
                                                <option value="0">-Ninguno-</option>
                                                <option v-for="(liner, index) in liners" :key="index" :value="liner.id">
                                                    {{ liner.nombre + ' ' + liner.apellido }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            Closer 1
                                            <select class="form-control" v-model="participantes.closer1">
                                                <option value="0">-Ninguno-</option>
                                                <option v-for="(closer, index) in closers" :key="index" :value="closer.id">
                                                    {{ closer.nombre + ' ' + closer.apellido }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            Closer 2
                                            <select class="form-control" v-model="participantes.closer2">
                                                <option value="0">-Ninguno-</option>
                                                <option v-for="(closer, index) in closers" :key="index" :value="closer.id">
                                                    {{ closer.nombre + ' ' + closer.apellido }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group col-12">
                                            <b-btn href="#" v-b-toggle.accordion1 variant="success">Regresar</b-btn>
                                            <b-btn href="#" v-b-toggle.accordion3 variant="success" v-if="condicionalidad(2)">Siguiente</b-btn>
                                        </div>
                                    </div>
                                </b-card-body>
                            </b-collapse>
                        </b-card>

                        <b-card no-body class="mb-1" v-if="condicionalidad(2)">
                            <b-card-header header-tag="header" class="p-1" role="tab">
                                <b-btn block href="#" v-b-toggle.accordion3 variant="info">Titular y Cotitular</b-btn>
                            </b-card-header>
                            <b-collapse id="accordion3" accordion="my-accordion" role="tabpanel">
                                <b-card-body>
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <b-btn v-if="invitado.id && contrato.titular != invitado.id && contrato.cotitular != invitado.id" variant="warning" v-on:click="cargarInvitado('titular','invitado')">
                                                Cargar Invitado
                                            </b-btn>
                                            <b-btn v-if="acompanante.id && contrato.titular != acompanante.id && contrato.cotitular != acompanante.id" variant="warning" v-on:click="cargarInvitado('titular','acompanante')">
                                                Cargar Acompa&ntilde;ante
                                            </b-btn>
                                            <b-btn v-if="contrato.titular != 0 || contrato.cotitular != 0" variant="warning" v-on:click="cargarInvitado('titular','otro')">
                                                Otro
                                            </b-btn>
                                        </div>
                                        <div class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Nombre
                                            <input type="text" class="form-control" v-model="titular.nombre" placeholder="Nombre" required>
                                        </div>
                                        <div class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Apellido
                                            <input type="text" class="form-control" v-model="titular.apellido" placeholder="Apellido" required>
                                        </div>
                                        <div class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Email 1
                                            <input type="email" class="form-control" v-model="titular.email" placeholder="eMail">
                                        </div>
                                        <div class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Email 2
                                            <input type="email" class="form-control" v-model="titular.email2" placeholder="eMail">
                                        </div>
                                        <div class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Celular
                                            <input type="number" class="form-control" v-model="titular.celular" v-on:change="limitarChr" placeholder="Celular">
                                        </div>
                                        <div class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Telefono
                                            <input type="number" class="form-control" v-model="titular.telefono" v-on:change="limitarChr" placeholder="Telefono">
                                        </div>
                                        <div class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Profesión
                                            <input type="text" class="form-control" v-model="titular.ocupacion" placeholder="Profesión">
                                        </div>
                                        <div class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Edad
                                            <input type="number" class="form-control" v-model="titular.edad" placeholder="Edad">
                                        </div>
                                        <div class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Estado Civil
                                            <select class="form-control" v-model="titular.estadoCivil">
                                                <option></option>
                                                <option>SOLTERO</option>
                                                <option>CASADO</option>
                                                <option>DIVORCIADO</option>
                                                <option>VIUDO</option>
                                                <option>UNION LIBRE</option>
                                            </select>
                                        </div>

                                        
                                        <div class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Cedula
                                            <input type="number" class="form-control" v-on:change="validarCedula" v-model="titular.cedula" placeholder="Cedula">
                                            <span v-html="alerta.cedula"></span>
                                        </div>
                                        <div class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Pasaporte
                                            <input type="text" class="form-control" v-model="titular.pasaporte" placeholder="Pasaporte">
                                        </div>
                                        <div class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Fecha de nacimiento
                                            <input type="date" class="form-control" v-model="titular.fechaNacimiento" v-on:change="calculaedad">
                                        </div>

                                        <div class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Pais
                                            <select class="form-control" v-model="titular.pais" v-on:change="getEstados">
                                                <option></option>
                                                <option v-for="(pais, index) in paises" :key="index">
                                                    {{ pais.pais }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Provincia
                                            <select class="form-control" v-model="titular.provincia" v-on:change="getCiudades">
                                                <option></option>
                                                <option v-for="(estado, index) in estados" :key="index">
                                                    {{ estado.estado }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Ciudad
                                            <select class="form-control" v-model="titular.ciudad">
                                                <option></option>
                                                <option v-for="(ciudad, index) in ciudades" :key="index">
                                                    {{ ciudad }}
                                                </option>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Direccion
                                            <input type="text" class="form-control" v-model="titular.direccion" placeholder="Direccion">
                                        </div>

                                        <hr class="col-11 mt-1">

                                        <div class="form-check col-12">
                                            <input class="form-check-input" type="checkbox" id="defaultCheck1" v-model="concotitular">
                                            <label class="form-check-label" for="defaultCheck1">
                                                <strong>Cotitular</strong>
                                            </label>
                                        </div>

                                        <hr class="col-11 mt-1">

                                        <div v-if="concotitular" class="form-group col-12">
                                            <b-btn v-if="invitado.id && contrato.titular != invitado.id && contrato.cotitular != invitado.id" variant="warning" v-on:click="cargarInvitado('cotitular','invitado')">
                                                Cargar Invitado
                                            </b-btn>
                                            <b-btn v-if="acompanante.id && contrato.titular != acompanante.id && contrato.cotitular != acompanante.id" variant="warning" v-on:click="cargarInvitado('cotitular','acompanante')">
                                                Cargar Acompa&ntilde;ante
                                            </b-btn>
                                            <b-btn v-if="contrato.cotitular != 0 || contrato.titular != 0" variant="warning" v-on:click="cargarInvitado('cotitular','otro')">
                                                Otro
                                            </b-btn>
                                        </div>

                                        <div v-if="concotitular" class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Nombre
                                            <input type="text" class="form-control" v-model="cotitular.nombre" placeholder="Nombre" required>
                                        </div>
                                        <div v-if="concotitular" class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Apellido
                                            <input type="text" class="form-control" v-model="cotitular.apellido" placeholder="Apellido" required>
                                        </div>
                                        <div v-if="concotitular" class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Email 1
                                            <input type="email" class="form-control" v-model="cotitular.email" placeholder="eMail">
                                        </div>
                                        <div v-if="concotitular" class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Email 2
                                            <input type="email" class="form-control" v-model="cotitular.email2" placeholder="eMail">
                                        </div>
                                        <div v-if="concotitular" class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Celular
                                            <input type="number" class="form-control" v-model="cotitular.celular" v-on:change="limitarChr" placeholder="Celular">
                                        </div>
                                        <div v-if="concotitular" class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Telefono
                                            <input type="number" class="form-control" v-model="cotitular.telefono" v-on:change="limitarChr" placeholder="Telefono">
                                        </div>
                                        <div v-if="concotitular" class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Profesión
                                            <input type="text" class="form-control" v-model="cotitular.ocupacion" placeholder="Profesión">
                                        </div>
                                        <div v-if="concotitular" class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Edad
                                            <input type="number" class="form-control" v-model="cotitular.edad" placeholder="Edad">
                                        </div>
                                        <div v-if="concotitular" class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Estado Civil
                                            <select class="form-control" v-model="cotitular.estadoCivil">
                                                <option></option>
                                                <option>SOLTERO</option>
                                                <option>CASADO</option>
                                                <option>DIVORCIADO</option>
                                                <option>VIUDO</option>
                                                <option>UNION LIBRE</option>
                                            </select>
                                        </div>

                                        
                                        <div v-if="concotitular" class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Cedula
                                            <input type="number" class="form-control" v-on:change="validarCedula" v-model="cotitular.cedula" placeholder="Cedula">
                                            <span v-html="alerta.cedulaA"></span>
                                        </div>
                                        <div v-if="concotitular" class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Pasaporte
                                            <input type="text" class="form-control" v-model="cotitular.pasaporte" placeholder="Pasaporte">
                                        </div>
                                        <div v-if="concotitular" class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Fecha de nacimiento
                                            <input type="date" class="form-control" v-model="cotitular.fechaNacimiento" v-on:change="calculaedad">
                                        </div>
                                        

                                        <div v-if="concotitular" class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Pais
                                            <select class="form-control" v-model="cotitular.pais" v-on:change="getEstados2">
                                                <option></option>
                                                <option v-for="(pais, index) in paises" :key="index">
                                                    {{ pais.pais }}
                                                </option>
                                            </select>
                                        </div>
                                        <div v-if="concotitular" class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Provincia
                                            <select class="form-control" v-model="cotitular.provincia" v-on:change="getCiudades2">
                                                <option></option>
                                                <option v-for="(estado, index) in estados2" :key="index">
                                                    {{ estado.estado }}
                                                </option>
                                            </select>
                                        </div>
                                        <div v-if="concotitular" class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Ciudad
                                            <select class="form-control" v-model="cotitular.ciudad">
                                                <option></option>
                                                <option v-for="(ciudad, index) in ciudades2" :key="index">
                                                    {{ ciudad }}
                                                </option>
                                            </select>
                                        </div>
                                        
                                        <div v-if="concotitular" class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Direccion
                                            <input type="text" class="form-control" v-model="cotitular.direccion" placeholder="Direccion">
                                        </div>
                                        

                                        <hr class="col-11 mt-1">
                                        <div class="form-group col-12">
                                            <b-btn href="#" v-b-toggle.accordion2 variant="success">Regresar</b-btn>
                                            <b-btn href="#" v-b-toggle.accordion4 v-if="condicionalidad(3)" variant="success">Siguiente</b-btn>
                                        </div>
                                    </div>
                                </b-card-body>
                            </b-collapse>
                        </b-card>

                        <b-card no-body class="mb-1" v-if="condicionalidad(3)">
                            <b-card-header header-tag="header" class="p-1" role="tab">
                                <b-btn block href="#" v-b-toggle.accordion4 variant="info">Portafolio de Servicios</b-btn>
                            </b-card-header>
                            <b-collapse id="accordion4" accordion="my-accordion" role="tabpanel">
                                <b-card-body>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                <center>
                                                                    P. Nacional
                                                                </center>
                                                            </th>
                                                            <th>
                                                                <center>
                                                                    P. Internacional
                                                                </center>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <b-btn v-on:click="seleccionaServicio(1);">Ninguno</b-btn>
                                                                <b-btn v-on:click="seleccionaServicio(2);">Todos</b-btn>
                                                                <br>
                                                                <b-form-checkbox-group v-model="misServicios" :options="servicios1">
                                                                </b-form-checkbox-group>
                                                            </td>
                                                            <td>
                                                                <b-btn v-on:click="seleccionaServicio(3);">Ninguno</b-btn>
                                                                <b-btn v-on:click="seleccionaServicio(4);">Todos</b-btn>
                                                                <br>
                                                                <b-form-checkbox-group v-model="misServicios" :options="servicios2">
                                                                </b-form-checkbox-group>
                                                                
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>                                        
                                        <div class="form-group col-12">
                                            <b-btn href="#" v-b-toggle.accordion3 variant="success">Regresar</b-btn>
                                            <b-btn href="#" v-b-toggle.accordion5 variant="success">Siquiente</b-btn>
                                        </div>
                                    </div>
                                </b-card-body>
                            </b-collapse>
                        </b-card>

                        <b-card no-body class="mb-1" v-if="condicionalidad(3)">
                            <b-card-header header-tag="header" class="p-1" role="tab">
                                <b-btn block href="#" v-b-toggle.accordion5 variant="info">Bonos</b-btn>
                            </b-card-header>
                            <b-collapse id="accordion5" accordion="my-accordion" role="tabpanel">
                                <b-card-body>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                <center>Bono</center>
                                                            </th>
                                                            <th>
                                                                <center>Cantidad</center>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="(bono, index) in misBonos" :key="index">
                                                            <td>
                                                                {{ bono.bono }}
                                                            </td>
                                                            <td>
                                                                <div class="form-group">
                                                                    <input class="form-control" type="number" step="1" v-model="bono.cantidad" v-on:keyup="maxiBonos(index)" v-on:change="maxiBonos(index)">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                                                                
                                        <div class="form-group col-12">
                                            <b-btn href="#" v-b-toggle.accordion4 variant="success">Regresar</b-btn>
                                            <b-btn href="#" v-b-toggle.accordion6 variant="success">Siquiente</b-btn>
                                        </div>
                                    </div>
                                </b-card-body>
                            </b-collapse>
                        </b-card>

                        <b-card no-body class="mb-1" v-if="condicionalidad(3)">
                            <b-card-header header-tag="header" class="p-1" role="tab">
                                <b-btn block href="#" v-b-toggle.accordion6 variant="info">Detalles del Contrato</b-btn>
                            </b-card-header>
                            <b-collapse id="accordion6" accordion="my-accordion" role="tabpanel">
                                <b-card-body>
                                    <div class="row">
                                        <div class="col-12">
                                            <strong>Valor del Contrato ${{ contrato.valorContrato }}</strong>
                                        </div>
                                        <div class="form-group col-lg-3 col-md-4 col-6">

                                            
                                           A&ntilde;os Otorgados
                                            <input class="form-control" type="number" step="1" v-model="contrato.anosOtorgados">
                                            
                                            

                                        <!--Noches por Años modificado jesus diaz
                                            <select class="form-control" v-model="contrato.anosOtorgados" required="yes">
                                                <option>7</option>
                                                <option>14</option>
                                                <option>21</option>
                                                <option>29</option>
                                                <option>36</option>
                                                <option>43</option>
                                                <option>50</option>
                                            </select>-->
                                            
                                        </div>
                                        <div class="form-group col-lg-3 col-md-4 col-6">
                                            A&ntilde;os Pactados
                                            <input class="form-control" type="number" step="1" v-model="contrato.anosPactados" @change="calcularValorContrato">
                                        </div>
                                        <div class="form-group col-lg-3 col-md-4 col-6">
                                           Noches por A&ntilde;o
                                            <select class="form-control" v-model="contrato.noches" required="yes">
                                                <option>7</option>
                                                <option>14</option>
                                                <option>21</option>
                                                <option>29</option>
                                                <option>36</option>
                                                <option>43</option>
                                                <option>50</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-3 col-md-4 col-6">
                                            Beneficiarios
                                            <input class="form-control" type="number" step="1" v-model="contrato.beneficiarios">
                                        </div>
                                        
                                        <div class="form-group col-lg-3 col-md-4 col-6">
                                            Boording Card
                                            <input class="form-control" type="number" step="1" v-model="contrato.boordingCard" @change="calcularValorContrato">
                                        </div>
                                        <div class="form-group col-lg-3 col-md-4 col-6">
                                            Otros Servicios
                                            <input class="form-control" type="number" step="0.01" v-model="contrato.otrosServicios" @change="calcularValorContrato">
                                        </div>
                                        <div class="form-group col-lg-3 col-md-4 col-6">
                                            <input type="checkbox" v-model="gastoLegal" value="1" @change="calcularValorContrato" v-on:click="calcularValorContrato">
                                                Gasto legal
                                        </div>
                                        <div class="form-group col-lg-3 col-md-4 col-6">
                                            <input type="checkbox" v-model="xpack" value="1" @change="calcularValorContrato" v-on:click="calcularValorContrato">
                                                Xpack
                                        </div>
                                        <div class="form-group col-lg-3 col-md-4 col-6">
                                            <input type="checkbox" v-model="servicioInternacional" value="1" @change="calcularValorContrato" v-on:click="calcularValorContrato">
                                                Servicio Internacional
                                        </div>
                                        <div class="form-group col-lg-3 col-md-4 col-6">
                                            <input type="checkbox" v-model="club" value="1" @change="calcularValorContrato" v-on:click="calcularValorContrato">
                                                Club
                                        </div>

                                        <hr class="col-11">

                                        <div class="col-12">
                                            <strong>Pago Inicial</strong>
                                        </div>
                                        <div class="form-group col-5">
                                            Cuota Inicial
                                            <input class="form-control" type="number" step="0.01" v-model="contrato.cuotaInicial" @change="calcularSaldos">
                                        </div>
                                        <div class="form-group col-5">
                                            Pago Inicial
                                            <input class="form-control" disabled type="number" step="0.01" v-model="contrato.pagoInicial">
                                        </div>
                                        <div class="form-group col-2">
                                            <b-btn v-on:click="showModal" v-b-tooltip.hover title="Agregar/Editar Pagos">
                                                <font-awesome-icon icon="dollar-sign"></font-awesome-icon>
                                            </b-btn>
                                            <b-modal ref="myModal" hide-footer title="Agregar/Editar Pagos">
                                                <div role="tablist">
                                                    <b-card no-body class="mb-1">
                                                        <b-card-header header-tag="header" class="p-1" role="tab">
                                                            <b-btn block href="#" v-b-toggle.accordionx1 variant="info">Agregar Pago</b-btn>
                                                        </b-card-header>
                                                        <b-collapse id="accordionx1" visible accordion="my-accordionx" role="tabpanel">
                                                            <b-card-body>
                                                                <div class="row">
                                                                    <div class="form-group col-sm-6">
                                                                        Tipo
                                                                        <select class="form-control" v-model="pagoN.tipo">
                                                                            <option>EFECTIVO</option>
                                                                            <option>DEPOSITO</option>
                                                                            <option>TRANSFERENCIA</option>
                                                                            <option>CHEQUE</option>
                                                                            <option>TARJETA</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group col-sm-6">
                                                                        Valor
                                                                        <input type="number" step="0.01" class="form-control" v-model="pagoN.valor">
                                                                    </div>
                                                                    <div class="form-group col-sm-6" v-if="pagoN.tipo != 'EFECTIVO'">
                                                                        Banco
                                                                        <input type="text" placeholder="Banco" class="form-control" v-model="pagoN.banco">
                                                                    </div>
                                                                    <div class="form-group col-sm-6" v-if="pagoN.tipo != 'EFECTIVO' && pagoN.tipo != 'TARJETA'">
                                                                        Numero
                                                                        <input type="text" placeholder="Numero" class="form-control" v-model="pagoN.numero">
                                                                    </div>
                                                                    <div class="form-group col-sm-6" v-if="pagoN.tipo == 'TARJETA'">
                                                                        Diferido
                                                                        <input type="text" placeholder="Diferido" class="form-control" v-model="pagoN.diferido">
                                                                    </div>
                                                                    <div class="form-group col-sm-6" v-if="pagoN.tipo == 'TARJETA'">
                                                                        Autorizacion
                                                                        <input type="text" placeholder="Autorizacion" class="form-control" v-model="pagoN.autorizacion">
                                                                    </div>
                                                                    <div class="form-group col-sm-6" v-if="pagoN.tipo == 'TARJETA'">
                                                                        Lote
                                                                        <input type="text" placeholder="Lote" class="form-control" v-model="pagoN.lote">
                                                                    </div>
                                                                    <div class="form-group col-sm-6" v-if="pagoN.tipo == 'TARJETA'">
                                                                        Tarjeta
                                                                        <select class="form-control" v-model="pagoN.tarjeta">
                                                                            <option>VISA</option>
                                                                            <option>MASTER CARD</option>
                                                                            <option>ALIA</option>
                                                                            <option>DISCOVER</option>
                                                                            <option>AMERICAN</option>
                                                                            <option>AMERICAN EXPRES</option>
                                                                            <option>DINNERS CLUB</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group col-12">
                                                                        <b-btn v-on:click="agregarPago">Guardar</b-btn>
                                                                    </div>
                                                                </div>
                                                            </b-card-body>
                                                        </b-collapse>
                                                    </b-card>
                                                    
                                                    <b-card no-body class="mb-1">
                                                        <b-card-header header-tag="header" class="p-1" role="tab">
                                                            <b-btn block href="#" v-b-toggle.accordionx2 variant="info">Ver/Eliminar Pagos</b-btn>
                                                        </b-card-header>
                                                        <b-collapse id="accordionx2" accordion="my-accordionx" role="tabpanel">
                                                            <b-card-body>
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div v-for="(pago, index) in pagos" :key="index" class="card">
                                                                            <div class="card-body">
                                                                                ${{ pago.valor + ' en ' + pago.tipo + '. ' }}
                                                                                <span v-if="pago.tipo != 'EFECTIVO'">
                                                                                    Banco: {{ pago.banco }}.
                                                                                    <span v-if="pago.tipo != 'TARJETA'">
                                                                                        Numero: {{ pago.numero }}.
                                                                                    </span>
                                                                                    <span v-else>
                                                                                        Tarjeta: {{ pago.tarjeta }}.
                                                                                        Diferido: {{ pago.diferido }}.
                                                                                        Lote: {{ pago.lote }}.
                                                                                        Autorizacion: {{ pago.autorizacion }}.
                                                                                    </span>
                                                                                </span>
                                                                                <b-btn variant="danger" v-on:click="borrarPago(index)">Eliminar</b-btn>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </b-card-body>
                                                        </b-collapse>
                                                    </b-card>
                                                </div>
                                            </b-modal>
                                        </div>
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <span v-if="total_efectivo > 0">
                                                        Efectivo:      ${{ total_efectivo }}
                                                        <br>
                                                    </span> 
                                                    <span v-if="total_cheque > 0">
                                                        Cheque:        ${{ total_cheque }}
                                                        <br>
                                                    </span> 
                                                    <span v-if="total_deposito > 0">
                                                        Deposito:      ${{ total_deposito }}
                                                        <br>
                                                    </span> 
                                                    <span v-if="total_transferencia > 0">
                                                        Transferencia: ${{ total_transferencia }}
                                                        <br>
                                                    </span> 
                                                    <span v-if="total_tarjeta > 0">
                                                        Tarjeta:       ${{ total_tarjeta }}
                                                        <br>
                                                    </span> 
                                                    <hr v-if="total > 0">
                                                    Total:         ${{ total }}
                                                </div>
                                            </div>
                                        </div>
                                        

                                        <hr class="col-11">

                                        <div class="col-md-6">
                                            <div class="card">
                                                <div class="card-body">
                                                    <strong>Finanaciar Saldo Inicial ${{ contrato.saldoInicial }}</strong>
                                                    <div class="row">
                                                        <div class="form-goup col-sm-6">
                                                            Numero de Cuotas
                                                            <input class="form-control" type="number" step="1" v-model="contrato.numeroCuotasIniciales" @change="calcularCuotas1">
                                                        </div>
                                                        <div class="form-goup col-sm-6">
                                                            Fecha Primer Pago
                                                            <input class="form-control" type="date" v-model="contrato.fechaPagoInicial" @change="calcularCuotas1">
                                                        </div>
                                                        
                                                        <div class="col-12">
                                                        <b-btn block v-b-toggle.collapsexx1 variant="secondary">Cuotas Saldo Inicial</b-btn>
                                                            <b-collapse id="collapsexx1" class="mt-2">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="table-responsive">
                                                                            <table class="table table-striped">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>
                                                                                            <center>Cuota</center>
                                                                                        </th>
                                                                                        <th>
                                                                                            <center>Fecha de Pago</center>
                                                                                        </th>
                                                                                        <th>
                                                                                            <center>Valor</center>
                                                                                        </th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr v-for="(cuota, index) in cuotas1" :key="index">
                                                                                        <td>
                                                                                            <strong>
                                                                                                {{ index+1 }}
                                                                                            </strong>
                                                                                        </td>
                                                                                        <td>
                                                                                            <input type="date" class="form-control" v-model="cuota.fecha">
                                                                                        </td>
                                                                                        <td>
                                                                                            <input type="number" step="0.01" style="width: 75px;" v-model="cuota.valor" v-on:change="recalcularCuotas1(index)">
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </b-collapse>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        
                                        <div class="col-md-6">
                                            <div class="card">
                                                <div class="card-body">
                                                    <strong>Finanaciar Saldo Restante ${{ contrato.saldoFinanciado }}</strong>
                                                    <div class="row">
                                                        <div class="form-goup col-sm-6">
                                                            Numero de Cuotas
                                                            <input class="form-control" type="number" step="1" v-model="contrato.numeroCuotasFinanciado" @change="calcularCuotas2">
                                                        </div>
                                                        <div class="form-goup col-sm-6">
                                                            Fecha Primer Pago
                                                            <input class="form-control" type="date" v-model="contrato.fechaPagoFinanciado" @change="calcularCuotas2">
                                                        </div>
                                                        
                                                        <div class="col-12">
                                                        <b-btn block v-b-toggle.collapsexx2 variant="secondary">Cuotas Saldo Restante</b-btn>
                                                            <b-collapse id="collapsexx2" class="mt-2">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="table-responsive">
                                                                            <table class="table table-striped">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>
                                                                                            <center>Cuota</center>
                                                                                        </th>
                                                                                        <th>
                                                                                            <center>Fecha de Pago</center>
                                                                                        </th>
                                                                                        <th>
                                                                                            <center>Valor</center>
                                                                                        </th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr v-for="(cuota, index) in cuotas2" :key="index">
                                                                                        <td>
                                                                                            <strong>
                                                                                                {{ index+1 }}
                                                                                            </strong>
                                                                                        </td>
                                                                                        <td>
                                                                                            <input type="date" class="form-control" v-model="cuota.fecha">
                                                                                        </td>
                                                                                        <td>
                                                                                            <input type="number" style="width: 75px;" step="0.01" v-model="cuota.valor" v-on:change="recalcularCuotas2(index)">
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </b-collapse>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <hr class="col-11">

                                        <div class="form-group col-12">
                                            <b-btn href="#" v-b-toggle.accordion5 variant="success">Regresar</b-btn>
                                            <b-btn href="#" v-b-toggle.accordion7 variant="success">Siquiente</b-btn>
                                        </div>
                                    </div>
                                </b-card-body>
                            </b-collapse>
                        </b-card>

                        <b-card no-body class="mb-1" v-if="contrato.valorContrato > 0">
                            <b-card-header header-tag="header" class="p-1" role="tab">
                                <b-btn block href="#" v-b-toggle.accordion7 variant="info">Finalizar</b-btn>
                            </b-card-header>
                            <b-collapse id="accordion7" accordion="my-accordion" role="tabpanel">
                                <b-card-body>
                                    <div class="row">
                                        <div class="form.group  col-12">
                                            Comentario
                                            <textarea class="form-control" v-model="comentario.comentario" placeholder="Comentario" rows="4"></textarea>
                                        </div>
                                        <div class="form-group col-12">
                                            <b-btn href="#" v-b-toggle.accordion6 variant="success">Regresar</b-btn>
                                            <b-btn variant="danger" v-on:click="crearContrato">Finalizar</b-btn>
                                        </div>
                                    </div>
                                </b-card-body>
                            </b-collapse>
                        </b-card>
                    </div>

                </div>
            </div>
        </div>
        <div class="card-body" v-else-if="creandoContrato">
            <div class="row">
                <div class="col-12">
                    <center>
                        <strong>Creando Contrato</strong>
                        <hr>
                        <b-progress :value="progresoCon" :max="100" show-progress animated></b-progress>
                    </center>
                </div>
            </div>
        </div>
        <div class="card-body" v-else-if="creadoContrato">
            <div class="row">
                <div class="col-12">
                    <center>
                        <strong>Contrato Creado</strong>
                        <hr>
                        <a :href="destino + '/contratos'" class="btn btn-secondary m-1">Ir a contratos</a>
                        <a :href="destino + '/vercontrato/' + contrato.id" class="btn btn-primary m-1">Ver contrato {{ contrato.sede+contrato.consecutivo }}</a>
                        <a :href="destino + '/pdfcontrato/' + contrato.id" class="btn btn-primary m-1" target="_blank">
                            <font-awesome-icon icon="file-pdf"></font-awesome-icon>
                        </a>
                    </center>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['base','cliente','destino'],
    data() {
        return {
            alerta: {
                tmk: '',
                cedula: '',
                cedulaA: ''
            },

            creandoContrato: false,
            creadoContrato: false,
            progresoCon: 0,

            sedes: [],
            paises: [],
            estados: [],
            estados2: [],
            ciudades: [],
            ciudades2: [],
            globales: [],

            comentario: {
                comentario: '',
                lugar:'CONTRATO'
            },

            total_efectivo: 0,
            total_cheque: 0,
            total_deposito: 0,
            total_transferencia: 0,
            total_tarjeta: 0,
            total: 0,

            pagos: [],
            pagoN: {
                tipo: 'EFECTIVO',
                valor: 0,
                banco: '',
                tarjeta: '',
                diferido: '',
                autorizacion: '',
                lote: '',
                numero: ''
            },
            gastoLegal: [],
            xpack: [],
            servicioInternacional: [],
            club: [],
            
            invitado: {},
            acompanante: {},

            contrato: {
                tmk: '',
                sede: '',
                ciudadSede: '',

                fechaPagoInicial: '',

                titular: 0,
                cotitular: 0,

                anosOtorgados: 0,
                anosPactados: 0,
                gastoLegal: 0,
                xpack: 0,
                servicioInternacional: 0,
                boordingCard: 0,
                valorContrato: 0,
                cuotaInicial: 0,
                pagoInicial: 0,
                saldoInicial: 0,
                numeroCuotasIniciales: 0,
                saldoFinanciado: 0,
                fechaPagoFinanciado: '',
                numeroCuotasFinanciado: 0,
                beneficiarios: 0,
                noches: 0,
                club: 0,
                factura: '',
                otrosServicios: 0
            }, 

            //////////////
            liners: [],
            jefes_sala: [],
            closers: [],
            cargos: {
                liner: 0,
                jefe_sala: 0,
                closer: 0
            },
            participantes: {
                liner: 0,
                jefe_sala: 0,
                closer1: 0,
                closer2: 0
            },
            ////////
            titular: {
                tipo: 2,

                sede: '',

                acompanante: 0,

                nombre: '',
                edad: '',
                apellido: '',
                cedula: '',
                pasaporte: '',
                celular: '',
                telefono: '',
                email: '',
                email2: '',
                pais: '',
                provincia: '',
                ciudad: '',
                direccion: '',
                estadoCivil: '',
                ocupacion: '',
                fechaNacimiento: '',
            },

            concotitular: false,

            cotitular: {
                tipo: 2,

                sede: '',

                acompanante: 0,

                nombre: '',
                edad: '',
                apellido: '',
                cedula: '',
                pasaporte: '',
                celular: '',
                telefono: '',
                email: '',
                email2: '',
                pais: '',
                provincia: '',
                ciudad: '',
                direccion: '',
                estadoCivil: '',
                ocupacion: '',
                fechaNacimiento: '',
            },

            ///////////////////
            nadaSN: false,
            nadaSiN: false,
            todoSN: false,
            todoSiN: false,

            servicios1: [],
            servicios2: [],
            misServicios: [],
            /////////////////
            bonos: [],
            misBonos: [],
            bonoN: {
                bonoId: 0,
                bono: '',
                cantidad: 0,
                dias:0,
                noches:0,
                personas:0,
                tipo: 0
            },

            //////////
            cuotas1: [],
            cuotas2: [],
            cuotaN: {
                contrato_id: 0,
                tipo: 1,
                valor: 0,
                saldo: 0,
                pagado: 0,
                fecha: '',
            }
        }
    },
    mounted() {
        this.getSedes();
        this.getBonos();
        this.getServicios();
        this.getPaises();
        this.getGlobales();

        this.getEmpleados('CLOSER');
        this.getEmpleados('LINER');
        this.getEmpleados('JEFE DE SALA');

        if (this.cliente > 0) {
            this.getParticipantes();
            this.getInvitado();
        }
    },  
    methods: {
        maxiBonos(index){
            let varb = 0;
            var vg = this.globales[6].valor;

            for (let i = 0; i < this.misBonos.length; i++) {
                if (this.misBonos[i].tipo == 0) {
                    varb = parseInt(varb) + parseInt(this.misBonos[i].cantidad);
                }
            }

            if (varb > vg && this.misBonos[index].bono != 'SALINAS' && this.misBonos[index].tipo == 0) {
                this.misBonos[index].cantidad = 0;
            }
        },
        limitarChr(){
            this.titular.celular = (this.titular.celular + '').substring(0,10);
            this.titular.telefono = (this.titular.telefono + '').substring(0,9);
            this.cotitular.celular = (this.cotitular.celular + '').substring(0,10);
            this.cotitular.telefono = (this.cotitular.telefono + '').substring(0,9);
        },
        validarCedula(){
            if (this.titular.cedula == '' || this.titular.cedula == null) {
                this.alerta.cedula = '';
            }else{
                if (this.titular.cedula.length != 10) {
                    this.alerta.cedula = '<span class="text-danger">Cedula Invalida</span>';
                } else {
                    let x = 0;
                    for (let i = 0; i < 9; i++) {
                        if (i%2 == 0) {
                            x = x + parseInt(this.titular.cedula[i]);
                        
                            if (parseInt(this.titular.cedula[i]) > 4) {
                                x = x - 9;
                            }
                        }
                        x = x + parseInt(this.titular.cedula[i]);
                    }

                    if (10 - (x%10) == parseInt(this.titular.cedula[9])) {
                        this.alerta.cedula = '<span class="text-success">Cedula Valida</span>';
                    }else{
                        this.alerta.cedula = '<span class="text-danger">Cedula Invalida</span>';
                    }

                    if (parseInt(this.titular.cedula[9]) == 0 && x%10 == 0) {
                        this.alerta.cedula = '<span class="text-success">Cedula Valida</span>';
                    }
                }
            }

            if (this.cotitular.cedula == '' || this.cotitular.cedula == null) {
                this.alerta.cedulaA = '';
            }else{
                if (this.cotitular.cedula.length != 10) {
                    this.alerta.cedulaA = '<span class="text-danger">Cedula Invalida</span>';
                } else {
                    let x = 0;
                    for (let i = 0; i < 9; i++) {
                        if (i%2 == 0) {
                            x = x + parseInt(this.cotitular.cedula[i]);
                        
                            if (parseInt(this.cotitular.cedula[i]) > 4) {
                                x = x - 9;
                            }
                        }
                        x = x + parseInt(this.cotitular.cedula[i]);
                    }

                    if (10 - (x%10) == parseInt(this.cotitular.cedula[9])) {
                        this.alerta.cedulaA = '<span class="text-success">Cedula Valida</span>';
                    }else{
                        this.alerta.cedulaA = '<span class="text-danger">Cedula Invalida</span>';
                    }

                    if (parseInt(this.cotitular.cedula[9]) == 0 && x%10 == 0) {
                        this.alerta.cedulaA = '<span class="text-success">Cedula Valida</span>';
                    }
                }
            }
        },
        calculaedad(){
            this.titular.edad = moment().diff(this.titular.fechaNacimiento, 'years',false);
            this.cotitular.edad = moment().diff(this.cotitular.fechaNacimiento, 'years',false);
        },
        existeTmk(){
            axios.get(this.base + '/getTmk/' + this.contrato.tmk).then((res) => {
                if (res.data.length > 0) {
                    this.alerta.tmk = '<span class="text-success">Codigo confirmado .</span>';
                }else{
                    this.alerta.tmk = '<span class="text-danger">Codigo no existe.</span>';
                }
            }).catch((err) => {
                console.log(err);
            });
        },
        recalcularCuotas2(index){
            var n = parseFloat(this.contrato.numeroCuotasFinanciado) - parseFloat(1) - parseFloat(index);
            var s = parseFloat(this.contrato.saldoFinanciado);

            var total1 = 0.00;

            for (let i = 0; i < index; i++) {
                total1 = parseFloat(total1) + parseFloat(this.cuotas2[i].valor);
            }
            
            this.cuotas2[index].saldo = this.cuotas2[index].valor;

            if (parseFloat(total1) + parseFloat(this.cuotas2[index].valor) >= parseFloat(s)) {
                this.cuotas2[index].valor = parseFloat(s) - parseFloat(total1);
                this.cuotas2[index].saldo = this.cuotas2[index].valor;
                
                for (let i = parseInt(index) + 1; i < this.cuotas2.length; i++) {
                    this.cuotas2[i].valor = 0.00;
                    this.cuotas2[i].saldo = this.cuotas2[i].valor;
                }
            } else {
                var s2 = parseFloat(s) - parseFloat(total1) - parseFloat(this.cuotas2[index].valor);
            
                var c = parseFloat((s2/n).toFixed(2));
                var x = parseFloat(s2) - parseFloat(c*n) + parseFloat(c);
                x = x.toFixed(2);
                c = c.toFixed(2);

                for (let i = parseInt(index) + 1; i < this.cuotas2.length - 1; i++) {
                    this.cuotas2[i].valor = c;
                    this.cuotas2[i].saldo = this.cuotas2[i].valor;
                }

                this.cuotas2[this.cuotas2.length - 1].valor = x;
                this.cuotas2[this.cuotas2.length - 1].saldo = this.cuotas2[this.cuotas2.length - 1].valor;
            }
        },
        recalcularCuotas1(index){
            var n = parseFloat(this.contrato.numeroCuotasIniciales) - parseFloat(1) - parseFloat(index);
            var s = parseFloat(this.contrato.saldoInicial);

            var total1 = 0.00;

            for (let i = 0; i < index; i++) {
                total1 = parseFloat(total1) + parseFloat(this.cuotas1[i].valor);
            }
            
            this.cuotas1[index].saldo = this.cuotas1[index].valor;

            if (parseFloat(total1) + parseFloat(this.cuotas1[index].valor) >= parseFloat(s)) {
                this.cuotas1[index].valor = parseFloat(s) - parseFloat(total1);
                this.cuotas1[index].saldo = this.cuotas1[index].valor;
                for (let i = parseInt(index) + 1; i < this.cuotas1.length; i++) {
                    this.cuotas1[i].valor = 0.00;
                    this.cuotas1[i].saldo = this.cuotas1[i].valor;
                }
            } else {
                var s2 = parseFloat(s) - parseFloat(total1) - parseFloat(this.cuotas1[index].valor);
            
                var c = parseFloat((s2/n).toFixed(2));
                var x = parseFloat(s2) - parseFloat(c*n) + parseFloat(c);
                x = x.toFixed(2);
                c = c.toFixed(2);

                for (let i = parseInt(index) + 1; i < this.cuotas1.length - 1; i++) {
                    this.cuotas1[i].valor = c;
                    this.cuotas1[i].saldo = this.cuotas1[i].valor;
                }

                this.cuotas1[this.cuotas1.length - 1].valor = x;
                this.cuotas1[this.cuotas1.length - 1].saldo = this.cuotas1[this.cuotas1.length - 1].valor;
            }
        },
        crearContrato(){
            var completo = true;
            var biencreado = true;
            this.creandoContrato = true;

            var titularId = this.titular.id;
            var cotitularId = this.cotitular.id;

            if (completo) {
                if (!this.titular.id || this.titular.id == 0) {
                    axios.post(this.base + '/clientes', this.titular).then((res) => {
                        this.titular = res.data;
                        titularId = res.data.id;
                    }).catch((err) => {
                        biencreado = false;
                        console.log(err);
                    });
                }else{
                    this.titular.tipo = 2;
                    axios.put(this.base + '/clientes/' + this.titular.id, this.titular).then((res) => {
                        this.titular = res.data;
                        titularId = res.data.id;
                    }).catch((err) => {
                        biencreado = false;
                        console.log(err);
                    });
                }
                this.progresoCon = 12;

                if (this.concotitular) {
                    if (!this.cotitular.id) {
                        axios.post(this.base + '/clientes', this.cotitular).then((res) => {
                            this.cotitular = res.data;
                            cotitularId = res.data.id;
                        }).catch((err) => {
                            biencreado = false;
                            console.log(err);
                        });
                    }else{                    
                        this.cotitular.tipo = 2;
                        axios.put(this.base + '/clientes/' + this.cotitular.id, this.cotitular).then((res) => {
                            this.cotitular = res.data;
                            cotitularId = res.data.id;
                        }).catch((err) => {
                            biencreado = false;
                            console.log(err);
                        });
                    }
                }
                this.contrato.cotitular = cotitularId;

                this.contrato.titular = titularId;

                this.progresoCon = 25;

                if (titularId > 0 && (!this.concotitular || (cotitularId > 0 && this.concotitular))) {
                    
                    if (this.invitado.id) {
                        axios.get(this.base + '/intercambiarParticipantes/' + this.invitado.id + '/' + titularId).then((res) => {
                            if(this.participantes.liner != 0 && this.cargos.liner != 0){
                                let participa = {
                                    empleado_id: this.participantes.liner,
                                    cargo_id: this.cargos.liner
                                };
                                axios.post(this.base + '/participantes/' + this.titular.id, participa).then((res2) => {
                                    
                                }).catch((err) => {
                                    biencreado = false;
                                    console.log(err);
                                });
                            }
                            if(this.participantes.jefe_sala != 0 && this.cargos.jefe_sala != 0){
                                let participa = {
                                    empleado_id: this.participantes.jefe_sala,
                                    cargo_id: this.cargos.jefe_sala
                                };
                                axios.post(this.base + '/participantes/' + this.titular.id, participa).then((res2) => {
                                    
                                }).catch((err) => {
                                    console.log(err);
                                });
                            }
                            if(this.participantes.closer1 != 0 && this.cargos.closer != 0){
                                let participa = {
                                    empleado_id: this.participantes.closer1,
                                    cargo_id: this.cargos.closer
                                };
                                axios.post(this.base + '/participantes/' + this.titular.id, participa).then((res2) => {
                                    
                                }).catch((err) => {
                                    console.log(err);
                                });
                            }
                            if(this.participantes.closer2 != 0 && this.cargos.closer != 0){
                                let participa = {
                                    empleado_id: this.participantes.closer2,
                                    cargo_id: this.cargos.closer
                                };
                                axios.post(this.base + '/participantes/' + this.titular.id, participa).then((res2) => {
                                    
                                }).catch((err) => {
                                    console.log(err);
                                });
                            }
                        }).catch((err) => {
                            biencreado = false;
                            console.log(err);
                        });
                    }else{
                        if(this.participantes.liner != 0 && this.cargos.liner != 0){
                            let participa = {
                                empleado_id: this.participantes.liner,
                                cargo_id: this.cargos.liner
                            };
                            axios.post(this.base + '/participantes/' + this.titular.id, participa).then((res2) => {
                                
                            }).catch((err) => {
                                biencreado = false;
                                console.log(err);
                            });
                        }
                        if(this.participantes.jefe_sala != 0 && this.cargos.jefe_sala != 0){
                            let participa = {
                                empleado_id: this.participantes.jefe_sala,
                                cargo_id: this.cargos.jefe_sala
                            };
                            axios.post(this.base + '/participantes/' + this.titular.id, participa).then((res2) => {
                                
                            }).catch((err) => {
                                console.log(err);
                            });
                        }
                        if(this.participantes.closer1 != 0 && this.cargos.closer != 0){
                            let participa = {
                                empleado_id: this.participantes.closer1,
                                cargo_id: this.cargos.closer
                            };
                            axios.post(this.base + '/participantes/' + this.titular.id, participa).then((res2) => {
                                
                            }).catch((err) => {
                                console.log(err);
                            });
                        }
                        if(this.participantes.closer2 != 0 && this.cargos.closer != 0){
                            let participa = {
                                empleado_id: this.participantes.closer2,
                                cargo_id: this.cargos.closer
                            };
                            axios.post(this.base + '/participantes/' + this.titular.id, participa).then((res2) => {
                                
                            }).catch((err) => {
                                console.log(err);
                            });
                        }
                    }


                    this.progresoCon = 35;
    
                    let upbonos = {
                        bonos: this.misBonos
                    };
    
                    let upServicios = {
                        servicios: this.misServicios
                    };
    
                    let upCuotas = {
                        cuotas: this.cuotas1.concat(this.cuotas2)
                    };
    
                    if (titularId != 0) {
                        axios.post(this.base + '/contratos',this.contrato).then((res) => {
                            this.contrato = res.data;
    
                            axios.post(this.base + '/comentarios/' + res.data.titular, this.comentario).then((res2) => {
                                this.comentario = res2.data;
                                console.log('comentario ag');
                            }).catch((err) => {
                                biencreado = false;
                                console.log(err);
                            });
                            this.progresoCon = 42;
                            axios.get(this.base + '/estadocontratos/' + res.data.id).then((res2) => {
                            
                            }).catch((err) => {
                                biencreado = false;
                                console.log(err);
                            });
                            this.progresoCon = 47;
    
                            
                            axios.post(this.base + '/contratobono/' + res.data.id, upbonos).then((res2) => {
                                console.log('bonos ag');
                            }).catch((err) => {
                                biencreado = false;
                                console.log(err);
                            });
                            this.progresoCon = 59;
                            
                            axios.post(this.base + '/contratoservicio/' + res.data.id, upServicios).then((res2) => {
                                console.log('servicios ag');
                            }).catch((err) => {
                                biencreado = false;
                                console.log(err);
                            });
                            this.progresoCon = 71;
    
                            axios.post(this.base + '/contratocuota/' + res.data.id, upCuotas).then((res2) => {
                                console.log('cuotas ag');
                            }).catch((err) => {
                                console.log(err);
                            });   
                            this.progresoCon = 90;
                            
                            for (let i = 0; i < this.pagos.length; i++) {
                                axios.post(this.base + '/contratopago/' + res.data.id, this.pagos[i]).then((res2) => {
                                    this.pagos[i] = res2.data;
                                    console.log('pago ag' + i);
                                }).catch((err) => {
                                    biencreado = false;
                                    console.log(err);
                                });   
                                this.progresoCon = 83 + i;
                            };
                            
                        }).catch((err) => {
                            biencreado = false;
                            console.log(err);
                        });
                    }      
                    this.progresoCon = 100;
    
                    this.creandoContrato = false;
    
                    if (biencreado) {
                        this.creadoContrato = true;
                    }else{
                        Toastr.error('Existe un error en la creacion del contrato');
                    }          
                }else{     
                    this.creandoContrato = false;
                    Toastr.error('COMPROBACION. Si esta seguro de que los datos ingresados son correctos, presione finalizar otra vez.');
                } 

            }else{
                this.creandoContrato = false;
            }
        },
        calcularCuotas1(){
            var n = parseFloat(this.contrato.numeroCuotasIniciales);
            var f = moment(this.contrato.fechaPagoInicial);
            var s = parseFloat(this.contrato.saldoInicial);

            var c = parseFloat((s/n).toFixed(2));
            var x = parseFloat(s) - parseFloat(c*n) + parseFloat(c);
            x = x.toFixed(2);
            c = c.toFixed(2);

            this.cuotas1 = [];

            if (n>0) {
                this.cuotas1.push({
                        contrato_id: 0,
                        tipo: 1,
                        valor: c,
                        saldo: c,
                        pagado: 0,
                        fecha: f.format("YYYY-MM-DD"),
                });
            }

            for (let i = 1; i < n-1; i++) {
                this.cuotas1.push({
                    contrato_id: 0,
                    tipo: 1,
                    valor: c,
                    saldo: c,
                    pagado: 0,
                    fecha: f.add(1,'M').format("YYYY-MM-DD"),
                });       
            }
            if (n>1) {
                this.cuotas1.push({
                    contrato_id: 0,
                    tipo: 1,
                    valor: x,
                    saldo: x,
                    pagado: 0,
                    fecha: f.add(1,'M').format("YYYY-MM-DD"),
                });
            }
        },
        calcularCuotas2(){
            var n = parseFloat(this.contrato.numeroCuotasFinanciado);
            var f = moment(this.contrato.fechaPagoFinanciado);
            var s = parseFloat(this.contrato.saldoFinanciado);

            var c = parseFloat((s/n).toFixed(2));
            var x = parseFloat(s) - parseFloat(c*n) + parseFloat(c);
            x = x.toFixed(2);
            c = c.toFixed(2);

            this.cuotas2 = [];

            if (n>0) {
                this.cuotas2.push({
                        contrato_id: 0,
                        tipo: 2,
                        valor: c,
                        saldo: c,
                        pagado: 0,
                        fecha: f.format("YYYY-MM-DD"),
                });
            }

            for (let i = 1; i < n-1; i++) {
                this.cuotas2.push({
                    contrato_id: 0,
                    tipo: 2,
                    valor: c,
                    saldo: c,
                    pagado: 0,
                    fecha: f.add(1,'M').format("YYYY-MM-DD"),
                });       
            }
            if (n>1) {
                this.cuotas2.push({
                    contrato_id: 0,
                    tipo: 2,
                    valor: x,
                    saldo: x,
                    pagado: 0,
                    fecha: f.add(1,'M').format("YYYY-MM-DD"),
                });
            }
        },
        calcularSaldos(){
            var con = this.contrato;

            this.contrato.saldoFinanciado = parseFloat(con.valorContrato) - parseFloat(con.cuotaInicial);
            this.contrato.saldoInicial = parseFloat(con.cuotaInicial) - parseFloat(con.pagoInicial);
        },
        calcularValorContrato(){
            var vg = this.globales;
            var con = this.contrato;

            var val = parseFloat(parseFloat(con.anosPactados) * parseFloat(vg[0].valor)) + parseFloat(con.otrosServicios) + parseFloat(parseFloat(con.boordingCard) * parseFloat(vg[3].valor));
            
            if (this.xpack.length > 0) {
                val = parseFloat(val) + parseFloat(this.xpack[0]) * parseFloat(vg[1].valor);
                this.contrato.xpack = this.xpack[0];
            }
            if (this.gastoLegal.length > 0) {
                val = parseFloat(val) + parseFloat(this.gastoLegal[0]) * parseFloat(vg[2].valor);
                this.contrato.gastoLegal = this.gastoLegal[0];
            }
            if (this.servicioInternacional.length > 0) {
                val = parseFloat(val) + parseFloat(this.servicioInternacional[0]) * parseFloat(vg[4].valor);
                this.contrato.servicioInternacional = this.servicioInternacional[0];
            }
            if (this.club.length > 0) {
                val = parseFloat(val) + parseFloat(this.club[0]) * parseFloat(vg[5].valor);
                this.contrato.club = this.club[0];
            }

            this.contrato.valorContrato = val;
            this.calcularSaldos();
        },
        getGlobales(){
            axios.get(this.base + '/variables').then((res) => {
                this.globales = res.data;
            }).catch((err) => {
                console.log(err);
            });
        },
        borrarPago(index){
            this.contrato.pagoInicial = parseFloat(this.contrato.pagoInicial) - parseFloat(this.pagos[index].valor);

            

            if (this.pagos[index].tipo == 'EFECTIVO') {
                this.total_efectivo = parseFloat(this.total_efectivo) - parseFloat(this.pagos[index].valor); 
            } else if (this.pagos[index].tipo == 'CHEQUE') {
                this.total_cheque = parseFloat(this.total_cheque) - parseFloat(this.pagos[index].valor); 
            } else if (this.pagos[index].tipo == 'TRANSFERENCIA') {
                this.total_transferencia = parseFloat(this.total_transferencia) - parseFloat(this.pagos[index].valor); 
            } else if (this.pagos[index].tipo == 'DEPOSITO') {
                this.total_deposito = parseFloat(this.total_deposito) - parseFloat(this.pagos[index].valor); 
            } else if (this.pagos[index].tipo == 'TARJETA') {
                this.total_tarjeta = parseFloat(this.total_tarjeta) - parseFloat(this.pagos[index].valor); 
            }

            this.pagos.splice(index,1);

            
            this.total = this.total_efectivo + this.total_cheque + this.total_deposito + this.total_transferencia + this.total_tarjeta;

            this.calcularSaldos();
        },
        agregarPago(){
            if (parseFloat(this.pagoN.valor) + parseFloat(this.contrato.pagoInicial) > parseFloat(this.contrato.valorContrato)) {
                Toastr.error("El pago EXEDE ELVALOR DELCONTRATO, no puede agregar mas.");
            } else {
                this.contrato.pagoInicial = parseFloat(this.contrato.pagoInicial) + parseFloat(this.pagoN.valor);
                
                if (this.contrato.pagoInicial > this.contrato.cuotaInicial) {
                    this.contrato.cuotaInicial = this.contrato.pagoInicial;
                }
    
                if (this.pagoN.tipo == 'EFECTIVO') {
                    this.total_efectivo = parseFloat(this.total_efectivo) + parseFloat(this.pagoN.valor); 
                } else if (this.pagoN.tipo == 'CHEQUE') {
                    this.total_cheque = parseFloat(this.total_cheque) + parseFloat(this.pagoN.valor); 
                } else if (this.pagoN.tipo == 'TRANSFERENCIA') {
                    this.total_transferencia = parseFloat(this.total_transferencia) + parseFloat(this.pagoN.valor); 
                } else if (this.pagoN.tipo == 'DEPOSITO') {
                    this.total_deposito = parseFloat(this.total_deposito) + parseFloat(this.pagoN.valor); 
                } else if (this.pagoN.tipo == 'TARJETA') {
                    this.total_tarjeta = parseFloat(this.total_tarjeta) + parseFloat(this.pagoN.valor); 
                }
    
                this.pagos.push(this.pagoN);
                this.pagoN = {
                    tipo: 'EFECTIVO',
                    valor: 0,
                    banco: '',
                    tarjeta: '',
                    diferido: '',
                    autorizacion: '',
                    lote: '',
                    numero: ''
                };
    
                this.total = this.total_efectivo + this.total_cheque + this.total_deposito + this.total_transferencia + this.total_tarjeta;
    
                this.calcularSaldos();
            }
        },
        showModal(){
            this.$refs.myModal.show();
        },
        hideModal(){
            this.$refs.myModal.hide();
        },
        condicionalidad(paso){
            if (this.contrato.sede != '' && this.contrato.ciudadSede != '' && this.contrato.tmk != '') {
                if (paso == 1) {
                    return true;
                } else {
                    if (this.participantes.jefe_sala != 0 && this.participantes.liner != 0 && this.participantes.closer1 != 0) {
                        if (paso == 2) {
                            return true;
                        } else {
                            if (this.titular.nombre != '' && this.titular.apellido != '' && this.titular.email != '' && this.titular.email != null && ((this.titular.celular != '' && this.titular.celular != null) || (this.titular.telefono != '' && this.titular.telefono != null))) {
                                if (paso == 3) {
                                    return true;
                                } else {
                                    if (true) {
                                        if (paso == 4) {
                                            
                                        }else{

                                        }
                                    } else {
                                        return false;
                                    }
                                }
                            } else {
                                return false;
                            }  
                        }
                    } else {
                        return false;
                    }       
                }
            } else {
                return false;
            }
        },
        seleccionaServicio(t){
            if (t==1) {
                for (let i = 0; i < this.servicios1.length; i++) {
                    this.misServicios.splice(this.misServicios.indexOf(this.servicios1[i].value),1);
                }
            } else if(t==2){
                for (let i = 0; i < this.servicios1.length; i++) {
                    if (this.misServicios.indexOf(this.servicios1[i].value) == -1) {
                        this.misServicios.push(this.servicios1[i].value);
                    }
                }
            }
            if (t==3) {
                for (let i = 0; i < this.servicios2.length; i++) {
                    this.misServicios.splice(this.misServicios.indexOf(this.servicios2[i].value),1);
                }
            } else if(t==4){
                for (let i = 0; i < this.servicios2.length; i++) {
                    if (this.misServicios.indexOf(this.servicios2[i].value) == -1) {
                        this.misServicios.push(this.servicios2[i].value);
                    }
                }
            }
        },
        getPaises(){
            axios.get(this.base + '/paises').then((res) => {
                this.paises = res.data;
            }).catch((err) => {
                console.log(err);
            });
        },
        getEstados(){
            axios.get(this.base + '/paises/' + this.titular.pais).then((res) => {
                this.estados = res.data;
            }).catch((err) => {
                console.log(err);
            });
        },
        getCiudades(){
            axios.get(this.base + '/paises/' + this.titular.pais + '/' + this.titular.provincia).then((res) => {
                this.ciudades = res.data;
            }).catch((err) => {
                console.log(err);
            });
        },
        getEstados2(){
            axios.get(this.base + '/paises/' + this.cotitular.pais).then((res) => {
                this.estados2 = res.data;
            }).catch((err) => {
                console.log(err);
            });
        },
        getCiudades2(){
            axios.get(this.base + '/paises/' + this.cotitular.pais + '/' + this.cotitular.provincia).then((res) => {
                this.ciudades2 = res.data;
            }).catch((err) => {
                console.log(err);
            });
        },
        cargarInvitado(origen,destino){
            if (origen == 'titular' && destino == 'invitado') {
                this.titular = this.invitado;
                this.contrato.titular = this.invitado.id;
            } else if (origen == 'cotitular' && destino == 'invitado') {
                this.cotitular = this.invitado;
                this.contrato.cotitular = this.invitado.id;
            } else if (origen == 'titular' && destino == 'acompanante') {
                this.titular = this.acompanante;
                this.contrato.titular = this.acompanante.id;
            } else if (origen == 'cotitular' && destino == 'acompanante') {
                this.cotitular = this.acompanante;
                this.contrato.cotitular = this.acompanante.id;
            } else if (origen == 'titular' && destino == 'otro') {
                this.contrato.titular = 0;
                this.titular.id = 0;
            } else if (origen == 'cotitular' && destino == 'otro') {
                this.contrato.cotitular = 0;
                this.cotitular.id = 0;
            }
        },
        setCiudadSede(){
            for (let i = 0; i < this.sedes.length; i++) {
                if (this.sedes[i].sede == this.contrato.sede) {
                    this.contrato.ciudadSede = this.sedes[i].ciudad;
                    console.log(this.contrato.ciudadSede);
                    break;
                }                
            }
        },

        getInvitado(){
            axios.get(this.base + '/clientes/' + this.cliente).then((res) => {
                this.invitado = res.data;
                this.contrato.sede = this.invitado.sede;
                this.contrato.tmk = this.invitado.tmk;
                this.setCiudadSede();

                if (this.invitado.acompanante > 0) {
                    axios.get(this.base + '/clientes/' + this.invitado.acompanante).then((res) => {
                        this.acompanante = res.data;
                    }).catch((err) => {
                        console.log(err);
                    });
                }

            }).catch((err) => {
                console.log(err);
            });
        },
        upParticipantes(){
            var estaBien = true;
            
            if(this.participantes.liner != 0 && this.cargos.liner != 0){
                let participa = {
                    empleado_id: this.participantes.liner,
                    cargo_id: this.cargos.liner
                };
                axios.post(this.base + '/participantes/' + this.cliente, participa).then((res) => {
                    
                }).catch((err) => {
                    estaBien = false;
                    console.log(err);
                });
            }
            if(this.participantes.jefe_sala != 0 && this.cargos.jefe_sala != 0){
                let participa = {
                    empleado_id: this.participantes.jefe_sala,
                    cargo_id: this.cargos.jefe_sala
                };
                axios.post(this.base + '/participantes/' + this.cliente, participa).then((res) => {
                    
                }).catch((err) => {
                    estaBien = false;
                    console.log(err);
                });
            }
            if(this.participantes.closer1 != 0 && this.cargos.closer != 0){
                let participa = {
                    empleado_id: this.participantes.closer1,
                    cargo_id: this.cargos.closer
                };
                axios.post(this.base + '/participantes/' + this.cliente, participa).then((res) => {
                    
                }).catch((err) => {
                    estaBien = false;
                    console.log(err);
                });
            }
            if(this.participantes.closer2 != 0 && this.cargos.closer != 0){
                let participa = {
                    empleado_id: this.participantes.closer2,
                    cargo_id: this.cargos.closer
                };
                axios.post(this.base + '/participantes/' + this.cliente, participa).then((res) => {
                    
                }).catch((err) => {
                    estaBien = false;
                    console.log(err);
                });
            }

            if (estaBien) {
                Toastr.success("Participantes registrados.");
                this.hideModal5();
            } else {
                Toastr.error("Error al registrar participantes.");
            }
            
        },
        getEmpleados(cargo){
            axios.get(this.base + '/empleadoscargo/' + cargo).then((res) => {
                if (cargo == 'CLOSER') {
                    this.closers = res.data;
                    if (this.closers.length > 0) {
                        this.cargos.closer = this.closers[0].cargo_id;
                    }
                } else if (cargo == 'LINER'){
                    this.liners = res.data;    
                    
                    if (this.liners.length > 0) {
                        this.cargos.liner = this.liners[0].cargo_id;
                    }                
                } else if (cargo == 'JEFE DE SALA'){
                    this.jefes_sala = res.data;
                    
                    if (this.jefes_sala.length > 0) {
                        this.cargos.jefe_sala = this.jefes_sala[0].cargo_id;
                    }                    
                }
            }).catch((err) => {
                console.log(err);
            });
        },
        getParticipantes(){
            axios.get(this.base + '/participantes/' + this.cliente).then((res) => {
                if (res.data) {
                    var xclos = 0;
                    for (let i = 0; i < res.data.length; i++) {
                        if (res.data[i].cargo_id == this.cargos.closer) {
                            if (xclos == 0) {
                                this.participantes.closer1 = res.data[i].empleado_id;
                                xclos++;
                            } else {
                                this.participantes.closer2 = res.data[i].empleado_id;
                            }
                        } else if (res.data[i].cargo_id == this.cargos.liner){
                            this.participantes.liner = res.data[i].empleado_id;
                        } else if (res.data[i].cargo_id == this.cargos.jefe_sala){
                            this.participantes.jefe_sala = res.data[i].empleado_id;
                        }
                    }
                }
            }).catch((err) => {
                console.log(err);
            });
        },

        getSedes(){
            axios.get(this.base + '/sedes').then((res) => {
                this.sedes = res.data;
            }).catch((err) => {
                console.log(err);
            });
        },
        getBonos(){
            axios.get(this.base + '/bonos').then((res) => {
                this.bonos = res.data;
                if (res.data) {
                    for (let i = 0; i < res.data.length; i++) {
                        this.misBonos.push({
                            bono: res.data[i].bono,
                            cantidad: 0,
                            tipo: res.data[i].tipo,
                            dias: res.data[i].dias,
                            tipo: res.data[i].tipo,
                            noches: res.data[i].noches,
                            personas: res.data[i].personas,
                        });
                    }
                }
            }).catch((err) => {
                console.log(err);
            });
        },
        getServicios(){
            axios.get(this.base + '/servicios').then((res) => {
                if (res.data) {
                    for (let i = 0; i < res.data.length; i++) {
                        if (res.data[i].tipo == 1) {
                            this.servicios1.push({
                                text: res.data[i].servicio+' '+res.data[i].porcentaje+'%.',
                                value: res.data[i].id
                            });
                        } else if (res.data[i].tipo == 2){
                            this.servicios2.push({
                                text: res.data[i].servicio+' '+res.data[i].porcentaje+'%.',
                                value: res.data[i].id
                            });
                        }
                    }
                }
            }).catch((err) => {
                console.log(err);
            });
        }
    },
}
</script>