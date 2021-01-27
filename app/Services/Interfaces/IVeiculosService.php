<?php


namespace App\Services\Interfaces;


interface IVeiculosService extends IBaseService
{
    function listarDisponiveis($inicio, $fim);
}
