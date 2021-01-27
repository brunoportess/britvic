<?php


namespace App\Http\Controllers;


use App\Services\Interfaces\IVeiculosService;
use Illuminate\Http\Request;
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

    public function index()
    {
        return view('veiculos.index');
    }

    public function criar()
    {
        return view('veiculos.cadastrar');
    }

    public function salvar(Request $request)
    {
        $request->validate([
            'marca' => 'required',
            'modelo' => 'required',
            'ano' => 'required|max:4',
            'placa' => 'required|max:8|unique:veiculos',
        ]);
        $dados = $request->all();
        $this->veiculosService->salvar($dados);
        return Redirect::route('veiculos-index')->with('success','Veículo adicionado com sucesso!');
    }

    public function editar($id)
    {
        $item = $this->veiculosService->listarPorId($id);
        return view('veiculos.editar', compact('item'));
    }

    public function atualizar($id, Request $request)
    {
        $request->validate([
            'marca' => 'required',
            'modelo' => 'required',
            'ano' => 'required|max:4',
            'placa' => 'required|max:8|unique:veiculos',
        ]);
        $dados = $request->all();
        $this->veiculosService->atualizar($id, $dados);
        return Redirect::route('veiculos-index')->with('success','Veículo atualizado com sucesso!');
    }

    public function deletar($id)
    {
        $this->veiculosService->deletar($id);
        return Redirect::route('veiculos-index')->with('success','Veículo deletado com sucesso!');
    }
}
