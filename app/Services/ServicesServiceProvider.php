<?php


namespace App\Services;


use Illuminate\Support\ServiceProvider;

class ServicesServiceProvider extends  ServiceProvider
{
    public function register()
    {
        $this->app->bind(Interfaces\IUsuariosService::class, UsuariosService::class);
        $this->app->bind(Interfaces\IVeiculosService::class, VeiculosService::class);
        $this->app->bind(Interfaces\IVeiculosReservasService::class, VeiculosReservasService::class);
    }
}
