<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'apellido' => ['required', 'string', 'max:255'],
            'tipo_documento' => ['required', 'string', 'max:255'],
            'no_documento' => ['required', 'string', 'max:15', 'unique:users'],
            'telefono' => ['nullable', 'string', 'max:15'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $nombreUsuario = strtolower(str_replace(' ', '', $data['name']));
        $contador = 1;
        $nombreUsuarioOriginal = $nombreUsuario;
        while (User::where('username', "@".$nombreUsuario)->exists()) {
            $nombreUsuario = $nombreUsuarioOriginal . $contador;
            $contador++;
        }
        return User::create([
            'name' => $data['name'],
            'apellido' => $data['apellido'],
            'username' => "@".$nombreUsuario,
            'tipo_documento' => $data['tipo_documento'],
            'no_documento' => $data['no_documento'],
            'telefono' => $data['telefono'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
