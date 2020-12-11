<?php

namespace App\Classes;

use App\EstadoDao;
use App\Interfaces\Estado;

class Processo implements Estado{

    public function aprovado()
    {
        $estado = EstadoDao::select('id_estado')->where(['nome' => 'Aprovado'])->first();
        return $estado->id_estado;
    }
    public function descartado()
    {
        $estado = EstadoDao::select('id_estado')->where(['nome' => 'Descartado'])->first();
        return $estado->id_estado;
    }
    public function processo()
    {
        $estado = EstadoDao::select('id_estado')->where(['nome' => 'Processo'])->first();
        return $estado->id_estado;
    }
}

?>
