<?php

namespace App;

use Carbon\Carbon;
use App\Classes\Vaga;
use App\Interfaces\IVagaDao;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class VagaDao extends Model implements IVagaDao
{
    public $timestamps = false;
    protected $primaryKey 	= 'id';
    protected $table		= 'vaga';

    protected $fillable = array(
        'id', 'id_empresa',  'descricao', 'validade', 'id_cargo', 'update_date', 'create_date', 'status',
    );

    public function candidato()
    {
        return $this->hasOne('App\CandidatoVagaDao', 'id_vaga', 'id');
    }

    public function empresa()
    {
        return $this->hasOne('App\CandidatoVagaDao', 'id_empresa', 'id_empresa');
    }

    public function cargo()
    {
        return $this->hasOne('App\CargoDao', 'id_cargo', 'id_cargo');
    }

    public function criar(Vaga $vaga)
    {
        $VagaDao = new VagaDao();
        $VagaDao->id_empresa = $vaga->getEmpresa();
        $VagaDao->validade = $vaga->getValidade();
        $VagaDao->id_cargo = $vaga->getCargo();
        $VagaDao->descricao = $vaga->getDescricao();
        $VagaDao->status = $vaga->getStatus();
        $VagaDao->save();

        return true;
    }

    public function excluir(Vaga $vaga)
    {
        $where = array(
            'id' => $vaga->getId(),
        );
        VagaDao::where($where)->update(['status' => 0]);

        CandidatoVagaDao::where(['id_vaga' => $vaga->getId()])->update(['status' => 0]);

        return true;
    }

    public function editar(Vaga $vaga)
    {
        $where = array(
            'id' => $vaga->getId(),
        );
        $VagaDao = VagaDao::where($where)->first();

        return $VagaDao;
    }

    public function atualizar(Vaga $vaga)
    {
        $where = array(
            'id' => $vaga->getId(),
        );
        $VagaDao = VagaDao::where($where)->first();

        $VagaDao->validade = $vaga->getValidade();
        $VagaDao->id_cargo = $vaga->getCargo();
        $VagaDao->area = $vaga->getArea();
        $VagaDao->descricao = $vaga->getDescricao();

        $VagaDao->save();
        return true;
    }

    public function listar()
    {
        $now = Carbon::now();

        $where = array(
            'status' => 1,
        );
        $VagaDao = VagaDao::where($where)
        ->where('validade', '>=', $now)
        ->paginate(10);

        return $VagaDao;
    }

    public function listar_vaga_empresa()
    {
        $where = array(
            'id_empresa' => Auth::user()->id,
            'status'     => 1,
        );

        $VagaDao = VagaDao::where($where)->with(['empresa' => function($query)
        {
            $query->where(['status' => 1]);
        }])->with(['cargo' => function($query)
        {
            $query->where(['status' => 1]);
            $query->with(['area']);
        }])->paginate(10);

        return $VagaDao;
    }

    public function relatorio_candidato($init, $final)
    {
       $areas = AreaDao::where(['id_area' => Auth::user()->candidato->area])->with(['vaga' => function($query)
       {
           $query->where(['status' => 1]);
       }])
       ->where('create_date', '>=', $init)
       ->where('update_date', '<=', $final)->with('vaga')->paginate(10);

       return $areas;
    }

    public function relatorio_candidato_area($init, $final)
    {
       $vagas = VagaDao::where(['area' => Auth::user()->candidato->area, 'status' => 1])
       ->where('create_date', '>=', $init)
       ->where('update_date', '<=', $final)->paginate(10);

       return $vagas;
    }
}
