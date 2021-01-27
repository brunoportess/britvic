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

    public function __construct(IUsuariosRepository $usuariosRepository)
    {
        $this->usuariosRepository = $usuariosRepository;
    }

    function listar()
    {
        return $this->usuariosRepository->listar();
    }

    function listarPorId($id)
    {
        return $this->usuariosRepository->listarPorId($id);
    }

    function salvar($dados)
    {
        return $this->usuariosRepository->salvar($dados);
    }

    function atualizar($id, $dados)
    {
        return $this->usuariosRepository->atualizar($id, $dados);
    }

    function deletar($id)
    {
        return $this->usuariosRepository->deletar($id);
    }

    function listarComUsuario()
    {
        return $this->usuariosRepository->listarComUsuario();
    }
}
