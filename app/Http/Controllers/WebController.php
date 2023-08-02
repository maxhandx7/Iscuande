<?php

namespace App\Http\Controllers;

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
}
