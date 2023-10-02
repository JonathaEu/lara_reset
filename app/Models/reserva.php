<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reserva extends Model
{
    use HasFactory;

    protected $fillable = [
        'clientes_id',
        'quartos_id',
        'users_id',
        'consumos_id',
        'status',
        'dt_inicial',
        'dt_final',
        'check_in',
        'check_out',
    ];

    public function clientes()
    {
        return $this->belongsTo('App\models\cliente');
    }
    public function quartos()
    {
        return $this->belongsTo('App\models\quarto')->with('frigobar');
    }
    public function consumos()
    {
        return $this->belongsTo('App\models\consumo');
    }
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}