<?php


namespace App\Http\Controllers\Api;


use App\Services\Interfaces\IVeiculosReservasService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;

class VeiculosReservasController
{
    /**
     * @var IVeiculosReservasService
     */
    private $reservasService;

    public function __construct(IVeiculosReservasService $reservasService)
    {
        $this->reservasService = $reservasService;
    }

    public function listar()
    {
        $data = $this->reservasService->listar();
        return response()->json($data);
    }

    public function salvar(Request $request)
    {
        $request->validate([
            'usuario_id' => 'required',
            'veiculo_id' => 'required',
            'data_inicio' => 'required',
            'data_fim' => 'required',
        ]);
        $dados = $request->all();
        $response = $this->reservasService->salvar($dados);
        return response()->json($response);
    }

    public function atualizar($id, Request $request)
    {
        // CUSTOMIZACAO NA REGRA DE PLACA PARA NAO ACUSAR ERRO NA PLACA DO PROPRIO VEICULO
        $request->validate([
            'usuario_id' => 'required',
            'veiculo_id' => 'required',
            'data_inicio' => 'required',
            'data_fim' => 'required',
        ]);
        $dados = $request->all();
        $response = $this->reservasService->atualizar($id, $dados);
        return response()->json($response);
    }

    public function deletar($id)
    {
        $this->reservasService->deletar($id);
        return response()->json();
    }
}
