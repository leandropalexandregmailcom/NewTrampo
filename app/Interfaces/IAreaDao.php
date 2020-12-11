<?php

namespace App\Interfaces;


use App\Classes\Area;


interface IAreaDao{

    public function criar(Area $area);
    public function deletar(Area $area);
    public function editar(Area $area);
    public function atualizar(Area $area);
    public function listar();
}

?>
