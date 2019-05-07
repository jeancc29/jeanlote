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

class Prueba extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'prueba:a';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gastos automaticos';

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

        
        $this->info(public_path());
    }
}