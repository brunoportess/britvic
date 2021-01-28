<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Veiculo extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = 'veiculos';
    protected $fillable = [
        'marca',
        'modelo',
        'ano',
        'placa',
        'ativo',
        'user_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    function reservas()
    {
        return $this->hasMany(VeiculoReserva::class, 'veiculo_id', 'id');
    }
}
