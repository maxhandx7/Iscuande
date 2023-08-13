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
        Carbon::setLocale('es');

        $citasMes = Cita::selectRaw('MONTH(FechaCita) as mes, COUNT(*) as mtotal')
        ->where('estado', 'ACEPTADA')
        ->groupBy(DB::raw('MONTH(FechaCita)'))
        ->orderBy('mes', 'DESC')
        ->limit(12)
        ->get();

        foreach ($citasMes as $mes) {
            $mes->mes = Carbon::createFromFormat('m', $mes->mes)->isoFormat('MMMM');
        }
        
        $totalCitasDia = Cita::selectRaw('DATE_FORMAT(FechaCita, "%d/%m/%Y") as dia')
            ->selectRaw('COUNT(*) as total_citas')
            ->where('estado', 'ACEPTADA')
            ->groupBy('FechaCita')
            ->orderBy('FechaCita', 'DESC')
            ->limit(7)
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
