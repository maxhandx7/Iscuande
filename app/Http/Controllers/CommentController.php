<?php

namespace App\Http\Controllers;

use App\comentarios;
use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $this->authorize('admin-only');
        $comentarios = comentarios::where('asunto', 'nn')->get();
        return view('admin.post.show', compact('comentarios'));
    }

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
                    'nombre' => auth()->user()->username,
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

    public function destroy($id)
    {
        $this->authorize('admin-only');
        try {
            $comentario = comentarios::find($id);
            $comentario->delete();
            return redirect()->back()->with('success', 'Comentario eliminado');
        } catch (\Exception $th) {
            return redirect()->back()->with('error', 'Ocurrió un error al eliminar el comentario');
        }
    }
}
