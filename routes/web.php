<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\PermissionController;

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
// Route::get('/', function () { return view('home'); });


Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('register', [RegisterController::class, 'register']);

Route::get('password/forget',  function () {
	return view('pages.forgot-password');
})->name('password.forget');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');


Route::group(['middleware' => 'auth'], function () {
	// logout route
	Route::get('/logout', [LoginController::class, 'logout']);
	Route::get('/clear-cache', [HomeController::class, 'clearCache']);

	// dashboard route  
	Route::get('/dashboard', function () {
		return view('pages.dashboard');
	})->name('dashboard');

	//only those have manage_user permission will get access
	Route::group(['middleware' => 'can:manage_user'], function () {
		Route::get('/users', [UserController::class, 'index'])->name('usuarios');
		Route::get('/user/get-list', [UserController::class, 'getUserList']);
		Route::get('/user/create', [UserController::class, 'create']);
		Route::post('/user/create', [UserController::class, 'store'])->name('create-user');
		Route::get('/user/{id}', [UserController::class, 'edit']);
		Route::post('/user/update', [UserController::class, 'update']);
		Route::get('/user/delete/{id}', [UserController::class, 'delete']);
	});

	//only those have manage_role permission will get access
	Route::group(['middleware' => 'can:manage_role|manage_user'], function () {
		Route::get('/roles', [RolesController::class, 'index']);
		Route::get('/role/get-list', [RolesController::class, 'getRoleList']);
		Route::post('/role/create', [RolesController::class, 'create']);
		Route::get('/role/edit/{id}', [RolesController::class, 'edit']);
		Route::post('/role/update', [RolesController::class, 'update']);
		Route::get('/role/delete/{id}', [RolesController::class, 'delete']);
	});


	//only those have manage_permission permission will get access
	Route::group(['middleware' => 'can:manage_permission|manage_user'], function () {
		Route::get('/permission', [PermissionController::class, 'index']);
		Route::get('/permission/get-list', [PermissionController::class, 'getPermissionList']);
		Route::post('/permission/create', [PermissionController::class, 'create']);
		Route::get('/permission/update', [PermissionController::class, 'update']);
		Route::get('/permission/delete/{id}', [PermissionController::class, 'delete']);
	});

	// get permissions
	Route::get('get-role-permissions-badge', [PermissionController::class, 'getPermissionBadgeByRole']);

	/////////////////////////////////////////////////////NUMEROS/////////////////////////////////////////////////////////////////////////		

	// Route::get('/clientes/listar/{id}', function ($id) { return view('pages.pricing', ['id' => $id]); });
	Route::get('/numeros/listar', 'numeros\NumerosController@listar')->name('numeros.listar');
	Route::get('/numeros/cadastar', 'numeros\NumerosController@cadastro')->name('numeros.cadastro');
	Route::post('/numeros/salvar', 'numeros\NumerosController@salvar')->name('numeros.salvar');
	Route::post('/numeros/buscar', 'numeros\NumerosController@buscaNomes')->name('numeros.buscar');
	// Route::post('/clientes/cadastrarpj', [ClientesController::class, 'cadastraClientesPj'])->name('clientes.cadastraClientesPj');
	// Route::post('/clientes/atualizarpj/{id}', [ClientesController::class, 'atualizarpj'])->name('atualizarpj');
	Route::post('/numeros/atualizar/{id}', 'numeros\NumerosController@atualizar')->name('numeros.atualizar');
	Route::post('/numeros/exibir', 'numeros\NumerosController@verNumero')->name('numeros.exibir');
	Route::get('/numeros/excluir/{id}', 'numeros\NumerosController@remover')->name('numeros.remove');
	Route::get('/numeros/editar/{id}', 'numeros\NumerosController@editar')->name('numeros.editar');
	// Route::get('/clientes/editarpj/{id}', [ClientesController::class, 'editarpj'])->name('editarpj');
	// Route::get('/clientes/imprimir/{id}', [ClientesController::class, 'imprimir'])->name('imprimir');
	// Route::get('/clientes/imprimirpj/{id}', [ClientesController::class, 'imprimirpj'])->name('imprimirpj');

	////////////////////////////////////////////////////APARELHOS/////////////////////////////////////////////////////////////////////////	

	Route::get('/aparelhos/listar', 'aparelhos\AparelhosController@listar')->name('aparelhos.listar');
	Route::get('/aparelhos/cadastro', 'aparelhos\AparelhosController@cadastro')->name('aparelhos.cadastro');
	Route::get('/aparelho/estoque', 'aparelhos\AparelhosController@estoque')->name('aparelhos.estoque');
	Route::post('/aparelhos/salvar', 'aparelhos\AparelhosController@salvar')->name('aparelhos.salvar');
	Route::post('/aparelhos/exibir', 'aparelhos\AparelhosController@verAparelho')->name('aparelhos.exibir');
	Route::get('/aparelhos/editar/{id}', 'aparelhos\AparelhosController@editar')->name('aparelhos.editar');
	Route::post('/aparelhos/atualizar/{id}', 'aparelhos\AparelhosController@atualizar')->name('aparelhos.atualizar');
	Route::get('/vendedores/excluir/{id}', 'aparelhos\AparelhosController@remover')->name('aparelhos.remove');
	Route::post('/aparelhos/confirmma', 'aparelhos\AparelhosController@confirmaEntrega')->name('aparelhos.confirma');
	Route::post('/aparelhos/lista_estoque', 'aparelhos\AparelhosController@buscaEstoque')->name('aparelhos.lista_estoque');

	///////////////////////////////////////////////////////CONTRATOS/////////////////////////////////////////////////////////////////////////	

	Route::get('/contratos/listar', 'contratos\ContratosController@listar')->name('contratos.listar');
	Route::get('/contratos/cadastro', 'contratos\ContratosController@cadastro')->name('contratos.cadastro');
	Route::post('/contratos/salvar', 'contratos\ContratosController@salvar')->name('contratos.salvar');
	Route::post('/contratos/buscar', 'contratos\ContratosController@buscaNomes')->name('contratos.buscaNomes');
	Route::post('/contratos/exibir', 'contratos\ContratosController@verContrato')->name('contratos.exibir');
	Route::get('/contratos/excluir/{id}', 'contratos\ContratosController@remover')->name('contratos.remove');
	Route::get('/contratos/imprimir/{id}', 'contratos\ContratosController@imprimir')->name('contratos.imprimir');
	// Route::post('/contratos/editar', 'contratos\ContratosController@editar')->name('contratos.editar');
	// Route::post('/tecnicos/atualizar/{id}', 'tecnicos\TecnicosController@atualizar')->name('tecnicos.atualizar');

	///////////////////////////////////////////////////////FATURAS/////////////////////////////////////////////////////////////////////////////

	Route::get('/faturas/listar', 'faturas\FaturasController@listar')->name('faturas.listar');
	Route::post('/faturas/cadastro', 'faturas\FaturasController@file')->name('faturas.cadastro');
	Route::get('/faturas/lancamento', 'faturas\FaturasController@cadastro')->name('faturas.lancamento');
	Route::post('/faturas/salvar', 'faturas\FaturasController@salvar')->name('faturas.salvar');
	Route::post('/faturas/exibir', 'faturas\FaturasController@verFatura')->name('faturas.exibir');
	Route::get('/faturas/excluir/{id}', 'faturas\FaturasController@remover')->name('faturas.remove');
	Route::get('/faturas/editar/{id}', 'faturas\FaturasController@editar')->name('faturas.editar');
	Route::post('/faturas/atualizar/{id}', 'faturas\FaturasController@atualizar')->name('faturas.atualizar');
	Route::get('/faturas/txt', 'faturas\FaturasController@gerarTxtFaturas')->name('faturas.txt');
	Route::get('/faturas/xml', 'faturas\FaturasController@gerarXml')->name('faturas.xml');


	///////////////////////////////////////////////////CONSULTA FATURAS/////////////////////////////////////////////////////////////////////////////

	Route::get('/consulta-fat/listar', 'consulta_fat\ConsultaFaturaController@listar')->name('consulta-fat.listar');
	Route::post('/consulta-fat/consulta', 'consulta_fat\ConsultaFaturaController@buscaFatura')->name('faturas.lista_faturas');
	// Route::get('/ordens-servico/cadastro', 'ordens\OrdemServicoController@cadastro')->name('ordens.cadastro');
	// Route::post('/tecnicos/salvar', 'tecnicos\TecnicosController@salvar')->name('tecnicos.salvar');
	// Route::post('/tecnicos/exibir', 'tecnicos\TecnicosController@verTecnico')->name('tecnicos.verTecnico');
	// Route::get('/tecnicos/excluir/{id}', 'tecnicos\TecnicosController@remover')->name('tecnicos.remove');
	// Route::get('/tecnicos/editar/{id}', 'tecnicos\TecnicosController@editar')->name('tecnicos.editar');
	// Route::post('/tecnicos/atualizar/{id}', 'tecnicos\TecnicosController@atualizar')->name('tecnicos.atualizar');


	/////////////////////////////////////////////////////////DASHBOARD///////////////////////////////////////////////////////////////////


	Route::get('/dashboard', 'dashboard\DashboardController@dados')->name('dashboard.dados');
});


//Route::get('/register', function () { return view('pages.register'); });