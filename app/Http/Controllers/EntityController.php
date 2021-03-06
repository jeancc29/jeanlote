<?php

namespace App\Http\Controllers;

use App\Entity;
use App\Types;
use Request;

use Illuminate\Support\Facades\Route; 
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;


use Faker\Generator as Faker;
use App\Generals;
use App\Sales;
use App\Salesdetails;
use App\Blockslotteries;
use App\Blocksplays;
use App\Stock;
use App\Tickets;
use App\Cancellations;
use App\Days;
use App\Payscombinations;
use App\Awards;
use App\Draws;
use App\Branches;
use App\Users;
use App\Roles;
use App\Commissions;
use App\Permissions;

use App\Http\Resources\LotteriesResource;
use App\Http\Resources\SalesResource;
use App\Http\Resources\BranchesResource;
use App\Http\Resources\RolesResource;
use App\Http\Resources\UsersResource;
use App\Http\Resources\EntityResource;

use Illuminate\Support\Facades\Crypt;

class EntityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $controlador = Route::getCurrentRoute()->getName(); 
        if(!strpos(Request::url(), '/api/')){
            return view('entidades.index', compact('controlador'));
        }

        

        $fechaActual = strtotime(date("d-m-Y H:i:00",time()));
        // $fechaActual = strtotime($fechaActual['mday'] . ' ' . $fechaActual['month'].' '.$fechaActual['year'] . ' ' . time() );
        
    
        $cadena = "060829";
        $buscar = "99";
    
        
    
        return Response::json([
            'entidades' => EntityResource::collection(Entity::whereIn('status', [1,0])->get()),
            'tipos' => Types::whereRenglon('entidad')->whereIn('descripcion', ['Banco', 'Otros'])->get()
        ], 201);
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
        $datos = request()->validate([
            'datos.id' => 'required',
            'datos.nombre' => 'required',
            'datos.status' => 'required',
            'datos.idTipo' => 'required'
    
        ])['datos'];


        $entidad = Entity::whereId($datos['id'])->first();

        if($entidad != null){
            $entidad->nombre = $datos['nombre'];
            $entidad->status = $datos['status'];
            $entidad->idTipo = $datos['idTipo'];
            $entidad->save();
        }else{
            Entity::create([
                'nombre' => $datos['nombre'],
                'status' => $datos['status'],
                'idTipo' => $datos['idTipo']
            ]);
        }
    


        return Response::json([
            'errores' => 0,
            'mensaje' => 'Se ha guardado correctamente',
            'entidades' => EntityResource::collection(Entity::whereIn('status', [1,0])->get()),
            'tipos' => Types::whereRenglon('entidad')->whereIn('descripcion', ['Banco', 'Otros'])->get()
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Entity  $entity
     * @return \Illuminate\Http\Response
     */
    public function show(Entity $entity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Entity  $entity
     * @return \Illuminate\Http\Response
     */
    public function edit(Entity $entity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entity  $entity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Entity $entity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entity  $entity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Entity $entity)
    {
       
        $datos = request()->validate([
            'datos.id' => 'required'
    
        ])['datos'];


        $entidad = Entity::whereId($datos['id'])->first();

        if($entidad != null){
            $entidad->status = 2;
            $entidad->save();
        }

        return Response::json([
            'errores' => 0,
            'mensaje' => 'Se ha eliminado correctamente',
            'entidades' => EntityResource::collection(Entity::whereIn('status', [1,0])->get()),
            'tipos' => Types::whereRenglon('entidad')->whereIn('descripcion', ['Banco', 'Otros'])->get()
        ], 201);
    }
}
