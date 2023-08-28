<?php

namespace App\Models;

use FactoryMethod;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class cliente extends Model
{
    use HasFactory;
    protected $fillable = [
        'nome',
        'nascimento',
        'cpf',
        'email',
        'senha',
        'telefone',
        'cidade',
        'estado'
    ];
    protected $table = 'clientes';

    public function estacionamento()
    {
        return $this->hasMany('App\Models\estacionamento', 'quartos_id', 'id');
    }
    public function reserva()
    {
        return $this->hasMany('App\Models\reserva');
    }

    /**
     * @return mixed
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * @param mixed $table 
     * @return self
     */
    public function setTable($table): self
    {
        $this->table = $table;
        return $this;
    }
}
