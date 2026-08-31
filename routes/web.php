<?php

use App\Http\Controllers\Academico\AreaController;
use App\Http\Controllers\Academico\AsignaturaController;
use App\Http\Controllers\Academico\CursoController;
use App\Http\Controllers\Academico\GradoController;
use App\Http\Controllers\estudiante\AcudienteController;
use App\Http\Controllers\estudiante\CaracterizacionDiscapacidadController;
use App\Http\Controllers\estudiante\EstudianteController;
use App\Http\Controllers\Evaluacion\EscalaValoracionController;
use App\Http\Controllers\Evaluacion\IndicadorLogroController;
use App\Http\Controllers\Evaluacion\PeriodoController;
use App\Http\Controllers\Institucional\InstitucionController;
use App\Http\Controllers\Institucional\SedeController;
use App\Http\Controllers\profesor\ProfesorController;
use App\Http\Controllers\Usuarios\RolController;
use App\Http\Controllers\Usuarios\UserController;
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