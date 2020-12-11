<?php

namespace App\Http\Controllers;

use App\VagaDao;
use App\EmpresaDao;
use App\Classes\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmpresaController extends Controller
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

    public function empresa_index()
    {
        $vagaDao = new VagaDao();
        $vagas = $vagaDao->listar_vaga_empresa();

        return view('empresa/home')->with('vagas', $vagas);
    }

}
