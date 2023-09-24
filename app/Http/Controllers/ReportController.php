<?php

namespace App\Http\Controllers;

use App\Especialidad;
use App\Exports\ExcelportCita;
use App\Exports\ExcelportTurno;
use App\Exports\ExcelportUser;
use App\Turno;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $this->authorize('admin-only');
        return view('admin.report.index');
    }

    public function user()
    {
        $this->authorize('admin-only');
        $users = User::get();
        $especialidades = Especialidad::get();
        return view('admin.report.user', compact('users', 'especialidades'));
    }

    public function turno()
    {
        $this->authorize('admin-only');
        $turnos = Turno::get();
        $users = User::get();
        return view('admin.report.turno', compact('turnos', 'users'));
    }

    public function cita()
    {
        $this->authorize('admin-only');
        $users = User::get();
        $especialidades = Especialidad::get();
        return view('admin.report.cita', compact('users', 'especialidades'));
    }

    public function exportUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tipo' => 'required'
        ]);

        if ($validator->fails()) {
                return redirect()->route('reports.user')->with('error', 'Ingrese los datos de busqueda ')
                ->withErrors($validator)
                ->withInput();
        }

        return Excel::download(new ExcelportUser($request->tipo, $request->especialidad_id), 'Reporte_usuarios.xlsx');
    }

    public function exportTurno(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fechaInicio' => 'required',
            'fechaFin' => 'required',
        ]);

        if ($validator->fails()) {
                return redirect()->route('reports.turno')->with('error', 'Ingrese los datos de busqueda ')
                ->withErrors($validator)
                ->withInput();
        }

        return Excel::download(new ExcelportTurno($request->fechaInicio, $request->fechaFin), 'Reporte_turnos.xlsx');
    }

    public function exportCita(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fechaInicio' => 'required',
            'fechaFin' => 'required',
        ]);

        if ($validator->fails()) {
                return redirect()->route('reports.cita')->with('error', 'Ingrese los datos de busqueda ')
                ->withErrors($validator)
                ->withInput();
        }
        return Excel::download(new ExcelportCita($request->fechaInicio, $request->fechaFin), 'Reporte_citas.xlsx');
    }
}
