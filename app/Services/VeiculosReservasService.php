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

    /**
     * VeiculosReservasService constructor.
     * @param IVeiculosReservasRepository $reservasRepository
     */
    public function __construct(IVeiculosReservasRepository $reservasRepository)
    {
        $this->reservasRepository = $reservasRepository;
    }

    /**
     * @return mixed
     */
    function listar()
    {
        return $this->reservasRepository->listar();
    }

    /**
     * @param $id
     * @return mixed
     */
    function listarPorId($id)
    {
        return $this->reservasRepository->listarPorId($id);
    }

    /**
     * @param $dados
     * @return mixed
     */
    function salvar($dados)
    {
        return $this->reservasRepository->salvar($dados);
    }

    /**
     * @param $id
     * @param $dados
     * @return mixed
     */
    function atualizar($id, $dados)
    {
        return $this->reservasRepository->atualizar($id, $dados);
    }

    /**
     * @param $id
     * @return mixed
     */
    function deletar($id)
    {
        return $this->reservasRepository->deletar($id);
    }
}
