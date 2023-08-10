<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reserva extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'dt_reserva',
        'check_in',
        'check_out',
        'valor_diaria',
    ];
}
