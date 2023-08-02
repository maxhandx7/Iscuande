<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function blog()
    {

        $posts = Post::orderBy('id', 'DESC')->where('status', 'PUBLISHED')->paginate(3);
        $categoriesWithCount = Category::select('categories.id', 'categories.slug', 'categories.name', DB::raw('COUNT(posts.id) as posts_count'))
            ->leftJoin('posts', 'categories.id', '=', 'posts.category_id')
            ->groupBy('categories.id', 'categories.name', 'categories.slug')
            ->orderByDesc(DB::raw('COUNT(posts.id)'))
            ->get();
        $tags = Tag::get();
        return view('posts', compact('posts',  'categoriesWithCount', 'tags'));
    }

    public function post($slug)
    {
        $categoriesWithCount = Category::select('categories.id', 'categories.slug', 'categories.name', DB::raw('COUNT(posts.id) as posts_count'))
            ->leftJoin('posts', 'categories.id', '=', 'posts.category_id')
            ->groupBy('categories.id', 'categories.name', 'categories.slug')
            ->orderByDesc(DB::raw('COUNT(posts.id)'))
            ->get();
        $post = \App\Post::where('slug', $slug)->first();
        $tags = Tag::get();
        return view('/post', compact('post',  'categoriesWithCount', 'tags'));
    }

    public function category($slug)
    {
        $category = \App\Category::where('slug', $slug)->pluck('id')->first();
        $categoriesWithCount = Category::select('categories.id', 'categories.slug', 'categories.name', DB::raw('COUNT(posts.id) as posts_count'))
            ->leftJoin('posts', 'categories.id', '=', 'posts.category_id')
            ->groupBy('categories.id', 'categories.name', 'categories.slug')
            ->orderByDesc(DB::raw('COUNT(posts.id)'))
            ->get();
        $relatedPosts   = \App\Post::where('category_id', $category)
            ->orderBy('id', 'DESC')->where('status', 'PUBLISHED')->paginate(3);
        $posts = Post::orderBy('id', 'DESC')->where('status', 'PUBLISHED')->paginate(3);
        $tags = Tag::get();
        return view('/posts', compact('relatedPosts', 'categoriesWithCount', 'posts', 'tags'));
    }
}
