<?php

namespace App\Http\Controllers;

use App\Especialidad;
use App\Exports\Excelport;
use App\User;
use Illuminate\Http\Request;
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

    public function exportUser(Request $request)
    {
        return Excel::download(new Excelport($request->tipo, $request->especialidad_id), 'Reporte_usuarios.xlsx');
    }
}
