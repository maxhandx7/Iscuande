<?php

namespace App\Http\Controllers;

use App\Cita;
use App\Turno;
use App\Http\Requests\Turno\StoreRequest;
use App\Http\Requests\Turno\UpdateRequest;
use App\Medico;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;


class TurnoController extends Controller
{
    public $hora;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $turnos = Turno::whereDate('fecha', '>=', Carbon::today()->format('Y-m-d'))
            ->get();


        foreach ($turnos as $turno) {
            $carbonFecha = Carbon::createFromFormat('Y-m-d', $turno->fecha);
            $turno->fecha = $carbonFecha->format('d-m-Y');
            $horasArray = explode(', ', $turno->horas);
            $primeraHora = reset($horasArray);
            $ultimaHora = end($horasArray);
            $horaCombinada = $primeraHora . " - " . $ultimaHora;
            $turno->horas = $horaCombinada;
            
        }   

        return view('admin.turno.index', compact('turnos'));
    }


    public function create()
    {
        $turnos = Turno::get();
        $medicos = User::where('tipo', 'MEDICO')->get();
        return view('admin.turno.create', compact('turnos', 'medicos'));
    }


    public function store(StoreRequest $request, Turno $turno)
    {
        if ($request->inicio == null) {
            return redirect()->route('turnos.create')->with('error', 'Hora inicio no puede quedar vacia');
        }
        if ($request->fin == null) {
            return redirect()->route('turnos.create')->with('error', 'Hora fin no puede quedar vacia');
        }
        if ($request->iCitas == null) {
            return redirect()->route('turnos.create')->with('error', 'Ingrese un valor valido en el intervalo');
        }
        try {
            $turno->my_store($request);
            return redirect()->route('turnos.index')->with('success', 'Turno credada con éxito');
        } catch (\Exception $th) {
            return redirect()->back()->with('error', 'Ocurrió un error al crear la turno');
        }
    }

    public function show(Turno $turno)
    {
        $citas = Cita::select('citas.id AS id', 'citas.FechaCita AS fecha', 'citas.HoraCita AS hora', 'citas.estado AS estado', 'users.name AS nombre', 'users.apellido AS apellido')
            ->join('users', 'citas.user_id', '=', 'users.id')
            ->where('citas.turno_id', $turno->id)
            ->where('users.tipo', 'PACIENTE')
            ->get();

            $horasArray = explode(', ', $turno->horas);
            $primeraHora = reset($horasArray);
            $ultimaHora = end($horasArray);
            $horaCombinada = $primeraHora . " - " . $ultimaHora;
            $turno->horas = $horaCombinada;
            
        return view('admin.turno.show', compact('turno', 'citas'));
    }


    public function edit(Turno $turno)
    {
        $medicos = User::where('tipo', 'MEDICO')->get();
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
