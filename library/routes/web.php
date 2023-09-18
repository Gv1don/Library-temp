<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataBasesController;

Route::get('/Library_card', [DataBasesController::class, 'Feeling'])->name('Library_card');

Route::get('/Reader', [DataBasesController::class, 'Feeling'])->name('Reader');

Route::get('/Book', [DataBasesController::class, 'Feeling'])->name('Book');

Route::get('/Genre', [DataBasesController::class, 'Feeling'])->name('Genre');

Route::get('/Author', [DataBasesController::class, 'Feeling'])->name('Author');

Route::get('/create', [DataBasesController::class, 'Create'])->name('create');

Route::post('/create', [DataBasesController::class, 'CreateSave']);

Route::get('/update', [DataBasesController::class, 'Update'])->name('update');

Route::post('/update', [DataBasesController::class, 'UpdateSave']);

Route::post('/delete', [DataBasesController::class, 'Delete'])->name('delete');

Route::get('/error', function(){
    return view('error');
})->name('error');