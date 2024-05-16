<?php

use App\UI\Http\Controllers\PetController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', [PetController::class, 'index'])->name('pet.index');
Route::get('/pet/filter', [PetController::class, 'filter'])->name('pet.filter');
Route::delete('/pet/{id}', [PetController::class, 'delete'])->name('pet.delete');
Route::get('/pet/{id}/edit', [PetController::class, 'edit'])->name('pet.edit');
Route::put('/pet/{id}', [PetController::class, 'update'])->name('pet.update');
Route::get('/pet/create', [PetController::class, 'create'])->name('pet.create');
Route::post('/pet', [PetController::class, 'store'])->name('pet.store');
