<?php

namespace App;

use App\Classes\CandidatoVaga;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Interfaces\ICandidatoVagaDao;
use Illuminate\Database\Eloquent\Model;

class CandidatoVagaDao extends Model implements ICandidatoVagaDao
{
    public $timestamps = false;
    protected $primaryKey 	= 'id_candidato_vaga';
    protected $table		= 'candidato_vaga';

    protected $fillable = array(
        'id_candidato_vaga', 'id_candidato', 'id_vaga', 'update_date', 'estado', 'create_date', 'status', 'id_empresa'
    );

    public function candidato()
    {
        return $this->hasOne('App\CandidatoDao', 'id_candidato', 'id_candidato');
    }

    public function vaga()
    {
        return $this->hasOne('App\VagaDao', 'id', 'id_vaga');
    }

    public function criar(CandidatoVaga $candidato)
    {
        $candidatoVagaDao = new CandidatoVagaDao();
        $candidatoVagaDao->id_candidato = $candidato->getCandidato();
        $candidatoVagaDao->id_vaga = $candidato->getVaga();
        $candidatoVagaDao->status = $candidato->getStatus();
        $candidatoVagaDao->estado = $candidato->getEstado();
        $candidatoVagaDao->id_empresa = $candidato->getEmpresa();
        $candidatoVagaDao->save();

        $vaga = VagaDao::where(['id' => $candidato->getVaga()])->first();
        $user = User::where(['id' => $vaga->id_empresa])->first();

        Mail::send('mail.candidata', ['candidato' => 'vaga'], function($m) use ($user)
        {
            $m->from('leandro.p.alexandre@gmail.com', 'Leandro');
            $m->to($user->email);
            $m->subject('Novo candidato');
        });

        return true;
    }

    public function encerrar_candidatura(CandidatoVaga $candidato)
    {
        $where = array(
            'id_candidato' => $candidato->getCandidato(),
            'id_vaga'      => $candidato->getVaga(),
            'status'       => 1
        );
        $candidatoVagaDao = CandidatoVagaDao::where($where)->update(['status' => 0]);

        return true;
    }

    public function editar(CandidatoVaga $candidato)
    {
        $where = array(
            'id_candidato' => $candidato->getCandidato(),
            'id_vaga'      => $candidato->getVaga(),
            'id_empresa'   => $candidato->getEmpresa(),
            'status'       => 1
        );
        $candidatoVagaDao = CandidatoVagaDao::where($where)->first();

        return $candidatoVagaDao;
    }

    public function atualizar($candidato)
    {
        $where = array(
            'id_candidato' => $candidato["candidato"],
            'id_vaga'      => $candidato["vaga"],
            'id_empresa'   => $candidato['empresa'],
        );
        $candidatoVagaDao = CandidatoVagaDao::where($where)->first();
dd($candidatoVagaDao);
        $candidatoVagaDao->id_vaga = $candidato["vaga"];
        dd($candidatoVagaDao);
        $candidatoVagaDao->save();

        return true;
    }

    public function listar(CandidatoVaga $vaga)
    {
        $where = array(
            'status'  => 1,
            'id_vaga' => $vaga->getVaga(),
        );

        $candidatoVagaDao = CandidatoVagaDao::where($where)
        ->with(['candidato' => function($query)
        {
            $query->where(['status' => 1])->with('user');
        }])
        ->with(['vaga' => function($query)
        {
            $query->where(['status' => 1]);
        }])->paginate(10);

        return $candidatoVagaDao;
    }

    // public function relatorio_candidato($init, $final)
    // {
    //     $resultado = VagaDao::where(['id_candidato' => Auth::user()->candidato->area])
    //     ->where('create_date', '>=', $init)
    //     ->where('update_date', '<=', $final)
    //     ->with(['vaga'])
    //     ->paginate(10);

    //     return $resultado;
    // }

    public function relatorio_candidato_vaga($init, $final, $vaga)
    {
        $resultado = CandidatoVagaDao::where(['id_vaga' => $vaga])
        ->where('create_date', '>=', $init)
        ->where('update_date', '<=', $final)
        ->with('candidato')
        ->paginate(10);

        return $resultado;
    }
}
