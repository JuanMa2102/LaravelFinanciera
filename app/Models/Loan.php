<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = [
        'client_id','cantidad','numero_pagos','cuota', 'total', 'fecha_ministracion', 'fecha_vencimiento'
    ];
}
