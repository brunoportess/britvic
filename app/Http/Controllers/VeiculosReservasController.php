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

    /**
     * VeiculosReservasController constructor.
     * @param IVeiculosReservasService $reservasService
     */
    public function __construct(IVeiculosReservasService $reservasService)
    {
        $this->reservasService = $reservasService;
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('veiculos.reservas.index');
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function criar()
    {
        return view('veiculos.reservas.cadastrar');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
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
        $this->reservasService->salvar($dados);
        return Redirect::route('reservas-index')->with('success','Veículo adicionado com sucesso!');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function editar($id)
    {
        $item = $this->reservasService->listarPorId($id);
        return view('veiculos.reservas.editar', compact('item'));
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
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
        $this->reservasService->atualizar($id, $dados);
        return Redirect::route('reservas-index')->with('success','Veículo atualizado com sucesso!');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deletar($id)
    {
        $this->reservasService->deletar($id);
        return Redirect::route('reservas-index')->with('success','Veículo deletado com sucesso!');
    }
}
