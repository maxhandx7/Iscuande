<?php

namespace App\Exports;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ExcelportTurno implements FromCollection, WithHeadings, ShouldAutoSize
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
            'Nombre medico',
            'Apellido medico',
            'Especialidad',
            'fecha',
            'descripcion',
            'Horas',
        ];
    }

    public function collection()
    {
        $resultado = DB::table('turnos as a')
            ->select('a.id', 'b.name', 'b.apellido', 'c.nombre', 'a.fecha', 'a.descripcion', 'a.horas')
            ->join('users as b', 'a.user_id', '=', 'b.id')
            ->join('especialidads as c', 'b.especialidad_id', '=', 'c.id')
            ->whereBetween('a.fecha', [$this->fechaInicio, $this->fechaFin])
            ->get();

        $resultadosProcesados = [];

        foreach ($resultado as $turno) {
            $carbonFecha = Carbon::createFromFormat('Y-m-d', $turno->fecha);
            $turno->fecha = $carbonFecha->format('d-m-Y');
            $horasArray = explode(', ', $turno->horas);
            $primeraHora = reset($horasArray);
            $ultimaHora = end($horasArray);
            $horaCombinada = $primeraHora . " - " . $ultimaHora;
            $turno->horas = $horaCombinada;
            $resultadosProcesados[] = $turno;
        }

        return collect($resultadosProcesados);
    }
}
