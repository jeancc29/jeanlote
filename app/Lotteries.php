<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lotteries extends Model
{
    protected $fillable = [
        'descripcion', 
        'abreviatura', 
        'horaCierre', 
        'status'
    ];

    // public function dias()
    // {
    //     return $this->belongsToMany('App\Days', 'day_lottery', 'idLoteria', 'idDia');
    // }

    public function dias()
    {
        return $this->belongsToMany('App\Days', 'day_lottery', 'idLoteria', 'idDia')->withPivot('horaApertura','horaCierre');
    }

    public function sorteos()
    {
        return $this->belongsToMany('App\Draws', 'draw_lottery', 'idLoteria', 'idSorteo');
    }

    public function pagosCombinaciones()
    {
        return $this->hasOne('App\Payscombinations', 'idLoteria');
    }
    public function blocksplays()
    {
        return $this->hasOne('App\Blocksplays', 'idLoteria');
    }
}
