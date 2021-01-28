<?php


namespace App\Services;


use App\Repositories\Interfaces\IBaseRepository;
use App\Services\Interfaces\IBaseService;

class BaseService implements IBaseService
{
    /**
     * @var IBaseRepository
     */
    private $repository;


    /**
     * BaseService constructor.
     * @param IBaseRepository $repository
     */
    public function __construct(IBaseRepository $repository){
        $this->repository = $repository;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    function listar()
    {
        try {
            $response = $this->repository->listar();
        }catch (\Exception $e){
            throw $e;
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
            $response = $this->repository->listarPorId($id);
        }catch (\Exception $e){
            throw $e;
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
            $response = $this->repository->salvar($dados);
        }catch (\Exception $e){
            throw $e;
        }

        return $response;
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
            $response = $this->repository->atualizar($id, $dados);
        }catch (\Exception $e){
            throw $e;
        }

        return $response;
    }

    /**
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    function deletar($id)
    {
        try {
            $response = $this->repository->deletar($id);
        }catch (\Exception $e){
            throw $e;
        }

        return $response;
    }
}
