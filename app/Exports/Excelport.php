<?php

namespace App\Exports;

use App\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class Excelport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    private $tipo;
    private $especialidad;

    use Exportable;

    public function __construct($tipo, $especialidad)
    {
        $this->tipo = $tipo;
        $this->especialidad = $especialidad;
    }

    public function headings(): array
    {
        return [
            'Id',
            'Especialidad',
            'Nombre',
            'Apellido',
            'Tipo documento',
            'Documento',
            'Telefono',
            'Email',
            'Tipo de usuario',
            'Estado',
        ];
    }


    public function collection()
    {
        if ($this->especialidad != "all") {
            $this->especialidad = intval($this->especialidad);
        }

        if ($this->tipo == "all") {
            $users = DB::table('users as a')
                ->leftJoin('especialidads as b', 'a.id', '=', 'b.id')
                ->select('a.id', 'b.nombre as especialidad_name', 'a.name', 'a.apellido', 'a.tipo_documento', 'a.no_documento', 'a.telefono', 'a.email', 'a.tipo', 'a.estado')
                ->get();
            return $users;
        }

        if ($this->tipo == "MEDICO" && $this->especialidad == "all") {
            $users = DB::table('users as a')
                ->leftJoin('especialidads as b', 'a.id', '=', 'b.id')
                ->select('a.id', 'b.nombre as especialidad_name', 'a.name', 'a.apellido', 'a.tipo_documento', 'a.no_documento', 'a.telefono', 'a.email', 'a.tipo', 'a.estado')
                ->where('a.tipo', '=', 'MEDICO')
                ->get();
            return $users;
        }

        if ($this->tipo == "MEDICO" && is_int($this->especialidad)) {   
            $users = DB::table('users as a')
                ->leftJoin('especialidads as b', 'a.especialidad_id', '=', 'b.id')
                ->select('b.id', 'b.nombre as especialidad_name', 'a.name', 'a.apellido', 'a.tipo_documento', 'a.no_documento', 'a.telefono', 'a.email', 'a.tipo', 'a.estado')
                ->where('a.tipo', '=', 'MEDICO')
                ->where('a.especialidad_id', '=', $this->especialidad)
                ->get();
            return $users;
        }

        if ($this->tipo == "PACIENTE") {
            $users = DB::table('users as a')
                ->leftJoin('especialidads as b', 'a.id', '=', 'b.id')
                ->select('a.id', 'b.nombre as especialidad_name', 'a.name', 'a.apellido', 'a.tipo_documento', 'a.no_documento', 'a.telefono', 'a.email', 'a.tipo', 'a.estado')
                ->where('a.tipo', '=', 'PACIENTE')
                ->get();
            return $users;
        }
    }
}
