<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('_index');

Route::get('/login', 'IndexController@logar')->name('logar');
Route::post('/login', 'IndexController@login')->name('login');
Route::get('/register', 'IndexController@register')->name('register');
Route::post('/cadastrar_usuario', 'IndexController@criar')->name('cadastrar_usuario');

Route::group(['middleware' => 'web'], function()
{
    //User
    Route::get('/home', 'HomeController@index')->name('index');
    Route::get('/edit_user', 'HomeController@edit_user')->name('edit_user');
    Route::post('/atualizar_user', 'HomeController@atualizar_user')->name('atualizar_user');
    Route::post('/logout', 'HomeController@logout')->name('logout');
});

Route::group(['middleware' => 'web', 'middleware' => 'candidato'], function()
{
    Route::get('/candidato_index', 'CandidatoController@candidato_index')->name('candidato_index');
    //vaga
    Route::get('/ver_vagas', 'VagaController@ver_vaga')->name('ver_vagas');
    Route::get('/detalhe_vaga', 'VagaController@detalhe_vaga')->name('detalhe_vaga');
    Route::get('/candidatar_vaga', 'VagaController@candidatar_vaga')->name('candidatar_vaga');

    //relatórios
    Route::get('/relatorio_candidato', 'RelatorioController@relatorio_candidato')->name('relatorio_candidato');
    Route::get('/resultado_candidato', 'RelatorioController@resultado_candidato')->name('resultado_candidato');
    Route::get('/relatorio_candidato_area', 'RelatorioController@relatorio_candidato_area')->name('relatorio_candidato_area');
    Route::get('/resultado_candidato_area', 'RelatorioController@resultado_candidato_area')->name('resultado_candidato_area');
});

Route::group(['middleware' => 'web', 'middleware' => 'empresa'], function()
{
    Route::get('/empresa_index', 'EmpresaController@empresa_index')->name('empresa_index');
    //Vagas
    Route::get('/nova_vaga', 'VagaController@nova')->name('nova_vaga');
    Route::get('/candidato_vaga', 'VagaController@candidato_vaga')->name('candidato_vaga');
    Route::post('/criar_vaga', 'VagaController@criar_vaga')->name('criar_vaga');
    Route::get('/listar_vaga_empresa', 'VagaController@listar_vaga_empresa')->name('listar_vaga_empresa');
    Route::get('/editar_vaga', 'VagaController@editar_vaga')->name('editar_vaga');
    Route::get('/descartar_candidato', 'VagaController@descartar_candidato')->name('descartar_candidato');
    Route::post('/atualizar_vaga', 'VagaController@atualizar_vaga')->name('atualizar_vaga');
    Route::post('/excluir_vaga', 'VagaController@fechar_vaga')->name('excluir_vaga');

    //relatórios
    Route::get('/relatorio_candidato_vaga', 'RelatorioController@relatorio_candidato_vaga')->name('relatorio_candidato_vaga');
    Route::get('resultado_candidato_vaga', 'RelatorioController@resultado_candidato_vaga')->name('resultado_candidato_vaga');

    //estado
    Route::get('/mudar_estado', 'EstadoController@mudar_estado')->name('mudar_estado');
});


Route::group(['middleware' => 'web', 'middleware' => 'administrador'], function()
{
    Route::get('/administrador_index', 'AdministradorController@administrador_index')->name('administrador_index');
    //Area
    Route::get('/gerenciar_area', 'AreaController@index')->name('gerenciar_area');
    Route::post('/criar_area', 'AreaController@cadastrar_area')->name('criar_area');
    Route::get('/nova_area', 'AreaController@nova_area')->name('nova_area');
    Route::get('/editar_area', 'AreaController@editar_area')->name('editar_area');
    Route::post('/atualizar_area', 'AreaController@atualizar_area')->name('atualizar_area');
    Route::get('/excluir_area', 'AreaController@excluir_area')->name('excluir_area');

    //Cargo
    Route::get('/gerenciar_cargo', 'CargoController@index')->name('gerenciar_cargo');
    Route::post('/criar_cargo', 'CargoController@cadastrar_cargo')->name('criar_cargo');
    Route::get('/novo_cargo', 'CargoController@novo_cargo')->name('novo_cargo');
    Route::get('/editar_cargo', 'CargoController@editar_cargo')->name('editar_cargo');
    Route::post('/atualizar_cargo', 'CargoController@atualizar_cargo')->name('atualizar_cargo');
    Route::get('/excluir_cargo', 'CargoController@excluir_cargo')->name('excluir_cargo');

    //Cargo
    Route::get('/gerenciar_cargo', 'CargoController@index')->name('gerenciar_cargo');
    Route::post('/criar_cargo', 'CargoController@cadastrar_cargo')->name('criar_cargo');
    Route::get('/nova_cargo', 'CargoController@nova_cargo')->name('nova_cargo');
    Route::get('/editar_cargo', 'CargoController@editar_cargo')->name('editar_cargo');
    Route::post('/atualizar_cargo', 'CargoController@atualizar_cargo')->name('atualizar_cargo');
    Route::get('/excluir_cargo', 'CargoController@excluir_cargo')->name('excluir_cargo');

    //usuário
    Route::get('/excluir_usuario', 'AdministradorController@excluir_usuario')->name('excluir_usuario');
});
