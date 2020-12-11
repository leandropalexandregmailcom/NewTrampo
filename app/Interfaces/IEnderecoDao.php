<?php

namespace App\Interfaces;


use App\Classes\Endereco;


interface IEnderecoDao{

    public function criar(Endereco $endereco);
    public function deletar(Endereco $endereco);
    public function editar(Endereco $endereco);
    public function atualizar(Endereco $endereco);
    public function listar();
}
?>
