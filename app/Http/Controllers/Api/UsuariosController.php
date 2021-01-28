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

    /**
     * UsuariosController constructor.
     * @param IUsuariosService $usuariosService
     */
    public function __construct(IUsuariosService $usuariosService)
    {
        $this->usuariosService = $usuariosService;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function listar()
    {
        $data = $this->usuariosService->listarComUsuario();
        return response()->json($data);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deletar($id)
    {
        $this->usuariosService->deletar($id);
        return response()->json();
    }
}
