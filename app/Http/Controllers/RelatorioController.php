<?php

namespace App\Http\Controllers;

use App\VagaDao;
use App\CandidatoVagaDao;
use App\EmpresaDao;
use App\Classes\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class RelatorioController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function relatorio_candidato_vaga()
    {
        $vagaDao = new VagaDao();
        $vagas = $vagaDao->listar_vaga_empresa();

        return view('relatorios/home')->with('vagas', $vagas);
    }

    public function relatorio_candidato()
    {
        return view('relatorios/candidato');
    }

    public function relatorio_candidato_area()
    {
        return view('relatorios/candidato_area');
    }

    public function resultado_candidato(Request $request)
    {
        $rules  = array(
            'inicial'   => 'required',
            'final'     => 'required',
        );

        $messages = array(
            'inicial.required' => 'Campo data inicial é obrigatório',
            'final.required' => 'Campo data final é obrigatório',
        );
        $this->validate($request, $rules, $messages);

        $request->inicial = str_replace("-", "/", $request->inicial);
        $request->final = str_replace("-", "/", $request->final);

        $date_init = Carbon::createFromFormat('Y/m/d',  $request->inicial);
        $date_init->hour(0)->minute(0)->second(0);

        $date_end= Carbon::createFromFormat('Y/m/d' , $request->final);
        $date_end->hour(23)->minute(59)->second(59);

        $vaga = new VagaDao();

        $resultado = $vaga->relatorio_candidato($date_init, $date_end);

        return view('relatorios/resultado_candidato')->with('resultado', $resultado);
    }

    public function resultado_candidato_vaga(Request $request)
    {
        $rules  = array(
            'vaga'   => 'required',
            'inicial'   => 'required',
            'final'     => 'required',
        );

        $messages = array(
            'vaga.required' => 'Campo vaga é obrigatório',
            'inicial.required' => 'Campo data inicial é obrigatório',
            'final.required' => 'Campo data final é obrigatório',
        );
        $this->validate($request, $rules, $messages);

        $request->inicial = str_replace("-", "/", $request->inicial);
        $request->final = str_replace("-", "/", $request->final);

        $date_init = Carbon::createFromFormat('Y/m/d',  $request->inicial);
        $date_init->hour(0)->minute(0)->second(0);

        $date_end= Carbon::createFromFormat('Y/m/d' , $request->final);
        $date_end->hour(23)->minute(59)->second(59);

        $candidato = new CandidatoVagaDao();

        $resultado = $candidato->relatorio_candidato_vaga($date_init, $date_end, $request->vaga);

        return view('relatorios/resultado_candidato_vaga')->with('resultado', $resultado);
    }

    public function resultado_candidato_area(Request $request)
    {
        $rules  = array(
            'inicial'   => 'required',
            'final'     => 'required',
        );

        $messages = array(
            'inicial.required' => 'Campo data inicial é obrigatório',
            'final.required'   => 'Campo data final é obrigatório',
        );
        $this->validate($request, $rules, $messages);

        $request->inicial = str_replace("-", "/", $request->inicial);
        $request->final = str_replace("-", "/", $request->final);

        $date_init = Carbon::createFromFormat('Y/m/d',  $request->inicial);
        $date_init->hour(0)->minute(0)->second(0);

        $date_end= Carbon::createFromFormat('Y/m/d' , $request->final);
        $date_end->hour(23)->minute(59)->second(59);

        $vaga = new VagaDao();

        $resultado = $vaga->relatorio_candidato_area($date_init, $date_end);

        return view('relatorios/resultado_candidato_area')->with('resultado', $resultado);
    }

}
