<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PacienteController extends Controller
{
    public function index(Request $req)
    {
        if ($req->id) {
            $paciente = Paciente::find($req->id);
        } else {
            $paciente = new Paciente();
        }
        return view('paciente', compact('paciente'));
    }

    public function save(Request $req)
    {
        if ($req->id != 0) {
            $paciente = Paciente::find($req->id);
        } else {
            $paciente = new  Paciente();
        }

        $paciente->nombre = $req->nombre;
        $paciente->ap_paterno = $req->ap_paterno;
        $paciente->ap_materno = $req->ap_materno;
        $paciente->telefono = $req->telefono;
        $paciente->save();

        return redirect()->route('list.paciente');
    }
    public function list()
    {
        $pacientes = Paciente::all();
        return view('pacientes', compact('pacientes'));
    }
    public function delete(Request $req)
    {
        $paciente = Paciente::find($req->id);
        $paciente->delete();
        return redirect()->route('list.paciente');
    }

    public function saveAPI(Request $req)
    {
         $user = new User();
        $paciente = new  Paciente();
            
        $user->name = $req->nombre .''. $req->ap_paterno . '' . $req->ap_materno;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->rol ="paciente";
        $user->save();
        $paciente->nombre = $req->nombre;
        $paciente->ap_paterno = $req->ap_paterno;
        $paciente->ap_materno = $req->ap_materno;
        $paciente->telefono = $req->telefono;
        $paciente->id_user = $user->id;
        $paciente->save();

        return "OK";
    }

    public function getPacienteByUserId($userId)
    {
        $paciente = Paciente::where('id_user', $userId)->first();
        if ($paciente) {
            return response()->json($paciente);
        } else {
            return response()->json(['error' => 'Paciente no encontrado'], 404);
        }
    }
}
