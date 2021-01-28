<?php


namespace App\Services;


use App\Repositories\Interfaces\IUsuariosRepository;
use App\Services\Interfaces\IUsuariosService;

class UsuariosService implements IUsuariosService
{
    /**
     * @var IUsuariosRepository
     */
    private $usuariosRepository;

    /**
     * UsuariosService constructor.
     * @param IUsuariosRepository $usuariosRepository
     */
    public function __construct(IUsuariosRepository $usuariosRepository)
    {
        $this->usuariosRepository = $usuariosRepository;
    }

    /**
     * @return mixed
     */
    function listar()
    {
        return $this->usuariosRepository->listar();
    }

    /**
     * @param $id
     * @return mixed
     */
    function listarPorId($id)
    {
        return $this->usuariosRepository->listarPorId($id);
    }

    /**
     * @param $dados
     * @return mixed
     */
    function salvar($dados)
    {
        return $this->usuariosRepository->salvar($dados);
    }

    /**
     * @param $id
     * @param $dados
     * @return mixed
     */
    function atualizar($id, $dados)
    {
        return $this->usuariosRepository->atualizar($id, $dados);
    }

    /**
     * @param $id
     * @return mixed
     */
    function deletar($id)
    {
        return $this->usuariosRepository->deletar($id);
    }

    /**
     * @return mixed
     */
    function listarComUsuario()
    {
        return $this->usuariosRepository->listarComUsuario();
    }
}
