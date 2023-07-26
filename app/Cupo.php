<?php

namespace App;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Model;

class Cupo extends Model
{
    protected $fillable = [
        'medico_id',
        'fecha',
        'descripcion',
        'horas',
    ];

    public function medico()
    {
        return $this->belongsTo(Medico::class);
    }


    public function my_store($request)
    {
        $fecha = $this->formatear_fecha($request->fecha);
        $horas = $this->horas($request->inicio, $request->fin);
        self::create([
            'medico_id' => $request->medico_id,
            'fecha' => $fecha,
            'descripcion' => $request->descripcion,
            'horas' => $horas,
        ]);
    }

    public function my_update($request)
    {

        $this->update([
            'medico_id' => $request->medico_id,
            'fecha' => $request->fecha,
            'descripcion' => $request->descripcion,
            'horas' => $request->horas,
        ]);
    }


    public function horas($inicio, $fin)
    {


        $hora_objetoInicio = DateTime::createFromFormat('g:i A', $inicio);
        $Inicio = date_format($hora_objetoInicio, "G:i");

        $hora_objetoFin = DateTime::createFromFormat('g:i A', $fin);
        $Fin = date_format($hora_objetoFin, "G:i");

        $horas = [];
        $horaInicio = Carbon::createFromTime(
            intval(substr($Inicio, 0, 2)), 
            intval(substr($Inicio, 3, 2)) 
        ); 

        $horaFin = Carbon::createFromTime(
            intval(substr($Fin, 0, 2)), 
            intval(substr($Fin, 3, 2)) 
        ); 


        while ($horaInicio <= $horaFin) {
            $horas[] = $horaInicio->format('g:i A');
            $horaInicio->addMinutes(30); // Añadir 30 minutos
        }

        $array = $horas;
        $cadena = implode(', ', $array);

        return $cadena;
    }

    public function formatear_fecha($fecha)
    {
        $fecha_original = $fecha;
        $fecha_objeto = date_create($fecha_original);
        $fecha_formateada = date_format($fecha_objeto, "Y-m-d");

        return $fecha_formateada;
    }
}
