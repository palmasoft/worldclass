<template>
    <div class="card">
        <div class="card-header">
            <strong>
                Contrato <i>"{{ contrato.sede + contrato.consecutivo }}"</i>
            </strong>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table>
                                <tbody>
                                    <tr>
                                        <td>
                                            <strong>
                                                Fecha de Creacion: 
                                                &nbsp;&nbsp;
                                            </strong>
                                        </td>
                                        <td>
                                            {{ fechaCreacion }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>
                                                Titular:
                                            </strong>
                                        </td>
                                        <td>
                                            {{ contrato.titularNombre }}
                                        </td>
                                    </tr>
                                    <tr v-if="contrato.cotitular > 0">
                                        <td>
                                            <strong>
                                                Cotitular:
                                            </strong>
                                        </td>
                                        <td>
                                            {{ contrato.cotitularNombre }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>
                                                Estado de Pago:
                                            </strong>
                                        </td>
                                        <td>
                                            {{ contrato.estadoContrato }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>
                                                Estado del Contrato:
                                            </strong>
                                        </td>
                                        <td v-if="contrato.estadoServicio < 2">
                                            <span class="text-success">Activo</span>
                                        </td>
                                        <td v-else-if="contrato.estadoServicio == 2">
                                            <span class="text-danger">Anulado</span>
                                        </td>
                                        <td v-else-if="contrato.estadoServicio == 3">
                                            <span class="text-danger">Anulado C.M.</span>
                                        </td>
                                        <td v-else-if="contrato.estadoServicio == 4">
                                            <span class="text-danger">Anulado E.D.</span>
                                        </td>
                                    </tr>
                                    <tr v-if="contrato.estadoServicio < 2">
                                        <td>
                                            <strong>
                                                Estado de Servicio:
                                            </strong>
                                        </td>
                                        <td v-if="contrato.estadoServicio == 0">
                                            <span class="text-success mr-1 mt-1 mb-1">Activo</span>
                                        </td>
                                        <td v-else>
                                            <span class="text-warning mr-1 mt-1 mb-1">Inactivo</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-12">
                    <div role="tablist">
                        <b-card no-body class="mb-1">
                            <b-card-header header-tag="header" class="p-1" role="tab">
                                <b-button v-if="contrato.cotitular > 0" block href="#" v-b-toggle.accordion1 variant="info">Titular y Cotitular</b-button>
                                <b-button v-else block href="#" v-b-toggle.accordion1 variant="info">Titular</b-button>
                            </b-card-header>
                            <b-collapse id="accordion1" visible accordion="my-accordion" role="tabpanel">
                                <b-card-body>
                                    <div class="row">
                                        <div class="col-12">
                                            <strong>Datos del Titular</strong>
                                        </div>
                                        <div class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Nombre:
                                            <br>
                                            <i>{{titular.nombre}}</i>                                            
                                        </div>
                                        <div class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Apellido:
                                            <br>
                                            <i>{{titular.apellido}}</i>
                                        </div>
                                        <div class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Email 1
                                            <br>
                                            <i>{{titular.email}}</i>
                                        </div>
                                        <div class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Email 2
                                            <br>
                                            <i>{{titular.email2}}</i>
                                        </div>
                                        <div class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Celular
                                            <br>
                                            <i>{{titular.celular}}</i>
                                        </div>
                                        <div class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Telefono
                                            <br>
                                            <i>{{titular.telefono}}</i>
                                        </div>
                                        <div class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Profecion
                                            <br>
                                            <i>{{titular.ocupacion}}</i>
                                        </div>
                                        <div class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Edad
                                            <br>
                                            <i>{{titular.edad}}</i>
                                        </div>
                                        <div class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Estado Civil
                                            <br>
                                            <i>{{titular.estadoCivil}}</i>
                                        </div>

                                        
                                        <div class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Cedula
                                            <br>
                                            <i>{{titular.cedula}}</i>
                                        </div>
                                        <div class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Pasaporte
                                            <br>
                                            <i>{{titular.pasaporte}}</i>
                                        </div>
                                        <div class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Fecha de nacimiento
                                            <br>
                                            <i>{{titular.fechaNacimiento}}</i>
                                        </div>

                                        <div class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Pais
                                            <br>
                                            <i>{{titular.pais}}</i>
                                        </div>
                                        <div class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Provincia
                                            <br>
                                            <i>{{titular.provincia}}</i>
                                        </div>
                                        <div class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Ciudad
                                            <br>
                                            <i>{{titular.ciudad}}</i>
                                        </div>
                                        
                                        <div class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Direccion
                                            <br>
                                            <i>{{titular.direccion}}</i>
                                        </div>

                                        <hr v-if="contrato.cotitular > 0" class="col-11 mt-1">
                                        
                                        <div v-if="contrato.cotitular > 0" class="col-12">
                                            <strong>Datos del Cotitular</strong>
                                        </div>

                                        <div v-if="contrato.cotitular > 0" class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Nombre
                                            <br>
                                            <i>{{cotitular.nombre}}</i>
                                        </div>
                                        <div v-if="contrato.cotitular > 0" class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Apellido
                                            <br>
                                            <i>{{cotitular.apellido}}</i>
                                        </div>
                                        <div v-if="contrato.cotitular > 0" class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Email 1
                                            <br>
                                            <i>{{cotitular.email}}</i>
                                        </div>
                                        <div v-if="contrato.cotitular > 0" class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Email 2
                                            <br>
                                            <i>{{cotitular.email2}}</i>
                                        </div>
                                        <div v-if="contrato.cotitular > 0" class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Celular
                                            <br>
                                            <i>{{cotitular.celular}}</i>
                                        </div>
                                        <div v-if="contrato.cotitular > 0" class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Telefono
                                            <br>
                                            <i>{{cotitular.telefono}}</i>
                                        </div>
                                        <div v-if="contrato.cotitular > 0" class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Profecion
                                            <br>
                                            <i>{{cotitular.ocupacion}}</i>
                                        </div>
                                        <div v-if="contrato.cotitular > 0" class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Edad
                                            <br>
                                            <i>{{cotitular.edad}}</i>
                                        </div>
                                        <div v-if="contrato.cotitular > 0" class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Estado Civil
                                            <br>
                                            <i>{{cotitular.estadoCivil}}</i>
                                        </div>

                                        
                                        <div v-if="contrato.cotitular > 0" class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Cedula
                                            <br>
                                            <i>{{cotitular.cedula}}</i>
                                        </div>
                                        <div v-if="contrato.cotitular > 0" class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Pasaporte
                                            <br>
                                            <i>{{cotitular.pasaporte}}</i>
                                        </div>
                                        <div v-if="contrato.cotitular > 0" class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Fecha de nacimiento
                                            <br>
                                            <i>{{cotitular.fechaNacimiento}}</i>
                                        </div>
                                        

                                        <div v-if="contrato.cotitular > 0" class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Pais
                                            <br>
                                            <i>{{cotitular.pais}}</i>
                                        </div>
                                        <div v-if="contrato.cotitular > 0" class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Provincia
                                            <br>
                                            <i>{{cotitular.provincia}}</i>
                                        </div>
                                        <div v-if="contrato.cotitular > 0" class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Ciudad
                                            <br>
                                            <i>{{cotitular.ciudad}}</i>
                                        </div>
                                        
                                        <div v-if="contrato.cotitular > 0" class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Direccion
                                            <br>
                                            <i>{{cotitular.direccion}}</i>
                                        </div>
                                    </div>
                                </b-card-body>
                            </b-collapse>
                        </b-card>

                        <b-card no-body class="mb-1">
                            <b-card-header header-tag="header" class="p-1" role="tab">
                                <b-button block href="#" v-b-toggle.accordion2 variant="info">Portafolio de Servicios</b-button>
                            </b-card-header>
                            <b-collapse id="accordion2" accordion="my-accordion" role="tabpanel">
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
                                                                <ul>
                                                                    <span v-for="(miServicio, index) in misServicios" :key="index">
                                                                        <li v-if="miServicio.tipo == 1">
                                                                            {{ miServicio.servicio + ' al '  + miServicio.porcentaje + '%.' }}
                                                                        </li>
                                                                    </span>
                                                                </ul>
                                                            </td>
                                                            <td>
                                                                <ul>
                                                                    <span v-for="(miServicio, index) in misServicios" :key="index">
                                                                        <li v-if="miServicio.tipo == 2">
                                                                            {{ miServicio.servicio + ' al '  + miServicio.porcentaje + '%.' }}
                                                                        </li>
                                                                    </span>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </b-card-body>
                            </b-collapse>
                        </b-card>

                        <b-card no-body class="mb-1">
                            <b-card-header header-tag="header" class="p-1" role="tab">
                                <b-button block href="#" v-b-toggle.accordion3 variant="info">Bonos</b-button>
                            </b-card-header>
                            <b-collapse id="accordion3" accordion="my-accordion" role="tabpanel">
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
                                                            <td class="text-right">
                                                                <strong>
                                                                    <i>
                                                                        {{bono.cantidad}}
                                                                    </i>
                                                                </strong>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </b-card-body>
                            </b-collapse>
                        </b-card>

                        <b-card no-body class="mb-1">
                            <b-card-header header-tag="header" class="p-1" role="tab">
                                <b-button block href="#" v-b-toggle.accordion4 variant="info">Detalles del Contrato</b-button>
                            </b-card-header>
                            <b-collapse id="accordion4" accordion="my-accordion" role="tabpanel">
                                <b-card-body>
                                    <div class="row">

                                        <div class="col-12">
                                            <strong>Valor del Contrato ${{ contrato.valorContrato }}</strong>
                                        </div>
                                        <div class="form-group col-lg-3 col-md-4 col-6">
                                            A&ntilde;os Pactados
                                            <br>
                                            <strong>
                                                <i>
                                                    {{contrato.anosPactados}}
                                                </i>
                                            </strong>
                                        </div>
                                        <div class="form-group col-lg-3 col-md-4 col-6">
                                            A&ntilde;os Otorgados
                                            <br>
                                            <strong>
                                                <i>
                                                    {{contrato.anosOtorgados}}
                                                </i>
                                            </strong>
                                        </div>
                                        <div class="form-group col-lg-3 col-md-4 col-6">
                                            Beneficiarios
                                            <br>
                                            <strong>
                                                <i>
                                                    {{contrato.beneficiarios}}
                                                </i>
                                            </strong>
                                        </div>
                                        <div class="form-group col-lg-3 col-md-4 col-6">
                                            Boording Card
                                            <br>
                                            <strong>
                                                <i>
                                                    {{contrato.boordingCard}}
                                                </i>
                                            </strong>
                                        </div>
                                        <div class="form-group col-lg-3 col-md-4 col-6">
                                            Otros Servicios
                                            <br>
                                            <strong>
                                                <i>
                                                    {{contrato.otrosServicios}}
                                                </i>
                                            </strong>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-6">
                                            <b-form-checkbox disabled v-model="contrato.gastoLegal" value="1" unchecked-value="0">
                                                Gasto legal
                                            </b-form-checkbox>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-6">
                                            <b-form-checkbox disabled v-model="contrato.xpack" value="1" unchecked-value="0">
                                                Xpack
                                            </b-form-checkbox>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-6">
                                            <b-form-checkbox disabled v-model="contrato.servicioInternacional" value="1" unchecked-value="0">
                                                Servicio Internacional
                                            </b-form-checkbox>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-6">
                                            <b-form-checkbox disabled v-model="contrato.club" value="1" unchecked-value="0">
                                                Club
                                            </b-form-checkbox>
                                        </div>

                                        <hr class="col-11">

                                        <div class="col-12">
                                            <strong>Pago Inicial</strong>
                                        </div>
                                        <div class="form-group col-5">
                                            Cuota Inicial
                                            <br>
                                            <strong>
                                                <i>
                                                    {{contrato.cuotaInicial}}
                                                </i>
                                            </strong>
                                        </div>
                                        <div class="form-group col-5">
                                            Pago Inicial
                                            <br>
                                            <strong>
                                                <i>
                                                    {{contrato.pagoInicial}}
                                                </i>
                                            </strong>
                                        </div>
                                        <div class="form-group col-2">
                                            <b-btn v-if="permiso_pago" v-on:click="guardarPagos" variant="primary" v-b-tooltip.hover title="Guardar">
                                                <font-awesome-icon icon="save"></font-awesome-icon>
                                            </b-btn>
                                            <b-btn v-if="permiso_pago" v-on:click="showModal" v-b-tooltip.hover title="Agregar/Editar Pagos">
                                                <font-awesome-icon icon="dollar-sign"></font-awesome-icon>
                                            </b-btn>
                                            <b-btn v-on:click="showModal2" v-b-tooltip.hover title="Pagos Anteriores">
                                                <font-awesome-icon icon="money-bill"></font-awesome-icon>
                                            </b-btn>
                                            <b-modal ref="myModal2" hide-footer title="Pagos Anteriores">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="table-responsive">
                                                            <table class="table table-striped">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Fecha</th>
                                                                        <th>Valor</th>
                                                                        <th>Tipo</th>
                                                                        <th>Descripcion</th>
                                                                        <th v-if="permiso_delete_pago">
                                                                            Eliminar
                                                                        </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr v-for="(pago, index) in pagosA" :key="index">
                                                                        <td>
                                                                            {{pago.created_at}}
                                                                        </td>
                                                                        <td>
                                                                            {{pago.valor}}
                                                                        </td>
                                                                        <td>
                                                                            {{pago.tipo}}
                                                                        </td>
                                                                        <td>
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
                                                                        </td>
                                                                        <td v-if="permiso_delete_pago">
                                                                            <b-btn variant="danger" @click="deletePago(pago.id)" v-b-tooltip.hover title="Eliminar" type="submit">
                                                                                <font-awesome-icon icon="trash"></font-awesome-icon>
                                                                            </b-btn>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </b-modal>

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

                                        <div class="col-lg-6">
                                            <div class="card">
                                                <div class="card-body">
                                                    <strong>Finanaciar Saldo Inicial ${{ contrato.saldoInicial }}</strong>
                                                    <div class="row">
                                                        <div class="form-goup col-sm-6">
                                                            Numero de Cuotas
                                                            <br>
                                                            <strong>
                                                                <i>
                                                                    {{contrato.numeroCuotasIniciales}}
                                                                </i>
                                                            </strong>
                                                        </div>
                                                        <div class="form-goup col-sm-6">
                                                            Fecha Primer Pago
                                                            <br>
                                                            <strong>
                                                                <i>
                                                                    {{contrato.fehcaPagoInicial}}
                                                                </i>
                                                            </strong>
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
                                                                                        <th>
                                                                                            <center>Saldo</center>
                                                                                        </th>
                                                                                        <th>
                                                                                            <center>Estado</center>
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
                                                                                            <strong>
                                                                                                {{cuota.fecha}}
                                                                                            </strong>
                                                                                        </td>
                                                                                        <td>
                                                                                            <strong>
                                                                                                {{cuota.valor}}
                                                                                            </strong>
                                                                                        </td>
                                                                                        <td>
                                                                                            <strong>
                                                                                                {{cuota.saldo}}
                                                                                            </strong>
                                                                                        </td>
                                                                                        <td>
                                                                                            <b-btn v-if="parseFloat(cuota.saldo) <= 0.0" variant="success">
                                                                                                Pagado
                                                                                            </b-btn>
                                                                                            <span v-else>
                                                                                                <b-btn v-if="gerTipoFechaCuota(cuota.fecha)" variant="warning">
                                                                                                    Vence {{ momentoCuota(cuota.fecha) }}
                                                                                                </b-btn>
                                                                                                <b-btn v-else variant="danger">
                                                                                                    Vencio {{ momentoCuota(cuota.fecha) }}
                                                                                                </b-btn>
                                                                                            </span>
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

                                            
                                        <div class="col-lg-6">
                                            <div class="card">
                                                <div class="card-body">
                                                    <strong>Finanaciar Saldo Restante ${{ contrato.saldoFinanciado }}</strong>
                                                    <div class="row">
                                                        <div class="form-goup col-sm-6">
                                                            Numero de Cuotas
                                                            <br>
                                                            <strong>
                                                                <i>
                                                                    {{contrato.numeroCuotasFinanciado}}
                                                                </i>
                                                            </strong>
                                                        </div>
                                                        <div class="form-goup col-sm-6">
                                                            Fecha Primer Pago
                                                            <br>
                                                            <strong>
                                                                <i>
                                                                    {{contrato.fehcaPagoFinanciado}}
                                                                </i>
                                                            </strong>
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
                                                                                        <th>
                                                                                            <center>Saldo</center>
                                                                                        </th>
                                                                                        <th>
                                                                                            <center>Estado</center>
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
                                                                                            <strong>
                                                                                                {{cuota.fecha}}
                                                                                            </strong>
                                                                                        </td>
                                                                                        <td>
                                                                                            <strong>
                                                                                                {{cuota.valor}}
                                                                                            </strong>
                                                                                        </td>
                                                                                        <td>
                                                                                            <strong>
                                                                                                {{cuota.saldo}}
                                                                                            </strong>
                                                                                        </td>
                                                                                        <td>
                                                                                            <b-btn v-if="parseFloat(cuota.saldo) <= 0.0" variant="success">
                                                                                                Pagado
                                                                                            </b-btn>
                                                                                            <span v-else>
                                                                                                <b-btn v-if="gerTipoFechaCuota(cuota.fecha)" variant="warning">
                                                                                                    Vence {{ momentoCuota(cuota.fecha) }}
                                                                                                </b-btn>
                                                                                                <b-btn v-else variant="danger">
                                                                                                    Vencio {{ momentoCuota(cuota.fecha) }}
                                                                                                </b-btn>
                                                                                            </span>
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

                                    </div>
                                </b-card-body>
                            </b-collapse>
                        </b-card>

                        <b-card no-body class="mb-1">
                            <b-card-header header-tag="header" class="p-1" role="tab">
                                <b-button block href="#" v-b-toggle.accordion5 variant="info">Comentarios</b-button>
                            </b-card-header>
                            <b-collapse id="accordion5" accordion="my-accordion" role="tabpanel">
                                <b-card-body>
                                    <form v-if="permiso_comentario" class="row" v-on:submit.prevent="comentarioUp(3)">
                                        <div class="col-12">
                                            <strong>Nuevo Comentario</strong>
                                        </div>
                                        <div class="form-group col-12">
                                            Comentario
                                            <textarea required class="form-control" rows="4" v-model="comentarioGeneral.comentario" placeholder="Comentario"></textarea>
                                        </div>
                                        <div class="form-group col-12">
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                        </div>
                                    </form>
                                    <hr>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <thead class="thead-dark bg-danger">
                                                        <tr>
                                                            <th>
                                                                <center>
                                                                    Usuario
                                                                </center>
                                                            </th>
                                                            <th>
                                                                <center>
                                                                    Cargo
                                                                </center>
                                                            </th>
                                                            <th>
                                                                <center>
                                                                    Contexto
                                                                </center>
                                                            </th>
                                                            <th>
                                                                <center>
                                                                    Fecha
                                                                </center>
                                                            </th>
                                                            <th>
                                                                <center>
                                                                    Comentario
                                                                </center>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="(comentario, index) in comentarios" :key="index">
                                                            <td>
                                                                {{ comentario.usuario }}
                                                            </td>
                                                            <td>
                                                                {{ comentario.cargo }}
                                                            </td>
                                                            <td>
                                                                {{ comentario.lugar }}
                                                            </td>
                                                            <td>
                                                                {{ comentario.created_at }}
                                                            </td>
                                                            <td>
                                                                {{ comentario.comentario }}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </b-card-body>
                            </b-collapse>
                        </b-card>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['base','contratoid','destino'],
    data() {
        return {
            permiso_pago: false,
            permiso_comentario: false,
            permiso_delete_pago: false,

            contrato: {},
            titular: {},
            cotitular: {},
            fechaCreacion: '',

            comentarioGeneral: {
                lugar: 'CARTERA',
                comentario: ''
            },

            misServicios: [],

            misBonos: [],

            cuotas1: [],
            cuotas2: [],

            pagosA: [],
            
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

            total_efectivo: 0,
            total_cheque: 0,
            total_deposito: 0,
            total_transferencia: 0,
            total_tarjeta: 0,
            total: 0,

            comentarios: []
        }
    },
    mounted() {
        this.getContrato();
        this.getBonos();
        this.getMisServicios();
        this.getCuotas();
        this.getMisPermisos();
    },
    methods: {
        deletePago(pagoId){
            axios.delete(this.base + '/contratopago/' + pagoId).then((res) => {
                location.reload();
            }).catch((err) => {
                console.log(err);
            });
        },
        gerTipoFechaCuota(fecha){
            var x = new Date(fecha);
            var hoy = new Date();

            if (hoy-x > 0) {
                return false;
            }

            return true;
        },
        momentoCuota(fecha){
            return moment(fecha, "YYYY-MM-DD").fromNow();
        },
        getMisPermisos(){
            axios.get(this.base + '/permisoExiste/cartera.pago').then((res) => {
                this.permiso_pago = res.data.existe;
            }).catch((err) => {
                console.log(err);
            });
            axios.get(this.base + '/permisoExiste/cartera.delete_pago').then((res) => {
                this.permiso_delete_pago = res.data.existe;
            }).catch((err) => {
                console.log(err);
            });
            axios.get(this.base + '/permisoExiste/cartera.comentario').then((res) => {
                this.permiso_comentario = res.data.existe;
            }).catch((err) => {
                console.log(err);
            });
        },
        calcularSaldos(){
            var con = this.contrato;

            if (parseFloat(con.pagoInicial) <= parseFloat(con.cuotaInicial)) {
                this.contrato.saldoFinanciado = parseFloat(con.valorContrato) - parseFloat(con.cuotaInicial);
                this.contrato.saldoInicial = parseFloat(con.cuotaInicial) - parseFloat(con.pagoInicial);
            } else {
                this.contrato.saldoFinanciado = parseFloat(con.valorContrato) - parseFloat(con.pagoInicial);
            }
                
        },
        guardarPagos(){
            let upCuotas = {
                cuotas: this.cuotas1.concat(this.cuotas2)
            };

            var x = parseFloat(this.total);
            this.calcularSaldos();

            if(parseFloat(this.contrato.pagoInicial) <= parseFloat(this.contrato.valorContrato)){
                axios.put(this.base + '/contratos/' + this.contratoid,this.contrato).then((res) => {
                    this.contrato = res.data;
                    axios.get(this.base + '/estadocontratos/' + this.contratoid).then((res2) => {
                        Toastr.success("Pagos guardados en el contrato.");
                    }).catch((err) => {
                        Toastr.error("Error al agregar el pago.");
                        console.log(err);
                    });
                }).catch((err) => {
                    console.log(err);
                });
                

                for (let i = 0; i < this.pagos.length; i++) {
                    axios.post(this.base + '/contratopago/' + this.contratoid, this.pagos[i]).then((res) => {
                        console.log('pago ag' + i);
                    }).catch((err) => {
                        console.log(err);
                    });   
                };
            }else{
                Toastr.error("El pago no se puede agregar debido a que exede el saldo pendiente.");
            }

            for (let i = 0; i < upCuotas.cuotas.length; i++) {
                if (parseFloat(x) > parseFloat(upCuotas.cuotas[i].saldo)) {
                    x = parseFloat(x) - parseFloat(upCuotas.cuotas[i].saldo);

                    upCuotas.cuotas[i].saldo = 0.00;                    
                    upCuotas.cuotas[i].pagado = upCuotas.cuotas[i].valor;
                }else{
                    upCuotas.cuotas[i].pagado = x;
                    upCuotas.cuotas[i].saldo = parseFloat(upCuotas.cuotas[i].saldo) - parseFloat(x);

                    x = 0.00;

                    break;
                }
            }

            if (parseFloat(x) < 1) {            
                axios.post(this.base + '/contratocuota/' + this.contratoid, upCuotas).then((res) => {
                    console.log('cuotas ag');
                    this.cuotas1=[];
                    this.cuotas2=[];
                    this.getCuotas();
                }).catch((err) => {
                    console.log(err);
                }); 

                this.pagos = [];
                this.total_efectivo = 0;
                this.total_cheque = 0;
                this.total_deposito = 0;
                this.total_transferencia = 0;
                this.total_tarjeta = 0;
                this.total = 0;

                Toastr.success("Pagos guardados EN LAS CUOTAS.");
            }else{
                Toastr.error("El pago no se puede agregar a LAS CUOTAS.");
            }
        },
        getComentarios(){
            axios.get(this.base + '/comentarios/' + this.titular.id).then((res) => {
                this.comentarios = res.data;
            }).catch((err) => {
                console.log(err);
            });
        },
        
        getCuotas(){
            axios.get(this.base + '/contratocuota/' + this.contratoid).then((res) => {
                for (let i = 0; i < res.data.length; i++) {
                    if (res.data[i].tipo == 1) {
                        this.cuotas1.push(res.data[i]);
                    } else {
                        this.cuotas2.push(res.data[i]);
                    }
                }
            }).catch((err) => {
                console.log(err);
            });
        },
        getPagos(){
            axios.get(this.base + '/contratopago/' + this.contratoid).then((res) => {
                this.pagosA = res.data; 
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
        },
        agregarPago(){
            if (parseFloat(this.pagoN.valor) + parseFloat(this.contrato.pagoInicial) > parseFloat(this.contrato.valorContrato)) {
                Toastr.error("El pago EXEDE ELVALOR DELCONTRATO, no puede agregar mas.");
            } else {

                this.contrato.pagoInicial = parseFloat(this.contrato.pagoInicial) + parseFloat(this.pagoN.valor);
                
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
            }
        },
        showModal(){
            this.$refs.myModal.show();
        },
        hideModal(){
            this.$refs.myModal.hide();
        },
        showModal2(){
            this.$refs.myModal2.show();
            this.getPagos();
        },
        hideModal2(){
            this.$refs.myModal2.hide();
        },
        getMisServicios(){
            axios.get(this.base + '/contratoservicio/' + this.contratoid).then((res) => {
                this.misServicios = res.data;                    
                
            }).catch((err) => {
                console.log(err);
            });
        },
        getBonos(){
            axios.get(this.base + '/contratobono/' + this.contratoid).then((res) => {
                this.misBonos = res.data;
            }).catch((err) => {
                console.log(err);
            });
        },
        comentarioUp(lugar){
            if (lugar == 3){
                axios.post(this.base + '/comentarios/' + this.contrato.titular, this.comentarioGeneral).then((res2) => {
                    Toastr.success("Comentario Guardado.");
                    this.comentarioGeneral = {
                        lugar: 'CARTERA',
                        comentario: ''
                    };
                    this.getComentarios();
                }).catch((err2) => {
                    Toastr.error('Error intentar guardar el comentario.');
                    console.log(err2);
                });   
            }
        },
        getContrato(){
            axios.get(this.base + '/contratos/' + this.contratoid).then((res) => {
                this.contrato = res.data;
                this.fechaCreacion = moment(this.contrato.created_at).format('LLLL').toUpperCase();
                this.getTitular();
            }).catch((err) => {
                console.log(err);
            });
        },
        getTitular(){
            axios.get(this.base + '/clientes/' + this.contrato.titular).then((res) => {
                this.titular = res.data;
                
                this.getComentarios();

                if (this.contrato.cotitular > 0) {
                    axios.get(this.base + '/clientes/' + this.contrato.cotitular).then((res2) => {
                        this.cotitular = res2.data;
                    }).catch((err2) => {
                        console.log(err2);
                    });
                }
            }).catch((err) => {
                console.log(err);
            });
        }
    },
}
</script>