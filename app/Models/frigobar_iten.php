<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class frigobar_iten extends Model
{
    use HasFactory;

    protected $fillable = [
        'frigobar_id',
        'itens_id',
    ];
}
