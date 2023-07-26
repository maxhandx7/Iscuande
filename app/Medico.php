<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    protected $fillable = [
        'nombre', 'apellido', 'cedula',  'especialidad',
    ];

    public function my_store($request)
    {
         self::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'cedula' => $request->cedula,
            'especialidad' => $request->especialidad,
        ]);

    }

    public function my_update($request)
    {
        $this->update([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'cedula' => $request->cedula,
            'especialidad' => $request->especialidad,
        ]);
    }
}
