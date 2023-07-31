<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
    ];

   
    
    public function my_store($request)
    {
        self::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);
    }

    public function my_update($request)
    {

        $this->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);
    }
}
