<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HeroesController;

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

Route::get('/', [HeroesController::class, 'index']);
Route::get('/hero/{hero}', [HeroesController::class, 'show']);
Route::post('/users', [UserController::class, 'store']);
Route::post('/users/authenticate', [UserController::class, 'authenticate']);

Route::middleware(['auth'])->group(function () {
    Route::get('/create', [HeroesController::class, 'create']);
    Route::get('/hero/edit/{hero}', [HeroesController::class, 'edit']);
    Route::post('/', [HeroesController::class, 'store']);
    Route::put('/hero/{hero}', [HeroesController::class, 'update']);
    Route::delete('/hero/{hero}', [HeroesController::class, 'destroy']);
    Route::post('/logout', [UserController::class, 'logout']);
    Route::get('/manage', [HeroesController::class, 'manage']);

});

Route::group(['middleware' => 'guest'], function() {
    Route::get('/register', [UserController::class, 'create']);
    //u providers RouteServiceProvider stavim da je public const HOME = '/', po defaultu je /home, a ja nemam /home rutu
    Route::get('/login', [UserController::class, 'login'])->name('login'); //middleware authenticate vraca login
});




