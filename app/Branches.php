<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branches extends Model
{
    protected $fillable = [
        'descripcion', 
        'ip', 
        'codigo', 
        'idUsuario',
        'dueno',
        'localidad',
        'balanceDesactivacion',
        'limiteVenta',
        'descontar',
        'deCada',
        'minutosCancelarTicket',
        'piepagina1',
        'piepagina2',
        'piepagina3',
        'piepagina4',
        'status'
    ];


    public function dias()
    {
        return $this->belongsToMany('App\Days', 'branches_days', 'idBanca', 'idDia')->withPivot('horaApertura','horaCierre');
    }

    public function loterias()
    {
        return $this->belongsToMany('App\Lotteries', 'branches_lotteries', 'idBanca', 'idLoteria');
    }

  

    public function usuario()
    {
        //Modelo, foreign key, local key
        return $this->hasOne('App\Users', 'id', 'idUsuario');
    }

    // public function pagosCombinaciones()
    // {
    //     //Modelo, foreign key, foreign key, local key, local key
    //     return $this->hasManyThrough('App\Payscombinations', 'App\Lotteries', 'id', 'id', 'idUsuario');
    // }

    public function pagosCombinaciones()
    {
        //Modelo, foreign key, foreign key, local key, local key
        return $this->hasMany('App\Payscombinations', 'idBanca');
    }

    public function gastos()
    {
        //Modelo, foreign key, foreign key, local key, local key
        return $this->hasMany('App\Automaticexpenses', 'idBanca');
    }

    public function comisiones()
    {
        //Modelo, foreign key, foreign key, local key, local key
        return $this->hasMany('App\Commissions', 'idBanca');
    }

    public function loteriaExiste($idLoteria){
        if($this->loterias()->wherePivot('idLoteria', $idLoteria)->first() != null)
            return true;
        else
            return false;
    }

    public function cerrada(){
        $cerrado = false;
        $fecha = getdate();
        $hora = explode(':',$this->dias()->whereWday($fecha['wday'])->first()->pivot->horaCierre);
        if((int)$fecha['hours'] > (int)$hora[0])
            $cerrado = true;
        else if((int)$hora[0] == (int)$fecha['hours']){
            //Validamos si los minutos actuales son mayores que los minutos horaCierre  
            if((int)$fecha['minutes'] > (int)$hora[1])
                $cerrado = true;
        }

        return $cerrado;
    }


    public function abierta(){
        $abierta = false;
        $fecha = getdate();
        $hora = explode(':',$this->dias()->whereWday($fecha['wday'])->first()->pivot->horaApertura);
        if((int)$fecha['hours'] > (int)$hora[0])
            $abierta = true;
        else if((int)$hora[0] == (int)$fecha['hours']){
            //Validamos si los minutos actuales son mayores que los minutos horaCierre  
            if((int)$fecha['minutes'] > (int)$hora[1])
                $abierta = true;
        }

        return $abierta;
    }

    public function limiteVenta($monto_a_vender){
        $abierta = false;
        $fecha = getdate();
        
       $ventas = Sales::whereBetween('created_at', array($fecha['year'].'-'.$fecha['mon'].'-'.$fecha['mday'] . ' 00:00:00', $fecha['year'].'-'.$fecha['mon'].'-'.$fecha['mday'] . ' 23:50:00'))
            ->where('idBanca', $this->id)
            ->where('status', '!=', 0)->sum('total');

        $ventas += $monto_a_vender;

        return ($ventas > $this->limiteVenta);
    }
   

}
