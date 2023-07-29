<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    protected $fillable = [
        'nombre', 'apellido', 'cedula',  'especialidad_id',
    ];

    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class);
    }


    public function my_store($request)
    {
         self::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'cedula' => $request->cedula,
            'especialidad_id' => $request->especialidad_id,
        ]);

    }

    public function my_update($request)
    {
        $this->update([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'cedula' => $request->cedula,
            'especialidad_id' => $request->especialidad_id,
        ]);
    }
}
