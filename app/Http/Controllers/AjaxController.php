<?php

namespace App\Http\Controllers;

use App\Medico;
use App\Turno;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function getTurnos(Request $request)
    {
        if ($request->ajax()) {
            $fecha_objeto = date_create_from_format('m/d/Y', $request->fecha);

            if ($fecha_objeto) {
                $fecha_formateada = date_format($fecha_objeto, 'Y-m-d');
                $fechas = Turno::where('fecha', $fecha_formateada)->get();
                foreach ($fechas as $fecha) {
                    $medico = Medico::where('id', $fecha->medico_id)->get();
                    var_dump($medico);
                    
                }
                die;
                return response()->json($fecha);
            } else {
                return false;
            }
        }
    }
}
