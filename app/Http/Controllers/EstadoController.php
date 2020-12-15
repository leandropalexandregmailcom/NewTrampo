<?php

namespace App\Http\Controllers;

use App\EstadoDao;
use App\Classes\Estado;
use App\CandidatoVagaDao;
use Illuminate\Http\Request;
use App\Classes\CandidatoVaga;
use Illuminate\Support\Facades\Auth;

class EstadoController extends Controller
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

    public function mudar_estado(Request $request)
    {
        $candidatoVaga = array(
            'estado'    => $request->id_estado,
            'vaga'      => $request->id_vaga,
            'empresa'   => Auth::user()->id,
            'candidato' => $request->id_candidato,
        );
        $CandidatoVaga = new CandidatoVagaDao();
        $response = $CandidatoVaga->atualizar($candidatoVaga);

        return response()->json($response);
    }
}
