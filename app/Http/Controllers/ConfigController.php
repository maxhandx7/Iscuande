<?php

namespace App\Http\Controllers;

use App\comentarios;
use App\Especialidad;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ConfigController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $comentarios = comentarios::where('asunto', '!=', 'nn')->get();
        return view('admin.config.index', compact('comentarios'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        $especialidades = Especialidad::get();
        return view('admin.config.edit', compact('user', 'especialidades'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);
        $user = Auth::user();
        if (Hash::check($request->current_password, $user->password)) {
            $user->update([
                'password' => Hash::make($request->password)
            ]);

            return redirect()->route('configs.edit', Auth::user()->id)->with('success', '¡Contraseña cambiada exitosamente!');
        } else {
            return back()->withErrors(['current_password' => 'La contraseña actual no coincide con nuestros registros.']);
        }
    }
}
