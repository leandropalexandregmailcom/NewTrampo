<?php

namespace App;

use App\Classes\Endereco;
use App\Interfaces\IEnderecoDao;
use Illuminate\Database\Eloquent\Model;

class EnderecoDao extends Model implements IEnderecoDao
{
    public $timestamps = false;
    protected $primaryKey 	= 'id_endereco';
    protected $table		= 'endereco';

    protected $fillable = array(
        'id_endereco', 'rua', 'cep', 'cidade', 'numero', 'update_date', 'create_date', 'status',
    );

    public function criar(Endereco $endereco)
    {
        $EnderecoDao = new EnderecoDao();
        $EnderecoDao->rua = $endereco->getRua();
        $EnderecoDao->cep = $endereco->getCep();
        $EnderecoDao->cidade = $endereco->getCidade();
        $EnderecoDao->numero = $endereco->getNumero();
        $EnderecoDao->status = $endereco->getStatus();
        $EnderecoDao->save();

        return $EnderecoDao;
    }

    public function deletar(Endereco $endereco)
    {
        $where = array(
            'id' => $endereco->getId(),
            'status' => $endereco->getStatus()
        );
        EnderecoDao::where($where)->update(['status' => 0]);

        return true;
    }

    public function editar(Endereco $endereco)
    {
        $where = array(
            'id' => $endereco->getId(),
            'status' => $endereco->getStatus()
        );

        $EnderecoDao = EnderecoDao::where($where)->first();

        return $EnderecoDao;
    }

    public function atualizar(Endereco $endereco)
    {
        $where = array(
            'id_endereco' => $endereco->getId(),
            'status' => $endereco->getStatus()
        );

        $EnderecoDao = EnderecoDao::where($where)->first();
        $EnderecoDao->rua = $endereco->getRua();
        $EnderecoDao->cep = $endereco->getCep();
        $EnderecoDao->cidade = $endereco->getCidade();
        $EnderecoDao->numero = $endereco->getNumero();
        $EnderecoDao->status = $endereco->getStatus();
        $EnderecoDao->save();

        return $EnderecoDao;
    }

    public function listar()
    {
        $where = array(
            'status' => 1
        );
        $EnderecoDao = EnderecoDao::where($where)->paginate(10);

        return $EnderecoDao;
    }
}
