<?php

namespace App\Http\Controllers;

use App\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route; 
use Illuminate\Support\Facades\Crypt; 

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $controlador = Route::getCurrentRoute()->getName(); 
        // $route = Route();
        //echo $controlador;
        
        return view('login.index', compact('controlador'));
    }

    public function acceder(Request $request)
    {
        $data = request()->validate([
            'usuario' => 'required',
            'password' => 'required'
        ], [
            'usuario.required' => 'El campo usuario es obligatorio',
            'password.required' => 'El campo password es obligatorio'
        ]);

       // dd($data);

        

        $u = Users::where(['usuario' => $data['usuario']])->get()->first();

    
        
   

        if($u == null){
            return redirect('login')->withErrors([
                'usuario' => 'Usuario o contraseña incorrectos'
            ]);
        }

        if(Crypt::decryptString($u->password) != $data['password']){
            return redirect('login')->withErrors([
                'password' => 'Contraseña incorrecta'
            ]);
        }
        
        //Session::put('idUsuario', $u->id);

       session(['idUsuario' => $u->id]);

      

       return redirect()->route('principal');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function show(Users $users)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function edit(Users $users)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Users $users)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function destroy(Users $users)
    {
        //
    }
}
