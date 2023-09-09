<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\Post\StoreRequest;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('admin-only');
        $posts = Post::get();
        return view('admin.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.post.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        try {
            if ($request->hasFile('picture')) {
                $file = $request->file('picture');
                $image_name = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path("/image"), $image_name);
            }
            if (empty($image_name)) {
                $defaultImage = 'system/default.jpg';
                $post =  Post::create($request->except('image') + [
                    'user_id' => Auth::user()->id,
                    'slug' => Str::slug($request->name, '_'),
                    'image' => $defaultImage,
                ]);
                return redirect()->route('posts.index')->with('success', 'Publicacion creada con éxito');
            } else {
                $post = Post::create($request->all() + [
                    'user_id' => Auth::user()->id,
                    'slug' => Str::slug($request->name, '_'),
                    'image' => $image_name,
                ]);
                $post->tags()->attach($request->get('tags'));
                return redirect()->route('posts.index')->with('success', 'Publicacion creada con éxito');
            }
        } catch (\Exception $th) {
            return redirect()->back()->with('error', 'Ocurrió un error al crear el producto.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.post.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  Post $post)
    {
        try {
            if ($request->hasFile('picture')) {
                $file = $request->file('picture');
                $image_name = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path("/image"), $image_name);
            }
            if (isset($image_name)) {
                $post->update($request->except('status') + [
                    'user_id' => Auth::user()->id,
                    'slug' => Str::slug($request->name, '_'),
                    'image' => $image_name,
                ]);
                return redirect()->route('posts.index')->with('success', 'Publicacion modificada');
            }
            $post->update($request->except('status') + [
                'user_id' => Auth::user()->id,
                'slug' => Str::slug($request->name, '_'),
            ]);
            return redirect()->route('posts.index')->with('success', 'Publicacion modificada');
        } catch (\Exception $th) {
            return redirect()->back()->with('error', 'Ocurrió un error al modificar la publicación.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        try {
            $post->delete();
            return redirect()->route('posts.index')->with('success', 'Publicacion eliminada');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocurrió un error al eliminar la publicación.');
        }
    }

    public function change_status(Post $post)
    {
        if ($post->status == 'PUBLISHED') {
            $post->update(['status' => 'DRAFT']);
            return redirect()->back()->with('info', 'Publicacion privada');
        } else {
            $post->update(['status' => 'PUBLISHED']);
            return redirect()->back()->with('info', 'Publicacion publicada');
        }
    }
}
