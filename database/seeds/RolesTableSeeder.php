<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'Super Usuario',
            'slug' => 'super.user',
            'description' => 'Usuario que posee control total del sistema.',
            'special' => 'all-access'
        ]);
        
        Role::create([
            'name' => 'Suspendido',
            'slug' => 'suspendido',
            'description' => 'Usuario que no posee acceso al sistema.',
            'special' => 'no-access'
        ]);
        
        Role::create([
            'name' => 'Afiliado',
            'slug' => 'afiliado',
            'description' => 'Usuario que es cliente afiliado y tiene acceso al sistema.',
            'special' => 'no-access'
        ]);
        
        Role::create([
            'name' => 'Administrador Web',
            'slug' => 'administrador.web',
            'description' => 'Usuario que es cliente afiliado y tiene acceso al sistema.',
            'special' => 'no-access'
        ]);
    }
}
