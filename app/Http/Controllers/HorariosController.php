<?php

namespace App\Http\Controllers;

use App\Days;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route; 
use Illuminate\Support\Facades\Crypt; 

class HorariosController extends Controller
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
        
        return view('horarios.index', compact('controlador'));
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
     * @param  \App\Days  $days
     * @return \Illuminate\Http\Response
     */
    public function show(Days $days)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Days  $days
     * @return \Illuminate\Http\Response
     */
    public function edit(Days $days)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Days  $days
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Days $days)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Days  $days
     * @return \Illuminate\Http\Response
     */
    public function destroy(Days $days)
    {
        //
    }
}
