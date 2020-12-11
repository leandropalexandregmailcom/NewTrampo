<?php

namespace App\Interfaces;


use App\Classes\Cargo;


interface ICargoDao{

    public function criar(Cargo $cargo);
    public function deletar(Cargo $cargo);
    public function editar(Cargo $cargo);
    public function atualizar(Cargo $cargo);
    public function listar();
}

?>
