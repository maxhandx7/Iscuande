<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Cita extends Model
{
    protected $fillable = [
        'user_id',
        'turno_id',
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

    public function my_store($request)
    {
         self::create([
            'user_id' => Auth::user()->id,
            'turno_id' => $request->turno_id,
            'FechaCita' => $request->FechaCita,
            'HoraCita' => $request->HoraCita,
        ]);

    }

    public function my_update($request)
    {
        $this->update([
            'user_id' => Auth::user()->id,
            'turno_id' => $request->turno_id,
            'FechaCita' => $request->FechaCita,
            'HoraCita' => $request->HoraCita,
        ]);
    }
}
