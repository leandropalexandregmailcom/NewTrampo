<?php

namespace App;

use App\Classes\Cargo;
use App\Interfaces\ICargoDao;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class CargoDao extends Model implements ICargoDao
{
    public $timestamps = false;
    protected $primaryKey 	= 'id_cargo';
    protected $table		= 'cargo';

    protected $fillable = array(
        'id_cargo', 'nome', 'id_area', 'status', 'create_date', 'update_date',
    );

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'id_user');
    }

    public function area()
    {
        return $this->hasOne('App\AreaDao', 'id_area', 'id_area');
    }

    public function vaga()
    {
        return $this->hasOne('App\VagaDao', 'vaga', 'id_vaga');
    }

    public function criar(Cargo $cargo)
    {
        $cargoDao = new CargoDao();
        $cargoDao->nome = $cargo->getNome();
        $cargoDao->id_area = $cargo->getArea();
        $cargoDao->status = $cargo->getStatus();
        $cargoDao->save();

        return true;
    }

    public function deletar(Cargo $cargo)
    {
        $where = array(
            'id_cargo' => $cargo->getId_Cargo(),
        );
        $cargoDao = CargoDao::where($where)->update(['status' => 0]);

        return $cargoDao;
    }

    public function editar(Cargo $cargo)
    {
        $where = array(
            'id_cargo' => $cargo->getId_Cargo(),
        );
        $cargoDao = CargoDao::where($where)->first();

        return $cargoDao;
    }

    public function atualizar(Cargo $cargo)
    {
        $where = array(
            'id_cargo' => $cargo->getId_Cargo(),
        );
        $cargoDao = CargoDao::where($where)->first();

        $cargoDao->nome = $cargo->getNome();
        $cargoDao->id_area = $cargo->getArea();
        $cargoDao->save();

        return true;
    }

    public function listar()
    {
        $cargoDao = CargoDao::where(['status' => 1])->with('area')->paginate(10);

        return $cargoDao;
    }

    public function relatorio_cargo($init, $final)
    {
        $resultado = VagaDao::where(['id_cargo' => Auth::user()->cargo->area])
        ->where('create_date', '>=', $init)
        ->where('update_date', '<=', $final)
        ->with(['vaga'])
        ->paginate(10);

        return $resultado;
    }
}
