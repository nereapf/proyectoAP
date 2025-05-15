<?php

use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\GastosFabricacionController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\ValoracionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::resource('productos', ProductoController::class)->middleware('auth');
Route::post('/productos/{producto}/valoraciones', [ValoracionController::class, 'store'
])->name('valoraciones.store');
Route::resource('materiales', MaterialController::class)->parameters([
    'materiales' => 'material'
])->middleware('auth');
Route::resource('gastos', GastosFabricacionController::class)->middleware('auth');
Route::resource('proyectos', ProyectoController::class)->middleware('auth');
Route::resource('catalogos', CatalogoController::class)->middleware('auth');
Route::resource('valoraciones', ValoracionController::class)->parameters([
    'valoraciones' => 'valoracion'
]);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
