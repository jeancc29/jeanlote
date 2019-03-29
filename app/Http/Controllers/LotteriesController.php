<?php

namespace App\Http\Controllers;

use App\Lotteries;
use Request;
use Illuminate\Support\Facades\Route; 
use Illuminate\Support\Facades\Response;


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

use Illuminate\Support\Facades\Crypt;

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
        if(!strpos(Request::url(), '/api/')){
            return view('loterias.index', compact('controlador'));
        }

        

        $fechaActual = strtotime(date("d-m-Y H:i:00",time()));
        // $fechaActual = strtotime($fechaActual['mday'] . ' ' . $fechaActual['month'].' '.$fechaActual['year'] . ' ' . time() );
        
    
        $cadena = "060829";
        $buscar = "99";
    
        
    
        return Response::json([
            'loterias' => LotteriesResource::collection( Lotteries::whereIn('status', [1,0])->get()),
            'dias' => Days::all(),
            'sorteos' => Draws::all(),
        ], 201);

        
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
        $datos = request()->validate([
            'datos.id' => 'required',
            'datos.descripcion' => 'required',
            'datos.abreviatura' => 'required|min:1|max:4',
            'datos.status' => 'required',
            'datos.horaCierre' => 'required',
            'datos.sorteos' => 'required',
    
            // 'datos.primera' => 'required',
            // 'datos.segunda' => 'required',
            // 'datos.tercera' => 'required',
            // 'datos.primeraSegunda' => 'required',
            // 'datos.primeraTercera' => 'required',
            // 'datos.segundaTercera' => 'required',
            // 'datos.tresNumeros' => 'required',
            // 'datos.dosNumeros' => 'required',
    
            //'datos.dias' => 'required',
        ])['datos'];
    
        $errores = 0;
        $mensaje = '';
    
       
        $loteria = Lotteries::whereId($datos['id'])->get()->first();
    
        /********************* PAGOS COMBINACIONES ************************/
        //$combinaciones = Payscombinations::where('idLoteria', $datos['id'])->get()->first();
        /********************* END PAGOS COMBINACIONES ************************/
    
        if($loteria != null){
            $loteria['descripcion'] = $datos['descripcion'];
            $loteria['abreviatura'] = $datos['abreviatura'];
            $loteria['status'] = $datos['status'];
            $loteria['horaCierre'] = $datos['horaCierre'];
            $loteria->save();
    
           /********************* PAGOS COMBINACIONES ************************/
            // if($combinaciones != null){
            //     $combinaciones['primera'] = $datos['primera'];
            //     $combinaciones['segunda'] = $datos['segunda'];
            //     $combinaciones['tercera'] = $datos['tercera'];
            //     $combinaciones['primeraSegunda'] = $datos['primeraSegunda'];
            //     $combinaciones['primeraTercera'] = $datos['primeraTercera'];
            //     $combinaciones['segundaTercera'] = $datos['segundaTercera'];
            //     $combinaciones['tresNumeros'] = $datos['tresNumeros'];
            //     $combinaciones['dosNumeros'] = $datos['dosNumeros'];
            //     $combinaciones->save();
            // }else{
            //     Payscombinations::create([
            //         'idLoteria' => $loteria['id'],
            //         'primera' => $datos['primera'],
            //         'segunda' => $datos['segunda'],
            //         'tercera' => $datos['tercera'],
            //         'primeraSegunda' => $datos['primeraSegunda'],
            //         'primeraTercera' => $datos['primeraTercera'],
            //         'segundaTercera' => $datos['segundaTercera'],
            //         'tresNumeros' => $datos['tresNumeros'],
            //         'dosNumeros' => $datos['dosNumeros']
            //     ]);
            // }
    
            /********************* END PAGOS COMBINACIONES ************************/
            
    
            /********************* DIAS ************************/
            //Eliminamos los dias para luego agregarlos nuevamentes
            // $loteria->dias()->detach();
            // $dias = collect($datos['dias'])->map(function($d) use($loteria){
                
            //     return ['idDia' => $d['id'], 'idLoteria' => $loteria['id'] ];
            // });
            // $loteria->dias()->attach($dias);
            /********************* END DIAS ************************/
    
            $loteria->sorteos()->detach();
            $sorteos = collect($datos['sorteos'])->map(function($s) use($loteria){
                
                return ['idSorteo' => $s['id'], 'idLoteria' => $loteria['id'] ];
            });
            $loteria->sorteos()->attach($sorteos);
    
        }else{
            $loteria = Lotteries::create([
                'descripcion' => $datos['descripcion'],
                'abreviatura' => $datos['abreviatura'],
                'horaCierre' => $datos['horaCierre'],
                'status' => $datos['status'],
            ]);
    
            /********************* PAGOS COMBINACIONES ************************/
            // Payscombinations::create([
            //     'idLoteria' => $loteria['id'],
            //     'primera' => $datos['primera'],
            //     'segunda' => $datos['segunda'],
            //     'tercera' => $datos['tercera'],
            //     'primeraSegunda' => $datos['primeraSegunda'],
            //     'primeraTercera' => $datos['primeraTercera'],
            //     'segundaTercera' => $datos['segundaTercera'],
            //     'tresNumeros' => $datos['tresNumeros'],
            //     'dosNumeros' => $datos['dosNumeros']
            // ]);
            /********************* END PAGOS COMBINACIONES ************************/
    
            /********************* DIAS ************************/
            //Eliminamos los dias para luego agregarlos nuevamentes
            // $loteria->dias()->detach();
            // $dias = collect($datos['dias'])->map(function($d) use($loteria){
            //     return ['idDia' => $d['id'], 'idLoteria' => $loteria['id'] ];
            // });
            // $loteria->dias()->attach($dias);
            /********************* END DIAS ************************/
    
            $loteria->sorteos()->detach();
            $sorteos = collect($datos['sorteos'])->map(function($s) use($loteria){
                return ['idSorteo' => $s['id'], 'idLoteria' => $loteria['id'] ];
            });
            $loteria->sorteos()->attach($sorteos);
        }
    
        return Response::json([
            'errores' => 0,
            'mensaje' => 'Se ha guardado correctamente'
        ], 201);
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
