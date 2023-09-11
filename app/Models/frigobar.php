<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class frigobar extends Model
{
    use HasFactory;

    protected $table = 'frigobar';

    protected $fillable = [
        'id',
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
        return $this->belongsTo('App\Models\quarto', 'quartos_id', 'id');
    }

    public function itens(): BelongsToMany
    {
        return $this->belongsToMany('App\models\iten');
    }
}
