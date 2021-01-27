<?php


namespace App\Services\Interfaces;


interface IBaseService
{
    function listar();
    function listarPorId($id);
    function salvar($dados);
    function atualizar($id, $dados);
    function deletar($id);
}
