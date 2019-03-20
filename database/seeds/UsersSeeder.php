<?php

use Illuminate\Database\Seeder;
use App\Users as u;
use Illuminate\Support\Facades\Crypt; 

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        u::create([
            'nombres' => 'Jean carlos',
            'apellidos' => 'Contreras',
            'sexo' => 'Masculino',
            'email' => 'jean29@outlook.com',
            'celular' => '8094266800',
            'idRole' => 1,
            'usuario' => 'jean',
            'password' => Crypt::encryptString('123')
        ]);
    }
}
