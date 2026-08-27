<?php

use App\Http\Controllers\AcudienteController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\AsignaturaController;
use App\Http\Controllers\CaracterizacionDiscapacidadController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\EscalaValoracionController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\GradoController;
use App\Http\Controllers\IndicadorLogroController;
use App\Http\Controllers\InstitucionController;
use App\Http\Controllers\PeriodoController;
use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\SedeController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\EnsureTeamMembership;
use Illuminate\Support\Facades\Route;

// Ruta pública inicial
Route::view('/', 'welcome')->name('home');

// Carga de rutas de configuración generales
require __DIR__.'/settings.php';

// Rutas autenticadas asociadas a un equipo
Route::prefix('{current_team}')
    ->middleware(['auth', 'verified', EnsureTeamMembership::class])
    ->group(function () {
        Route::view('dashboard', 'dashboard')->name('dashboard');

        Route::resource('acudientes', AcudienteController::class);
        Route::resource('areas', AreaController::class);
        Route::resource('asignaturas', AsignaturaController::class);
        Route::resource('caracterizaciones', CaracterizacionDiscapacidadController::class);
        Route::resource('grados', GradoController::class);
        Route::resource('cursos', CursoController::class);
        Route::resource('escalas', EscalaValoracionController::class);
        Route::resource('periodos', PeriodoController::class);
        Route::resource('indicadores', IndicadorLogroController::class);
        Route::resource('estudiantes', EstudianteController::class);
        Route::resource('profesores', ProfesorController::class);
        Route::resource('instituciones', InstitucionController::class);
        Route::resource('sedes', SedeController::class);
        Route::resource('roles', RolController::class);

        Route::resource('usuarios', UserController::class)->except(['create', 'store']);
        Route::put('usuarios/{id}/password', [UserController::class, 'updatePassword'])->name('usuarios.updatePassword');
    });