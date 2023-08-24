<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class frigobar_iten extends Model
{
    use HasFactory;

    protected $fillable = [
        'frigobar_id',
        'iten_id',
        'qtd_item'
    ];

    protected $table = 'frigobar_iten';

    // public function frigobar()
    // {
    //     return $this->hasMany('App\Models\frigobar', 'frigobar_id', 'id');
    // }
    //     public function itens()
    //     {
    //         return $this->hasMany('App\Models\iten', 'itens_id', 'id');
    //     }
}
