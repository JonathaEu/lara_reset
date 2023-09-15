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
    ];

    protected $table = 'frigobar_iten';

    public function itens()
    {
        return $this->belongsToMany(iten::class);
    }

}