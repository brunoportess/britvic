<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VeiculoReserva extends Model
{
    use HasFactory;
    use SoftDeletes;
    use \App\Traits\VeiculoReserva;
    protected $table = 'veiculos_reservas';
    protected $fillable = [
        'veiculo_id',
        'usuario_id',
        'data_inicio',
        'data_fim'
    ];

    function veiculo()
    {
        return $this->belongsTo(Veiculo::class, 'veiculo_id', 'id');
    }

    function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id', 'id');
    }
}
