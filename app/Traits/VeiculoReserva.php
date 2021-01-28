<?php


namespace App\Traits;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

trait VeiculoReserva
{
    public static function bootVeiculoReserva()
    {
        static::created(function (Model $model) {
            Log::info("RESERVA CRIADA: veiculo_id {$model->veiculo_id}, usuario_id {$model->usuario_id}");
        });
    }
}
