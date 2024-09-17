<?php

use App\Http\Controllers\CitaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\EspecialidadController;
use App\Http\Controllers\PacienteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('login',[LoginController::class,'login']);

Route::get('especialidades', [EspecialidadController::class,'listAPI']);
Route::get('especialidad/{id}', [EspecialidadController::class, 'showAPI']);
Route::post('especialidad/guardar', [EspecialidadController::class,'saveAPI']);
Route::post('especialidad/eliminar', [EspecialidadController::class,'deleteAPI']);

Route::get('doctores', [DoctorController::class,'listAPI']);
Route::post('doctor/guardar', [DoctorController::class,'saveAPI']);
Route::post('doctor/eliminar', [DoctorController::class,'deleteAPI']);

Route::post('pacientes/guardar',[PacienteController::class,'saveAPI']);
Route::get('pacientes/usuario/{userId}', [PacienteController::class,'getPacienteByUserId']);

Route::get('citas', [CitaController::class, 'listAPI']);
Route::post('citas/save', [CitaController::class, 'saveAPI']);
Route::post('citas/delete', [CitaController::class, 'deleteAPI']);
Route::get('citas/{id}', [CitaController::class, 'showAPI']);
Route::get('citas/paciente/{id_paciente}', [CitaController::class, 'listByPacienteAPI']);
