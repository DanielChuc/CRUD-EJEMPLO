<?php

use App\Http\Controllers\EmpleadoController;
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

Route::get('/', function () {
    return view('auth.login');
});

/* Route::get('/empleado', [EmpleadoController::Class,'index']);
Route::get('/empleado/create', [EmpleadoController::Class,'create']);
Route::get('/empleado/edit', [EmpleadoController::Class,'edit']);
 */
Route::resource('empleado', EmpleadoController::class)->middleware('auth');
Auth::routes(['register'=>false,'reset'=>false]);

Route::get('/home', [EmpleadoController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [EmpleadoController::class, 'index'])->name('home');

});
