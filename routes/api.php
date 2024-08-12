<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\ReplySupportApiController;
use App\Http\Controllers\Api\SupportController;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\CartaoController;
use App\Http\Controllers\Api\UsuarioApiController;
use App\Http\Controllers\Api\AcessoController;
use App\Http\Controllers\Api\ContaController;
use App\Http\Controllers\Api\MarcacoesController;
use App\Http\Controllers\Api\MedicalController;
use App\Http\Controllers\Api\HorariosDisponiveisController;
use App\Http\Controllers\Api\AnimalUserController;
// use App\Http\Controllers\Api\ApiCotacaoController;



Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});


Route::apiResource('contas', ContaController::class)->names([
    'index' => 'contas.index'
]);

Route::patch('/contas/{id}', [ContaController::class, 'update']);
Route::patch('/contas/update-name/{id}', [ContaController::class, 'updateName']);
Route::patch('/contas/store/{id}', [ContaController::class, 'store']);

Route::get('/marcacoes/recepcionista', [MarcacoesController::class, 'getMarcacaoRecepcionista'])->name('marcacoes.getMarcacaoRecepcionista');

Route::put('/marcacoes/update/{id}', [MarcacoesController::class, 'update_medical'])->name('marcacoes.update_medical');

Route::put('/marcacoes/edicao/{id}', [MarcacoesController::class, 'edicao'])->name('marcacoes.edicao');

Route::put('/marcacoes/excluido/{id}', [MarcacoesController::class, 'excluido'])->name('marcacoes.excluido');

Route::apiResource('/marcacoes', MarcacoesController::class);

Route::apiResource('/horarios_disponiveis', HorariosDisponiveisController::class);

Route::apiResource('/medical', MedicalController::class);

Route::get('/animaluser/{id}', [AnimalUserController::class, 'show'])->name('animaluser.show');

Route::post('/submitMarcacao', [MarcacoesController::class, 'store'])->name('marcacao.store');

Route::apiResource('/getCotacao', App\Http\Controllers\Api\ApiCotacaoController::class);

Route::apiResource('/useremail', App\Http\Controllers\Api\UserController::class);

Route::post('/transfer/valor', [App\Http\Controllers\Api\TransferController::class, 'store'])->name('transfer.store');

Route::get('/getTransfer/{id}', [App\Http\Controllers\Api\TransferController::class, 'show']);