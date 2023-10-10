<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class iten extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'valor',
        'estoque',
    ];

    public function frigobar(): BelongsToMany
    {
        return $this->belongsToMany(frigobar::class);
    }

    public function frigobar_iten(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\frigobar_iten');
    }
}