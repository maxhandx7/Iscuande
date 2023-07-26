<?php

namespace App\Http\Controllers;

use App\Cita;
use App\Cupo;
use App\Http\Requests\Cita\StoreRequest;
use App\Http\Requests\Cita\UpdateRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CitaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $tipo = Auth::user()->tipo;
        $id = Auth::user()->id;
        if ($tipo == 'ADMIN') {
            Carbon::setLocale('es');
            $citas = Cita::get();
            foreach ($citas as $cita) {
                $cita->fecha_formateada = Carbon::createFromFormat('Y-m-d', $cita->FechaCita)->format('d \d\e F \d\e Y');
            }
            return view('admin.cita.index', compact('citas'));
        } else {
            Carbon::setLocale('es');
            $citas = Cita::where('user_id', $id)->get();
            foreach ($citas as $cita) {
                $cita->fecha_formateada = Carbon::createFromFormat('Y-m-d', $cita->FechaCita)->format('d \d\e F \d\e Y');
            }
            return view('admin.cita.index', compact('citas'));
        }
    }


    public function create()
    {
        $cupos = Cupo::get();
        $cuposRegistrados = Cita::pluck('HoracIta')->toArray();
        $horasFaltantes = [];
        foreach ($cupos as $cupo) {
            $horasCadena = $cupo->horas;
            $horasArray = explode(', ', $horasCadena);
            $horasFaltantes = array_diff($horasArray, $cuposRegistrados);
        }

        return view('admin.cita.create', compact('cupos', 'horasFaltantes'));
    }


    public function store(StoreRequest $request, Cita $cita)
    {
        /* $validarCupo = Cupo::where('id', $request->cupo_id)->first();
        dd($validarCupo->id);
        if ($validarCupo->cupos == 0) {
            return redirect()->back()->with('error', 'No hay cupos disponibles');
        } */
        try {
            $cita->my_store($request);
            return redirect()->route('citas.index')->with('success', 'Cita credada con éxito');
        } catch (\Exception $th) {
            return redirect()->back()->with('error', 'Ocurrió un error al crear la cita');
        }
    }

    public function show(Cita $cita)
    {
        return view('admin.cita.show', compact('cita'));
    }


    public function edit(Cita $cita)
    {
        $cupos = Cupo::get();
        $cuposRegistrados = Cita::pluck('HoracIta')->toArray();
        foreach ($cupos as $cupo) {
            $horasCadena = $cupo->horas;
            $horasArray = explode(', ', $horasCadena);
            $horasFaltantes = array_diff($horasArray, $cuposRegistrados);
        }

        return view('admin.cita.edit', compact('cita', 'cupos', 'horasFaltantes'));
    }

    public function update(UpdateRequest $request, Cita $cita)
    {
        try {
            $cita->my_update($request);
            return redirect()->route('citas.index')->with('success', 'Cita modificada');
        } catch (\Exception $th) {
            return redirect()->back()->with('error', 'Ocurrió un error al actualizar la cita');
        }
    }


    public function destroy(Cita $cita)
    {
        try {
            $cita->delete();
            return redirect()->route('citas.index')->with('success', 'Cita eliminada');
        } catch (\Exception $th) {
            return redirect()->back()->with('error', 'Ocurrió un error al cancelar la cita');
        }
    }
}
