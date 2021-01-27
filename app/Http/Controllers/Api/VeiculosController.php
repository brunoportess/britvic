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
}
