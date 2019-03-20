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

    public function comisiones()
    {
        //Modelo, foreign key, foreign key, local key, local key
        return $this->hasMany('App\Commissions', 'idBanca');
    }

   

}
