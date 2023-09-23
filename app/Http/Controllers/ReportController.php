<?php

namespace App\Http\Controllers;

use App\Exports\Excelport;
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
        return view('admin.report.user');
    }

    public function exportUser()
    {
        return Excel::download(new Excelport, 'usuarios.xlsx');
    }
}
