<?php

namespace App\Http\Controllers;

use App\Cita;
use App\User;
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
            ->selectRaw('DATE_FORMAT(c.FechaCita, "%Y-%d-%m") as mes')
            ->selectRaw('COUNT(*) as mtotal')
            ->selectRaw('(SELECT COUNT(*) FROM citas c2 WHERE c2.estado = "ACEPTADA" AND DATE_FORMAT(c2.FechaCita, "%Y-%m") >= DATE_FORMAT(c.FechaCita, "%Y-%m")) as totalmes')
            ->where('c.estado', '=', 'ACEPTADA')
            ->groupByRaw('DATE_FORMAT(c.FechaCita, "%Y-%d-%m"), c.FechaCita')
            ->orderByRaw('DATE_FORMAT(c.FechaCita, "%Y-%d-%m") DESC')
            ->limit(12)
            ->get();

        foreach ($citasMes as  $mes) {
            $partes = explode("-", $mes->mes);
            $mes->mes = $partes[1];
        }

        

        $totalCitasDia = Cita::selectRaw('DATE_FORMAT(FechaCita, "%m/%d/%Y") as dia')
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

        $medicosMasAtendidos = User::select('users.id', 'users.name', 'users.apellido')
            ->withCount(['turno as cita_count' => function ($query) {
                $query->join('citas', 'citas.turno_id', '=', 'turnos.id')
                    ->where('citas.estado', 'ACEPTADA');
            }])
            ->where('tipo', 'MEDICO')
            ->orderBy('cita_count', 'desc')
            ->get();


        return view('home', compact(
            'citasMes',
            'totalCitasDia',
            'totalCitasAceptadas',
            'totalCitasRechazadas',
            'totalCitasPendientes',
            'medicosMasAtendidos'
        ));
    }
}
