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

    /**
     * VeiculosReservasController constructor.
     * @param IVeiculosReservasService $reservasService
     */
    public function __construct(IVeiculosReservasService $reservasService)
    {
        $this->reservasService = $reservasService;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function listar()
    {
        $data = $this->reservasService->listar();
        return response()->json($data);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deletar($id)
    {
        $this->reservasService->deletar($id);
        return response()->json();
    }
}
