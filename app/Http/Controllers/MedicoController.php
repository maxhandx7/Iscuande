<?php

namespace App\Http\Controllers;

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
        return view('admin.medico.create');
    }


    public function store(StoreRequest $request, Medico $medico)
    {
        /* $validarCupo = Medico::where('id', $request->cupo_id)->first();
        dd($validarCupo->id);
        if ($validarCupo->medicos == 0) {
            return redirect()->back()->with('error', 'No hay medicos disponibles');
        } */
        try {
            $medico->my_store($request);
            return redirect()->route('medicos.index')->with('success', 'Medico credada con éxito');
        } catch (\Exception $th) {
            return redirect()->back()->with('error', 'Ocurrió un error al crear la medico');
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
            return redirect()->route('medicos.index')->with('success', 'Medico modificada');
        } catch (\Exception $th) {
            return redirect()->back()->with('error', 'Ocurrió un error al actualizar la medico');
        }
    }


    public function destroy(Medico $medico)
    {
        try {
            $medico->delete();
            return redirect()->route('medicos.index')->with('success', 'Medico eliminada');
        } catch (\Exception $th) {
            return redirect()->back()->with('error', 'Ocurrió un error al cancelar la medico');
        }
    }
}
