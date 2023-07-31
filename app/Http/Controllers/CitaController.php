<?php

namespace App\Http\Controllers;

use App\Cita;
use App\Cupo;
use App\Especialidad;
use App\Http\Requests\Cita\StoreRequest;
use App\Http\Requests\Cita\UpdateRequest;
use App\Medico;
use App\Turno;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CitaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        Carbon::setLocale('es');
        $tipo = Auth::user()->tipo;
        $id = Auth::user()->id;
        if ($tipo == 'ADMIN') {
            Carbon::setLocale('es');
            $citas = Cita::get();
            foreach ($citas as $cita) {
                $cita->fecha_formateada = Carbon::createFromFormat('Y-m-d', $cita->FechaCita)->isoFormat('D [de] MMMM [de] YYYY');
            }
            return view('admin.cita.index', compact('citas'));
        }
        if ($tipo == 'MEDICO') {
            $turnos = Turno::where('user_id', $id)->get();
            $citas = [];

            foreach ($turnos as $turno) {
                $citasDeTurno = Cita::where('turno_id', $turno->id)->get();

                foreach ($citasDeTurno as $cita) {
                    $cita->fecha_formateada = Carbon::createFromFormat('Y-m-d', $cita->FechaCita)->isoFormat('D [de] MMMM [de] YYYY');
                    $citas[] = $cita;
                }
            }

            return view('admin.cita.index', compact('citas'));
        } else {
            $citas = Cita::where('user_id', $id)->get();
            foreach ($citas as $cita) {
                $cita->fecha_formateada = Carbon::createFromFormat('Y-m-d', $cita->FechaCita)->isoFormat('D [de] MMMM [de] YYYY');
            }
            return view('admin.cita.index', compact('citas'));
        }
    }


    public function create()
    {

        $turnos = Turno::get();
        $especialidades = Especialidad::get();
        $medico = User::where('tipo', 'MEDICO')
            ->get();;
        $cuposRegistrados = Cita::pluck('HoracIta')->toArray();
        $horasFaltantes = [];
        foreach ($turnos as $cupo) {
            $horasCadena = $cupo->horas;
            $horasArray = explode(', ', $horasCadena);
            $horasFaltantes = array_diff($horasArray, $cuposRegistrados);
        }

        return view('admin.cita.create', compact('turnos', 'especialidades', 'medico'));
    }


    public function storeCita(Request $request)
    {
        try {
            $idTurno = $request->input('id_turno');
            $fechaTurno = $request->input('fecha_turno');
            $horaSeleccionada = $request->input('hora_seleccionada');

            $cita = new Cita;
            $result = $cita->my_store($idTurno, $fechaTurno, $horaSeleccionada);
            if ($result) {
                return response()->json(['success' => true, 'redirect_url' => route('citas.index')]);
            } else {
                return response()->json(['success' => false, 'message' => 'Ocurrió un error al crear la cita']);
            }
        } catch (\Exception $th) {
            return response()->json(['success' => false, 'message' => 'Ocurrió un error al crear la cita']);
        }
    }


    public function show(Cita $cita)
    {
        return view('admin.cita.show', compact('cita'));
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
