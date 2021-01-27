<?php


namespace App\Http\Controllers\Api;


use App\Services\Interfaces\IUsuariosService;
use App\Services\Interfaces\IVeiculosService;
use Illuminate\Support\Facades\Redirect;

class UsuariosController
{
    /**
     * @var IUsuariosService
     */
    private $usuariosService;

    public function __construct(IUsuariosService $usuariosService)
    {
        $this->usuariosService = $usuariosService;
    }

    public function listar()
    {
        $data = $this->usuariosService->listarComUsuario();
        return response()->json($data);
    }

    public function deletar($id)
    {
        $this->usuariosService->deletar($id);
        return response()->json();
    }
}
