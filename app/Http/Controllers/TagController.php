<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $tags = Tag::get();

        return view('admin.tag.index', compact('tags'));
    }


    public function create()
    {
        return view('admin.tag.create');
    }


    public function store(Request $request, Tag $tag)
    {
        try {
            $tag->my_store($request);
            return redirect()->route('tags.index')->with('success', 'Etiqueta credada con éxito');
        } catch (\Exception $th) {
            return redirect()->back()->with('error', 'Ocurrió un error al crear la etiqueta');
        }
    }

    public function show(Tag $tag)
    {
        return view('admin.tag.show', compact('tag'));
    }


    public function edit(Tag $tag)
    {
        return view('admin.tag.edit', compact('tag'));
    }

    public function update(Request $request, Tag $tag)
    {
        try {
            $tag->my_update($request);
            return redirect()->route('tags.index')->with('success', 'Etiqueta modificada');
        } catch (\Exception $th) {
            return redirect()->back()->with('error', 'Ocurrió un error al actualizar la etiqueta');
        }
    }


    public function destroy(Tag $tag)
    {
        try {
            $tag->delete();
            return redirect()->route('tags.index')->with('success', 'Etiqueta eliminada');
        } catch (\Exception $th) {
            return redirect()->back()->with('error', 'Ocurrió un error al eliminar la etiqueta');
        }
    }
}
