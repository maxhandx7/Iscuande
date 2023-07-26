<?php

namespace App\Http\Controllers;

use App\Cupo;
use App\Http\Requests\Cupo\StoreRequest;
use App\Http\Requests\Cupo\UpdateRequest;
use App\Medico;
use Carbon\Carbon;

class CupoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $cupos = Cupo::get();
        

        return view('admin.cupo.index', compact('cupos'));
    }


    public function create()
    {
        $cupos = Cupo::get();
        $medicos = Medico::get();
        return view('admin.cupo.create', compact('cupos', 'medicos'));
    }


    public function store(StoreRequest $request, Cupo $cupo)
    {
        try {
            $cupo->my_store($request);
            return redirect()->route('cupos.index')->with('success', 'Turno credada con éxito');
        } catch (\Exception $th) {
            return redirect()->back()->with('error', 'Ocurrió un error al crear la turno');
        }
    }

    public function show(Cupo $cupo)
    {
        return view('admin.cupo.show', compact('cupo'));
    }


    public function edit(Cupo $cupo)
    {
        $medicos = Medico::get();
        return view('admin.cupo.edit', compact('cupo', 'medicos'));
    }

    public function update(UpdateRequest $request, Cupo $cupo)
    {
        try {
            $cupo->my_update($request);
            return redirect()->route('cupos.index')->with('success', 'Turno modificado');
        } catch (\Exception $th) {
            return redirect()->back()->with('error', 'Ocurrió un error al actualizar la turno');
        }
    }


    public function destroy(Cupo $cupo)
    {
        try {
            $cupo->delete();
            return redirect()->route('cupos.index')->with('success', 'Turno eliminado');
        } catch (\Exception $th) {
            return redirect()->back()->with('error', 'Ocurrió un error al cancelar la turno');
        }
    }
}
