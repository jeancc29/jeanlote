<?php
namespace App\Classes;

use App\transactions;
use App\Types;


class Helper{
    public function saldo($id, $es_banca = true){
        $datos = Array("id" => $id, "es_banca" => $es_banca);

        $saldo_inicial = 0;

        if($datos["es_banca"] == 1){
            $idTipoEntidad1 = Types::where(['renglon' => 'entidad', 'descripcion' => 'Banca'])->first();
            $debito = transactions::where(
                [
                    'idEntidad1'=> $datos["id"], 
                    'idTipoEntidad1' => $idTipoEntidad1->id, 
                    'status' => 1
                ])->sum('debito');
            $credito =  transactions::where(
                [
                    'idEntidad1'=> $datos["id"], 
                    'idTipoEntidad1' => $idTipoEntidad1->id, 
                    'status' => 1
                ])->sum('credito');
            $saldo_inicial = $debito - $credito;
        }else{
            $idTipoEntidad2 = Types::where(['renglon' => 'entidad', 'descripcion' => 'Banco'])->first();
            $debito = transactions::where(
                [
                    'idEntidad2'=> $datos["id"],
                    'idTipoEntidad2' => $idTipoEntidad2->id,  
                    'status' => 1
                ])->sum('debito');
            $credito = transactions::where(
                [
                    'idEntidad2'=> $datos["id"],
                    'idTipoEntidad2' => $idTipoEntidad2->id,  
                    'status' => 1
                ])->sum('credito');
            $saldo_inicial = $credito - $debito;
        }

       return $saldo_inicial;
    }
}