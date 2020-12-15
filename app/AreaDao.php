<?php

namespace App;

use App\Classes\Area;
use App\Interfaces\IAreaDao;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class AreaDao extends Model implements IAreaDao
{
    public $timestamps = false;
    protected $primaryKey 	= 'id_area';
    protected $table		= 'area';

    protected $fillable = array(
        'id_area', 'nome', 'create_date', 'update_date', 'status',
    );

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'id_user');
    }

    public function vaga()
    {
        return $this->hasOne('App\VagaDao', 'area', 'id_area');
    }

    public function criar(Area $area)
    {
        $areaDao = new AreaDao();
        $areaDao->nome = $area->getNome();
        $areaDao->status = $area->getStatus();
        $areaDao->save();

        return true;
    }

    public function deletar(Area $area)
    {
        $where = array(
            'id_area' => $area->getId_Area(),
        );
        $areaDao = AreaDao::where($where)->update(['status' => 0]);
        CargoDao::where($where)->update(['status' => 0]);
        $vaga = VagaDao::where($where)->update(['status' => 0]);
        CandidatoVagaDao::where(['id_vaga' => $vaga->id])->update(['status' => 0]);

        return $areaDao;
    }

    public function editar(Area $area)
    {
        $where = array(
            'id_area' => $area->getId_Area(),
        );
        $areaDao = AreaDao::where($where)->with(['cargo' => function($query)
        {
            $query->where(['status' => 1]);
        }])->first();

        return $areaDao;
    }

    public function atualizar(Area $area)
    {
        $where = array(
            'id_area' => $area->getId_Area(),
        );
        $areaDao = AreaDao::where($where)->first();

        $areaDao->nome = $area->getNome();
        $areaDao->save();

        return true;
    }

    public function listar()
    {
        $areaDao = AreaDao::where(['status' => 1])->paginate(10);

        return $areaDao;
    }
}
