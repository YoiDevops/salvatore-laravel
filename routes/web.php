<?php

use App\Http\Middleware\EnsureTeamMembership;
use Illuminate\Support\Facades\Route;

// Importación de todos los controladores del sistema académico
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

Route::view('/', 'welcome')->name('home');

Route::prefix('{current_team}')
    ->middleware(['auth', 'verified', EnsureTeamMembership::class])
    ->group(function () {
        Route::view('dashboard', 'dashboard')->name('dashboard');

        // --- RUTAS MÓDULOS ACADÉMICOS (PROTEGIDAS) ---
        Route::resource('acudientes', AcudienteController::class);
        Route::resource('areas', AreaController::class);
        Route::resource('asignaturas', AsignaturaController::class);
        Route::resource('caracterizaciones', Caracterizacion_discapacidadController::class);
        Route::resource('grados', GradoController::class);
        Route::resource('cursos', CursoController::class);
        Route::resource('escalas', Escala_valoracionController::class);
        Route::resource('periodos', PeriodoController::class);
        Route::resource('indicadores', Indicador_logroController::class);
        Route::resource('estudiantes', EstudianteController::class);
        Route::resource('profesores', ProfesorController::class);
        Route::resource('instituciones', InstitucionController::class);
        Route::resource('sedes', SedeController::class);
        Route::resource('roles', RolController::class);
        
        // Usuarios (sin create/store ya que se registran vía Auth/Roles)
        Route::resource('usuarios', UserController::class)->except(['create', 'store']);
        Route::put('usuarios/{id}/password', [UserController::class, 'updatePassword'])->name('usuarios.updatePassword');
    });

require __DIR__.'/settings.php';