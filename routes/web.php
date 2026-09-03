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
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Volt::route('/login', 'Actions.auth.login')->name('login');

Route::view('/', 'welcome')->name('home');

require __DIR__.'/settings.php';

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    Route::view('administrador/dashboard', 'administrador.dashboardAdmin')
        ->middleware('role:Administrador')
        ->name('dashboardAdmin');

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