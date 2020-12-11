<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadoDao extends Model
{
    public $timestamps = false;
    protected $primaryKey 	= 'id_estado';
    protected $table		= 'estado';

    protected $fillable = array(
        'id_estado', 'aprovado', 'cancelado', 'processo', 'descartado', 'update_date', 'create_date', 'status', 'cor'
    );

    public function listar()
    {
        $where = array(
            'status' => 1,
        );
        $EstadoDao = EstadoDao::where($where)->paginate(10);

        return $EstadoDao;
    }
}
