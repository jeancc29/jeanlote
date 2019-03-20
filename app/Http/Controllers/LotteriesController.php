<?php

namespace App\Http\Controllers;

use App\Lotteries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route; 

class LotteriesController extends Controller
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

       // dd($controlador);

        
        return view('loterias.index', compact('controlador'));
        //return view('loterias.index');
    }

    public function bloqueos()
    {
        $controlador = Route::getCurrentRoute()->getName(); 
        // $route = Route();
        //echo $controlador;

       // dd($controlador);

        
        return view('loterias.bloqueos', compact('controlador'));
        //return view('loterias.index');
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
     * @param  \App\Lotteries  $lotteries
     * @return \Illuminate\Http\Response
     */
    public function show(Lotteries $lotteries)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lotteries  $lotteries
     * @return \Illuminate\Http\Response
     */
    public function edit(Lotteries $lotteries)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lotteries  $lotteries
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lotteries $lotteries)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lotteries  $lotteries
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lotteries $lotteries)
    {
        //
    }
}
