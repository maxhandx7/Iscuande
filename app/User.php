<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'especialidad_id', 'name', 'apellido', 'tipo_documento', 'no_documento', 'telefono', 'email', 'password',  'tipo', 'estado', 
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class);
    }

    public function my_store($request)
    {
         self::create([
            'especialidad_id' => $request->especialidad_id,
            'name' => $request->name,
            'apellido' => $request->apellido,
            'tipo_documento' => $request->tipo_documento,
            'no_documento' => $request->no_documento,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'tipo' => $request->tipo,
            
        ]);

    }

    public function my_update($request)
    {
        $this->update([
            'especialidad_id' => $request->especialidad_id,
            'name' => $request->name,
            'apellido' => $request->apellido,
            'tipo_documento' => $request->tipo_documento,
            'no_documento' => $request->no_documento,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'tipo' => $request->tipo,
            'estado' => $request->estado,
            'especialidad_id' => $request->especialidad_id,
        ]);
    }
}
