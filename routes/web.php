<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CRUDController;

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

Route::get('/', function () {
    return view('welcome');
});

//Route::resource('przedmioty', CRUDController::class)->except(['store', 'update']);

Route::controller(CRUDController::class)->prefix('przedmioty')->group(function() {
    Route::get('/wszystkie', 'index');
    Route::get('/dodaj-przedmiot', 'create');
    Route::get('/{id}', 'show');
    Route::get('/{id}/edytuj', 'edit');
    Route::get('/{id}/usun', 'destroy');
  });
