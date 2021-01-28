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

    /**
     * BaseRepository constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    function listar()
    {
        try {
            $response = $this->model->get();
        } catch (\Exception $e) {
            throw new \Exception($e);
        }
        return $response;
    }

    /**
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    function listarPorId($id)
    {
        try {
            $response = $this->model->where('id', $id)->first();
        } catch (\Exception $e) {
            throw new \Exception($e);
        }
        return $response;
    }

    /**
     * @param $dados
     * @return mixed
     * @throws \Exception
     */
    function salvar($dados)
    {
        try {
            return $this->model->create($dados);
        } catch (\Exception $e) {
            throw new \Exception($e);
        }

    }

    /**
     * @param $id
     * @param $dados
     * @return mixed
     * @throws \Exception
     */
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

    /**
     * @param $id
     * @throws \Exception
     */
    function deletar($id)
    {
        try {
            $this->model->where('id', $id)->delete();
        } catch (\Exception $e) {
            throw new \Exception($e);
        }
    }
}
