<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Cargo;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Super Usuario',
            'email' => 'info@systemsoca.com',
            'password' => bcrypt('system2019')
        ]);

        DB::table('role_user')->insert([
            'role_id' => 1,
            'user_id' => 1
        ]);

        Cargo::create([
            'nombre' => 'LINER'
        ]);
        Cargo::create([
            'nombre' => 'CLOSER'
        ]);
        Cargo::create([
            'nombre' => 'JEFE DE SALA'
        ]);
        Cargo::create([
            'nombre' => 'TMK'
        ]);
        Cargo::create([
            'nombre' => 'OPC'
        ]);
    }
}
