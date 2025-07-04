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
                                            <b-btn class="m-1" variant="warning" v-b-tooltip.hover title="Desactivar" v-on:click="estadoContrato(1)">
                                                <font-awesome-icon icon="ban"></font-awesome-icon>
                                            </b-btn>
                                        </td>
                                        <td v-else>
                                            <span class="text-warning mr-1 mt-1 mb-1">Inactivo</span>
                                            <b-btn class="m-1" variant="warning" v-b-tooltip.hover title="Activar" v-on:click="estadoContrato(0)">
                                                <font-awesome-icon icon="check-circle"></font-awesome-icon>
                                            </b-btn>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>
                                                Estado de Verificacion:
                                            </strong>
                                        </td>
                                        <td>
                                            <strong>
                                                <span v-if="contrato.verificado">
                                                    {{ contrato.verificado }}
                                                </span>
                                                <span v-else class="text-secondary">
                                                    Sin Verfificar
                                                </span>
                                            </strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <hr>
                            <div class="form-group">
                                <b-btn v-if="contrato.estadoServicio < 2 && permiso_anular" variant="success" v-b-tooltip.hover title="Caido en Mesa" v-on:click="estadoContrato(3)">
                                    Anular C.M.
                                </b-btn>
                                <b-btn v-if="contrato.estadoServicio < 2 && permiso_anular" variant="success" v-b-tooltip.hover title="Error de Digitacion" v-on:click="estadoContrato(4)">
                                    Anular E.D.
                                </b-btn>
                                <b-btn v-if="contrato.verificado != 'VERIFICADO'" v-on:click="showModal2">
                                    Verificar
                                </b-btn>

                                <b-modal ref="myModal2" hide-footer title="Verificar">
                                    <form class="row" v-on:submit.prevent="verificar">
                                        <div class="form-group col-12">
                                            Marque lo que este verificado en el contrato.
                                            <b-form-checkbox-group stacked name="puntosverificados" v-model="verificaInfo.selected" :options="verificaInfo.options" />
                                        </div>
                                        <div class="form-group col-12">
                                            Estado de Verificacion:
                                            <b-form-radio-group name="tipoverificado" v-model="verificaInfo.verificado" :options="verificaInfo.options2" />
                                        </div>
                                        <div class="form-group col-12">
                                            Comentario:
                                            <textarea class="form-control" rows="4" v-model="verificaInfo.comentario"></textarea>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                            <b-btn v-on:click="hideModal2">Cancelar</b-btn>
                                        </div>
                                    </form>
                                </b-modal>
                            </div>
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
                                    <form class="row" v-on:submit.prevent="titularesUp">
                                        <div class="col-12">
                                            <strong>Datos del Titular</strong>
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
                                            <input type="number" class="form-control" v-model="titular.celular" placeholder="Celular">
                                        </div>
                                        <div class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Telefono
                                            <input type="number" class="form-control" v-model="titular.telefono" placeholder="Telefono">
                                        </div>
                                        <div class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Profesión
                                            <input type="text" class="form-control" v-model="titular.ocupacion" placeholder="Profecion">
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
                                            <input type="number" class="form-control" v-model="titular.cedula" placeholder="Cedula">
                                        </div>
                                        <div class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Pasaporte
                                            <input type="text" class="form-control" v-model="titular.pasaporte" placeholder="Pasaporte">
                                        </div>
                                        <div class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Fecha de nacimiento
                                            <input type="date" class="form-control" v-model="titular.fechaNacimiento">
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

                                        <hr v-if="contrato.cotitular > 0" class="col-11 mt-1">
                                        
                                        <div v-if="contrato.cotitular > 0" class="col-12">
                                            <strong>Datos del Cotitular</strong>
                                        </div>

                                        <div v-if="contrato.cotitular > 0" class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Nombre
                                            <input type="text" class="form-control" v-model="cotitular.nombre" placeholder="Nombre" required>
                                        </div>
                                        <div v-if="contrato.cotitular > 0" class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Apellido
                                            <input type="text" class="form-control" v-model="cotitular.apellido" placeholder="Apellido" required>
                                        </div>
                                        <div v-if="contrato.cotitular > 0" class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Email 1
                                            <input type="email" class="form-control" v-model="cotitular.email" placeholder="eMail">
                                        </div>
                                        <div v-if="contrato.cotitular > 0" class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Email 2
                                            <input type="email" class="form-control" v-model="cotitular.email2" placeholder="eMail">
                                        </div>
                                        <div v-if="contrato.cotitular > 0" class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Celular
                                            <input type="number" class="form-control" v-model="cotitular.celular" placeholder="Celular">
                                        </div>
                                        <div v-if="contrato.cotitular > 0" class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Telefono
                                            <input type="number" class="form-control" v-model="cotitular.telefono" placeholder="Telefono">
                                        </div>
                                        <div v-if="contrato.cotitular > 0" class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Profesión
                                            <input type="text" class="form-control" v-model="cotitular.ocupacion" placeholder="Profecion">
                                        </div>
                                        <div v-if="contrato.cotitular > 0" class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Edad
                                            <input type="number" class="form-control" v-model="cotitular.edad" placeholder="Edad">
                                        </div>
                                        <div v-if="contrato.cotitular > 0" class="form-group col-sm-6 col-md-4 col-lg-3">
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

                                        
                                        <div v-if="contrato.cotitular > 0" class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Cedula
                                            <input type="number" class="form-control" v-model="cotitular.cedula" placeholder="Cedula">
                                        </div>
                                        <div v-if="contrato.cotitular > 0" class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Pasaporte
                                            <input type="text" class="form-control" v-model="cotitular.pasaporte" placeholder="Pasaporte">
                                        </div>
                                        <div v-if="contrato.cotitular > 0" class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Fecha de nacimiento
                                            <input type="date" class="form-control" v-model="cotitular.fechaNacimiento">
                                        </div>
                                        

                                        <div v-if="contrato.cotitular > 0" class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Pais
                                            <select class="form-control" v-model="cotitular.pais" v-on:change="getEstados2">
                                                <option></option>
                                                <option v-for="(pais, index) in paises" :key="index">
                                                    {{ pais.pais }}
                                                </option>
                                            </select>
                                        </div>
                                        <div v-if="contrato.cotitular > 0" class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Provincia
                                            <select class="form-control" v-model="cotitular.provincia" v-on:change="getCiudades2">
                                                <option></option>
                                                <option v-for="(estado, index) in estados2" :key="index">
                                                    {{ estado.estado }}
                                                </option>
                                            </select>
                                        </div>
                                        <div v-if="contrato.cotitular > 0" class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Ciudad
                                            <select class="form-control" v-model="cotitular.ciudad">
                                                <option></option>
                                                <option v-for="(ciudad, index) in ciudades2" :key="index">
                                                    {{ ciudad }}
                                                </option>
                                            </select>
                                        </div>
                                        
                                        <div v-if="contrato.cotitular > 0" class="form-group col-sm-6 col-md-4 col-lg-3">
                                            Direccion
                                            <input type="text" class="form-control" v-model="cotitular.direccion" placeholder="Direccion">
                                        </div>
                                        
                                        <hr class="col-11 mt-1">

                                        <div v-if="permiso_titular" class="form-group col-12">
                                            Comentario
                                            <textarea required class="form-control" rows="4" v-model="comentarioTitular.comentario" placeholder="Comentario"></textarea>
                                        </div>

                                        <hr class="col-11 mt-1">

                                        <div v-if="permiso_titular" class="form-group col-12">
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                        </div>
                                    </form>
                                </b-card-body>
                            </b-collapse>
                        </b-card>

                        <form v-on:submit.prevent="cambiarContrato">
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
                                                                    <b-form-checkbox-group v-model="misServicios" :options="servicios1">
                                                                    </b-form-checkbox-group>
                                                                </td>
                                                                <td>
                                                                    <b-form-checkbox-group v-model="misServicios" :options="servicios2">
                                                                    </b-form-checkbox-group>
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
                                                                <td>
                                                                    <div class="form-group">
                                                                        <input class="form-control" type="number" step="1" v-model="bono.cantidad">
                                                                    </div>
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
                                                <input class="form-control" type="number" step="1" v-model="contrato.anosPactados" @change="calcularValorContrato">
                                            </div>
                                            <div class="form-group col-lg-3 col-md-4 col-6">
                                               Noches por Años
                                                <input class="form-control" type="number" step="1" v-model="contrato.anosOtorgados">
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
                                            <!--<div class="col-lg-3 col-md-4 col-6">
                                                <b-form-checkbox v-model="contrato.gastoLegal" value="1" unchecked-value="0" @change="calcularValorContrato">
                                                    Gasto legal
                                                </b-form-checkbox>
                                            </div>
                                            <div class="col-lg-3 col-md-4 col-6">
                                                <b-form-checkbox v-model="contrato.xpack" value="1" unchecked-value="0" @change="calcularValorContrato">
                                                    Xpack
                                                </b-form-checkbox>
                                            </div>
                                            <div class="col-lg-3 col-md-4 col-6">
                                                <b-form-checkbox v-model="contrato.servicioInternacional" value="1" unchecked-value="0" @change="calcularValorContrato">
                                                    Servicio Internacional
                                                </b-form-checkbox>
                                            </div>
                                            <div class="col-lg-3 col-md-4 col-6">
                                                <b-form-checkbox v-model="contrato.club" value="1" unchecked-value="0" @change="calcularValorContrato">
                                                    Club
                                                </b-form-checkbox>
                                            </div>
                                            <div class="form-group col-12">
                                                <b-btn v-on:click="calcularValorContrato">Validar</b-btn>
                                            </div>-->

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
                                                <b-btn v-if="permiso_update" v-on:click="showModal" v-b-tooltip.hover title="Agregar/Editar Pagos">
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
                                                                                                <input type="number" style="width: 75px;" step="0.01" v-model="cuota.valor">
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
                                                                                                <input type="number" style="width: 75px;" step="0.01" v-model="cuota.valor">
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

                                            <div v-if="permiso_update" class="form-group col-12">
                                                Comentario
                                                <textarea required class="form-control" rows="4" v-model="comentarioContrato.comentario" placeholder="Comentario"></textarea>
                                            </div>

                                            <hr class="col-11">

                                            <div v-if="permiso_update" class="form-group col-12">
                                                <button type="submit" class="btn btn-primary">Cambiar Valor</button>
                                            </div>
                                            <div v-if="permiso_upgrade" class="form-group col-12">
                                                <button class="btn btn-primary" v-on:click="upgrade('UP')">Upgrade</button>
                                            </div>
                                            <div v-if="permiso_upgrade" class="form-group col-12">
                                                <button class="btn btn-primary" v-on:click="upgrade('DOWN')">Downgrade</button>
                                            </div>

                                        </div>
                                    </b-card-body>
                                </b-collapse>
                            </b-card>
                        </form>

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

                        
                        <b-card no-body class="mb-1">
                            <b-card-header header-tag="header" class="p-1" role="tab">
                                <b-button block href="#" v-b-toggle.accordion6 variant="info">Documentos</b-button>
                            </b-card-header>
                            <b-collapse id="accordion6" accordion="my-accordion" role="tabpanel">
                                <b-card-body>
                                    <a :href="destino + '/pdfcontrato/' + contrato.id" class="btn btn-primary m-1" target="_blank">
                                        <font-awesome-icon icon="file-pdf"></font-awesome-icon> Contrato
                                    </a>
                                    <a :href="destino + '/pdfcertificadovacaciones/' + contrato.id" class="btn btn-dark m-1" target="_blank">
                                        <font-awesome-icon icon="file-pdf"></font-awesome-icon> Certificado de Vacaciones
                                    </a>
                                    <a v-if="contrato.saldoInicial > 0" :href="destino + '/pdfpagare1/' + contrato.id" class="btn btn-secondary m-1" target="_blank">
                                        <font-awesome-icon icon="file-invoice-dollar"></font-awesome-icon> Pagare Inicial
                                    </a>
                                    <a v-if="contrato.saldoFinanciado > 0" :href="destino + '/pdfpagare2/' + contrato.id" class="btn btn-secondary m-1" target="_blank">
                                        <font-awesome-icon icon="file-invoice-dollar"></font-awesome-icon> Pagare Financiado
                                    </a>

                                    <a :href="destino + '/pdfsiuso/' + contrato.id" class="btn btn-info m-1" target="_blank">
                                        <font-awesome-icon icon="file-alt"></font-awesome-icon> Si de Uso
                                    </a>
                                    <a :href="destino + '/pdfsivigencia/' + contrato.id" class="btn btn-info m-1" target="_blank">
                                        <font-awesome-icon icon="file-alt"></font-awesome-icon> Si de Vigencia
                                    </a>

                                    
                                    <a v-for="(replica, index) in replicas" :key="index" :href="destino + '/documentos/replicas/' + replica.replica" class="btn btn-waring m-1" target="_blank">
                                        <font-awesome-icon icon="file-alt"></font-awesome-icon>{{ replica.tipo + replica.created_at }}
                                    </a>
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
            verificaInfo: {
                selected: [],
                options: [
                    {
                        text:"Datos Titular/Cotitular",
                        value: "Datos Titular/Cotitular"
                    },
                    {
                        text:"Datos Contacto",
                        value: "Datos Contacto"
                    },
                    {
                        text:"Portafolio",
                        value: "Portafolio"
                    },
                    {
                        text:"Bonos",
                        value: "Bonos"
                    },
                    {
                        text:"Años",
                        value: "Años"
                    },
                    {
                        text:"Formas de Pago",
                        value: "Formas de Pago"
                    },
                    {
                        text:"Documentos Fisicos",
                        value: "Documentos Fisicos"
                    }
                ],
                verificado: '',
                options2:[
                    {
                        text: "NULO",
                        value: "NULO"
                    },
                    {
                        text: "VERIFICADO",
                        value: "VERIFICADO"
                    }
                ],
                comentario: ""
            },

            permiso_titular: false,
            permiso_update: false,
            permiso_comentario: false,
            permiso_upgrade: false,
            permiso_anular: false,
            

            paises: [],
            estados: [],
            estados2: [],
            ciudades: [],
            ciudades2: [],
            globales: [],

            contrato: {},
            titular: {},
            cotitular: {},
            fechaCreacion: '',

            comentarioTitular: {
                lugar: 'CONTRATO',
                comentario: ''
            },
            comentarioContrato: {
                lugar: 'CONTRATO',
                comentario: ''
            },
            comentarioGeneral: {
                lugar: 'CONTRATO',
                comentario: ''
            },

            servicios1: [],
            servicios2: [],
            misServicios: [],

            misBonos: [],

            cuotas1: [],
            cuotas2: [],

            
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

            comentarios: [],
            replicas: []
        }
    },
    mounted() {
        this.getGlobales();

        this.getContrato();
        this.getServicios();
        this.getBonos();
        this.getMisServicios();
        this.getCuotas();
        this.getPagos();
        

        this.getPaises();

        this.getMisPermisos();
        this.getReplicas();
    },
    methods: {
        verificar(){
            axios.post(this.base + '/verificar/' + this.contratoid,this.verificaInfo).then((res) => {
                this.hideModal2();
                this.contrato.verificado = this.verificaInfo.verificado;
                Toastr.success("Estado de Verificacion Cambiado.");

                comentarioX = {
                    lugar: 'CONTRATO',
                    comentario: this.verificaInfo.comentario
                };

                axios.post(this.base + '/comentarios/' + this.contrato.titular, comentarioX).then((res2) => {
                    Toastr.success("Comentario Guardado.");
                    
                    this.getComentarios();
                }).catch((err2) => {
                    Toastr.error('Error intentar guardar el comentario.');
                    console.log(err2);
                });  
            }).catch((e) => {
                Toastr.error("Error");
                console.log(e);
            });
        },
        getMisPermisos(){
            axios.get(this.base + '/permisoExiste/contrato.titular').then((res) => {
                this.permiso_titular = res.data.existe;
            }).catch((err) => {
                console.log(err);
            });
            axios.get(this.base + '/permisoExiste/contrato.update').then((res) => {
                this.permiso_update = res.data.existe;
            }).catch((err) => {
                console.log(err);
            });
            axios.get(this.base + '/permisoExiste/contrato.comentario').then((res) => {
                this.permiso_comentario = res.data.existe;
            }).catch((err) => {
                console.log(err);
            });
            axios.get(this.base + '/permisoExiste/contrato.upgrade').then((res) => {
                this.permiso_upgrade = res.data.existe;
            }).catch((err) => {
                console.log(err);
            });
            axios.get(this.base + '/permisoExiste/contrato.anular.cm').then((res) => {
                this.permiso_anular = res.data.existe;
            }).catch((err) => {
                console.log(err);
            });
        },
        getReplicas(){
            axios.get(this.base + '/replicas/' + this.contratoid).then((res) => {
                this.replicas = res.data;
            }).catch((err) => {
                console.log(err);
            });
        },
        getComentarios(){
            axios.get(this.base + '/comentarios/' + this.titular.id).then((res) => {
                this.comentarios = res.data;
            }).catch((err) => {
                console.log(err);
            });
        },
        upgrade(tipoU){
            axios.get(this.base + '/upcontrato/' + this.contrato.id + '/' + tipoU).then((res) => {
                Toastr.success("Contrato Modificado exitosamente.");
                this.cambiarContrato();
            }).catch((err) => {
                Toastr.error("Error");
                console.log(err);
            })
        },
        cambiarContrato(){
            var completo = true;

            if (completo) {
                let upbonos = {
                    bonos: this.misBonos
                };
    
                let upServicios = {
                    servicios: this.misServicios
                };
    
                let upCuotas = {
                    cuotas: this.cuotas1.concat(this.cuotas2)
                };
    
                axios.put(this.base + '/contratos/' + this.contratoid,this.contrato).then((res) => {
                    this.contrato = res.data;

                    axios.get(this.base + '/estadocontratos/' + res.data.id).then((res2) => {
                            
                    }).catch((err) => {
                        console.log(err);
                    });
                            
                    axios.post(this.base + '/contratobono/' + res.data.id, upbonos).then((res2) => {
                        console.log('bonos ag');
                    }).catch((err) => {
                        console.log(err);
                    });
                            
                    axios.post(this.base + '/contratoservicio/' + res.data.id, upServicios).then((res2) => {
                        console.log('servicios ag');
                    }).catch((err) => {
                        console.log(err);
                    });
    
                    axios.post(this.base + '/contratocuota/' + res.data.id, upCuotas).then((res2) => {
                        console.log('cuotas ag');
                    }).catch((err) => {
                        console.log(err);
                    });   
                    this.progresoCon = 90;
                    
                    axios.delete(this.base + '/contratopagoeliminatodo/' + this.contratoid).then((res2) => {
                        console.log('pagos elim');
                    }).catch((err) => {
                        console.log(err);
                    }); 

                    for (let i = 0; i < this.pagos.length; i++) {

                        axios.post(this.base + '/contratopago/' + res.data.id, this.pagos[i]).then((res2) => {
                            this.pagos[i] = res2.data;
                            console.log('pago ag' + i);
                        }).catch((err) => {
                            console.log(err);
                        });   
                        this.progresoCon = 83 + i;
                    };

                    this.comentarioUp(2);
                            
                }).catch((err) => {
                    console.log(err);
                });     
            }
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
                for (let i = 0; i < res.data.length; i++) {
                    this.pagos.push(res.data[i]);
                    
                    if (res.data[i].tipo == 'EFECTIVO') {
                        this.total_efectivo = parseFloat(this.total_efectivo) + parseFloat(res.data[i].valor); 
                    } else if (res.data[i].tipo == 'CHEQUE') {
                        this.total_cheque = parseFloat(this.total_cheque) + parseFloat(res.data[i].valor); 
                    } else if (res.data[i].tipo == 'TRANSFERENCIA') {
                        this.total_transferencia = parseFloat(this.total_transferencia) + parseFloat(res.data[i].valor); 
                    } else if (res.data[i].tipo == 'DEPOSITO') {
                        this.total_deposito = parseFloat(this.total_deposito) + parseFloat(res.data[i].valor); 
                    } else if (res.data[i].tipo == 'TARJETA') {
                        this.total_tarjeta = parseFloat(this.total_tarjeta) + parseFloat(res.data[i].valor); 
                    }

                    this.total = this.total_efectivo + this.total_cheque + this.total_deposito + this.total_transferencia + this.total_tarjeta;
                }
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
        },
        showModal(){
            this.$refs.myModal.show();
        },
        hideModal(){
            this.$refs.myModal.hide();
        },
        showModal2(){
            this.$refs.myModal2.show();
        },
        hideModal2(){
            this.$refs.myModal2.hide();
        },
        getGlobales(){
            axios.get(this.base + '/variables').then((res) => {
                this.globales = res.data;
            }).catch((err) => {
                console.log(err);
            });
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

            var val = parseFloat(parseFloat(con.anosPactados) * parseFloat(vg[0].valor)) + parseFloat(con.otrosServicios) + parseFloat(parseFloat(con.boordingCard) * parseFloat(vg[3].valor)) 
                    + parseFloat(con.xpack) * parseFloat(vg[1].valor) + parseFloat(con.gastoLegal) * parseFloat(vg[2].valor)
                    + parseFloat(con.servicioInternacional) * parseFloat(vg[4].valor) + parseFloat(con.club) * parseFloat(vg[5].valor);

            this.contrato.valorContrato = val;
            this.calcularSaldos();
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
        },
        getMisServicios(){
            axios.get(this.base + '/contratoservicio/' + this.contratoid).then((res) => {
                for (let i = 0; i < res.data.length; i++) {
                    this.misServicios.push(res.data[i].id);                    
                }
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
            if (lugar == 1) {
                axios.post(this.base + '/comentarios/' + this.contrato.titular, this.comentarioTitular).then((res2) => {
                    Toastr.success("Comentario Guardado.");
                    this.comentarioTitular = {
                        lugar: 'CONTRATO',
                        comentario: ''
                    };
                    this.getComentarios();
                }).catch((err2) => {
                    Toastr.error('Error intentar guardar el comentario.');
                    console.log(err2);
                });                
            } else if (lugar == 2){
                axios.post(this.base + '/comentarios/' + this.contrato.titular, this.comentarioContrato).then((res2) => {
                    Toastr.success("Se ha cambiado el valor del contrato.");
                    this.comentarioContrato = {
                        lugar: 'CONTRATO',
                        comentario: ''
                    };
                    this.getComentarios();
                }).catch((err2) => {
                    Toastr.error('Error intentar Cambiar el valor del contrato.');
                    console.log(err2);
                });   
            } else if (lugar == 3){
                axios.post(this.base + '/comentarios/' + this.contrato.titular, this.comentarioGeneral).then((res2) => {
                    Toastr.success("Comentario Guardado.");
                    this.comentarioGeneral = {
                        lugar: 'CONTRATO',
                        comentario: ''
                    };
                    this.getComentarios();
                }).catch((err2) => {
                    Toastr.error('Error intentar guardar el comentario.');
                    console.log(err2);
                });   
            }
        },
        titularesUp(){
            axios.put(this.base + '/clientes/' + this.contrato.titular,this.titular).then((res) => {
                Toastr.success("Datos del Titular actualizados.");
                if (this.contrato.cotitular > 0) {
                    axios.put(this.base + '/clientes/' + this.contrato.cotitular, this.cotitular).then((res2) => {
                        Toastr.success("Datos del cotitular actualizados.");
                    }).catch((err2) => {
                        Toastr.error('Error intentar actualizar los datos del Cotitular.');
                        console.log(err2);
                    });
                }
                this.comentarioUp(1);
            }).catch((err) => {
                Toastr.error('Error intentar actualizar los datos del Titular.');
                console.log(err);
            });
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
                
                this.getEstados();
                this.getCiudades();
                this.getComentarios();

                if (this.contrato.cotitular > 0) {
                    axios.get(this.base + '/clientes/' + this.contrato.cotitular).then((res2) => {
                        this.cotitular = res2.data;
                        this.getEstados2();
                        this.getCiudades2();
                    }).catch((err2) => {
                        console.log(err2);
                    });
                }
            }).catch((err) => {
                console.log(err);
            });
        },
        estadoContrato(estado){
            axios.get(this.base + '/estadoserviciocontrato/' + estado + '/' + this.contratoid).then((res) => {
                this.contrato.estadoServicio = estado;
                if (estado == 0) {
                    Toastr.success("El contrato ha sido Activado!!");
                } else if (estado == 1) {
                    Toastr.success("El contrato ha sido Desactivaedo!!");
                } else {
                    Toastr.success("El contrato ha sido Anulado!!");
                }
            }).catch((err) => {
                Toastr.error("Error al cambiar el estado del contrato.");
                console.log(err);
            });
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
    },
}
</script>