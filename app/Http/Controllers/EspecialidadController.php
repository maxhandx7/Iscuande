<?php

namespace App\Http\Controllers;

use App\Especialidad;
use App\Http\Requests\Medico\StoreRequest;
use App\Http\Requests\Medico\UpdateRequest;
use Illuminate\Http\Request;

class EspecialidadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $especialidads = Especialidad::get();
        return view('admin.especialidad.index', compact('especialidads'));
    }


    public function create()
    {
        return view('admin.especialidad.create');
    }


    public function store(StoreRequest $request, Especialidad $especialidad)
    {
        try {
            $especialidad->my_store($request);
            return redirect()->route('especialidads.index')->with('success', 'Especialidad creada con éxito');
        } catch (\Exception $th) {
            return redirect()->back()->with('error', 'Ocurrió un error al crear la especialidad');
        }
    }

    public function show(Especialidad $especialidad)
    {
        return view('admin.especialidad.show', compact('especialidad'));
    }


    public function edit(Especialidad $especialidad)
    {
        return view('admin.especialidad.edit', compact('especialidad'));
    }

    public function update(UpdateRequest $request, Especialidad $especialidad)
    {
        try {
            $especialidad->my_update($request);
            return redirect()->route('especialidads.index')->with('success', 'Especialidad modificada');
        } catch (\Exception $th) {
            return redirect()->back()->with('error', 'Ocurrió un error al actualizar la especialidad');
        }
    }


    public function destroy(Especialidad $especialidad)
    {
        try {
            $especialidad->delete();
            return redirect()->route('especialidads.index')->with('success', 'Especialidad eliminada');
        } catch (\Exception $th) {
            return redirect()->back()->with('error', 'Ocurrió un error al cancelar la especialidad');
        }
    }
}
