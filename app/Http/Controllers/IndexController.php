<?php

namespace App\Http\Controllers;

use App\User;
use App\AreaDao;
use App\EmpresaDao;
use App\EnderecoDao;
use App\CandidatoDao;
use App\Classes\Vaga;
use App\Classes\Empresa;
use App\Classes\Usuario;
use App\Classes\Endereco;

use App\Classes\Candidato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{

    public function register()
    {
        $area = new AreaDao();
        $areas = $area->listar();
        return view('auth/register')->with('areas', $areas);

    }

    public function criar(Request $request)
    {
        $user = User::where(['email' => $request->email])->first();
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
            'perfil'   => 'required',
            'password' => 'required',
            'estado'   => 'required',
            'cidade'   => 'required',
            'cep'	   => 'required',
            'numero'   => 'required|numeric'
        );

        $messages = array(
            'name.required'	     => 'Campo nome é obrigatório',
            'email.required'     => 'Campo email é obrigatório',
            'perfil.required'    => 'Campo perfil é obrigatório',
            'password.required'	 => 'Campo senha é obrigatório',
            'estado.required'	 => 'Campo estado é obrigatório',
            'cidade.required'	 => 'Campo cidade é obrigatório',
            'cep.required'	     => 'Campo cep é obrigatório',
        );
        $this->validate($request, $rules, $messages);

        $endereco = new Endereco();

        $endereco->setEstado($request->estado);
        $endereco->setCidade($request->cidade);
        $endereco->setNumero($request->numero);
        $endereco->setRua($request->rua);
        $endereco->setCep($request->cep);
        $endereco->setStatus(1);

        $enderecoDao = new EnderecoDao();
        $Endereco = $enderecoDao->criar($endereco);

        $endereco->setId($Endereco->id_endereco);

        $usuario = new Usuario();
        $usuario->setNome($request->name);
        $usuario->setEmail($request->email);
        $usuario->setSenha(Hash::make($request->password));
        $usuario->setPerfil($request->perfil);
        $usuario->setEndereco($endereco->getId());
        $usuario->setStatus(1);

        $usuarioDao = new User();
        $Usuario = $usuarioDao->criar($usuario);

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
            $candidato->setApresentacao($request->apresentacao);
            $candidato->setCurriculo($request->curriculo);
            $candidato->setArea($request->area);
            $candidato->setCurriculo($request->curriculo);
            $candidato->setProfissao($request->profissao);
            $candidato->setId_user($Usuario->id);
            $candidato->setStatus(1);

            $candidatoDao = new CandidatoDao();
            $candidatoDao->criar($candidato);

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

        return redirect()->route('index');
    }

    public function logar()
    {
        return view('auth/login');
    }

    public function login(Request $request)
    {
        $usuario = new Usuario();

        $usuario->setEmail((string)$request->email);
        $usuario->setSenha((string)$request->password);

        if(Auth::guard('web')->attempt(['email' => $usuario->getEmail(), 'password' => $usuario->getSenha(), 'status' => 1]))
        {
            return redirect()->route(Auth::user()->perfil.'_index');
        }

        return redirect()->route('login');
    }
}
