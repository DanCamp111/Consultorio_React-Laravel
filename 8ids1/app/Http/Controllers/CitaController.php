<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Consultorio;
use App\Models\Doctor; // Asegúrate de importar el modelo Doctor
use App\Models\Material;
use App\Models\MaterialesUsados;
use App\Models\Medicamento;
use App\Models\MedicamentoRecetado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CitaController extends Controller
{
    public function index(Request $req)
    {
        $citas = $req->id_paciente ?
            Cita::where('id_paciente', $req->id_paciente)
            ->with(['especialidad', 'paciente', 'doctor'])
            ->orderBy('id')
            ->get() :
            Cita::with(['especialidad', 'paciente', 'doctor'])
            ->orderBy('id')
            ->get();

        $doctores = Doctor::all(); // Obtener todos los doctores

        return view('citas', compact('citas', 'doctores'));
    }

    // Guardar una cita
    public function save(Request $req)
    {
        $cita = $req->id != 0 ? Cita::find($req->id) : new Cita();

        $cita->fill($req->all());
        $cita->save();

        return redirect()->route('list.citas');
    }

    // Guardar una cita (API)
    public function saveAPI(Request $req)
    {
        $cita = $req->id != 0 ? Cita::find($req->id) : new Cita();

        $cita->fill($req->all());
        $cita->save();

        return response()->json($cita);
    }

    // Listar todas las citas
    public function list()
    {
        $citas = Cita::with(['especialidad', 'consultorio'])
            ->orderBy('id')
            ->get();
        $doctores = Doctor::all();
        $consultorios = Consultorio::all();
        return view('citas', compact('citas', 'doctores', 'consultorios'));
    }


    // Listar todas las citas (API)
    public function listAPI()
    {
        $citas = Cita::with(['especialidad', 'paciente', 'doctor'])
            ->orderBy('id')
            ->get();
        return response()->json($citas);
    }

    // Listar citas por paciente (web)
    public function listByPaciente(Request $req)
    {
        $citas = Cita::where('id_paciente', $req->id_paciente)
            ->with(['especialidad', 'paciente', 'doctor'])
            ->orderBy('id')
            ->get();
        $doctores = Doctor::all(); // Obtener todos los doctores
        return view('citas', compact('citas', 'doctores'));
    }

    // Listar citas por paciente (API)
    public function listByPacienteAPI($id_paciente)
    {
        $citas = Cita::where('id_paciente', $id_paciente)
            ->with(['especialidad', 'paciente', 'doctor'])
            ->orderBy('id')
            ->get();
        return response()->json($citas);
    }

    // Eliminar una cita
    public function delete(Request $req)
    {
        $cita = Cita::find($req->id);
        $cita->delete();
        return redirect()->route('list.citas');
    }

    // Eliminar una cita (API)
    public function deleteAPI(Request $req)
    {
        $cita = Cita::find($req->id);
        $cita->delete();
        return response()->json(['message' => 'Deleted']);
    }
    public function show($id)
    {
        $cita = Cita::with(['paciente', 'doctor'])->findOrFail($id);
        $medicamentos = Medicamento::all();
        $materiales = Material::all();

        return view('cita_detalles', compact('cita', 'medicamentos', 'materiales'));
    }

    // Mostrar una cita específica (API)
    public function showAPI($id)
    {
        $cita = Cita::with(['especialidad', 'paciente', 'doctor'])->find($id);
        if ($cita) {
            return response()->json($cita);
        } else {
            return response()->json(['error' => 'Cita no encontrada'], 404);
        }
    }

    public function authorizeCita(Request $req)
    {
        $cita = Cita::find($req->id);
        $cita->estado = 'aprobada';
        $cita->save();

        return redirect()->route('list.citas');
    }

    // Rechazar una cita
    public function rejectCita(Request $req)
    {
        $cita = Cita::find($req->id);
        $cita->estado = 'rechazada';
        $cita->save();

        return redirect()->route('list.citas');
    }

    // Asignar un doctor a una cita
    public function assignDoctor(Request $req)
    {
        $cita = Cita::find($req->id);
        $cita->id_doctor = $req->id_doctor;
        $cita->save();

        return redirect()->route('list.citas');
    }

    // Obtener doctores por especialidad para una cita específica
    public function getDoctoresByEspecialidad($id_cita)
    {
        $cita = Cita::with('especialidad')->find($id_cita);
        $doctores = Doctor::where('id_especialidades', $cita->id_especialidades)->get();
        return response()->json($doctores);
    }

    public function listByDoctor()
    {
        $user = Auth::user();

        // Obtener el doctor asociado al usuario autenticado
        $doctor = Doctor::where('id_user', $user->id)->first();

        if ($doctor) {
            $doctorId = $doctor->id;

            $citas = Cita::where('id_doctor', $doctorId)
                ->with(['especialidad', 'paciente', 'doctor'])
                ->orderBy('id')
                ->get();

            return view('citas_por_doctor', compact('citas', 'doctor'));
        } else {
            // Redirigir o mostrar un mensaje de error si el usuario no es un doctor
            return redirect()->route('home')->with('error', 'No tiene permisos para ver esta página.');
        }
    }

    public function assignMedicamento(Request $request, $id)
    {
        $request->validate([
            'id_medicamento' => 'required|exists:medicamentos,id',
            'cantidad' => 'required',
            'unidad' => 'required',
            'cada_cuanto' => 'required',
            'dias' => 'required',
        ]);

        MedicamentoRecetado::create([
            'id_cita' => $id,
            'id_medicamento' => $request->id_medicamento,
            'cantidad' => $request->cantidad,
            'unidad' => $request->unidad,
            'cada_cuanto' => $request->cada_cuanto,
            'dias' => $request->dias,
        ]);

        return redirect()->route('doctor.citas.show', $id)->with('success', 'Medicamento asignado correctamente.');
    }

    public function assignMaterial(Request $request, $id)
    {
        $request->validate([
            'id_material' => 'required|exists:materiales,id',
            'cantidad' => 'required',
            'unidad' => 'required',
        ]);

        MaterialesUsados::create([
            'id_cita' => $id,
            'id_material' => $request->id_material,
            'cantidad' => $request->cantidad,
            'unidad' => $request->unidad,
        ]);

        return redirect()->route('doctor.citas.show', $id)->with('success', 'Material asignado correctamente.');
    }

    public function updateObservaciones(Request $req, $id)
    {
        $cita = Cita::find($id);
        $cita->observaciones = $req->observaciones;
        $cita->save();

        return redirect()->route('doctor.citas.show', $id)->with('success', 'Observaciones actualizadas correctamente.');
    }
}
