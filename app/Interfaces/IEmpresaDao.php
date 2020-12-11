<?php

namespace App\Interfaces;

use App\Classes\Empresa;

interface IEmpresaDao{

    public function criar(Empresa $empresa);
    public function deletar(Empresa $empresa);
    public function editar(Empresa $empresa);
    public function atualizar(Empresa $empresa);
    public function listar();
}

?>
