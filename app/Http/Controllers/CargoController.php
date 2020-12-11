<?php

namespace App\Http\Controllers;

use App\AreaDao;
use App\CargoDao;
use App\Classes\Area;
use App\Classes\Cargo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CargoController extends Controller
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

    public function index()
    {
        $cargoDao = new CargoDao();
        $cargo = $cargoDao->listar();

        return view('cargo/gerenciar')->with('cargo', $cargo);
    }

    public function novo_cargo()
    {
        $areaDao = new AreaDao();
        $areas = $areaDao->listar();

        return view('cargo/cadastrar')->with('Area', $areas);
    }

    public function cadastrar_cargo(Request $request)
    {
        $rules  = array(
            'nome'   => 'required',
            'area'   => 'required'
        );

        $messages = array(
            'nome.required' => 'Campo nome é obrigatório',
            'area.required' => 'Campo área é obrigatório',
        );
        $this->validate($request, $rules, $messages);

        $cargo = new Cargo();
        $area = new Area();
        $area->setNome($request->area);

        $cargo->setNome($request->nome);
        $cargo->setArea($area->getNome());
        $cargo->setStatus(1);

        $cargoDao = new CargoDao();
        $cargoDao->criar($cargo);

        return redirect()->route('gerenciar_cargo');
    }

    public function editar_cargo(Request $request)
    {
        $rules  = array(
            'id'   => 'required',
        );

        $messages = array(
            'id.required' => 'Campo id é obrigatório',
        );
        $this->validate($request, $rules, $messages);

        $areaDao = new AreaDao();
        $areas = $areaDao->listar();

        $cargo = new Cargo();

        $cargo->setId_Cargo($request->id);

        $cargoDao = new CargoDao();
        $result = $cargoDao->editar($cargo);

        return view('cargo/editar')->with('cargo', $result)->with('Area', $areas);
    }

    public function atualizar_cargo(Request $request)
    {
        $rules  = array(
            'id'   => 'required',
            'nome' => 'required',
            'area' => 'required',
        );

        $messages = array(
            'nome.required' => 'Campo nome é obrigatório',
            'id.required'   => 'Campo id é obrigatório',
            'area.required' => 'Campo área é obrigatório',
        );
        $this->validate($request, $rules, $messages);

        $cargo = new Cargo();
        $area = new Area();

        $area->setNome($request->area);
        $cargo->setArea($area->getNome());

        $cargo->setNome($request->nome);
        $cargo->setId_Cargo($request->id);

        $cargoDao = new CargoDao();
        $cargoDao->atualizar($cargo);

        return redirect()->route('gerenciar_cargo');
    }

    public function excluir_cargo(Request $request)
    {
        $rules  = array(
            'id'   => 'required',
        );

        $messages = array(
            'id.required' => 'Campo id é obrigatório',
        );
        $this->validate($request, $rules, $messages);

        $cargo = new Cargo();

        $cargo->setId_Cargo($request->id);

        $cargoDao = new CargoDao();
        $cargoDao->deletar($cargo);

        return redirect()->route('gerenciar_cargo');
    }
}
