<?php

namespace App\Http\Controllers;

use App\comentarios;
use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $post_id)
    {

        if (auth()->check()) {
            try {
                $request->validate([
                    'body' => 'required|string',
                ]);

                $comment = new comentarios([
                    'user_id' => auth()->user()->id,
                    'post_id' => $post_id,
                    'nombre' => auth()->user()->name,
                    'email'  => auth()->user()->email,
                    'body' => $request->body,

                ]);
                $comment->save();

                return back()->with('success', '¡Comentario publicado con éxito!');
            } catch (\Throwable $th) {
                return back()->with('error', 'Hubo un error al publicar el comentario');
            }
        } else {
            return back()->with('error', 'Debe iniciar sesion para poder comentar');
        }
    }
}
