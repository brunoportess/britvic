<?php


namespace App\Services;


use App\Repositories\Interfaces\IVeiculosRepository;
use App\Repositories\Interfaces\IVeiculosReservasRepository;
use App\Services\Interfaces\IVeiculosReservasService;

class VeiculosReservasService implements IVeiculosReservasService
{
    /**
     * @var IVeiculosReservasRepository
     */
    private $reservasRepository;

    public function __construct(IVeiculosReservasRepository $reservasRepository)
    {
        $this->reservasRepository = $reservasRepository;
    }

    function listar()
    {
        return $this->reservasRepository->listar();
    }

    function listarPorId($id)
    {
        return $this->reservasRepository->listarPorId($id);
    }

    function salvar($dados)
    {
        return $this->reservasRepository->salvar($dados);
    }

    function atualizar($id, $dados)
    {
        return $this->reservasRepository->atualizar($id, $dados);
    }

    function deletar($id)
    {
        return $this->reservasRepository->deletar($id);
    }
}
