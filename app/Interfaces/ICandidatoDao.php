<?php

namespace App\Interfaces;


use App\Classes\Candidato;


interface ICandidatoDao{

    public function criar(Candidato $candidato);
    public function deletar(Candidato $candidato);
    public function editar(Candidato $candidato);
    public function atualizar(Candidato $candidato);
    public function listar();
}

?>
