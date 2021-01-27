<?php


namespace App\Repositories;


use App\Models\Veiculos;
use App\Repositories\Interfaces\IVeiculosRepository;

class VeiculosRepository extends BaseRepository implements IVeiculosRepository
{
    public function __construct(Veiculos $veiculos)
    {
        parent::__construct($veiculos);
    }
}
