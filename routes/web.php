<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GroupsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\InstituitionsController;
use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [Controller::class, 'homepage']);
Route::get('/cadastro', [Controller::class, 'cadastrar']);

/**
 * Routes to user auth
 * 
 */

Route::get('/login', [Controller::class, 'fazerLogin'])->name('login.form');
Route::post('/login', [DashboardController::class, 'auth'])->name('user.login');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('user.dashboard');

/*Route::get('/user', [UsersController::class, 'index'])->name('user.index');
*/
Route::resource('user', UsersController::class);
Route::resource('instituition', InstituitionsController::class);
Route::resource('group', GroupsController::class);

Route::post('group/{group_id}/user', [GroupsController::class, 'userStore'])->name('group.user.store');

Route::resource('instituition.product', ProductsController::class);