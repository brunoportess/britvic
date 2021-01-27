<?php


namespace App\Repositories;


use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends  ServiceProvider
{
    public function register()
    {
        $this->app->bind(Interfaces\IUsuariosRepository::class, UsuariosRepository::class);
        $this->app->bind(Interfaces\IVeiculosRepository::class, VeiculosRepository::class);
        $this->app->bind(Interfaces\IVeiculosReservasRepository::class, VeiculosReservasRepository::class);
    }
}
