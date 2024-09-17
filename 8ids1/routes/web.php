<?php

use App\Http\Controllers\CitaController;
use App\Http\Controllers\ConsultorioController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\EspecialidadController;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\MedicamentoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
    
});


Route::get('/hola',[HelloController::class,'index'])->name('hello');
Route::get('/aviso',[HelloController::class,'aviso'])->name('aviso');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::get('especialidad/nueva', [EspecialidadController::class,'index'])->name('nueva.especialidad');
Route::get('especialidad/nueva', [EspecialidadController::class,'index'])->name('nueva.especialidad')->middleware('auth');
Route::post('especialidad/guardar' , [EspecialidadController::class,'save'])->name('guardar.especialidad')->middleware('auth');
Route::get('especialidad/list', [EspecialidadController::class,'list'])->name('list.especialidad')->middleware('auth');
Route::post('especialidad/borrar' , [EspecialidadController::class,'delete'])->name('borrar.especialidad')->middleware('auth');


Route::get('doctor/nueva', [DoctorController::class,'index'])->name('nueva.doctor')->middleware('auth');
Route::post('doctor/guardar' , [DoctorController::class,'save'])->name('guardar.doctor')->middleware('auth');
Route::get('doctor/list', [DoctorController::class,'list'])->name('list.doctor')->middleware('auth');
Route::post('doctor/borrar' , [DoctorController::class,'delete'])->name('borrar.doctor')->middleware('auth');
Route::get('doctor/citas', [CitaController::class, 'listByDoctor'])->name('doctor.citas')->middleware('auth');
Route::get('doctor/citas/{id}', [CitaController::class, 'show'])->name('doctor.citas.show')->middleware('auth');
Route::post('doctor/citas/{id}/medicamento', [CitaController::class, 'assignMedicamento'])->name('doctor.citas.assignMedicamento')->middleware('auth');
Route::post('doctor/citas/{id}/material', [CitaController::class, 'assignMaterial'])->name('doctor.citas.assignMaterial')->middleware('auth');
Route::get('doctor/citas/{id}/receta', [DoctorController::class, 'generateReceta'])->name('doctor.citas.receta')->middleware('auth');


Route::get('consultorio/nueva', [ConsultorioController::class,'index'])->name('nueva.consultorio')->middleware('auth');
Route::post('consultorio/guardar' , [ConsultorioController::class,'save'])->name('guardar.consultorio')->middleware('auth');
Route::get('consultorio/list', [ConsultorioController::class,'list'])->name('list.consultorio')->middleware('auth');
Route::post('consultorio/borrar' , [ConsultorioController::class,'delete'])->name('borrar.consultorio')->middleware('auth');

Route::get('paciente/nueva', [PacienteController::class,'index'])->name('nueva.paciente')->middleware('auth');
Route::post('paciente/guardar' , [PacienteController::class,'save'])->name('guardar.paciente')->middleware('auth');
Route::get('paciente/list', [PacienteController::class,'list'])->name('list.paciente')->middleware('auth');
Route::post('paciente/borrar' , [PacienteController::class,'delete'])->name('borrar.paciente')->middleware('auth');

Route::get('material/nuevo', [MaterialController::class, 'index'])->name('nueva.material')->middleware('auth');
Route::post('material/guardar', [MaterialController::class, 'save'])->name('guardar.material')->middleware('auth');
Route::get('material/lista', [MaterialController::class, 'list'])->name('list.material')->middleware('auth');
Route::post('material/borrar', [MaterialController::class, 'delete'])->name('borrar.material')->middleware('auth');

Route::get('medicamento/nuevo', [MedicamentoController::class, 'index'])->name('nueva.medicamento')->middleware('auth');
Route::post('medicamento/guardar', [MedicamentoController::class, 'save'])->name('guardar.medicamento')->middleware('auth');
Route::get('medicamento/lista', [MedicamentoController::class, 'list'])->name('list.medicamento')->middleware('auth');
Route::post('medicamento/borrar', [MedicamentoController::class, 'delete'])->name('borrar.medicamento')->middleware('auth');

Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index'])->name('ver.logs')->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::get('citas', [CitaController::class, 'list'])->name('list.citas');
    Route::post('cita/autorizar', [CitaController::class, 'authorizeCita'])->name('autorizar.cita');
    Route::post('cita/rechazar', [CitaController::class, 'rejectCita'])->name('rechazar.cita');
    Route::post('cita/asignar-doctor', [CitaController::class, 'assignDoctor'])->name('asignar.doctor');
    Route::post('citas/{id}/updateObservaciones', [CitaController::class, 'updateObservaciones'])->name('citas.updateObservaciones');
});
