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
use App\Http\Controllers\Institucional\SedeController;
use App\Http\Controllers\profesor\PanelController as ProfesorPanelController;
use App\Http\Controllers\profesor\ProfesorController;
use App\Http\Controllers\Usuarios\RolController;
use App\Http\Controllers\Usuarios\UserController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Volt::route('/login', 'Actions.auth.login')->name('login');

Route::view('/', 'welcome')->name('home');
Volt::route('/formulario', 'formulario')->name('formulario');

require __DIR__.'/settings.php';

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    Route::view('administrador/dashboard', 'administrador.dashboardAdmin')
        ->middleware('role:Administrador')
        ->name('dashboardAdmin');

    Route::middleware('role:Administrador')->group(function () {
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
        Route::resource('sedes', SedeController::class);
        Route::resource('roles', RolController::class);

        Route::resource('usuarios', UserController::class);
        Route::put('usuarios/{id}/password', [UserController::class, 'updatePassword'])->name('usuarios.updatePassword');
    });

    // Portal del profesor: acceso de solo consulta a la información
    // académica que necesita un docente (no puede crear, editar ni borrar).
    Route::middleware('role:Profesor')->prefix('profesor')->name('profesor.')->group(function () {
        Route::get('dashboard', [ProfesorPanelController::class, 'dashboard'])->name('dashboard');

        Route::get('cursos', [ProfesorPanelController::class, 'cursos'])->name('cursos.index');
        Route::get('cursos/{curso}', [ProfesorPanelController::class, 'cursoShow'])->name('cursos.show');

        Route::get('estudiantes', [ProfesorPanelController::class, 'estudiantes'])->name('estudiantes.index');
        Route::get('estudiantes/{estudiante}', [ProfesorPanelController::class, 'estudianteShow'])->name('estudiantes.show');

        Route::get('asignaturas', [ProfesorPanelController::class, 'asignaturas'])->name('asignaturas.index');
        Route::get('asignaturas/{asignatura}', [ProfesorPanelController::class, 'asignaturaShow'])->name('asignaturas.show');

        Route::get('grados', [ProfesorPanelController::class, 'grados'])->name('grados.index');
        Route::get('grados/{grado}', [ProfesorPanelController::class, 'gradoShow'])->name('grados.show');

        Route::get('escalas', [ProfesorPanelController::class, 'escalas'])->name('escalas.index');
        Route::get('escalas/{escala}', [ProfesorPanelController::class, 'escalaShow'])->name('escalas.show');

        Route::get('indicadores', [ProfesorPanelController::class, 'indicadores'])->name('indicadores.index');
        Route::get('indicadores/{indicador}', [ProfesorPanelController::class, 'indicadorShow'])->name('indicadores.show');
    });
});