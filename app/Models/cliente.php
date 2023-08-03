<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cliente extends Model
{
    use HasFactory;
    protected $fillable = [
        'nome',
        'nascimento',
        'cpf',
        'email',
        'senha',
        'telefone',
        'cidade',
        'estado'
    ];
    // protected $table = 'clientes';
}
