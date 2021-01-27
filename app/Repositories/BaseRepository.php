<?php


namespace App\Repositories;


use App\Repositories\Interfaces\IBaseRepository;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements IBaseRepository
{
    /**
     * @var model
     */
    private $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    function listar()
    {
        try {
            $response = $this->model->get();
        } catch (\Exception $e) {
            throw new \Exception($e);
        }
        return $response;
    }

    function listarPorId($id)
    {
        try {
            $response = $this->model->where('id', $id)->first();
        } catch (\Exception $e) {
            throw new \Exception($e);
        }
        return $response;
    }

    function salvar($dados)
    {
        try {
            return $this->model->create($dados);
        } catch (\Exception $e) {
            throw new \Exception($e);
        }

    }

    function atualizar($id, $dados)
    {
        try {
            $response = $this->model->where('id', $id)->first();
            $response->fill($dados);
            $response->save();
        } catch (\Exception $e) {
            throw new \Exception($e);
        }
        return $response;
    }

    function deletar($id)
    {
        try {
            $this->model->where('id', $id)->delete();
        } catch (\Exception $e) {
            throw new \Exception($e);
        }
    }
}
