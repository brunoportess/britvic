<?php


namespace App\Repositories;


use App\Models\VeiculoReserva;
use App\Repositories\Interfaces\IVeiculosReservasRepository;

class VeiculosReservasRepository extends BaseRepository implements IVeiculosReservasRepository
{
    /**
     * @var VeiculoReserva
     */
    private $veiculoReserva;

    /**
     * VeiculosReservasRepository constructor.
     * @param VeiculoReserva $veiculoReserva
     */
    public function __construct(VeiculoReserva $veiculoReserva)
    {
        parent::__construct($veiculoReserva);
        $this->veiculoReserva = $veiculoReserva;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     * @throws \Exception
     */
    public function listar()
    {
        try {
            $response = $this->veiculoReserva->with('veiculo', 'usuario')->get();
        } catch (\Exception $e) {
            throw new \Exception($e);
        }
        return $response;
    }
}
