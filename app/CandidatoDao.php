<?php

namespace App;

use App\Classes\Candidato;
use App\Interfaces\ICandidatoDao;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class CandidatoDao extends Model implements ICandidatoDao
{
    public $timestamps = false;
    protected $primaryKey 	= 'id_candidato';
    protected $table		= 'candidato';

    protected $fillable = array(
        'id_candidato', 'area', 'profissao', 'apresentacao', 'curriculo', 'status', 'id_user'
    );

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'id_user');
    }

    public function area()
    {
        return $this->hasOne('App\User', 'id_area', 'area');
    }

    public function vaga()
    {
        return $this->hasOne('App\VagaDao', 'vaga', 'id_vaga');
    }

    public function criar(Candidato $candidato)
    {
        $candidatoDao = new CandidatoDao();
        $candidatoDao->apresentacao = $candidato->getApresentacao();
        $candidatoDao->profissao = $candidato->getProfissao();
        $candidatoDao->curriculo = $candidato->getCurriculo();
        $candidatoDao->area = $candidato->getArea();
        $candidatoDao->status = $candidato->getStatus();
        $candidatoDao->id_user = $candidato->getId_User();
        $candidatoDao->save();

        return true;
    }

    public function deletar(Candidato $candidato)
    {
        $where = array(
            'id_user' => $candidato->getId_User(),
            'status'  => $candidato->getStatus()
        );
        $candidatoDao = CandidatoDao::where($where)->update(['status' => 0]);

        return $candidatoDao;
    }

    public function editar(Candidato $candidato)
    {
        $where = array(
            'id_user' => $candidato->getId_User(),
            'status'  => $candidato->getStatus()
        );
        $candidatoDao = CandidatoDao::where($where)->first();

        return $candidatoDao;
    }

    public function atualizar(Candidato $candidato)
    {
        $where = array(
            'id_user' => $candidato->getId_User(),
            'status'  => $candidato->getStatus()
        );
        $candidatoDao = CandidatoDao::where($where)->first();

        $candidatoDao->apresentacao = $candidato->getApresentacao();
        $candidatoDao->profissao = $candidato->getProfissao();
        $candidatoDao->curriculo = $candidato->getCurriculo();
        $candidatoDao->area = $candidato->getArea();
        $candidatoDao->save();

        return true;
    }

    public function listar()
    {
        $candidatoDao = CandidatoDao::where(['status' => 1])->paginate(10);

        return $candidatoDao;
    }

    public function relatorio_candidato($init, $final)
    {
        $resultado = VagaDao::where(['id_candidato' => Auth::user()->candidato->area])
        ->where('create_date', '>=', $init)
        ->where('update_date', '<=', $final)
        ->with(['vaga'])
        ->paginate(10);

        return $resultado;
    }
}
