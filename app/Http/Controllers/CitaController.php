<?php

namespace App\Http\Controllers;

use App\Cita;
use App\Especialidad;
use App\Mail\citaCreada;
use App\Turno;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CitaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        Carbon::setLocale('es');
        $tipo = Auth::user()->tipo;
        $id = Auth::user()->id;
        if ($tipo == 'ADMIN') {
            Carbon::setLocale('es');
            if (isset($request->filterFecha)) {
                $carbonFecha = Carbon::createFromFormat('Y-m-d', $request->filterFecha);
                $fechaFormateada = $carbonFecha->format('Y-m-d');
            }

            $fechaActual = Carbon::now()->format('Y-m-d');
            $citas = Cita::where('FechaCita', isset($fechaFormateada) ? $fechaFormateada : $fechaActual)->get();
            foreach ($citas as $cita) {
                $cita->fecha_formateada = Carbon::createFromFormat('Y-m-d', $cita->FechaCita)->isoFormat('D [de] MMMM [de] YYYY');
            }
            return view('admin.cita.index', compact('citas'));
        }
        if ($tipo == 'MEDICO') {
            $turnos = Turno::where('user_id', $id)->get();
            $citas = [];

            foreach ($turnos as $turno) {
                $citasDeTurno = Cita::where('turno_id', $turno->id)
                ->whereDate('FechaCita', '>=', Carbon::today()->format('Y-m-d'))
                ->get();
                foreach ($citasDeTurno as $cita) {
                    $cita->fecha_formateada = Carbon::createFromFormat('Y-m-d', $cita->FechaCita)->isoFormat('D [de] MMMM [de] YYYY');
                    $citas[] = $cita;
                }
            }

            return view('admin.cita.index', compact('citas'));
        } else {
            $citas = Cita::where('user_id', $id)
                ->whereDate('FechaCita', '>=', Carbon::today()->format('Y-m-d'))
                ->get();
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
        $medicos = User::where('tipo', 'MEDICO')
            ->get();
        $pacientes = User::where('tipo', 'PACIENTE')
            ->get();
        $cuposRegistrados = Cita::pluck('HoracIta')->toArray();
        $horasFaltantes = [];
        foreach ($turnos as $cupo) {
            $horasCadena = $cupo->horas;
            $horasArray = explode(', ', $horasCadena);
            $horasFaltantes = array_diff($horasArray, $cuposRegistrados);
        }

        return view('admin.cita.create', compact('turnos', 'especialidades', 'medicos', 'pacientes'));
    }


    public function storeCita(Request $request)
    {
        try {
            $idTurno = $request->input('id_turno');
            $fechaTurno = $request->input('fecha_turno');
            $horaSeleccionada = $request->input('hora_seleccionada');
            $idPaciente = $request->input('idPaciente');

            if (!$idPaciente) {
                $especialidad = Turno::where('id', $idTurno)->first();

                $validate = Cita::where('FechaCita', $fechaTurno)
                    ->where('HoraCita', $horaSeleccionada)
                    ->where('turno_id', $idTurno)
                    ->get();
    
                if ($validate->count() > 0) {
                    return response()->json(['success' => false, 'message' => 'Ya se tomó esta reserva']);
                }
    
                $validateFecha = Cita::where('user_id', Auth::user()->id)
                    ->where('especialidad_id', $especialidad->especialidad_id)
                    ->whereDate('FechaCita', '>=', Carbon::today()->format('Y-m-d'))
                    ->first();
    
    
                if ($validateFecha != null) {
                    $Fecha = Carbon::createFromFormat('Y-m-d', $validateFecha->FechaCita)->isoFormat('D [de] MMMM [de] YYYY');
                    return response()->json([
                        'success' => false, 'message' =>
                        'Sr(a) ' . $validateFecha->user->name . ' ' . $validateFecha->user->apellido .
                            ' ya tiene una cita asignada' . ' de '. $validateFecha->turno->user->especialidad->nombre . ' para el ' .
                            $Fecha . ' a las ' .
                            $validateFecha->HoraCita
                    ]);
                } 
    
                $cita = new Cita;
                $result = $cita->my_store($idTurno, $fechaTurno, $horaSeleccionada, $especialidad->especialidad_id, $idPaciente);
                if ($result) {
                    return response()->json(['success' => true, 'message' => 'Estado Actualizado', 'cita_id' => $result->id]);
                } else {
                    return response()->json(['success' => false, 'message' => 'Ocurrió un error al crear la cita']);
                }
            }else {
                $especialidad = Turno::where('id', $idTurno)->first();

                $validate = Cita::where('FechaCita', $fechaTurno)
                    ->where('HoraCita', $horaSeleccionada)
                    ->where('turno_id', $idTurno)
                    ->get();
    
                if ($validate->count() > 0) {
                    return response()->json(['success' => false, 'message' => 'Ya se tomó esta reserva']);
                }
    
                $validateFecha = Cita::where('user_id', $idPaciente)
                    ->where('especialidad_id', $especialidad->especialidad_id)
                    ->whereDate('FechaCita', '>=', Carbon::today()->format('Y-m-d'))
                    ->first();
    
    
                if ($validateFecha != null) {
                    $Fecha = Carbon::createFromFormat('Y-m-d', $validateFecha->FechaCita)->isoFormat('D [de] MMMM [de] YYYY');
                    return response()->json([
                        'success' => false, 'message' =>
                        'Sr(a) ' . $validateFecha->user->name . ' ' . $validateFecha->user->apellido .
                            ' ya tiene una cita asignada' . ' de '. $validateFecha->turno->user->especialidad->nombre . ' para el ' .
                            $Fecha . ' a las ' .
                            $validateFecha->HoraCita
                    ]);
                } 
    
                $cita = new Cita;
                $result = $cita->my_store($idTurno, $fechaTurno, $horaSeleccionada, $especialidad->especialidad_id, $idPaciente);
                if ($result) {
                    return response()->json(['success' => true, 'message' => 'Estado Actualizado', 'cita_id' => $result->id]);
                } else {
                    return response()->json(['success' => false, 'message' => 'Ocurrió un error al crear la cita']);
                }
            }

           
        } catch (\Exception $th) {
            return response()->json(['success' => false, 'message' => $th]);
        }
    }


    public function show(Cita $cita)
    {

        $cita->fecha_formateada = Carbon::createFromFormat('Y-m-d', $cita->FechaCita)->isoFormat('D [de] MMMM [de] YYYY');
        $citas_user = Cita::where('user_id', $cita->user_id)->get();

        return view('admin.cita.show', compact('cita', 'citas_user'));
    }





    public function destroy(Cita $cita)
    {
        try {
            $cita->delete();
            return redirect()->route('citas.index')->with('success', 'Cita cancelada');
        } catch (\Exception $th) {
            return redirect()->back()->with('error', 'Ocurrió un error al cancelar la cita');
        }
    }

    public function enviarCorreo(Request $request)
    {
        if ($request->ajax()) {
            $cita = Cita::where('id', $request->cita_id)->first();
            $emailPaciente = $cita->user->email;
            $nombrePaciente = $cita->user->name . " " . $cita->user->apellido;
            $FechaCita = $cita->FechaCita;
            $HoraCita = $cita->HoraCita;
            Mail::to($emailPaciente)->send(new citaCreada($nombrePaciente, $FechaCita, $HoraCita));
            return "Correo enviado correctamente.";
        }
    }


    public function createAdmin()
    {

        $turnos = Turno::get();
        $especialidades = Especialidad::get();
        $medicos = User::where('tipo', 'MEDICO')
            ->get();
        $pacientes = User::where('tipo', 'PACIENTE')
            ->get();
        $cuposRegistrados = Cita::pluck('HoracIta')->toArray();
        $horasFaltantes = [];
        foreach ($turnos as $cupo) {
            $horasCadena = $cupo->horas;
            $horasArray = explode(', ', $horasCadena);
            $horasFaltantes = array_diff($horasArray, $cuposRegistrados);
        }

        return view('admin.cita.createAdmin', compact('turnos', 'especialidades', 'medicos', 'pacientes'));
    }
}
