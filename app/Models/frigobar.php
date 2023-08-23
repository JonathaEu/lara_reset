<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class frigobar extends Model
{
    use HasFactory;

    protected $table = 'frigobar';

    protected $fillable = [
        'quartos_id',
        'ativo',
        'numero',
    ];

    /**
     * Summary of quarto
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function quarto()
    {
        return $this->belongsTo('App\Models\quarto', 'quartos_id');
    }

    public function frigobar_itens()
    {
        return $this->belongsTo('App\Models\frigobar_itens');
    }
}
