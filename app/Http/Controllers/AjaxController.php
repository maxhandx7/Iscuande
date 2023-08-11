<?php

namespace App\Http\Controllers;

use App\Cita;
use App\Mail\MiCorreo;
use App\Turno;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AjaxController extends Controller
{
    public function getTurnos(Request $request)
    {
        if ($request->ajax()) {
            $fecha_objeto = date_create_from_format('m/d/Y', $request->fecha);

            if ($fecha_objeto) {
                $fecha_formateada = date_format($fecha_objeto, 'Y-m-d');
                $fechas = Turno::where('fecha', $fecha_formateada)
                    ->where('especialidad_id', $request->especialidad)
                    ->get();

                if (count($fechas) == 0) {
                    return false;
                }
                $data = array(); // Nuevo array para almacenar la información
                foreach ($fechas as $fecha) {
                    $medicos = User::where('id', $fecha->user_id)
                        ->where('tipo', 'MEDICO')
                        ->get();
                    foreach ($medicos as $medico) {
                        $fecha->medico = $medico->name . " " . $medico->apellido;
                    }
                    $data[] = $fecha;
                }
                return response()->json([
                    'data' => $data,
                ]);
            } else {
                return false;
            }
        }
    }

    public function getHorario(Request $request)
    {
        if ($request->ajax()) {
            $turnos = Turno::where('id', $request->idTurno)
                ->get();
            foreach ($turnos as $turno) {
                $citas = Cita::get();
                for ($i = 0; $i < count($citas); $i++) {
                    $cuposRegistrados =  Cita::where('turno_id', $turno->id)
                        ->pluck('HoracIta')->toArray();
                }
            }
            return response()->json([
                'data' => $turnos,
                'cuposRegistrados' => isset($cuposRegistrados) ? $cuposRegistrados : "",
            ]);
        }
    }



    public function updateStatus(Request $request)
    {
        if ($request->ajax()) {
            $cita = new Cita;
            $result = $cita->my_update($request->id, $request->estado);
            if ($result) {
                $this->enviarCorreo($request->id);
                return response()->json(['success' => true, 'message' => 'Estado Actualizado']);
            } else {
                return response()->json(['success' => false, 'message' => 'Ocurrio un error al actualizar estadoo']);
            }
        }
    }

    public function enviarCorreo($id)
    {
        $cita = Cita::where('id', $id)->first();
        $emailPaciente = $cita->user->email;
        $nombrePaciente = $cita->user->name." ".$cita->user->apellido;
        $estado = $cita->estado;
        Mail::to($emailPaciente)->send(new MiCorreo($nombrePaciente, $estado));

        return "Correo enviado correctamente.";
    }
}
