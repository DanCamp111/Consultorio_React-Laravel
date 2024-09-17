<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Doctor;
use App\Models\Especialidad;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Dompdf\Dompdf;
use Carbon\Carbon;

class DoctorController extends Controller
{
    public function index(Request $req)
    {
        if ($req->id) {
            $doctor = Doctor::with('user')->find($req->id);
        } else {
            $doctor = new Doctor();
        }

        $especialidades = Especialidad::all();
        return view('doctor', compact('doctor', 'especialidades'));
    }

    public function save(Request $req)
    {
        if ($req->id != 0) {
            $doctor = Doctor::find($req->id);
            $user = User::find($doctor->id_user);
        } else {
            $doctor = new Doctor();
            $user = new User();
            $user->password = Hash::make($req->password);
            $user->email = $req->email; // Solo crear password al crear usuario
            $user->rol = "doctor";
        }

        $user->name = $req->nombre . ' ' . $req->ap_paterno . ' ' . $req->ap_materno;
        $user->save();

        $doctor->nombre = $req->nombre;
        $doctor->ap_paterno = $req->ap_paterno;
        $doctor->ap_materno = $req->ap_materno;
        $doctor->cedula = $req->cedula;
        $doctor->telefono = $req->telefono;
        $doctor->id_especialidades = $req->especialidad;
        $doctor->id_user = $user->id;
        $doctor->save();

        return redirect()->route('list.doctor');
    }

    public function saveAPI(Request $req)
    {
        if ($req->id != 0) {
            $doctor = Doctor::find($req->id);
        } else {
            $doctor = new Doctor();
        }

        $doctor->nombre = $req->nombre;
        $doctor->ap_paterno = $req->ap_paterno;
        $doctor->ap_materno = $req->ap_materno;
        $doctor->cedula = $req->cedula;
        $doctor->telefono = $req->telefono;
        $doctor->id_especialidades = $req->especialidad;
        $doctor->save();

        return "OK";
    }

    public function list()
    {
        $doctores = Doctor::all();
        return view('doctores', compact('doctores'));
    }

    public function listAPI()
    {
        $doctores = Doctor::all();
        return $doctores;
    }

    public function delete(Request $req)
    {
        $doctor = Doctor::find($req->id);
        $doctor->delete();
        return redirect()->route('list.doctor');
    }

    public function deleteAPI(Request $req)
    {
        $doctor = Doctor::find($req->id);
        $doctor->delete();
        return "OK";
    }

    
    public function generateReceta($id)
    {
        $cita = Cita::with(['medicamentos', 'materiales', 'doctor', 'paciente'])->findOrFail($id);
        $doctor = $cita->doctor;
        $paciente = $cita->paciente;
        $observaciones = $cita->observaciones;
        $medicamentos = $cita->medicamentos;
        $materiales = $cita->materiales;
        $data = compact('cita', 'doctor', 'paciente', 'observaciones', 'medicamentos', 'materiales');
        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('pdf.receta', $data)->render());
        $dompdf->setPaper(array(0, 0, 583, 420)); // Dimensiones en puntos (1 pulgada = 72 puntos)
        $dompdf->render();
    
        // Obtener el nombre del paciente y la fecha para el nombre del archivo
        $nombrePaciente = str_replace(' ', '_', $paciente->nombre);
        $fecha = Carbon::parse($cita->fecha)->format('Ymd_His');
        $filename = 'receta_' . $nombrePaciente . '_' . $fecha . '.pdf';
    
        // Enviar el PDF al navegador
        return $dompdf->stream($filename, array("Attachment" => false));
    }
    
}
