<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blockslotteries extends Model
{
    protected $fillable = [
        'idLoteria', 
        'monto', 
        'idSorteo'
    ];
}
