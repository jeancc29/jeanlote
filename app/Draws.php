<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Draws extends Model
{
    protected $fillable = [
        'descripcion', 'bolos', 'cantidadNumeros', 'status'
    ];

    public function loteriasRelacionadas()
    {
        return $this->belongsToMany('App\Lotteries', 'drawsrelations', 'idSorteo', 'idLoteria')->withPivot('idLoteriaPertenece');;
    }
}
