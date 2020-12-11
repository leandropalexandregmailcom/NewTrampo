<?php

namespace App\Interfaces;


use App\Classes\Usuario;


interface IUsuarioDao{

    public function criar(Usuario $usuario);
    public function deletar(Usuario $usuario);
    public function editar(Usuario $usuario);
    public function atualizar(Usuario $usuario);
    public function listar();
}
?>
