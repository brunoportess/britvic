<?php


namespace App\Repositories\Interfaces;



interface IVeiculosRepository extends IBaseRepository
{
    function listarDisponiveis($inicio, $fim);
    function relatorioVeiculo($veiculo, $mes);
}
