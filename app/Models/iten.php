<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class iten extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'valor',
        'quantidade',
    ];
}
