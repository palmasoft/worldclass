@extends('layouts.app')

@section('content')
    <div class="container m-2">
        <div class="row justify-content-center">
            <div class="col-12">
                
                <div role="tablist">

                    <b-card no-body class="mb-1">                        
                        <b-card-header header-tag="header" class="p-1" role="tab">
                            <b-btn block href="#" v-b-toggle.accordion1 variant="info">Variables Globales</b-btn>
                        </b-card-header>
                        <b-collapse id="accordion1" visible accordion="my-accordion" role="tabpanel">
                            <b-card-body>
                                <variables-component base="{{ url('/crud') }}"></variables-component>
                            </b-card-body>
                        </b-collapse>
                    </b-card>  

                    <b-card no-body class="mb-1">
                        <b-card-header header-tag="header" class="p-1" role="tab">
                            <b-btn block href="#" v-b-toggle.accordion2 variant="info">Sedes</b-btn>
                        </b-card-header>
                        <b-collapse id="accordion2" accordion="my-accordion" role="tabpanel">
                            <b-card-body>
                                <sedes-component base="{{ url('/crud') }}"></sedes-component>
                            </b-card-body>
                        </b-collapse>
                    </b-card>    

                    <b-card no-body class="mb-1">
                        <b-card-header header-tag="header" class="p-1" role="tab">
                            <b-btn block href="#" v-b-toggle.accordion3 variant="info">Bonos</b-btn>
                        </b-card-header>
                        <b-collapse id="accordion3" accordion="my-accordion" role="tabpanel">
                            <b-card-body>
                                <bonos-component base="{{ url('/crud') }}"></bonos-component>
                            </b-card-body>
                        </b-collapse>
                    </b-card>           

                    <b-card no-body class="mb-1">
                        <b-card-header header-tag="header" class="p-1" role="tab">
                            <b-btn block href="#" v-b-toggle.accordion4 variant="info">Servicios</b-btn>
                        </b-card-header>
                        <b-collapse id="accordion4" accordion="my-accordion" role="tabpanel">
                            <b-card-body>
                                <servicios-component base="{{ url('/crud') }}"></servicios-component>
                            </b-card-body>
                        </b-collapse>
                    </b-card>  
                    
                    <b-card no-body class="mb-1">
                        <b-card-header header-tag="header" class="p-1" role="tab">
                            <b-btn block href="#" v-b-toggle.accordion5 variant="info">Productos</b-btn>
                        </b-card-header>
                        <b-collapse id="accordion5" accordion="my-accordion" role="tabpanel">
                            <b-card-body>
                                <productos-component base="{{ url('/crud') }}"></productos-component>
                            </b-card-body>
                        </b-collapse>
                    </b-card>
                    
                    <b-card no-body class="mb-1">
                        <b-card-header header-tag="header" class="p-1" role="tab">
                            <b-btn block href="#" v-b-toggle.accordion6 variant="info">Proveedores</b-btn>
                        </b-card-header>
                        <b-collapse id="accordion6" accordion="my-accordion" role="tabpanel">
                            <b-card-body>
                                <proveedores-component base="{{ url('/crud') }}"></proveedores-component>
                            </b-card-body>
                        </b-collapse>
                    </b-card>  

                    <b-card no-body class="mb-1">
                        <b-card-header header-tag="header" class="p-1" role="tab">
                            <b-btn block href="#" v-b-toggle.accordion7 variant="info">Enunciados Anexo 1</b-btn>
                        </b-card-header>
                        <b-collapse id="accordion7" accordion="my-accordion" role="tabpanel">
                            <b-card-body>
                                <enunciados-component base="{{ url('/crud') }}"></enunciados-component>
                            </b-card-body>
                        </b-collapse>
                    </b-card>           

                </div>

            </div>
        </div>
    </div>
@endsection