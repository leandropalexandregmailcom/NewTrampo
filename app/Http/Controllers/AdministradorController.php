<?php

namespace App\Http\Controllers;

use App\User;
use App\VagaDao;
use App\Classes\Usuario;
use Illuminate\Http\Request;
use App\Classes\Administrador;
use Illuminate\Support\Facades\Auth;

class AdministradorController extends Controller
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

    public function administrador_index()
    {
        $usuario = new User();
        $user = $usuario->listar();

        return view('administrador/home')->with('user', $user);
    }

    public function excluir_usuario(Request $request)
    {
        $usuario = new Usuario();
        $usuario->setId($request->id);

        $usuarioDao = new User();
        $usuarioDao->excluir($usuario);

        return redirect()->route(Auth::user()->perfil.'_index');
    }
}
