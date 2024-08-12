<?php


use App\Http\Controllers\FormVericationController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Api\UsuarioApiController;
use App\Http\Controllers\DashboardController;
use App\Mail\TestEmail;
use Illuminate\Support\Facades\Mail;


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
Route::get('/send-email', function () {
    Mail::to('recipient@example.com')->send(new TestEmail());
    return 'Email sent!';
});

Route::post('/verification/login/', [FormVericationController::class, 'getLogin'])->name('verification');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::view('/{any}', 'layouts/app')
    ->where('any', '.*');

require __DIR__ . '/auth.php';