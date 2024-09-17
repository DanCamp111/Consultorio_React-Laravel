<?php

namespace App\Http\Controllers;

use App\Models\Medicamento;
use Illuminate\Http\Request;

class MedicamentoController extends Controller
{
    public function index(Request $req)
    {
        if($req->id)
        {
            $medicamento = Medicamento::find($req->id);
        }
        else
        {
            $medicamento = new Medicamento();
        }
        return view('medicamento', compact('medicamento'));
    }

    public function save(Request $req)
    {
        if($req->id != 0)
        {
            $medicamento = Medicamento::find($req->id);
        }
        else
        {
            $medicamento = new Medicamento();
        }

        $medicamento->codigo = $req->codigo;
        $medicamento->descripcion = $req->descripcion;
        $medicamento->precio = $req->precio;
        $medicamento->fecha_caducidad = $req->fecha_caducidad;
        $medicamento->existencias = $req->existencias;
        $medicamento->save();

        return redirect()->route('list.medicamento');
    }

    public function list()
    {
        $medicamentos = Medicamento::all(); 
        return view('medicamentos', compact('medicamentos'));
    }

    public function delete(Request $req)
    {
        $medicamento = Medicamento::find($req->id);
        $medicamento->delete();
        return redirect()->route('list.medicamento');
    }
}

