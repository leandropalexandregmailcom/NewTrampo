<?php

namespace App\Interfaces;


use App\Classes\Experiencia;


interface IExperienciaDao{

    public function criar(Experiencia $experiencia);
    public function deletar(Experiencia $experiencia);
    public function editar(Experiencia $experiencia);
    public function atualizar(Experiencia $experiencia);
    public function listar();
}
?>
