<?php


namespace App\Repositories\Interfaces;


interface IBaseRepository
{
    function listar();
    function listarPorId($id);
    function salvar($dados);
    function atualizar($id, $dados);
    function deletar($id);
}
