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
        'tipo_quartos_id',
    ];

    public function frigobar()
    {
        return $this->hasMany('App\Models\frigobar', 'quartos_id');
    }
}
