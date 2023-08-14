<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Cita extends Model
{
    protected $fillable = [
        'user_id',
        'turno_id',
        'especialidad_id',
        'FechaCita',
        'HoraCita',
        'estado'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function turno()
    {
        return $this->belongsTo(Turno::class);
    }

    public function my_store($id, $fecha, $hora, $especialidad)
    {
        return self::create([
            'user_id' => Auth::user()->id,
            'turno_id' => intval($id),
            'especialidad_id' => $especialidad,
            'FechaCita' => $fecha,
            'HoraCita' => $hora,
        ]); 
    }

    public function my_update($id, $estado)
    {
        return $this->where('id', $id)->update(['estado' => $estado]);
    }
}
