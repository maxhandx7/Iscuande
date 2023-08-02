<?php

namespace App\Http\Controllers;

use App\Cita;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $citasMes = DB::table('citas as c')
            ->selectRaw('MONTH(c.FechaCita) as mes')
            ->selectRaw('COUNT(*) as mtotal')
            ->selectRaw('(SELECT COUNT(*) FROM citas c2 WHERE c2.estado = "ACEPTADA" AND MONTH(c2.FechaCita) >= MONTH(c.FechaCita)) as totalmes')
            ->where('c.estado', '=', 'ACEPTADA')
            ->groupByRaw('MONTH(c.FechaCita), c.FechaCita')
            ->orderByRaw('MONTH(c.FechaCita) DESC')
            ->limit(12)
            ->get();
      
        $fechaEspecifica = Carbon::now()->format('Y-m-d');

        $totalCitasDia = Cita::selectRaw('DATE_FORMAT(FechaCita, "%d/%m/%Y") as dia')
        ->selectRaw('COUNT(*) as total_citas')
        ->where('estado', 'ACEPTADA')
        ->groupBy('FechaCita')
        ->orderBy('FechaCita', 'desc')
        ->get();


        $totalCitasAceptadas = DB::table('citas')
            ->where('estado', 'ACEPTADA')
            ->count();

        $totalCitasRechazadas = DB::table('citas')
            ->where('estado', 'RECHAZADA')
            ->count();

        $totalCitasPendientes = DB::table('citas')
            ->where('estado', 'PENDIENTE')
            ->count();


        return view('home', compact(
            'citasMes',
            'totalCitasDia',
            'totalCitasAceptadas',
            'totalCitasRechazadas',
            'totalCitasPendientes'
        ));
    }
}
