<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class estacionamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'quartos_id',
        'numero_vaga'
    ];
    protected $table = 'estacionamento';
}
