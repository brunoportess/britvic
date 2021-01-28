<?php


namespace App\Http\Controllers;


use App\Services\Interfaces\IVeiculosService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;

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
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        //dd(auth()->user()->id);
        return view('veiculos.index');
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function criar()
    {
        return view('veiculos.cadastrar');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function salvar(Request $request)
    {
        $request->validate([
            'marca' => 'required',
            'modelo' => 'required',
            'ano' => 'required|max:4',
            'placa' => ['required', 'max:8',
                Rule::unique('veiculos')->where(function ($query) use ( $request) {
                    $query->whereNull('deleted_at')->where('placa', '=', $request->placa);
                })]
        ]);
        $dados = $request->all();
        $dados['user_id'] = auth()->user()->id;
        $this->veiculosService->salvar($dados);
        return Redirect::route('veiculos-index')->with('success','Veículo adicionado com sucesso!');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function editar($id)
    {
        $item = $this->veiculosService->listarPorId($id);
        return view('veiculos.editar', compact('item'));
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
            'marca' => 'required',
            'modelo' => 'required',
            'ano' => 'required|max:4',
            'placa' => ['required', 'max:8',
                    Rule::unique('veiculos')->where(function ($query) use ($id, $request) {
                        $query->whereNull('deleted_at')->where('id', '!=', $id)->where('placa', '=', $request->placa);
                    })]
        ]);
        $dados = $request->all();
        $this->veiculosService->atualizar($id, $dados);
        return Redirect::route('veiculos-index')->with('success','Veículo atualizado com sucesso!');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deletar($id)
    {
        $this->veiculosService->deletar($id);
        return Redirect::route('veiculos-index')->with('success','Veículo deletado com sucesso!');
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function relatorioVeiculo()
    {
        return view('veiculos.relatorio');
    }
}
