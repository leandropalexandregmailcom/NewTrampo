<?php

namespace App;

use App\Classes\Experiencia;
use App\Interfaces\IExperienciaDao;
use Illuminate\Database\Eloquent\Model;

class ExperienciaDao extends Model implements IExperienciaDao
{
    public $timestamps = false;
    protected $primaryKey 	= 'id_experiencia';
    protected $table		= 'experiencia';

    protected $fillable = array(
        'id_experiencia', 'cargo', 'descricao', 'entrada', 'saida', 'update_date', 'create_date', 'status',
    );

    public function criar(Experiencia $experiencia)
    {
        $ExperienciaDao = new ExperienciaDao();
        $ExperienciaDao->cargo = $experiencia->getCargo();
        $ExperienciaDao->descricao = $experiencia->getDescricao();
        $ExperienciaDao->entrada = $experiencia->getEntrada();
        $ExperienciaDao->saida = $experiencia->getSaida();
        $ExperienciaDao->status = $experiencia->getStatus();
        $ExperienciaDao->save();

        return true;
    }

    public function deletar(Experiencia $experiencia)
    {
        $where = array(
            'id' => $experiencia->getId(),
        );
        ExperienciaDao::where($where)->update(['status' => 0]);

        return true;
    }

    public function editar(Experiencia $experiencia)
    {
        $where = array(
            'id' => $experiencia->getId(),
        );
        $ExperienciaDao = ExperienciaDao::where($where)->first();

        return $ExperienciaDao;
    }

    public function atualizar(Experiencia $experiencia)
    {
        $where = array(
            'id' => $experiencia->getId(),
        );
        $ExperienciaDao = ExperienciaDao::where($where)->first();

        $ExperienciaDao->cargo = $experiencia->getCargo();
        $ExperienciaDao->descricao = $experiencia->getDescricao();
        $ExperienciaDao->entrada = $experiencia->getEntrada();
        $ExperienciaDao->saida = $experiencia->getSaida();
        $ExperienciaDao->save();

        return true;
    }

    public function listar()
    {
        $where = array(
            'status' => 1,
        );
        $ExperienciaDao = ExperienciaDao::where($where)->paginate(10);

        return $ExperienciaDao;
    }
}
