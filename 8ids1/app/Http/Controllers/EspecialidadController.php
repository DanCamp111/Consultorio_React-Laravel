<?php

namespace App\Http\Controllers;

use App\Models\Especialidad;
use Illuminate\Http\Request;

class EspecialidadController extends Controller
{
    public function index(Request $req)
    {
        if ($req->id) {
            $especialidad = Especialidad::find($req->id);
        } else {
            $especialidad = new Especialidad();
        }
        return view('especialidad', compact('especialidad'));
    }

    public function save(Request $req)
    {
        if ($req->id != 0) {
            $especialidad = Especialidad::find($req->id);
        } else {
            $especialidad = new Especialidad();
        }

        $especialidad->nombre = $req->nombre;
        $especialidad->estado = true;
        $especialidad->save();

        return redirect()->route('list.especialidad');
    }

    public function saveAPI(Request $req)
    {
        if ($req->id != 0) {
            $especialidad = Especialidad::find($req->id);
        } else {
            $especialidad = new Especialidad();
        }

        $especialidad->nombre = $req->nombre;
        $especialidad->estado = true;
        $especialidad->save();

        return "OK";
    }

    public function list()
    {
        $especialidades = Especialidad::all(); 
        return view('especialidades', compact('especialidades'));
    }

    public function listAPI()
    {
        $especialidades = Especialidad::all(); 
        return $especialidades;
    }

    public function delete(Request $req)
    {
        $especialidad = Especialidad::find($req->id);
        $especialidad->delete();
        return redirect()->route('list.especialidad');
    }

    public function deleteAPI(Request $req)
    {
        $especialidad = Especialidad::find($req->id);
        $especialidad->delete();
        return "OK";
    }

   
    public function showAPI($id)
    {
        $especialidad = Especialidad::find($id);
        if ($especialidad) {
            return response()->json($especialidad);
        } else {
            return response()->json(['error' => 'Especialidad no encontrada'], 404);
        }
    }
}
