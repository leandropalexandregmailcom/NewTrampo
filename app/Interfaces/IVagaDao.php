<?php

namespace App\Interfaces;


use App\Classes\Vaga;


interface IVagaDao{

    public function criar(Vaga $vaga);
    public function excluir(Vaga $vaga);
    public function editar(Vaga $vaga);
    public function atualizar(Vaga $vaga);
    public function listar();
}
?>
