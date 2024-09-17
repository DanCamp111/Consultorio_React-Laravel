<?php

namespace App\Http\Controllers;

use App\Models\Consultorio;
use Illuminate\Http\Request;

class ConsultorioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $req)
    {
        if($req->id)
        {
            $consultorio = Consultorio::find($req->id);
        }
        else
        {
            $consultorio = new Consultorio();
        }
        return view('consultorio', compact('consultorio'));
    }

    public function save(Request $req)
    {
        if($req->id !=0)
        {
            $consultorio=Consultorio::find($req->id);
        }
        else
        {
            $consultorio= new  Consultorio();
        }

        $consultorio->numero = $req->numero;
        $consultorio->save();

        return redirect()->route('list.consultorio');
    }
    public function list()
    {
        $consultorios = Consultorio::all(); 
        return view('consultorios',compact('consultorios'));
    }
    public function delete(Request $req)
    {
        $consultorio = Consultorio::find($req->id);
        $consultorio->delete();
        return redirect()->route('list.consultorio');
    }
}
