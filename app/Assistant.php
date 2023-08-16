<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assistant extends Model
{
    protected $fillable = [
        'nombre',
        'directivas',
        'principios'
       ];

       public function my_update($request, $principios, $directivas){
        $this->update([
            'nombre'=> $request->nombre,
            'directivas'=> $directivas,
            'principios' => $principios,
        ]);
    }
}
