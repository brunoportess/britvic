<?php


namespace App\Repositories;


use App\Models\Usuarios;
use App\Repositories\Interfaces\IUsuariosRepository;

class UsuariosRepository extends BaseRepository implements IUsuariosRepository
{
    public function __construct(Usuarios $usuarios)
    {
        parent::__construct($usuarios);
    }
}
