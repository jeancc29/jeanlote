<?php

namespace App\Http\Controllers;

use App\Blockslotteries;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route; 

class BlockslotteriesController extends Controller
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
        
        return view('bloqueos.index', compact('controlador'));
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
     * @param  \App\Blockslotteries  $blockslotteries
     * @return \Illuminate\Http\Response
     */
    public function show(Blockslotteries $blockslotteries)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blockslotteries  $blockslotteries
     * @return \Illuminate\Http\Response
     */
    public function edit(Blockslotteries $blockslotteries)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blockslotteries  $blockslotteries
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blockslotteries $blockslotteries)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blockslotteries  $blockslotteries
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blockslotteries $blockslotteries)
    {
        //
    }
}
