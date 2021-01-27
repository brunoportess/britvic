<?php


namespace App\Repositories;


use App\Models\Usuario;
use App\Repositories\Interfaces\IUsuariosRepository;

class UsuariosRepository extends BaseRepository implements IUsuariosRepository
{
    /**
     * @var Usuario
     */
    private $usuarios;

    public function __construct(Usuario $usuarios)
    {
        parent::__construct($usuarios);
        $this->usuarios = $usuarios;
    }

    function listarComUsuario()
    {
        try {
            $response = $this->usuarios->with('user')->get();
        } catch (\Exception $e) {
            throw new \Exception($e);
        }
        return $response;
    }
}
