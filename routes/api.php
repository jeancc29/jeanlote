<?php

use Illuminate\Http\Request;
use Faker\Generator as Faker;
use App\Lotteries;
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

date_default_timezone_set("America/Santiago");



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


//Route::get('/principal', 'PrincipalController@index');
//Route::get('/principal', 'PrincipalController@index');

//Route::apiResource('principal', 'PrincipalController');
Route::post('/acceder', 'LoginController@accederApi');

Route::get('/principal', 'PrincipalController@index');
Route::post('/principal/indexPost', 'PrincipalController@indexPost');
Route::post('/principal/guardar', 'PrincipalController@store');
Route::post('/principal/montodisponible', 'PrincipalController@montodisponible');
Route::post('/principal/pruebahttp', 'PrincipalController@pruebahttp');
Route::post('/principal/pagar', 'PrincipalController@pagar');
Route::post('/principal/duplicar', 'PrincipalController@duplicar');
Route::post('/principal/cancelar', 'PrincipalController@cancelar');

Route::post('/imagen/guardar', 'PrincipalController@imagen');
Route::post('/principal/sms', 'PrincipalController@sms');


Route::get('/loterias', 'LotteriesController@index');
Route::post('/loterias/guardar', 'LotteriesController@store');
Route::post('/loterias/eliminar', 'LotteriesController@destroy');

Route::get('/bancas', 'BranchesController@index');
Route::post('/bancas/guardar', 'BranchesController@store');
Route::post('/bancas/eliminar', 'BranchesController@destroy');

Route::get('/usuarios', 'UsersController@index');
Route::post('/usuarios/guardar', 'UsersController@store');
Route::post('/usuarios/eliminar', 'UsersController@destroy');

Route::get('/horarios', 'HorariosController@index');
Route::post('/horarios/normal/guardar', 'HorariosController@store');


Route::get('/premios', 'AwardsController@index');
Route::post('/premios/guardar', 'AwardsController@store');

Route::get('/bloqueos', 'BlockslotteriesController@index');
Route::post('/bloqueos/loterias/guardar', 'BlockslotteriesController@store');
Route::post('/bloqueos/jugadas/guardar', 'BlocksplaysController@store');



Route::post('/reportes/monitoreo/', 'ReportesController@monitoreo');
Route::post('/reportes/ventas/', 'ReportesController@ventas');
Route::post('/reportes/jugadas/', 'ReportesController@jugadas');


Route::get('/entidades', 'EntityController@index');
Route::post('/entidades/guardar', 'EntityController@store');
Route::post('/entidades/eliminar', 'EntityController@destroy');

Route::get('/transacciones', 'TransactionsController@index');
Route::get('/transacciones/grupo', 'TransactionsController@grupo');
Route::post('/transacciones/saldo', 'TransactionsController@saldo');
Route::post('/transacciones/guardar', 'TransactionsController@store');
Route::post('/transacciones/buscar', 'TransactionsController@buscar');
Route::post('/transacciones/buscarTransaccion', 'TransactionsController@buscarTransaccion');
