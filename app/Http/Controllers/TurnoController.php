<?php

namespace App\Http\Controllers;

use App\Turno;
use App\Http\Requests\Cupo\StoreRequest;
use App\Http\Requests\Cupo\UpdateRequest;
use App\Medico;
use Illuminate\Http\Request;

class TurnoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $turnos = Turno::get();
        

        return view('admin.turno.index', compact('turnos'));
    }


    public function create()
    {
        $turnos = Turno::get();
        $medicos = Medico::get();
        return view('admin.turno.create', compact('turnos', 'medicos'));
    }


    public function store(StoreRequest $request, Turno $turno)
    {
        try {
            $turno->my_store($request);
            return redirect()->route('turnos.index')->with('success', 'Turno credada con éxito');
        } catch (\Exception $th) {
            return redirect()->back()->with('error', 'Ocurrió un error al crear la turno');
        }
    }

    public function show(Turno $turno)
    {
        return view('admin.turno.show', compact('turno'));
    }


    public function edit(Turno $turno)
    {
        $medicos = Medico::get();
        return view('admin.turno.edit', compact('turno', 'medicos'));
    }

    public function update(UpdateRequest $request, Turno $turno)
    {
        try {
            $turno->my_update($request);
            return redirect()->route('turnos.index')->with('success', 'Turno modificado');
        } catch (\Exception $th) {
            return redirect()->back()->with('error', 'Ocurrió un error al actualizar la turno');
        }
    }


    public function destroy(Turno $turno)
    {
        try {
            $turno->delete();
            return redirect()->route('turnos.index')->with('success', 'Turno eliminado');
        } catch (\Exception $th) {
            return redirect()->back()->with('error', 'Ocurrió un error al cancelar la turno');
        }
    }
}
