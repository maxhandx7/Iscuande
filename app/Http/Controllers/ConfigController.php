<?php

namespace App\Http\Controllers;

use App\Especialidad;
use App\User;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function edit($id)
    {
       
        $user = User::find($id);
        $especialidades = Especialidad::get();
        return view('admin.config.edit', compact('user', 'especialidades'));
    }
}
