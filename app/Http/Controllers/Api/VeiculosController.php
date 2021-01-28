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

    public function __construct(IVeiculosService $veiculosService)
    {
        $this->veiculosService = $veiculosService;
    }

    public function listar()
    {
        $data = $this->veiculosService->listar();
        return response()->json($data);
    }

    public function deletar($id)
    {
        $this->veiculosService->deletar($id);
        return response()->json();
    }

    public function listarDisponiveis($inicio, $fim)
    {
        $data = $this->veiculosService->listarDisponiveis($inicio, $fim);
        return response()->json($data);
    }

    public function relatorioVeiculo($veiculo, $mes)
    {
        $data = $this->veiculosService->relatorioVeiculo($veiculo, $mes);
        return response()->json($data);
    }
}
