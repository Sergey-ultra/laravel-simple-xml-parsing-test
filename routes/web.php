<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
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

Route::get('/', [MainController::class, 'index'])->name('home');
Route::get('/login', [AuthController::class, 'showLogin'])->name('show-login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/registration', [AuthController::class, 'showRegistration'])->name('show-registration');
Route::post('/registration', [AuthController::class, 'registration'])->name('registration');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->prefix('admin')->group(function() {

    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('/regenerate', [AdminController::class, 'regenerate'])->name('regenerate');

});


