<?php

use Illuminate\Database\Seeder;
use App\Servicio;
use App\Bono;

class ServiciosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //servicios

        Servicio::create([
            'servicio' => 'Hoteles hasta 25%.',
            'tipo' => 1,
            'porcentaje' => 25
        ]);

        Servicio::create([
            'servicio' => 'Tours y Excurciones hasta 25%.',
            'tipo' => 1,
            'porcentaje' => 25
        ]);

        Servicio::create([
            'servicio' => 'Paquetes de ultima Hora hasta 35%.',
            'tipo' => 1,
            'porcentaje' => 35
        ]);

        Servicio::create([
            'servicio' => 'Paquetes por armar hasta 15%.',
            'tipo' => 1,
            'porcentaje' => 15
        ]);

        Servicio::create([
            'servicio' => 'Tiketes Aereos hasta 10%.',
            'tipo' => 1,
            'porcentaje' => 10
        ]);

        Servicio::create([
            'servicio' => 'Paquete todo incluido hasta 25%.',
            'tipo' => 1,
            'porcentaje' => 25
        ]);

        Servicio::create([
            'servicio' => 'Paquetes armados hasta 25%.',
            'tipo' => 1,
            'porcentaje' => 25
        ]);

        

        Servicio::create([
            'servicio' => 'Resort hasta 25%.',
            'tipo' => 2,
            'porcentaje' => 25
        ]);

        Servicio::create([
            'servicio' => 'Renta de Autos hasta 10%.',
            'tipo' => 2,
            'porcentaje' => 10
        ]);

        Servicio::create([
            'servicio' => 'Tikets aereos hasta 15%.',
            'tipo' => 2,
            'porcentaje' => 15
        ]);

        Servicio::create([
            'servicio' => 'Cruceros hasta 25%.',
            'tipo' => 2,
            'porcentaje' => 25
        ]);

        Servicio::create([
            'servicio' => 'Hoteles hasta 25%.',
            'tipo' => 2,
            'porcentaje' => 25
        ]);

        Servicio::create([
            'servicio' => 'Paquetes hasta 25%.',
            'tipo' => 2,
            'porcentaje' => 25
        ]);

        Servicio::create([
            'servicio' => 'Vacaciones y Eventos hasta 25%.',
            'tipo' => 2,
            'porcentaje' => 25
        ]);

        Servicio::create([
            'servicio' => 'Deportes extremos y paquetes de divercion hasta 10%.',
            'tipo' => 2,
            'porcentaje' => 10
        ]);

        //bonos
        Bono::create([
            'bono' => 'ORLANDO'
        ]);
        
        Bono::create([
            'bono' => 'LAS VEGAS'
        ]);
        
        Bono::create([
            'bono' => 'CIUDAD DE PANAMA'
        ]);
        
        Bono::create([
            'bono' => 'ISLA MARGARITA'
        ]);
        
        Bono::create([
            'bono' => 'SALINAS'
        ]);
        
        Bono::create([
            'bono' => 'DISCOUNT CARD FRIDAYS'
        ]);
        
        Bono::create([
            'bono' => 'DISCOUNT CARD PIZZA HUT'
        ]);
    }
}
