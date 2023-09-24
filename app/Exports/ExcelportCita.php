<?php

namespace App\Exports;

use App\Cita;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ExcelportCita implements FromCollection, WithHeadings, ShouldAutoSize
{
    private $fechaInicio;
    private $fechaFin;
    use Exportable;

    public function __construct($fechaInicio, $fechaFin)
    {
        $this->fechaInicio = $fechaInicio;
        $this->fechaFin = $fechaFin;
    }

    public function headings(): array
    {
        return [
            'Id',
            'Usuario',
            'Tipo documento',
            'Documento',
            'Telefono',
            'Correo',
            'Fecha',
            'Hora',
            'Medico',
            'Especialidad',
            'Descripcion',
            'Estado',
        ];
    }

    public function collection()
    {
        $citas = Cita::select('id', 'user_id', 'turno_id', 'especialidad_id', 'FechaCita', 'HoraCita', 'estado')
            ->whereBetween('FechaCita', [$this->fechaInicio, $this->fechaFin])->get();

        $resultadosProcesados = [];

        foreach ($citas as $cita) {
            $carbonFecha = Carbon::createFromFormat('Y-m-d', $cita->FechaCita);
            $cita->FechaCita = $carbonFecha->format('d-m-Y');
            $cita->usuario  = $cita->user->name . " " . $cita->user->apellido;
            $cita->tipo_documento  = $cita->user->tipo_documento;
            $cita->no_documento  = $cita->user->no_documento;
            $cita->telefono  = $cita->user->telefono;
            $cita->email  = $cita->user->email;
            $cita->medico  = $cita->turno->user->name . " " . $cita->turno->user->apellido;
            $cita->especialidad  = $cita->turno->user->especialidad->nombre;
            $cita->descripcion  = $cita->turno->descripcion;
            $resultadosProcesados[] = $cita;
        }

        $collections = collect($resultadosProcesados);
        $collections = $collections->map(function ($item) {
            return [
                'id' => $item->id,
                'usuario' => $item->usuario,
                'tipo_documento' => $item->tipo_documento,
                'no_documento' => $item->no_documento,
                'telefono' => $item->telefono,
                'email' => $item->email,
                'FechaCita' => $item->FechaCita,
                'HoraCita' => $item->HoraCita,
                'medico' => $item->medico,
                'especialidad' => $item->especialidad,
                'descripcion' => $item->descripcion,
                'estado' => $item->estado,
            ];
        });

        return $collections;
    }
}
