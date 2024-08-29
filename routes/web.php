<?php

use Illuminate\Support\Facades\Route;

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
use App\Http\Controllers\Controller;

Route::get('/', [Controller::class, 'homepage']);
Route::get('/cadastro', [Controller::class, 'cadastrar']);
Route::get('/login', [Controller::class, 'fazerLogin']);
