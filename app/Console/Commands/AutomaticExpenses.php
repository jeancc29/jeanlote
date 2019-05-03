<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Draws;
use App\Branches;
use Carbon\Carbon;
use App\transactions;
use App\Types;
use App\Users;
use App\Entity;
use App\Classes\Helper;
use App\Http\Resources\AutomaticexpensesResource;
date_default_timezone_set("America/Santiago");


class AutomaticExpenses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transacciones:gastos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Se restaran los gastos automaticos';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // $fichero = 'gente.txt';
        // // Abre el fichero para obtener el contenido existente
        // $actual = file_get_contents($fichero);
        // // Añade una nueva persona al fichero
        // $actual .= "John Smith\n";
        // // Escribe el contenido al fichero
        // file_put_contents($fichero, $actual);

        $fecha = Carbon::now();
        

        $fechaDesde = $fecha->year.'-'.$fecha->month.'-'.$fecha->day. " 23:59:00";
        $fechaHasta = $fecha->year.'-'.$fecha->month.'-'.$fecha->day. " 24:59:00";
        $usuario = Users::whereNombres("Sistema")->first();
        $tipo = Types::whereRenglon('transaccion')->whereDescripcion("Consumo automatico de banca")->first();
        $idTipoEntidad1 = Types::where(['renglon' => 'entidad', 'descripcion' => 'Banca'])->first();
        $idTipoEntidad2 = Types::where(['renglon' => 'entidad', 'descripcion' => 'Sistema'])->first();
        $entidad = Entity::whereNombre("Sistema")->first();
       
        if($usuario == null || $tipo == null)
            return;
            
        

        
        $bancas = Branches::whereStatus(1)->has('gastos')->get();
        foreach($bancas as $b){
            $gastos = AutomaticexpensesResource::collection($b->gastos);
            foreach($gastos as $g){

                //Verificamos si el gasto es diario
                if(strtolower($g->frecuencia->descripcion) == "diario"){
                    //Verificamos que la hora de la fecha actual sean las 12AM, osea las 24 que es igual a la hora cero 0
                    if($fecha->hour == 15){
                       //Verificamos que no haya transacciones realizadas en la fecha actual para la banca y el gasto especificado
                        if(transactions::where(['idEntidad1' => $b['id'], 'idGasto' => $g->id, 'status' => 1])->whereBetween('created_at', array($fechaDesde, $fechaHasta))->first() != null)
                            continue;
                        
                            $saldo = (new Helper)->saldo($b['id'], true);
                            $t = transactions::create([
                                'idUsuario' => $usuario->id,
                                'idTipo' => $tipo->id,
                                'idTipoEntidad1' => $idTipoEntidad1->id,
                                'idTipoEntidad2' => $idTipoEntidad2->id,
                                'idEntidad1' => $b['id'],
                                'idEntidad2' => $entidad->id,
                                'entidad1_saldo_inicial' => $saldo,
                                'entidad2_saldo_inicial' => 0,
                                'debito' => 0,
                                'credito' => $g['monto'],
                                'idGasto' => $g['id'],
                                'entidad1_saldo_final' => $saldo - $g['monto'],
                                'entidad2_saldo_final' => 0
                            ]);
                        $this->info('klk: ');
                    }
                        
                }
                
            }
        }

        


        // Draws::create([
        //     'descripcion' => 'Sorteo cronjob',
        //     'bolos' => 3,
        //     'cantidadNumeros' => 4,
        //     'status' => 1
        // ]);
    }
}
