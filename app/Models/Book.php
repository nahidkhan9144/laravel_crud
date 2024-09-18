<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    public $timestamps = false;
     protected $table = 'books';

     protected $fillable = [
         'title',
         'author',
         'description',
         'published_date',
     ];
 
     protected $hidden = [

     ];
 
     protected $casts = [
        //  'published_date' => 'datetime',
     ];
     
}
