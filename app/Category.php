<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
   protected $fillable = [

			 'name', 'slug', 'body' 
	];

    public function my_store($request){
        self::create([
            'name'=> $request->name,
            'body'=> $request->body,
            'slug' => Str::slug($request->name, '_'),
        ]);
    }

    public function my_update($request){
        $this->update([
            'name'=> $request->name,
            'body'=> $request->body,
            'slug' => Str::slug($request->name, '_'),
        ]);
    }

    public function posts(){
    	return $this->hasMany(Post::class);
    }
}
