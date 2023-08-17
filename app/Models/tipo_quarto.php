<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipo_quarto extends Model
{
    use HasFactory;
    protected $table = 'tipo_quarto';

    protected $fillable = [
        'tipo',
        'tipo_quartos_id',
    ];
}
