<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class estacionamento extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'nome',
    //     'nascimento',
    // ];
    protected $table = 'estacionamento';
}
