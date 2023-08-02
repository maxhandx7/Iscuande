<?php

namespace App\Http\Controllers;

use App\Cita;
use App\Turno;
use App\User;
use Illuminate\Http\Request;

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

                $citas = Cita::get();
                for ($i = 0; $i < count($citas); $i++) {
                    $cuposRegistrados =  Cita::where('id', $citas[$i]->id)->pluck('HoracIta')->toArray();
                }
                
                $data = array(); // Nuevo array para almacenar la información
                foreach ($fechas as $fecha) {
                    $medicos = User::where('id', $fecha->user_id)
                    ->where('tipo', 'MEDICO')
                    ->get();
                    foreach ($medicos as $medico) {
                        $fecha->medico = $medico->name." " .$medico->apellido;
                    }
                    $data[] = $fecha; 
                }

            
                return response()->json([
                    'data' => $data,
                    'cuposRegistrados' => isset($cuposRegistrados) ? $cuposRegistrados : "",
                ]);
            } else {
                return false;
            }
        }
    }



    public function updateStatus(Request $request)
    {
        if ($request->ajax()) {
            $cita = new Cita;
            $result = $cita->my_update($request->id, $request->estado);
            if ($result) {
                return response()->json(['success' => true, 'message' => 'Estado Actualizado']);
            } else {
                return response()->json(['success' => false, 'message' => 'Ocurrio un error al actualizar estadoo']);
            }
        }
    }
}
