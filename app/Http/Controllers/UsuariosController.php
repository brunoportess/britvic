<?php


namespace App\Http\Controllers;


use App\Services\Interfaces\IUsuariosService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;

class UsuariosController
{
    /**
     * @var IUsuariosService
     */
    private $usuariosService;

    /**
     * UsuariosController constructor.
     * @param IUsuariosService $usuariosService
     */
    public function __construct(IUsuariosService $usuariosService)
    {
        $this->usuariosService = $usuariosService;
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('usuarios.index');
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function criar()
    {
        return view('usuarios.cadastrar');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function salvar(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'cpf' => ['required', 'max:14',
                Rule::unique('usuarios')->where(function ($query) use ($request) {
                    $query->whereNull('deleted_at')->where('cpf', '=', $request->cpf);
                })]
        ]);
        $dados = $request->all();
        $dados['user_id'] = auth()->user()->id;
        $this->usuariosService->salvar($dados);
        return Redirect::route('usuarios-index')->with('success','Usuário adicionado com sucesso!');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function editar($id)
    {
        $item = $this->usuariosService->listarPorId($id);
        return view('usuarios.editar', compact('item'));
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function atualizar($id, Request $request)
    {
        // CUSTOMIZACAO NA REGRA DE CPF PARA NAO ACUSAR ERRO NO CPF DO PROPRIO USUARIO
        $request->validate([
            'nome' => 'required',
            'cpf' => ['required', 'max:14',
                Rule::unique('usuarios')->where(function ($query) use ($id, $request) {
                    $query->whereNull('deleted_at')->where('id', '!=', $id)->where('cpf', '=', $request->cpf);
                })]
        ]);
        $dados = $request->all();
        $this->usuariosService->atualizar($id, $dados);
        return Redirect::route('usuarios-index')->with('success','Usuários atualizado com sucesso!');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deletar($id)
    {
        $this->usuariosService->deletar($id);
        return Redirect::route('usuarios-index')->with('success','Usuário deletado com sucesso!');
    }
}
