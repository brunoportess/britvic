<?php


namespace App\Http\Controllers;


class UsuariosController
{
    public function __construct()
    {
    }

    public function index()
    {
        return view('usuarios.index');
    }
}
