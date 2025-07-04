<?php

use Illuminate\Database\Seeder;
use App\variable;

class VariablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        variable::create([
            'nombre' => 'Valor Anual',
            'valor' => '500'
        ]);
        
        variable::create([
            'nombre' => 'Xpack',
            'valor' => '200'
        ]);
        
        variable::create([
            'nombre' => 'Gasto Legal',
            'valor' => '450'
        ]);
        
        variable::create([
            'nombre' => 'Boording Card',
            'valor' => '250'
        ]);
        
        variable::create([
            'nombre' => 'Servicio Internacional',
            'valor' => '250'
        ]);
        
        variable::create([
            'nombre' => 'Club',
            'valor' => '200'
        ]);
        
        variable::create([
            'nombre' => 'Maximo de Bonos por Contrato',
            'valor' => '2'
        ]);

        variable::create([
            'nombre' => 'Correos Manifiesto',
            'valor' => ''
        ]);

        variable::create([
            'nombre' => 'Correos Autorizacion',
            'valor' => ''
        ]);

        variable::create([
            'nombre' => 'Correos Verficacion',
            'valor' => ''
        ]);

        variable::create([
            'nombre' => 'Correos Nomina',
            'valor' => ''
        ]);

        variable::create([
            'nombre' => 'Correos Cartera',
            'valor' => ''
        ]);

        variable::create([
            'nombre' => 'Representante Legal',
            'valor' => 'JOSE MANUEL MOLINA SAMPER'
        ]);

        variable::create([
            'nombre' => 'Nacionalidad del representante Legal',
            'valor' => 'colombiano'
        ]);

        variable::create([
            'nombre' => 'Cedula del representante Legal',
            'valor' => '093300193-5'
        ]);

        variable::create([
            'nombre' => 'Nombre comercial de la Empresa',
            'valor' => 'ONE CLASS TRAVEL'
        ]);

        variable::create([
            'nombre' => 'Nombre de la Empresa',
            'valor' => 'NASELLORIL S.A.'
        ]);

        variable::create([
            'nombre' => 'RUC de la Empresa',
            'valor' => '0992991291001'
        ]);

        variable::create([
            'nombre' => 'Direccion de la Empresa',
            'valor' => 'Guayaquil. Av. Carlos Julio Arosemena C.C Albán Borja puerta 1 local 75 P2'
        ]);

        variable::create([
            'nombre' => 'Reslucion de Controverciass de la Empresa',
            'valor' => 'Cámara de Comercio de Guayaquil'
        ]);

        variable::create([
            'nombre' => 'Ciudad del representante Legal',
            'valor' => 'Guayaquil'
        ]);

        variable::create([
            'nombre' => 'Telefonos Principales de la empresa',
            'valor' => '1700 500 500'
        ]);

        variable::create([
            'nombre' => 'Sucursales',
            'valor' => 'Guayaquil;Quito;Ambato'
        ]);

        variable::create([
            'nombre' => 'Telefonos por sucursal',
            'valor' => '(04)220 32 75 /70/73;(02) 2922064;(03) 2849276'
        ]);

        variable::create([
            'nombre' => 'Direccion po sucursal',
            'valor' => 'Guayaquil--CENTRO COMERCIAL ALBAN BORJA AV. CARLOS JULIO AROSEMENA E ILLANES LOCALES 74
            Y 75;Manta--CENTRO COMERCIAL PLAZA DEL SOL "THE HAPPENING PLACE" LOCAL 18B'
        ]);

        variable::create([
            'nombre' => 'Paginas Web',
            'valor' => 'www.oneclassecuador.com.ec'
        ]);

        variable::create([
            'nombre' => 'Correos de contacto',
            'valor' => 'reservasoc@oneclassecuador.com;servioc@oneclassecuador.com'
        ]);
    }
}
