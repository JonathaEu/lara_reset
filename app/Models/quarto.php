<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
        return $this->hasMany('App\Models\frigobar', 'quartos_id', 'id');
    }
    public function reserva()
    {
        return $this->hasMany('App\Models\reserva');
    }
}
