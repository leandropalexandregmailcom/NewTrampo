<?php

namespace App\Http\Controllers;

use App\AreaDao;
use App\Classes\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AreaController extends Controller
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
        $areaDao = new AreaDao();
        $areas = $areaDao->listar();

        return view('area/gerenciar')->with('areas', $areas);
    }

    public function nova_area()
    {
        return view('area/cadastrar');
    }

    public function cadastrar_area(Request $request)
    {
        $rules  = array(
            'nome'   => 'required',
        );

        $messages = array(
            'nome.required' => 'Campo nome é obrigatório',
        );
        $this->validate($request, $rules, $messages);

        $area = new Area();

        $area->setNome($request->nome);
        $area->setStatus(1);

        $areaDao = new AreaDao();
        $areaDao->criar($area);

        return redirect()->route('gerenciar_area');
    }

    public function editar_area(Request $request)
    {
        $rules  = array(
            'id'   => 'required',
        );

        $messages = array(
            'id.required' => 'Campo id é obrigatório',
        );
        $this->validate($request, $rules, $messages);

        $area = new Area();

        $area->setId_Area($request->id);

        $areaDao = new AreaDao();
        $result = $areaDao->editar($area);

        return view('area/editar')->with('area', $result);
    }

    public function atualizar_area(Request $request)
    {
        $rules  = array(
            'id'   => 'required',
            'nome' => 'required',
        );

        $messages = array(
            'nome.required' => 'Campo nome é obrigatório',
            'id.required'   => 'Campo id é obrigatório',
        );
        $this->validate($request, $rules, $messages);

        $area = new Area();

        $area->setNome($request->nome);
        $area->setId_Area($request->id);

        $areaDao = new AreaDao();
        $areaDao->atualizar($area);

        return redirect()->route('gerenciar_area');
    }

    public function excluir_area(Request $request)
    {
        $rules  = array(
            'id'   => 'required',
        );

        $messages = array(
            'id.required' => 'Campo id é obrigatório',
        );
        $this->validate($request, $rules, $messages);

        $area = new Area();

        $area->setId_Area($request->id);

        $areaDao = new AreaDao();
        $result = $areaDao->deletar($area);

        return redirect()->route('gerenciar_area');
    }
}
