<?php

namespace App\Http\Controllers;

use App\AreaDao;
use App\VagaDao;
use App\CargoDao;
use App\EstadoDao;
use App\Classes\Vaga;
use App\CandidatoVagaDao;
use App\Classes\Processo;
use App\Interfaces\Estado;
use Illuminate\Http\Request;
use App\Classes\CandidatoVaga;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class VagaController extends Controller
{
    public function nova()
    {
        $areaDao = new AreaDao();
        $area = $areaDao->listar();

        $cargoDao = new CargoDao();
        $cargo = $cargoDao->listar();

        return view('vaga/cadastrarVaga')->with('areas', $area)->with('cargos', $cargo);
    }

    public function criar_vaga(Request $request)
    {
        $rules  = array(
            'cargo'     => 'required',
            'descricao' => 'required',
            'validade'  => 'required'
        );

        $messages = array(
            'descricao.required' => 'Campo descrição é obrigatório',
            'cargo.required'     => 'Campo cargo é obrigatório',
            'validade.required'  => 'Campo validade é obrigatório',
        );
        $this->validate($request, $rules, $messages);

        $vaga = new Vaga();

        $cargoDao = cargoDao::select('id_area')->where(['id_cargo' => $request->cargo])->first();

        $vaga->setCargo($request->cargo);
        $vaga->setEmpresa(Auth::user()->id);
        $vaga->setArea($cargoDao->id_area);
        $vaga->setDescricao($request->descricao);
        $vaga->setValidade($request->validade);
        $vaga->setStatus(1);

        $vagaDao = new VagaDao();
        $vagaDao->criar($vaga);

        return redirect()->route(Auth::user()->perfil.'_index');
    }

    public function editar_vaga(Request $request)
    {
        $areaDao = new AreaDao();
        $area = $areaDao->listar();
        $vaga = new Vaga();
        $vaga->setId($request->id);
        $vagaDao = new VagaDao();

        $editar = $vagaDao->editar($vaga);

        return view('vaga/editarVaga')->with('vaga', $editar)->with('areas', $area);
    }

    public function atualizar_vaga(Request $request)
    {
        $rules  = array(
            'area'      => 'required',
            'cargo'     => 'required',
            'descricao' => 'required',
            'validade'  => 'required'
        );

        $messages = array(
            'area.required'	     => 'Campo área é obrigatório',
            'descricao.required' => 'Campo descrição é obrigatório',
            'cargo.required'     => 'Campo cargo é obrigatório',
            'validade.required'  => 'Campo validade é obrigatório',
        );
        $this->validate($request, $rules, $messages);

        $vaga = new Vaga();

        $vaga->setCargo($request->cargo);
        $vaga->setArea($request->area);
        $vaga->setDescricao($request->descricao);
        $vaga->setValidade($request->validade);

        $vaga->setId($request->id);
        $vagaDao = new VagaDao();

        $vagaDao->atualizar($vaga);

        return redirect()->route(Auth::user()->perfil.'_index');
    }

    public function detalhe_vaga(Request $request)
    {
        $vaga = new Vaga();

        $vaga->setId($request->id_vaga);
        $vagaDao = new VagaDao();

        $detalhe = $vagaDao->editar($vaga);

        return view('vaga/detalhe_vaga')->with('vaga', $detalhe);
    }

    public function candidatar_vaga(Request $request)
    {
        $candidatoVaga = new CandidatoVaga();
        $processo = new Processo();
        $Vaga = new Vaga();
        $vagaDao = new VagaDao();

        $Vaga->setId($request->id_vaga);
        $vaga = $vagaDao->editar($Vaga);


        $candidatoVaga->setCandidato(Auth::user()->id);
        $candidatoVaga->setVaga($request->id_vaga);
        $candidatoVaga->setEstado($processo->processo());
        $candidatoVaga->setEmpresa($vaga->id_empresa);
        $candidatoVaga->setStatus(1);
        dd($candidatoVaga);
        $candidatoVagaDao = new CandidatoVagaDao();

        $candidato = $candidatoVagaDao->editar($candidatoVaga);

        if($candidato)
        {
            return redirect()->route(Auth::user()->perfil.'_index');
        }

        $candidatoVagaDao->criar($candidatoVaga);

        return redirect()->route(Auth::user()->perfil.'_index');
    }

    public function candidato_vaga(Request $request)
    {
        $vaga =  new CandidatoVaga();
        $vaga->setVaga($request->id);

        $estadoDao = new EstadoDao();
        $estados = $estadoDao->listar();

        $candidato = new CandidatoVagaDao();
        $lista = $candidato->listar($vaga);

        return view('vaga/candidato_vaga')->with('lista', $lista)->with('estados', $estados);
    }

    public function fechar_vaga(Request $request)
    {
        $vaga  = new Vaga();
        $vaga->setId($request->id);
        $vagaDao = new VagaDao();
        $vagaDao->excluir($vaga);

        return redirect()->route(Auth::user()->perfil.'_index');
    }

    public function descartar_candidato(Request $request)
    {
        $candidato = new CandidatoVaga();
        $candidato->setCandidato($request->id_candidato);
        $candidato->setVaga($request->id_vaga);
        $candidato->setEmpresa(Auth::user()->empresa->id_empresa);

        $dao = new CandidatoVagaDao();
        $dao->encerrar_candidatura($candidato);

        return redirect()->route(Auth::user()->perfil.'_index');
    }
}
