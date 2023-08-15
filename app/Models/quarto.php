<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class quarto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'numero',
        'valor',
        'max_cap',
        'quarto_id',
    ];
}
