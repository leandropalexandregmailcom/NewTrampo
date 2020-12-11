<?php

namespace App\Interfaces;


use App\Classes\CandidatoVaga;


interface ICandidatoVagaDao{

    public function criar(CandidatoVaga $candidatoVaga);
    public function encerrar_candidatura(CandidatoVaga $candidatoVaga);
    public function editar(CandidatoVaga $candidatoVaga);
    public function atualizar(CandidatoVaga $candidatoVaga);
    public function listar(CandidatoVaga $candidatoVaga);
}

?>
