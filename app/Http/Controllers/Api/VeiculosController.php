<?php


namespace App\Http\Controllers\Api;


use App\Services\Interfaces\IVeiculosService;
use Illuminate\Support\Facades\Redirect;

class VeiculosController
{
    /**
     * @var IVeiculosService
     */
    private $veiculosService;

    /**
     * VeiculosController constructor.
     * @param IVeiculosService $veiculosService
     */
    public function __construct(IVeiculosService $veiculosService)
    {
        $this->veiculosService = $veiculosService;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function listar()
    {
        $data = $this->veiculosService->listar();
        return response()->json($data);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deletar($id)
    {
        $this->veiculosService->deletar($id);
        return response()->json();
    }

    /**
     * @param $inicio
     * @param $fim
     * @return \Illuminate\Http\JsonResponse
     */
    public function listarDisponiveis($inicio, $fim)
    {
        $data = $this->veiculosService->listarDisponiveis($inicio, $fim);
        return response()->json($data);
    }

    /**
     * @param $veiculo
     * @param $mes
     * @return \Illuminate\Http\JsonResponse
     */
    public function relatorioVeiculo($veiculo, $mes)
    {
        $data = $this->veiculosService->relatorioVeiculo($veiculo, $mes);
        return response()->json($data);
    }
}
