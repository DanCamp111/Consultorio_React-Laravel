<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index(Request $req)
    {
        if($req->id)
        {
            $material = Material::find($req->id);
        }
        else
        {
            $material = new Material();
        }
        return view('material', compact('material'));
    }

    public function save(Request $req)
    {
        if($req->id != 0)
        {
            $material = Material::find($req->id);
        }
        else
        {
            $material = new Material();
        }

        $material->codigo = $req->codigo;
        $material->descripcion = $req->descripcion;
        $material->precio = $req->precio;
        $material->fecha_caducidad = $req->fecha_caducidad;
        $material->existencia = $req->existencia;
        $material->save();

        return redirect()->route('list.material');
    }

    public function list()
    {
        $materiales = Material::all(); 
        return view('materiales', compact('materiales'));
    }

    public function delete(Request $req)
    {
        $material = Material::find($req->id);
        $material->delete();
        return redirect()->route('list.material');
    }
}
