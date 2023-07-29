<?php

namespace App\Http\Controllers;

use App\Especialidad;
use App\Medico;
use App\Http\Requests\Medico\StoreRequest;
use App\Http\Requests\Medico\UpdateRequest;
use Illuminate\Http\Request;

class MedicoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $medicos = Medico::get();
        return view('admin.medico.index', compact('medicos'));
    }


    public function create()
    {
        $especialidades = Especialidad::get();
        return view('admin.medico.create', compact('especialidades'));
    }


    public function store(StoreRequest $request, Medico $medico)
    {
        try {
            $medico->my_store($request);
            return redirect()->route('medicos.index')->with('success', 'Medico credado con éxito');
        } catch (\Exception $th) {
            return redirect()->back()->with('error', 'Ocurrió un error al crear al medico');
        }
    }

    public function show(Medico $medico)
    {
        return view('admin.medico.show', compact('medico'));
    }


    public function edit(Medico $medico)
    {
        return view('admin.medico.edit', compact('medico'));
    }

    public function update(UpdateRequest $request, Medico $medico)
    {
        try {
            $medico->my_update($request);
            return redirect()->route('medicos.index')->with('success', 'Medico modificado');
        } catch (\Exception $th) {
            return redirect()->back()->with('error', 'Ocurrió un error al actualizar al medico');
        }
    }


    public function destroy(Medico $medico)
    {
        try {
            $medico->delete();
            return redirect()->route('medicos.index')->with('success', 'Medico eliminado');
        } catch (\Exception $th) {
            return redirect()->back()->with('error', 'Ocurrió un error al eliminar al medico');
        }
    }
}
