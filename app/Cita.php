<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Cita extends Model
{
    protected $fillable = [
        'user_id',
        'cupo_id',
        'FechaCita',
        'HoraCita',
        'cupos',
        'estado'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cupo()
    {
        return $this->belongsTo(Cupo::class);
    }

    public function my_store($request)
    {
         self::create([
            'user_id' => Auth::user()->id,
            'cupo_id' => $request->cupo_id,
            'FechaCita' => $request->FechaCita,
            'HoraCita' => $request->HoraCita,
        ]);

    }

    public function my_update($request)
    {
        $this->update([
            'user_id' => Auth::user()->id,
            'cupo_id' => $request->cupo_id,
            'FechaCita' => $request->FechaCita,
            'HoraCita' => $request->HoraCita,
        ]);
    }
}
