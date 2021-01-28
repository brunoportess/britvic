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

    /**
     * UsuariosRepository constructor.
     * @param Usuario $usuarios
     */
    public function __construct(Usuario $usuarios)
    {
        parent::__construct($usuarios);
        $this->usuarios = $usuarios;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     * @throws \Exception
     */
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
