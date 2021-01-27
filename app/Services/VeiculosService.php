<?php


namespace App\Services;


use App\Repositories\Interfaces\IVeiculosRepository;
use App\Services\Interfaces\IVeiculosService;

class VeiculosService implements IVeiculosService
{
    /**
     * @var IVeiculosRepository
     */
    private $veiculosRepository;

    public function __construct(IVeiculosRepository $veiculosRepository)
    {
        $this->veiculosRepository = $veiculosRepository;
    }

    function listar()
    {
        return $this->veiculosRepository->listar();
    }

    function listarPorId($id)
    {
        return $this->veiculosRepository->listarPorId($id);
    }

    function salvar($dados)
    {
        return $this->veiculosRepository->salvar($dados);
    }

    function atualizar($id, $dados)
    {
        return $this->veiculosRepository->atualizar($id, $dados);
    }

    function deletar($id)
    {
        return $this->veiculosRepository->deletar($id);
    }
}
