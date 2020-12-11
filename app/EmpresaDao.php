<?php

namespace App;

use App\Classes\Empresa;
use App\Interfaces\IEmpresaDao;
use Illuminate\Database\Eloquent\Model;

class EmpresaDao extends Model implements IEmpresaDao
{
    public $timestamps = false;
    protected $primaryKey 	= 'id_empresa';
    protected $table		= 'empresa';

    protected $fillable = array(
        'id_empresa', 'cnpj', 'id_user', 'update_date', 'create_date', 'status',
    );

    public function criar(Empresa $empresa)
    {
        $EmpresaDao = new EmpresaDao();
        $EmpresaDao->cnpj = $empresa->getCnpj();
        $EmpresaDao->status = $empresa->getStatus();
        $EmpresaDao->id_user = $empresa->getId_User();
        $EmpresaDao->save();

        return true;
    }
    public function deletar(Empresa $empresa)
    {
        $where = array(
            'status' => 1,
            'id_user' => $empresa->getId_User(),
        );
        EmpresaDao::where($where)->update(['status' => 0]);

        return true;
    }
    public function editar(Empresa $empresa)
    {
        $where = array(
            'status' => 1,
            'id_user' => $empresa->getId_User(),
        );
        $EmpresaDao = EmpresaDao::where($where)->first();
        return $EmpresaDao;
    }
    public function atualizar(Empresa $empresa)
    {
        $where = array(
            'status' => 1,
            'id_user' => $empresa->getId_User(),
        );
        $EmpresaDao = EmpresaDao::where($where)->first();
        $EmpresaDao->cnpj = $empresa->getCnpj();
        $EmpresaDao->status = $empresa->getStatus();
        $EmpresaDao->save();

        return true;
    }
    public function listar()
    {
        $where = array(
            'status' => 1,
        );
        $EmpresaDao = EmpresaDao::where($where)->paginate(10);

        return $EmpresaDao;
    }
}
