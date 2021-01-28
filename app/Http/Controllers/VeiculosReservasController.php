<?php


namespace App\Http\Controllers;


use App\Services\Interfaces\IVeiculosReservasService;
use App\Services\Interfaces\IVeiculosService;
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

    public function index()
    {
        //dd(auth()->user()->id);
        return view('veiculos.reservas.index');
    }

    public function criar()
    {
        return view('veiculos.reservas.cadastrar');
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
        $this->reservasService->salvar($dados);
        Redirect::route('reservas-index')->with('success','Veículo adicionado com sucesso!');
    }

    public function editar($id)
    {
        $item = $this->reservasService->listarPorId($id);
        return view('veiculos.reservas.editar', compact('item'));
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
        $this->reservasService->atualizar($id, $dados);
        Redirect::route('reservas-index')->with('success','Veículo atualizado com sucesso!');
    }

    public function deletar($id)
    {
        $this->reservasService->deletar($id);
        Redirect::route('reservas-index')->with('success','Veículo deletado com sucesso!');
    }
}
