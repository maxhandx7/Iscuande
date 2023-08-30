<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
   protected $casts = [
      'configurations' => 'json',
   ];

   protected $fillable = [
      'name',
      'description',
      'mision',
      'vision',
      'logo',
      'mail',
      'address',
      'phone',
      'nit',
   ];

   
}
