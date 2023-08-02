<?php

namespace App;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
    protected $fillable = [
        'user_id',
        'especialidad_id',
        'fecha',
        'descripcion',
        'horas',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function my_store($request)
    {
        $fecha = $this->formatear_fecha($request->fecha);
        $horas = $this->horas($request->inicio, $request->fin, $request->iCitas);
        $especialidad = User::where('id', $request->medico_id)->first();
        self::create([
            'user_id' => $request->medico_id,
            'especialidad_id' => $especialidad->especialidad_id,
            'fecha' => $fecha,
            'descripcion' => $request->descripcion,
            'horas' => $horas,
        ]);
    }

    public function my_update($request)
    {
       
        $especialidad = User::where('id', $request->medico_id)->first();

        
        $this->update([
            'user_id' => $request->medico_id,
            'especialidad_id' => $especialidad->especialidad_id,
            'descripcion' => $request->descripcion,
        ]);
    }


    public function horas($inicio, $fin, $mcitas)
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
            $horaInicio->addMinutes($mcitas); 
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
