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

Route::apiResource('/getCotacao', App\Http\Controllers\Api\ApiCotacaoController::class);

Route::apiResource('/useremail', App\Http\Controllers\Api\UserController::class);

Route::post('/transfer/valor', [App\Http\Controllers\Api\TransferController::class, 'store'])->name('transfer.store');

Route::get('/getTransfer/{id}', [App\Http\Controllers\Api\TransferController::class, 'show']);

Route::apiResource('/vehicles', App\Http\Controllers\Api\VehicleModelController::class);

Route::apiResource('/vehicles', App\Http\Controllers\Api\VehicleModelController::class);

Route::post('/vehicles', [App\Http\Controllers\Api\VehicleModelController::class, 'vehicleTag']);

Route::get('/getAccount/{id}', [App\Http\Controllers\Api\AccountController::class, 'show']);