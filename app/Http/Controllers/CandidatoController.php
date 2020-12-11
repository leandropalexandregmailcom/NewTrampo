<?php

namespace App\Http\Controllers;

use App\VagaDao;
use App\CandidatoDao;
use App\Classes\Candidato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CandidatoController extends Controller
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

    public function candidato_index()
    {
        $vagaDao = new VagaDao();
        $vagas = $vagaDao->listar();

        return view('candidato/home')->with('vagas', $vagas);
    }
}
