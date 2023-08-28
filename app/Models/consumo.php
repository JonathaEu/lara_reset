<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class consumo extends Model
{
    use HasFactory;

    protected $fillable = [
        'itens_id',
        'quantidade',
        'valor_total'
    ];
    protected $table = 'consumo';

    public function reserva()
    {
        return $this->hasMany(reserva::class);
    }
}
