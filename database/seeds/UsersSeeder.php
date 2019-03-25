<?php

use Illuminate\Database\Seeder;
use App\Users as u;
use App\Permissions as p;
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
        $usuario = u::create([
            'nombres' => 'Jean carlos',
            'apellidos' => 'Contreras',
            'sexo' => 'Masculino',
            'email' => 'jean29@outlook.com',
            'celular' => '8094266800',
            'idRole' => 1,
            'usuario' => 'jean',
            'password' => Crypt::encryptString('123')
        ]);
        
        $usuario->permisos()->detach();
        $permisos = p::all();
        $permisos = collect($permisos)->map(function($d) use($usuario){
            return ['idPermiso' => $d['id'], 'idUsuario' => $usuario['id']];
        });
       
        $usuario->permisos()->attach($permisos);
    }
}
