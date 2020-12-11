<?php

namespace App;

use App\Classes\Usuario;
use App\Classes\Endereco;
use App\Interfaces\IUsuarioDao;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    public $timestamps = false;

    protected $fillable = [
        'id', 'name', 'email', 'password', 'perfil', 'id_endereco', 'create_date', 'update_date'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function empresa()
    {
        return $this->hasOne('App\EmpresaDao', 'id_user', 'id');
    }

    public function candidato()
    {
        return $this->hasOne('App\CandidatoDao', 'id_user', 'id');
    }

    public function endereco()
    {
        return $this->hasOne('App\EnderecoDao', 'id_endereco', 'id_endereco');
    }

    public function criar(Usuario $usuario)
    {
        $UsuarioDao = new User();
        $UsuarioDao->name = $usuario->getNome();
        $UsuarioDao->email = $usuario->getEmail();
        $UsuarioDao->password = $usuario->getSenha();
        $UsuarioDao->perfil = $usuario->getPerfil();
        $UsuarioDao->status = $usuario->getStatus();
        $UsuarioDao->id_endereco = $usuario->getEndereco();
        $UsuarioDao->save();

        return $UsuarioDao;
    }

    public function listar()
    {
        $UsuarioDao = new User();

        $user = $UsuarioDao->where(['status' => 1])
        ->with(['endereco' => function($query)
        {
            $query->where(['status' => 1]);
        }])
        ->with(['candidato' =>function($query)
        {
            $query->where(['status' => 1]);
        }])
        ->with(['empresa' =>function($query)
        {
            $query->where(['status' => 1]);
        }])
        ->paginate(10);

        return $user;
    }

    public function excluir(Usuario $usuario)
    {
        $UsuarioDao = new User();
        $UsuarioDao->where(['id' => $usuario->getId()])->update(['status' => 0]);
        EnderecoDao::where(['id_endereco' => Auth::user()->id_endereco])->update(['status' => 0]);

        if(Auth::user()->perfil == 'candidato')
        {
            $Usuario = CandidatoDao::where(['id_user' => $usuario->getId(), 'status' => 1])->update(['status' => 0]);
        }
        elseif(Auth::user()->perfil == 'empresa')
        {
            $Usuario = EmpresaDao::where(['id_user' => $usuario->getId(), 'status' => 1])->update(['status' => 0]);
        }

        return true;
    }

    public function editar(Usuario $usuario)
    {
        $UsuarioDao = new User();

        $user = $UsuarioDao->where(['id' => $usuario->getId(), 'status' => 1])
        ->with('endereco')->with(Auth::user()->perfil)->first();

        return $user;
    }

    public function atualizar(Usuario $usuario)
    {
        $Usuario = new User();
        $UsuarioDao = $Usuario->where(['id' => $usuario->getId(), 'status' => 1])->first();
        $UsuarioDao->name = $usuario->getNome();
        $UsuarioDao->email = $usuario->getEmail();
        $UsuarioDao->id_endereco = $usuario->getEndereco();
        $UsuarioDao->save();

        return $UsuarioDao;
    }
}
