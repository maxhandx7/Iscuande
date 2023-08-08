<?php

namespace App\Http\Controllers;

use App\comentarios;
use App\Post;
use App\User;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('id', 'DESC')->where('status', 'PUBLISHED')->paginate(3);
        $medicos = User::where('tipo', 'MEDICO')->get();
        return view('welcome', compact('posts', 'medicos'));
    }

    public function nosotros()
    {
        $posts = Post::orderBy('id', 'DESC')->where('status', 'PUBLISHED')->paginate(3);
        $medicos = User::where('tipo', 'MEDICO')->get();
        return view('web.nosotros', compact('posts', 'medicos'));
    }
    public function medicos()
    {
        $posts = Post::orderBy('id', 'DESC')->where('status', 'PUBLISHED')->paginate(3);
        $medicos = User::where('tipo', 'MEDICO')->get();
        return view('web.medicos', compact('posts', 'medicos'));
    }
    public function contactos()
    {
        return view('web.contactos');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nombre' => 'required|string',
                'email' => 'required|string',
                'asunto' => 'required|string',
                'body' => 'required|string',
            ]);

            $comment = new comentarios([
                'nombre' => $request->nombre,
                'email'  => $request->email,
                'asunto'  => $request->asunto,
                'body' => $request->body,
            ]);
            $comment->save();

            return back()->with('success', '¡Mensaje enviado con éxito!');
        } catch (\Throwable $th) {
            return back()->with('error', 'Hubo un error al enviar el mensaje');
        }
    }
}
