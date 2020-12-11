<?php

namespace App\Http\Controllers;

use App\User;
use App\VagaDao;
use App\EmpresaDao;
use App\EnderecoDao;
use App\CandidatoDao;
use App\Classes\Empresa;
use App\Classes\Usuario;
use App\Classes\Endereco;
use App\Classes\Candidato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
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
        return redirect()->route(Auth::user()->perfil.'_index');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('_index');
    }

    public function edit_user()
    {
        $usuario = new Usuario();
        $usuario->setId(Auth::user()->id);

        $usuarioDao = new User();
        $user = $usuarioDao->editar($usuario);

        return view('auth/edit')->with('Usuario', $user);
    }

    public function atualizar_user(Request $request)
    {
        $usuario = new Usuario();
        $usuario->setId(Auth::user()->id);

        $usuarioDao = new User();


        $user = $usuarioDao->editar($usuario);
        if($user)
        {
            $rules  = array(
                'email'    => 'required',
            );

            $messages = array(
                'email.required'	=> 'Email já cadastrado',
            );
            $this->validate($request, $rules, $messages);
        }

        $rules  = array(
            'name'     => 'required',
            'email'    => 'required',
            'estado'   => 'required',
            'cidade'   => 'required',
            'cep'	   => 'required',
            'numero'   => 'required|numeric'
        );

        $messages = array(
            'name.required'	     => 'Campo nome é obrigatório',
            'email.required'     => 'Campo email é obrigatório',
            'estado.required'	 => 'Campo estado é obrigatório',
            'cidade.required'	 => 'Campo cidade é obrigatório',
            'cep.required'	     => 'Campo cep é obrigatório',
        );
        $this->validate($request, $rules, $messages);

        $endereco = new Endereco();

        $endereco->setId($user->endereco->id_endereco);
        $endereco->setEstado($request->estado);
        $endereco->setCidade($request->cidade);
        $endereco->setNumero($request->numero);
        $endereco->setRua($request->rua);
        $endereco->setCep($request->cep);
        $endereco->setStatus(1);

        $enderecoDao = new EnderecoDao();
        $Endereco = $enderecoDao->atualizar($endereco);

        $endereco->setId($Endereco->id_endereco);

        $usuario->setNome($request->name);
        $usuario->setEmail($request->email);
        $usuario->setEndereco($endereco->getId());
        $usuario->setStatus(1);

        $usuarioDao = new User();
        $Usuario = $usuarioDao->atualizar($usuario);

        if($Usuario->perfil == 'candidato')
        {
            $rules  = array(
                'curriculo'    => 'required',
                'apresentacao' => 'required',
                'area'         => 'required',
                'curriculo'    => 'required',
            );

            $messages = array(
                'curriculo.required'	=> 'Campo cúrriculo é obrigatório',
                'apresentacao.required' => 'Campo apresentação é obrigatório',
                'area.required'         => 'Campo área é obrigatório',
                'curriculo.required'    => 'Campo currículo é obrigatório',
            );
            $this->validate($request, $rules, $messages);

            if ($request->hasFile('curriculo') && $request->file('curriculo')->isValid())
            {
                $name = uniqid(date('HisYmd'));

                $extension = $request->curriculo->extension();

                if(strtolower($extension) != "pdf")
                {
                    $rules  = array(
                        'curriculo'    => 'required',
                    );
                    $messages = array(
                        'curriculo.required' => 'Cúrriculo deve ser em formato pdf',
                    );
                    $this->validate($request, $rules, $messages);
                }
                $request->curriculo = "{$name}.{$extension}";
            }

            $candidato = new Candidato();
            $candidato->setId_User($Usuario->id);
            $candidato->setApresentacao($request->apresentacao);
            $candidato->setCurriculo($request->curriculo);
            $candidato->setArea($request->area);
            $candidato->setCurriculo($request->curriculo);
            $candidato->setProfissao($request->profissao);
            $candidato->setStatus(1);

            $candidatoDao = new CandidatoDao();
            $candidatoDao->atualizar($candidato);

            return redirect()->route('index');
        }

        $rules  = array(
            'cnpj'    => 'required',
        );

        $messages = array(
            'cnpj.required'	=> 'Campo cnpj é obrigatório',
        );
        $this->validate($request, $rules, $messages);

        $empresa = new Empresa();

        $empresa->setCnpj($request->cnpj);
        $empresa->setId_user($Usuario->id);
        $empresa->setStatus(1);

        $empresaDao = new EmpresaDao();
        $empresaDao->criar($empresa);

        return redirect()->route(Auth::user()->perfil.'_index');
    }
}
