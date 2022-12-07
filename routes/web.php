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

Route::get('/hero/create', [HeroesController::class, 'create'])->middleware('auth');

Route::get('/hero/edit/{hero}', [HeroesController::class, 'edit'])->middleware('auth');

Route::post('/', [HeroesController::class, 'store'])->middleware('auth');

Route::put('/hero/{hero}', [HeroesController::class, 'update'])->middleware('auth');

Route::delete('/hero/{hero}', [HeroesController::class, 'destroy'])->middleware('auth');

Route::get('/hero/{hero}', [HeroesController::class, 'show']);

Route::get('/register', [UserController::class, 'create'])->middleware('guest');

Route::post('/users', [UserController::class, 'store']);

Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

//u providers RouteServiceProvider stavim da je public const HOME = '/', po defaultu je /home, a ja nemam /home rutu
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest'); //middleware authenticate vraca login

Route::post('/users/authenticate', [UserController::class, 'authenticate']);

Route::get('/manage', [HeroesController::class, 'manage'])->middleware('auth');
