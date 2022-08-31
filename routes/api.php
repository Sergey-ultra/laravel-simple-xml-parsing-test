<?php

use App\Http\Controllers\Api\CurrencyController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware(['currency', 'date.api'])->group(function() {
    Route::get('/quotation/{date}', [CurrencyController::class, 'index'])
    ->where('date', '\d\d\-\d\d\-\d\d\d\d')
    ;
});

