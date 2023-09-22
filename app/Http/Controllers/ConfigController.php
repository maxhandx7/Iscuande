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
        $this->authorize('admin-only');
        $comentarios = comentarios::get();
        return view('admin.config.index', compact('comentarios'));
    }

    public function edit($id)
    {
        $validate = Auth::user()->id;
        if ($validate != $id) {
            return back()->with('error', 'No esta permitido hacer eso');
        }
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

    public function destroy($id)
    {
        $this->authorize('admin-only');
        try {
            $comentario = comentarios::find($id);
            $comentario->delete();
            return redirect()->route('configs.index')->with('success', 'Comentario eliminado');
        } catch (\Exception $th) {
            return redirect()->back()->with('error', 'Ocurrió un error al eliminar el comentario');
        }
    }


    public function update(Request $request, User $user)
    {
        try {
            $user = Auth::user();
            if (Auth::user()->tipo == "PACIENTE") {
                $user->update([
                    'telefono' => $request->telefono,
                    'email' => $request->email,
                ]);
            } else {
                $user->update([
                    'especialidad_id' => $request->especialidad_id,
                    'name' => $request->name,
                    'apellido' => $request->apellido,
                    'tipo_documento' => $request->tipo_documento,
                    'no_documento' => $request->no_documento,
                    'telefono' => $request->telefono,
                    'email' => $request->email,
                    'tipo' => $request->tipo,
                    'estado' => $request->estado,
                ]);
            }
            return redirect()->back()->with('success', 'Usuario modificado');
        } catch (\Exception $th) {
            return redirect()->back()->with('error', 'Ocurrió un error al actualizar el usuario');
        }
    }
}
