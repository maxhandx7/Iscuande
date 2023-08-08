<?php

namespace App\Http\Controllers;

use App\Especialidad;
use App\Http\Requests\User\StoreRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::get();
        return view('admin.user.index', compact('users'));
    }


    public function create()
    {
        $users = User::get();
        $especialidades = Especialidad::get();
        return view('admin.user.create', compact('users', 'especialidades'));
    }


    public function store(StoreRequest $request, User $user)
    {

        try {
            $user->my_store($request);
            return redirect()->route('users.index')->with('success', 'Usuario credado con éxito');
        } catch (\Exception $th) {
            return redirect()->back()->with('error', 'Ocurrió un error al crear lel usuario');
        }
    }

    public function show(User $user)
    {
        return view('admin.user.show', compact('user'));
    }


    public function edit(User $user)
    {
        $especialidades = Especialidad::get();
        return view('admin.user.edit', compact('user', 'especialidades'));
    }

    public function update(Request $request, User $user)
    {
        try {
            $user->my_update($request);
            return redirect()->route('users.index')->with('success', 'Usuario modificado');
        } catch (\Exception $th) {
            return redirect()->back()->with('error', 'Ocurrió un error al actualizar el usuario');
        }
    }


    public function destroy(User $user)
    {
        try {
            $user->delete();
            return redirect()->route('users.index')->with('success', 'Usuario eliminado');
        } catch (\Exception $th) {
            return redirect()->back()->with('error', 'Ocurrió un error al eliminar el usuario');
        }
    }

    public function showChangePasswordForm()
    {
        return view('admin.config.change-password');
    }

    
}
