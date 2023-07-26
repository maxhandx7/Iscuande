<?php

namespace App\Http\Controllers;

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
        return view('admin.user.create', compact('users'));
    }


    public function store(Request $request, User $user)
    {
        
        try {
            $user->my_store($request);
            
            return redirect()->route('users.index')->with('success', 'User credada con éxito');
        } catch (\Exception $th) {
            return redirect()->back()->with('error', 'Ocurrió un error al crear la user');
        }
    }

    public function show(User $user)
    {
        return view('admin.user.show', compact('user'));
    }


    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        try {
            $user->my_update($request);
            return redirect()->route('users.index')->with('success', 'User modificada');
        } catch (\Exception $th) {
            return redirect()->back()->with('error', 'Ocurrió un error al actualizar la user');
        }
    }


    public function destroy(User $user)
    {
        try {
            $user->delete();
            return redirect()->route('users.index')->with('success', 'User eliminada');
        } catch (\Exception $th) {
            return redirect()->back()->with('error', 'Ocurrió un error al cancelar la user');
        }
    }
}
